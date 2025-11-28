<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Hotels;
use App\Models\PackageBooking;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Auth;
use PDF; 


class PDFController extends Controller
{

    // public function downloadWithLogo($user_id, $booking_id, $pdf_name)
    // {
    //       set_time_limit(300);

    //     try {
    //         $user = Agent::where('id',Auth::id())->first();
    //         $booking = PackageBooking::with('tourists', 'hotels')->where('id', $booking_id)->first();
    //         $user = Agent::where('id',Auth::id())->first();

    //         // $pdf_name = urldecode(basename($pdf_name));
    //         // $pdfPath = public_path('packages/pdf/' . $pdf_name);

    //         // if (!file_exists($pdfPath)) {
    //         //     return abort(404, 'PDF not found.');
    //         // }

    //         $pdf = new Fpdi();
           
    //         // $pageCount = $pdf->setSourceFile($pdfPath);

    //         // for ($i = 1; $i <= $pageCount; $i++) {
    //         //     $template = $pdf->importPage($i);
    //         //     $size = $pdf->getTemplateSize($template);
    //         //     $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
    //         //     $pdf->useTemplate($template);
    //         // }

    //         $invoiceHtml = view('front.invoice', compact('user', 'booking'))->render();
    //         $tempPdf = PDF::loadHTML($invoiceHtml);
    //         $tempPdfPath = tempnam(sys_get_temp_dir(), 'invoice') . '.pdf';
    //         $tempPdf->save($tempPdfPath);

    //         $invoicePageCount = $pdf->setSourceFile($tempPdfPath);
    //         for ($i = 1; $i <= $invoicePageCount; $i++) {
    //             $template = $pdf->importPage($i);
    //             $size = $pdf->getTemplateSize($template);
    //             $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
    //             $pdf->useTemplate($template);
    //         }

    //         unlink($tempPdfPath);

    //         return response()->stream(function () use ($pdf) {
    //             $pdf->Output('D', 'customized_with_invoice.pdf');
    //         }, 200, [
    //             'Content-Type' => 'application/pdf',
    //             'Content-Disposition' => 'attachment; filename="customized_with_invoice.pdf"'
    //         ]);

    //     } catch (\Exception $e) {
    //         \Log::error('PDF generation failed: ' . $e->getMessage());
    //         return abort(500, 'Something went wrong generating the PDF.');
    //     }
    // }


    // latest

    public function downloadWithLogo($user_id, $booking_id, $pdf_name)
{
    set_time_limit(300);

    try {
        $data['user'] = Auth::guard('agent')->user();
        $data['booking'] = PackageBooking::with('tourists', 'hotels', 'package', 'packagetemp')
                            ->where('user_id', $user_id)
                            ->where('id', $booking_id)
                            ->first();

        if (!$data['booking']) {
            return abort(404, 'Booking not found.');
        }

        $packageIds = [$data['booking']->package_id]; // single booking
        $data['hotels'] = Hotels::where(function ($query) use ($packageIds) {
            foreach ($packageIds as $id) {
                $query->orWhereRaw("FIND_IN_SET(?, package_id)", [$id]);
            }
        })->get();

        // Invoice PDF
        $invoiceHtml = view('front.invoice', $data)->render();
        $tempPdf = PDF::loadHTML($invoiceHtml);
        $tempPdfPath = tempnam(sys_get_temp_dir(), 'invoice') . '.pdf';
        $tempPdf->save($tempPdfPath);

        $pdf = new \setasign\Fpdi\Fpdi();
        $invoicePageCount = $pdf->setSourceFile($tempPdfPath);
        for ($i = 1; $i <= $invoicePageCount; $i++) {
            $template = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($template);
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($template);
        }
        unlink($tempPdfPath);

        // Additional PDF
        $additionalPdfPath = public_path('packages/pdf/' . urldecode($pdf_name));
        if (file_exists($additionalPdfPath)) {
            try {
                $additionalPageCount = $pdf->setSourceFile($additionalPdfPath);
                for ($i = 1; $i <= $additionalPageCount; $i++) {
                    $template = $pdf->importPage($i);
                    $size = $pdf->getTemplateSize($template);
                    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                    $pdf->useTemplate($template);
                }
            } catch (\Exception $e) {
                \Log::error("FPDI cannot import compressed PDF: " . $e->getMessage());
            }
        }

        return response()->stream(function () use ($pdf) {
            $pdf->Output('D', 'customized_with_invoice.pdf');
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="customized_with_invoice.pdf"'
        ]);

    } catch (\Exception $e) {
        \Log::error('PDF generation failed: ' . $e->getMessage());
        return abort(500, 'Something went wrong generating the PDF.');
    }
}


// public function downloadWithLogo($user_id, $booking_id, $pdf_name)
// {
//     set_time_limit(300);

//     try {
//         $data['user'] = Auth::guard('agent')->user();

//         $data['booking'] = PackageBooking::with('tourists', 'hotels')
//             ->where('user_id', $data['user']->id)
//             ->orderBy('id', 'DESC')->get();

//         $packageIds = $data['booking']->pluck('package_id')->map(fn($id) => (int)$id)->toArray();

//         $data['hotels'] = Hotels::where(function ($query) use ($packageIds) {
//             foreach ($packageIds as $id) {
//                 $query->orWhereRaw("FIND_IN_SET(?, package_id)", [$id]);
//             }
//         })->get();

//         $pdf = new \setasign\Fpdi\Fpdi(); // ensure full namespace if needed

//         // 1. Generate invoice page
//         $invoiceHtml = view('front.invoice', $data)->render();
//         $tempPdf = PDF::loadHTML($invoiceHtml);
//         $tempPdfPath = tempnam(sys_get_temp_dir(), 'invoice') . '.pdf';
//         $tempPdf->save($tempPdfPath);

//         // Add invoice to FPDI
//         $invoicePageCount = $pdf->setSourceFile($tempPdfPath);
//         for ($i = 1; $i <= $invoicePageCount; $i++) {
//             $template = $pdf->importPage($i);
//             $size = $pdf->getTemplateSize($template);
//             $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
//             $pdf->useTemplate($template);
//         }

//         unlink($tempPdfPath); // Delete temp file

//         // 2. Append additional PDF if exists
//         $additionalPdfPath = public_path('packages/pdf/' . urldecode($pdf_name));
//         if (file_exists($additionalPdfPath)) {
//             $additionalPageCount = $pdf->setSourceFile($additionalPdfPath);
//             for ($i = 1; $i <= $additionalPageCount; $i++) {
//                 $template = $pdf->importPage($i);
//                 $size = $pdf->getTemplateSize($template);
//                 $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
//                 $pdf->useTemplate($template);
//             }
//         } else {
//             \Log::warning("Additional PDF not found: " . $additionalPdfPath);
//         }

//         // Output PDF inline (view in browser, not download)
//         return response()->stream(function () use ($pdf) {
//             $pdf->Output('I', 'customized_with_invoice.pdf'); // Inline display
//         }, 200, [
//             'Content-Type' => 'application/pdf',
//             'Content-Disposition' => 'inline; filename="customized_with_invoice.pdf"'
//         ]);

//     } catch (\Exception $e) {
//         \Log::error('PDF generation failed: ' . $e->getMessage());
//         return abort(500, 'Something went wrong generating the PDF.');
//     }
// }



}

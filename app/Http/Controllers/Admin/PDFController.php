<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Hotels;
use App\Models\PackageBooking;
use App\Models\Tourist;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use PDF;
use Razorpay\Api\Customer;

class PDFController extends Controller
{
    // latest


//     public function downloadWithLogo($user_id, $booking_id, $pdf_name)
// {
//     ini_set('memory_limit', '4096M'); // or -1 for unlimited
//     set_time_limit(600);
//        Log::info('downloadWithLogo:', [
//             'user_id' => $user_id,
//             'booking_id' => $booking_id,
//             'pdf_name' => $pdf_name
//         ]);

//     try {
//         $data['user'] = Agent::where('id', $user_id)->first();
//         $data['booking'] = PackageBooking::with('tourists', 'hotels', 'package', 'packagetemp')
//                             ->where('user_id', $user_id)
//                             ->where('id', $booking_id)
//                             ->first();

//         if (!$data['booking']) {
//             return abort(404, 'Booking not found.');
//         }

//         $packageIds = [$data['booking']->package_id]; 
//         $data['hotels'] = Hotels::where(function ($query) use ($packageIds) {
//             foreach ($packageIds as $id) {
//                 $query->orWhereRaw("FIND_IN_SET(?, package_id)", [$id]);
//             }
//         })->get();

//         $invoiceHtml = view('front.invoice', $data)->render();
//         $tempPdf = PDF::loadHTML($invoiceHtml);
//         $tempPdfPath = tempnam(sys_get_temp_dir(), 'invoice') . '.pdf';
//         $tempPdf->save($tempPdfPath);

//         $pdf = new \setasign\Fpdi\Fpdi();
//         $invoicePageCount = $pdf->setSourceFile($tempPdfPath);
//         for ($i = 1; $i <= $invoicePageCount; $i++) {
//             $template = $pdf->importPage($i);
//             $size = $pdf->getTemplateSize($template);
//             $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
//             $pdf->useTemplate($template);
//         }
//         unlink($tempPdfPath);

//         $additionalPdfPath = public_path('packages/pdf/' . urldecode($pdf_name));
//         if (file_exists($additionalPdfPath)) {
//             try {
//                 $additionalPageCount = $pdf->setSourceFile($additionalPdfPath);
//                 for ($i = 1; $i <= $additionalPageCount; $i++) {
//                     $template = $pdf->importPage($i);
//                     $size = $pdf->getTemplateSize($template);
//                     $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
//                     $pdf->useTemplate($template);
//                 }
//             } catch (\Exception $e) {
//                 \Log::error("FPDI cannot import compressed PDF: " . $e->getMessage());
//             }
//         }

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


public function downloadWithLogo($user_id, $booking_id, $pdf_name)
{
    ini_set('memory_limit', '4096M');
    set_time_limit(600);

    try {
        // FETCH BOOKING
        $data['user'] = Agent::find($user_id);
        $data['booking'] = PackageBooking::with('tourists', 'hotels', 'package', 'packagetemp')
                        ->where('user_id', $user_id)
                        ->find($booking_id);

        $data['Customer'] = Tourist::where('booking_id', $booking_id)->get();              

        if (!$data['booking']) {
            return abort(404, 'Booking not found.');
        }

     
        $invoiceHtml = view('front.invoice', $data)->render();
        $invoicePdf = PDF::loadHTML($invoiceHtml);
        $invoicePdfPath = tempnam(sys_get_temp_dir(), 'invoice') . '.pdf';
        $invoicePdf->save($invoicePdfPath);

        $pdf = new \setasign\Fpdi\Fpdi();

        $filePath = public_path('packages/pdf/' . urldecode($pdf_name));
        $attachPdfPath = null;

        if (file_exists($filePath)) {

            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            // CASE PDF
            if ($ext === 'pdf') {
                $attachPdfPath = $filePath;
            }

            // CASE DOC / DOCX
            elseif (in_array($ext, ['doc', 'docx'])) {

                $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);

                // Word → HTML
                $htmlPath = sys_get_temp_dir() . '/' . uniqid('word_') . '.html';
                \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML')->save($htmlPath);

                // HTML → PDF
                $convertedPdfPath = sys_get_temp_dir() . '/' . uniqid('word_pdf_') . '.pdf';
                PDF::loadHTML(file_get_contents($htmlPath))->save($convertedPdfPath);

                $attachPdfPath = $convertedPdfPath;
            }

            // MERGE ATTACHED PDF BEFORE INVOICE
            if ($attachPdfPath && file_exists($attachPdfPath)) {

                $pageCount = $pdf->setSourceFile($attachPdfPath);

                for ($i = 1; $i <= $pageCount; $i++) {
                    $template = $pdf->importPage($i);
                    $size = $pdf->getTemplateSize($template);
                    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                    $pdf->useTemplate($template);
                }
            }
        }

        // -----------------------------
        // 4️⃣ INVOICE PDF AFTER ATTACHED
        // -----------------------------
        $invCount = $pdf->setSourceFile($invoicePdfPath);

        for ($i = 1; $i <= $invCount; $i++) {
            $template = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($template);
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($template);
        }

        // Delete Temp
        unlink($invoicePdfPath);

        return response()->stream(function () use ($pdf) {
            $pdf->Output('D', 'customized_with_invoice.pdf');
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="customized_with_invoice.pdf"'
        ]);

    } catch (\Exception $e) {
        \Log::error('PDF generation failed: ' . $e->getMessage());
        return abort(500, 'Error generating PDF.');
    }
}


// public function downloadWithLogo($user_id, $booking_id, $pdf_name)
// {
//     ini_set('memory_limit', '4096M');
//     set_time_limit(600);

//     try {
//         // Fetch booking + invoice data
//         $data['user'] = Agent::find($user_id);
//         $data['booking'] = PackageBooking::with('tourists', 'hotels', 'package', 'packagetemp')
//                         ->where('user_id', $user_id)
//                         ->find($booking_id);

//         if (!$data['booking']) {
//             return abort(404, 'Booking not found.');
//         }

//         // Render invoice HTML → PDF
//         $invoiceHtml = view('front.invoice', $data)->render();
//         $invoicePdf = PDF::loadHTML($invoiceHtml);
//         $invoicePdfPath = tempnam(sys_get_temp_dir(), 'invoice') . '.pdf';
//         $invoicePdf->save($invoicePdfPath);

//         // Start merging
//         $pdf = new \setasign\Fpdi\Fpdi();
//         $invCount = $pdf->setSourceFile($invoicePdfPath);

//         for ($i = 1; $i <= $invCount; $i++) {
//             $template = $pdf->importPage($i);
//             $size = $pdf->getTemplateSize($template);
//             $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
//             $pdf->useTemplate($template);
//         }

//         unlink($invoicePdfPath);

//         // ==========================================
//         //   ATTACHED FILE HANDLING (PDF / DOCX)
//         // ==========================================
//         $filePath = public_path('packages/pdf/' . urldecode($pdf_name));

//         if (file_exists($filePath)) {

//             $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

//             // CASE 1: PDF → Direct merge
//             if ($ext === 'pdf') {
//                 $attachPdfPath = $filePath;
//             }

//             // CASE 2: DOC / DOCX → Convert to PDF
//             elseif (in_array($ext, ['doc', 'docx'])) {

//                 $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);

//                 // Convert Word → HTML
//                 $htmlPath = sys_get_temp_dir() . '/' . uniqid('word_') . '.html';
//                 \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML')->save($htmlPath);

//                 // Convert HTML → PDF
//                 $convertedPdfPath = sys_get_temp_dir() . '/' . uniqid('word_pdf_') . '.pdf';
//                 $domPdf = PDF::loadHTML(file_get_contents($htmlPath));
//                 $domPdf->save($convertedPdfPath);

//                 $attachPdfPath = $convertedPdfPath;
//             }

//             // Merge final PDF
//             if (!empty($attachPdfPath) && file_exists($attachPdfPath)) {

//                 $pageCount = $pdf->setSourceFile($attachPdfPath);

//                 for ($i = 1; $i <= $pageCount; $i++) {
//                     $template = $pdf->importPage($i);
//                     $size = $pdf->getTemplateSize($template);
//                     $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
//                     $pdf->useTemplate($template);
//                 }
//             }
//         }

//         return response()->stream(function () use ($pdf) {
//             $pdf->Output('D', 'customized_with_invoice.pdf');
//         }, 200, [
//             'Content-Type' => 'application/pdf',
//             'Content-Disposition' => 'attachment; filename="customized_with_invoice.pdf"'
//         ]);

//     } catch (\Exception $e) {
//         \Log::error('PDF generation failed: ' . $e->getMessage());
//         return abort(500, 'Error generating PDF.');
//     }
// }




}

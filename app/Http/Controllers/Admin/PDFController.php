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



// public function downloadWithLogo($user_id, $booking_id, $pdf_name)
// {
//     ini_set('memory_limit', '4096M');
//     set_time_limit(600);

//     try {
//         // FETCH BOOKING
//         $data['user'] = Agent::find($user_id);
//         $data['booking'] = PackageBooking::with('tourists', 'hotels', 'package', 'packagetemp')
//                         ->where('user_id', $user_id)
//                         ->find($booking_id);            

//         if (!$data['booking']) {
//             return abort(404, 'Booking not found.');
//         }

     
//         $invoiceHtml = view('front.invoice', $data)->render();
//         $invoicePdf = PDF::loadHTML($invoiceHtml);
//         $invoicePdfPath = tempnam(sys_get_temp_dir(), 'invoice') . '.pdf';
//         $invoicePdf->save($invoicePdfPath);

//         $pdf = new \setasign\Fpdi\Fpdi();

//         $filePath = public_path('packages/pdf/' . urldecode($pdf_name));
//         $attachPdfPath = null;

//         if (file_exists($filePath)) {

//             $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

//             // CASE PDF
//             if ($ext === 'pdf') {
//                 $attachPdfPath = $filePath;
//             }

//             // CASE DOC / DOCX
//             elseif (in_array($ext, ['doc', 'docx'])) {

//                 $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);

//                 // Word → HTML
//                 $htmlPath = sys_get_temp_dir() . '/' . uniqid('word_') . '.html';
//                 \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML')->save($htmlPath);

//                 // HTML → PDF
//                 $convertedPdfPath = sys_get_temp_dir() . '/' . uniqid('word_pdf_') . '.pdf';
//                 PDF::loadHTML(file_get_contents($htmlPath))->save($convertedPdfPath);

//                 $attachPdfPath = $convertedPdfPath;
//             }

//             // MERGE ATTACHED PDF BEFORE INVOICE
//             if ($attachPdfPath && file_exists($attachPdfPath)) {

//                 $pageCount = $pdf->setSourceFile($attachPdfPath);

//                 for ($i = 1; $i <= $pageCount; $i++) {
//                     $template = $pdf->importPage($i);
//                     $size = $pdf->getTemplateSize($template);
//                     $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
//                     $pdf->useTemplate($template);
//                 }
//             }
//         }

//         // -----------------------------
//         // 4️⃣ INVOICE PDF AFTER ATTACHED
//         // -----------------------------
//         $invCount = $pdf->setSourceFile($invoicePdfPath);

//         for ($i = 1; $i <= $invCount; $i++) {
//             $template = $pdf->importPage($i);
//             $size = $pdf->getTemplateSize($template);
//             $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
//             $pdf->useTemplate($template);
//         }

//         // Delete Temp
//         unlink($invoicePdfPath);

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


public function downloadWithLogo($user_id, $booking_id, $pdf_name)
{
    ini_set('memory_limit', '4096M');
    set_time_limit(600);

    try {

        // -----------------------------
        // 1️⃣ FETCH BOOKING DATA
        // -----------------------------
        $data['user'] = Agent::find($user_id);

        $data['booking'] = PackageBooking::with(
            'tourists',
            'hotels',
            'package',
            'packagetemp'
        )
        ->where('user_id', $user_id)
        ->find($booking_id);

        if (!$data['booking']) {
            abort(404, 'Booking not found.');
        }

        // -----------------------------
        // 2️⃣ GENERATE INVOICE PDF
        // -----------------------------
        $invoiceHtml = view('front.invoice', $data)->render();

        $invoicePdf = PDF::loadHTML($invoiceHtml);
        $invoicePdfPath = tempnam(sys_get_temp_dir(), 'invoice_') . '.pdf';
        $invoicePdf->save($invoicePdfPath);

        // -----------------------------
        // 3️⃣ FPDI INIT
        // -----------------------------
        $pdf = new \setasign\Fpdi\Fpdi();

        // Full HD size (1920x1080 @72DPI)
        $pageWidth  = 677; // mm
        $pageHeight = 381; // mm

        // -----------------------------
        // 4️⃣ ATTACHED FILE HANDLING
        // -----------------------------
        $filePath = public_path('packages/pdf/' . urldecode($pdf_name));
        $attachPdfPath = null;

        if (file_exists($filePath)) {

            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            // CASE: PDF
            if ($ext === 'pdf') {
                $attachPdfPath = $filePath;
            }

            // CASE: DOC / DOCX
            elseif (in_array($ext, ['doc', 'docx'])) {

                $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);

                // Word → HTML
                $htmlPath = sys_get_temp_dir() . '/' . uniqid('word_') . '.html';
                \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML')
                    ->save($htmlPath);

                // HTML → PDF
                $convertedPdfPath = sys_get_temp_dir() . '/' . uniqid('word_pdf_') . '.pdf';
                PDF::loadHTML(file_get_contents($htmlPath))
                    ->save($convertedPdfPath);

                $attachPdfPath = $convertedPdfPath;
            }

            // -----------------------------
            // 5️⃣ MERGE ATTACHED PDF FIRST
            // -----------------------------
            if ($attachPdfPath && file_exists($attachPdfPath)) {

                $pageCount = $pdf->setSourceFile($attachPdfPath);

                for ($i = 1; $i <= $pageCount; $i++) {

                    $template = $pdf->importPage($i);

                    $pdf->AddPage('L', [$pageWidth, $pageHeight]);
                    $pdf->useTemplate($template, 0, 0, $pageWidth, $pageHeight);
                }
            }
        }

        // -----------------------------
        // 6️⃣ MERGE INVOICE PDF (FULL HD)
        // -----------------------------
        $invCount = $pdf->setSourceFile($invoicePdfPath);

        for ($i = 1; $i <= $invCount; $i++) {

            $template = $pdf->importPage($i);

            $pdf->AddPage('L', [$pageWidth, $pageHeight]);
            $pdf->useTemplate($template, 0, 0, $pageWidth, $pageHeight);
        }

        // -----------------------------
        // 7️⃣ CLEANUP TEMP FILES
        // -----------------------------
        if (file_exists($invoicePdfPath)) {
            unlink($invoicePdfPath);
        }

        // -----------------------------
        // 8️⃣ DOWNLOAD RESPONSE
        // -----------------------------
        return response()->stream(function () use ($pdf) {
            $pdf->Output('D', 'customized_with_invoice_1920x1080.pdf');
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="customized_with_invoice_1920x1080.pdf"'
        ]);

    } catch (\Exception $e) {

        \Log::error('PDF generation failed: ' . $e->getMessage());

        abort(500, 'Error generating PDF.');
    }
}


}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use setasign\Fpdi\Fpdi;
use PDF; 


class PDFController extends Controller
{

    public function downloadWithLogo($user_id, $pdf_name)
    {
        try {
            $user = Agent::findOrFail($user_id);

            $pdf_name = urldecode(basename($pdf_name));
            $pdfPath = public_path('packages/pdf/' . $pdf_name);

            if (!file_exists($pdfPath)) {
                return abort(404, 'PDF not found.');
            }

            $pdf = new Fpdi();

            // Import existing PDF pages
            $pageCount = $pdf->setSourceFile($pdfPath);
            for ($i = 1; $i <= $pageCount; $i++) {
                $template = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($template);
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useTemplate($template);
            }

            // Render the invoice view and convert to PDF
            $invoiceHtml = view('front.invoice', compact('user'))->render();
            
            // Use Laravel's PDF facade to generate a temporary PDF from the view
            $tempPdf = PDF::loadHTML($invoiceHtml);
            $tempPdfPath = tempnam(sys_get_temp_dir(), 'invoice') . '.pdf';
            $tempPdf->save($tempPdfPath);

            // Import the invoice PDF and append its pages
            $invoicePageCount = $pdf->setSourceFile($tempPdfPath);
            for ($i = 1; $i <= $invoicePageCount; $i++) {
                $template = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($template);
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useTemplate($template);
            }

            // Clean up temporary file
            unlink($tempPdfPath);

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

    // public function downloadWithLogo($user_id, $pdf_name)
    // {
    //     try {
    //         $user = Agent::findOrFail($user_id);

    //         $pdf_name = urldecode(basename($pdf_name)); 
    //         $logoPath = public_path($user->logo); 
    //         $pdfPath = public_path('packages/pdf/' . $pdf_name); 

    //         if (!file_exists($pdfPath)) {
    //             return abort(404, 'PDF not found.');
    //         }

    //         $pdf = new Fpdi();

    //         $pageCount = $pdf->setSourceFile($pdfPath);
    //         for ($i = 1; $i <= $pageCount; $i++) {
    //             $template = $pdf->importPage($i);
    //             $size = $pdf->getTemplateSize($template);
    //             $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
    //             $pdf->useTemplate($template);
    //         }

    //         $pdf->AddPage();
    //         $pdf->SetFont('Arial', 'B', 14);
    //         $pdf->Cell(0, 10, 'User Logo Added Below', 0, 1, 'C');

    //         if (file_exists($logoPath)) {
    //             $pdf->Image($logoPath, 60, 40, 90); 
    //         } else {
    //             $pdf->Ln(20);
    //             $pdf->SetFont('Arial', 'I', 12);
    //             $pdf->Cell(0, 10, 'Logo not found', 0, 1, 'C'); 
    //         }

    //         return response()->stream(function () use ($pdf) {
    //             $pdf->Output('D', 'customized_with_logo.pdf');
    //         }, 200, [
    //             'Content-Type' => 'application/pdf',
    //             'Content-Disposition' => 'attachment; filename="customized_with_logo.pdf"'
    //         ]);

    //     } catch (\Exception $e) {
    //         \Log::error('PDF generation failed: ' . $e->getMessage());
    //         return abort(500, 'Something went wrong generating the PDF.');
    //     }
    // }
}

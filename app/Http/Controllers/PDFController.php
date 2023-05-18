<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\PDF;


class PDFController extends Controller
{
    public function exportPDF(){
        $domPdf = new Dompdf();
        $html = View::make('tutorial.tutorial')->render();
        $start = strpos($html, '<div id="export">');
        $end = strpos($html, '</div>', $start);
        $length = $end - $start + strlen('</div>');
        if ($start !== false && $end !== false) {
            $exportContent = substr($html, $start, $length);
            $domPdf->loadHtml($exportContent);
            $domPdf->render();
            $domPdf->stream();

        } else {
            // Handle if the div with id "export" is not found
            return response('Div not found.', 404);
        }


    }
    /*public function exportPDF()
    {
        $html = View::make('tutorial.tutorial')->render();s
        return response($html);
        $start = strpos($html, '<div id="export">');
        $end = strpos($html, '</div>', $start);
        $length = $end - $start + strlen('</div>');

        if ($start !== false && $end !== false) {
            $exportContent = substr($html, $start, $length);

            $dompdf = new Dompdf();
            $dompdf->loadHtml($exportContent);
            $dompdf->render();
            $dompdf->stream("tutorial.pdf");
        } else {
            // Handle if the div with id "export" is not found
            return response('Div not found.', 404);
        }
    }*/

}

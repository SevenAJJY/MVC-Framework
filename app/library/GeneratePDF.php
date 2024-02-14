<?php

namespace SEVENAJJY\Library;
        // require 'vendor/autoload.php';

require  VENDOR . "autoload.php";
use Dompdf\Dompdf;

class GeneratePDF {
    public function generate() {
        
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml('polleta');
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        
        // Render the HTML as PDF
        $dompdf->render();
        
        // Output the generated PDF to Browser
        $dompdf->stream('invoice.pdf');
    }
}
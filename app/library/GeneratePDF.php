<?php

namespace SEVENAJJY\Library;

require  VENDOR . "autoload.php";
use Dompdf\Dompdf;

class GeneratePDF {
    public function generate() {

        $html = '<h1 style="color:green">Exemple<h1>';
        $html .= '<img src="perDPDF.png" />' ;
        
        $dompdf = new Dompdf();
        $dompdf->getOptions()->set('chroot', '/' );
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
            
        // Output the generated PDF to Browser
        $dompdf->stream('invoice.pdf', ['Attachment' => 0 ]);
    }
}
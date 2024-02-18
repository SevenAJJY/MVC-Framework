<?php

namespace SEVENAJJY\Library;

require  VENDOR . "autoload.php";

use ArrayIterator;
use DateTime;
use Dompdf\Dompdf;
use SEVENAJJY\Models\ClientInvoiceModel;

class GeneratePDF {
    public static function generate(ClientInvoiceModel $invoice, ArrayIterator|false $productDetails, array $dictionary) {
        $html = '' ;
        
        $html .= ' 
            <!DOCTYPE html>
            <html lang="en">
            
            <head>
                <title>HAJJYFOODS</title>
                <!-- Make you site support all letter formats -->
            <meta charset="UTL-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <style type="text/css">
                    body{
                        font-family: "Poppins", sans-serif; 
                        margin: 30px;
                        border: 1px solid #e1e1e1;
                    }

                    *,
                    ::before,
                    ::after {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        list-style: none;
                    }

                    
                    .invoice_container{
                        
                        width: 100%;
                        height: 100%;
                        height: auto;
                        position: relative;
                    }
                    .invoice__head{
                        height: 170px;
                    }
                    .invoice__head img{
                        float: left;
                        width: 200px;
                        height:200px;
                        padding-left: 60px;
                    }

                    .invoice__head .company__info{
                        float:right;
                        padding-right: 50px;
                        margin-top: 30px;
                        text-align: center;
                        font-size: 15px;
                    }

                    .company__info strong{
                        font-size: 35px;
                        font-weight: bold;
                        color: #29844b ; 
                    }

                    .client__info{
                        border: solid 1px #707070;
                        width: 90%;
                        height: 95px;
                        padding: 20px;
                        margin: 10px 15px;
                        margin-top: 25px;
                    }

                    .client__info .div_1{
                        float: left;
                    }

                    .div_1 .info__name,
                    .div_2 .info__name{
                        float: left;
                    }

                    .div_1 .info__name p ,
                    .div_2 .info__name p {
                        font-weight: bold;
                        font-size:15px;
                    }
                    .div_1 .info__info,
                    .div_2 .info__info{
                        position: absolute;
                        left: 130px;
                    }
                    .div_2 .info__info p,
                    .div_1 .info__info p {
                        font-size:15px;
                        color: #222;
                    }
                    .client__info .div_2{
                        float: right;
                        margin-right:200px;
                    }

                    .product__list{
                        width: 95%;
                        padding: 17px;
                        margin-bottom: 10px;
                    }

                    .product__list  span{
                        border:none;
                        background-color: #a9cf46;
                        font-size: 15px;
                        padding: 6px 10px;
                        margin-bottom: 10px;
                        border-radius: 3px;
                        color:#fff;
                    }
                    
                    .product__list table {
                        border-collapse: collapse;
                        margin-top: 0px;
                        width: 100%;
                        margin-top: 10px;
                        margin-bottom: 10px;
                    }
                    .product__list table td {
                        border: 1px solid #e1e1e1;
                    }

                    .product__list table th{
                        border:none;
                        background-color: #e1e1e1;
                        font-size: 15px;
                        font-weight: bold;
                    }

                    table th, table td{
                        padding: 5px;
                        text-align: center;
                    }

                    table td{
                        font-size: 13px;
                    }

                    .bill-total{
                        text-align: right;
                    }

                    .bill-total p {
                        display: inline-block;
                        margin-bottom:-4.5px;
                        font-weight: bold;
                    }
                </style>
            </head>
            <body style=" display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">';
        // Container
        $html .= '<div class="invoice_container">';
            // Logo + info
            $html .= '<div class="invoice__head">' ;
                $html .= '<img src="perDPDF.png" />' ;
                $html .= '<div class="company__info">
                            <strong>HAJJY FOODS</strong> di elhajjy rahal
                            <p>Via DE NICOLA 8/10 95131 Catania, Italy</p>
                            <p>Cod. Fisc.:LHJRHL68T15Z330I</p>
                            <p>P. iva 03588290837</p>
                            <p>Cell. +39 331 774 0868</p>
                            <p>Email. hajjy.foods@gmail.com</p>
                        </div>' ;
            $html .= '</div>';
            $addresslength = (mb_strlen($invoice->Address) > 35) ? "font-size: 12px" : "";
            $html .= '
        <div class="client__info">
            <div class="div_1">
                <div class="info__name">
                    <p>N.cliente</p>
                    <p>Nr.cliente</p>
                    <p>Indirizzo</p>
                    <p>Nr.telefono</p>
                    <p>E-mail</p>
                </div>
                <div class="info__info">
                    <p>: '. $invoice->Name .'</p>
                    <p>: HF'.$invoice->ClientId.'</p>
                    <p style="'.$addresslength.'">: '.$invoice->Address.'</p>
                    <p>: '.$invoice->PhoneNumber.'</p>
                    <p>: '.$invoice->Email.'</p>
                </div>
            </div>
            
            <div class="div_2">
                <div class="info__name">
                    <p>P.IVA</p>
                    <p>Codice fisc</p>
                    <p>sconto</p>
                    <p>Inv.Date</p>
                    <p>Nr.Invoice </p>
                </div>
                <div class="info__info">
                    <p>: '.$invoice->PartitaIVA.'</p>
                    <p>: '.$invoice->CodFISC.'</p>
                    <p>: '.$invoice->Discount.' %</p>
                    <p>: '.(new DateTime($invoice->Created))->format('F j, Y').'</p>
                    <p>: NO.'. (new DateTime($invoice->Created))->format('ym') . '-' . $invoice->InvoiceId .'</p>
                </div>
            </div>
        </div>';

        $html .= "
                <div class='product__list'>
                    <span>elenco prodotti</span>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descrizione</th>
                                <th>unità</th>
                                <th>Quantità</th>
                                <th>Pezzi/Box</th>
                                <th>Pezzi</th>
                                <th>Prezzo</th>
                                <th>Tot</th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
                        if (false !== $productDetails) {
                            $total = $i = 0;
                            foreach ($productDetails as $product) {
                                $total = (($product->Quantity *  $product->PiecesInBox) * $product->ProductPrice) + $total;
                                $html .= "<tr>";
                                     $html .= '<td style="text-align:center">' . ++$i                 . ' </td>' ;
                                     $html .= '<td style="text-align:left">' . $product->Name       . ' </td>' ;
                                     $html .= '<td style="text-align:center">' . $dictionary['text_unit_'. $product->Unit]        . ' </td>' ;
                                     $html .= '<td style="text-align:center">' . $product->Quantity   . ' </td>' ;
                                     $html .= '<td style="text-align:center">' . $product->PiecesInBox  . ' </td>' ;
                                     $html .= '<td style="text-align:center">' . $product->Quantity *  $product->PiecesInBox . ' </td>' ;
                                     $html .= '<td style="text-align:center">' . $product->ProductPrice . ' €</td>' ;
                                     $html .= '<td style="text-align:right">' . number_format((float) (($product->Quantity *  $product->PiecesInBox) * $product->ProductPrice), 2, '.', '') . ' €</td>' ;
                                $html .= "</tr>";
                                    
                            }
                        }
                        else {
                            $html .= '<tr><td colspan="6" class="alert alert-success text-center mb-2 mt-2">
                                    Non ci sono prodotti
                                </td></tr>';
                        }

        $html .="</tbody>
                    </table>
                    <div class='bill-total'>
                        <p>TOT. DOC €</p>
                        <span style='padding: 5px 30px;color: #fff;letter-spacing: 1.5px;font-weight:bold;margin-left:15px'>". number_format((float) (isset($total) ? $total : 0), 2, '.', '') ."</span>
</div>
</div>
";
$html .= '</div>';

$html .= '</body>

</html>' ;

$dompdf = new Dompdf();
$dompdf->getOptions()->set('chroot', '/' );
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->addInfo('Title', 'Invoice for '. $invoice->Name);
$dompdf->addInfo('Author', 'SEVENAJJY (HAJJYFOODS)');
$dompdf->addInfo('Subject', 'Sales bill');
$dompdf->addInfo('Keywords', 'sales-purchases-invoice-bill-HJYFOODS');
$dompdf->addInfo('Application', 'hajjyfoods.com');
// Output the generated PDF to Browser
$dompdf->stream($invoice->Name . " NO." . (new DateTime($invoice->Created))->format('ymd') . '-' . $invoice->InvoiceId . '.pdf', ['Attachment' => 0 ]);
}
}
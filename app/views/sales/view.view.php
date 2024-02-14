<div class="home-content">

    <div class="invoice-view">
        <div class="d-flex justify-content-center pb-4 pt-4">
            <span class="headder"><?= $text_header; ?></span>
        </div>
        <div class="self_info">
            <div class="login-logo">
                <img src="/img/hajjyfoodsgrande.png" alt="hajjy food logo">
            </div>
            <strong>HAJJY FOODS</strong> di Elhajjy Rahal
            <p class="self_address">Via DE NICOLA 8/10 95131 Catania, Italy</p>
            <p class="self_cod">Cod. Fisc.:LHJRHL68T15Z330I</p>
            <p class="self_iva">P. iva 03588290837</p>
        </div>

        <?php //var_dump($invoice);?>

        <div class="purchase-invoice" style="direction:<?= ($this->session->lang == 'ar')? 'rtl' : 'ltr'; ?>">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div><?= $text_table_ref ?></div>
                    <div><?= $text_name ?></div>
                    <div><?= $text_payment_type ?></div>
                    <div><?= $text_created ?></div>
                </div>
                <div class="col-md-3 col-sm-6 line">
                    <div>: <span class="ms-3">
                            NO.<?= (new DateTime($invoice->Created))->format('ym') . '-' . $invoice->InvoiceId ?></span>
                    </div>
                    <div>: <span class="ms-3"><?= $invoice->Name ?></div>
                    <div>: <span class="ms-3"><?= ${'text_payment_type_'.$invoice->PaymentType} ?></div>
                    <div>: <span class="ms-3"><?= (new DateTime($invoice->Created))->format('Y/m/d') ?></div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div><?= $text_payment_status ?></div>
                    <div><?= $text_discount_percentage ?></div>
                    <div><?= 'P. IVA' ?></div>
                    <div><?= 'Codice fiscale' ?></div>
                </div>
                <div class=" col-md-3 col-sm-6">
                    <div>: <span class="ms-3">
                            <?= ${'text_payment_status_' . $invoice->PaymentStatus} ?>
                    </div>
                    <div>: <span class="ms-3"><?= $invoice->Discount ?>%</div>
                    <div>: <span class="ms-3"><?= $invoice->PartitaIVA ?></div>
                    <div>: <span class="ms-3"><?= $invoice->CodFISC ?></div>
                </div>
            </div>
        </div>

        <table class="table table-sm table-responsive-md caption-top bill-table"
            style="color:var(--text-color);direction:<?= ($this->session->lang == 'ar')? 'rtl' : 'ltr'; ?>">
            <caption><?= $text_product_list ?></caption>
            <thead style="background-color: var(--body-color);">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= $text_product_name ?></th>
                    <th scope="col"><?= $text_unit ?></th>
                    <th scope="col"><?= $text_Quantity ?></th>
                    <th scope="col"><?= $text_piecesBox ?></th>
                    <th scope="col"><?= $text_pieces ?></th>
                    <th scope="col"><?= $text_price ?></th>
                    <th scope="col" style="text-align:right"><?= $text_tot ?></th>
                </tr>
            </thead>
            <tbody class="product-list">
                <?php 
                if (false !== $productDetails) {
                    $i = 0;
                    $total = 0;
                    foreach ($productDetails as $product) {
                        $total = (($product->Quantity *  $product->PiecesInBox) * $product->ProductPrice) + $total;
                        echo '<tr>' ;
                            echo '<td style="text-align:center">' . ++$i                 . ' </td>' ;
                            echo '<td>' . $product->Name       . ' </td>' ;
                            echo '<td style="text-align:center">' . ${'text_unit_'. $product->Unit}       . ' </td>' ;
                            echo '<td style="text-align:center">' . $product->Quantity   . ' </td>' ;
                            echo '<td style="text-align:center">' . $product->PiecesInBox  . ' </td>' ;
                            echo '<td style="text-align:center">' . $product->Quantity *  $product->PiecesInBox . ' </td>' ;
                            echo '<td style="text-align:center">' . $product->ProductPrice . ' €</td>' ;
                            echo '<td style="text-align:right">' . number_format((float) (($product->Quantity *  $product->PiecesInBox) * $product->ProductPrice), 2, '.', '') . ' €</td>' ;?>
                <?php
                        echo '</tr>' ;
                    }
                }
                else {
                        echo '<tr><td colspan="6" class="alert alert-success text-center mb-2 mt-2">
                                    <i class="fas fa-exclamation-triangle me-3 "></i> '.$text_no_data.
                            '</td></tr>';
                }
        ?>
            </tbody>
        </table>
        <div class="bill-total">
            <p><?= $text_total_end ?></p>
            <span><?= number_format((float) ($total), 2, '.', '') ?></span>
        </div>

    </div>

</div>
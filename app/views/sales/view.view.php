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
                <div class="col-md-3 col-sm-6">
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
            <span><?= number_format((float) (isset($total) ? $total : 0), 2, '.', '') ?></span>
        </div>

        <div class="download__bill">
            <a href="/sales/downloadbill/<?= $invoice->InvoiceId ?>" class="bookmarkBtn">
                <span class="IconContainer">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M128 0c-17.6 0-32 14.4-32 32v448c0 17.6 14.4 32 32 32h320c17.6 0 32-14.4 32-32V128L352 0H128z"
                            fill="#e2e5e7" />
                        <path d="M384 128h96L352 0v96c0 17.6 14.4 32 32 32z" fill="#b0b7bd" />
                        <path fill="#cad1d8" d="M480 224l-96-96h96z" />
                        <path
                            d="M416 416c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V256c0-8.8 7.2-16 16-16h352c8.8 0 16 7.2 16 16v160z"
                            fill="red" />
                        <path
                            d="M101.744 303.152c0-4.224 3.328-8.832 8.688-8.832h29.552c16.64 0 31.616 11.136 31.616 32.48 0 20.224-14.976 31.488-31.616 31.488h-21.36v16.896c0 5.632-3.584 8.816-8.192 8.816-4.224 0-8.688-3.184-8.688-8.816v-72.032zm16.88 7.28v31.872h21.36c8.576 0 15.36-7.568 15.36-15.504 0-8.944-6.784-16.368-15.36-16.368h-21.36zM196.656 384c-4.224 0-8.832-2.304-8.832-7.92v-72.672c0-4.592 4.608-7.936 8.832-7.936h29.296c58.464 0 57.184 88.528 1.152 88.528h-30.448zm8.064-72.912V368.4h21.232c34.544 0 36.08-57.312 0-57.312H204.72zm99.152 1.024v20.336h32.624c4.608 0 9.216 4.608 9.216 9.072 0 4.224-4.608 7.68-9.216 7.68h-32.624v26.864c0 4.48-3.184 7.92-7.664 7.92-5.632 0-9.072-3.44-9.072-7.92v-72.672c0-4.592 3.456-7.936 9.072-7.936h44.912c5.632 0 8.96 3.344 8.96 7.936 0 4.096-3.328 8.704-8.96 8.704h-37.248v.016z"
                            fill="#fff" />
                        <path d="M400 432H96v16h304c8.8 0 16-7.2 16-16v-16c0 8.8-7.2 16-16 16z" fill="#cad1d8" />
                    </svg>
                </span>
                <p class="btn_text">Download</p>
            </a>
        </div>



    </div>

</div>
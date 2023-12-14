<div class="home-content" style="direction:<?= ($_SESSION['lang'] == 'ar')? 'rtl' : 'ltr'; ?>">

    <div class="invoice-view">
        <div class="d-flex justify-content-center pb-4 pt-4">
            <span class="headder"><?= $text_header; ?></span>
        </div>
        <div class="self_info">
            <strong>HAJJY FOODS</strong> di Elhajjy Rahal
            <p class="self_address">Via Luigi Manfredi, 27/29/31 90127 Catania, Italy</p>
            <p class="self_cod">Cod. Fisc.:LHARHL80P13 Z249V</p>
            <p class="self_iva">P. iva 06712600821</p>
        </div>

        <?php var_dump($invoice); ?>

        <div class="purchase-invoice">
            <div class="row">
                <div class="col-md-3">
                    <div><?= $text_table_ref ?></div>
                    <div><?= $text_name ?></div>
                    <div><?= $text_payment_type ?></div>
                    <div><?= $text_created ?></div>
                </div>
                <div class="col-md-3 line">
                    <div>: <span class="ms-3">
                            NO.<?= (new DateTime($invoice->Created))->format('ym') . '-' . $invoice->InvoiceId ?></span>
                    </div>
                    <div>: <span class="ms-3"><?= $invoice->Name ?></div>
                    <div>: <span class="ms-3"><?= ${'text_payment_type_'.$invoice->PaymentType} ?></div>
                    <div>: <span class="ms-3"><?= (new DateTime($invoice->Created))->format('Y/m/d') ?></div>
                </div>
                <div class="col-md-3">
                    <div><?= $text_payment_status ?></div>
                    <div><?= $text_discount_percentage ?></div>
                </div>
                <div class=" col-md-3">
                    <div>: <span class="ms-3">
                            <?= ${'text_payment_status_' . $invoice->PaymentStatus} ?>
                    </div>
                    <div>: <span class="ms-3"><?= $invoice->Discount ?>%</div>
                </div>
            </div>
        </div>


    </div>

</div>
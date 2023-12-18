<div class="home-content" style="direction:<?= ($_SESSION['lang'] == 'ar')? 'rtl' : 'ltr'; ?>">
    
    <div class="invoice-view">
        <div class="d-flex justify-content-center pb-4 pt-4">
            <span class="headder"><?= $text_header; ?></span>
        </div>

        <?php var_dump($invoice); ?>

        <div class="purchase-invoice">
            <div class="row">
                <div class="col-md-1">
                    <div><?= $text_table_ref ?></div>
                    <div><?= $text_name_label ?></div>
                    <div><?= $text_payment_type_label ?></div>
                    <div><?= $text_created ?></div>
                </div>
                <div class="col-md-9">
                    <div>: <span class="ms-3"> NO.<?= (new DateTime($invoice->Created))->format('ym') . '-' . $invoice->InvoiceId ?></span></div>
                    <div>: <span class="ms-3"><?= $invoice->Name ?></div>
                    <div>: <span class="ms-3"><?= ${'text_payment_type_'.$invoice->PaymentType} ?></div>
                    <div>: <span class="ms-3"><?= (new DateTime($invoice->Created))->format('Y/m/d') ?></div>
                </div>
            </div>
        </div>
    </div>
    
</div>
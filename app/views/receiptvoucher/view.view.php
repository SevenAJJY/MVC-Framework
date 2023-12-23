<div class="home-content" style="direction:<?= ($_SESSION['lang'] == 'ar')? 'rtl' : 'ltr'; ?>">
    
    <div class="invoice-view">
        <div class="d-flex justify-content-center pb-4 pt-4">
            <span class="headder"><?= $text_header; ?></span>
        </div>

        <div class="purchase-invoice">
            <ul>
                <li><span><?= $text_table_ref ?>:</span></li>
                <li><?= $text_name_label ?></li>:
                <li><?= $text_created ?></li>:
            </ul>


        </div>
    </div>
    
</div>
<div class="home-content" style="direction:<?= ($_SESSION['lang'] == 'ar')? 'rtl' : 'ltr'; ?>">
    <div class="">
            <h1 class="main-title text-center"><?php echo $text_header ;?></h1>

    <form action="" class="appform" method="post" autocomplete="off" enctype="application/x-www-form-urlencoded">
        <div class="d-flex justify-content-center invoice-title">
            <span><?= $text_tilte_1 ?></span>
        </div>
        <div class="my-container _invoivce">
            <div class="row app-form">
                <!-- <h4><?php echo $text_legend ?></h4> -->
                <div class="row">
                        <div class="col-md-4">
                            <div class="input-box">
                                <select class="form-select select-box" name="ClientId" required >
                                    <option value="" selected><?= $text_table_client ?></option>
                                    <?php if (false !== $clients): ?>
                                        <?php foreach ($clients as $client):?>
                                            <option value="<?= $client->ClientId ?>" <?= $this->seletedIf('ClientId' ,  $client->ClientId, $client);  ?> ><?=  $client->Name ?></option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 inv-label">
                                    <h6 class="invoice-labels"><?= $text_payment_type_label ?></h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch discount">
                                        <input required type="radio" class="form-check-input" name="PaymentType" <?= $this->boxCheckedIf('PaymentType', 1, $invoice) ?> value="<?= $this->showValue('PaymentType', null, 1) ?>">
                                        <label class="label"> <?= $text_payment_type_1 ?></label>
                                    </div>
                                    <div class="form-check form-switch discount">
                                        <input required type="radio" class="form-check-input" name="PaymentType" <?= $this->boxCheckedIf('PaymentType', 2, $invoice) ?> value="<?= $this->showValue('PaymentType', null, 2) ?>">
                                        <label class="label"> <?= $text_payment_type_2 ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-box">
                                <select class="form-select select-box " name="PaymentStatus" required>
                                    <option value="" selected><?= $text_payment_status_label ?></option>
                                    <option value="1" <?= $this->seletedIf('PaymentStatus' ,  1, $invoice);?> > <?= $text_payment_status_1 ?></option>
                                    <option value="2" <?= $this->seletedIf('PaymentStatus' ,  2, $invoice);?> > <?= $text_payment_status_2 ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center invoice-title">
            <span><?= $text_tilte_2 ?></span>
        </div>
        <div class="my-container _invoivce">
            <div class="row app-form">
                <!-- <h4><?php echo $text_legend ?></h4> -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-box">
                            <select class="form-select select-box " name="Discount" required>
                                <option value="" selected><?= $text_discount_percentage ?></option>
                                <?php for($i = 1 ; $i < 100 ; $i++):?>
                                    <option value="<?= $i ?>" <?= $this->seletedIf('Discount', $i, $invoice)?> ><?= $i ?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-box">
                                <select name="products" class="form-select select-box " id="products">
                                    <option value=""><?= $text_select ?></option>
                                    <?php if (false !== $products): foreach ($products as $product): ?>
                                        <option data-price="<?= $product->SellPrice ?>" <?= $this->seletedIf('products' ,  $product->ProductId);  ?> value="<?= $product->ProductId ?>"><?= $product->Name ?></option>
                                    <?php endforeach;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 add-prodcuts d-flex align-items-center"> 
                            <a class="addProduct"  href="javascript:void(0);"><i class="fa fa-plus"></i> <?= $text_add_product ?></a>
                        </div>
                    </div>
                </div>
            </div>

        <div class="d-flex justify-content-center invoice-title">
            <span><?= $text_tilte_3 ?></span>
        </div>
        <div class="my-container _invoivce">
            <div class="row">
                <!-- <h4><?php echo $text_legend ?></h4> -->
                <div class="table-responsive tables">
                    <div class="products_list">
                        <table class="table__content" style="margin: 0;">
                            <thead>
                                <tr>
                                    <td><?= $text_product_name ?></td>
                                    <td><?= $text_product_quantity ?></td>
                                    <td><?= $text_product_price ?></td>
                                    <td><?= $text_delete ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if( false !== $details): foreach($details as $detail): ?>
                                    <tr>
                                        <td>
                                            <p><?= $detail->Name ?></p>
                                        </td>
                                        <td>
                                            <input name="productq[]" class="input-products" type="number" required min="1" value="<?= $detail->Quantity ?>">
                                        </td>
                                        <td>
                                            <input name="productp[]" class="input-products" type="number" required min="<?= $detail->ProductPrice ?>" value="<?= $detail->ProductPrice ?>">
                                            <input name="productv[]" class="input-products" type="hidden" value="<?= $detail->ProductId ?>"> 
                                        </td>
                                        <td>
                                            <a onclick="removeProduct(this);" href="javascript:void(0);"> <i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-container _invoivce mt-4 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-4 ">
                    <div class="input-box">
                        <input type="submit" class="purchaseBtn" name="submit" value="<?= $text_label_save ?>" maxlength="30" required/>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
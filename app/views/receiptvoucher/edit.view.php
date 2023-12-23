<div class="home-content"
    onload="validateReceipt('PaymentType','BankName','BankAccountNumber', 'CheckNumber', 'TransferedTo')">
    <div class="row">
        <h1 class="main-head"><?= $text_header ;?></h1>
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?= $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="input-box">
                        <select class="form-select select-box" id="PaymentType" name="PaymentType" required
                            onchange="validateReceipt(this.id,'BankName','BankAccountNumber', 'CheckNumber', 'TransferedTo')">
                            <option value="" selected><?= $text_table_payment_type ?></option>
                            <option value="1" <?= $this->seletedIf('PaymentType' , 1, $voucher); ?>>
                                <?= $text_payment_type_1 ?></option>
                            <option value="2" <?= $this->seletedIf('PaymentType' , 2, $voucher); ?>>
                                <?= $text_payment_type_2 ?></option>
                            <option value="3" <?= $this->seletedIf('PaymentType' , 3, $voucher); ?>>
                                <?= $text_payment_type_3 ?></option>
                        </select>
                    </div>
                    <div class="input-box">
                        <input type="number" spellcheck="false" name="PaymentAmount" step="1" min="1"
                            value="<?= $this->showValue('PaymentAmount', $voucher) ?>" required />
                        <label for=""><?= $text_table_payment ?></label>
                    </div>
                    <div class="input-box">
                        <input type="text" spellcheck="false" name="PaymentLiteral"
                            value="<?= $this->showValue('PaymentLiteral', $voucher) ?>" required />
                        <label><?= $text_table_payment_literal ?></label>
                    </div>
                    <div class="input-box" id="BankName">
                        <input type="text" spellcheck="false" name="BankName" id="bankname" maxlength="30"
                            value="<?= $this->showValue('BankName', $voucher) ?>" />
                        <label><?= $text_table_bank_name ?></label>
                    </div>
                    <div class="input-box" id="BankAccountNumber">
                        <input type="text" spellcheck="false" name="BankAccountNumber" id="bankaccountnumber"
                            maxlength="30" value="<?= $this->showValue('BankAccountNumber', $voucher) ?>" />
                        <label><?= $text_table_bank_account_name ?></label>
                    </div>
                    <div class="input-box" id="CheckNumber">
                        <input type="text" spellcheck="false" name="CheckNumber" maxlength="30" id="checknumber"
                            value="<?= $this->showValue('CheckNumber', $voucher) ?>" />
                        <label><?= $text_table_check_number ?></label>
                    </div>
                    <div class="input-box" id="TransferedTo">
                        <input type="text" spellcheck="false" name="TransferedTo" maxlength="30" id="transferedto"
                            value="<?= $this->showValue('TransferedTo', $voucher) ?>" />
                        <label><?= $text_table_transfered_to ?></label>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="mt-3 mb-5" name="submit" value="<?= $text_label_save ?>"
                            maxlength="30" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
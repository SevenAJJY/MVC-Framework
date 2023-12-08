<div class="home-content">
    <div class="row">
        <h1 class="main-head"><?= $text_header ;?></h1>
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?= $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="input-box">
                        <input type="text" spellcheck="false" name="ExpenseName" maxlength="30"
                            value="<?= $this->showValueV2('ExpenseName',$expensescategories) ?>" required>
                        <label for=""><?= $text_ExpenseName ?></label>
                    </div>
                    <div class="input-box">
                        <input type="number" spellcheck="false" name="FixedPayment" min="1" step="0.01"
                            value="<?= $this->showValueV2('FixedPayment',$expensescategories) ?>" required />
                        <label><?= $text_FixedPayment ?></label>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="mt-3" name="submit" value="<?= $text_label_save ?>" maxlength="30"
                            required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
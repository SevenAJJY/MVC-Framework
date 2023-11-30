<div class="home-content">
    <div class="row">
        <h1 class="main-head"><?= $text_header ;?></h1>

        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?= $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off"
                    enctype="application/x-www-form-urlencoded">
                    <div class="input-box">
                        <input type="text" spellcheck="false" class="Name" name="Name" id="Name" maxlength="50"
                            value="<?= $this->showValueV2('Name') ?>" required>
                        <label for="Name"><?= $text_label_Name ?></label>
                    </div>
                    <div class="input-box">
                        <input type="email" spellcheck="false" name="Email" id="Email" maxlength="40"
                            value="<?= $this->showValueV2('Email') ?>" required>
                        <label for="Email"><?= $text_label_Email ?></label>
                    </div>
                    <div class="input-box">
                        <input type="text" spellcheck="false" id="Number" name="PhoneNumber" maxlength="15"
                            value="<?= $this->showValueV2('PhoneNumber') ?>" required>
                        <label for="Number"><?= $text_label_PhoneNumber ?></label>
                    </div>
                    <div class="input-box">
                        <input type="text" id="Address" name="Address" class="input" spellcheck="false" maxlength="100"
                            value="<?= $this->showValueV2('Address') ?>" required />
                        <label for="Address"><?= $text_label_Address ?></label>
                        <i class="fa-regular fa-eye-slash togglePass"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" id="PartitaIVA" name="PartitaIVA" class="input" spellcheck="false"
                            maxlength="15" value="<?= $this->showValueV2('PartitaIVA') ?>" required />
                        <label for="Address"><?= $text_label_PartitaIVA ?></label>
                    </div>
                    <div class="input-box">
                        <input type="text" id="CodFISC" name="CodFISC" class="input" spellcheck="false" maxlength="20"
                            value="<?= $this->showValueV2('CodFISC') ?>" required />
                        <label for="Address"><?= $text_label_CodFISC ?></label>
                    </div>
                    <div class="input-box">
                        <input type="submit" name="submit" value="<?= $text_label_save ?>" maxlength="30" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
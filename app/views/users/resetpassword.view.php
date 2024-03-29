<div class="home-content">
    <div class="row">
        <h1 class="main-title text-center"><?= $text_header ;?></h1>

        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?= $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off"
                    enctype="application/x-www-form-urlencoded">
                    <div class="input-box">
                        <input type="password" id="password" name="Password" class="input" spellcheck="false"
                            value="<?php echo $this->showValueV2('Password') ?>" required />
                        <label for="password"><?= $text_ucpwd_label ?></label>
                        <i class="fa-regular fa-eye-slash togglePass"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" id="password" name="CPassword" class="input2" spellcheck="false"
                            value="<?= $this->showValueV2('Password') ?>" required />
                        <label for="password"><?= $text_ucpwdc_label ?></label>
                        <i class="fa-regular fa-eye-slash togglePass2"></i>
                    </div>

                    <div class="input-box">
                        <input type="submit" name="submit" value="<?= $text_label_save ?>" maxlength="30" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
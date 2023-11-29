<div class="home-content">
    <div class="row">
        <h1 class="main-title text-center"><?= $text_header ;?></h1>

        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?= $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off"
                    enctype="application/x-www-form-urlencoded">
                    <div class="input-box">
                        <input type="text" spellcheck="false" id="Number" name="PhoneNumber"
                            value="<?= $this->showValueV2('PhoneNumber',$user) ?>" required>
                        <label for="Number"><?= $text_label_PhoneNumber ?></label>
                    </div>
                    <div class="input-box">
                        <select class="form-select select-box" name="GroupId" aria-label="Default select example">
                            <option value="" selected><?= $text_user_GroupId?></option>
                            <?php if (false !== $groups): ?>
                            <?php foreach ($groups as $group):?>
                            <option value="<?= $group->GroupId ?>"
                                <?= $this->selectedIf('GroupId' , $group->GroupId , $user);  ?>><?= $group->GroupName ?>
                            </option>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>

                    <div class="input-box">
                        <input type="submit" name="submit" value="<?= $text_label_save ?>" maxlength="30" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
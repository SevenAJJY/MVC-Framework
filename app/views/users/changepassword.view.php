<div class="home-content ">
    <div class="row">
        <h1 class="main-head"><?= $text_header ;?></h1>

        <div class="row p-3 g-3">
            <div class="col-md-3">
                <div class="u__panel">
                    <div class="u_profile__details">
                        <div class="imageBox">
                            <form action="" id="formId" method="post" autocomplete="off" enctype="multipart/form-data">
                                <input type="file" name="image" class="my__file" id="">
                            </form>
                            <?php
                                $imageProfile = !empty($profile->Image) ? $profile->Image : 'noImage.jpg';
                            ?>
                            <img src="/uploads/images/<?= $imageProfile ?>" alt="photo de profile">
                        </div>
                        <h4><?= $profile->FirstName. ' ' . $profile->LastName ?></h4>
                        <span class="mb-3"><?= $this->session->u->Email ?></span>
                        <input type="submit" form="formId" name="saveImage" class="btn btn-sm btn-primary"
                            style="background-color: rgba(255, 255, 255, 0.3);" value="Change photo" />
                    </div>
                    <ul class="u_menu">
                        <li class="<?= ($this->matchUrl('/users/view')) ? 'u_active' : ''; ?>"> <a href="/users/view"><i
                                    class="fa-solid fa-id-badge"></i><span><?= $text_profile ?></span></a></li>
                        <li class="<?= ($this->matchUrl('/users')) ? 'u_active' : ''; ?>"> <a href="/users"><i
                                    class="fa-solid fa-calendar-days"></i><span><?= $text_recent_activity ?></span></a>
                        </li>
                        <li class="<?= ($this->matchUrl('/users/editprofile')) ? 'u_active' : ''; ?>"> <a
                                href="/users/editprofile"><i
                                    class="fa-solid fa-pen-to-square"></i><span><?= $text_edit_profile ?></span></a>
                        </li>
                        <li class="<?= ($this->matchUrl('/users/changepassword')) ? 'u_active' : ''; ?>"> <a
                                href="/users/changepasssword"><i
                                    class="fa-solid fa-key"></i><span><?= $text_change_password ?></span></a></li>
                        <li class="<?= ($this->matchUrl('/users/settings')) ? 'u_active' : ''; ?>"> <a
                                href="/users/settings"><i
                                    class="fa-solid fa-gears"></i><span><?= $text_other_settings ?></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <div class="my-container editprofile">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <form action="" class="appform row" method="post" autocomplete="off"
                                    enctype="multipart/form-data" enctype="application/x-www-form-urlencoded">
                                    <h4><?= $text_legend ?></h4>
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <div class="input-box">
                                            <input type="text" spellcheck="false" class="FirstName" name="OPassword"
                                                id="oPassword" maxlength="10"
                                                value="<?= $this->showValueV2('FirstName') ?>" required>
                                            <label for="oPassword"><?= $text_old_password ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <div class="input-box">
                                            <input type="password" spellcheck="false" name="NPassword" id="NPassword"
                                                maxlength="10" value="<?= $this->showValueV2('LastName') ?>" required>
                                            <label for="NPassword"><?= $text_new_password ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <div class="input-box">
                                            <input type="password" spellcheck="false" id="CNPassword" name="CNPassword"
                                                value="<?= $this->showValueV2('PhoneNumber') ?>" required>
                                            <label for="CNPassword"><?= $text_confirm_new_password ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <div class="input-box">
                                            <input type="submit" name="submit" value="<?= $text_label_save ?>"
                                                maxlength="30" required>
                                        </div>
                                    </div>


                                </form>
                            </div>
                            <div class="col-md-6 col-lg-6 box-disable">
                                <div class="edit-image">
                                    <img src="/img/passw.gif" alt="">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="home-content ">
    <div class="row">
        <h1 class="main-head"><?= $text_header ;?></h1>

        <div class="row p-3 g-3">
            <div class="col-md-3">
                <div class="u__panel">
                    <div class="u_profile__details">
                        <div class="imageBox">
                            <form action="" id="formId" method="post" autocomplete="off" enctype="multipart/form-data">
                                <input type="file" name="Image" class="my__file" id="">
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
                        <li class="<?= ($this->matchUrl('/users/view')) === true ? 'u_active' : ''; ?>"> <a
                                href="/users/view"><i
                                    class="fa-solid fa-id-badge"></i><span><?= $text_profile ?></span></a></li>
                        <li class="<?= ($this->matchUrl('/users')) === true ? 'u_active' : ''; ?>"> <a href="/users"><i
                                    class="fa-solid fa-calendar-days"></i><span><?= $text_recent_activity ?></span></a>
                        </li>
                        <li class="<?= ($this->matchUrl('/users/editprofile')) === true ? 'u_active' : ''; ?>"> <a
                                href="/users/editprofile"><i
                                    class="fa-solid fa-pen-to-square"></i><span><?= $text_edit_profile ?></span></a>
                        </li>
                        <li class="<?= ($this->matchUrl('/users/changepassword')) === true ? 'u_active' : ''; ?>"> <a
                                href="/users/changepassword"><i
                                    class="fa-solid fa-key"></i><span><?= $text_change_password ?></span></a></li>
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
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="input-box">
                                            <input type="text" spellcheck="false" class="FirstName" name="FirstName"
                                                id="FirstName" maxlength="10"
                                                value="<?= $this->showValueV2('FirstName', $profile) ?>" required>
                                            <label for="FirstName"><?= $text_firstname ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="input-box">
                                            <input type="text" spellcheck="false" name="LastName" id="LastName"
                                                maxlength="10" value="<?= $this->showValueV2('LastName' , $profile) ?>"
                                                required>
                                            <label for="LastName"><?= $text_lastname ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="input-box">
                                            <input type="text" spellcheck="false" id="Number" name="PhoneNumber"
                                                value="<?= $this->showValueV2('PhoneNumber', $user) ?>" required>
                                            <label for="Number"><?= $text_label_PhoneNumber ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="input-box">
                                            <input type="text" spellcheck="false" id="address" name="Address"
                                                value="<?= $this->showValueV2('Address', $profile) ?>" required>
                                            <label for="address"><?= $text_address_label ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="input-box">
                                            <input type="date" spellcheck="false" id="Dob" name="DOB"
                                                value="<?= $this->showValueV2('DOB', $profile) ?>" required>
                                            <label for="dob"><?= $text_dob_label ?></label>
                                        </div>
                                    </div>
                                    <div class="input-box">
                                        <input type="submit" name="submit" value="<?= $text_label_save ?>"
                                            maxlength="30" required>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 col-lg-6 box-disable">
                                <div class="edit-image">
                                    <img src="/img/ed.gif" alt="">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
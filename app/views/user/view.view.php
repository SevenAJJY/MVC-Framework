<div class="home-content " >
    <div class="row">
        <h1 class="main-title text-center"><?= $text_header ;?></h1>
        <?php 
            $this->highlightMenu('/users') ;
        ?>

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
                        <h4><?= $profile->FirstName . ' ' . $profile->LastName ?></h4>
                        <span class="mb-3"><?= $user->Email ?></span>
                        <input type="submit" form="formId" name="submit" class="btn btn-sm btn-primary" style="background-color: rgba(255, 255, 255, 0.3);" value="Change photo"/>
                    </div>
                    <ul class="u_menu">
                        <li class="<?= ($this->matchUrl('/users/view')) === true ? 'u_active' : ''; ?>" > <a href="/users/view"><i class="fa-solid fa-id-badge"></i><span><?= $text_profile ?></span></a></li>
                        <li class="<?= ($this->matchUrl('/users')) === true ? 'u_active' : ''; ?>" > <a href="/users"><i class="fa-solid fa-calendar-days"></i><span><?= $text_recent_activity ?></span></a></li>
                        <li class="<?= ($this->matchUrl('/users/editprofile')) === true ? 'u_active' : ''; ?>" > <a href="/users/editprofile"><i class="fa-solid fa-pen-to-square"></i><span><?= $text_edit_profile ?></span></a></li>
                        <li class="<?= ($this->matchUrl('/users/changepassword')) === true ? 'u_active' : ''; ?>" > <a href="/users/changepassword"><i class="fa-solid fa-key"></i><span><?= $text_change_password ?></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="u__panel">
                    <div class="u_img">
                        <img src="/img/cover.avif" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <h5><?= $text_header ?></h5>
                    </div>
                    <div class="row" style="direction:<?= ($_SESSION['lang'] == 'ar')? 'rtl' : 'ltr'; ?>">
                        <div class="col-md-12 col-lg-6 u__info">
                            <ul>
                                <li>
                                    <span><?= $text_firstname ?></span>:
                                    <?= $profile->FirstName ?>
                                </li>
                                <li>
                                    <span><?= $text_address ?></span>:
                                    <?= $profile->Address ?>
                                </li>
                                <li>
                                    <span><?= $text_group ?></span>:
                                    <?= $this->session->u->GroupName ?>
                                </li>
                                <li>
                                    <span><?= $text_phone ?></span>:
                                    <?= $user->PhoneNumber ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12 col-lg-6 u__info">
                            <ul>
                                <li>
                                    <span><?= $text_lastname ?></span>:
                                    <?= $profile->LastName ?>
                                </li>
                                <li>
                                    <span><?= $text_dob ?></span>:
                                    <?= $profile->DOB ?>
                                </li>
                                <li>
                                    <span><?= $text_email ?></span>:
                                    <?= $user->Email ?>
                                </li>
                                <li>
                                    <span><?= $text_subscription_date ?></span>:
                                    <?= $user->SubscriptionDate ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offset-md-3 col-md-9">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="boxes">
                            <div class="icon-box ">
                                <i class="fa-regular fa-rectangle-list ibox1"></i>
                            </div>
                            <div class="statistics-box">
                                <span>Total Privileges</span>
                                <h5><?= count($this->session->u->privileges) ?></h5>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
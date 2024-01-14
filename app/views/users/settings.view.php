<div class="home-content ">
    <div class="row">
        <h1 class="main-head"><?= $text_header ;?></h1>
        <?php 
            $this->highlightMenu('/users');
        ?>

        <div class="row p-3 g-3">
            <div class="col-md-3">
                <div class="u__panel">
                    <div class="u_profile__details">
                        <div class="imageBox">
                            <form action="" id="formId" method="post" autocomplete="off" enctype="multipart/form-data">
                                <input type="file" accept="image/*" name="image" class="my__file" id="">
                            </form>
                            <?php
                            $imageProfile = !empty($profile->Image) ? $profile->Image : 'noImage.jpg';
                            ?>
                            <img src="/uploads/images/<?= $imageProfile ?>" alt="photo de profile">
                        </div>
                        <h4><?= $profile->FirstName . ' ' . $profile->LastName ?></h4>
                        <span class="mb-3"><?= $user->Email ?></span>
                        <input type="submit" form="formId" name="submit" class="btn btn-sm btn-primary"
                            style="background-color: rgba(255, 255, 255, 0.3);" value="<?= $text_change_photo ?>" />
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
                        <li class="<?= ($this->matchUrl('/users/settings')) ? 'u_active' : ''; ?>"> <a
                                href="/users/settings"><i
                                    class="fa-solid fa-gears"></i><span><?= "Other settings" ?></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <div class="my-container editprofile">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
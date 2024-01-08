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
                        <div class="style-switcher js-style-switcher">
                            <button class="style-switcher-toggler js-style-switcher-toggler">
                                <svg stroke="currentColor" fill="none" stroke-width="1.5" viewBox="0 0 24 24"
                                    aria-hidden="true" class="style__switcher-toggler-icon" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </button>
                            <div class="style-switcher-main">
                                <h2>Style Switcher</h2>
                                <div class="style-switcher-item">
                                    <p>Theme Color</p>
                                    <div class="theme-color">
                                        <input type="range" min="0" max="360" class="hue-slider js-hue-slider" />
                                        <div class="hue">
                                            <span class="js-hue"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="style-switcher-item">
                                    <label class="form-switch">
                                        <span>Dark Mode</span>
                                        <input type="checkbox" class="js-dark-mode" />
                                        <div class="box"></div>
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
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
                            $imageProfile = !empty($profile->Image) && file_exists(IMAGES_UPLOAD_STORAGE. DS .$profile->Image) ? $profile->Image : 'noImage.jpg';
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
                                    class="fa-solid fa-gears"></i><span><?= $text_other_settings ?></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <div class="my-container editprofile">
                        <h4><?= $text_header ?></h4>
                        <span class="check_errors"></span>
                        <label for="displayStyleSwitcher" class="other__settings"
                            style="direction:<?= ($this->session->lang == 'ar')? 'rtl' : 'ltr'; ?>">
                            <span class="setting__text">
                                <p style="color: var(--main-color); font-weight: 700;margin-right: 15px;">―</p>
                                <?= $text_hide ?>
                                <code style="color:var(--main-color)">' <?= $text_style_switcher ?></code> <strong
                                    style="color:var(--main-color)"> '</strong>
                            </span>
                            <span class="setting__type">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" id="displayStyleSwitcher" type="checkbox"
                                        role="switch">
                                </div>
                            </span>
                        </label>
                        <div class="">
                            <span class="setting__text">
                                <div class="settings_top">
                                    <p style="color: var(--main-color); font-weight: 700;margin-right: 15px;">―</p>
                                    <?= "Choose" ?>
                                    <code style="color:var(--main-color)">' <?= " the statistics" ?></code>
                                    <strong style="color:var(--main-color)"> '</strong> that will appear in the
                                    dashboard
                                </div>
                                <ul class="settings_bottom">
                                    <li>
                                        <label for="users">
                                            <div class="form-check form-switch">
                                                <input data-stats="Users" class="form-check-input" id="users"
                                                    type="checkbox" role="switch" name="stats" checked>
                                            </div>
                                            Users
                                        </label>
                                    </li>
                                    <li>
                                        <label for="sales">
                                            <div class="form-check form-switch">
                                                <input data-stats="Sales" class="form-check-input" id="sales"
                                                    type="checkbox" role="switch" name="stats" checked>
                                            </div>
                                            Sales
                                        </label>
                                    </li>
                                    <li>
                                        <label for="purchases">
                                            <div class="form-check form-switch">
                                                <input data-stats="Purchases" class="form-check-input" id="purchases"
                                                    type="checkbox" role="switch" name="stats" checked>
                                            </div>
                                            Purchases
                                        </label>
                                    </li>
                                    <li>
                                        <label for="clients">
                                            <div class="form-check form-switch">
                                                <input data-stats="Clients" class="form-check-input" id="clients"
                                                    type="checkbox" role="switch" name="stats" checked>
                                            </div>
                                            Clients
                                        </label>
                                    </li>
                                    <li>
                                        <label for="suppliers">
                                            <div class="form-check form-switch">
                                                <input data-stats="Suppliers" class="form-check-input" id="suppliers"
                                                    type="checkbox" role="switch" name="stats">
                                            </div>
                                            Suppliers
                                        </label>
                                    </li>
                                    <li>
                                        <label for="products">
                                            <div class="form-check form-switch">
                                                <input data-stats="Products" class="form-check-input" id="products"
                                                    type="checkbox" role="switch" name="stats">
                                            </div>
                                            Products
                                        </label>
                                    </li>
                                    <li>
                                        <label for="productscategories">
                                            <div class="form-check form-switch">
                                                <input data-stats="Products Categories" class="form-check-input"
                                                    id="productscategories" type="checkbox" role="switch" name="stats">
                                            </div>
                                            Products Categories
                                        </label>
                                    </li>
                                    <li>
                                        <label for="dailyexpenses">
                                            <div class="form-check form-switch">
                                                <input data-stats="Daily Expenses" class="form-check-input"
                                                    id="dailyexpenses" type="checkbox" role="switch" name="stats">
                                            </div>
                                            Daily Expenses
                                        </label>
                                    </li>
                                </ul>
                            </span>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
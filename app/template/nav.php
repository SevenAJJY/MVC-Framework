<!-- Start Sidebar -->
<div class="sidebar close">
    <div class="logo-details">
        <!-- <i class="fa-brands fa-shopify logo"></i> -->
        <div class="logo">
            S7
        </div>
        <span class="logo_name"> SEVENAJJY </span>
    </div>
    <i class="fa-solid fa-angle-right bx-menu"></i>
    <ul class="nav-links">
        <li class="<?= $this->matchURL('/') ? "selected" : '' ?>">
            <a href="/">
                <i class="fa-solid fa-chart-column"></i>
                <span class="link_name"><?= $text_general_statistics ?></span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#"><?= $text_general_statistics ?></a></li>
            </ul>
        </li>
        <li class="<?= $this->matchURL('/') ? "selected" : '' ?>">
            <div class="iocn-link">
                <a href="javascript:;">
                    <i class="fa-solid fa-arrow-right-arrow-left"></i>
                    <span class="link_name"><?= $text_transactions ?></span>
                </a>
                <i class="fa-solid fa-angle-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="javascript:;"><?= $text_transactions ?></li>
                <li><a href="/purchases"><i
                            class="fa-solid fa-gift sub-icons"></i><?= $text_transactions_purchases ?></a></li>
                <li><a href="/sales"><i
                            class="fa-solid fa-bag-shopping sub-icons"></i><?= $text_transactions_sales ?></a></li>
            </ul>
        </li>
        <li class="<?= $this->matchURL('/') ? "selected" : '' ?>">
            <div class="iocn-link">
                <a href="javascript:;">
                    <i class="fa-solid fa-wallet "></i>
                    <span class="link_name"><?= $text_expences ?></span>
                </a>
                <i class="fa-solid fa-angle-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="/transactions" class="link_name"><?= $text_expences ?></a></li>
                <li><a href="/expensescategories"><i
                            class="fa-solid fa-tags sub-icons"></i><?= $text_expences_categories ?></a></li>
                <li><a href="/dailyexpenses"><i
                            class="fa-solid fa-circle-dollar-to-slot sub-icons"></i><?= $text_expences_daily_expences ?></a>
                </li>
            </ul>
        </li>
        <li class="<?= $this->matchURL('/') ? "selected" : '' ?>">
            <div class="iocn-link">
                <a href="javascript:;">
                    <i class="fa-solid fa-store "></i>
                    <span class="link_name"><?= $text_store ?></span>
                </a>
                <i class="fa-solid fa-angle-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#"><?= $text_store ?></a></li>
                <li><a href="/productcategories"><i
                            class="fa-solid fa-sitemap sub-icons"></i><?= $text_store_categories ?></a></li>
                <li><a href="/productlist"><i class="fa-solid fa-tags sub-icons"></i><?= $text_store_pruducts ?></a>
                </li>
            </ul>
        </li>
        <li class="<?= $this->matchURL('/clients') ? "selected" : '' ?>">
            <a href="/clients">
                <i class="fa-solid fa-user-tie "></i>
                <span class="link_name"><?= $text_clients ?></span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/clients"><?= $text_clients ?></a></li>
            </ul>
        </li>
        <li class="<?= $this->matchURL('/suppliers') ? "selected" : '' ?>">
            <a href="/suppliers">
                <i class="fa-solid fa-user-group"></i>
                <span class="link_name"><?= $text_suppliers ?></span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/suppliers"><?= $text_suppliers ?></a></li>
            </ul>
        </li>
        <li class="<?= $this->matchURL('/') ? "selected" : '' ?>">
            <div class="iocn-link">
                <a href="javascript:;">
                    <i class="fa-solid fa-users"></i>
                    <span class="link_name"><?= $text_users ?> </span>
                </a>
                <i class="fa-solid fa-angle-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li class=""><a class="link_name" href="#"><?= $text_users ?> </a></li>
                <li><a href="/users"><i class="fa-solid fa-circle-user sub-icons"></i><?= $text_users_list ?></a></li>
                <li><a href="/usersgroups"><i class="fa-solid fa-users-gear sub-icons"></i><?= $text_users_groups ?></a>
                </li>
                <li><a href="/privileges"><i class="fa-solid fa-key sub-icons"></i><?= $text_users_privileges ?></a>
                </li>
            </ul>
        </li>

        <li class="<?= $this->matchURL('/notifications') ? "selected" : '' ?>">
            <a href="/notifications">
                <i class="fa-regular fa-bell"></i>
                <span class="link_name"><?= $text_notifications ?> </span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/notifications"><?= $text_notifications ?> </a></li>
            </ul>
        </li>
        <li class="<?= $this->matchURL('/language') ? "selected" : '' ?>">
            <a href="/language">
                <i class="icon-language"></i>
                <span class="link_name"><?= $_SESSION['lang'] == 'ar' ? 'انجليزي' : 'Arabic' ?></span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/language"><?= $text_change_language ?></a></li>
            </ul>
        </li>
        <li>
            <div class="mode">
                <div class="moon-sun">
                    <i class="fa-regular fa-moon moon"></i>
                    <i class="fa-regular fa-sun sun"></i>
                </div>
                <span class="mode-text text">Dark Mode</span>
                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>

            </div>
        </li>

        <li>
            <div class="profile-details">
                <div class="profile-content">

                    <img src="/uploads/images/" class="image" alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">fname</div>
                    <div class="job">group name</div>
                </div>
                <a href="/auth/logout"><i class="fa-solid fa-right-from-bracket"></i></a></a>
            </div>
        </li>
    </ul>
</div>

<!-- End Sidebar -->
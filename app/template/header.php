<div class="main-content">
    <section class="home-section">
        <!-- Start Navbar -->

        <header class="header-n">
            <div class="nav-n" id="navbar">
                <div class="menu-n">
                    <div>

                        <div class="info-n">
                            <img src="/uploads/images/" class="logo-n">
                        </div>
                        <span></span>
                        <ul class="profile-n">
                            <li><a href="/users/view">My Profile</a></li>
                            <li><a href="/users/editprofile">Edit Profile</a></li>
                            <li><a href="#">Settings</a></li>
                            <li><a href="/auth/logout">Logout</a></li>
                        </ul>

                        <ul>
                            <li><a href="/">dashboard</a></li>
                            <li><a href="/language">lang</a></li>
                        </ul>
                        <ul class="social-media">
                            <li><a href="https://www.facebook.com/marwa.brada.39"><i
                                        class="fa-brands fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/yassine_elhajjy/?hl=fr"><i
                                        class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/yassine-elhajjy-bab1ba233/"><i
                                        class="fa-brands fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="container-n">
                    <span class="brand-n"><?php if (isset($title)) {
                        echo ' > ' . 'title' ;
                    } ?></span>
                    <div class="container-inner">
                        <ul>
                            <li class="center"><a href="/">dashboard</a></li>
                            <li class="center"><a href="/language">lang</a>
                            </li>
                        </ul>
                        <a class="photo-name-n" href="/users/view">
                            <div class="photo-n">
                                <img src="/uploads/images/" alt="">
                            </div>
                            <span class="name-n"></span>
                        </a>
                    </div>
                    <div class="menu-icon-n" id="menu-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </header>

    </section>


    <!-- End Navbar -->
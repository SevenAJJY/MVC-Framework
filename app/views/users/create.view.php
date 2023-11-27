<div class="home-content">
    <div class="row">
        <h1 class="main-head"><?php echo $text_header ;?></h1>

        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container fuser">
                <h4><?php echo $text_legend ?></h4>
                <form action="" class="appform row" method="post" autocomplete="off" enctype="multipart/form-data"
                    enctype="application/x-www-form-urlencoded">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="text" spellcheck="false" class="FirstName" name="FirstName" id="FirstName"
                                maxlength="10" required>
                            <label for="FirstName"><?php echo $text_label_FirstName ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="text" spellcheck="false" name="LastName" id="LastName" maxlength="10" required>
                            <label for="LastName"><?php echo $text_label_LastName ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="text" spellcheck="false" class="Username" name="Username" id="Username"
                                maxlength="30" required>
                            <label for="username" class="labelerror"><?php echo $text_label_Username ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="text" spellcheck="false" id="Number" name="PhoneNumber" required>
                            <label for="Number"><?php echo $text_label_PhoneNumber ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="password" id="password" name="Password" class="input" spellcheck="false"
                                required />
                            <label for="password"><?php echo $text_label_Password ?></label>
                            <i class="fa-regular fa-eye-slash togglePass"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="password" id="cPassword" name="CPassword" class="input2" spellcheck="false"
                                required />
                            <label for="cPassword"><?php echo $text_label_CPassword ?></label>
                            <i class="fa-regular fa-eye-slash togglePass2"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="email" spellcheck="false" id="email" class="Email" name="Email" maxlength="40"
                                required>
                            <label for="email"><?php echo $text_label_Email ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="email" spellcheck="false" id="cemail" name="CEmail" maxlength="40" required>
                            <label for="cemail"><?php echo $text_label_CEmail ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <select class="form-select select-box" name="GroupId" aria-label="Default select example">
                                <option value="" selected><?php echo $text_user_GroupId?></option>
                                <?php if (false !== $groups): ?>
                                <?php foreach ($groups as $group):?>
                                <option value="<?php echo $group->GroupId ?>"><?php echo $group->GroupName ?></option>
                                <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="text" spellcheck="false" id="address" name="Address" required>
                            <label for="address"><?= $text_address_label ?></label>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="input-box">
                            <input type="file" id="Image" name="Image" />
                            <label for="Image"><i class="fa-solid fa-cloud-arrow-up"></i><span
                                    class="ms-4"><?= $text_profile_image ?></span></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="date" spellcheck="false" id="Dob" name="DOB" value="<?= date('Y-m-d') ?>"
                                required>
                            <label for="dob"><?= $text_dob_label ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="date" spellcheck="false" id="subscriptionDate" name="SubscriptionDate"
                                value="<?= date('Y-m-d') ?>" required>
                            <label for="subscriptionDate"><?= $text_joined_label ?></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-box">
                            <input type="submit" name="submit" value="<?php echo $text_label_save ?>" maxlength="30"
                                required>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
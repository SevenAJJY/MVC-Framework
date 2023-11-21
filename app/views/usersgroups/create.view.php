<div class="home-content">
    <div class="row">
            <h1 class="main-title text-center"><?php echo $text_header ;?></h1>
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?php echo $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off" enctype="application/x-www-form-urlencoded">
                    <div class="input-box">
                        <input type="text" spellcheck="false" name="GroupName" maxlength="20" required>
                        <label for=""><?php echo $text_label_group_title ?></label>
                    </div>
                    <!-- <div class="input-box"> -->
                        <label for=""></label>
                        <h4 class="privilegesgroups"><?php echo $text_label_group ?></h4>
                        <?php if($privileges != false): ?>
                            <?php foreach ($privileges as $privilege): ?>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="Privileges[]" value="<?php echo $privilege->PrivilegeId ; ?>" role="switch" id="flexSwitchCheckDefault">
                                    <label class="form-check-label label" for="flexSwitchCheckDefault"><?php echo $privilege->PrivilegeTitle ; ?></label>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <!-- </div> -->
                    <div class="input-box">
                        <input type="submit" class="mt-3" name="submit" value="<?php echo $text_label_save ?>" maxlength="30" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
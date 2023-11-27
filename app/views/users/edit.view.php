<div class="home-content">
    <div class="row">
            <h1 class="main-title text-center"><?php echo $text_header ;?></h1>

        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?php echo $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off" enctype="application/x-www-form-urlencoded">
                    <div class="input-box">
                        <input type="text" spellcheck="false" id="Number"  name="PhoneNumber" value="<?php echo $this->showValue('PhoneNumber',$user) ?>"  required>
                        <label for="Number"><?php echo $text_label_PhoneNumber ?></label>
                    </div>
                    <div class="input-box">
                        <select class="form-select select-box" name="GroupId" aria-label="Default select example" >
                            <option value="" selected><?php echo $text_user_GroupId?></option>
                            <?php if (false !== $groups): ?>
                                <?php foreach ($groups as $group):?>
                                    <option value="<?php echo $group->GroupId ?>" <?php echo $this->seletedIf('GroupId' , $group->GroupId , $user);  ?> ><?php echo $group->GroupName ?></option>
                                <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                    
                    <div class="input-box">
                        <input type="submit" name="submit" value="<?php echo $text_label_save ?>" maxlength="30" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
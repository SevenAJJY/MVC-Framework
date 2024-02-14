<div class="home-content login-box">

    <div class="row d-flex justify-content-center align-items-center flex-column h-100 mt-50">
        <?php 
             $messages = $this->messenger->getMessages();
             if (!empty($messages))
             {
                 foreach ($messages as $message) {
                     /**
                      * 
                      * @var array
                      */
                     $typeMsg = [];
                     switch ($message[1]) {
                         case 1:
                             $typeMsg['type'] = 'fa-regular fa-circle-check' ;
                             $typeMsg['msg'] = 'Success!' ;
                             break;
                         case 2:
                             $typeMsg['type'] = 'fa-solid fa-circle-exclamation' ;
                             $typeMsg['msg'] = 'Failed!' ;
                             break;
                         case 3:
                             $typeMsg['type'] = 'fa-solid fa-circle-info' ;
                             $typeMsg['msg'] = 'Info!' ;
                             break;
                         case 4:
                             $typeMsg['type'] = 'fa-solid fa-triangle-exclamation' ;
                             $typeMsg['msg'] = 'Warning!' ;
                             break;
                     }
                     echo '<div class="d-flex justify-content-center mb-4">
                             <div class="my-alert-2 message t'.$message[1].'">
                                 <div class="my-alert-2-content ">
                                 <i class="'.$typeMsg['type'].' check _icon-message t'.$message[1].'"></i>
                                     <div class="message_content">
                                         <span class="text-alert text-1"><strong>'.$typeMsg['msg'].'</strong></span>
                                         <span class="text-alert text-2">'. $message[0].'</span>
                                     </div>
                                 </div>
                             </div>
                         </div>' ;
                 }
             }
    ?>
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container login_bx">
                <div class="dots dots-login-above"></div>

                <h4><?php echo $login_header ?></h4>
                <div class="login-logo">
                    <img src="/img/hajjyfoodsgrande.png" alt="hajjy food logo">
                </div>
                <form action="" class="appform" method="post" autocomplete="off"
                    enctype="application/x-www-form-urlencoded">
                    <div class="input-box">
                        <input type="text" spellcheck="false" id="Username" name="ucname" required>
                        <label for="Username"><?php echo $login_ucname ?></label>
                    </div>
                    <div class="input-box">
                        <input type="password" spellcheck="false" id="Password" name="ucpwd" required>
                        <label for="Password"><?php echo $login_ucpwd ?></label>
                    </div>
                    <div class="input-box">
                        <input type="submit" name="login" value="<?php echo $login_button ?>" maxlength="30" required>
                    </div>
                </form>
                <div class="dots dots-login-under"></div>

            </div>
        </div>
    </div>
    <!-- <div class="image">
        <img src="/img/login_image1.svg" alt="loginImage">
    </div> -->
</div>
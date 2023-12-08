<div class="home-content">
    <div class="row">
        <h1 class="main-head"><?php echo $text_header ;?></h1>
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?php echo $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="input-box">
                        <input type="text" spellcheck="false" name="Name" maxlength="20"
                            value="<?php echo $this->showValueV2('Name', $category) ?>" required>
                        <label for=""><?php echo $text_label_Name ?></label>
                    </div>
                    <div class="input-box">
                        <input type="file" spellcheck="false" id="file" name="image" accept="image/*" maxlength="20">
                        <label for="file"><i class="fa-solid fa-cloud-arrow-up"></i> &nbsp;&nbsp;&nbsp;
                            <?php echo $text_label_Image ?></label>
                    </div>
                    <?Php if($category->Image !== null): ?>
                    <div class="input-box image__upload">
                        <img src="/uploads/images/<?= $category->Image ?>" class="upload-image" data-action="edit">
                    </div>
                    <?Php endif; ?>
                    <div class="input-box">
                        <input type="submit" class="mt-4" name="submit" value="<?php echo $text_label_save ?>"
                            maxlength="30" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
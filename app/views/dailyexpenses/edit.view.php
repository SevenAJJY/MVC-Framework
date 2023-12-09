<div class="home-content">
    <div class="row">
        <h1 class="main-head"><?= $text_header ;?></h1>
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?= $text_legend ?></h4>
                <!-- <?php var_dump($list, $categories) ?> -->
                <form action="" class="appform" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="input-box w-notes">
                        <select class="form-select select-box" name="CategoryId">
                            <option selected><?= $text_select_category?></option>
                            <?php if (false !== $categories): ?>
                            <?php foreach ($categories as $category):?>
                            <option value="<?= $category->ExpenseId ?>"
                                <?= $this->selectedIf('ExpenseId' , $list->ExpenseId , $list); ?>>
                                <?= $category->ExpenseName ?></option>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                    <div class="notes">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle"
                            viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                        </svg>
                        <span class="note"><?= $text_note_category ?></span>
                    </div>
                    <div class="input-box w-notes">
                        <input type="number" spellcheck="false" name="Payment" min="1" step="0.01"
                            value="<?= $this->showValueV2('Payment', $list) ?>" />
                        <label><?= $text_payment_label ?></label>
                    </div>
                    <div class="notes">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle"
                            viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                        </svg>
                        <span class="note"><?= $text_note_payment ?></span>
                    </div>
                    <div class="input-box">
                        <input type="text" spellcheck="false" name="Description" maxlength="50"
                            value="<?= $this->showValueV2('Description', $list) ?>" required>
                        <label for=""><?= $text_description_label ?></label>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="mt-3" name="submit" value="<?= $text_label_save ?>" maxlength="30">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
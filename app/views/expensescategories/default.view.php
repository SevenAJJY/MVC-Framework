<div class="home-content">
    <h1 class="main-head"><?php echo $text_header ;?></h1>
    <div class="main-button">
        <a href="/expensescategories/create">
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?php echo $text_new_item ?></span>
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?php echo $text_new_item ?></span>
        </a>
    </div>
    <div class="table-responsive tables">
        <table class="table__content">
            <thead>
                <tr>
                    <th><?= $text_expense_name ?></th>
                    <th><?= $text_fixed_payment ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (false !== $expensescategories) {
                foreach ($expensescategories as $category) {
                    echo '<tr>' ;
                        echo '<td>' . $category->ExpenseName . '</td>' ;
                        echo '<td>' . $category->FixedPayment . ' €</td>' ;?>
                <td>
                    <a href="/expensescategories/edit/<?= $category->ExpenseId ?>"><i class="fas fa-edit"></i></a>
                    <a href="/expensescategories/delete/<?= $category->ExpenseId ?>"
                        onclick="return confirm('<?= $text_delete_confirm ; ?>');"><i
                            class="fa-regular fa-trash-can"></i></a>
                </td>
                <?php
                    echo '</tr>' ;
                }
            }
            else {
                    echo '<tr><td colspan="4" class="alert alert-success text-center mb-2 mt-2">
                                <i class="fas fa-exclamation-triangle me-3 "></i> '.$text_no_data.
                        '</td></tr>';
            }
        ?>
            </tbody>
        </table>
    </div>

</div>
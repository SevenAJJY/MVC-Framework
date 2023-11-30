<div class="home-content">
    <h1 class="main-head"><?php echo $text_header ;?></h1>
    <div class="main-button">
        <a href="/suppliers/create">
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?php echo $text_new_item ?></span>
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?php echo $text_new_item ?></span>
        </a>
    </div>

    <div class="table-responsive tables">
        <table class="table__content">
            <thead>
                <tr>
                    <th><?= $text_table_name ?></th>
                    <th><?= $text_table_email ?></th>
                    <th><?= $text_table_phone_number ?></th>
                    <th><?= $text_label_address ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (false !== $suppliers) {
                foreach ($suppliers as $supplier) {
                    echo '<tr>' ;
                        echo '<td>' . $supplier->Name . '</td>' ;
                        echo '<td>' . $supplier->Email . '</td>' ;
                        echo '<td>' . $supplier->PhoneNumber  . '</td>' ;
                        echo '<td>' . $supplier->Address . '</td>' ;?>
                <td>
                    <a href="/suppliers/edit/<?= $supplier->SupplierId ?>"><i class="fas fa-edit"></i></a>
                    <a href="/suppliers/delete/<?= $supplier->SupplierId ?>"
                        onclick="return confirm('<?= $text_delete_confirm ; ?>');"><i
                            class="fa-regular fa-trash-can"></i></a>
                </td>
                <?php
                    echo '</tr>' ;
                }
            }
            else {
                    echo '<tr><td colspan="5" class="alert alert-success text-center mb-2 mt-2">
                                <i class="fas fa-exclamation-triangle me-3 "></i> '.$text_no_data.
                        '</td></tr>';
            }
        ?>
            </tbody>
        </table>
    </div>

</div>
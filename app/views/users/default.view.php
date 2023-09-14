<!DOCTYPE html>
<div class="home-content">
    <h1 class="main-title text-center">ALL USERS</h1>
    <div class="main-button">
        <a href="/user/create">
            <span><i class="fa-solid fa-plus me-2 ms-2"></i><?= $text_add_new_user ?></span>
            <span><i class="fa-solid fa-plus me-2 ms-2"></i><?= $text_add_new_user ?></span>
        </a>
    </div>
    <div class="errors">
        <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-success  mt-3">
                            <i class="fas fa-check me-3"></i> '.$_SESSION['message'].'
                        </div>';
                        unset($_SESSION['message']) ;
                }
            ?>
    </div>
    <div class="table-responsive tables">
        <table class="table__content">
            <thead>
                <tr>
                    <th><?= $text_table_name ?></th>
                    <th><?= $text_table_age ?></th>
                    <th><?= $text_table_address ?></th>
                    <th><?= $text_table_salary ?></th>
                    <th><?= $text_table_tax ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (false !== $users) {
                foreach ($users as $user) {
                    echo '<tr>' ;
                        echo '<td>' . $user->name . '</td>' ;
                        echo '<td>' . $user->age . '</td>' ;
                        echo '<td>' . $user->address . '</td>' ;
                        echo '<td>' . $user->salary  . ' DH</td>' ;
                        echo '<td>' . $user->tax . '</td>' ;?>
                <td>
                    <a href="/user/edit/<?= $user->id ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i>
                        <?= $text_table_edit ?></a>
                    <a href="/user/delete/<?= $user->id ?>" class="btn btn-sm btn-danger"
                        onclick="if(!confirm('<?= $text_delete_confirm ?>')) return false;"><i class="fas fa-times"></i>
                        <?= $text_table_delete ?></a>
                </td>
                <?php
                        echo '</tr>' ;
                }
            }
            else {
                    echo '<tr><td rowspan="6" class="alert alert-success text-center mb-2 mt-2">
                                <i class="fas fa-exclamation-triangle me-3 "></i> '.$text_no_data.'
                        </td></tr>';
            }
        ?>
            </tbody>
        </table>
    </div>

</div>
<div class="home-content">
    <h1 class="main-title text-center"><?= $text_header ;?></h1>
    <div class="main-button">
        <a href="/users/create">
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?= $text_new_item ?></span>
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?= $text_new_item ?></span>
        </a>
    </div>
    <div class="table-responsive tables">
        <table class="table__content">
        <thead>
            <tr>
                <th><?= $text_table_username ?></th>
                <th><?= $text_table_group ?></th>
                <th><?= $text_table_email ?></th>
                <th><?= $text_table_subscription_date ?></th>
                <th><?= $text_table_last_login ?></th>
                <th><?= $text_table_control ?></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if (false !== $users) {
                foreach ($users as $user) {
                    echo '<tr>' ;
                        echo '<td>' . $user->Username . '</td>' ;
                        echo '<td>' . $user->GroupName . '</td>' ;
                        echo '<td>' . $user->Email . '</td>' ;
                        echo '<td>' . $user->SubscriptionDate  . '</td>' ;
                        echo '<td>' . $user->LastLogin . '</td>' ;?>
                            <td>
                                <a href="/users/edit/<?= $user->UserId ?>" class="btn btn-sm"><i class="fas fa-edit"></i> </a>
                                <a href="/users/delete/<?= $user->UserId ?>" class="btn btn-sm"onclick="return confirm('<?= $text_delete_confirm ; ?>');"><i class="fa-regular fa-trash-can"></i></a>
                                <a href="/users/resetpassword/<?= $user->UserId ?>" class="btn btn-sm"><i class="fa-brands fa-keycdn"></i></a>
                            </td>
                    <?php
                    echo '</tr>' ;
                }
            }
            else {
                    echo '<tr><td rowspan="6" class="alert alert-success text-center mb-2 mt-2">
                                <i class="fas fa-exclamation-triangle me-3 "></i> '.$text_no_data.
                        '</td></tr>';
            }
        ?>
        </tbody>
    </table>
    </div>

</div>

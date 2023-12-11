<div class="home-content">
    <h1 class="main-head"><?php echo $text_header ;?></h1>

    <div class="main-button">
        <a href="/clients/create">
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
                if (false !== $clients) {
                foreach ($clients as $client) {
                    echo '<tr>' ;
                        echo '<td>' . $client->Name . '</td>' ;
                        echo '<td>' . $client->Email . '</td>' ;
                        echo '<td>' . $client->PhoneNumber  . '</td>' ;
                        echo '<td>' . $client->Address . '</td>' ;?>
                <td>
                    <a href="/clients/edit/<?= $client->ClientId ?>"><i class="fas fa-edit"></i></a>
                    <a href="/clients/delete/<?= $client->ClientId ?>"
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
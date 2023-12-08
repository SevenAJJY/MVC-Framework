<div class="home-content">
    <h1 class="main-head"><?= $text_header ;?></h1>
    <div class="main-button">
        <a href="/productlist/create">
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?= $text_new_item ?></span>
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?= $text_new_item ?></span>
        </a>
    </div>

    <div class="table-responsive tables">
        <table class="table__content">
            <thead>
                <tr>
                    <th><?= $text_table_name ?></th>
                    <th><?= $text_table_category ?></th>
                    <th><?= $text_table_buy_price ?></th>
                    <th><?= $text_table_sell_price ?></th>
                    <th><?= $text_table_quantity ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (false !== $products) {
                foreach ($products as $product) {
                    echo '<tr>' ;
                        echo '<td>' . $product->Name . '</td>' ;
                        echo '<td>' . $product->categoryName . '</td>' ;
                        echo '<td>' . $product->BuyPrice  . ' €</td>' ;
                        echo '<td>' . $product->SellPrice . ' €</td>' ;
                        echo '<td>' . $product->Quantity . '</td>' ;?>
                <td>
                    <a href="/productlist/edit/<?= $product->ProductId ?>"><i class="fas fa-edit"></i></a>
                    <a href="/productlist/delete/<?= $product->ProductId ?>"
                        onclick="return confirm('<?= $text_delete_confirm ; ?>');"><i
                            class="fa-regular fa-trash-can"></i></a>
                </td>
                <?php
                    echo '</tr>' ;
                }
            }
            else {
                    echo '<tr><td colspan="6" class="alert alert-success text-center mb-2 mt-2">
                                <i class="fas fa-exclamation-triangle me-3 "></i> '.$text_no_data.
                        '</td></tr>';
            }
        ?>
            </tbody>
        </table>
    </div>

</div>
<div class="home-content">
    <h1 class="main-head"><?php echo $text_header ;?></h1>
    <div class="main-button">
        <a href="/purchases/create">
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?php echo $text_new_item ?></span>
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?php echo $text_new_item ?></span>
        </a>
    </div>
    <div class="table-responsive tables">
        <table class="table__content">
            <thead>
                <tr>
                    <th><?= $text_table_ref; ?></th>
                    <th><?= $text_table_supplier; ?></th>
                    <th><?= $text_table_created; ?></th>
                    <th><?= $text_table_added_to_store; ?></th>
                    <th><?= $text_table_products_total ?></th>
                    <th><?= $text_table_total ?></th>
                    <th><?= $text_table_payment_type; ?></th>
                    <th><?= $text_table_paid; ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (false !== $invoices) {
                foreach ($invoices as $invoice) {
            ?>
                <tr>
                    <td> B-<?=(new DateTime($invoice->Created))->format('ym-') ?><?= $invoice->InvoiceId; ?></td>
                    <td><?= $invoice->supplier; ?></td>
                    <td><?= (new DateTime($invoice->Created))->format('Y-m-d h:i a'); ?></td>
                    <td><span class="added-to-store added-<?= $invoice->AddedToStore ?>">
                            <?= ${'text_added_to_store_' . $invoice->AddedToStore}; ?> </span></td>
                    <td><?= $invoice->ptotal ?></td>
                    <td><?= number_format((float) $invoice->Total, 2, '.', '') ?> €</td>
                    <td><?= ${'text_payment_type_' . $invoice->PaymentType}; ?></td>
                    <td><?= $invoice->totalPaid == null ? 0 : $invoice->totalPaid ?> €</td>
                    <td class="controls_td">
                        <a href="/purchases/view/<?= $invoice->InvoiceId ?>"><i class="fa-regular fa-eye"></i></a>
                        <?php if ($invoice->AddedToStore != 1): ?>
                        <a href="/purchases/edit/<?= $invoice->InvoiceId ?>"><i class="fas fa-edit"></i></a>
                        <a href="/purchases/delete/<?= $invoice->InvoiceId ?>"
                            onclick="return confirm('<?= $text_table_control_delete_confirm ; ?>');"><i
                                class="fa-regular fa-trash-can"></i></a>
                        <a href="/purchases/deliverproducts/<?= $invoice->InvoiceId ?>"
                            onclick="return confirm('<?= $text_table_control_deliver_confirm ; ?>');"><i
                                class="fa-solid fa-truck-fast"></i></a>
                        <?php endif ?>
                        <?php if ($invoice->Total > $invoice->totalPaid): ?>
                        <a href="/paymentvoucher/create/<?= $invoice->InvoiceId ?>"><i
                                class="fa-solid fa-money-bill-transfer"></i>
                            <?php endif; ?>
                            <?php if ($invoice->totalPaid != null): ?>
                            <a href="/paymentvoucher/default/<?= $invoice->InvoiceId ?>"><i
                                    class="fa-solid fa-clipboard-list"></i></a>
                            <?php endif; ?>
                    </td>
                    <?php
                    echo '</tr>' ;
                }
            }
            else {
                    echo '<tr><td colspan="9" class="alert alert-success text-center mb-2 mt-2">
                                <i class="fas fa-exclamation-triangle me-3 "></i> '.$text_no_data.
                        '</td></tr>';
            }
        ?>
            </tbody>
        </table>
    </div>
</div>









































<!-- <table>
<tr>
    <td>
        <select name="products" id="products">
            <option value="">choose product</option>
            <?php if (false !== $products): foreach ($products as $product): ?>
                <option data-price="<?= $product->BuyPrice ?>" <?= (@$_POST['products'] == $product->ProductId) ? 'selected' : '' ?> value="<?= $product->ProductId ?>"><?= $product->Name ?></option>
            <?php endforeach;endif; ?>
        </select>
    </td>
</tr>
</table>
<table>
    <tr>
        <td>
            <a class="addProduct" href="javascript:void(0);"><i class="fa fa-plus"></i>add_product</a>
            <div class="products_list">
                <table>
                    <tr>
                        <td>product_name</td>
                        <td>product_quantity</td>
                        <td>product_price</td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table> -->
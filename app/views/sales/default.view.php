<div class="home-content">
    <h1 class="main-head"><?php echo $text_header ;?></h1>
    <div class="main-button">
        <a href="/sales/create">
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?php echo $text_new_item ?></span>
            <span><i class="fa-solid fa-plus me-2 ms-2"></i> <?php echo $text_new_item ?></span>
        </a>
    </div>
    <div class="table-responsive tables">
        <table class="table__content">
            <thead>
                <tr>
                    <th><?= $text_table_ref; ?></th>
                    <th><?= $text_name_label; ?></th>
                    <th><?= $text_table_created; ?></th>
                    <th><?= $text_table_product_delivery; ?></th>
                    <th><?= $text_table_products_total ?></th>
                    <th><?= $text_table_total ?></th>
                    <th><?= $text_table_payment_type; ?></th>
                    <th><?= $text_table_paid; ?></th>
                    <th><?= $text_table_payment_status; ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (false !== $invoices) {
                foreach ($invoices as $invoice) {
            ?>
                <tr>
                    <td> S-<?=(new DateTime($invoice->Created))->format('ym-') ?><?= $invoice->InvoiceId; ?></td>
                    <td><?= $invoice->supplier; ?></td>
                    <td><?= (new DateTime($invoice->Created))->format('Y-m-d h:i a'); ?></td>
                    <td><span class="added-to-store added-<?= $invoice->ProductsDelivery ?>">
                            <?= ${'text_added_to_store_' . $invoice->ProductsDelivery}; ?> </span></td>
                    <td><?= $invoice->ptotal ?></td>
                    <td><?= number_format((float) $invoice->Total, 2, '.', '') ?> €</td>
                    <td><?= ${'text_payment_type_' . $invoice->PaymentType}; ?></td>
                    <td><?= $invoice->totalPaid == null ? 0 : number_format((float) $invoice->totalPaid, 2, '.', '')  ?>
                        €</td>
                    <td>
                        <?php 
                            $invoice->totalPaid == null ? 0 : $invoice->totalPaid ;
                            if (floor($invoice->Total) == floor($invoice->totalPaid)) {
                                echo "<span class='status-1'> </span>";
                            }elseif (floor($invoice->Total) >= floor($invoice->totalPaid)) {
                                echo "<span class='status-2'> </span>";
                            }
                            
                            ?>
                    </td>
                    <td class="controls_td">
                        <a href="/sales/view/<?= $invoice->InvoiceId ?>"><i class="fa-regular fa-eye"></i></a>
                        <a target="_blank" href="/sales/downloadbill/<?= $invoice->InvoiceId ?>"><i
                                class="fa-regular fa-file-pdf"></i></a>
                        <?php if ($invoice->ProductsDelivery != 1): ?>
                        <a href="/sales/edit/<?= $invoice->InvoiceId ?>"><i class="fas fa-edit"></i></a>
                        <a href="/sales/delete/<?= $invoice->InvoiceId ?>"
                            onclick="return confirm('<?= $text_table_control_delete_confirm ; ?>');"><i
                                class="fa-regular fa-trash-can"></i></a>
                        <a href="/sales/deliverproducts/<?= $invoice->InvoiceId ?>"
                            onclick="return confirm('<?= $text_table_control_deliver_confirm ; ?>');"><i
                                class="fa-solid fa-truck-fast"></i></a>
                        <?php endif ?>

                        <?php if (floor($invoice->Total) > floor($invoice->totalPaid)): ?>
                        <a href="/receiptvoucher/create/<?= $invoice->InvoiceId ?>"><i
                                class="fa fa-credit-card"></i></a>
                        <?php endif; ?>
                        <?php if ($invoice->totalPaid != null): ?>
                        <a href="/receiptvoucher/default/<?= $invoice->InvoiceId ?>"><i
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
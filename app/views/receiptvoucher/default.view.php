<div class="home-content">
    <h1 class="main-head"><?php echo $text_header ;?></h1>
    <div class="table-responsive tables">
        <table class="table__content">
            <thead>
                <tr>
                    <th><?= $text_table_ref; ?></th>
                    <th><?= $text_table_invoice ?></th>
                    <th><?= $text_table_client; ?></th>
                    <th><?= $text_table_created; ?></th>
                    <th><?= $text_table_payment; ?></th>
                    <th><?= $text_table_payment_type; ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (false !== $vouchers) {
                foreach ($vouchers as $voucher) {
            ?>
                <tr>
                    <td>V-<?= (new DateTime($voucher->iCreated))->format('ym-') ?><?= $voucher->InvoiceId; ?></td>
                    <td>B-<?= (new DateTime($voucher->iCreated))->format('ym-') ?><?= $voucher->InvoiceId; ?></td>
                    <td><?= $voucher->ClientName; ?></td>
                    <td><?= (new DateTime($voucher->iCreated))->format('Y-m-d h:i a'); ?></td>
                    <td><?= $voucher->PaymentAmount; ?> DH</td>
                    <td><?= ${'text_payment_type_' . $voucher->PaymentType}; ?></td>
                    <td>
                        <a href="/paymentvoucher/view/<?= $voucher->ReceiptId ?>"><i class="fa fa-eye"></i></a>
                        <!-- <a href="/paymentvoucher/edit/<?= $voucher->ReceiptId ?>"><i class="fa fa-edit"></i></a> -->
                        <a href="/paymentvoucher/delete/<?= $voucher->ReceiptId ?>"
                            onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i
                                class="fa-regular fa-trash-can"></i></a>
                        <!-- <a href="/paymentvoucher/attachcopy/<?= $voucher->ReceiptId ?>"><i class="fa fa-paperclip"></i></a> -->
                    </td>
                </tr>
                <?php
                    echo '</tr>' ;
                }
            }
            else {
                    echo '<tr><td rowspan="4" class="alert alert-success text-center mb-2 mt-2">
                                <i class="fas fa-exclamation-triangle me-3 "></i> '.$text_no_data.
                        '</td></tr>';
            }
        ?>
            </tbody>
        </table>
    </div>
</div>
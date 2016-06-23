<div class="row">
    <div class="col-lg-12">
        <?php
        $level = $user_object['user_level'];
        $form_attributes = array('id' => 'view_orderfm', 'class' => 'form-inline', 'role' => 'form');
        echo form_open('', $form_attributes); ?>

    </div>
</div>
<div class="well well-sm"><b>Order Details</b></div>
<!--Place order form -->
<div id="order_infor">

    <table class="table table-bordered table-striped" id="store_infor_tbl">
        <tr>
            <td style="width:50%">Store Name : <?php print_r($orderitems[0]['station_id']); ?> </td>
            <td>Order Date: <?php print_r($orderitems[0]['order_date']); ?></td>
        </tr>
        <tr>
            <td>Requestor's Name : <?php print_r($orderitems[0]['order_by']); ?> </td>
            <td>Today's Date: <?php echo date('Y-m-d', strtotime(date('Y-m-d'))); ?></td>
        </tr>
    </table>

    <div class="well well-sm"><b>Order Details</b></div>
    <div class="table-responsive">
        <div id="order">
            <table class="table table-bordered table-striped">

                <thead>
                <tr align="center">
                    <th>Vaccine</th>
                    <th>Stock On Hand</th>
                    <th>Minimum Stock</th>
                    <th>Maximum Stock</th>
                    <th>First Expiry Date</th>
                    <th>Quantity ordered(Doses)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($orderitems as $orderitems) {
                $stock_on_hand = $orderitems['stock_on_hand'];
                $min_stock = $orderitems['min_stock'];
                $max_stock = $orderitems['max_stock'];
                $first_expiry = $orderitems['first_expiry'];
                $quantity_ordered = $orderitems['quantity_ordered'];
                $order_by = $orderitems['order_by'];
                $vaccine = $orderitems['Vaccine_name'];

                ?>
                <tr align="center" order_row="1">
                    <td><?php echo $orderitems['Vaccine_name'] ?></td>


                    <td><?php $data = array('name' => 'stock_on_hand', 'id' => 'stock_on_hand', 'class' => 'form-control stock_on_hand_', 'readonly' => 'readonly', 'value' => $stock_on_hand);
                        echo form_input($data); ?></td>
                    <td><?php $data = array('name' => 'min_stock', 'id' => 'min_stock', 'class' => 'form-control min_stock_', 'readonly' => 'readonly', 'value' => $min_stock);
                        echo form_input($data); ?></td>
                    <td><?php $data = array('name' => 'max_stock', 'id' => 'max_stock', 'class' => 'form-control max_stock_', 'readonly' => 'readonly', 'value' => $max_stock);
                        echo form_input($data); ?></td>
                    <td><?php $data = array('name' => 'first_expiry_date', 'id' => 'first_expiry_date', 'class' => 'form-control first_expiry_date_', 'readonly' => 'readonly', 'value' => $first_expiry);
                        echo form_input($data); ?></td>
                    <td><?php $data = array('name' => 'quantity_dose', 'id' => 'quantity_dose', 'class' => 'form-control quantity_dose_', 'readonly' => 'readonly', 'value' => $quantity_ordered);
                        echo form_input($data); ?></td>
                    <?php } ?>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php if ($option == 1 && $status_name == "issued") { ?>
    <input type="button" value="Continue" class="btn btn-sm btn-danger"
           onclick="window.location.href='<?php echo base_url() . 'stock/receive_stocks' . '/' . $order_id ?>'"/>
<?php } else if ($option == 2 && $status_name == "pending" && $level != 3) { ?>
    <input type="button" value="Continue" class="btn btn-sm btn-danger"
           onclick="window.location.href='<?php echo base_url() . 'stock/issue_stocks' . '/' . $order_id ?>'"/>
<?php } else { ?>
    <!--   <input type="button" value="Receive Order" class="btn btn-sm btn-danger" disabled="" hidden/>-->
<?php }


echo form_close();
  


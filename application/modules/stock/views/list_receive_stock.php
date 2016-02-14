<?php echo $this->session->flashdata('msg');  ?>
<div class="row">

    <div class="col-lg-12 col-sm-12">

        <a href="<?php echo site_url('stock/receive_stock');?>" class="btn btn-primary state_change" id="create_order" value="Create Order">Receive stocks directly</a>
    </div>
</div>
</br>

<div class="well well-sm"><b>Requests</b></div>
</br>
<div class="row">


    <div class="col-lg-12 col-sm-12">
        <div class="panel default blue_title h2">

            <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab">

                    <li class="active"><a data-toggle="tab" href="#tab1"><b>Requests from me</b></a></li>

                </ul>
                <div class="tab-content" id="">

                    <div id="tab1" class="tab-pane fade in active">
                        <form id="list_orders_fm">
                            <!--Listing Submitted Requests-->


                            <table class="table table-bordered table-striped" id="list_orders_tbl">
                                <thead>
                                <tr><th>Request # </th><th>Date Created</th><th>Status</th><th>Action</th></tr>
                                </thead>

                                <tbody>
                                <?php $option=1 ; ?>
                                <?php foreach ($submitted_orders as $order) {
                                $ledger_url = base_url().'order/view_orders/'.$order['order_by'].'/'.$order['date_created'].'/'.$option.'/'.$order['order_id'].'/'.$order['status_name'];

                                ?>

                                <tr>
                                    <td><?php  echo $order['order_id']?></td>
                                    <td><?php echo $order['date_created']?></td>
                                    <td style="color:red"><?php echo $order['status_name']?></td>
                                    <td><a href="<?php  echo $ledger_url ?>" class="btn btn-danger btn-xs">View <i class="fa fa-eye"></i></a></td>
                                    <?php }?>
                                </tr>

                                </tbody>
                            </table>

                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    window.setTimeout(function() {
        $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
</script>
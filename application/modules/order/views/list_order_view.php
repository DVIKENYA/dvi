<div class="row">
    <div class="col-lg-12 col-sm-12">

      <a href="<?php echo site_url('order/create_order');?>" class="btn btn-primary state_change" id="create_order" value="Create Order">Create Order</a>
    </div>
  </div>
  </br>
  
  <div class="well well-sm"><b>My Orders</b></div>
  </br>
<div class="row">
  
  <?php echo $this->session->flashdata('msg');  ?>
<div class="col-lg-12 col-sm-12">
 <div class="panel default blue_title h2">

              <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab">
                
                  <li class="active"><a data-toggle="tab" href="#tab1"><b>Submitted Orders</b></a></li>
                  <li><a data-toggle="tab" href="#tab2"><b>Placed Orders</b></a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div id="tab1" class="tab-pane fade in active">
                   <div class="table-responsive">
                   <form id="list_orders_fm">
<!--Listing Submitted Orders-->


    <table class="table table-bordered table-striped" id="list_orders_tbl">
        <thead>
                <tr><th>Order # </th><th>Date Created</th><th>Status</th><th>Action</th></tr>
        </thead>

        <tbody>
          <?php $option=1 ; ?>
        <?php foreach ($submitted_orders as $order) { 
         $ledger_url = base_url().'order/view_orders/'.$order['order_by'].'/'.$order['date_created'].'/'.$option;
         
         ?>
        
              <tr>
<!--              <td><?php // echo $order['order_id']?></td>-->
              <td><?php echo $order['station_id']?></td>
              <td><?php echo $order['date_created']?></td>
              <td style="color:red">Pending</td>
              <td><a href="<?php  echo $ledger_url ?>" class="btn btn-danger btn-xs">View <i class="fa fa-eye"></i></a></td>
<!--              <td><a href="<?php  echo $ledger_url ?>">View</a><span class="divider"> | </span><a href="#">Download</a></td>-->
        <?php }?>
              </tr>

        </tbody>
        </table>
        

</form></div>
                  </div>
                  <div id="tab2" class="tab-pane fade">
                  <div class="table-responsive">
                   <form id="list_orders_fm">
<!--Listing Placed Orders-->


    <table class="table table-bordered table-striped" id="list_orders_tbl">
        <thead>
                <tr><th>Order # </th><th>Order from</th><th>Date Created</th><th>Action</th></tr>
        </thead>

        <tbody>
        <?php $option=2 ; ?>
        <?php foreach ($orders as $order) { 
         $ledger_url = base_url().'order/view_orders/'.$order['order_by'].'/'.$order['date_created'].'/'.$option;
        
         ?>
        
              <tr>
<!--              <td><?php // echo $order['order_id']?></td>-->
              <td><?php echo $order['station_id']?></td>
              <td><?php echo $order['date_created']?></td>
              <td style="color:red">Pending</td>
              <td><a href="<?php  echo $ledger_url ?>" class="btn btn-danger btn-xs">View <i class="fa fa-eye"></i></a></td>
<!--              <td><a href="<?php  echo $ledger_url ?>">View</a><span class="divider"> | </span><a href="#">Download</a></td>-->
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
               </div>


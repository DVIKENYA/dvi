<?php echo $this->session->flashdata('msg');  ?>
<div class="row">
  

<div class="col-lg-12 col-sm-12">
 <div class="panel default blue_title h2">

              <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab">
                
                  <li class="active"><a data-toggle="tab" href="#tab1"><b>Requests to me</b></a></li>
                  
                </ul>
                <div class="tab-content">
                  <div id="tab" class="tab-pane fade in active">
                   <form>
<!--Listing Placed Orders-->


    <table class="table table-bordered table-striped" id="list_orders_tbl">
        <thead>
                <tr><th>Request # </th><th>Order from</th><th>Date Created</th><th>Action</th></tr>
        </thead>

        <tbody>
          <?php $option=2 ; ?>
        <?php foreach ($orders as $order) {
        $ledger_url = base_url().'order/view_orders/'.$order['order_by'].'/'.$order['date_created'].'/'.$option.'/'.$order['order_id'].'/'.$order['status_name'];
         ?>
        
              <tr>
              <td><?php  echo $order['order_id']?></td>
              <td><?php echo $order['station_id']?></td>
              <td><?php echo $order['date_created']?></td>
              
              <td><a href="<?php  echo $ledger_url ?>" class="btn btn-danger btn-xs">View <i class="fa fa-eye"></i></a></td>
        <?php }?>
              </tr>

        </tbody>
        </table>
         <?php echo $this->pagination->create_links(); ?>
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
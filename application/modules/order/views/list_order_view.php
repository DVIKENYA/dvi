<form id="list_orders_fm">
   <a href='<?php echo site_url('order/create_order');?>' class='btn btn-info state_change' id="create_order" value="Create Order">Create Order</a>
   <hr></hr> <hr></hr>

<!--Listing Placed Orders-->
      <div><h5 class="bg-info">Placed Orders</h5></div>
      <hr></hr>

    <table class="table" id="list_orders_tbl">
        <thead>
                <tr><td>Order By </td><td>Date Created</td><td>Status</td><td>Action</td></tr>
        </thead>

        <tbody>

        <?php foreach ($orders as $order) { 
         $ledger_url = base_url().'order/view_orders/'.$order['order_by'].'/'.$order['date_created'];
         ?>
        
              <tr>
<!--              <td><?php // echo $order['order_id']?></td>-->
              <td><?php echo $order['station_id']?></td>
              <td><?php echo $order['date_created']?></td>
              <td style="color:red">Pending</td>
              <td><a href="<?php  echo $ledger_url ?>">View</a></td>
<!--              <td><a href="<?php  echo $ledger_url ?>">View</a><span class="divider"> | </span><a href="#">Download</a></td>-->
        <?php }?>
              </tr>

        </tbody>
        </table>

</form>

<script>
     var formURL="<?php echo base_url();?>order/view_orders";
    $.ajax({
              url : formURL,
              type: "POST",
              data : {
                "vaccines":$order['order_by'],
                "stock_on_hand":$order['date_created']    
             },/* dataType : json,*/
              success:function(data, textStatus, jqXHR) 
              {
                  console.log(data);
               // window.location.replace('<?php// echo base_url().'order/list_orders'?>');
                  //data: return data from server
              },
              error: function(jqXHR, textStatus, errorThrown) 
              {
                  console.log("Error");
              }
          });
</script>

<form id="list_recieved_orders_fm">
  <div>
      <ol class="breadcrumb">
        <li><a href="#">Received Orders</a></li><span class="divider">/</span>
        <li class="active"><a href="#"><?php echo $page_title;?></a></li><span class="divider">/</span>
      </ol>
    </div>
   <div>
   <a href='<?php echo site_url('admin/order_management/receive_orders');?>' class='btn btn-info state_change' id="receive_orders" value="receive_orders">Receive Orders</a>
   <hr></hr>

    <table class="table" id="list_received_orders_tbl">
<thead>
  <tr><td>Issue No</td><td>Received From </td><td>Date Received </td><td>Status</td><td>Action</td></tr>
</thead>
<tbody>
<tr><td></td><td> </td><td></td><td></td>
<td><a href="#">View</a><span class="divider"> | </span><a href="#">Edit</a></td></tr>
</tbody>
</table>
</form>
<?php
$form_attributes = array('id' => 'create_orderfm','method' =>'post');
echo form_open('order/save_order',$form_attributes);?>
                
                  <!--Place order form -->
   <div id="order_infor">

     	<table class="table table-bordered" id="store_infor_tbl">
     		<tr><td style="width:50%">Store Name : NAIROBI REGION</td><td>Last Update: </td></tr>
          <tr>
          <td>Operated : </td>
          <td>Date: <?php echo date('Y-m-d',strtotime(date('Y-m-d')));?></td>
     	</table>

   	<table class="table table-bordered" id="order_infor_tbl">
   		
   		<thead>
         <tr align="center">
          <td>Vaccine</td><td>Stock On Hand</td><td>Minimum Stock</td><td>Maximum Stock</td><td>First Expiry Date</td><td>Quantity_to_order(Doses)</td>
        </tr>
      </thead>

<?php echo form_hidden('created',date('Y-m-d',strtotime(date('Y-m-d'))));?>

         <tbody>
             	<?php foreach ($vaccines as $vaccine) { ?>
             	<tr vaccine_id="<?php echo $vaccine['ID'] ?>">
             		<td><?php echo $vaccine['Vaccine_name']?></td>
             		<td><?php $data=array('name' => 'stock_on_hand[]','id'=> 'stock_on_hand_'.$vaccine['ID'] , 'readonly'=>'readonly'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'min_stock[]','id'=> 'min_stock_'.$vaccine['ID'] , 'readonly'=>'readonly'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'max_stock[]','id'=> 'max_stock_'.$vaccine['ID'],'readonly'=>'readonly' ); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'first_expiry_date[]','id'=> 'first_expiry_date_'.$vaccine['ID'] , 'readonly'=>'readonly'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'quantity_dose[]','id'=> 'quantity_dose_'.$vaccine['ID'] ); echo form_input($data);?></td>
                <?php echo form_hidden('vaccine[]',$vaccine['ID']);?>
                
             	</tr>
             	<?php }?>
         </tbody>
   	</table>
   </div> 
   <?php 
   $data=array('name' => 'place_order','id'=> 'p_order','value' => 'Place Order');
   if ($options == "view") {
   echo form_hidden($data);   
 }
   else{
   echo form_submit($data);
   }
   echo form_close();?>

              <!--Place values on view form-->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
  <?php 

      if (!empty($orderitems)){
    foreach ($orderitems as $items) {
   ?>
        $("#stock_on_hand_<?php echo $items['vaccine_id']; ?>").val("<?php echo $items['stock_on_hand']; ?>");
        $("#min_stock_<?php echo $items['vaccine_id']; ?>").val("<?php echo $items['min_stock']; ?>");
        $("#max_stock_<?php echo $items['vaccine_id']; ?>").val("<?php echo $items['max_stock']; ?>");
        $("#first_expiry_date_<?php echo $items['vaccine_id']; ?>").val("<?php echo $items['first_expiry']; ?>");
        $("#quantity_dose_<?php echo $items['vaccine_id']; ?>").val("<?php echo $items['qty_order_doses']; ?>");
        $("#quantity_dose_<?php echo $items['vaccine_id']; ?>").attr("readonly","readonly");
        
<?php }} ?>
});
</script>

<?php
$form_attributes = array('id' => 'create_orderfm','method' =>'post');
echo form_open('order/save_order',$form_attributes);?>
   <div>
      <ol class="breadcrumb">
         <li><a href="#">Vaccines</a></li><span class="divider">/</span>
          <li class="active"><a href="#"></a></li><span class="divider">/</span>
    </ol>
    </div>
   
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
         <tbody>
         	<?php foreach ($vaccines as $vaccine) { ?>
         	<tr vaccine_id="<?php echo $vaccine['ID'] ?>">
         		<td><?php echo $vaccine['Vaccine_name']?></td>
         		<td><?php $data=array('name' => 'stock_on_hand[]','id'=> 'stock_on_hand_'.$vaccine['ID'] , 'readonly'=>'readonly'); echo form_input($data);?></td>
         		<td><?php $data=array('name' => 'min_stock[]','id'=> 'min_stock_'.$vaccine['ID'] , 'readonly'=>'readonly'); echo form_input($data);?></td>
         		<td><?php $data=array('name' => 'max_stock[]','id'=> 'max_stock_'.$vaccine['ID'] ); echo form_input($data);?></td>
         		<td><?php $data=array('name' => 'first_expiry_date[]','id'=> 'first_expiry_date_'.$vaccine['ID'] , 'readonly'=>'readonly'); echo form_input($data);?></td>
         		<td><?php $data=array('name' => 'quantity_dose[]','id'=> 'quantity_dose_'.$vaccine['ID'] ); echo form_input($data);?></td>
            <?php echo form_hidden('vaccine[]',$vaccine['ID']);?>
            <?php echo form_hidden('created[]','date_created');?>
         	</tr>
         	<?php }?>
         </tbody>
   	</table>
   </div> 
   <?php 
   echo form_submit('place_order','Place Order');
   echo form_close();?>
<!-- 
<?php foreach ($orderitems as $items) { 
  echo "<pre>";
print_r($items['vaccine_id']);
}?> -->
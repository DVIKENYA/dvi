<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
$form_attributes = array('id' => 'create_orderfm','method' =>'post');
echo form_open('order/save_order',$form_attributes);

$region = Modules::run('template/getUserRegion');
$county = Modules::run('template/getUserCounty');
$subcounty = Modules::run('template/getUserSubcounty');

if($region==$user_object['user_statiton']){
  echo form_hidden('order_destination', 'KENYA');
}elseif ($county==$user_object['user_statiton']) {
  echo form_hidden('order_destination', $region);
}elseif ($subcounty==$user_object['user_statiton']) {
  echo form_hidden('order_destination', $county);
}
?>               
                  <!--Place order form -->
   <div id="order_infor">

      <table class="table table-bordered" id="store_infor_tbl">
          <td>Order By : <?php echo $user_object['user_statiton']; ?> </td>
          <td>Order To : <?php echo $user_object['statiton_above']; ?> </td>
          <td>Date: <?php echo date('Y-m-d',strtotime(date('Y-m-d')));?></td>
      </table>
    <div id="order">
    <table class="table table-bordered" >
      
      <thead>
         <tr align="center">
          <td>Vaccine</td><td>Stock On Hand</td><td>Minimum Stock</td><td>Maximum Stock</td><td>First Expiry Date</td><td>Quantity to order(Doses)</td>
        </tr>
      </thead>

<?php echo form_hidden('created',date('Y-m-d',strtotime(date('Y-m-d'))));
$user_id = ($this->session->userdata['logged_in']['user_id']);
echo form_hidden('user',$user_id);
$station = ($this->session->userdata['logged_in']['user_id']);
echo form_hidden('station',$station);
?>

         <tbody>
              <?php
              foreach ($vaccines as $vaccine) {?>
              <tr vaccine_id="<?php echo $vaccine['ID'] ?>">
                <td><?php echo $vaccine['Vaccine_name']?></td>
                <td><?php $data=array('name' => 'stock_on_hand[]','id'=> 'stock_on_hand_'.$vaccine['ID'] , 'class'=>'form-control stock_on_hand_','readonly'=>'readonly'); echo form_input($data);?></td>
                <td><?php $data=array('name' => 'min_stock[]','id'=> 'min_stock_'.$vaccine['ID'] ,'class'=>'form-control min_stock_', 'readonly'=>'readonly'); echo form_input($data);?></td>
                <td><?php $data=array('name' => 'max_stock[]','id'=> 'max_stock_'.$vaccine['ID'],'class'=>'form-control max_stock_','readonly'=>'readonly' ); echo form_input($data);?></td>
                <td><?php $data=array('name' => 'first_expiry_date[]','id'=> 'first_expiry_date_'.$vaccine['ID'] , 'class'=>'form-control first_expiry_date_','readonly'=>'readonly'); echo form_input($data);?></td>
                <td><?php $data=array('name' => 'quantity_dose[]','tabindex' => $vaccine['ID'],'id'=> 'quantity_dose_'.$vaccine['ID'],'type'=> 'number'); echo form_input($data);?></td>
                <?php echo form_hidden('vaccine[]',$vaccine['ID']);?>
                
              </tr>
              <?php }?>
         </tbody>
    </table>
    </div>
   </div> 

   <?php 
   $data=array('name' => 'place_order','id'=> 'p_order','value' => 'Place Request','class'=>'btn btn-sm btn-danger');
    echo form_submit($data);
    echo form_close();
   ?>

<!--Place values on view form-->

<script>
    <?php
    foreach ($order_vaccines as $order_v){
    ?>
    var stock = $("#stock_on_hand_<?php echo $order_v['ID']; ?>");
    stock.val("<?php echo $order_v['stock_on_hand']; ?>");
    $("#first_expiry_date_<?php echo $order_v['ID']; ?>").val("<?php echo $order_v['first_expiry_date']; ?>");
    var min = $("#min_stock_<?php echo $order_v['ID']; ?>");
    min.val(Math.ceil("<?php echo $order_v['minstock']; ?>"));
    var max = $("#max_stock_<?php echo $order_v['ID']; ?>");
    max.val(Math.ceil("<?php echo $order_v['maxstock']; ?>"));
    var quantity = $("#quantity_dose_<?php echo $order_v['ID']; ?>");
    var doses = (max.val())-stock.val();
    quantity.val(doses);
    console.log(doses);
    <?php }?>
</script>

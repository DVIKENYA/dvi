<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <div id="order_infor">

          <table class="table table-bordered" id="store_infor_tbl">
            <tr><td style="width:50%">Store Name  : <?php echo $user_object['user_statiton']; ?> </td>
            <td>Last Update: <?php echo date('Y-m-d',strtotime(date('Y-m-d')));?> </td></tr>
              <tr>
              <td>Order By : <?php echo $user_object['user_statiton']; ?> </td>
              <td>Date: <?php echo date('Y-m-d',strtotime(date('Y-m-d')));?></td>
          </table>
          </div>
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
              <?php foreach ($vaccines as $vaccine) { ?>
              <tr vaccine_id="<?php echo $vaccine['ID'] ?>">
                <td><?php echo $vaccine['Vaccine_name']?></td>
                <td><?php $data=array('name' => 'stock_on_hand[]','id'=> 'stock_on_hand_'.$vaccine['ID'] , 'class'=>'form-control stock_on_hand_','readonly'=>'readonly'); echo form_input($data);?></td>
                <td><?php $data=array('name' => 'min_stock[]','id'=> 'min_stock_'.$vaccine['ID'] ,'class'=>'form-control min_stock_', 'readonly'=>'readonly'); echo form_input($data);?></td>
                <td><?php $data=array('name' => 'max_stock[]','id'=> 'max_stock_'.$vaccine['ID'],'class'=>'form-control max_stock_','readonly'=>'readonly' ); echo form_input($data);?></td>
                <td><?php $data=array('name' => 'first_expiry_date[]','id'=> 'first_expiry_date_'.$vaccine['ID'] , 'class'=>'form-control first_expiry_date_','readonly'=>'readonly'); echo form_input($data);?></td>
                <td><?php $data=array('name' => 'quantity_dose[]','id'=> 'quantity_dose_'.$vaccine['ID'] ); echo form_input($data);?></td>
                <?php echo form_hidden('vaccine[]',$vaccine['ID']);?>
                
              </tr>
              <?php }?>
         </tbody>
    </table>
    </div>
   </div> 



  </div>

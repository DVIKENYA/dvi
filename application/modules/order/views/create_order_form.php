<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
$form_attributes = array('id' => 'create_orderfm','method' =>'post');
echo form_open('order/save_order',$form_attributes);?>
                
                  <!--Place order form -->
   <div id="order_infor">

     	<table class="table table-bordered" id="store_infor_tbl">
     		<tr><td style="width:50%">Store Name  : <?php echo $user_object['user_statiton']; ?> </td>
        <td>Last Update: <?php echo date('Y-m-d',strtotime(date('Y-m-d')));?> </td></tr>
          <tr>
          <td>Order By : <?php echo $user_object['user_statiton']; ?> </td>
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

   <?php 
   $data=array('name' => 'place_order','id'=> 'p_order','value' => 'Place Order','class'=>'btn btn-sm btn-danger');
    echo form_submit($data);
    echo form_close();
   ?>

<!--Place values on view form-->

<script>
    <?php
    foreach ($order_vaccines as $order_v){
    ?>
    $("#stock_on_hand_<?php echo $order_v['ID']; ?>").val("<?php echo $order_v['stock_on_hand']; ?>");
    $("#first_expiry_date_<?php echo $order_v['ID']; ?>").val("<?php echo $order_v['first_expiry_date']; ?>");
    $("#min_stock_<?php echo $order_v['ID']; ?>").val("<?php echo $order_v['minstock']; ?>");
    $("#max_stock_<?php echo $order_v['ID']; ?>").val("<?php echo $order_v['maxstock']; ?>");
    <?php }?>


        // When a user selects a vaccine get the selected vaccines fetch the values from the database
        
        $(document).on( 'click','.vaccine', function () {
	         var order_row=$(this);
		 		   var selected_vaccine=order_row.val();
           var selected_months= $('#order_infor').find('.order_months').val();

		   load_vaccine_infor(selected_vaccine,order_row,selected_months);
		});

		function load_vaccine_infor(selected_vaccine,order_row,selected_months){
		
			       var _url="<?php echo base_url();?>order/get_order_values";
						
			       var request=$.ajax({
			     url: _url,
			     type: 'post',
			     data: {"selected_vaccine":selected_vaccine},

			    });
			    request.done(function(data){
			    	data=JSON.parse(data);
			    	console.log(data);
			    	$.each(data,function(key,value){
                                    
                console.log(key);
                console.log(value);
                console.log(selected_months);

                var period_stock=(value.Wastage_factor * value.Doses_required* value.population_one)/12;
                var max_stock=Math.ceil(1.25* period_stock);
                var min_stock=Math.ceil(0.25* period_stock);
                var quantity_order= Math.ceil(max_stock- value.stock_balance);
                order_row.closest("tr").find(".stock_on_hand_").val(value.stock_balance);
                order_row.closest("tr").find(".first_expiry_date_").val(value.first_expiry_date);
                order_row.closest("tr").find(".max_stock_").val(max_stock);
                order_row.closest("tr").find(".min_stock_").val(min_stock);
                order_row.closest("tr").find(".quantity_dose_").val(quantity_order);

			    		
			    		
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
		}


</script>

<?php
$form_attributes = array('id' => 'create_orderfm','method' =>'post');
echo form_open('',$form_attributes);?>
                
                  <!--Place order form -->
   <div id="order_infor">

     	<table class="table table-bordered" id="store_infor_tbl">
            <?php $county = Modules::run('template/getUserCounty');
            $subcounty = Modules::run('template/getUserSubcounty');?>
     		<tr><td style="width:50%">Store Name  : <?php echo $user_object['user_statiton']; ?> </td><td>Last Update: <?php echo date('Y-m-d',strtotime(date('Y-m-d')));?> </td></tr>
          <tr>
          <td>Order By : <?php echo $user_object['user_statiton']; ?> </td>
          <td>Date: <?php echo date('Y-m-d',strtotime(date('Y-m-d')));?></td>
         <!-- <td> Select Months to order
              <select name="order_months" id="order_months" class="form-control order_months">
                     <option value="">--Select Months to order--</option>
                     <?php for($i = 1; $i<=12; $i++){
                       echo "<option value='".$i."'>".$i."</option>";
                      } ?>
          </select></td>-->
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

          <tr align="center" order_row="1">
          
          <td> <select name="vaccine" class="form-control vaccine" id="vaccine">
                     <option value="">--Select One--</option>
                     <?php foreach ($vaccines as $vaccine) { 
                         echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
                         }?>
                    </select></td>
                    
                    <td><?php $data=array('name' => 'stock_on_hand','id'=> 'stock_on_hand' , 'class'=>'form-control stock_on_hand_','readonly'=>'readonly'); echo form_input($data);?></td>
                    <td><?php $data=array('name' => 'min_stock','id'=> 'min_stock' , 'class'=>'form-control min_stock_', 'readonly'=>'readonly'); echo form_input($data);?></td>
                    <td><?php $data=array('name' => 'max_stock','id'=> 'max_stock', 'class'=>'form-control max_stock_', 'readonly'=>'readonly' ); echo form_input($data);?></td>
                    <td><?php $data=array('name' => 'first_expiry_date','id'=> 'first_expiry_date' , 'class'=>'form-control first_expiry_date_', 'readonly'=>'readonly'); echo form_input($data);?></td>
                    <td><?php $data=array('name' => 'quantity_dose','id'=> 'quantity_dose', 'class'=>'form-control quantity_dose_', ); echo form_input($data);?></td>
                    <td ><a href="#" class="add"><span class="label label-success"><i class="fa  fa-plus-square"></i> <b>ADD</b></span></a><span class="divider">  </span><a href="#" class="remove"><span class="label label-danger"><i class="fa  fa-minus-square"></i> <b>REMOVE</b></span></a></td>

          </tr>

        </tbody>
   	</table>
    </div>
   </div> 
   <button type="submit" name="place_order" id="place_order" class="btn btn-sm btn-danger">Place Order</button>
   <?php 
echo form_close();
   ?>

<!--Place values on view form-->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script>
 $(document).on( 'click','#order .add', function () {

              var thisRow =$('#order tr:last');
              var cloned_object = $(thisRow).clone();

              var order_row = cloned_object.attr("order_row");
              var next_order_row = parseInt(order_row) + 1;
              cloned_object.attr("order_row", next_order_row);
                      
              var stock_id = "stock_on_hand" + next_order_row;
              var stock_on_hand = cloned_object.find(".stock_on_hand_");
              stock_on_hand.attr('id',stock_id);
                     
              var min_stock_id = "min_stock" + next_order_row;
              var min_stock = cloned_object.find(".min_stock_");
              min_stock.attr('id',min_stock_id);

              var max_stock_id = "max_stock" + next_order_row;
              var max_stock = cloned_object.find(".max_stock_");
              max_stock.attr('id',max_stock_id);

              var first_expiry_date_id = "first_expiry_date" + next_order_row;
              var first_expiry_date = cloned_object.find(".first_expiry_date_");
              first_expiry_date.attr('id',first_expiry_date_id);

              var quantity_dose_id = "quantity_dose" + next_order_row;
              var quantity_dose = cloned_object.find(".quantity_dose_");
              quantity_dose.attr('id',quantity_dose_id);

              cloned_object .insertAfter( thisRow ).find( 'input' ).val( '' );
             
                });
// Remove a row from the form
           $('#order').delegate('.remove', 'click', function(){
             $(this).closest('tr').remove();});


 $("#create_orderfm").submit(function(e){

          e.preventDefault();//STOP default action
          var vaccine_count=0;
          $.each($(".vaccine"), function(i, v) {
                   vaccine_count++;
          });

       
       var formURL="<?php echo base_url();?>order/save_order";
       
       
       var vaccines = retrieveFormValues_Array('vaccine');
       var stock_on_hand = retrieveFormValues_Array('stock_on_hand');
       var min_stock = retrieveFormValues_Array('min_stock');
       var max_stock = retrieveFormValues_Array('max_stock');
       var first_expiry_date = retrieveFormValues_Array('first_expiry_date');
       var quantity_dose = retrieveFormValues_Array('quantity_dose');
       var date_created=retrieveFormValues('created');
       var user_id=retrieveFormValues('user');
       var station_id=retrieveFormValues('station');
       
        for(var i = 0; i < vaccine_count; i++) {
          var get_vaccine=vaccines[i];
          var get_stock_on_hand=stock_on_hand[i];
          var get_min_stock=min_stock[i];
          var get_max_stock=max_stock[i];
          var get_first_expiry_date=first_expiry_date[i];
          var get_quantity_dose=quantity_dose[i];
          var get_date_created=date_created;
          var get_user=user_id;
          var get_station=station_id;
        
        $.ajax({
              url : formURL,
              type: "POST",
              data : {
                "vaccines":get_vaccine,
                "stock_on_hand":get_stock_on_hand,
                "min_stock":get_min_stock,
                "max_stock":get_max_stock,
                "first_expiry_date":get_first_expiry_date,
                "quantity_dose":get_quantity_dose,
                "created":get_date_created,
                "user":get_user,
                "station":get_station
              },/* dataType : json,*/
              success:function(data, textStatus, jqXHR) 
              {
                  console.log(data);
                window.location.replace('<?php echo base_url().'order/list_orders'?>');
                  //data: return data from server
              },
              error: function(jqXHR, textStatus, errorThrown) 
              {
                  console.log("Error");
              }
          });
     }
       e.unbind(); //unbind. to stop multiple form submit.
           });

     //This function loops the whole form and saves all the input, select, e.t.c. elements with their corresponding values in a javascript array for processing

           function retrieveFormValues(name) {
                      var dump;
                        $.each($("input[name=" + name + "], select[name=" + name + "]"), function(i, v) {
                            var theTag = v.tagName;
                            var theElement = $(v);
                            var theValue = theElement.val();
                            dump = theValue;
                        });
                      return dump;
            }
  
          function retrieveFormValues_Array(name) {
                var dump = new Array();
                var counter = 0;
                  $.each($("input[name=" + name + "], select[name=" + name + "]"), function(i, v) {
                      var theTag = v.tagName;
                      var theElement = $(v);
                      var theValue = theElement.val();
                      /*dump[counter] = theElement.attr("value");*/
                      dump[counter] = theValue;

                      counter++;
                  });
                return dump;
        }
        // When a user selects a vaccine get the selected vaccines fetch the values from the database
        
        $(document).on( 'click','.vaccine', function () {
	           var order_row=$(this);
		 /*  var selected_vaccine=$(this).val();*/
		   var selected_vaccine=order_row.val();
                   var selected_months= $('#order_infor').find('.order_months').val();
                   
		    //alert(selected_vaccine);
		   load_vaccine_infor(selected_vaccine,order_row,selected_months);
		});
//        $(document).on( 'change','order_months', function () {
//	           var order_row=$(this);
//		 /*  var selected_vaccine=$(this).val();*/
//		   var selected_months=order_row.val();
//                    var selected_vaccine=$('#order_infor').find('.vaccine').val();
//		    //alert(selected_months);
//		   //load_vaccine_infor(selected_months);
//                   load_vaccine_infor(selected_vaccine,order_row,selected_months);
//		});

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
			    	//stock_row.closest("tr").find(".batch_no option").remove();
			    	//stock_row.closest("tr").find(".expiry_date ").val("");
			    	//stock_row.closest("tr").find(".available_quantity").val("");
			    	//stock_row.closest("tr").find(".vvm_s").val("");
			    	//stock_row.closest("tr").find(".batch_no ").append("<option value='0'>Select batch </option> ");
			    	$.each(data,function(key,value){
                                    
                                    console.log(key);
                                    console.log(value);
                                    //console.log(value.batch_number);
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

			    		
			    		/*value[0].batch_number;*/
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
		}


</script>

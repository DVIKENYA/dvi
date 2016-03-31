<div class="row">
    <div class="col-lg-12">
<?php
$form_attributes = array('id' => 'physical_stock_fm','class'=>'form-inline','role'=>'form');
echo form_open('',$form_attributes);?>

<div id="physical_stock">
<div class="table-responsive">
<table class="table table-bordered table-hover table-striped">

<style type="text/css">
	input[id="available_quantity"]{
	 background-color: #E0F2F7 !important 
	}
	td .cells{
		width: 80% !important ;
	}

	.span {
		margin-bottom:5px;
		display: table-cell;
	}
    



</style>
	<thead>
		<th align="center">Vaccine Name</th>
		<th >Batch Number</th>
		<th >Expiry Date</th>
		<th >Date of count</th>
		<th >Available Quantity</th>
		<th > Physical Count</th>
		<th>Action</th>
							
							
	</thead>
	<tbody>
		
             	<tr physical_row="1">
             	<input type="hidden" name ="transaction_type" class="transaction_type" value="2">
                     <td> <select name="vaccine" class="form-control vaccine" id="vaccine" required>
		                 <option value="" selected="selected">Select Vaccine</option>
		                 <?php foreach ($vaccines as $vaccine) { 
		                     echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
		                     }?>
                        </select>
                     </td>
             		<td> <select name="batch_no" class="form-control batch_no" id="batch_no" required ></select></td>
             		<td><?php $data=array('name' => 'expiry_date','id'=> 'expiry_date','class'=>'form-control expiry_date cells','disabled'=>''); echo form_input($data);?></td>
             		 
             		<td> <?php $data = array('name' => 'date_of_count', 'required' => 'true', 'id' => 'date_of_count', 'required' => 'true', 'class' => 'form-control date_of_count cells'); echo form_input($data); ?></td>
             		<td><?php $data=array('name' => 'available_quantity','id'=> 'available_quantity','class'=>'form-control available_quantity cells','disabled'=>'','required'=>'' ); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'physical_count','required'=>'true','type'=>'Number', 'min'=>'0','id'=>'physical_count' ,'class'=>'form-control physical_count cells','required'=>'' ); echo form_input($data);?></td>
					<td hidden><?php $data=array('name' => 'row_id','id'=> 'row_id','class'=>'form-control row_id' , 'hidden'=>'' ); echo form_input($data);?></td>
             		<td class="small">
                                <a href="#" class="add btn"><span class="label label-success"><i
                                            class="fa fa-plus-square"></i> <b>ADD</b></span></a><br>
                                <a href="#" class="remove btn"><span class="label label-danger"><i
                                            class="fa  fa-minus-square"></i> <b>REMOVE</b></span></a>
                     </td>
             	</tr>
             	
	</tbody>
</table>
</div>

<input type="button" name="btn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-danger" value="Submit"/>

<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to submit the entered details?
            <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                   <button type="submit" name="physical_stock_fm" id="physical_stock_fm" class="btn btn-sm btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </div>  
</div>


<?php echo form_close();?>
</div>
</div>
</div>

 
<script type="text/javascript">



			$('#date_of_count').datepicker({dateFormat: "yy-mm-dd", maxDate: 0}).datepicker('setDate', null);
			// Add another row in the form on click add

           $('#physical_stock').delegate( '.add', 'click', function () {

             var thisRow =$('#physical_stock tr:last');
              var cloned_object = $( thisRow ).clone();

              var physical_row = cloned_object.attr("physical_row");
			  var next_physical_row = parseInt(physical_row) + 1;
			   cloned_object.attr("physical_row", next_physical_row);
                
                var vaccine_id = "vaccine" + next_physical_row;
			    var vaccine = cloned_object.find(".vaccine");
				vaccine.attr('id',vaccine_id);
               
               var batch_id = "batch_no" + next_physical_row;
			    var batch = cloned_object.find(".batch_no");
				batch.attr('id',batch_id);

				var expiry_id = "expiry_date" + next_physical_row;
				var expiry = cloned_object.find(".expiry_date");
				expiry.attr('id',expiry_id);

				var count_id = "date_of_count" + next_physical_row;
				var count = cloned_object.find(".date_of_count");
				count.removeClass("hasDatepicker").attr('id', count_id).datepicker({
		            dateFormat: "yy-mm-dd",
		            maxDate: 0,
		            setDate: null
		        });
				var available_quantity_id = "available_quantity" + next_physical_row;
			    var available_quantity = cloned_object.find(".available_quantity");
				available_quantity.attr('id',available_quantity_id);

				var physical_count_id = "physical_count" + next_physical_row;
			    var physical_count = cloned_object.find(".physical_count");
				physical_count.attr('id',physical_count_id);


				var row_id = "row_id" + next_physical_row;
			    var id = cloned_object.find(".row_id");
				id.attr('id',row_id);

                cloned_object .insertAfter( thisRow ).find( 'input' ).val( '' );
             
                });
// Remove a row from the form
           $('#physical_stock').delegate('.remove', 'click', function(){
             $(this).closest('tr').remove();});


           $("#physical_stock_fm").submit(function(e)
         {
			         	e.preventDefault();//STOP default action
			         	var vaccine_count=0;
			         	$.each($(".vaccine"), function(i, v) {
			                   vaccine_count++;
			         	});

		   
		   var formURL="<?php echo base_url();?>stock/save_physical_count";

		   var vaccines = retrieveFormValues_Array('vaccine');
		   var batch_no = retrieveFormValues_Array('batch_no');
		   var expiry_date = retrieveFormValues_Array('expiry_date');
		   var count_date = retrieveFormValues_Array('date_of_count');
		   var available_quantity = retrieveFormValues_Array('available_quantity');
		   var physical_count = retrieveFormValues_Array('physical_count');
		   var id = retrieveFormValues_Array('row_id');



		   	for(var i = 0; i < vaccine_count; i++) {
		   		var get_vaccine=vaccines[i];
		   		var get_batch=batch_no[i];
		   		var get_expiry=expiry_date[i];
		   		var get_date=count_date[i];
		   		var get_quantity=available_quantity[i];
				var get_count=physical_count[i];
				var get_id=id[i];

					    $.ajax(
					    {
					        url : formURL,
					        type: "POST",
					        data : {"vaccine":get_vaccine,"batch_no":get_batch,"expiry_date":get_expiry,"date_of_count":get_date,"available_quantity":get_quantity,"physical_count":get_count,"id":get_id},
					       
					     success:function(data, textStatus, jqXHR) 
					        {
					        	window.location.replace('<?php echo base_url().'stock/list_inventory'?>');
					            //data: return data from server
					        },
					     error: function(jqXHR, textStatus, errorThrown) 
					        {
					            //if fails      
					        }
					    });
		 }
		   // e.unbind(); //unbind. to stop multiple form submit.
           });

		
			$(document).on( 'change','.vaccine', function () {
				var stock_row=$(this);
				var selected_vaccine=$(this).val();
				load_batches(selected_vaccine,stock_row);
		     });

		function load_batches(selected_vaccine,stock_row){
		
				var _url="<?php echo base_url();?>stock/get_batches";
						
							var request=$.ajax({
								     url: _url,
								     type: 'post',
								     data: {"selected_vaccine":selected_vaccine},

						    });

				    request.done(function(data){
					    	data=JSON.parse(data);
					    	console.log(data);
					    	stock_row.closest("tr").find(".batch_no option").remove();
					    	stock_row.closest("tr").find(".expiry_date ").val("");
					    	stock_row.closest("tr").find(".available_quantity").val("");
					    	stock_row.closest("tr").find(".physical_count").val("");
					    	stock_row.closest("tr").find(".row_id").val("");
					    	stock_row.closest("tr").find(".batch_no ").append("<option value=''>Select batch </option> ");
				    $.each(data,function(key,value){
				    		stock_row.closest("tr").find(".batch_no").append("<option value='"+value.batch_number+"'>"+value.batch_number+"</option> ");
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
		}
		
		
			$(document).on( 'change','.batch_no', function () {
				   var stock_row=$(this);
				   var selected_batch=$(this).val();
			     batch_details(selected_batch,stock_row);
		});

		function batch_details(selected_batch,stock_row){
					var _url="<?php echo base_url();?>stock/get_batch_details";
								
						var request=$.ajax({
							     url: _url,
							     type: 'post',
							     data: {"selected_batch":selected_batch},

					    });
					    request.done(function(data){
								    	data=JSON.parse(data);
								    	console.log(data);
								    	stock_row.closest("tr").find(".expiry_date ").val("");
								    	stock_row.closest("tr").find(".available_quantity").val("");
								    	stock_row.closest("tr").find(".physical_count").val("");
								    	stock_row.closest("tr").find(".row_id").val("");
								    	
					    $.each(data,function(key,value){
					    		stock_row.closest("tr").find(".expiry_date").val(value.expiry_date);
					    		stock_row.closest("tr").find(".available_quantity").val(value.stock_balance);
								stock_row.closest("tr").find(".row_id").val(value.receive_id);
					    });
					                                });
					    request.fail(function(jqXHR, textStatus) {
						  
						});
		}

		 //This function loops the whole form and saves all the input, select, e.t.c. elements with their corresponding values in a javascript array for processing

          function retrieveFormValues_Array(name) {
                      var dump = new Array();
                      var counter = 0;
              $.each($("input[name=" + name + "], select[name=" + name + "]"), function(i, v) {
                            var theTag = v.tagName;
                            var theElement = $(v);
                            var theValue = theElement.val();
                            dump[counter] = theValue;

                            counter++;
                });
                      return dump;
            }

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

</script>


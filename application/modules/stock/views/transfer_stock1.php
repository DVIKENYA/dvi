<?php
$form_attributes = array('id' => 'transferstock_fm','method' =>'post');
echo form_open('',$form_attributes);?>
<table>
<p class="bg-info"> Transaction Details</p>
	<thead> 
	                        <th style="width:50%;" class="small" align="center"> Transfer To</th>
							<th style="width:50%;" class="small">Date Of Transfer </th>

	</thead>
	<tbody>
		<tr>
			<td><?php $data=array('name' => 'issued_to','id'=> 'issued_to','class'=>'col-xs-20 issued_to'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'date_issued','id'=>'date_issued','class'=>'col-xs-11 date_issued','type'=>'date'); echo form_input($data);?></td>
		</tr>
	</tbody>
</table>
<table>
	
</table>
<hr></hr><hr></hr>
<div id="stock_issue">
	 <p class="bg-info"> Vaccine Details</p> 
	<table class="table"  >
		<thead>

			                <th style="width:17%;" class="small" align="center">Vaccine/Diluents</th>
							<th style="width:14%;" class="small">Batch No.</th>
							<th style="width:2%;" class="small">Expiry&nbsp;Date</th>
							<th style="width:12%;" class="small">Amount Ordered</th>
							<th style="width:12%;" class="small">Available quantity</th>
							<th style="width:12%;" class="small">Amount Issued</th>
							<th style="width:19%;" class="small">VVM Status</th>
							<th style="width:11%" class="small">Action</th>
		</thead>
		<tbody>

			<tr align="center" issue_row="1">
			<input type="hidden" name ="transaction_type" class="transaction_type" value="2">
			<td> <select name="vaccine" class="col-xs-11 vaccine" id="vaccine">
                 <option value="">--Select One--</option>
                 <?php foreach ($vaccines as $vaccine) { 
                     echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
                     }?>
                </select></td>
                <td> <select name="batch_no" class="col-xs-12 batch_no" id="batch_no">
                
                </select></td>
                <style type="text/css">

                input[id="available_quantity"]{
                 background-color: #E0F2F7 !important
                 }</style>
             		
             		<td><?php $data=array('name' => 'expiry_date','id'=> 'expiry_date','class'=>'col-xs-11 expiry_date', 'type'=>'date'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'amt_ordered','id'=> 'amt_ordered','class'=>'col-xs-12 amt_ordered'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'available_quantity','id'=> 'available_quantity','class'=>'col-xs-12 available_quantity','readonly'=>''); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'amt_issued','id'=> 'amt_issued','class'=>'col-xs-12 amt_issued'); echo form_input($data);?></td>
             		<td>
             		<select name="vvm_status" class="vvm_s col-xs-11">
             		<option value=""> --Select One-- </option>
                    <option value="1">Stage 1</option>
                    <option value="2">Stage 2</option>
                    <option value="3">Stage 3</option>
                </select></td>
             	
             		<td class="col-xs-9 small "><a href="#" class="add"> Add </a><span class="divider"> | </span><a href="#" class="remove">Remove</a></td>

			</tr>

		</tbody>
	</table>


</div>
<input type="submit" name="stock_issue_fm" id="stock_issue_fm" value="Issue Stock">
<?php

   echo form_close();?>



   <script type="text/javascript">

 
// Add another row in the form on click add

           $('#stock_issue').delegate( '.add', 'click', function () {
           	
             var thisRow =$('#stock_issue tr:last');
              var cloned_object = $( thisRow ).clone();

              var issue_row = cloned_object.attr("issue_row");
			  var next_issue_row = parseInt(issue_row) + 1;
			   cloned_object.attr("issue_row", next_issue_row);
                
                var vaccine_id = "vaccine" + next_issue_row;
			    var vaccine = cloned_object.find(".vaccine");
				vaccine.attr('id',vaccine_id);
               
               var batch_id = "batch_no" + next_issue_row;
			    var batch = cloned_object.find(".batch_no");
				batch.attr('id',batch_id);

				var expiry_id = "expiry_date" + next_issue_row;
				var expiry = cloned_object.find(".expiry_date");
				expiry.attr('id',expiry_id);

				var amt_ordered_id = "amt_ordered" + next_issue_row;
			    var amt_ordered = cloned_object.find(".amt_ordered");
				amt_ordered.attr('id',amt_ordered_id);

				var amt_issued_id = "amt_issued" + next_issue_row;
			    var amt_issued = cloned_object.find(".amt_issued");
				amt_issued.attr('id',amt_issued_id);

				var vvm_id= "vvm" + next_issue_row;
			    var vvm_status = cloned_object.find(".vvm_s");
				vvm_status.attr('id',vvm_id);


                cloned_object .insertAfter( thisRow ).find( 'input' ).val( '' );
             
                });
// Remove a row from the form
           $('#stock_issue').delegate('.remove', 'click', function(){
             $(this).closest('tr').remove();});


           //This function loops the whole form and saves all the input, select, e.t.c. elements with their corresponding values in a javascript array for processing

           function retrieveFormValues() {
		
		  var dump = Array;
				$.each($("input, select, textarea"), function(i, v) {
					var theTag = v.tagName;
					var theElement = $(v);
					var theValue = theElement.val();
					if(theElement.attr('type') == "radio") {
						var text = 'input:radio[name=' + theElement.attr('name') + ']:checked';
						dump[theElement.attr("name")] = $(text).attr("value");
					} else {
						dump[theElement.attr("name")] = theElement.attr("value");
					}
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



	 $("#issuestock_fm").submit(function(e)
         {
         	e.preventDefault();//STOP default action
         	var vaccine_count=0;
         	$.each($(".vaccine"), function(i, v) {
                   vaccine_count++;
         	});

		   
		   var formURL="<?php echo base_url();?>stock/save_issued_stock";

		   var vaccines = retrieveFormValues_Array('vaccine');
		   var batch_no = retrieveFormValues_Array('batch_no');
		   var expiry_date = retrieveFormValues_Array('expiry_date');
		   var amt_ordered = retrieveFormValues_Array('amt_ordered');
		   var amt_issued = retrieveFormValues_Array('amt_issued');
		   var vvm_status = retrieveFormValues_Array('vvm_status');
		   var date_issued = retrieveFormValues('date_issued');
		   var issued_to= retrieveFormValues('issued_to');
		   var transaction_type= retrieveFormValues('transaction_type');



		   	for(var i = 0; i < vaccine_count; i++) {
		   		var get_vaccine=vaccines[i];
		   		var get_batch=batch_no[i];
		   		var get_expiry=expiry_date[i];
		   		var get_amt_ordered=amt_ordered[i];
		   		var get_amt_issued=amt_issued[i];
		   		var get_vvm_status=vvm_status[i];
		   		var get_date_issued=date_issued;
                var get_issued_to=issued_to;
                var get_transaction_type=transaction_type;

			    $.ajax(
			    {
			        url : formURL,
			        type: "POST",
			        data : {"transaction_type":get_transaction_type,"date_issued":get_date_issued,"issued_to":get_issued_to,"vaccine":get_vaccine,"batch_no":get_batch,"expiry_date":get_expiry,"amt_issued":get_amt_issued,"vvm_status":get_vvm_status},
			       /* dataType : json,*/
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

		$("#vaccine").change(function(){
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
			    	stock_row.closest("tr").find(".batch_no ").append("<option value='0'>Select batch </option> ");
			    	$.each(data,function(key,value){
			    		stock_row.closest("tr").find(".batch_no").append("<option value='"+value.batch_number+"'>"+value.batch_number+"</option> ");

			    		
			    		/*value[0].batch_number;*/
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
		}
		
		$(".batch_no").change(function(){
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
			    	$.each(data,function(key,value){
			    		stock_row.closest("tr").find(".expiry_date").val(value.expiry_date);
			    		stock_row.closest("tr").find(".available_quantity").val(value.stock_balance);

			    		
			    		/*value[0].batch_number;*/
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
		}


   </script>
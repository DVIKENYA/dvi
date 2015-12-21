<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
$location = array();
$location[]="Select Location";
  foreach($locations as $row ){
    $location[$row->location] = $row->location; 
  }

$order = array();
$order[]="Select Order Number";
  foreach($orders as $row ){
    $order[$row->order_id] = $row->order_id; 
  }
?>


<div class="row">
    <div class="col-lg-12">
<?php
$form_attributes = array('id' => 'issuestock_fm','method' =>'post','class'=>'','role'=>'form');
echo form_open('',$form_attributes);?>

<div class="well well-sm"><b>Transaction Details</b></div>
	
<div class="row">
	<div class="col-lg-3">
	  <div class="panel-body">
	  <b>Issue To</b>
	    <?php
        echo form_error('issued_to');
        echo form_dropdown('issued_to', $location, 'id="issued_to" class="form-control"'); 
        ?>
	   </div>
	</div>
	<div class="col-lg-3">
	  <div class="panel-body">
	  <b>S11 #</b>
	    <?php $data=array('name' => 's11','required'=>'true', 'id'=> 's11','class'=>'form-control'); echo form_input($data);?>
	    </div>
	</div>
    
    <div class="col-lg-3">
	  <div class="panel-body">
	  <b>Date Issued</b>
	   <?php  $data=array('name' => 'date_issued','required'=>'true','id'=>'datepicker','required'=>'true', 'class'=>'form-control'); echo form_input($data);?>
	   
 		</div>
	  </div>

	
<input type="hidden" name ="transaction_type" class="transaction_type" value="2">
</div>

<div id="stock_issue" class="row">
<div class="col-lg-12">
<div class="table-responsive">
<div class="well well-sm"><b>Vaccine Details</b></div>



	 
	<table class="table table-bordered table-hover table-striped">
		<thead>

			                <th style="width:12%;" class="small">Vaccine/Diluents</th>
							<th style="width:12%;" class="small">Batch No.</th>
							<th style="width:9%;" class="small">Expiry </br>Date</th>
							<th style="width:12%;" class="small">Amount </br>Ordered</th>
							<th style="width:9%;" class="small">Stock </br>Quantity</th>
							<th style="width:15%;" class="small">Amount </br>Issued</th>
							<th style="width:9%;" class="small">VVM Status</th>
							<th style="width:9%;" class="small">Action</th>
		</thead>
<tbody>
		<tr issue_row="1">
			<input type="hidden" name ="transaction_type" class="transaction_type" value="2">
            <td><select name="vaccine" class="form-control vaccine" id="vaccine" required="true">
		                 <option value="">--Select One--</option>
		                 <?php foreach ($vaccines as $vaccine) { 
		                     echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
		                     }?>
                </select></td>
            <td><select name="batch_no" class="form-control batch_no" id="batch_no" required="true"></select></td>
            <td><?php $data=array('name' => 'expiry_date','id'=> 'expiry_date','class'=>'form-control expiry_date', 'required'=>'true','readonly'=>''); echo form_input($data);?></td>
            <style type="text/css">
	            input[id="available_quantity"]{
	             background-color: #E0F2F7 !important }</style>
	        <td class="small"><?php $data=array('name' => 'amt_ordered','id'=> 'amt_ordered', 'type' =>'number',' min' => '0', 'required'=>'true','class'=>'form-control amt_ordered'); echo form_input($data);?></td>
            <td><?php $data=array('name' => 'available_quantity','id'=> 'available_quantity','class'=>'form-control available_quantity','readonly'=>'', 'value'=>'' ); echo form_input($data);?></td>
            <td><?php $data=array('name' => 'amt_issued','id'=> 'amt_issued','class'=>'form-control amt_issued', 'type' =>'number',' min' => '0','required'=>'true'); echo form_input($data);?></td>
            <td><?php $data=array('name' => 'vvm_status','id'=> 'vvm_status','class'=>'form-control vvm_s'); echo form_input($data);?></td>
            <td class="small">
		     			<a href="#" class="add btn"><span class="label label-success"><i class="fa fa-plus-square"></i> <b>ADD</b></span></a><br>
		             	<a href="#" class="remove btn" ><span class="label label-danger"><i class="fa  fa-minus-square"></i> <b>REMOVE</b></span></a>
		    </td>

           </tr>     	
             	
	</tbody>
	</table>

</div></div></div></div>


<button type="submit" name="stock_issue_fm" id="stock_issue_fm" class="btn btn-sm btn-danger">Submit</button>



<?php

   echo form_close();?>

	

   <script type="text/javascript">

 	$('#datepicker').datepicker({dateFormat: "yy-mm-dd",  maxDate: 0}).datepicker('setDate', null);
// Add another row in the form on click add

           $(document).on( 'click','#stock_issue .add', function () {

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


                cloned_object .insertAfter( thisRow ).find('input').val( '' );

                });
// Remove a row from the form
           $('#stock_issue').delegate('.remove', 'click', function(){
             $(this).closest('tr').remove();});


          

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
		   var s11 = retrieveFormValues('s11');

		   
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
                var get_s11 = s11;

			    $.ajax(
			    {
			        url : formURL,
			        type: "POST",
			        data : {"transaction_type":get_transaction_type,"issued_to":get_issued_to, "s11":get_s11, "date_issued":get_date_issued,"vaccine":get_vaccine,"batch_no":get_batch,"expiry_date":get_expiry,"amt_issued":get_amt_issued,"vvm_status":get_vvm_status},
			       /* dataType : json,*/
			        success:function(data, textStatus, jqXHR) 
			        {
			        	//console.log(data);
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
		 /*  var selected_vaccine=$(this).val();*/
		   var selected_vaccine=stock_row.val();
		   // alert(selected_vaccine);
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
			    	stock_row.closest("tr").find(".vvm_s").val("");
			    	stock_row.closest("tr").find(".batch_no ").append("<option value='0'>Select batch </option> ");
			    	$.each(data,function(key,value){
			    	stock_row.closest("tr").find(".batch_no").append("<option value='"+value.batch_number+"'>"+value.batch_number+"</option> ");

			    		
			    		/*value[0].batch_number;*/
			    		
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
			    	stock_row.closest("tr").find(".vvm_s").val("");
			    	$.each(data,function(key,value){
			    		stock_row.closest("tr").find(".expiry_date").val(value.expiry_date);
			    		stock_row.closest("tr").find(".available_quantity").val(value.stock_balance);
			    		stock_row.closest("tr").find(".vvm_s").val(value.name);
			    		stock_row.closest("tr").find(".amt_issued").attr('max', value.stock_balance);
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
		}

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
   </script>
  
<?php 
$location = array();
$location[]="Select Location";
  foreach($locations as $row ){
    $location[$row->id] = $row->location; 
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
    $form_attributes = array('id' => 'stock_received_fm','class'=>'form-horizontal','role'=>'form');
    echo form_open('',$form_attributes);?>
  </div>
</div>

<div class="well well-sm"><b>Transaction Details</b></div>
<<<<<<< HEAD

<div class="row">
<div class="col-lg-3">
  <div class="panel-body">
  <b>Received From</b>
   <?php
        echo form_error('received_from');
        echo form_dropdown('received_from', $location, 'id="received_from" class="form-control"'); 
        ?>
    </div>
</div>
<div class="col-lg-3">
  <div class="panel-body">
  <b>S11 #</b>
    <?php $data=array('name' => 's11','id'=> 's11','class'=>'form-control'); echo form_input($data);?>
    </div>
</div>
<div class="col-lg-3">
  <div class="panel-body">
  <b>Date Received</b>
   <?php $data=array('name' => 'date_received','id'=>'date_received','class'=>'form-control'); echo form_input($data);?>
    </div>
</div> 

<div class="col-lg-3">
  <div class="panel-body">
  <b>Order Number</b>
   <?php
          echo form_error('order');
          echo form_dropdown('order', $order, 'id="order" class="form-control"'); 
          ?>
    </div>
</div> 

</div>
<input type="hidden" name ="transaction_type" class="transaction_type" value="1">
=======
<div class="row">
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <b>Received From</b>
      <?php $data=array('name' => 'received_from','id'=> 'received_from','class'=>'form-control'); echo form_input($data);?>
    </div>
  </div>
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <b>S11 #</b>
      <?php $data=array('name' => 's11','id'=> 's11','class'=>'form-control'); echo form_input($data);?>
    </div>
  </div>
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <b>Date Received</b>
      <?php $data=array('name' => 'date_received','id'=>'date_received','class'=>'form-control'); echo form_input($data);?>
    </div>
  </div> 
>>>>>>> 5ce27d877dfd339616208f10ca68f5e09044c455

  <input type="hidden" name ="transaction_type" class="transaction_type" value="1">
</div>

<br/>
<div class="well well-sm"><b>Vaccine Details</b></div>
<br/>
<div class="table-responsive">


  <div id="stock_receive_tbl">

   <table class="table table-bordered  table-striped">
    <thead>

     <th align="center">Vaccine/Diluents</th>
     <th >Batch No.</th>
     <th >Expiry&nbsp;Date</th>
     <th >Quantity(doses)</th>
     <th >VVM Status</th>
     <th >Action</th>
   </thead>
   <tbody>

     <tr align="center" receive_row="1"> 

<<<<<<< HEAD
<div id="stock_receive_tbl">
	 
	<table class="table table-bordered table-hover table-striped">
		<thead>

			        <th align="center">Vaccine/Diluents</th>
							<th >Batch No.</th>
							<th >Expiry&nbsp;Date</th>
							<th >Quantity(doses)</th>
							<th >VVM Status</th>
							<th >Action</th>
		</thead>
		<tbody>

			<tr align="center" receive_row="1"> 
              
              <td> <select name="vaccine" class="vaccine form-control" id="vaccine">
                 <option value="">--Select One--</option>
                 <?php foreach ($vaccines as $vaccine) { 
                     echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
                     }?>
                </select></td>

				
             		<td><?php $data=array('name' => 'batch_no','id'=>'batch_no','class'=>'batch_no form-control'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'expiry_date','id'=> 'expiry_date','class'=>'form-control expiry_date', 'type'=>'date'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'quantity_received','id'=> 'quantity_received','class'=>'quantity_received form-control'); echo form_input($data);?></td>
             		
                <td>
                <select name="vvm_status" class=" form-control vvm_status " id="vvm_status" name="vvm_status">
                <option value=""> --Select One-- </option>
                    <option value="1">Stage 1</option>
                    <option value="2">Stage 2</option>
                    <option value="3">Stage 3</option>
                     <option value="3">Stage 4</option>
                </select></td>
             		<td ><a href="#" class="add"><span class="label label-success"><i class="fa  fa-plus-square"></i> <b>ADD</b></span></a><span class="divider">  </span><a href="#" class="remove"><span class="label label-danger"><i class="fa  fa-minus-square"></i> <b>REMOVE</b></span></a></td>
			</tr>

		</tbody>
	</table>
=======
      <td> <select name="vaccine" class="vaccine form-control" id="vaccine">
       <option value="">--Select One--</option>
       <?php foreach ($vaccines as $vaccine) { 
         echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
       }?>
     </select></td>


     <td><?php $data=array('name' => 'batch_no','id'=>'batch_no','class'=>'batch_no form-control'); echo form_input($data);?></td>
     <td><?php $data=array('name' => 'expiry_date','id'=> 'expiry_date','class'=>'form-control expiry_date', 'type'=>'date'); echo form_input($data);?></td>
     <td><?php $data=array('name' => 'quantity_received','id'=> 'quantity_received','class'=>'quantity_received form-control'); echo form_input($data);?></td>

     <td>
      <select name="vvm_status" class=" form-control vvm_status " id="vvm_status" name="vvm_status">
        <option value=""> --Select One-- </option>
        <option value="1">Stage 1</option>
        <option value="2">Stage 2</option>
        <option value="3">Stage 3</option>
        <option value="3">Stage 4</option>
      </select></td>
      <td ><a href="#" class="add"><span class="label label-success"><i class="fa  fa-plus-square"></i> <b>ADD</b></span></a><span class="divider">  </span><a href="#" class="remove"><span class="label label-danger"><i class="fa  fa-minus-square"></i> <b>REMOVE</b></span></a></td>
    </tr>

  </tbody>
</table>
>>>>>>> 5ce27d877dfd339616208f10ca68f5e09044c455


</div>

<button type="submit" name="stock_receivedstock_received" id="stock_received" class="btn btn-sm btn-danger">Receive Stock</button>

<?php
echo form_close();?>
</div>
<script type="text/javascript">

 $('#date_received').datepicker().datepicker('setDate', new Date());

 $('#stock_receive_tbl').delegate( '.add', 'click', function () {

   var thisRow =$('#stock_receive_tbl tr:last');
   var cloned_object = $( thisRow ).clone();

<<<<<<< HEAD
             $('#date_received').datepicker().datepicker('setDate', new Date());
             $('#expiry_date').datepicker({dateFormat: "yy-mm-dd",  minDate: 0}).datepicker('setDate', null);
              $('#stock_receive_tbl').delegate( '.add', 'click', function () {
            
                       var thisRow =$('#stock_receive_tbl tr:last');
                       var cloned_object = $( thisRow ).clone();
=======
   var receive_row = cloned_object.attr("receive_row");
   var next_receive_row = parseInt(receive_row) + 1;
   cloned_object.attr("receive_row", next_receive_row);

   var vaccine_id = "vaccine" + next_receive_row;
   var vaccine = cloned_object.find(".vaccine");
   vaccine.attr('id',vaccine_id);
>>>>>>> 5ce27d877dfd339616208f10ca68f5e09044c455

   var batch_id = "batch_no" + next_receive_row;
   var batch = cloned_object.find(".batchno_");
   batch.attr('id',batch_id);

   var expiry_id = "expiry_date" + next_receive_row;
   var expiry = cloned_object.find(".expiry_date");
   expiry.attr('id',expiry_id);

   var quantity_received_id = "quantity_received" + next_receive_row;
   var quantity_received = cloned_object.find(".quantity_received");
   quantity_received.attr('id',quantity_received_id);

<<<<<<< HEAD
                      var expiry_id = "expiry_date" + next_receive_row;
                      var expiry = cloned_object.find(".expiry_date");
                      expiry.attr('id',expiry_id);
                      
                      var quantity_received_id = "quantity_received" + next_receive_row;
                      var quantity_received = cloned_object.find(".quantity_received");
                      quantity_received.attr('id',quantity_received_id);
=======
   var vvm_status_id = "vvm_status" + next_receive_row;
   var vvm_status = cloned_object.find(".vvm_status");
   vvm_status.attr('id',vvm_status_id);

   cloned_object .insertAfter( thisRow ).find( 'input' ).val( '' );
>>>>>>> 5ce27d877dfd339616208f10ca68f5e09044c455

 });

<<<<<<< HEAD
                cloned_object .insertAfter( thisRow ).find( 'input' ).val( '' );
                });
=======
 $('#stock_receive_tbl').delegate('.remove', 'click', function(){
   $(this).closest('tr').remove();});
>>>>>>> 5ce27d877dfd339616208f10ca68f5e09044c455


 

 $("#stock_received_fm").submit(function(e)
 {
          e.preventDefault();//STOP default action
          var vaccine_count=0;
          $.each($(".vaccine"), function(i, v) {
           vaccine_count++;
         });


          var formURL="<?php echo base_url();?>stock/save_received_stock";

          var vaccines = retrieveFormValues_Array('vaccine');
          var batch_no = retrieveFormValues_Array('batch_no');
          var expiry_date = retrieveFormValues_Array('expiry_date');
          var quantity_received = retrieveFormValues_Array('quantity_received');
          var vvm_status = retrieveFormValues_Array('vvm_status');
          var date_received = retrieveFormValues('date_received');
          var received_from= retrieveFormValues('received_from');
          var transaction_type= retrieveFormValues('transaction_type');

          for(var i = 0; i < vaccine_count; i++) {
            var get_vaccine=vaccines[i];
            var get_batch=batch_no[i];
            var get_expiry=expiry_date[i];
            var get_quantity_received=quantity_received[i];
            var get_vvm_status=vvm_status[i];
            var get_date_received=date_received;
            var get_received_from=received_from;
            var get_transaction_type=transaction_type;

            $.ajax(
            {
              url : formURL,
              type: "POST",
              data : {"transaction_type":get_transaction_type,"date_received":get_date_received,"received_from":get_received_from,"vaccine":get_vaccine,"batch_no":get_batch,"expiry_date":get_expiry,"quantity_received":get_quantity_received,"vvm_status":get_vvm_status},
              /* dataType : json,*/
            // url : "<?php echo site_url("stock/list_inventory"); ?>";
            success:function(data, textStatus, jqXHR) 
            {
                  //data: return data from server
                  
                  window.location.replace('<?php echo base_url().'stock/list_inventory'?>');



                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                  //if fails      
                }
              });
          }
       // e.unbind(); //unbind. to stop multiple form submit.
     });

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
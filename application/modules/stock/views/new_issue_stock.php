<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
<?php
$form_attributes = array('id' => 'issuestock_fm','method' =>'post','class'=>'','role'=>'form');
echo form_open('stock/new_save_issued_stock',$form_attributes);?>
<div class="well well-sm"><b>Transaction Details</b></div>
	
<div class="row">
	<div class="col-lg-3">
	  <div class="panel-body">
	  <b>Issue To</b>
	   <?php $data=array('name' => 'issued_to','id'=> 'issued_to','class'=>'form-control','value'=>$order_infor[0]['station_id'],'readonly'=>'readonly'); echo form_input($data);?>
		
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
	  <b>Date Issued</b>
	   <?php  $data=array('name' => 'date_issued','required'=>'true','id'=>'datepicker','required'=>'true', 'class'=>'form-control'); echo form_input($data);?>
	   
 		</div>
	  </div>

	  <div class="col-lg-3">
		  <div class="panel-body">
		  <b>Order Number</b>
		    <?php $data=array('name' => 'order','id'=> 'order','class'=>'form-control', 'value'=>$order_infor[0]['order_id'], 'readonly'=>'readonly'); echo form_input($data);?>
		
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

			                <th style="width:9%;" class="small">Vaccine/Diluents</th>
							<th style="width:9%;" class="small">Batch No.</th>
							<th style="width:12%;" class="small">Expiry </br>Date</th>
							<th style="width:12%;" class="small">Amount </br>Ordered</th>
							<th style="width:9%;" class="small">Stock </br>Quantity</th>
							<th style="width:15%;" class="small">Amount </br>Issued</th>
							<th style="width:9%;" class="small">VVM Status</th>
							<th style="width:9%;" class="small">Comment</th>
		</thead>
<tbody>
		<?php foreach ($issues as $vaccine) {?>
				<tr align="center" issue_row="<?php echo $vaccine['vaccine_id'] ?>">
					<td><?php echo $vaccine['Vaccine_name']?></td>
					<?php echo form_hidden('vaccine[]',$vaccine['vaccine_id']);?>
					<style type="text/css">
					input[id="available_quantity"]{
						background-color: #E0F2F7 !important
					}</style>
					<td><?php $data=array('name' => 'batch_no[]','id'=> 'batch_no'.$vaccine['vaccine_id'],'class'=>'form-control batch_no','readonly'=>'','value'=>$vaccine['batch_number']); echo form_input($data);?></td>
					<td><?php $data=array('name' => 'expiry_date[]','id'=> 'expiry_date'.$vaccine['vaccine_id'],'class'=>'form-control expiry_date','readonly'=>'','value'=>$vaccine['expiry_date']); echo form_input($data);?></td>
					<td><?php $data=array('name' => 'amt_ordered[]','id'=> 'amt_ordered','class'=>'form-control amt_ordered','value'=>$vaccine['qty_order_doses']); echo form_input($data);?></td>
					<td><?php $data=array('name' => 'available_quantity[]','id'=> 'available_quantity'.$vaccine['vaccine_id'],'class'=>'form-control available_quantity','value'=>$vaccine['stock_balance'],'readonly'=>''); echo form_input($data);?></td>
					<td><?php $data=array('name' => 'amt_issued[]','id'=> 'amt_issued'.$vaccine['vaccine_id'],'class'=>'form-control amt_issued','value'=>$vaccine['qty_order_doses']); echo form_input($data);?></td>
					<td><?php $data=array('name' => 'vvm_status[]','id'=> 'vvm_status'.$vaccine['vaccine_id'],'class'=>'form-control  vvm_s','value'=>$vaccine['name']); echo form_input($data);?></td>
					<td><textarea name="comment[]" id="comment"></textarea></td>
	

						</tr>
						<?php }?>
	</tbody>
	</table>

</div></div></div></div>


<button type="submit" name="stock_issue_fm" id="stock_issue_fm" class="btn btn-sm btn-danger">Submit</button>

<?php
        echo form_hidden('date_recorded',date('Y-m-d',strtotime(date('Y-m-d'))));
		echo form_close();?>
	

<script type="text/javascript">

 	$('#datepicker').datepicker({dateFormat: "yy-mm-dd",  maxDate: 0}).datepicker('setDate', null);
</script>
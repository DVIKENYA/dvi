 <div class="row">
  <div class="col-lg-12">
    <?php
    $form_attributes = array('id' => 'stock_received_fm','class'=>'form-horizontal','role'=>'form','method'=>'post');
    echo form_open('stock/new_save_received_stock',$form_attributes);?>
  </div>
</div>

<div class="well well-sm"><b>Transaction Details</b></div>
<div class="row">
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <b>Received From</b>
      <?php $data=array('name' => 'received_from','id'=> 'received_from','class'=>'form-control','disabled'=>'','value'=>$receipts[0]['issued_by_station_id']); echo form_input($data);?>
    </div>
  </div>
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <b>S11 #</b>
      <?php $data=array('name' => 's11','id'=> 's11','class'=>'form-control','value'=>$receipts[0]['S11']); echo form_input($data);?>
    </div>
  </div>
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <b>Date Received</b>
      <?php $data=array('name' => 'date_received','id'=>'date_received','class'=>'form-control','required'=>'','type'=>'date','autocomplete'=>'off'); echo form_input($data);?>
    </div>
  </div> 

  <input type="hidden" name ="transaction_type" class="transaction_type" value="1">
  <?php echo form_hidden('issue_id',$receipts[0]['issue_id']);
        echo form_hidden('order_id',$receipts[0]['order_id']);
        echo form_hidden('date_recorded',date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))));?>
</div>

<br/>
<div class="well well-sm"><b>Vaccine Details</b></div>
<br/>
<div class="table-responsive">


  <div id="stock_receive_tbl">

   <table class="table table-bordered  table-striped">
    <thead>
      <th style="width:9%;" class="small">Vaccine/Diluents</th>
      <th style="width:10%;" class="small">Batch No.</th>
      <th style="width:9%;" class="small">Expiry Date</th>
      <th style="width:9%;" class="small">Quantity </br>Ordered</th>
      <th style="width:9%;" class="small">Quantity </br>Received</th>
      <th style="width:12%;" class="small">VVM Status</th>
      <th style="width:9%;" class="small">Comment</th>
   </thead>
   <tbody>

<?php foreach ($receipts as $vaccine) { ?>
     <tr align="center" receive_row="<?php echo $vaccine['ID'] ?>"> 
     <td><?php echo $vaccine['Vaccine_name']?></td>
     <?php echo form_hidden('vaccine[]',$vaccine['ID']);?>
     <td><?php $data=array('name' => 'batch_no[]','id'=>'batch_no','class'=>'batch_no form-control','value'=>$vaccine['batch_no'],'readonly'=>''); echo form_input($data);?></td>
     <td><?php $data=array('name' => 'expiry_date[]','id'=> 'expiry_date','class'=>'form-control expiry_date', 'type'=>'date','value'=>$vaccine['expiry_date'],'readonly'=>''); echo form_input($data);?></td>
     <td><?php $data=array('name' => 'quantity_ordered[]','id'=> 'quantity_ordered','class'=>'quantity_ordered form-control','value'=>$vaccine['amount_ordered'],'readonly'=>''); echo form_input($data);?></td>
     <td><?php $data=array('name' => 'quantity_received[]','id'=> 'quantity_received','class'=>'quantity_received form-control','type'=>'number','min'=>'0','value'=>$vaccine['amount_issued']); echo form_input($data);?></td>
     <td>
      <select name="vvm_status[]" class=" form-control vvm_status " id="vvm_status" name="vvm_status" required>
        <option value="">Select Status </option>
        <option value="1">Stage 1</option>
        <option value="2">Stage 2</option>
        <option value="3">Stage 3</option>
        <option value="3">Stage 4</option>
      </select></td>
     <td><?php  $data = array('name'=> 'comment','id'=> 'comment','rows'=> '2','cols'=> '9','class'=> 'form-control comment'); echo form_textarea($data);?></td>
<!--     <td><textarea name="comment[]" id="comment" disabled>--><?php //echo ($vaccine['comment']); ?><!--</textarea></td>-->
    </tr>
<?php }?>
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
                              <button type="submit" name="stock_received" id="stock_received" class="btn btn-sm btn-danger">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>



<?php

echo form_close();?>
</div>

<script type="text/javascript">

  $('#date_received').datepicker({dateFormat: "yy-mm-dd",  maxDate: 0}).datepicker('setDate', null);
</script>
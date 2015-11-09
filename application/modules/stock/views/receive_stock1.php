<?php
$form_attributes = array('id' => 'stock_receive_fm');
echo form_open($form_attributes);?>



<table>
<p class="bg-info"> Transaction Details</p>
	<thead>
		                  <th style="width:50%;" class="small" align="center">Received From</th>
							<th style="width:50%;" class="small" >Date Received </th>
	</thead>
	<tbody>
		<tr>
			<td><?php $data=array('name' => 'received_from','id'=> 'received_from','class'=>'col-xs-20'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'date_received','id'=>'date_received','class'=>'col-xs-9'); echo form_input($data);?></td>
		</tr>
	</tbody>
</table>
<hr></hr><hr></hr>


<div id="stock_table">
	 <p class="bg-info"> Vaccine Details</p> 
	<table class="table">
		<thead>

			              <th style="width:26%;" class="small" align="center">Vaccine</th>
							<th style="width:15%;" class="small">Batch No.</th>
							<th style="width:16%;" class="small">Expiry&nbsp;Date</th>
							<th style="width:12%;" class="small">Quantity(doses)</th>
							<th style="width:16%;" class="small">VVM Status</th>
							<th style="width:15%" class="small">Action</th>
		</thead>
		<tbody>
            	<?php /*foreach ($vaccines as $vaccine) {*/ ?>
			<tr align="center" stock_row="1" >
				<td> <select name="select_vaccine" class="select_vaccine">
             		 <option value="">--Select One--</option>
             		 <?php foreach ($vaccines as $vaccine) { 
                     echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
                     }?>
                </select></td>
					<?php /*echo form_hidden('vaccine[]',$vaccine['ID']);*/?>
             		<td><?php $data=array('name' => 'batch_no','id'=>'batch_no','class'=>'col-xs-12 batch'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'expirydate','id'=> 'expiry_date','class'=>'col-xs-11 expiry','type'=>'date'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'quantity','id'=> 'quantity','class'=>'col-xs-12 quantity'); echo form_input($data);?></td>
             		<!-- <td><input type="date" /></td> -->
             		<td>
             		<select name="vvm_status" class="status">
             		<option value="" >--Select One--</option>
             		<?php foreach ($vvm_status as $status) { 
                    echo "<option value='".$status['id']."'>".$status['name']."</option>";
                     }?>
                </select></td>
             		<td class="col-xs-9 small "><a href="#" class="add"> Add </a><span class="divider"> | </span><a href="#" class="remove">Remove</a></td>
			</tr>
				<?php /*}*/?>

		</tbody>
	</table>
</div>
<input type="submit" name="stock_receive" id="receive_fm" value="Receive Stock">
<?php
     echo form_close();?>
     
 
     
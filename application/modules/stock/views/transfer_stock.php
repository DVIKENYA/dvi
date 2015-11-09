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
			<td><?php $data=array('name' => '','id'=> '','class'=>'col-xs-20'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => '','id'=>'date_transferred','class'=>'col-xs-9'); echo form_input($data);?></td>
		</tr>
	</tbody>
</table>
<table>
	
</table>
<hr></hr><hr></hr>
<div id="stock_issue">
	 <p class="bg-info"> Vaccine Details</p> 
	<table class="table">
		<thead>

			                <th style="width:17%;" class="small" align="center">Vaccine</th>
							<th style="width:12%;" class="small">Batch No.</th>
							<th style="width:16%;" class="small">Expiry&nbsp;Date</th>
							<th style="width:12%;" class="small">Amount Requested</th>
							<th style="width:12%;" class="small">Amount Transferred</th>
							<th style="width:16%;" class="small">VVM Status</th>
							<th style="width:18%" class="small">Action</th>
		</thead>
		<tbody>

			<tr align="center">
				
             	<td><?php $data=array('name' => '','id'=> '','class'=>'col-xs-12'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => '','id'=>'','class'=>'col-xs-9'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => '','id'=> 'expiry_date','class'=>'col-xs-12'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => '','id'=> '','class'=>'col-xs-12'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => '','id'=> '','class'=>'col-xs-12'); echo form_input($data);?></td>
             		<td>
             		<select name="vvm_status">
             		<option value=""> --Select One-- </option>
                    <option value="1">Stage 1</option>
                    <option value="2">Stage 2</option>
                    <option value="3">Stage 3</option>
                </select></td>
             		
             		<td class="col-xs-9 small "><a href="#"> Add </a><span class="divider"> | </span><a href="#">Remove</a></td>
			</tr>

		</tbody>
	</table>


</div>
<?php
$data=array('name' => 'stock_transfer','id'=> 'stock_transfer','value' => 'Transfer Stock');
 echo form_submit($data);
   
   echo form_close();?>
   <script type="text/javascript">
 
   </script>
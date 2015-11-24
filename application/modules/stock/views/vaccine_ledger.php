 <div class="row">
    <div class="col-lg-12">
<?php
$form_attributes = array('id' => 'vaccine_ledger','class'=>'form-inline','role'=>'form');
echo form_open('',$form_attributes);?>


<div class="well well-sm"><b>Vaccines</b></div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
  <div class="form-group">
  <b>Vaccine/Diluents</b>
   <select name="v_list" class="form-control v_list" id="v_list">
                 <option value="">--Select One--</option>
                 <?php foreach ($vaccines as $vaccine) { 
                     echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
                     }?>
                </select>
    </div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
  <div class="form-group">
  
    </div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
  <div class="form-group">
  
    </div>
</div>
<br/>
<br/><br/>
<div class="table-responsive">
<div class="well well-sm"><b>Vaccine Ledger</b></div>

						
<table class="table table-bordered table-hover table-striped" id="v_ledger_tbl">

		
	<thead>
	
		<th>Vaccines/Diluents (Origin/Destination)</th>
		                    <th >Batch Number</th>
							<th >Transaction Date</th>
							<th> Stock Received </th>
							<th >Stock Issued</th>
							<th>Store Balance</th>
							<th >Expiry Date</th>
							<th >VVM Status</th>
	</thead>
	<tbody>
	<?php foreach ($ledgers as $ledger) { ?>

		<tr align="center" ledger_row="1">
				
             	    
             	    <td><?php echo $ledger['Vaccine_name']?></td>
             	    <td><?php echo $ledger['batch_number']?></td>
             	    <td><?php echo $ledger['transaction_date']?></td>
             	    <td><?php echo $ledger['quantity_in']?></td>
             	    <td><?php echo $ledger['quantity_out']?></td>
             	    <td><?php echo $ledger['stock_balance']?></td>
             	    <td><?php echo $ledger['expiry_date']?></td>
             	    <td><?php echo $ledger['name']?></td>
             		
			</tr>
			<?php } ?>
	</tbody>
</table>

<?php echo form_close();?>
</div></div></div>
<script type="text/javascript">
$('#v_ledger_tbl > tbody  > tr').each(function(key,value) {
/*console.log(value);
celval= value.cells;
console.log(celval);*/
var cellLength= value.cells.length;
console.log(cellLength);
for(var y=0; y<cellLength; y+=1){
    var cell = value.cells[y];
    console.log(cell);


    //do something with every cell here
  }
});
	
	$(document).on( 'change','#v_list', function () {
		   var selected_vaccine=$(this).val();
		   get_ledger(selected_vaccine);
		});

			function get_ledger(selected_vaccine){
				var _url="<?php echo base_url();?>stock/get_vaccine_ledger/"+ selected_vaccine;
				   var request=$.ajax({
						     url: _url,
						     type: 'post',
						    });
				   request.done(function(data){
			    	data=JSON.parse(data);
			    	console.log(data);
			    	$.each(data,function(key,value){
			    		console.log(value);
			    		/*alert($("table td:gt(0)").length);*/
			    		
			    		/*console.log(value.Vaccine_name);*/
	                  /* $('#myDiv table table td').eq(0).text('Picked');*/
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
			   
			}
</script>
 <div class="row">
    
<?php
$form_attributes = array('id' => 'vaccine_ledger','class'=>'form-inline','role'=>'form');
echo form_open('',$form_attributes);?>


<div class="row">
  </br>
  </br>
<div class="col-lg-12">    
	<div class="table-responsive">
		<div class="well well-sm"><b>Vaccine Ledger</b></div>

<div class="row">
	<div class="col-lg-3">
		  <div class="panel-body">
		   <b>Vaccine/Diluents</b><br>
			   <select name="v_list" class="form-control v_list" id="v_list">
			                 <option value="0">--Select One--</option>
			                 <?php foreach ($vaccines as $vaccine) { 
			                     echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
			                     }?>
			                </select>
		    </div>
		</div> 
	<div class="col-lg-3">
		<div class="panel-body">
		   <b>Store Balance</b><br>
			   <input type="text" class="form-control balance" id="balance" name="balance" readonly="true">
		    </div>
		</div> 
</div>
	
<div class="margin-top-10"></div>

 <table id="table" class="display table table-bordered table-striped table-hover" cellspacing="0" width="100%">
      <thead>
      <tr class="button"></tr>

        <tr>
		    <th>Transaction Date</th>
		    <th>Transaction Type</th>
		    <th>Origin</th>
		    <th>Destination</th>
		    <th>Vaccines/Diluents</th>
		    <th>Quantity In</th>
		    <th>Quantity Out</th>
		    <th >Batch Number</th>
			<th >Expiry Date</th>
		</tr>
      </thead>
      <tbody>
      </tbody>

      <tfoot>
        <tr>
	        <th>Transaction Date</th>
		    <th>Transaction Type</th>
		    <th>Origin</th>
		    <th>Destination</th>
		    <th>Vaccines/Diluents</th>
		    <th>Quantity In</th>
		    <th>Quantity Out</th>
		    <th >Batch Number</th>
			<th >Expiry Date</th>
        </tr>
      </tfoot>
    </table>						

<?php echo form_close();?>
</div>
</div>
</div>
</div>
<script type="text/javascript">

 	$(document).ready(function() {
 		
		table = $('#table').DataTable({ 
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.

		// Load data for the table's content from an Ajax source
		"ajax": {
		    "url": "<?php echo site_url('stock/ledger/')."/".$id?>",
		    "type": "POST"
		},
		"dom": 'Bfrtip',
        "buttons": [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
			],	
		"responsive": {
		    "details": {
		        "type": 'column'
		    }
		},
		//Set column definition initialisation properties.
		"columnDefs": [
		{ 
		  "targets": [ -1 ], //last column
		  "orderable": false, //set not orderable
		},
		],

		});

		
    });

	
	$(document).on( 'change','#v_list', function () {
		var selected_vaccine=$(this).val();
		get_ledger(selected_vaccine);
		});

			function get_ledger(selected_vaccine){
				var _url="<?php echo base_url();?>stock/store_balance/"+ selected_vaccine;
				   var request=$.ajax({
						     url: _url,
						     type: 'post',
						    });
				   request.done(function(data){
			    	data=JSON.parse(data);
			    	$(".balance").val("");
			    	  	$.each(data,function(key,value){
			    		$(".balance").val(value.balance);
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
			   
			}

		$(document).on( 'change','#v_list', function () {
		var selected_vaccine=$(this).val();	
		var _url="<?php echo site_url('stock/ledger/')?>/"+ selected_vaccine;
		table.ajax.url( _url).load();
		});	
	
			
</script>


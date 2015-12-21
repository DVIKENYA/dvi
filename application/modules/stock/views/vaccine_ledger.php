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

     <div class="col-lg-12 col-sm-12">
     <div class="panel default blue_title h2">
        <div class="panel-body">
        <ul class="nav nav-tabs">

        <li class="active"><a data-toggle="tab" href="#tab1"><b>Stock In</b></a></li>
        <li><a data-toggle="tab" href="#tab2"><b>Stock Out</b></a></li>
        </ul>
        <div class="tab-content">
        <div id="tab1" class="tab-pane fade in active">
        <form>

          <div class="table-responsive">
              <table id="table1" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                <thead>
                  <tr class="button"></tr>

                    <tr>
                    <th >Transaction Date</th>
                    <th >Quantity In</th>
                    <th >Quantity Out</th>
                    <th >Batch Number</th>
                    <th >Expiry Date</th>
                   </tr>
                  </thead>
                  <tbody>
                  </tbody>

                  <tfoot>
                    <tr>
                    <th >Transaction Date</th>
                    <th >Quantity In</th>
                    <th >Quantity Out</th>
                    <th >Batch Number</th>
                    <th >Expiry Date</th>
                    </tr>
                  </tfoot>
              </table>
            </div>

        </form>
        </div>
        <div id="tab2" class="tab-pane fade">
        <form id="other_depots">
            <div class="table-responsive">
              <table id="table2" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                <thead>
                  <tr class="button"></tr>

                    <tr>
                    <th >Transaction Date</th>
                    <th >Source</th>
                    <th >Quantity In</th>
                    <th >Quantity Out</th>
                    <th >Batch Number</th>
                    <th >Expiry Date</th>
                   </tr>
                  </thead>
                  <tbody>
                  </tbody>

                  <tfoot>
                    <tr>
                    <th >Transaction Date</th>
                    <th >Source</th>
                    <th >Quantity In</th>
                    <th >Quantity Out</th>
                    <th >Batch Number</th>
                    <th >Expiry Date</th>
                    </tr>
                  </tfoot>
              </table>
            </div>

        </form>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>

	

<?php echo form_close();?>

<script type="text/javascript">

 	$(document).ready(function() {
 		
		table1 = $('#table1').DataTable({ 
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.

		// Load data for the table's content from an Ajax source
		"ajax": {
		    "url": "<?php echo site_url('stock/ledger_in/')."/".$id?>",
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

    $(document).ready(function() {
 		
		table2 = $('#table2').DataTable({ 
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.

		// Load data for the table's content from an Ajax source
		"ajax": {
		    "url": "<?php echo site_url('stock/ledger_out/')."/".$id?>",
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
		table1.ajax.url( _url).load();
		table2.ajax.url( _url).load();
		});	
	
			
</script>


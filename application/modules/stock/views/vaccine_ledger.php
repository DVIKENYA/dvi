<?php
$station_id = $user_object['user_statiton'];
$sql="SELECT DISTINCT mv.Vaccine_name,batch_number as batch,expiry_date as mydate ,stock_balance as stock FROM m_stock_balance mb
LEFT JOIN m_vaccines mv ON mv.ID= mb.vaccine_id WHERE station_id= '".$station_id."'";
 $res2 = $this->db->query($sql)->result_array();
    $arrayResults2 = $res2;
    
//    print_r($res2);

    $mystring1 = ""; $mystring2="";
    
    $vacc_name = array();
    $batch = array(); 
    $date = array(); 
    $stock = array(); 
    
      foreach ($res2 as  $row2) {
      //array_push($array1, $row['']);
      $mystring1 = $row2['Vaccine_name'];
      $mystring2 = $row2['batch'];
      $mystring3 = $row2['mydate'];
      $mystring4 = $row2['stock'];

      $mystring4 = intval($mystring4);
      $mystring3 = intval($mystring3);
           
      array_push($vacc_name, $mystring1);
      array_push($batch, $mystring2);
      array_push($date, $mystring3);
      array_push($stock, $mystring4);

    }
  
   $urls_name_enc = json_encode($vacc_name);
   $urls_batch_enc = json_encode($batch);
   $urls_date_enc = json_encode($date);
   $urls_stock_enc = json_encode($stock);

 //var_dump($total);
?>

        <div id="table-container"></div>
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

<!--
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
--> 
<div class="margin-top-10"></div>

     <div class="col-lg-12 col-sm-12">
     <div class="panel default blue_title h2">
        <div class="panel-body">
        <ul class="nav nav-tabs">

        <li class="active"><a data-toggle="tab" href="#tab1"><b>Stock In</b></a></li>
        <li><a data-toggle="tab" href="#tab2"><b>Stock Out</b></a></li>
        <li><a data-toggle="tab" href="#tab3"><b>Physical Count</b></a></li>
        </ul>
        <div class="tab-content">
        <div id="tab1" class="tab-pane fade in active">
        <form>

          <div class="table-responsive">
              <table id="table1" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                <thead>
                  <tr class="button"></tr>

                    <tr>
                        <th >Transaction <br>Date</th>
                        <th >Vaccine/Diluent</th>
                        
                        <th >Amount <br>Received</th>
                        <th >Batch <br>Number</th>
                        <th >Expiry <br>Date</th>
                        
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>

                  <tfoot>
                    <tr>
                        <th >Transaction <br>Date</th>
                        <th >Vaccine/Diluent</th>
                        
                        <th >Amount <br>Received</th>
                        <th >Batch <br>Number</th>
                        <th >Expiry <br>Date</th>
                    </tr>
                  </tfoot>
              </table>
            </div>

        </form>
        </div>
        <div id="tab2" class="tab-pane fade">
        <form id="">
        <div class="table-responsive">
          <table id="table2" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
            <thead>
                  <tr class="button"></tr>

                    <tr>
                        <th >Transaction <br>Date</th>
                        <th >Vaccine/Diluent</th>
                        <th >Origin/Destination</th>
                        <th >Amount <br>Issued</th>
                        <th >Batch <br>Number</th>
                        <th >Expiry <br>Date</th>
                        
                      
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>

                  <tfoot>
                    <tr>
                        <th >Transaction <br>Date</th>
                        <th >Vaccine/Diluent</th>
                        <th >Origin/Destination</th>
                        <th >Amount <br>Issued</th>
                        <th >Batch <br>Number</th>
                        <th >Expiry <br>Date</th>
                        
                                          </tr>
          </table>
         </div>

        </form>
    </div>

    <div id="tab3" class="tab-pane fade">
        <form id="">
        <div class="table-responsive">
          <table id="table3" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
            <thead>
                  <tr class="button"></tr>

                    <tr>
                        <th >Vaccine/Diluent</th>
                        <th >Batch <br>Number</th>
                        <th >Expiry <br>Date</th>>
                        <th >Stock<br>Quantity</th>
                        
                      
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>

                  <tfoot>
                    <tr>
                        <th >Vaccine/Diluent</th>
                        <th >Batch <br>Number</th>
                        <th >Expiry <br>Date</th>>
                        <th >Stock<br>Quantity</th>
                        
                    </tr>
          </table>
         </div>

        </form>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

  

<?php echo form_close();?>
 <br/>
 <div class="row"></div>
 <br/>
 <div id="container" style="width:100%; height:300px; " >
    
 </div>


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


  $(document).ready(function() {
    
    table3 = $('#table3').DataTable({ 
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('stock/vaccine_count/')."/".$id?>",
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
</script>



<script type="text/javascript">

       window.setTimeout(function() {
          $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
          });
      }, 5000);
</script> 
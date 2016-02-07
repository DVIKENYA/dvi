<div id="table-container"></div>
<div class="row">
    <div class="row">
    <div class="col-sm-3 col-sm-6">
        <div class="information green_info">
            <div class="information_inner">
                <div class="info green_symbols"><i class="fa fa-cubes icon"></i></div>
               <span>Stock Balance </span>
                <h1 class="bolded"><?php echo($bal[0]['stock_balance']);?></h1>

            </div>
        </div>
    </div>

<div class="col-lg-12">
  <div class="table-responsive">
    <div class="well well-sm"><b>Stocks Ledger</b></div>

<div class="margin-top-10"><h4></h4></div>

     <div class="col-lg-12 col-sm-12">
     <div class="panel default blue_title h2">
        <div class="panel-body">
        <ul class="nav nav-tabs">

        <li class="active"><a data-toggle="tab" href="#tab1"><b>Stocks Received</b></a></li>
        <li><a data-toggle="tab" href="#tab2"><b>Stocks Issued</b></a></li>
        <li><a data-toggle="tab" href="#tab3"><b>Physical Count</b></a></li>
        <li><a data-toggle="tab" href="#tab4"><b>Batch Summary</b></a></li>
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
                        <th >Destination</th>
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
                        <th >Destination</th>
                        <th >Amount <br>Issued</th>
                        <th >Batch <br>Number</th>
                        <th >Expiry <br>Date</th>
                        
                    </tr>
                  </tfoot>
          </table>
         </div>

        </form>
    </div>

            <div id="tab3" class="tab-pane fade">
                    <div class="table-responsive">
                        <table id="table3" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th >Vaccine/Diluent</th>
                                    <th >Batch <br>Number</th>
                                    <th >Expiry<br>Date</th>
                                    <th >Stock<br>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                            <tfoot>
                            <tr>
                                <th >Vaccine/Diluent</th>
                                <th >Batch <br>Number</th>
                                <th >Expiry <br>Date</th>
                                <th >Stock<br>Quantity</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

            </div>

                    <div id="tab4" class="tab-pane fade">
                    <div class="table-responsive">
                        <table id="table4" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th >Batch<br>Number </th>
                                    <th >Expiry<br>Date</th>
                                    <th >Stock<br>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                            <tfoot>
                            <tr>
                                <th >Batch<br>Number</th>
                                <th >Expiry<br>Date</th>
                                <th >Stock<br>Balance</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

  

 <div class="row"></div>
 <br/>
 <div id="container" style="width:100%; height:300px; " >
    
 </div>


<script type="text/javascript">

  $(document).ready(function() {
    
    table1 = $('#table1').DataTable({
    "sDom": '<l<t>ip>',
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
    "sDom": '<l<t>ip>',
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
    "sDom": '<l<t>ip>', 
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

  $(document).ready(function() {
    
    table4 = $('#table4').DataTable({
    "sDom": '<l<t>ip>', 
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('stock/batch_summary/')."/".$id?>",
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
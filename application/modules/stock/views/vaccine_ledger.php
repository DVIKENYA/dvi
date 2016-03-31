<div class="row" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-sm-3 col-sm-6">
            <div class="information green_info">
                <div class="information_inner">
                    <div class="info green_symbols"><i class="fa fa-cubes icon"></i></div>
                    <span><?php echo ($vaccine[0]["Vaccine_name"]);?> Stock Balance </span>
                    <h1 class="bolded" id="bal"></h1>

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
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="pull-right">
                                                <span id="range-in">
                                                        Filter from
                                                        <input id="date-range-in1"  value="" size="20">
                                                        to
                                                        <input id="date-range-in2"  value="" size="20">
                                                 </span>
                                                <button id="range-in-clear">Clear</button>
                                            </div>
                                    </div>

                                    </div>

                                    <form>

                                        <div class="table-responsive">
                                            <table id="table1" class="table table-bordered table-hover table-striped"
                                                   cellspacing="0" width="100%">
                                                <tr class="button"></tr>
                                                <thead>
                                                <tr>
                                                    <th>Date<br>Received</th>
                                                    <th>Vaccine/Diluent</th>
                                                    <th>Amount <br>Received</th>
                                                    <th>Batch <br>Number</th>
                                                    <th>Expiry <br>Date</th>
                                                    <th>Action</th>
                                                   

                                                </tr>

                                                </thead>
                                                <tbody>
                                                </tbody>

                                                <tfoot>
                                                <tr>
                                                    <th>Date<br>Received</th>
                                                    <th>Vaccine/Diluent</th>
                                                    <th>Amount <br>Received</th>
                                                    <th>Batch <br>Number</th>
                                                    <th>Expiry <br>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </form>
                                </div>
                                <div id="tab2" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="pull-right">
                                                 <span id="range-out">
                                                        Filter from
                                                        <input id="date-range-out1"  value="" size="20">
                                                        to
                                                        <input id="date-range-out2"  value="" size="20">
                                                 </span>
                                                <button id="range-out-clear">Clear</button>
                                            </div>
                                        </div>

                                    </div>

                                    <form>

                                        <div class="table-responsive">
                                            <table id="table2" class="table table-bordered table-hover table-striped"
                                                   cellspacing="0" width="100%">
                                                <thead>
                                                <tr class="button"></tr>

                                                <tr>
                                                    <th>Date<br>Issued</th>
                                                    <th>Vaccine/Diluent</th>
                                                    <th>Destination</th>
                                                    <th>Amount <br>Issued</th>
                                                    <th>Batch <br>Number</th>
                                                    <th>Expiry <br>Date</th>


                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>

                                                <tfoot>
                                                <tr>
                                                    <th>Date<br>Issued</th>
                                                    <th>Vaccine/Diluent</th>
                                                    <th>Destination</th>
                                                    <th>Amount <br>Issued</th>
                                                    <th>Batch <br>Number</th>
                                                    <th>Expiry <br>Date</th>

                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </form>
                                </div>

                                <div id="tab3" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table id="table3" class="table table-bordered table-hover table-striped"
                                               cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Date of count</th>
                                                <th>Vaccine/Diluent</th>
                                                <th>Batch <br>Number</th>
                                                <th>Expiry<br>Date</th>
                                                <th>Stock<br>Quantity</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th>Date of count</th>
                                                <th>Vaccine/Diluent</th>
                                                <th>Batch <br>Number</th>
                                                <th>Expiry <br>Date</th>
                                                <th>Stock<br>Quantity</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>

                                <div id="tab4" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table id="table4" class="table table-bordered table-hover table-striped"
                                               cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Batch<br>Number</th>
                                                <th>Expiry<br>Date</th>
                                                <th>Stock<br>Balance</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th>Batch<br>Number</th>
                                                <th>Expiry<br>Date</th>
                                                <th>Stock<br>Balance</th>
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

    <br/>
<!--    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>-->


    <script type="text/javascript">

        var table1;

        $(document).ready(function () {

            table1 = $('#table1').DataTable({

                "sDom": '<l<t>ip>',
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('stock/ledger_in/') . "/" . $id?>",
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
                        "targets": [-1], //last column
                        "orderable": false, //set not orderable
                    },
                ]

            });
            $('#range-in').dateRangePicker({
                showShortcuts: true,
                shortcuts :
                {
                    'prev-days': [3,5,7],
                    'prev': ['week','month','year'],
                    'next-days':null,
                    'next':null
                },
                startOfWeek: 'monday',
                separator : ' to ',
                endDate: new Date(),
                selectForward: false,
                applyBtnClass: '',

                setValue: function(s,s1,s2)
                {
                    $('#date-range-in1').val(s1);
                    $('#date-range-in2').val(s2);
                }
            }).bind('datepicker-closed',function()
            {
                if ($('#date-range-in1').val() && $('#date-range-in2').val() ) {
                    var obj = $('#date-range-in1').val() + '/' + $('#date-range-in2').val();
                    table1.columns(0).search(obj).draw();
                }
            });
            $('#range-in-clear').click(function(evt)
            {
                evt.stopPropagation();
                $('#range-in').data('dateRangePicker').clear();
                var obj = $('#date-range-in1').val() + '/' + $('#date-range-in2').val();
                table1.columns(0).search(obj).draw();
            });





        });
        function remove_duplicate(id) {
            var url;
            url = "<?php echo site_url('stock/remove_duplicate')?>"  + '/'+ id;
            if (confirm('Are you sure, remove this data?')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        console.log(data);
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            }
        }

        function reload_table() {
            table1.ajax.reload(null, false); //reload datatable ajax

        }

        function auto_load(){
            url = "<?php echo site_url('stock/get_stock_balance'). "/" . $id?>";
            $.ajax({
              url: url,
              cache: false,
              success: function(data){
                 $("#bal").html(data);
              } 
            });
          }

        $(document).ready(function(){

            auto_load(); //Call auto_load() function when DOM is Ready

          });

          //Refresh auto_load() function after 10000 milliseconds
          setInterval(auto_load,50000);


        $(document).ready(function () {

            table2 = $('#table2').DataTable({
                "sDom": '<l<t>ip>',
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('stock/ledger_out/') . "/" . $id?>",
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
                        "targets": [-1], //last column
                        "orderable": false, //set not orderable
                    },
                ],

            });

            $('#range-out').dateRangePicker({
                showShortcuts: true,
                shortcuts :
                {
                    'prev-days': [3,5,7],
                    'prev': ['week','month','year'],
                    'next-days':null,
                    'next':null
                },
                startOfWeek: 'monday',
                separator : ' to ',
                endDate: new Date(),
                selectForward: false,
                applyBtnClass: '',

                setValue: function(s,s1,s2)
                {
                    $('#date-range-out1').val(s1);
                    $('#date-range-out2').val(s2);
                }
            }).bind('datepicker-closed',function()
            {
                if ($('#date-range-out1').val() && $('#date-range-out2').val() ) {
                    var obj = $('#date-range-out1').val() + '/' + $('#date-range-out2').val();

                    table2.columns(0).search(obj).draw();
                }
            });
            $('#range-out-clear').click(function(evt)
            {
                evt.stopPropagation();
                $('#range-out').data('dateRangePicker').clear();
                var obj = $('#date-range-out1').val() + '/' + $('#date-range-out2').val();
                table2.columns(0).search(obj).draw();
            });



        });


        $(document).ready(function () {

            table3 = $('#table3').DataTable({
                "sDom": '<l<t>ip>',
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('stock/vaccine_count/') . "/" . $id?>",
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
                        "targets": [-1], //last column
                        "orderable": false, //set not orderable
                    },
                ],

            });


        });

        $(document).ready(function () {

            table4 = $('#table4').DataTable({
                "sDom": '<l<t>ip>',
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('stock/batch_summary/') . "/" . $id?>",
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
                        "targets": [-1], //last column
                        "orderable": false, //set not orderable
                    },
                ],

            });


        });
    </script>


    <script type="text/javascript">
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: []
            }]
        });
        window.setTimeout(function () {
            $("#alert-message").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 5000);
    </script>
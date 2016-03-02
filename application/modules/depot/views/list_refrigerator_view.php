<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-lg-12">
        <a href="javascript:void()" onclick="add_fridge()" class="btn btn-primary">Add Refrigerator</a>
    </div>
</div>
<div class="row">
    <br>
    <br>
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="col-lg-12" style="margin-top: 10px;">
        <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        <br>
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                <thead>

                <tr>
                    <th>Refrigerator Model</th>
                    <th>Manufacturer</th>
                    <th>Temp. Monitor No.</th>
                    <th>Main Power Source</th>
                    <th>Year of Installation</th>
                    <th>Status</th>
                    <th style="width:250px;">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <tr>
                    <th>Refrigerator Model</th>
                    <th>Manufacturer</th>
                    <th>Temp. Monitor No.</th>
                    <th>Main Power Source</th>
                    <th>Year of Installation</th>
                    <th>Status</th>
                    <th style="width:250px;">Action</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <script type="text/javascript">

            var save_method; //for save method string
            var table;
            var url;

            $(document).ready(function () {
                table = $('#table').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('depot/get_fridges_by_id/') . "/" . $id?>",
                        "type": "POST"
                    },

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


            function add_fridge() {
                save_method = 'add';
                $('#form')[0].reset(); // reset form on modals
                $('#fridge_modal_form').modal('show'); // show bootstrap modal
                $('.modal-title').text('Add Refrigerator');
            }

            function edit_fridge(id) {
                save_method = 'update';
                $('#form')[0].reset(); // reset form on modals

                //Ajax Load data from ajax
                $.ajax({
                    url: "<?php echo site_url('depot/edit_fridge/')?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        //$('[name="model"]').val(data.Model);
                        $('[name="temperature_monitor_no"]').val(data.temperature_monitor_no);
                        $('select[name="main_power_source"]').val(data.main_power_source);
                        $('select[name="refrigerator_status"]').val(data.refrigerator_status);
                        document.getElementById("btnUpdate").addEventListener('click', function(){
                            save(data.id);
                        });

                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Refrigerator'); // Set title to Bootstrap modal title

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error retrieving data ');
                    }
                });
            }

            function reload_table() {
                table.ajax.reload(null, false); //reload datatable ajax
            }

            function save(id) {
                var url;
                if (save_method == 'add') {
                    url = "<?php echo site_url('depot/add_fridge') . "/" . $id?>";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#form').serialize(),
                        dataType: "JSON",
                        success: function (data) {
                            //if success close modal and reload ajax table
                            $('#fridge_modal_form').modal('hide');
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Error adding / update data');
                        }
                    });
                }
                else {
                    url = "<?php echo site_url('depot/update_fridge') . "/"?>"+id;
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#editform').serialize(),
                        dataType: "JSON",
                        success: function (data) {
                            //if success close modal and reload ajax table
                            $('#modal_form').modal('hide');
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Error adding / update data');
                        }
                    });
                }

            }

            function delete_fridge(id) {
                if (confirm('Are you sure delete this data?')) {
                    // ajax delete data to database
                    $.ajax({
                        url: "<?php echo site_url('depot/delete_fridge/')?>/" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data) {
                            //if success reload ajax table
                            $('#modal_form').modal('hide');
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Error adding / update data');
                        }
                    });

                }
            }

        </script>

        <!-- Bootstrap modal -->
        <div class="modal fade" id="fridge_modal_form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="form" class="form-horizontal">

                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Refrigerator Model</label>
                                    <div class="col-md-8">
                                        <select id="model" name="model">
                                            <option value="">--Select Model--</option>
                                            <?php
                                            foreach ($fridge_model as $row) {
                                                echo "<option value='" . $row->id . "'>" . $row->Model . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Temp. Monitor No.</label>
                                    <div class="col-md-8">
                                        <input name="temperature_monitor_no" placeholder="Temperature Monitor No"
                                               class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Main Power Source</label>
                                    <div class="col-md-8">
                                        <select id="main_power_source" name="main_power_source">
                                            <option value="">--Select Power Source--</option>
                                            <option value="Electricity">Electricity</option>
                                            <option value="Solar">Solar</option>
                                            <option value="Gasoline">Gasoline</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Year of Installation</label>
                                    <div class="col-md-8">
                                        <input name="refrigerator_age" placeholder="Year of Installation" type="number"
                                               required="true" min="1950" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Refrigerator Status</label>
                                <div class="col-md-8">
                                    <select id="refrigerator_status" name="refrigerator_status" required="true">
                                        <option value="">--Select Refrigerator's Status--</option>
                                        <option value="Functional">Functional</option>
                                        <option value="Awaiting Repair">Awaiting Repair</option>
                                        <option value="Decommissioned">Decommissioned</option>

                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Bootstrap modal -->

        <!-- Bootstrap modal -->
        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="editform" class="form-horizontal">

                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Temp. Monitor No.</label>
                                    <div class="col-md-8">
                                        <input name="temperature_monitor_no" placeholder="Temperature Monitor No"
                                               class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Main Power Source</label>
                                    <div class="col-md-8">
                                        <select id="main_power_source" name="main_power_source">
                                            <option value="">--Select Power Source--</option>
                                            <option value="Electricity">Electricity</option>
                                            <option value="Solar">Solar</option>
                                            <option value="Gasoline">Gasoline</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Refrigerator Status</label>
                                    <div class="col-md-8">
                                        <select id="refrigerator_status" name="refrigerator_status" required="true">
                                            <option value="">--Select Refrigerator's Status--</option>
                                            <option value="Functional">Functional</option>
                                            <option value="Awaiting Repair">Awaiting Repair</option>
                                            <option value="Decommissioned">Decommissioned</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                        <button type="button" id="btnUpdate" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Bootstrap modal -->

    </div>
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
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-lg-12">
        <?php
        $vvm = array(
            '1'  => 'Stage 1',
            '2'  => 'Stage 2',
            );
        $form_attributes = array('id' => 'issuestock_fm', 'method' => 'post', 'class' => '', 'role' => 'form');
        echo form_open('', $form_attributes); ?>

        <div class="well well-sm"><b>Transaction Details</b></div>

        <div class="row">
            <div class="col-lg-3">
                <div class="panel-body">
                    <b>Issue To</b><br>
                    <select name="issued_to" class="form-control issued_to" id="issued_to" required="true">
                        <option value="">Select Location</option>
                        <?php foreach ($locations as $row) {
                            echo "<option value='" . $row->location . "'>" . $row->location . "</option>";
                        } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel-body">
                    <?php if ($user_object['user_level'] == '1') { ?><b>Voucher #</b> <?php } else { ?><b>S11
                        #</b> <?php } ?>
                    <?php $data = array('name' => 's11', 'id' => 's11', 'class' => 'form-control');
                    echo form_input($data); ?>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="panel-body">
                    <b>Date Issued</b>
                    <?php $data = array('name' => 'date_issued', 'required' => 'true', 'id' => 'datepicker', 'required' => 'true', 'class' => 'form-control');
                    echo form_input($data); ?>

                </div>
            </div>


            <input type="hidden" name="transaction_type" class="transaction_type" value="2">
        </div>

        <div id="stock_issue" class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <div class="well well-sm"><b>Vaccine Details</b></div>


                    <table class="table table-bordered table-hover table-striped">
                        <thead>

                        <th style="width:12%;">Vaccine/Diluents</th>
                        <th style="width:12%;">Batch No.</th>
                        <th style="width:9%;">Expiry </br>Date</th>
                        <th style="width:12%;">Amount </br>Ordered</th>
                        <th style="width:9%;">Stock </br>Quantity</th>
                        <th style="width:15%;">Amount </br>Issued</th>
                        <th style="width:9%;">VVM Status</th>
                        <th style="width:9%;">Action</th>
                        </thead>
                        <tbody>
                        <tr issue_row="1">
                            <input type="hidden" name="transaction_type" class="transaction_type" value="2">
                            <td><select name="vaccine" class="form-control vaccine" id="vaccine" required="true">
                                    <option value="">Select Vaccine</option>
                                    <?php foreach ($vaccines as $vaccine) {
                                        echo "<option value='" . $vaccine['ID'] . "'>" . $vaccine['Vaccine_name'] . "</option>";
                                    } ?>
                                </select></td>
                            <td><select name="batch_no" class="form-control batch_no" id="batch_no"
                                        required="true"></select></td>
                            <td><?php $data = array('name' => 'expiry_date', 'id' => 'expiry_date', 'class' => 'form-control expiry_date', 'required' => 'true', 'readonly' => '');
                                echo form_input($data); ?></td>
                            <style type="text/css">
                                input[id="available_quantity"] {
                                    background-color: #E0F2F7 !important
                                }</style>
                            <td class="small"><?php $data = array('name' => 'amt_ordered', 'id' => 'amt_ordered', 'type' => 'number', ' min' => '0', 'required' => 'true', 'class' => 'form-control amt_ordered');
                                echo form_input($data); ?></td>
                            <td><?php $data = array('name' => 'available_quantity', 'id' => 'available_quantity', 'class' => 'form-control available_quantity', 'readonly' => '', 'value' => '');
                                echo form_input($data); ?></td>
                            <td><?php $data = array('name' => 'amt_issued', 'id' => 'amt_issued', 'class' => 'form-control amt_issued', 'type' => 'number', ' min' => '0', 'required' => 'true');
                                echo form_input($data); ?></td>
                            <td>
                                <select name="vvm_status" class="form-control vvm_status" id="vvm_status" required="true">
                                    <option value="">Select Status</option>
                                    <?php foreach ($vvm as $key=>$value) {
                                        echo "<option value='" . $key . "'>" . $value . "</option>";
                                    } ?>
                                </select>
                            </td>
                            <td class="small">
                                <a href="#" class="add btn"><span class="label label-success"><i
                                            class="fa fa-plus-square"></i> <b>ADD</b></span></a><br>
                                <a href="#" class="remove btn"><span class="label label-danger"><i
                                            class="fa  fa-minus-square"></i> <b>REMOVE</b></span></a>
                            </td>
                            <?php echo form_hidden('date_recorded', date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')))); ?>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <input type="button" name="btn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-danger" value="Submit"/>

    <!--
    <button type="submit" name="stock_issue_fm" id="stock_issue_fm" class="btn btn-sm btn-danger">Submit</button> -->


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
                    <button type="submit" name="stock_issue_fm" id="stock_issue_fm" class="btn btn-sm btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </div>  
</div>

    <?php

    echo form_close(); ?>


    <script type="text/javascript">

        $('#datepicker').datepicker({dateFormat: "yy-mm-dd", maxDate: 0}).datepicker('setDate', null);
        // Add another row in the form on click add

        $(document).on('click', '#stock_issue .add', function () {

            var thisRow = $('#stock_issue tr:last');
            var cloned_object = $(thisRow).clone();

            var issue_row = cloned_object.attr("issue_row");
            var next_issue_row = parseInt(issue_row) + 1;
            cloned_object.attr("issue_row", next_issue_row);

            var vaccine_id = "vaccine" + next_issue_row;
            var vaccine = cloned_object.find(".vaccine");
            vaccine.attr('id', vaccine_id);

            var batch_id = "batch_no" + next_issue_row;
            var batch = cloned_object.find(".batch_no");
            batch.attr('id', batch_id);

            var expiry_id = "expiry_date" + next_issue_row;
            var expiry = cloned_object.find(".expiry_date");
            expiry.attr('id', expiry_id);

            var amt_ordered_id = "amt_ordered" + next_issue_row;
            var amt_ordered = cloned_object.find(".amt_ordered");
            amt_ordered.attr('id', amt_ordered_id);

            var amt_issued_id = "amt_issued" + next_issue_row;
            var amt_issued = cloned_object.find(".amt_issued");
            amt_issued.attr('id', amt_issued_id);

            var vvm_id = "vvm" + next_issue_row;
            var vvm_status = cloned_object.find(".vvm_s");
            vvm_status.attr('id', vvm_id);


            cloned_object.insertAfter(thisRow).find('input').val('');

        });
        // Remove a row from the form
        $('#stock_issue').delegate('.remove', 'click', function () {
            $(this).closest('tr').remove();
        });


        $("#issuestock_fm").submit(function (e) {
            e.preventDefault();//STOP default action
            var vaccine_count = 0;
            $.each($(".vaccine"), function (i, v) {
                vaccine_count++;
            });


            var formURL = "<?php echo base_url();?>stock/save_issued_stock";

            var date_issued = retrieveFormValues('date_issued');
            var date_recorded = retrieveFormValues('date_recorded');
            var issued_to = retrieveFormValues('issued_to');
            var s11 = retrieveFormValues('s11');

            var vaccines = retrieveFormValues_Array('vaccine');
            var batch_no = retrieveFormValues_Array('batch_no');
            var expiry_date = retrieveFormValues_Array('expiry_date');
            var vvm_status = retrieveFormValues_Array('vvm_status');
            var amt_ordered = retrieveFormValues_Array('amt_ordered');
            var amt_issued = retrieveFormValues_Array('amt_issued');


            var dat = new Array();
            var get_date_recorded = date_recorded;
            var get_date_issued = date_issued;
            var get_issued_to = issued_to;

            var get_s11 = s11;

            for (var i = 0; i < vaccine_count; i++) {
                var data = new Array();
                var get_vaccine = vaccines[i];
                var get_batch = batch_no[i];
                var get_expiry = expiry_date[i];
                var get_amount_ordered = amt_ordered[i];
                var get_amount_issued = amt_issued[i];
                var get_vvm_status = vvm_status[i];


                data = {
                    "vaccine_id": get_vaccine,
                    "batch_no": get_batch,
                    "expiry_date": get_expiry,
                    "amount_ordered": get_amount_ordered,
                    "amount_issued": get_amount_issued,
                    "vvm_status": get_vvm_status
                };
                dat.push(data);
            }
            console.log(dat);
            batch = JSON.stringify(dat);
            $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: {
                        "issued_to": get_issued_to,
                        "date_recorded": get_date_recorded,
                        "s11": get_s11,
                        "date_issued": get_date_issued,
                        "batch": batch
                    },
                    /* dataType : json,*/
                    success: function (data, textStatus, jqXHR) {
                        //console.log(data);
                         window.location.replace('<?php echo base_url() . 'stock/list_issue_stock'?>');
                        //data: return data from server
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //if fails
                    }
                });

            // e.unbind(); //unbind. to stop multiple form submit.
        });

        $(document).on('change', '.vaccine', function () {
            var stock_row = $(this);
            /*  var selected_vaccine=$(this).val();*/
            var selected_vaccine = stock_row.val();
            // alert(selected_vaccine);
            load_batches(selected_vaccine, stock_row);
        });

        function load_batches(selected_vaccine, stock_row) {

            var _url = "<?php echo base_url();?>stock/get_batches";

            var request = $.ajax({
                url: _url,
                type: 'post',
                data: {"selected_vaccine": selected_vaccine},

            });
            request.done(function (data) {
                data = JSON.parse(data);
                console.log(data);
                stock_row.closest("tr").find(".batch_no option").remove();
                stock_row.closest("tr").find(".expiry_date ").val("");
                stock_row.closest("tr").find(".available_quantity").val("");
                stock_row.closest("tr").find(".vvm_status").val("");
                stock_row.closest("tr").find(".batch_no ").append("<option value=''>Select batch </option> ");
                $.each(data, function (key, value) {
                    stock_row.closest("tr").find(".batch_no").append("<option value='" + value.batch_number + "'>" + value.batch_number + "</option> ");


                    /*value[0].batch_number;*/

                });
            });
            request.fail(function (jqXHR, textStatus) {

            });
        }


        $(document).on('change', '.batch_no', function () {
            var stock_row = $(this);
            var selected_batch = $(this).val();
            batch_details(selected_batch, stock_row);
        });

        function batch_details(selected_batch, stock_row) {
            var _url = "<?php echo base_url();?>stock/get_batch_details";

            var request = $.ajax({
                url: _url,
                type: 'post',
                data: {"selected_batch": selected_batch},

            });
            request.done(function (data) {
                data = JSON.parse(data);
                console.log(data);
                stock_row.closest("tr").find(".expiry_date ").val("");
                stock_row.closest("tr").find(".available_quantity").val("");
                stock_row.closest("tr").find(".vvm_status").val("");
                $.each(data, function (key, value) {
                    stock_row.closest("tr").find(".expiry_date").val(value.expiry_date);
                    stock_row.closest("tr").find(".available_quantity").val(value.stock_balance);
                    // stock_row.closest("tr").find(".vvm_status").val(value.status);
                    stock_row.closest("tr").find(".amt_issued").attr('max', value.stock_balance);

                });
            });
            request.fail(function (jqXHR, textStatus) {

            });
        }

        //This function loops the whole form and saves all the input, select, e.t.c. elements with their corresponding values in a javascript array for processing

        function retrieveFormValues(name) {
            var dump;
            $.each($("input[name=" + name + "], select[name=" + name + "]"), function (i, v) {
                var theTag = v.tagName;
                var theElement = $(v);
                var theValue = theElement.val();
                dump = theValue;
            });
            return dump;
        }

        function retrieveFormValues_Array(name) {
            var dump = new Array();
            var counter = 0;
            $.each($("input[name=" + name + "], select[name=" + name + "]"), function (i, v) {
                var theTag = v.tagName;
                var theElement = $(v);
                var theValue = theElement.val();
                /*dump[counter] = theElement.attr("value");*/
                dump[counter] = theValue;

                counter++;
            });
            return dump;
        }

    </script>
  
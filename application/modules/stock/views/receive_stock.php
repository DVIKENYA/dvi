<div class="row">
    <div class="col-lg-12">
        <?php
        $form_attributes = array('id' => 'stock_received_fm', 'method' => 'post', 'class' => 'form-inline', 'role' => 'form');
        echo form_open('', $form_attributes); ?>

        <div class="well well-sm"><b>Transaction Details</b></div>

        <div class="row">
            <div class="col-lg-3">
                <div class="panel-body">
                    <b>Origin</b>
                    <?php $data = array('name' => 'received_from', 'id' => 'received_from', 'class' => 'form-control', 'value' => $location, 'readonly' => '');
                    echo form_input($data); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel-body">
                    <b>S11 #</b><br>
                    <?php $data = array('name' => 's11', 'id' => 's11', 'class' => 'form-control', 'type' => 'text');
                    echo form_input($data); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel-body">
                    <b>Date Received</b>
                    <?php $data = array('name' => 'date_received', 'id' => 'date_received', 'class' => 'form-control', 'required' => '', 'type' => 'date', 'autocomplete' => 'off');
                    echo form_input($data); ?>
                </div>
            </div>


        </div>
        <input type="hidden" name="transaction_type" class="transaction_type" value="1">
        <br/>

        <div class="table-responsive">
            <div class="well well-sm"><b>Vaccine Details</b></div>

            <div id="stock_receive_tbl">

                <table class="table table-bordered table-hover table-striped">
                    <thead>

                    <th align="center">Vaccine/Diluents</th>
                    <th>Batch No.</th>
                    <th>Expiry&nbsp;Date</th>
                    <th>Quantity(doses)</th>
                    <th>VVM Status</th>
                    <th>Comment</th>
                    <th>Action</th>
                    </thead>
                    <tbody>

                    <tr align="center" receive_row="1">

                        <td><select name="vaccine" class="vaccine form-control" id="vaccine" required>
                                <option value="">Select Vaccine</option>
                                <?php foreach ($vaccines as $vaccine) {
                                    echo "<option value='" . $vaccine['ID'] . "'>" . $vaccine['Vaccine_name'] . "</option>";
                                } ?>
                            </select></td>


                        <td><?php $data = array('name' => 'batch_no', 'id' => 'batch_no', 'class' => 'batch_no form-control', 'required' => '', 'type' => 'text', 'autocomplete' => 'off');
                            echo form_input($data); ?></td>
                        <td><?php $data = array('name' => 'expiry_date', 'id' => 'expiry_date', 'class' => 'form-control expiry_date', 'type' => 'date', 'required' => '', 'type' => 'date', 'autocomplete' => 'off');
                            echo form_input($data); ?></td>
                        <td><?php $data = array('name' => 'amount_received', 'id' => 'amount_received', 'class' => 'amount_received form-control', 'required' => '', 'type' => 'number');
                            echo form_input($data); ?></td>

                        <td>
                            <select name="vvm_status" class=" form-control vvm_status " id="vvm_status"
                                    name="vvm_status">
                                <option value="">Select Status</option>
                                <option value="1">Stage 1</option>
                                <option value="2">Stage 2</option>
                                <option value="3">Stage 3</option>
                                <option value="4">Stage 4</option>
                            </select></td>

                        <td><?php  $data = array('name'=> 'comment','id'=> 'comment','rows'=> '2','cols'=> '8','class'=> 'form-control comment');
                            echo form_textarea($data);?></td>
                        <td class="small">
                                <a href="#" class="add btn"><span class="label label-success"><i
                                            class="fa fa-plus-square"></i> <b>ADD</b></span></a><br>
                                <a href="#" class="remove btn"><span class="label label-danger"><i
                                            class="fa  fa-minus-square"></i> <b>REMOVE</b></span></a>
                            </td>
                    </tr>

                    </tbody>
                </table>

                <?php echo form_hidden('date_recorded', date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))));  ?>
            </div>

            <input type="button" name="btn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-danger" value="Submit"/>

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
                               <button type="submit" name="stock_received" id="stock_received" class="btn btn-sm btn-danger">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            

            <?php
            echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">

    $('#date_received').datepicker({dateFormat: "yy-mm-dd", maxDate: 0}).datepicker('setDate', null);
    $('#expiry_date').datepicker({dateFormat: "yy-mm-dd", minDate: 0}).datepicker('setDate', null);
    $('#stock_receive_tbl').delegate('.add', 'click', function () {

        var thisRow = $('#stock_receive_tbl tr:last');
        var cloned_object = $(thisRow).clone();

        var receive_row = cloned_object.attr("receive_row");
        var next_receive_row = parseInt(receive_row) + 1;
        cloned_object.attr("receive_row", next_receive_row);

        var vaccine_id = "vaccine" + next_receive_row;
        var vaccine = cloned_object.find(".vaccine");
        vaccine.attr('id', vaccine_id);

        var batch_id = "batch_no" + next_receive_row;
        var batch = cloned_object.find(".batchno_");
        batch.attr('id', batch_id);

        var expiry_id = "expiry_date" + next_receive_row;
        var expiry = cloned_object.find(".expiry_date");
        expiry.removeClass("hasDatepicker").attr('id', expiry_id).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            setDate: null
        });


        var amount_received_id = "amount_received" + next_receive_row;
        var amount_received = cloned_object.find(".amount_received");
        amount_received.attr('id', amount_received_id);

        var vvm_status_id = "vvm_status" + next_receive_row;
        var vvm_status = cloned_object.find(".vvm_status");
        vvm_status.attr('id', vvm_status_id);

        var comment_id = "comment" + next_receive_row;
        var comment = cloned_object.find(".comment");
        comment.attr('id', comment_id);

        cloned_object.insertAfter(thisRow).find('input').val('');
        //cloned_object .insertAfter( thisRow ).find('#expiry_date').datepicker();
    });

    $('#stock_receive_tbl').delegate('.remove', 'click', function () {
        $(this).closest('tr').remove();
    });


    $("#stock_received_fm").submit(function (e) {
        e.preventDefault();//STOP default action
        var vaccine_count = 0;
        $.each($(".vaccine"), function (i, v) {
            vaccine_count++;
        });


        var formURL = "<?php echo base_url();?>stock/save_received_stocks";

        var vaccines = retrieveFormValues_Array('vaccine');
        var s11 = retrieveFormValues('s11');
        var batch_no = retrieveFormValues_Array('batch_no');
        var expiry_date = retrieveFormValues_Array('expiry_date');
        var amount_received = retrieveFormValues_Array('amount_received');
        var vvm_status = retrieveFormValues_Array('vvm_status');
        var comment = retrieveCommentValues_Array('comment');
        var date_received = retrieveFormValues('date_received');
        var date_recorded = retrieveFormValues('date_recorded');
        var received_from = retrieveFormValues('received_from');
        var transaction_type = retrieveFormValues('transaction_type');

        var dat = new Array();
        var get_date_received = date_received;
        var get_date_recorded = date_recorded;
        var get_received_from = received_from;
        var get_transaction_type = transaction_type;
        var get_s11 = s11;

        for (var i = 0; i < vaccine_count; i++) {
            var data = new Array();
            var get_vaccine = vaccines[i];
            var get_batch = batch_no[i];
            var get_expiry = expiry_date[i];
            var get_amount_received = amount_received[i];
            var get_vvm_status = vvm_status[i];
            var get_comment = comment[i];


            data = {
                "vaccine_id": get_vaccine,
                "batch_no": get_batch,
                "expiry_date": get_expiry,
                "amount_received": get_amount_received,
                "vvm_status": get_vvm_status,
                "comment": get_comment
            };
            dat.push(data);
        }
        console.log(dat);
        batch = JSON.stringify(dat);
        $.ajax(
            {
                //
                url: formURL,
                type: "POST",
                data: {
                    "transaction_type": get_transaction_type,
                    "date_received": get_date_received,
                    "date_recorded": get_date_recorded,
                    "received_from": get_received_from,
                    "s11": get_s11,
                    "batch": batch
                },
                success: function (data, textStatus, jqXHR) {
                    //data: return data from server
                    window.location.replace('<?php echo base_url() . 'stock/list_inventory'?>');


                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                }
            });

        // e.unbind(); //unbind. to stop multiple form submit.
    });

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

    
    function retrieveCommentValues_Array(name) {
        var dump = new Array();
        var counter = 0;
         $.each($("textarea[name=" + name + "]"), function (i, v) {
            var theTag = v.tagName;
            var theElement = $(v);
            var theValue = theElement.val();
            /*dump[counter] = theElement.attr("value");*/
            dump[counter] = theValue;

            counter++;
        });
        return dump;
    }

    window.onbeforeunload = function () {

    }

</script>
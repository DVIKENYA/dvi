<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo $this->session->flashdata('msg'); ?>

<?php
$group = array();
$group[] = "Select One";
foreach ($magroups as $row) {
    $group[$row->id] = $row->name;

}
$level = array();
$level[] = "Select One";
foreach ($malevels as $row) {
    $level[$row->id] = $row->name;
}

$region = array();
$region[] = "Select One";
foreach ($maregion as $row) {
    $region[$row->id] = $row->region_name;
}


$nation = array('Select One', 'Kenya');
$national ="";
$regional ="";
?>


<div class="row">
    <div class="col-md-12">
        <div class="block-web">
            <div class="porlets-content">

                <?php echo form_open('users/register', 'class="form"'); ?>
                <div class="form-section ">

                    <?php
                    echo form_label('Enter First Name', 'f_name');
                    echo form_error('f_name');
                    echo form_input(['name' => 'f_name', 'id' => 'f_name', 'value' => $f_name, 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter First Name']);

                    echo form_label('Enter Last Name', 'l_name');
                    echo form_error('l_name');
                    echo form_input(['name' => 'l_name', 'id' => 'l_name', 'value' => $l_name, 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter Last Name']);

                    echo form_label('Enter Phone Number', 'phone');
                    echo form_error('phone');
                    echo form_input(['name' => 'phone', 'id' => 'phone', 'value' => $phone, 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter Phone Number']);

                    echo form_label('Enter Email Address', 'email');
                    echo form_error('email');
                    echo form_input(['name' => 'email', 'id' => 'email', 'value' => $email, 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter Email']);
                    ?>

                </div>

                <div class="form-section ">
                    <?php
                    echo form_label('Enter User Name', 'username');
                    echo form_error('username');
                    echo form_input(['name' => 'username', 'id' => 'username', 'value' => $username, 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter Username ']);
                    echo form_label('Enter Password', 'password');
                    echo form_error('modulename_name');
                    echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Enter Password']);
                    echo form_label('RE-Enter Password', 'password');
                    echo form_error('modulename_name');
                    echo form_password(['name' => 'passwordc', 'id' => 'passwordc', 'class' => 'form-control', 'required' => '', 'placeholder' => 'RE-Enter Password']);
                    ?>

                </div>

                <div class="form-section ">
                    <div class="form-group" id="user_group">
                    <?php
                    echo form_label('Enter User Group','user_group');
                    echo form_error('user_group');
                    echo form_dropdown('user_group', $group, $user_group, 'id="user_group" class="form-control"');
                    ?>
                    </div>
                    <div class="form-group" id="user_level">
                        <?php
                        echo form_label('Enter Access Level', 'user_level');
                        echo form_error('user_level');
                        echo form_dropdown('user_level', $level, $user_level, 'id="user_level" class="form-control"');
                        ?>
                    </div>
                    <div class="form-group" id="base1">
                        <?php
                        echo form_label('Enter National Base', 'national');
                        echo form_error('national');
                        //echo form_input(['name' => 'user_group', 'id' => 'user_group',  'value' => $user_group ,'class' => 'form-control', 'placeholder' => 'Enter User Group ID']);
                        echo form_dropdown('national', $nation, set_value($national), 'id="national" class="form-control"');
                        ?>
                    </div>
                    <div class="form-group" id="base2">
                        <?php
                        echo form_label('Enter Regional Base ', 'regional');
                        echo form_error('regional');
                        echo form_dropdown('regional', $region, set_value($regional), 'id="regional" class="form-control"');
                        ?>
                    </div>
                    <div class="form-group" id="base3">
                        <label>Enter County Base</label>
                        <select name="countyuser" class="form-control" id="countyuser"></select>
                    </div>
                    <div class="form-group" id="base4">
                        <label>Enter Sub County Base</label>
                        <select name="subcountyuser" class="form-control" id="subcountyuser"></select>
                    </div>
                    <div class="form-group" id="base5">
                        <label>Enter Facility Base</label>
                        <select name="facilityuser" class="form-control" id="facilityuser"></select>

                        </div>
                    </div>
                    <div class="form-navigation">
                        <button type="button" class="previous btn btn-info pull-left">&lt; Previous</button>
                        <button type="button" class="next btn btn-info pull-right">Next &gt;</button>
                        <button class="btn btn-danger pull-right" name="submit" type="submit">Submit</button>
                        <span class="clearfix"></span>
                    </div>
                    <?php
                    if (isset($update_id)){
                        echo form_hidden('update_id', $update_id);
                    }
                    echo form_close(); ?>

                </div><!--/porlets-content-->
            </div><!--/block-web-->
        </div><!--/col-md-6-->
    </div>


    <script type="text/javascript">
        $(document).ready(function () {

            //start of user basestation assignment
            $("#base1").hide();
            $("#base2").hide();
            $("#base3").hide();
            $("#base4").hide();
            $("#base5").hide();

            $('#user_level select').change(function () {
                var selLevel = $(this).val();
                console.log(selLevel);

                if (selLevel == '1') {

                    // console.log("Detected change... National");
                    $("#base1").show();
                    $("#base2").hide();
                    $("#base3").hide();
                    $("#base4").hide();
                    $("#base5").hide();

                } else if (selLevel == '2') {
                    // console.log("Detected change... Regional");
                    $("#base1").show();
                    $("#base2").show();
                    $("#base3").hide();
                    $("#base4").hide();
                    $("#base5").hide();
                } else if (selLevel == '3') {
                    // console.log("Detected change... County");
                    $("#base1").show();
                    $("#base2").show();
                    $("#base3").show();
                    $("#base4").hide();
                    $("#base5").hide();


                } else if (selLevel == '4') {
                    // console.log("Detected change... Subcounty");
                    $("#base1").show();
                    $("#base2").show();
                    $("#base3").show();
                    $("#base4").show();
                    $("#base5").hide();
                } else if (selLevel == '5') {
                    // console.log("Detected change... Facility");
                    $("#base1").show();
                    $("#base2").show();
                    $("#base3").show();
                    $("#base4").show();
                    $("#base5").show();
                } else {
                    //cleanup function

                    $("#base1").hide();
                    $("#base2").hide();
                    $("#base3").hide();
                    $("#base4").hide();
                    $("#base5").hide();
                }

            });
            //End of user basestation assignment

        });


        $(document).ready(function () {
            $("#regional").change(function () {
                var regional = $(this).val();
                console.log(regional);
                var request = $.ajax({
                    url: "<?php echo base_url(); ?>users/getCountyByRegion/" + regional,
                    data: regional,
                    type: "POST",
                });
                request.done(function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    $("#countyuser option").remove();
                    $('#countyuser').append("<option value=''>--Select County Base--</option> ");
                    $.each(data, function (key, value) {
                        $('#countyuser').append("<option value='" + value.county_id + "'>" + value.county_name + "</option>");
                    });
                });
                request.fail(function (jqXHR, textStatus) {
                });
            });
        });

        $(document).ready(function () {
            $("#countyuser").change(function () {
                var countyuser = $(this).val();
                console.log(countyuser);
                var request = $.ajax({
                    url: "<?php echo base_url(); ?>users/getSubcountyByCounty/" + countyuser,
                    data: countyuser,
                    type: "POST",
                });
                request.done(function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    $("#subcountyuser option").remove();
                    $('#subcountyuser').append("<option value=''>--Select Sub County Base--</option> ");
                    $.each(data, function (key, value) {
                        $('#subcountyuser').append("<option value='" + value.subcounty_id + "'>" + value.subcounty_name + "</option>");
                    });
                });
                request.fail(function (jqXHR, textStatus) {
                });
            });
        });

        $(document).ready(function () {
            $("#subcountyuser").change(function () {
                var subcountyuser = $(this).val();
                console.log(subcountyuser);
                var request = $.ajax({
                    url: "<?php echo base_url(); ?>users/getFacilityBySubcounty/" + subcountyuser,
                    data: subcountyuser,
                    type: "POST",
                });
                request.done(function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    $("#facilityuser option").remove();
                    $('#facilityuser').append("<option value=''>--Select Facility Base--</option> ");
                    $.each(data, function (key, value) {
                        $('#facilityuser').append("<option value='" + value.facility_id + "'>" + value.facility_name + "</option>");
                    });
                });
                request.fail(function (jqXHR, textStatus) {
                });
            });
        });

    </script>

    <script type="text/javascript">

        window.setTimeout(function () {
            $("#alert-message").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 5000);

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(function () {
                var $sections = $('.form-section');

                function navigateTo(index) {
                    // Mark the current section with the class 'current'
                    $sections
                        .removeClass('current')
                        .eq(index)
                        .addClass('current');
                    // Show only the navigation buttons that make sense for the current section:
                    $('.form-navigation .previous').toggle(index > 0);
                    var atTheEnd = index >= $sections.length - 1;
                    $('.form-navigation .next').toggle(!atTheEnd);
                    $('.form-navigation [type=submit]').toggle(atTheEnd);
                }

                function curIndex() {
                    // Return the current index by looking at which section has the class 'current'
                    return $sections.index($sections.filter('.current'));
                }

                // Previous button is easy, just go back
                $('.form-navigation .previous').click(function () {
                    navigateTo(curIndex() - 1);
                });

                // Next button goes forward iff current block validates
                $('.form-navigation .next').click(function () {
                    if ($('.form').parsley().validate({group: 'block-' + curIndex()}))
                        navigateTo(curIndex() + 1);
                });

                // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
                $sections.each(function (index, section) {
                    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
                });
                navigateTo(0); // Start at the beginning
            });
        });
    </script>
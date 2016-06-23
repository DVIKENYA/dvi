<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$location = array();
$location[] = "Select Location";
foreach ($locations as $row) {
    $location[$row->location] = $row->location;
}

?>
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <?php //echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
        <h1>Add New Store</h1>
        <?php echo form_open('depot/submit', array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <?php
            echo form_label('Depot Location', 'depot_location');
            echo form_error('depot_location');
            echo form_dropdown('depot_location', $location, $depot_location, 'id="depot_location" class="form-control"');

            ?>
        </div>
        
        <div class="form-group">
            <?php
            echo form_label('Store Officer', 'officer');
            echo form_error('officer');
            echo form_input(['name' => 'officer', 'id' => 'officer', 'pattern' => '[a-zA-Z\s]+', 'value' => $officer, 'class' => 'form-control', 'placeholder' => 'Full Name']);
            ?>
        </div>

        <div class="form-group">
            <?php
            echo form_label('Mobile Phone Number', 'officer_phone');
            echo form_error('officer_phone');
            echo form_input(['name' => 'officer_phone', 'id' => 'officer_phone', 'pattern' => "[07]{2}[0-9]{8}", 'value' => $officer_phone, 'class' => 'form-control', 'placeholder' => 'e.g. 0712345678']);
            ?>
        </div>

        <div class="form-group">
            <?php
            echo form_label('Email Address', 'officer_email');
            echo form_error('officer_email');
            echo form_input(['name' => 'officer_email', 'id' => 'officer_email', 'pattern' => "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$", 'value' => $officer_email, 'class' => 'form-control', 'placeholder' => 'e.g. someone@example.com']);
            ?>
        </div>

        <div class="col-lg-6 col-lg-offset-4">
            <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Create Store</button>
        </div>
        <?php

        if (isset($update_id)) {
            echo form_hidden('update_id', $update_id);
        }
        echo form_close(); ?>
    </div>
</div>

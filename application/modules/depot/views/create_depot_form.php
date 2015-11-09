<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      <h1>Add New Depot</h1>
	  <?php 
	$region_array = array();
	foreach($region as $row ){
		$region_array[$row->region_name] = $row->region_name;
	}
	$county_array = array();
	foreach($county as $row ){
		$county_array[$row->county_name] = $row->county_name;
	}	
	$subcounty_array = array();
	foreach($subcounty as $row ){
		$subcounty_array[$row->subcounty_name] = $row->subcounty_name;
	}
	?>
      <?php echo form_open('depot/submit',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Depot Name','depot_location');
        echo form_error('depot_location');
        echo form_input(['name' => 'depot_location', 'id' => 'depot',  'value' => $depot_location ,'class' => 'form-control', 'placeholder' => 'Enter Depot Name']);
        ?>
      </div>
     <div class="form-group">
        <?php
        echo form_label('Region','region_id');
        echo form_error('region_id');
		echo form_dropdown('region_id',$region_array , $region_id, 'id="region_id" class="form-control"'); 
        ?>
      </div>
	  <div class="form-group">
        <?php
        echo form_label('County','county_id');
        echo form_error('county_id');
		echo form_dropdown('county_id',$county_array , $county_id, 'id="county_id" class="form-control"'); 
        ?>
      </div>
     <div class="form-group">
        <?php
        echo form_label('Sub-couty','subcounty_id');
        echo form_error('subcounty_id');
        echo form_dropdown('subcounty_id',$subcounty_array , $subcounty_id, 'id="subcounty_id" class="form-control"'); 
        ?>
      </div>
     
      <div class="col-lg-6 col-lg-offset-4">
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Create Depot</button>
      </div>
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>

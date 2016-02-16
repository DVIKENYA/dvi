<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">

    <?php //echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      <h1>Region Details</h1>
      <?php echo form_open('region/submit',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Region Name','region_name');
        echo form_error('region_name');
        echo form_input(['name' => 'region_name', 'id' => 'region', 'pattern'=>'[a-zA-Z\s]+',  'value' => $region_name ,'class' => 'form-control', 'placeholder' => 'Enter Region Name']);
        ?>
      </div>
     <div class="form-group">
        <?php
        echo form_label('Region Headquarter','region_headquarter');
        echo form_error('region_headquarter');
        echo form_input(['name' => 'region_headquarter', 'id' => 'region','pattern'=>'[a-zA-Z\s]+',  'value' => $region_headquarter ,'class' => 'form-control', 'placeholder' => 'Enter Region Headquarter']);
        ?>
      </div>
	  <div class="form-group">
        <?php
        echo form_label('Region Manager','region_manager');
        echo form_error('region_manager');
        echo form_input(['name' => 'region_manager', 'id' => 'region','pattern'=>'[a-zA-Z\s]+',  'value' => $region_manager ,'class' => 'form-control', 'placeholder' => 'Enter Name of Region Manager']);
        ?>
      </div>
	  <div class="form-group">
        <?php
        echo form_label('Mobile Phone of Region Manager','region_manager_phone');
        echo form_error('region_manager_phone');
        echo form_input(['name' => 'region_manager_phone','pattern'=>"[07]{2}[0-9]{8}", 'id' => 'region',  'value' => $region_manager_phone ,'class' => 'form-control', 'placeholder' => 'e.g. 0712345678' ]);
        ?>
      </div>
     
     <div class="form-group">
        <?php
        echo form_label('Email of Region Manager','region_manager_email');
        echo form_error('region_manager_email');
        echo form_input(['name' => 'region_manager_email', 'id' => 'region', 'pattern'=>"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$", 'value' => $region_manager_email ,'class' => 'form-control', 'placeholder' => 'e.g. someone@example.com']);
        ?>
      </div>
     
      <div >
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Submit</button>
      </div>
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>

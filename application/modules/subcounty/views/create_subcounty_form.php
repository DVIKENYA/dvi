<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
<!--    --><?php //echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      <h1>Add New Sub County</h1>
      <?php echo form_open('subcounty/submit',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Sub County Name','subcounty_name');
        echo form_error('subcounty_name');
        echo form_input(['name' => 'subcounty_name', 'pattern'=>'[a-zA-Z\s]+', 'id' => 'subcounty',  'value' => $subcounty_name ,'readonly' => '','class' => 'form-control', 'placeholder' => 'Enter Sub County Name']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('County Name','county_id');
        echo form_error('county_id');
        echo form_input(['name' => 'county_id', 'id' => 'county_id',  'value' => $county_id ,'class' => 'form-control', 'placeholder' => 'Enter County Name']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Estimated Total Population','population');
        echo form_error('population');
        echo form_input(['name' => 'population', 'type'=>'number', 'min'=>'0', 'id' => 'population',  'value' => $population ,'class' => 'form-control', 'placeholder' => 'Enter Population']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Estimated Population Under One','population_one');
        echo form_error('population_one');
        echo form_input(['name' => 'population_one','type'=>'number', 'min'=>'0', 'id' => 'population_one',  'value' => $population_one ,'class' => 'form-control', 'placeholder' => 'Enter Population']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Estimated Population of Women','population_women');
        echo form_error('population_women');
        echo form_input(['name' => 'population_women', 'type'=>'number', 'min'=>'0','id' => 'population_women',  'value' => $population_women ,'class' => 'form-control', 'placeholder' => 'Enter Population']);
        ?>
      </div>
     <div class="form-group">
        <?php
        echo form_label('Number of Health Facilities','no_facilities');
        echo form_error('no_facilities');
        echo form_input(['name' => 'no_facilities', 'type'=>'number', 'min'=>'0','id' => 'no_facilities',  'value' => $no_facilities ,'class' => 'form-control', 'placeholder' => 'Enter Number']);
        ?>
      </div>
      <div >
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Create Sub County</button>
      </div>
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>

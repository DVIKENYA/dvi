<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
    <?php //echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      <h1>Add New Group</h1>
      <?php echo form_open('group/submit',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Group Name','name');
        echo form_error('name');
        echo form_input(['name' => 'name', 'id' => 'name',  'value' => $name ,'class' => 'form-control', 'placeholder' => 'Enter Group Name']);
        ?>
      </div>
     <div class="form-group">
        <?php
        echo form_label('Group Description','description');
        echo form_error('description');
        echo form_input(['name' => 'description', 'id' => 'description',  'value' => $description ,'class' => 'form-control', 'placeholder' => 'Enter Group Description']);
        ?>
      </div>
      
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Create Group</button>
     
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>

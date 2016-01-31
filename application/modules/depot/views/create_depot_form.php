<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
// $location = array();
// $location[]="Select Location";
//   foreach($locations as $row ){
//     $location[$row->location] = $row->location; 
//   }

?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      <h1>Add New Depot</h1>
       <?php echo form_open('depot/submit',array('class'=>'form-horizontal'));?>
      <div class="form-group">
          <?php
          echo form_label('Depot Location','depot_location');
          //echo form_error('depot_location');
          echo form_input(['name' => 'depot_location', 'id' => 'depot_location',  'value' =>  $depot_location,'class' => 'form-control', 'type' => 'text']);     
        // echo form_label('Depot Location','depot_location');
        // echo form_error('depot_location');
        // echo form_dropdown('depot_location', $location, 'id="depot_location" class="form-control"'); 
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

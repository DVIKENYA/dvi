<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
    <?php //echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');
	 	  
	 $array = array();
      $x=0;
      foreach($mafridge as $row ){
         
         $array[$row->id] = $row->Model;

}

 
	?>
      <h1>Add Fridge</h1>
      <?php echo form_open('fridges/submit',array('class'=>'form-horizontal', ));?>
      <div class="form-group">
        <?php
        echo form_label('Select Make/Model','Model');
        echo "<br>";
        echo form_error('Model');
        echo form_dropdown('Model',$array , $Model, 'id="Model" class="form-control"'); 
        ?>
      </div>
	 <?php echo form_hidden('date_added',date('Y-m-d',strtotime(date('Y-m-d'))));
 $user_id = ($this->session->userdata['logged_in']['user_id']);
echo form_hidden('user',$user_id);
$station = ($this->session->userdata['logged_in']['user_id']);
echo form_hidden('station',$station);
?>
       
		      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Submit</button>

      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>

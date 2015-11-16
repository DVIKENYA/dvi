<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="col-md-4 col-md-offset-7 col-sm-6">
 <div class="login_page">
  <div class="registration">
     

  <div class="panel-heading border login_heading">SIGN IN</div> 

       <?php 
      echo $this->session->flashdata('msg');?>
      <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>     
       <?php echo form_open('users/login_process');?>
         <div class="form-group">
              <?php
              echo form_label('Enter User Name','username');
              echo form_error('username');
              echo form_input(['name' => 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Enter Username Name']);
              ?>
          </div>
    <div class="form-group">
              <?php
              echo form_label('Enter Password','password');
              echo form_error('modulename_name');
              echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter Password']);
              ?>
    </div>
      
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">LOGIN</button>
    <?php echo form_close();?>

        <hr/>
    <img src="<?php echo base_url() ?>assets/images/coat_of_arms.png" width="25" height="25" /><span class="theme_color">&nbsp;&nbsp;<b>DVI KENYA</b></span> &copy; <?PHP echo date("Y"); ?> <span class="plus"><i class="fa fa-2x fa-lock" title="secure website"></i></span>

 </div>

  </div>
</div>
<script type="text/javascript">
window.setTimeout(function() {
    $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

</script>
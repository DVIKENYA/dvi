<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
   <div class="row">
       <div class="col-lg-4 col-lg-offset-4">
      <?php echo $this->session->flashdata('msg');  ?>
      <?php //echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
 <?php echo form_open('users/register');?>
   
<?php  
$group = array();
  foreach($magroups as $row ){
    $group[$row->id] = $row->name;
    
  }

?>


   <div class="form-group">
        <?php
        echo form_label('Enter First Name','f_name');
        echo form_error('f_name');
        echo form_input(['name' => 'f_name', 'id' => 'f_name',  'value' => $f_name ,'class' => 'form-control', 'placeholder' => 'Enter First Name']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Enter Last Name','l_name');
        echo form_error('l_name');
        echo form_input(['name' => 'l_name', 'id' => 'l_name',  'value' => $l_name ,'class' => 'form-control', 'placeholder' => 'Enter Last Name']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Enter User Name','username');
        echo form_error('username');
        echo form_input(['name' => 'username', 'id' => 'username',  'value' => $username ,'class' => 'form-control', 'placeholder' => 'Enter Username Name']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Enter Phone Number','phone');
        echo form_error('phone');
        echo form_input(['name' => 'phone', 'id' => 'phone', 'pattern'=>"[07]{2}[0-9]{8}" , 'value' => $phone ,'class' => 'form-control', 'placeholder' => 'Enter Phone Number']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Enter Email Address','email');
        echo form_error('email');
        echo form_input(['name' => 'email', 'id' => 'email',  'value' => $email ,'class' => 'form-control', 'placeholder' => 'Enter Email']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Enter Title Name','title');
        echo form_error('title');
        echo form_input(['name' => 'title', 'id' => 'title',  'value' => $title ,'class' => 'form-control', 'placeholder' => 'Enter Title']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Enter User Group','user_group');
        echo form_error('user_group');
        //echo form_input(['name' => 'user_group', 'id' => 'user_group',  'value' => $user_group ,'class' => 'form-control', 'placeholder' => 'Enter User Group ID']);
       echo form_dropdown('user_group', $group, $user_group, 'id="user_group" class="form-control"'); 
        ?>
      </div>
     <div class="form-group">
        <?php
        echo form_label('Enter Password','password');
        echo form_error('modulename_name');
        echo form_password(['name' => 'password', 'id' => 'password' ,'class' => 'form-control', 'placeholder' => 'Enter Password']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('RE-Enter Password','password');
        echo form_error('modulename_name');
        echo form_password(['name' => 'passwordc', 'id' => 'passwordc', 'class' => 'form-control', 'placeholder' => 'RE-Enter Password']);
        ?>
      </div>
      
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">REGISTER</button>
    <?php echo form_close();?>
</div>
<?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
</div>
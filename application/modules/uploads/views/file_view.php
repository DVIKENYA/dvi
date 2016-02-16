<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
 
 

 <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
    <?php echo $this->session->flashdata('msg');  ?>
    <?php //echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
     
      <?php echo form_open_multipart('uploads/do_upload',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Document Name','file_name');
        echo form_error('file_name');
        echo form_input(['name' => 'file_name', 'id' => 'file_name', 'class' => 'form-control', 'placeholder' => 'Enter Document Name']);
        ?>
      </div>
     <div class="form-group">
        <?php
        echo form_label('Purpose of Document','purpose');
        echo form_error('purpose');
        echo form_input(['name' => 'purpose', 'id' => 'purpose',  'class' => 'form-control', 'placeholder' => 'Purpose of Document']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Year of Publication','published');
        echo form_error('published');
        echo form_input(['name' => 'published', 'id' => 'published',  'class' => 'form-control', 'placeholder' => 'Year of Publication']);
        ?>
      </div>
      
      
      <div class="form-group">
        <?php
        echo form_label('Choose Document to Upload','userfile');
        echo form_error('userfile');
        echo form_upload(['name' => 'userfile', 'id' => 'userfile',  'class' => 'form-control']);
        ?>
      </div>
      <div >
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Upload File</button>
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

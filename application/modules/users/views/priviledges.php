<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('modulename/create');?>" class="btn btn-primary">Add modulename</a>
    </div>
  </div>
  <div class="row">
  </br>
  </br>
  <?php echo $this->session->flashdata('msg');  ?>
    <div class="col-lg-12" style="margin-top: 10px;">
     

  <script type="text/javascript">
window.setTimeout(function() {
    $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

</script>

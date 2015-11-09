<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('depot/create');?>" class="btn btn-primary">Add Depot</a>
    </div>
  </div>
  <div class="row">
  </br>
  </br>
  <?php echo $this->session->flashdata('msg');  ?>
    <div class="col-lg-12" style="margin-top: 10px;">
     <div class="table-responsive">
  <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Depot Depot </th>
                                        <th>Depot Region </th>
                                        <th>Depot County</th>
                                        <th>Depot Sub-County </th>
                                        <td align="center"><b>Edit</b></td>
                                        <td align="center"><b>Delete</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($records->result() as $row){
                                        $edit_url = base_url().'depot/create/'.$row->id;
                                        $delete_url = base_url().'depot/delete/'.$row->id;
                                      ?>
                                    <tr>
                                        <td><?php echo $row->depot_location ?></td>
                                        <td><?php echo $row->region_id ?></td>
                                        <td><?php echo $row->county_id ?></td>
                                        <td><?php echo $row->subcounty_id ?></td>
                                        <td align="center"><a href="<?php echo $edit_url ?>"><i class="fa fa-edit"></i></a></td>
                                        <td align="center"><a href="<?php echo $delete_url ?>"><i class="fa fa-trash-o"></i></td>
                                       
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                    <hr>
                    </br>
                    
                    <?php 

                    //echo $this->table->generate($records);
                    echo $this->pagination->create_links(); ?>
                    
                    
                    
                
                        </div>

  <script type="text/javascript">
window.setTimeout(function() {
    $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

</script>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('users/create_user');?>" class="btn btn-primary">Add New User</a>
    </div>
  </div>
  <div class="row">
  <br>
  <br>
  <?php echo $this->session->flashdata('msg');  ?>
    <div class="col-lg-12" style="margin-top: 10px;">
     <div class="table-responsive">
  <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>

                                 
                                        <th>Names</th>
                                        
                                        <th>Phone</th>
                                        <th>Email </th>
                                        <th>User Group </th>
                                        <th>User Level </th>
                                       <td align="center"><b>Edit</b></td> 
                                       <td align="center"><b>Delete</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($records->result() as $row){
                                        $edit_url = base_url().'users/create_user/'.$row->id;
                                        $delete_url = base_url().'users/delete/'.$row->id;
                                      ?>
                                    <tr>
                                        <td><?php echo $row->f_name."  ".$row->l_name ?></td>
                                       
                                        <td><?php echo $row->phone ?></td>
                                        <td><?php echo $row->email ?></td>
                                        <td><?php echo $row->user_group ?></td>
                                        <td><?php echo $row->user_level ?></td>
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

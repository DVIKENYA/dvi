<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
  </br>
  </br>
  <?php echo $this->session->flashdata('msg');  ?>
    <div class="col-lg-12" style="margin-top: 10px;">
     <div class="table-responsive">
  <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                    <th>File Name</th>
                                        <th>Purpose </th>
                                         <th>Year Published</th>
                                        <th>Uploaded By</th>
                                        <th>Date Uploaded</th>
                                        <td align="center"><b>Download</b></td>
                                         <?php            
                                        if ( $user_object['user_level']=='1') {?>
                                        <td align="center"><b>Delete</b></td>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($files->result() as $row){
                                        $edit_url = base_url().'uploads/download_file/'.$row->raw_name;;
                                        $delete_url = base_url().'uploads/delete/'.$row->id;
                                      ?>
                                    <tr>
                                        <td><?php echo $row->file_name ?></td>
                                        <td><?php echo $row->purpose ?></td>
                                        <td><?php echo $row->published ?></td>
                                        <td><?php echo $row->owner ?></td>
                                        <td><?php echo $row->upload_date ?></td>
                                        <td align="center"><a href="<?php echo $edit_url ?>"><i class="fa fa-cloud-download"></i></a></td>
                                         <?php            
                                        if ( $user_object['user_level']=='1') {?>
                                        <td align="center"><a href="<?php echo $delete_url ?>"><i class="fa fa-trash-o"></i></td>
                                    </tr>
                                    <?php } ?><?php } ?>
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

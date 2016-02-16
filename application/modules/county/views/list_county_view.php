<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12">
<!--      <a href="--><?php //echo site_url('county/create');?><!--" class="btn btn-primary">Add County</a>-->
    </div>
  </div>
  <div class="row">


  <?php echo $this->session->flashdata('msg');  ?>
    <div class="col-lg-12" style="margin-top: 10px;">
     <div class="table-responsive">
  <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>County Name</th>
										                    <th>Population</th>
										                    <th>Population One</th>
										                    <th>Women Population</th>
                                        <td align="center"><b>Edit</b></td>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($records->result() as $row){
                                        $edit_url = base_url().'county/create/'.$row->id;
                                       
                                      ?>
                                    <tr>
                                        <td><?php echo $row->county_name ?></td>
                    					           <td><?php echo $row->population ?></td>

										                    <td><?php echo $row->population_one ?></td>
										                    <td><?php echo $row->population_women ?></td>
										
										<td align="center"><a href="<?php echo $edit_url ?>"><i class="fa fa-edit"></i></a></td>

                                       
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
                
                        </div>

  <script type="text/javascript">
window.setTimeout(function() {
    $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

</script>

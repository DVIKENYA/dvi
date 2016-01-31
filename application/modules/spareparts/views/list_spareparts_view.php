<?php defined('BASEPATH') OR exit('No direct script access allowed');?>  
<div class="row">
  <div class="col-lg-12 col-sm-12">
    <div class="panel default blue_title h2">
      <div class="panel-body">
        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a data-toggle="tab" href="#tab1"><b>Spare Parts Management</b></a></li>
          <li><a data-toggle="tab" href="#tab2"><b>Spares Requests   <span class="badge">14</span></b></a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div id="tab1" class="tab-pane fade in active">

            <a href="<?php echo site_url('spareparts/create');?>" class="btn btn-primary" >Add New Spare Part</a> 
            <div class="btn-group pull-right">
              <button class="btn btn-success dropdown-toggle " data-toggle="dropdown"> Add Options <span class="caret"></span> </button>
              <ul class="dropdown-menu">
                <li> <a href="<?php echo site_url('e_name');?>">New Equipment Option</a> </li>
                <li class="divider"></li>
                <li> <a href="<?php echo site_url('e_type');?>">New Spare Part Type </a> </li>

              </ul>
            </div>
            <br>
            <?php echo $this->session->flashdata('msg');  ?>
            <br>
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th>Spare Parts #</th>
                    <th>Equipment</th>
                    <th>Spare Part Type</th>
                    <th>Spare Part Name</th>
                    <th>Manufacturer</th>
                    <th>Model</th>
                    <th>catalogue #</th>
                    <th>Serial #</th>
                    <th>Quantity</th>


                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($records->result() as $row){

                    ?>
                    <tr>
                      <td><?php echo $row->id ?></td>
                      <td><?php echo $row->equipment ?></td>
                      <td><?php echo $row->etype ?></td>
                      <td><?php echo $row->part_type ?></td>
                      <td><?php echo $row->brand ?></td>
                      <td><?php echo $row->model ?></td>
                      <td><?php echo $row->catalogue ?></td>
                      <td><?php echo $row->serial ?></td>
                      <td><?php echo $row->quantity ?></td>



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
          <div id="tab2" class="tab-pane fade">

            <a href="<?php echo site_url('spareparts/create');?>" class="btn btn-primary" >Issue Item</a> 
            <br><br>
            <table class="table table-bordered table-striped">
              <thead>
                <tr><th>Job Card # </th><th>Date Created</th><th>Job Card Owner</th><td align="center"><b>Action</b></td></tr>
              </thead>

              <tbody>
                <tr>
                  <td>002</td>
                  <td>205-11-28</td>
                  <td>Baringo County</td>
                  <td align="center"><a href="#" class="btn btn-danger btn-xs">View <i class="fa fa-eye"></i></a></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
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

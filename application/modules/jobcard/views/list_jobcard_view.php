<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12 col-sm-12">

      <a href="<?php echo site_url('jobcard/create');?>" class="btn btn-primary" >Create Job Card</a>
    </div>
  </div>
  </br>
  
  <div class="well well-sm"><b>View Job Cards</b></div>
  
<div class="row">
  
  <?php echo $this->session->flashdata('msg');  ?>
<div class="col-lg-12 col-sm-12">
 <div class="panel default blue_title h2">

              <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab">

                  <li class="active"><a data-toggle="tab" href="#tab1"><b>My Job Cards</b></a></li>
                  <li><a data-toggle="tab" href="#tab2"><b>Open Job Cards</b></a></li>
                  <li><a data-toggle="tab" href="#tab3"><b>Job Card History</b></a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div id="tab1" class="tab-pane fade in active">
                   
<!--Listing Submitted Orders-->


    <table class="table table-bordered table-striped">
        <thead>
                <tr><th>Job Card # </th><th>Date Created</th><td colspan="2" align="center"><b>Action</b></td></tr>
        </thead>

        <tbody>
              <tr>
              <td>001</td>
              <td>2015-11-28</td>
              <td align="center"><a href="#" class="btn btn-danger btn-xs">Edit <i class="fa fa-edit"></i></a></td>
              <td align="center"><a href="#" class="btn btn-danger btn-xs">Delete <i class="fa fa-trash-o"></i></td>
              </tr>

        </tbody>
        </table>


                  </div>
                  <div id="tab2" class="tab-pane fade">
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
                  <div id="tab3" class="tab-pane fade">
                   <table class="table table-bordered table-striped">
        <thead>
                <tr><th>Date Closed</th><th>Job Card Owner</th><th>Technician</th><td align="center"><b>Action</b></td></tr>
        </thead>

        <tbody>
              <tr>
              <td>2015-10-28</td>
              <td>Baringo County</td>
              <td >John Doe</td>
              <td align="center"><a href="#" class="btn btn-danger btn-xs">Open <i class="fa fa-folder-open"></i></td>
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

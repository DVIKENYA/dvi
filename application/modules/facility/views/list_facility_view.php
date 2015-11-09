<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12">
      <!--<a href="<?php //echo site_url('facility/create');?>" class="btn btn-primary">Add Facility</a>-->
    </div>
  </div>
  <div class="row">
  </br>
  </br>
  <?php echo $this->session->flashdata('msg');  ?>
    <div class="col-lg-12" style="margin-top: 10px;">
     <div class="table-responsive">
    <table id="table" class="display table table-bordered dataTable table-hover" cellspacing="0" width="100%">
      <thead>
      <tr class="button"></tr>
        <tr>
          <th>Facility Name</th>
          <th>Officer Incharge</th>
          <th>No. of Vaccine Carriers</th>
          <th>No. of Cold Boxes</th>
          <th style="width:250px;">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>

      <tfoot>
        <tr>
          <th>Facility Name</th>
          <th>Officer Incharge</th>
          <th>No. of Vaccine Carriers</th>
          <th>No. of Cold Boxes</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
  </div>

  <script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('facility/action_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": true, //set not orderable
        },
        ],

      });
    });
   
  </script>
 <!-- Bootstrap modal -->
  <div class="modal fade" id="fridge_modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="fridge_form" class="form-horizontal">
          <div class="form-body">
            
            <div class="form-group">
              <label class="control-label col-md-4">Refrigerator</label>
              <div class="col-md-8">
                <input name="refrigerator" placeholder="Refrigerator" class="form-control" type="text">
              </div>
            </div>
           
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  </body>
</html>
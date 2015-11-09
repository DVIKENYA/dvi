<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

 <div class="row">
        <div class="col-md-12">

    <h5 class="content-header text-info">Immunization Of Children</h5>      
            <table id="table" class="display table table-bordered dataTable table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="content-header text-info">Month</th>
          <th class="content-header text-info">Children Immunized > 2yrs</th>
          <th class="content-header text-info">Children Immunized > 1yr</th>

        </tr>
      </thead>
      <tbody>
      </tbody>

      <tfoot>
        <tr>
          <th class="content-header text-info">Month</th>
          <th class="content-header text-info">Children Immunized > 2yrs</th>
          <th class="content-header text-info">Children Immunized > 1yr</th>
          
        </tr>
      </tfoot>
    </table>
  </div><!--/porlets-content-->  
</div><!--/block-web-->  

 <script type="text/javascript">
 
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('dashboard/get_data/')?>",
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
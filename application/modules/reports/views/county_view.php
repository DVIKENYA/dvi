<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row" id="row">
    <div class="col-lg-12" style="margin-top: 10px;">
     <div class="table-responsive">
    <table id="table" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
      <thead>
      <tr class="button"></tr>
        <tr>
          <th>County Name</th>
          
        </tr>
      </thead>
      <tbody>
      </tbody>

      <tfoot>
        <tr>
          <th>County Name</th>
        </tr>
      </tfoot>
    </table>
  </div>

  <script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({ 
        "sDom": '<l<t>ip>',
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('reports/county_list')?>",
            "type": "POST"
        },
        "dom": 'Bfrtip',
        "buttons": [
          'excelHtml5',
          'csvHtml5',
          'pdfHtml5',
        ],
        "responsive": {
          "details": {
            "type": 'column'
          }
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
   


   function county(id){
            url = "<?php echo site_url('reports/index')?>"+"/"+id+"/counties";
            $.ajax({
              url: url,
              cache: false,
              success: function(data){
                 $("#row").html(data);
              } 
            });
          }


  </script>
 
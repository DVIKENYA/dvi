<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

 

<div class="row">
    <div class="block-web">
        <div class="col-lg-12">
          <div class="col-md-6">
            <h5 class="content-header text-info">National Wastage</h5>
            </br>
            <div id="morris-donut-chart" ></div>
          </div>
          
          <div class="col-md-6">
            <h5 class="content-header text-info">National Coverage</h5>
            </br>
            

            <div id="line-example"></div>
          </div>

        </div>
       </div>
</div>

</br>

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

<script type="text/javascript">
$(document).ready(function(){
  Morris.Donut({
  element: 'morris-donut-chart',
  data: <?php echo json_encode($wastage)?>,
  colors:['#54cdb4'],
  labelColor: '#333300',
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){


var morris = Morris.Line({
  element: 'line-example',
  data: <?php echo json_encode($coverage)?>,
  xkey: ['label'],
  parseTime:false,
  ykeys: ['BCG','OPV','PCV1','ROTA'],
  labels: ['BCG', 'OPV','PCV1','ROTA'],
  colors: ['red',"blue","green","yellow"]
});


    $('#activate1').on('change', function() {
      var isChecked1 = $('#activate1').is(':checked');
      var isChecked2 = $('#activate2').is(':checked');
      var isChecked3 = $('#activate3').is(':checked'); 
      var isChecked4 = $('#activate4').is(':checked');  
      var isChecked5 = $('#activate5').is(':checked');  
 
      morris.setData(data(isChecked1,isChecked2,isChecked3,isChecked4));
      
    });
    $('#activate2').on('change', function() {
      var isChecked1 = $('#activate1').is(':checked');
      var isChecked2 = $('#activate2').is(':checked');
      var isChecked3 = $('#activate3').is(':checked');  
      var isChecked4 = $('#activate4').is(':checked');  
      var isChecked5 = $('#activate5').is(':checked'); 

      morris.setData(data(isChecked1,isChecked2,isChecked3,isChecked4));
    });
    $('#activate3').on('change', function() {
      var isChecked1 = $('#activate1').is(':checked');
      var isChecked2 = $('#activate2').is(':checked');
      var isChecked3 = $('#activate3').is(':checked');
      var isChecked4 = $('#activate4').is(':checked');  
      var isChecked5 = $('#activate5').is(':checked');

      morris.setData(data(isChecked1,isChecked2,isChecked3,isChecked4));
    });
     $('#activate4').on('change', function() {
      var isChecked1 = $('#activate1').is(':checked');
      var isChecked2 = $('#activate2').is(':checked');
      var isChecked3 = $('#activate3').is(':checked');  
      var isChecked4 = $('#activate4').is(':checked');  
      var isChecked5 = $('#activate5').is(':checked'); 

      morris.setData(data(isChecked1,isChecked2,isChecked3,isChecked4));
      
    });
 });    
</script>
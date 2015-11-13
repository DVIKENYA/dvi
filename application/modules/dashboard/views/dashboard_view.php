<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?php echo base_url() ?>assets/js/xepOnline.jqPlugin.js"></script> 

<div class="row">
<div class="block-web">
<div class="col-lg-12">

<div class="col-md-6">
      <h5 class="content-header text-info">Stock Available</h5>
      <button id="print">Export As PDF</button>
</br>
    
 
<div id="morris-bar-chart" name="morris-bar-chart"></div>
</div>
<div class="col-md-6">
  
     <h5 class="content-header text-info">Usage Trends </h5>
<td> <select name="vaccine" class="form-control vaccine" id="vaccine">
                 <option value="">--Select Antigen--</option>
                 <?php foreach ($mavaccine as $vaccine) { 
                     echo "<option value='".$vaccine['Vaccine_name']."'>".$vaccine['Vaccine_name']."</option>";
                     }?>
                </select></td>

<div id="morris-line-chart" name="morris-line-chart" ></div>
</div>

</div>
</div>
  </div>

    
<br/>

<div class="row">
    <div class="block-web">
        <div class="col-lg-12">
          <div class="col-md-6">
            <h5 class="content-header text-info">Wastage</h5>
            </br>
            <div id="morris-donut-chart" ></div>
          </div>
          
          <div class="col-md-6">
            <h5 class="content-header text-info">Coverage</h5>
            </br>
            <input type="checkbox" id="activate1" checked="checked"/> BCG
            <input type="checkbox" id="activate2" checked="checked"/>  OPV
            <input type="checkbox" id="activate3" checked="checked"/> PCV1
            <input type="checkbox" id="activate4" checked="checked"/> ROTA

            <div id="line-example"></div>
          </div>

        </div>
       </div>
</div>

</br>



<script type="text/javascript">
$(document).ready(function(){
 
 Morris.Bar({
        element: 'morris-bar-chart',
        data: <?php echo json_encode($chart)?>,

        xkey: ['label'],
        ykeys: ['value'],
        labels: ['Series A'],
        hideHover: 'auto',
        resize: false,
        barColors: ['#54cdb4', '#FF0000'],
    });
 $('#print').click(function() {
  printMe();
 });

 function printMe(){
  xepOnline.Formatter.Format('morris-bar-chart' , {render :'download', srctype: 'svg'});
 }
 
 });
</script>

<script type="text/javascript">

$.get( "<?php echo base_url();?>dashboard/get_linechart", function(json) {
console.log(json);
Morris.Line({
        element: 'morris-line-chart',
        data: $.parseJSON(json) ,

        xkey: ['label'],
        ykeys: ['value'],
        parseTime:false,
        labels: ['Series A'],
        hideHover: 'auto',
        resize: false,
        lineColors: ['#54cdb4','#1ab394'],
    });
});

$('.vaccine').change(function () {
    var vaccine = $(this).val();
    console.log(vaccine);
  $('#morris-line-chart').empty();
   load_linechart(vaccine);
});

function load_linechart(vaccine){
    
        var _url="dashboard/get_linechart";
            
        var request=$.ajax({
           url: _url,
           type: 'post',
           data: {"vaccine":vaccine, "id":<?php echo $id?>},

          });
          request.done(function(data){
      console.log(data);
        Morris.Line({
          element: 'morris-line-chart',
          data: $.parseJSON(data) ,
          
          xkey: ['label'],
          ykeys: ['value'],
          parseTime:false,
          labels: ['Series A'],
          hideHover: 'auto',
          resize: false,
          lineColors: ['#54cdb4','#1ab394'],
          });
        });                 
           
          request.fail(function(jqXHR, textStatus) {
          
        });
}
    

</script>


<script type="text/javascript">

$(document).ready(function(){
  Morris.Donut({
  element: 'morris-donut-chart',
  data: <?php echo json_encode($wastage)?>,
  colors:['#54cdb4','#0BA462','#95D7BB'],
  labelColor: '#333300'
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





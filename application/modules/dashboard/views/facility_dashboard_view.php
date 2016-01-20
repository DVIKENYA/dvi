<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
<div class="block-web">
<div class="col-lg-12">

<div class="col-md-6">
      <h5 class="content-header text-info">Stock Available</h5>
   
<div id="morris-bar-chart" name="morris-bar-chart"></div>
</div>
<div class="col-md-6">
  
     <h5 class="content-header text-info">Usage Trends </h5>
<!-- <td> <select name="vaccine" class="form-control vaccine" id="vaccine">
                 <option value="">--Select Antigen--</option>
                 <?php foreach ($mavaccine as $vaccine) { 
                     //echo "<option value='".$vaccine['Vaccine_name']."'>".$vaccine['Vaccine_name']."</option>";
                     }?>
                </select></td> -->

<div id="morris-line-chart" name="morris-line-chart" ></div>
</div>

</div>
</div>
  </div>

    
<br/>

<div class="row">
    <div class="block-web">
        <div class="col-lg-12">

            <h5 class="content-header text-info">Wastage</h5>
            </br>
            <div id="morris-donut-chart" ></div>

          


        </div>
       </div>
</div>

</br>

<div class="row">
    <div class="block-web">
        <div class="col-lg-12">
  
            <h5 class="content-header text-info">Coverage</h5>
            </br>
            <div id="container"></div>
        

        </div>
       </div>
</div>


<script type="text/javascript">
$.getJSON( "<?php echo base_url();?>dashboard/get_chart", function(ty) {
 $.each(ty, function(name, value) {
        nam =   name;
        val = value;
    });
//console.log(ty);
//console.log(val);
//alert( $.fn.jquery );


  $('#morris-bar-chart').highcharts({
    chart: {
      type: 'column'
    },
      /*exporting: {
            enabled:true
        },*/
    title: {
      text: "Stock balance of various vaccines"
    },
    series : [{data : ty, name: "stock level"}
             ],
    xAxis: {
            categories : nam
    }
  });
});

</script>

<script type="text/javascript">

$.getJSON( "<?php echo base_url();?>dashboard/get_linechart", function(tin) {
 $.each(tin, function(name, value) {
        nam = name;
        val = value;
 });
 
console.log(tin);
//console.log(val);

    $('#morris-line-chart').highcharts({
        chart: {
            type: 'bar'
        },
          exporting: {
            enabled:true
        },
        title: {
            text: ''
        },
        xAxis: {
            categories:nam
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Usage Trends'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: [{data: tin, name: "Usage"}
        ]
    });
});
    

</script>


<script type="text/javascript">
$.getJSON( "<?php echo base_url();?>dashboard/get_init", function(dol) {
 $.each(dol, function(name, value) {
        nam = name;
        val = value;
    });
 
//console.log(dol);
//console.log(val);

    $('#morris-donut-chart').highcharts({
        chart: {
            type: 'bar'
        },
          exporting: {
            enabled:true
        },
        title: {
            text: 'Stacked bar chart'
        },
        xAxis: {
            categories:nam
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Initial vs Current Wastage Factor'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: [{data: <?php echo json_encode($wastage) ?>, name: "Current"}, 
                 {data: dol, name: "Initial"}
        ]
    });
});
</script>

<script type="text/javascript">
$.getJSON( "<?php echo base_url();?>dashboard/get_coverage", function(mim) {
 $.each(mim, function(name, value) {
        nam = name;
   
  console.log(mim);
       
    $('#container').highcharts({
        chart: {
        type: 'line'
        },
          exporting: {
            enabled:true
        },
        title: {
            text: 'Coverage of Vaccines',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: DHIS',
            x: -20
        },
        xAxis: {
           categories: nam
        },
        yAxis: {
            title: {
                text: 'Coverage (%)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        series: [ {data:mim,name:"BCG"}
      ]

    });
    });
    });
    </script>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

    <script type="text/javascript">
      window.heap=window.heap||[],heap.load=function(e,t){window.heap.appid=e,window.heap.config=t=t||{};var n=t.forceSSL||"http:"===document.location.protocol,a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src=(n?"https:":"http:")+"//cdn.heapanalytics.com/js/heap-"+e+".js";var o=document.getElementsByTagName("script")[0];o.parentNode.insertBefore(a,o);for(var r=function(e){return function(){heap.push([e].concat(Array.prototype.slice.call(arguments,0)))}},p=["clearEventProperties","identify","setEventProperties","track","unsetEventProperty"],c=0;c<p.length;c++)heap[p[c]]=r(p[c])};
      heap.load("2129479354");
    </script>

<div class="row">
<div class="block-web">
<div class="col-lg-12">

<div class="col-md-6">

     <div id="table" class="table-responsive">
  <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <?php
                                        if($user_level=='3'){?>
                                        <th><h5 class="content-header text-info">5 Best Performing SubCounties</h5></th>
                                    <?php } elseif ($user_level=='2'){?>
                                        <th><h5 class="content-header text-info">5 Best Performing Counties</h5></th>
                                        <?php }
                                        ?> 
                                        <th><h5 class="content-header text-info">DPT Coverage</h5></th>
                                        <th><h5 class="content-header text-info">Drop Out</h5></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    arsort($dpt3cov);  
                                    foreach ($dpt3cov as $row){
                                      ?>
                                    <tr>
                                        <?php if($user_level=='3'){?>
                                        <td><?php echo $row['subcounty_name'] ?></td>
                                        <td><?php echo $row['totaldpt3'] ?></td>
                                        <td><?php echo ($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                       <?php } elseif ($user_level=='2'){?>
                                       <td><?php echo $row['county_name'] ?></td>
                                        <td><?php echo $row['totaldpt3'] ?></td>
                                        <td><?php echo ($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                    </tr><?php }?> 
                                    <?php } ?>
                                </tbody>
                            </table>
                    <hr>
                    </br>
                    
                        </div>

</div>

<div class="col-md-6">

     <div class="table-responsive">
  <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <?php
                                        if($user_level=='3'){?>
                                        <th><h5 class="content-header text-info">5 Best Performing SubCounties</h5></th>
                                    <?php } elseif ($user_level=='2'){?>
                                        <th><h5 class="content-header text-info">5 Best Performing Counties</h5></th>
                                        <?php }
                                        ?> 
                                        <th><h5 class="content-header text-info">DPT Coverage</h5></th>
                                        <th><h5 class="content-header text-info">Drop Out</h5></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    asort($dpt3cov);
                                    foreach ($dpt3cov as $row){
                                      ?>
                                    <tr>
                                        <?php if($user_level=='3'){?>
                                        <td><?php echo $row['subcounty_name'] ?></td>
                                        <td><?php echo $row['totaldpt3'] ?></td>
                                        <td><?php echo ($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                       <?php } elseif ($user_level=='2'){?>
                                       <td><?php echo $row['county_name'] ?></td>
                                        <td><?php echo $row['totaldpt3'] ?></td>
                                        <td><?php echo ($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                    </tr><?php }?> 
                                    <?php } ?>
                                </tbody>
                            </table>
                    <hr>
                    </br>
                
                        </div>

</div>
<!--<div class="col-lg-2">

            <div class="information blue_info">
              <div class="information_inner">
              <div class="info blue_symbols"><i class="fa fa-shopping-cart icon"></i></div>
                <span>TODAY FEEDBACK</span>
                <h1 class="bolded">12,254K</h1>
                <div class="infoprogress_blue">
                  <div class="blueprogress"></div>
                </div>
                <b class=""><small>Better than yesterday ( 7,5% )</small></b>
                <div class="pull-right" id="work-progress2">
                  <canvas style="display: inline-block; width: 47px; height: 25px; vertical-align: top;" width="47" height="25"></canvas>
                </div>
              </div>
            </div>
</div>-->

</div>
</div>
</div>

    
<br/>


<div class="row">
<div class="block-web">
<div class="col-lg-12">

<div class="col-md-6">
      <h5 class="content-header text-info">Stock Available</h5>
   
<div id="morris-bar-chart" name="morris-bar-chart"></div>
</div>
<div class="col-md-6">
  
     <h5 class="content-header text-info">Months of Stock</h5>

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
// $.getJSON("<?php echo base_url();?>dashboard/get_subcounty_dpt3cov", function (data) {
//     var tr;
//     for (var i = 0; i < data.length; i++) {
//         tr = $('<tr/>');
//         tr.append("<td>" + data[i].subcounty_name + "</td>");
//         tr.append("<td>" + data[i].totaldpt3 + "</td>");
//         tr.append("<td>""</td>");
//         $('table').append(tr);
//     }
// });

</script>


<script type="text/javascript">
$.getJSON( "<?php echo base_url();?>dashboard/get_chart", function(ty) {
 $.each(ty, function(name, value) {
        nam =   name;
        val = value;
    });
//console.log(ty);
//console.log(val);

  $('#morris-bar-chart').highcharts({
    chart: {
      type: 'column'
    },
    credits: {
      enabled: false
    },
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
$.getJSON( "<?php echo base_url();?>dashboard/get_mofstock", function(mts) {
 $.each(mts, function(name, value) {
        nam =  name;
        val = value;
    });
//console.log(ty);
//console.log(val);

  $('#morris-line-chart').highcharts({
    chart: {
      type: 'column'
    },
    credits: {
      enabled: false
    },
    title: {
      text: "Months of Stock"
    },
    series : [{data : mts, name: "months of stock"}
             ],
    xAxis: {
            categories : nam
    }
  });
});

</script>

<script type="text/javascript">

// $.get( "<?php echo base_url();?>dashboard/get_linechart", function(json) {
// //console.log(json);
// Morris.Line({
//         element: 'morris-line-chart',
//         data: $.parseJSON(json) ,

//         xkey: ['label'],
//         ykeys: ['value'],
//         parseTime:false,
//         labels: ['Series A'],
//         hideHover: 'auto',
//         resize: false,
//         lineColors: ['#54cdb4','#1ab394'],
//     });
// });

// $('.vaccine').change(function () {
//     var vaccine = $(this).val();
//     //console.log(vaccine);
//   $('#morris-line-chart').empty();
//    load_linechart(vaccine);
// });

// function load_linechart(vaccine){
    
//         var _url="dashboard/get_linechart";
            
//         var request=$.ajax({
//            url: _url,
//            type: 'post',
//            data: {"vaccine":vaccine, "id":<?php echo $id?>},

//           });
//           request.done(function(data){
//       console.log(data);
//         Morris.Line({
//           element: 'morris-line-chart',
//           data: $.parseJSON(data) ,
          
//           xkey: ['label'],
//           ykeys: ['value'],
//           parseTime:false,
//           labels: ['Series A'],
//           hideHover: 'auto',
//           resize: false,
//           lineColors: ['#54cdb4','#1ab394'],
//           });
//         });                 
           
//           request.fail(function(jqXHR, textStatus) {
          
//         });
// }
    

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
        credits: {
            enabled: false
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
/* $.each(mim, function(name, value) {
        nam = name;
   });*/
  //console.log(mim);
       
    $('#container').highcharts({
        chart: {
        type: 'line'
        },
        credits: {
            enabled: false
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

    //});
    });
    });
    </script>
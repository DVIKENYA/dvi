<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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
                                    <?php } elseif ($user_level=='2' || $user_level=='1'){?>
                                        <th><h5 class="content-header text-info">5 Best Performing Counties</h5></th>
                                        <?php } elseif ($user_level=='4'){?>
                                        <th><h5 class="content-header text-info">5 Best Performing Facilities</h5></th>
                                        <?php }?> 
                                        <th><h5 class="content-header text-info">DPT Coverage</h5></th>
                                        <th><h5 class="content-header text-info">Drop Out</h5></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //array_slice($dpt3cov, 0, 5);
                                    arsort($dpt3cov);  
                                    foreach ($dpt3cov as $row){
                                      ?>
                                    <tr>
                                        <?php if($user_level=='3'){?>
                                        <td><?php echo $row['subcounty_name'] ?></td>
                                        <td><?php echo $row['totaldpt3'] ?></td>
                                        <td><?php echo ($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                       <?php } elseif ($user_level=='2' || $user_level=='1'){?>
                                       <td><?php echo $row['county_name'] ?></td>
                                        <td><?php echo $row['totaldpt3'] ?></td>
                                        <td><?php echo ($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                       <?php } elseif ($user_level=='4'){?>
                                       <td><?php echo $row['facility_name'] ?></td>
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
                                    <?php } elseif ($user_level=='2' || $user_level=='1'){?>
                                        <th><h5 class="content-header text-info">5 Best Performing Counties</h5></th>
                                        <?php } elseif ($user_level=='4'){?>
                                        <th><h5 class="content-header text-info">5 Best Performing Facilities</h5></th>
                                        <?php }?>
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
                                       <?php } elseif ($user_level=='2' || $user_level=='1'){?>
                                       <td><?php echo $row['county_name'] ?></td>
                                        <td><?php echo $row['totaldpt3'] ?></td>
                                        <td><?php echo ($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                        <?php } elseif ($user_level=='4'){?>
                                       <td><?php echo $row['facility_name'] ?></td>
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
  
            <h5 class="content-header text-info">Coverage</h5>
            </br>
            <div id="container"></div>
        

        </div>
       </div>
</div>

<script type="text/javascript">


</script>


<script type="text/javascript">
$.getJSON( "<?php echo base_url();?>dashboard/get_chart", function(ty) {
 $.each(ty, function(name, value) {
        nam =   name;
        val = value;
    });

  $.getJSON("<?php echo base_url();?>dashboard/minmax_stock", function(sm) {
    console.log(sm);
   

        $.each(sm, function(key, value) {
            min =   value.min_stock;
            max =   value.max_stock;

        });


  $('#morris-bar-chart').highcharts({
    chart: {
      type: 'column'
    },
      events: {
          load: function() {
              this.showLoading(); // show loading message
          }
      },
      credits: {
      enabled: false
    },
    title: {
      text: "Stock balance of various vaccines"
    },
    
    series : [{data : ty, name: "stock level"}],

    xAxis: {
            categories : nam
    }
});
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
    series : [{data : mts, name: "months of stock"}],
    xAxis: {
            categories : nam
    }
  });
});

</script>




<script type="text/javascript">
$.getJSON( "<?php echo base_url();?>dashboard/get_init", function(dol) {
 $.each(dol, function(name, value) {
        nam = name;
        val = value;
    });


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
$.each(mim, function(name, value) {
        nam = name;
        val = value;
   });
       
    $('#container').highcharts({
        chart: {
        type: 'line'
        },
        events: {
            load: function() {
                this.showLoading(); // show loading message
            }
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
        series: [
            {
                data:mim,
                name:"BCG",
                turboThreshold:0
            }

      ]

    });
    });
    </script>
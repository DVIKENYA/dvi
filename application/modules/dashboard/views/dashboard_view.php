<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="block-web">
        <div class="col-lg-12">

            <div class="col-md-6">
                <div id="table" class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <?php if ($user_level == '1' || $user_level == '2') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Best Performing Counties</h5></th>
                                <?php }elseif($user_level == '3') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Best Performing </br>SubCounties</h5></th>

                                <?php }elseif($user_level == '4') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Best Performing </br>Facilities</h5></th>
                                <?php } ?>
                                <th>
                                    <h5 class="content-header text-info">DPT </br>Coverage %</h5></th>
                                <th>
                                    <h5 class="content-header text-info">Drop Out</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($best as $row) {?>
                            <tr>
                                <?php if ($user_level == '2') { ?>
                                <td><?php echo $row['county_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                <?php }elseif($user_level == '3') { ?>
                                <td><?php echo $row['subcounty_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                <?php }elseif($user_level == '4') { ?>
                                <td><?php echo $row['facility_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                            </tr><?php } ?> <?php } ?>
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
                                <?php if ($user_level == '1' || $user_level == '2') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Poor Performing Counties</h5></th>
                                <?php }elseif($user_level == '3') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Poor Performing </br>SubCounties</h5></th>
                                <?php }elseif($user_level == '4') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Poor Performing </br>Facilities</h5></th>
                                <?php } ?>
                                <th>
                                    <h5 class="content-header text-info">DPT </br>Coverage %</h5></th>
                                <th>
                                    <h5 class="content-header text-info">Drop Out</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach($worst as $row) {   ?>
                            <tr>
                                <?php if ($user_level == '2') { ?>
                                <td><?php echo $row['county_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                <?php }elseif($user_level == '3') { ?>
                                <td><?php echo $row['subcounty_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                <?php }elseif($user_level == '4') { ?>
                                <td><?php echo $row['facility_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                            </tr><?php } ?> <?php } ?>
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

                <div id="morris-line-chart" name="morris-line-chart"></div>
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
    nam ="";
    $.getJSON("<?php echo base_url(); ?>dashboard/get_chart", function(ty) {
        $.each(ty, function(name, value) {
            nam = name;
            val = value;
        });
        $('#morris-bar-chart').highcharts({
            chart: {
                type: 'column'
            },
            loading: {
                hideDuration: 100,
                labelStyle: {
                    "fontWeight": "bold",
                    "position": "relative",
                    "top": "45%"
                },
                showDuration: 100,
                style: undefined
            },
            credits: {
                enabled: false
            },
            title: {
                text: "Stock balance of various vaccines"
            },
            yAxis: {
                title: {
                    text: 'Amount'
                }
            },
            xAxis: {
                 categories: nam,
                title: {
                    text: 'Vaccine/Diluent'
                }
            },
            series: [{
                data: ty,
                name: "stock level"
            }]
        });

    });
</script>


<script type="text/javascript">
    nam ="";
    $.getJSON("<?php echo base_url(); ?>dashboard/months_of_stock", function(mts) {
        $.each(mts, function(name, value) {
            nam = name;
            val = value;
        });
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
            yAxis: {
                title: {
                    text: 'No of Months'
                }
            },
            xAxis: {
                 categories: nam,
                title: {
                    text: 'Vaccine/Diluent'
                }
            },
            series: [{
                data: mts,
                name: "months of stock"
            }]
        });
    });
</script>

<script type="text/javascript">
    nam ="";
    $.getJSON("<?php echo base_url(); ?>dashboard/get_coverage", function(mim) {
        $.each(mim, function(name, value) {
            nam = name;
            val = value;
        });

        $('#container').highcharts({
            chart: {
                type: 'line'
            },
            loading: {
                hideDuration: 100,
                labelStyle: {
                    "fontWeight": "bold",
                    "position": "relative",
                    "top": "45%"
                },
                showDuration: 100,
                style: undefined
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
                categories: nam,
                title: {
                    text: 'Months'
                }
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
            series: [{
                    data: mim,
                    name: "BCG",
                    turboThreshold: 0
                }

            ]

        });
    });
</script>
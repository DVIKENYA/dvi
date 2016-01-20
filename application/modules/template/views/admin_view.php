<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo $main_title; ?></title>
  <!--<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">-->
  
  
  <link href="<?php echo base_url() ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url() ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url() ?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet">

  <link href="<?php echo base_url() ?>assets/plugins/advanced-datatable/css/demo_page.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/jquery-ui.css" rel="stylesheet" >
  <link href="<?php echo base_url() ?>assets/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
<!--
  <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
  <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
  <script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
  
  <script src="<?php echo base_url() ?>assets/js/jquery-2.1.0.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
  <!--<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>-->

 

</head>
<body class="light_theme  fixed_header left_nav_fixed">
  <div class="wrapper">
    <!--\\\\\\\ wrapper Start \\\\\\-->
    <div class="header_bar">
      <!--\\\\\\\ header Start \\\\\\--><!--\\\\\\\ brand end \\\\\\-->
      <div class="brand">
        <!--\\\\\\\ brand Start \\\\\\-->
        <div class="logo" style="display:block"><img src="<?php echo base_url() ?>assets/images/coat_of_arms.png" width="30" height="30" /><span class="theme_color">&nbsp;&nbsp;DVI</span> Kenya</div>
        <div class="small_logo" style="display:none"><img src="<?php echo base_url() ?>assets/images/coat_of_arms.png" width="50" height="47" alt="s-logo" /></div>
      </div>
      <!--\\\\\\\ brand end \\\\\\-->
      <div class="header_top_bar">
        <!--\\\\\\\ header top bar start \\\\\\-->
        <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
         <a href="#" class="add_user"> <i class="fa fa-map-marker"></i> <span> <?php echo $user_object['path']; ?> </span></a>
        
        <div class="top_right_bar">
          <!--\\\\\\\ header top bar start \\\\\\-->
          <div class="top_right">
            <div class="top_right_menu">
             
              <ul>              
                <li class="dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"> notification <span class="badge badge color_2">2</span> </a>
                  <div class="notification_drop_down dropdown-menu">
                    <div class="top_pointer"></div>
                    <div class="box"> <a href="#"> <span class="block primery_6"> <i class="fa fa-envelope-o"></i> </span> <span class="block_text">Alerts</span> </a> </div>
                    <div class="box"> <a href="#"> <span class="block primery_2"> <i class="fa fa-calendar-o"></i> </span> <span class="block_text">Dates</span> </a> </div>

                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="user_admin dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"><span class="user_adminname"><?php echo '<b> Hello '.$user_object['user_fname'].' </b>' ;?></span> <img src="<?php echo base_url() ?>assets/images/user.jpg" /> <b class="caret"></b> </a>
            <ul class="dropdown-menu">
              <div class="top_pointer"></div>
              <li> <a href="<?php //echo site_url('admin/user/profile');?>"><i class="fa fa-user"></i> Profile</a> </li>
              <!--  <li> <a href="#"><i class="fa fa-question-circle"></i> Help</a> </li> -->
              <!-- <li> <a href="#"><i class="fa fa-cog"></i> Setting </a></li> -->
              <li> <a href="<?php echo site_url('users/logout');?>"><i class="fa fa-power-off"></i> Logout</a> </li>
            </ul>
          </div>
          <!--<a href="javascript:;" class="toggle-menu menu-right push-body jPushMenuBtn rightbar-switch"><i class="fa fa-comment chat"></i></a>-->
        </div>
      </div>
      <!--\\\\\\\ header top bar end \\\\\\-->
    </div>
    <!--\\\\\\\ header end \\\\\\-->
    <div class="inner">
      <!--\\\\\\\ inner start \\\\\\-->
      <div class="left_nav">
        <!--\\\\\\\left_nav start \\\\\\-->
        <div class="">
             &nbsp;
        </div>
        <div class="left_nav_slidebar">
          <ul>
            <li class="left_nav_active theme_border"><a href="javascript:void(0);"><i class="fa fa-home"></i> HOME <span class="left_nav_pointer"></span> <span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul style="display:block">
                <li> <a href="<?php echo site_url('dashboard/home');?>" class="left_nav_sub_active"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Dashboard</b> </a> </li>
              </ul>
            </li>
            <li> <a href="javascript:void(0);"> <i class="fa fa-cubes"></i>MANAGE STOCK<span class="plus"><i class="fa fa-plus"></i></span></a>
              <ul>
                <li> <a href="<?php echo site_url('stock/c_physical_stock/physical_count');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>STOCK COUNT</b> </a> </li>
                <li> <a href="<?php echo site_url('stock/list_inventory');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>STOCK LEDGERS</b> </a> </li>
                <li> <a href="<?php echo site_url('stock/receive_stock');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>RECEIVE STOCKS</b> </a> </li>
                <li> <a href="<?php echo site_url('stock/issue_stock');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>ISSUE STOCKS</b> </a> </li>
                <!-- <li> <a href="<?php echo site_url('stock/transfer_stock');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Transfer Stocks</b> </a> </li> -->
                <!--  <li> <a href="#" class="left_nav_sub_active"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Arrival Tracking</b> </a> </li> -->
                <!-- <li> <a href="#"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Settings</b> </a> </li> -->
              </ul>
            </li>
            <li> <a href="javascript:void(0);"> <i class="fa fa-th"></i>COLD CHAIN<span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul>
                <li> <a href="#"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>LOG REPORTS</b> </a> </li> 
              </ul>
            </li>
            <li> <a href="javascript:void(0);"> <i class="fa fa-bar-chart "></i>REPORTS<span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul>
                <li> <a href="#"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>REPORT MODULE</b> </a> </li>
                <li> <a href="#"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>COUNTY REPORTS</b> </a> </li>
                <li> <a href="#"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>FORECASTING</b> </a> </li>
              </ul>
            </li>
            <li> <a href="javascript:void(0);"> <i class="fa fa-user-plus"></i>DOCUMENTS<span class="plus"><i class="fa fa-plus"></i></span> </a>
  <?php            
if ( $user_object['user_level']=='1') {?>
    <ul>
     <li> <a href="<?php echo site_url('uploads/');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i><b>UPLOAD DOCUMENTS</b> </a> </li>
    <li> <a href="<?php echo site_url('uploads/list_files');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i><b>DOWNLOAD DOCUMENTS</b> </a> </li>
    </ul>
 <?php } else  {?>
     <ul>
     <li> <a href="<?php echo site_url('uploads/list_files');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i><b>DOWNLOAD DOCUMENTS</b> </a> </li>
     </ul>
 <?php }
 ?> 
             
            </li>
            <li> <a href="javascript:void(0);"> <i class="fa fa-gear"></i>CONFIGURATIONS<span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul>
                <li> <a href="<?php echo site_url('group/');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>ADD GROUPS</b> </a> </li>
                <li> <a href="<?php echo site_url('users/list_users');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i><b>ADD USERS</b> </a> </li>
                <li> <a href="<?php echo site_url('vaccines');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>ADD VACCINES</b> </a> </li>
                <li> <a href="<?php echo site_url('region/');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>ADD REGIONS</b> </a> </li>
                <li> <a href="<?php echo site_url('county/');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>ADD COUNTY</b> </a> </li>
                <li> <a href="<?php echo site_url('subcounty/');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>ADD SUB-COUNTY</b> </a> </li>
                <li> <a href="<?php echo site_url('depot');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>ADD DEPOT</b> </a> </li>
                <li> <a href="<?php echo site_url('facility');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>ADD FACILITIES</b> </a> </li>
                <!--<li> <a href="<?php //echo site_url('fridges');?>"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Fridges</b> </a> </li>-->
              </ul>
            </li>
            <li> <a href="javascript:void(0);"><img src="<?php echo base_url() ?>assets/images/coat_of_arms.png" width="30" height="30" /><span class="theme_color">&nbsp;&nbsp;<b>DVI KENYA</b></span>  <span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul>
                <li> <a href="#"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>ABOUT</b> </a> </li>
              </ul>
            </li>
          </ul>
        </div>

        </div><!--\\\\\\\left_nav end \\\\\\-->
          <div class="contentpanel">
                    <!--\\\\\\\ contentpanel start\\\\\\-->
                    <div class="pull-left breadcrumb_admin clear_both">
                      <div class="pull-left page_title theme_color">
                        <h1><?php echo $section?></h1>
                        <h2 class=""><?php echo $subtitle ?></h2>
                      </div>  
                    </div>
                    <div class="container clear_both padding_fix">
                              <!--\\\\\\\ container  start \\\\\\-->
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>-->
                                    <div class="block-web" >
                                            <div class="header">
                                                  <h3 class="content-header text-info "><?php echo $user_object['user_statiton']; ?></h3>
                                            </div>
                                            <div class="porlets-content">
                                              <?php 
                                                    $this->load->view($module.'/'.$view_file);
                                              ?>
                                            </div><!--/porlets-content--> 
                                    </div><!--/block-web--> 
                                </div><!--/col-md-12--> 
                            </div>
                    </div><!--\\\\\\\ container  end \\\\\\-->
          </div><!--\\\\\\\ contentpanel end \\\\\\-->
    </div><!--\\\\\\\ inner end\\\\\\-->
  </div><!--\\\\\\\ wrapper end\\\\\\-->
                  
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/common-script.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jPushMenu.js"></script> 
<!--<script src="js/side-chats.js"></script>-->

<script src="<?php echo base_url() ?>assets/plugins/morris/morris.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url() ?>assets/plugins/morris/raphael-min.js" type="text/javascript"></script>  
<script src="<?php echo base_url() ?>assets/plugins/morris/morris-script.js"></script> 
<script src="<?php echo base_url() ?>assets/plugins/highcharts/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/highcharts/highcharts.src.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/highcharts/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/highcharts/exporting.src.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/highcharts/offline-exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/highcharts/offline-exporting.src.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/highcharts/solid-gauge.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/highcharts/solid-gauge.src.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/data-tables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/demo-slider/demo-slider.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/knob/jquery.knob.min.js"></script> 
</body>
</html>
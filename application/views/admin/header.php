<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<?php
$uri_segment = $this->uri->segment(2);
?>
<html lang="en">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <!-- start: META -->
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <link rel="shortcut icon" href="<?= base_url() ?>backend-assets/images/logo/favicon.png" />
        <!-- start: GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <!-- end: GOOGLE FONTS -->
        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>backend-assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>backend-assets/vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>backend-assets/vendor/themify-icons/themify-icons.min.css">
        <link href="<?= base_url() ?>backend-assets/vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>backend-assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>backend-assets/vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
        <!-- end: MAIN CSS -->
        <!-- start: CLIP-TWO CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>backend-assets/css/styles.css">
        <link rel="stylesheet" href="<?= base_url() ?>backend-assets/css/plugins.css">
        <link rel="stylesheet" href="<?= base_url() ?>backend-assets/css/themes/theme-1.css" id="skin_color" />
        <link href="<?= base_url() ?>backend-assets/vendor/select2/select2.min.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>backend-assets/vendor/DataTables/css/DT_bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>backend-assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">

        <link href="<?= base_url() ?>backend-assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>backend-assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>backend-assets/vendor/iCheck/all.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>backend-assets/vendor/iCheck/minimal/blue.css"  />

        <link href="<?= base_url() ?>backend-assets/alertify/alertify.core.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>backend-assets/alertify/alertify.default.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>backend-assets/css/myset.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>backend-assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url() ?>backend-assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <style type="text/css">
            .action-row{
                margin: 10px 0;
            }
            table thead tr th,
            table tbody tr td{
                text-align: center
            }
        </style>

    </head>
    <!-- end: HEAD -->
    <body>
        <div id="app">
            <!-- sidebar -->
            <div class="sidebar app-aside" id="sidebar">
                <div class="sidebar-container">
                    <nav>
                        <!-- end: SEARCH FORM -->
                        <!-- start: MAIN NAVIGATION MENU -->

                        <ul class="main-navigation-menu">
                            <li class="<?= ($uri_segment == 'dashboard') ? 'active' : ''; ?>" >
                                <a href="<?= site_url() ?>admin/dashboard" id="dash">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="fa fa-dashboard"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title"> Dashboard </span>
                                        </div>
                                    </div>
                                </a>
                            </li>                            
                            <li class="<?= ($uri_segment == 'stream') ? 'active' : ''; ?>">
                                <a href="javascript:void(0)">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="ti-layout-grid2"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title">Stream Master</span><i class="icon-arrow"></i>
                                        </div>
                                    </div>
                                </a>
                                <ul class="sub-menu" style="display: none;">
                                    <li class="active">
                                        <a href="<?= base_url() ?>admin/stream">
                                            <span class="title">Stream List</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?= base_url() ?>admin/stream/stream_add">
                                            <span class="title">Stream Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>                                                        
                            <li class="<?= ($uri_segment == 'course') ? 'active' : ''; ?>">
                                <a href="javascript:void(0)">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="ti-layout-grid2"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title">Course Master</span><i class="icon-arrow"></i>
                                        </div>
                                    </div>
                                </a>
                                <ul class="sub-menu" style="display: none;">
                                    <li class="active">
                                        <a href="<?= base_url() ?>admin/course">
                                            <span class="title">Course List</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?= base_url() ?>admin/course/course_add">
                                            <span class="title">Course Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>                                                       
                            <li class="<?= ($uri_segment == 'college') ? 'active' : ''; ?>">
                                <a href="javascript:void(0)">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="ti-layout-grid2"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title">College Master</span><i class="icon-arrow"></i>
                                        </div>
                                    </div>
                                </a>
                                <ul class="sub-menu" style="display: none;">
                                    <li class="active">
                                        <a href="<?= base_url() ?>admin/college">
                                            <span class="title">College List</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#">
                                            <span class="title">College Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- / sidebar -->
            <div class="app-content">
                <!-- start: TOP NAVBAR -->
                <header class="navbar navbar-default navbar-static-top">

                    <!-- start: NAVBAR HEADER -->
                    <div class="navbar-header">
                        <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
                            <i class="ti-align-justify"></i>
                        </a>
                        <a class="navbar-brand"  href="<?= base_url() ?>admin/dashboard">
                            <img src="<?= base_url() ?>backend-assets/images/logo1.png" style="width:120px;text-align:center;" class=""  alt=""/>
                        </a>
                        <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
                            <i class="ti-align-justify"></i>
                        </a>
                        <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="ti-view-grid"></i>
                        </a>
                    </div>
                    <!-- end: NAVBAR HEADER -->
                    <!-- start: NAVBAR COLLAPSE -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-right">
                            <li class="dropdown current-user">
                                <a href class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= site_url() ?>backend-assets/images/Avatar.png" alt="admin"> <span class="username" style="text-transform: capitalize;"><?= $this->session->userdata('username') ?> <i class="ti-angle-down"></i></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-dark">
                                    <li>
                                        <a href="<?= base_url() ?>admin/changepassword">
                                            Change Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>admin/alogin/logout">
                                            Log Out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- end: USER OPTIONS DROPDOWN -->
                        </ul>
                        <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
                    </div>
                </header>
                <!-- end: TOP NAVBAR -->
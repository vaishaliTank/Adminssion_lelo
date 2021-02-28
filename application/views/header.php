<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Udema a modern educational site template">
      <meta name="author" content="Ansonika">
      <title> Admissionlelo </title>
      <!-- Favicons-->
      <link rel="shortcut icon" href="img/x-icon.jpg" type="image/x-icon">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <!-- GOOGLE WEB FONT -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
      <!-- BASE CSS -->
      <link href="<?= base_url() ?>cms_assets/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?= base_url() ?>cms_assets/css/style.css" rel="stylesheet">
      <link href="<?= base_url() ?>cms_assets/css/vendors.css" rel="stylesheet">
      <link href="<?= base_url() ?>cms_assets/css/icon_fonts/css/all_icons.min.css" rel="stylesheet">
      <!-- YOUR CUSTOM CSS -->
      <link href="<?= base_url() ?>cms_assets/css/custom.css" rel="stylesheet">
      <script src="<?= base_url() ?>cms_assets/js/jquery-3.5.1.min.js"></script>
   </head>
   <body>
      <div id="page">
         <header class="header menu_2" style="background-color: #fff;">
            <div id="preloader">
               <div data-loader="circle-side"></div>
            </div>
            <!-- /Preload -->
            <div id="logo">
               <a href="<?= base_url() ?>"><img src="<?= base_url() ?>cms_assets/img/logo_2.png" width="149" height="42" alt=""></a>
            </div>
            <ul id="top_menu">
               <li><a href="#0" class="search-overlay-menu-btn">Search</a></li>
               <li class="hidden_tablet"><a href="admission.html" class="btn_1 rounded"><i class="fa fa-phone" aria-hidden="true"></i> +91 9582044410</a></li>
            </ul>
            <!-- /top_menu -->
            <a href="#menu" class="btn_mobile">
               <div class="hamburger hamburger--spin" id="hamburger">
                  <div class="hamburger-box">
                     <div class="hamburger-inner"></div>
                  </div>
               </div>
            </a>
            <nav id="menu" class="main-menu">
               <ul>
                  <li><span><a href="<?= base_url() ?>courses">Top Courses</a></span> </li>
                  <li><span><a href="<?= base_url() ?>colleges">Top Colleges</a></span> </li>
                  <li><span><a href="#">Career Counselling</a></span> </li>
                  <li><span><a href="#">Study in India</a></span> </li>
                  <li><span><a href="#">About Us</a></span></li>
                  <li><span><a href="#">Blog</a></span></li>
               </ul>
            </nav>
            <!-- Search Menu -->
            <div class="search-overlay-menu">
               <span class="search-overlay-close"><span class="closebt"><i class="ti-close"></i></span></span>
               <form role="search" id="searchform" method="get">
                  <input value="" name="q" type="search" placeholder="Search..." />
                  <button type="submit"><i class="fa fa-search"></i>
                  </button>
               </form>
            </div>
            <!-- End Search Menu -->
         </header>
         <!-- /header -->
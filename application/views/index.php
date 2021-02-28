<style type="text/css">
   .b-search{
      position: absolute;
      -moz-transition: all .3s ease-in-out;
      -o-transition: all .3s ease-in-out;
      -webkit-transition: all .3s ease-in-out;
      -ms-transition: all .3s ease-in-out;
      transition: all .3s ease-in-out;
      right: -1px;
      color: #fff;
      font-weight: 600;
      font-size: 14px;
      font-size: .875rem;
      top: 0;
      border: 0;
      padding: 0 25px;
      height: 50px;
      cursor: pointer;
      outline: 0;
      -webkit-border-radius: 0 3px 3px 0;
      -moz-border-radius: 0 3px 3px 0;
      -ms-border-radius: 0 3px 3px 0;
      border-radius: 0 3px 3px 0;
      background-color: #F14C5C;
   }
</style>
<style type="text/css">
   .img_icon_F{
      max-width: 100%; height: auto;vertical-align: middle; border-style: none;
   }
   .img_icon_b{
      vertical-align: middle; border-style: none; max-width: 100%;height: auto;
   }
   .asd{
      margin-top: 20px; font-weight: 600; font-size: 13px;
   }
   .College_t{
      display: inline-block;font-size: 12px;color: #777;
   }
   .service_single_box{
      /*box-shadow: 0 5px 19px 0 rgb(0 0 0 / 15%);*/
      box-shadow: 0px 0px 6px rgb(0 0 0 / 37%);
      border: none;
      padding: 40px 17px;
      margin: 20px 3px 25px 3px!important;
   }
   .how .service_icon {
      /*padding: 30px;*/
      position: relative;
      max-width: 140px;
      border-radius: 50%;
      transition: all .3s ease-in-out;
   }
   .how .service_icon .white-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
   }
   .service_single_box:hover{
      color: #FFF!important;
      background-color:  #0c67c2!important;
   }
   .service_single_box:hover .asd{  color: #fff !important;}
   .service_single_box:hover .College_t{  color: #fff !important;}
   .service_single_box:hover .img_icon_b{  opacity: 0!important;}
   .owl-nav button {
      position: absolute;
      top: 50%;
      background-color: #000;
      color: #fff;
      margin: 0;
      transition: all 0.3s ease-in-out;
   }
   .owl-nav button.owl-prev {
      left: -50px;
   }
   .owl-nav button.owl-next {
      right:  -50px;
   }
   .owl-prev
   {
      left: -50px;
   }
   .owl-next
   {
      right: : -50px;
   }
   .owl-nav button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
   }
   span {
      font-size: 80px;    
      position: relative;
      top: -5px;
      line-height: 0;
   }
   .owl-nav button:focus {
      outline: none;
   }
</style>
<style type="text/css">
   .social-icons >li{
      display: inline-block;
   }
   .social-icons >li >a{
      width: 35px;
      height: 35px;
      line-height: 35px;
      margin-left: 6px;
      margin-right: 0;
      border-radius: 100%;
      border:1px solid;
      text-align: center;
      color: #818a91;
      font-size: 16px;
      display: inline-block;
      transition: all .2s linear;
   }
   .social-icons >li >a:hover{
      border-color: #f24d5d;
   }
   .sI:hover .s_icon{
      color: #f24d5d;
   }
</style>
<main class="main_ped">
   <section class="hero_single version_2">
      <div class="wrapper">
         <div class="container" style="text-align: start;">
            <p style="color: #F14C5C;margin-bottom: 15px;">The Leader in Online Lraring</p>
            <h3 style="color: #000;">Master the skills to <br> Drive your career.</h3>
            <form>
               <div id="custom-search-input">
                  <div class="input-group">
                     <input type="text" class=" search-query" placeholder="Search course, college name ">
                     <!-- <input type="submit" class="btn_search b-search" value="0">  -->
                     <button type="submit" class="b-search"><i class="fa fa-search"></i></button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </section>
   <!-- /hero_single -->
   
   <section class="how" style="padding-top: 80px; padding-bottom:70px;background: #F8F8F8;">
      <div class="container">
         <div class="section-heading text-center pb-5">
            <p class="wow fadeInUp" data-wow-delay="0.2s" style="color: #F14C5C;margin-bottom: 10px">Browse Categories</p>
            <h2 class="wow fadeInUp" data-wow-delay="0.3s">Expolore TheBest College Strems In India</h2>
            <p class="wow fadeInUp" data-wow-delay="0.4s">AdmissionLelo acts as a simple, online search engine portal connecting both the top colleges in India and the candidates seeking information about them in order to choose the right stream. Choosing the best college streams in India is not an easy task. We help to make it easier for you by providing all the right information you need to make life-changing decisions.</p>
         </div>
         <div class="owl-carousel owl-theme">
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/ENGINEERING_FFF.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/ENGINEERING.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">ENGINEERING AND TECHNOLOGY</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(1);
                        $cource_count = $this->mhome->getCourceCount(1);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/network_FFF.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/network.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">BUSINESS AND COMMERCE</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(2);
                        $cource_count = $this->mhome->getCourceCount(2);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/EDUCATION_FFF.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/EDUCATION.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">EDUCATION AND TEACHING</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(4);
                        $cource_count = $this->mhome->getCourceCount(4);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/pharmacy-fff.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/pharmacy.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">PHARMACY</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(5);
                        $cource_count = $this->mhome->getCourceCount(5);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/paramedic-fff.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/paramedic.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">PARAMEDICAL</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(6);
                        $cource_count = $this->mhome->getCourceCount(6);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/web-design-fff.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/web-design.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">DESIGN COURSES</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(7);
                        $cource_count = $this->mhome->getCourceCount(7);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/conversation-fff.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/conversation.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">MASS COMMUNICATION</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(8);
                        $cource_count = $this->mhome->getCourceCount(8);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/cv-fff.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/cv.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">COMPUTER APPLICATION</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(9);
                        $cource_count = $this->mhome->getCourceCount(9);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/pharmacy-fff.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/pharmacy.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">LAW</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(3);
                        $cource_count = $this->mhome->getCourceCount(3);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
            <div class="item">
               <div class="service_single_content box-shadow text-center mb-100 wow fadeInUp service_single_box" data-wow-delay="0.5s">
                  <div class="service_icon d-inline-block">
                     <img src="<?= base_url() ?>cms_assets/img/pharmacy-fff.png" class="colored-icon img_icon_F" alt="">
                     <img src="<?= base_url() ?>cms_assets/img/pharmacy.png" class="white-icon img_icon_b" alt="">
                  </div>
                  <h6 class="asd">HOSPITALITY AND TOURISM MANAGEMENT</h6>
                  <ul>
                     <?php
                        $college_count = $this->mhome->getCollegeCounts(10);
                        $cource_count = $this->mhome->getCourceCount(10);
                     ?>
                     <li class="College_t" style="margin-right: 15px;">College: <?= $college_count ?></li>
                     <li class="College_t">Courses: <?= $cource_count ?></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /container -->
   <div class="container-fluid" style="padding-top:70px;padding-bottom: 40px;  background:#ffffff;box-shadow: 0 0px 6px 0 rgb(0 0 0 / 11%);">
      <div class="container">
         <div class="row">
            <div class="col-lg-2" style="align-self: center;">
               <div class="text-center">
                  <h6>Admissionlelo :</h6>
               </div>
            </div>
            <div class="col-lg-5">
               <div class="row">
                  <div class="col-lg-3 col-md-3 col-3">
                     <div class=""> <img src="<?= base_url() ?>cms_assets/img/ht.jpg" class="w-100"></div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-3">
                     <div class=""> <img src="<?= base_url() ?>cms_assets/img/bs.jpg" class="w-100"></div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-3">
                     <div class=""> <img src="<?= base_url() ?>cms_assets/img/bw.jpg" class="w-100"></div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-3">
                     <div class=""> <img src="<?= base_url() ?>cms_assets/img/dh.jpg" class="w-100"></div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="row">
                  <div class="col-lg-6 col-md-6 col-6">
                     <div class=""> <img src="<?= base_url() ?>cms_assets/img/pu.jpg" class="w-100"></div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6" style="align-self: center;">
                     <div class=""> <img src="<?= base_url() ?>cms_assets/img/lv.jpg" class="w-100"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container margin_60">
      <div class="main_title_2">
         <p style="color: #F14C5C;margin-bottom: 0px; ">Featured Course</p>
         <h2 style="color: #000;margin-top: 0;">Pick Course to Get Started</h2>
      </div>
      <div class="row">
         <?php 
            $courseList = $this->mhome->getCourseList();
            if(!empty($courseList)){
               foreach($courseList as $course){
                  ?>
                     <div class="col-lg-4 col-md-6 wow" data-wow-offset="150">
                        <a href="<?= base_url().'courses/details/'.strtolower (str_replace(" ","-",$course->stream_name)); ?>" class="grid_item">
                           <figure class="block-reveal">
                              <div class="block-horizzontal"></div>
                              <img src="<?= base_url() ?>upload/<?= $course->stream_img ?>" class="img-fluid" alt="">
                              <div class="info">
                                 <h3><?= $course->stream_name ?></h3>
                              </div>
                           </figure>
                        </a>
                     </div>
                  <?php
               }
            }
         ?>
      </div>
      <p class="text-center mt-3"><a href="<?= base_url() ?>courses" class="btn_1 rounded" style="font-weight: 500; border-radius: 5px!important;">Browse More Courses</a></p>
      <!-- /row -->
   </div>
   <div class="container-fluid" style="padding-top:70px;padding-bottom: 40px;  background: linear-gradient(to right,  #051757 0%,#051757 50%,#02113a 50%,#02113a 100%);">
      <div class="container">
         <div class="row">
            <div class="col-lg-5">
               <div class="">
                  <h2 style="color: #fff; font-size: 31px;">Why you need the guidanace of AdmissionLelo </h2>
                  <p style="color: #fff;font-size: 21px;">Best career Counselling in Delhi?</p>
                  <p class="text-start mt-3"><a href="#" class="btn_1 rounded" style="font-weight: 500; border-radius: 5px!important;">Sing up now</a></p>
               </div>
            </div>
            <div class="col-lg-7">
               <div class="row">
                  <div class="col-lg-6 col-md-6">
                     <div style="background: #fff; border-radius: 5px;padding: 15px 25px;margin-bottom: 30px;">
                        <figure style="display: inline-block;vertical-align: top;margin: 0;"><img src="<?= base_url() ?>cms_assets/img/Screenshot_1.png" style="height: 50px;"></figure>
                        <div style="display: inline-block;margin-left: 10px;">
                           <h3 class="mb-0" style="font-size: 24px;">Flexible classes</h3>
                           <p class="m-0">You pick the schedule.</p>
                        </div>
                     </div>
                     <div style="background: #fff; border-radius: 5px;padding: 15px 25px;margin-bottom: 30px;">
                        <figure style="display: inline-block;vertical-align: top;margin: 0;"><img src="<?= base_url() ?>cms_assets/img/Screenshot_3.png" style="height: 50px;"></figure>
                        <div style="display: inline-block;margin-left: 10px;">
                           <h3 class="mb-0" style="font-size: 24px;">Flexible classes</h3>
                           <p class="m-0">You pick the schedule.</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <div style="background: #fff; border-radius: 5px;padding: 15px 25px;margin-bottom: 30px;">
                        <figure style="display: inline-block;vertical-align: top;margin: 0;"><img src="<?= base_url() ?>cms_assets/img/Screenshot_2.png" style="height: 50px;"></figure>
                        <div style="display: inline-block;margin-left: 10px;">
                           <h3 class="mb-0" style="font-size: 24px;">Offline mode</h3>
                           <p class="m-0">Download classes.</p>
                        </div>
                     </div>
                     <div style="background: #fff; border-radius: 5px;padding: 15px 25px;margin-bottom: 30px;">
                        <figure style="display: inline-block;vertical-align: top;margin: 0;"><img src="<?= base_url() ?>cms_assets/img/Screenshot_4.png" style="height: 50px;"></figure>
                        <div style="display: inline-block;margin-left: 10px;">
                           <h3 class="mb-0" style="font-size: 24px;">Educator help</h3>
                           <p class="m-0">Always get answers.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /container -->
   <div class="container-fluid" style="padding-top: 90px;padding-bottom: 90px;background: #F8F8F8;">
      <div class="container">
         <div class="main_title_2">
            <p style="color: #F14C5C;margin-bottom: 10px"><b>Testimonials</b></p>
            <h2 style="color: #000; margin-top: 0;">Student Community Feedback</h2>
         </div>
         <?php
            $testimonials = $this->mhome->getTestimonials();
            if(!empty($testimonials)){
               ?>
                  <div class="owl-carousel owl-theme">
                     <?php
                        foreach($testimonials as $testimonal){
                           ?>
                              <div class="item">
                                 <div style="box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 23%);padding: 22px; margin: 4px;background: #fff;height: 254px;overflow: auto;">
                                    <ul style="margin-bottom: 13px;">
                                       <li class="d-inline-block"><i class="fa fa-star" aria-hidden="true" style="color: #f8bb00;"></i></li>
                                       <li class="d-inline-block"><i class="fa fa-star" aria-hidden="true" style="color: #f8bb00;"></i></li>
                                       <li class="d-inline-block"><i class="fa fa-star" aria-hidden="true" style="color: #f8bb00;"></i></li>
                                       <li class="d-inline-block"><i class="fa fa-star" aria-hidden="true" style="color: #f8bb00;"></i></li>
                                       <li class="d-inline-block"><i class="fa fa-star" aria-hidden="true" style="color: #f8bb00;"></i></li>
                                    </ul>
                                    <p style="font-size: 13px; margin-bottom: 13px;color: #000;"><?= $testimonal->message_text; ?></p>
                                    <p class="m-0" style="color: #000;font-weight: 600;"><?= $testimonal->customer_name; ?></p>
                                 </div>
                              </div>
                           <?php 
                        }
                     ?>
                  </div>
               <?php
            }
         ?>
      </div>
   </div>
   <div class="call_section">
      <div class="container clearfix">
         <div class="col-lg-5 col-md-6 float-right wow" data-wow-offset="250">
            <div class="block-reveal">
               <div class="block-vertical"></div>
               <div class="box_1">
                  <h3>Free Career Counselling</h3>
                  <p class="mb-2">Ius cu tamquam persequeris, eu veniam apeirian platonem qui, id aliquip voluptatibus pri. Ei mea primis ornatus disputationi. Menandri erroribus cu per, duo solet congue ut. </p>
                  <p class="mb-2">every student dreams of landing a perfect job and of landing a perfect job one has to study in top college in india. howewe, it isn't easy to choose the perfect college</p>
                  <p class="mb-2">every student dreams of landing a perfect job and of landing a perfect job one has to study in top college in india. howewe, it isn't easy to choose the perfect college</p>
                  <div class="text-center"> <a href="#0" class="btn_1 rounded" style="margin-top: 10px; border-radius: 5px!important;">Read more</a> </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="bg_color_1" style="position: relative;">
      <div class="container margin_120_95 pt-4">
         <div class="main_title_2">
            <h2>Blogs</h2>
         </div>
         <div class="row">
            <div class="col-lg-6">
               <a class="box_news" href="#0">
                  <figure>
                     <img src="<?= base_url() ?>cms_assets/img/news_home_1.jpg" alt="">
                     <figcaption><strong>28</strong>Dec</figcaption>
                  </figure>
                  <h4>How to Choose the Best <br> Education Counsellor</h4>
                  <p>every student dreams of landing a perfect job and of landing a perfect job one has to study in top college in india. howewe, it isn't easy to choose the perfect college  </p>
               </a>
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
               <a class="box_news" href="#0">
                  <figure>
                     <img src="<?= base_url() ?>cms_assets/img/news_home_2.jpg" alt="">
                     <figcaption><strong>28</strong>Dec</figcaption>
                  </figure>
                  <h4>How to Choose the Best <br> Education Counsellor</h4>
                  <p>every student dreams of landing a perfect job and of landing a perfect job one has to study in top college in india. howewe, it isn't easy to choose the perfect college  </p>
               </a>
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
               <a class="box_news" href="#0">
                  <figure>
                     <img src="<?= base_url() ?>cms_assets/img/news_home_3.jpg" alt="">
                     <figcaption><strong>28</strong>Dec</figcaption>
                  </figure>
                  <h4>How to Choose the Best <br> Education Counsellor</h4>
                  <p>every student dreams of landing a perfect job and of landing a perfect job one has to study in top college in india. howewe, it isn't easy to choose the perfect college  </p>
               </a>
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
               <a class="box_news" href="#0">
                  <figure>
                     <img src="<?= base_url() ?>cms_assets/img/news_home_4.jpg" alt="">
                     <figcaption><strong>28</strong>Dec</figcaption>
                  </figure>
                  <h4>How to Choose the Best <br> Education Counsellor</h4>
                  <p>every student dreams of landing a perfect job and of landing a perfect job one has to study in top college in india. howewe, it isn't easy to choose the perfect college  </p>
               </a>
            </div>
            <!-- /box_news -->
         </div>
         <!-- /row -->
         <p class="text-center mt-3"><a href="#" class="btn_1 rounded" style="font-weight: 500; border-radius: 5px!important;">View All Blogs</a></p>
      </div>
      <!-- /container -->
   </div>
   <div class="container-fluid" style="position: absolute; bottom: -80px;">
      <div class="container">
         <div class="row py-5 px-4 what_sec">
            <div class="col-lg-6">
               <div>
                  <h3 class="c-fff f--18">Want Us to Email you about Special offers & Updates?</h3>
               </div>
            </div>
            <div class="col-lg-6" style="align-self: center;">
               <div class="text-center">
                  <form class="example">
                     <input type="text" class="email_subs">
                     <button type="submit" class="btn-subscribe">subscribe</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- /container -->
   </div>
   <!-- /bg_color_1 -->
   <!--/call_section--> 
</main>
<!-- /main -->
         
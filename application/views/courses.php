
         <main class="main_ped">
            <section id="hero_in" class="courses">
               <div class="wrapper" style="background-image: url(<?= base_url() ?>cms_assets/img/bn-4.jpg);
                  background-size: cover; ">
                  <div class="container">
                     <h1 class="fadeInUp" style="text-align: start;"> Top Courses</h1>
                  </div>
               </div>
            </section>
            <!--/hero_in-->
            <section>
               <div class="container margin_60">
                  <div class="main_title_2">
                     <h2 style="color: #000;margin-top: 0;"> Popular Courses</h2>
                  </div>
                  <div class="row">
                     <?php
                        if(!empty($courseList)){
                           foreach($courseList as $course){
                              ?>
                                 <div class="col-lg-4 col-md-6 wow" data-wow-offset="150">
                                    <a href="<?= base_url().'courses/details/'.strtolower (str_replace(" ","-",$course->stream_name)); ?>" class="grid_item">
                                       <figure class="block-reveal">
                                          <div class="block-horizzontal"></div>
                                          <img src="<?= base_url() ?>upload/<?= $course->stream_img ?>" class="img-fluid" alt="">
                                          <div class="info">
                                             <!-- <small><i class="ti-layers"></i>15 Programmes</small> -->
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
                  <!-- <p class="text-center mt-3"><a href="#" class="btn_1 rounded" style="font-weight: 500; border-radius: 5px!important;"> LOAD MORE </a></p> -->
                  <!-- /row -->
               </div>
            </section>
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
         </main>
         
<style type="text/css">
   .rule {
      margin: 10px 0;
      border: none;
      height: 1.5px;
      background-image: linear-gradient(left, #f0f0f0, #c9bbae, #f0f0f0);
   }
   /* ===== Select Box ===== */
   .sel {
      font-size: 14px;
      display: inline-block;
      width: 100%;
      background-color: transparent;
      position: relative;
      cursor: pointer;
   }
   .sel::before {
      position: absolute;
      content: "↓";
      height: 10px;width: 10px;
      font-size: 24px;
      color: #999;
      right: 20px;
      top: calc(50% - 1em);
   }
   .sel.active::before {
      transform: rotateX(-180deg);
   }
   .sel__placeholder {
      display: block;
      /*font-size: 2.3em;*/
      color: #838e95;
      padding: 0.2em 0.5em;
      text-align: left;
      pointer-events: none;
      user-select: none;
      visibility: visible;
   }
   .sel.active .sel__placeholder {
      visibility: hidden;
   }
   .sel__placeholder::before {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 0.2em 0.5em;
      content: attr(data-placeholder);
      visibility: hidden;
   }
   .sel.active .sel__placeholder::before {
      visibility: visible;
   }
   .sel__box {
      position: absolute;
      top: calc(100% + 4px);
      left: -4px;
      display: none;
      list-style-type: none;
      text-align: left;
      font-size: 1em;
      background-color: #FFF;
      width: calc(100% + 8px);
      box-sizing: border-box;
   }
   .sel.active .sel__box {
      display: block;
      animation: fadeInUp 500ms;
   }
   .sel__box__options {
      display: list-item;
      font-size: 14px;
      color: #838e95;
      padding: 0.5em;
      user-select: none;
   }
   .sel__box__options::after {
      content: '\f00c';
      font-family: 'FontAwesome';
      font-size: 0.5em;
      margin-left: 5px;
      display: none;
   }
   .sel__box__options.selected::after {
      display: inline;
   }
   .sel__box__options:hover {
      background-color: #ebedef;
   }
   /* ----- Select Box Black Panther ----- */
   .sel {
      border-bottom: 2px solid #9d2e4e;
   }
   .sel--black-panther {
      z-index: 3;
      font-weight: 500;
   }
   /* ----- Select Box Superman ----- */
   .sel--superman {
   /*   display: none; */
      z-index: 2;
   }
   /* ===== Keyframes ===== */
   @keyframes fadeInUp {
      from {
         opacity: 0;
         transform: translate3d(0, 20px, 0);
      }
      to {
         opacity: 1;
         transform: none;
      }
   }
   @keyframes fadeOut {
      from {
         opacity: 1;
      }
      to {
         opacity: 0;
      }
   }
</style>
         <main class="main_ped">
            <section id="hero_in" class="courses">
               <div class="wrapper" style="background-image: url(<?= base_url() ?>cms_assets/img/bn-1.jpg);
                  background-size: cover; ">
                  <div class="container">
                     <h1 class="fadeInUp" style="text-align: start"><?= isset($courseDetail) ? $courseDetail->stream_name : '' ?></h1>
                  </div>
               </div>
            </section>
            <!--/hero_in-->
            <div class="">
               <div class="container-fluid margin_60_35">
                  <div class="row">
                     <div class="col-lg-8 p-0">
                        <section class="p-3">
                           <div>
                              <h4>Top <?= isset($courseDetail) ? $courseDetail->stream_name : '' ?> Courses in india</h4>
                              <?php
                                 if(isset($courseDetail)){
                                    echo $courseDetail->stream_desc;
                                 }
                              ?>
                           </div>
                        </section>
                        <section class="pt-3">
                           <div class="container-fluid">
                              <h4>Best <?= isset($courseDetail) ? $courseDetail->stream_name : '' ?> college in india </h4>
                              <?php
                                 if(isset($courseDetail)){
                                    echo $courseDetail->stream_college_desc;
                                 }
                              ?>
                              <?php
                                 $colleges = $this->mcourses->getColleges($courseDetail->stream_id);
                                 if(!empty($colleges)){
                                    ?>
                                       <div class="row">
                                          <?php
                                             foreach($colleges as $college){
                                                ?>
                                                   <div class="col-lg-4 col-md-6">
                                                      <div style="box-shadow: 0 5px 40px 0 rgb(0 0 0 / 11%); margin-bottom: 30px; ">
                                                         <div class="">
                                                            <img src="<?= base_url() ?>upload/<?= $college->college_image ?>" style="width: 100%;height: 190px;">
                                                         </div>
                                                         <div class="" style="padding: 10px;">
                                                            <P style="margin-bottom:0px; font-size:15px;font-weight: 600; color: #000;"><?= $college->college_name ?></P>
                                                            <P style="margin-bottom:0px ;"><?= $college->city.' '.$college->state ?></P>
                                                         </div>
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
                        </section>
                        <section class="bg_color_1 p-3">
                           <div class="container-fluid">
                              <h4>Types of <?= isset($courseDetail) ? $courseDetail->stream_name : '' ?> Courses</h4>
                              <?= isset($courseDetail) ? $courseDetail->stream_course_desc : '' ?>
                              <?php
                                 $courses_names = $this->mcourses->getCoursesList($courseDetail->stream_id);
                                 if(!empty($courses_names)){
                                    ?>
                                       <div class="row">
                                          <div class="col-lg-6">
                                             <ul class="bullets mb-0">
                                                <?php
                                                   foreach ($courses_names as $key => $names) {
                                                      if($key < 18){
                                                         ?>
                                                            <li><?= $names->course_name ?></li>
                                                         <?php
                                                      }
                                                   }
                                                ?>
                                             </ul>
                                          </div>
                                          <div class="col-lg-6">
                                             <ul class="bullets">
                                                <?php
                                                   foreach ($courses_names as $key => $names) {
                                                      if($key > 18){
                                                         ?>
                                                            <li><?= $names->course_name ?></li>
                                                         <?php
                                                      }
                                                   }
                                                ?>
                                             </ul>
                                          </div>
                                       </div>
                                    <?php
                                 }
                              ?>
                           </div>
                        </section>
                        <!-- /section -->
                     </div>
                     <!-- /col -->
                     <aside class="col-lg-4" id="sidebar">
                        <div class="">
                           <div style="text-align: center; padding: 25px; background-color: #9d2e4e;border-radius: 5px 5px 0 0;">
                              <img src="<?= base_url() ?>cms_assets/img/home-icon.png">
                              <h4 style="color: #fff;font-family: emoji;margin:15px 0 15px 0;">Apply For Admission</h4>
                              <p class="nopadding" style="color: #fff;">ALHM INSTITUTE OG TOURISM AND HOTEL MANAGEMENT</p>
                           </div>
                           <div id="message-contact"></div>
                           <form class="box_detail" method="post" action="assets/contact.php" id="contactform" autocomplete="off">
                              <div class="">
                                 <div class="">
                                    <span class="input">
                                    <input class="input_field" type="text" id="name_contact" name="name_contact">
                                    <label class="input_label">
                                    <span class="input__label-content">Your Name</span>
                                    </label>
                                    </span>
                                 </div>
                                 <div class="">
                                    <span class="input">
                                    <input class="input_field" type="email" id="email_contact" name="email_contact">
                                    <label class="input_label">
                                    <span class="input__label-content">Your email</span>
                                    </label>
                                    </span>
                                 </div>
                                 <div class="">
                                    <span class="input">
                                    <input class="input_field" type="text" id="phone_contact" name="phone_contact">
                                    <label class="input_label">
                                    <span class="input__label-content">Your telephone</span>
                                    </label>
                                    </span>
                                 </div>
                                 <div class="sel sel--black-panther" style="margin: 15px 0;">
                                    <select name="select-profession" id="select-profession">
                                       <option value="" disabled> Select strem</option>
                                       <option value="Profession" >Profession</option>
                                       <option value="hacker">Hacker</option>
                                       <option value="gamer">Gamer</option>
                                       <option value="developer">Developer</option>
                                       <option value="programmer">Programmer</option>
                                       <option value="designer">Designer</option>
                                    </select>
                                 </div>
                                 <div class="sel sel--superman" style="margin: 15px 0;">
                                    <select name="select-superpower" id="select-superpower">
                                       <option value="" disabled>Superpower</option>
                                       <option value="hacker">Power</option>
                                       <option value="gamer">Speed</option>
                                       <option value="developer">Acrobatics</option>
                                       <option value="programmer">Accuracy</option>
                                    </select>
                                 </div>
                              </div>
                              <!-- /row -->
                              <div style="position:relative; margin-top: 10px;">
                                 <input type="submit" value="Apply Now" class="btn_1 full-width" id="submit-contact" style="background: #9d2e4e;">
                              </div>
                           </form>
                        </div>
                     </aside>
                  </div>
                  <!-- /row -->
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
         </main>
         <!--/main-->
      
      <script type="text/javascript">
         /* ===== Logic for creating fake Select Boxes ===== */
         $('.sel').each(function() {
         $(this).children('select').css('display', 'none');
         
         var $current = $(this);
         
         $(this).find('option').each(function(i) {
         if (i == 0) {
         $current.prepend($('<div>', {
         class: $current.attr('class').replace(/sel/g, 'sel__box')
         }));
         
         var placeholder = $(this).text();
         $current.prepend($('<span>', {
         class: $current.attr('class').replace(/sel/g, 'sel__placeholder'),
         text: placeholder,
         'data-placeholder': placeholder
         }));
         
         return;
         }
         
         $current.children('div').append($('<span>', {
         class: $current.attr('class').replace(/sel/g, 'sel__box__options'),
         text: $(this).text()
         }));
         });
         });
         
         // Toggling the `.active` state on the `.sel`.
         $('.sel').click(function() {
         $(this).toggleClass('active');
         });
         
         // Toggling the `.selected` state on the options.
         $('.sel__box__options').click(function() {
         var txt = $(this).text();
         var index = $(this).index();
         
         $(this).siblings('.sel__box__options').removeClass('selected');
         $(this).addClass('selected');
         
         var $currentSel = $(this).closest('.sel');
         $currentSel.children('.sel__placeholder').text(txt);
         $currentSel.children('select').prop('selectedIndex', index + 1);
         });
         
      </script>
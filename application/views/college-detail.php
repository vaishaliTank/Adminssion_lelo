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

   .course_type_table table{
      width: 100%;
   }

   .course_type_table .panel-collapse{
      padding-left: 10px;
   }

   #sidebar .topLogo {
       width: 100%;
       float: left;
       padding: 30px 20px;
       background: #e8ebf0;
       margin-bottom: 20px;
       text-align: center;
   }
</style>
         <main class="main_ped">
            <section id="hero_in" class="courses">
               <div class="wrapper" style="background-image: url(<?= base_url() ?>cms_assets/img/bn-1.jpg);
                  background-size: cover; ">
                  <div class="container">
                     <h1 class="fadeInUp" style="text-align: start;"> <?= isset($collegeDetails) ? $collegeDetails->college_name : '' ?></h1>
                     <h5 style="text-align: left;color: #fff;"><?= isset($collegeDetails) ? $collegeDetails->city.' '.$collegeDetails->state : '' ?></h5>
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
                              <img src="<?= base_url() ?>upload/<?= $collegeDetails->college_image ?>" style="width: 100%;">
                           </div>
                        </section>
                        <section class="p-3">
                           <div>
                              <h4>ABOUT US</h4>
                              <?php
                                 if(isset($collegeDetails)){
                                    echo $collegeDetails->aboutus;
                                 }
                              ?>
                           </div>
                        </section>
                        <section class="p-3">
                           <div>
                              <h4>FEATURES</h4>
                              <div class="row feature-icons" style="text-transform: uppercase;">
                                 <div class="col">
                                    <img src="<?= base_url() ?>upload/extra-images/feature-icon1.png">
                                    <span>infrastructure</span>
                                 </div>  
                                 <div class="col">
                                    <img src="<?= base_url() ?>upload/extra-images/feature-icon2.png">
                                    <span>hotels</span>
                                 </div>
                                 <div class="col">
                                    <img src="<?= base_url() ?>upload/extra-images/feature-icon3.png">
                                    <span>library</span>
                                 </div>
                                 <div class="col">
                                    <img src="<?= base_url() ?>upload/extra-images/feature-icon4.png">
                                    <span>cafeteria</span>
                                 </div>
                                 <div class="col">
                                    <img src="<?= base_url() ?>upload/extra-images/feature-icon5.png">
                                    <span>transportation</span>
                                 </div>
                                 <div class="col">
                                    <img src="<?= base_url() ?>upload/extra-images/feature-icon6.png">
                                    <span>sports</span>
                                 </div>
                                 <div class="col">
                                    <img src="<?= base_url() ?>upload/extra-images/feature-icon7.png">
                                    <span>placements</span>
                                 </div>
                              </div>
                           </div>
                        </section>
                        <section class="p-3 course_type_table">
                           <div>
                              <h4><?= isset($collegeDetails) ? $collegeDetails->college_name : '' ?> COURSES</h4>
                              <table>
                                 <thead>
                                    <tr>
                                       <th width="50%">Course</th>
                                       <th width="20%">Duration</th>
                                       <th width="15%">Annual Fee (National)</th>
                                       <th width="15%">International Fees</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td colspan="4">
                                          <table>
                                             <tr>
                                                <td>
                                                   <div id="faq" role="tablist" aria-multiselectable="true">
                                                      <?php
                                                         $streamSql = "SELECT * FROM tbl_stream WHERE status=1";
                                                         $streamRes = $this->db->query($streamSql);
                                                         if($streamRes->num_rows() > 0){
                                                            foreach($streamRes->result() as $stream){
                                                               $courseSql = "SELECT tbl_college_course.*, tbl_course.course_name FROM tbl_college_course LEFT JOIN tbl_course ON tbl_course.courseid=tbl_college_course.course_id  WHERE college_id='".$collegeDetails->college_id."' AND tbl_college_course.stream_id='".$stream->stream_id."' AND tbl_college_course.status=1 LIMIT 4";
                                                               $courseRes = $this->db->query($courseSql);
                                                               if($courseRes->num_rows() > 0){
                                                                  ?>
                                                                     <div class="panel panel-default">
                                                                        <div class="panel-heading" role="tab" id="questionOne<?php echo $stream->stream_id ?>">
                                                                           <!-- <h2 class="panel-title"> -->
                                                                              <a data-toggle="collapse" data-parent="#faq" href="#answerOne<?= $stream->stream_id ?>" aria-expanded="false" aria-controls="answerOne<?= $stream->stream_id ?>">
                                                                                 <?= $stream->stream_name;?> 
                                                                              </a>
                                                                           <!-- </h2> -->
                                                                        </div>
                                                                        <div id="answerOne<?= $stream->stream_id ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="questionOne<?= $stream->stream_id ?>">
                                                                           <table>
                                                                              <?php
                                                                                 foreach($courseRes->result() as $course){
                                                                                    ?>
                                                                                       <tr>
                                                                                          <td  width="50%"><?= $course->course_name; ?></td>
                                                                                          <td  width="20%"><?= $course->duration; ?></td>
                                                                                          <td  width="15%"><?= $course->annual_fees; ?></td>
                                                                                          <td  width="15%"><?= $course->international_fees; ?></td>
                                                                                       </tr>
                                                                                    <?php 
                                                                                 }
                                                                              ?>
                                                                           </table>
                                                                        </div>
                                                                     </div>
                                                                  <?php   
                                                               }
                                                            }
                                                         }
                                                      ?>
                                                   </div>
                                                </td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </section>
                        <section class="p-3">
                           <div>
                              <h4>FACULTY DETAILS</h4>
                              <table style="width: 100%;">
                                 <tr>
                                    <th>FACULTY DETAILS</th>
                                    <th>DESIGNATION</th>
                                 </tr>
                                 <?php
                                    $sqlFaculty = "SELECT * FROM tbl_college_facility WHERE college_id='".$collegeDetails->college_id."' AND status=1";
                                    $resFaculty = $this->db->query($sqlFaculty);
                                    if($resFaculty->num_rows() > 0){ 
                                       foreach($resFaculty->result() as $faculty){
                                          ?>
                                             <tr>
                                                <td><?= $faculty->facility_fname." ".$faculty->facility_lname; ?></td>
                                                <td><?= $faculty->designation; ?></td>
                                             </tr>
                                          <?php 
                                       }
                                    }
                                 ?>
                              </table>
                           </div>
                        </section>
                        <!-- /section -->
                     </div>
                     <!-- /col -->
                     <aside class="col-lg-4" id="sidebar">
                        <div class="">
                           <?php 
                              $socialSql = "SELECT * FROM tbl_social_link WHERE college_id='".$collegeDetails->college_id."'";
                              $resSocial = $this->db->query($socialSql);
                              if($resSocial->num_rows() > 0){
                                 $clg_details = $resSocial->row();
                                 ?>
                                    <div class="topLogo">
                                       <img src="<?= base_url(); ?>upload/<?= $clg_details->college_logo; ?>" alt="GNIOT" />
                                    </div>
                                    <div class="loginDetails">
                                       <p><span>Email Id :</span><a href="mailto:<?= $clg_details->college_email; ?>"><?= $clg_details->college_email; ?></a></p>
                                       <p><span>Phone :</span><?= $clg_details->college_phone; ?></p>
                                   </div>
                                   <div class="socialLiks">
                                       <h4>Social Links</h4>
                                       <ul style="display: inline-flex;">
                                           <li><a style="font-size: 30px;padding: 10px;" href="<?= $clg_details->facebooklink; ?>" target="_blank" class="facebook"><i class="fa fa-facebook-square"></i></a></li>
                                           <li><a style="font-size: 30px;padding: 10px;" href="<?= $clg_details->twitterlink; ?>" target="_blank" class="twitter"><i class="fa fa-twitter-square"></i></a>  </li>
                                           <!-- <li><a href="<? $clg_details->googlepluslink; ?>" target="_blank" class="google-plus"><i class="fa fa-google-plus-square"></i></a> </li> -->
                                           <li><a style="font-size: 30px;padding: 10px;" href="<?= $clg_details->linkedinlink; ?>" target="_blank" class="linkedin"><i class="fa fa-linkedin-square"></i></a>
                                           <li><a style="font-size: 30px;padding: 10px;" href="<?= $clg_details->instagramlink; ?>" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a> </li> 
                                       </ul>
                                   </div>
                                 <?php
                              }
                           ?>
                        </div>
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
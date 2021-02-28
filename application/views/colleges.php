
         <main class="main_ped">
            <section id="hero_in" class="courses">
               <div class="wrapper" style="background-image: url(<?= base_url() ?>cms_assets/img/bn-2.jpg);background-size: cover; ">
                  <div class="container">
                     <!--  <h1 class="fadeInUp"> university</h1> -->
                     <div class="row">
                        <div class="col-lg-2"> </div>
                        <div class="col-lg-8">
                           <form method="POST" action="<?= base_url() ?>colleges" name="searchfrm" id="searchfrm">
                              <h1 class="fadeInUp"> university</h1>
                              <div class="search_bar_error mb-0">
                                 <input type="text" name="freeserchvalue" id="freeserchvalue" class="form-control" placeholder="Search by Courses, Search by State, Search by University">
                                 <input type="submit" value="Search">
                              </div>
                           </form>
                        </div>
                        <div class="col-lg-2"> </div>
                     </div>
                  </div>
               </div>
            </section>
            <!--/hero_in-->
            <section class="py-5">
               <div class="container">
                  <h4 style="margin-bottom: 20px;">The Top College in India ary only a Click away! </h4>
                  <p style="margin-bottom: 10px;">AdmissionLelo is proud to be India's number one education advisory portal guiding you for your learning and higher schooling needs. We offer a comprehensive database of the top colleges in India, showcase complete information on what it takes to get admission in best colleges in India. Getting into the best colleges in India was never easier, especially now when we got your back.</p>
                  <p style="margin-bottom: 10px;">Our information portal offers tens of thousands of courses from across hundreds of the best colleges in India - all aimed at making it easier for you to arrive at the right decision for your education and career, with minimum fuss.</p>
                  <p style="margin-bottom: 10px;">These top colleges in India often feature world-class infrastructure, continuous innovation-based pedagogy, and updated syllabi to ensure that not only are students enabled optimally for the best learning outcomes in the best manners possible but also that they are employable in the real world by companies and industries to solve real-world problems dynamically.</p>
                  <div>
                     <div id="Home" class="tabcontent">
                        <div class="row py-5">
                           <?php
                              if(!empty($collegeList)){
                                 foreach($collegeList as $college){
                                    ?>
                                       <div class="col-lg-4 col-md-6">
                                          <div class="box_col">
                                             <div>
                                                <img src="<?= base_url() ?>upload/<?= $college->college_image ?>" style="height:233px;" class="w-100">
                                             </div>
                                             <div class="" style="padding: 10px;">
                                                <a href="<?= base_url() ?>colleges/details/<?= strtolower (str_replace(" ","-",$college->college_name)."-".str_replace(" ","-",$college->city)."-".str_replace(" ","-",$college->state)."-".$college->college_id);?>" class="box_col_na"><?= $college->college_name ?></a>
                                                <P class="mb-0" ><?= $college->city.' '.$college->state ?></P>
                                             </div>
                                          </div>
                                       </div>
                                    <?php
                                 } 
                              }
                           ?>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="text-center">
                     <button class="tablink bnt_s"style="padding: 10px 15px;"  onclick="openPage('Home', this, '#f24d5d')" id="defaultOpen">1</button>
                     <button class="tablink bnt_s" style="padding: 10px 13px;" onclick="openPage('News', this, '#f24d5d')">2</button>
                     <button class="tablink bnt_s" style="padding: 10px 13px;" onclick="openPage('Contact', this, '#f24d5d')">3</button>
                     <button class="tablink bnt_s" style="padding: 10px 13px;" onclick="openPage('About', this, '#f24d5d')"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                  </div> -->
                  <style type="text/css">
                     .bnt_s{
                     border-radius: 48px;
                     font-size: 15px;
                     line-height: 15px;
                     background-color: transparent;
                     border: 1px solid;
                     }
                  </style>
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
         
<script>
   function openPage(pageName,elmnt,color) {
     var i, tabcontent, tablinks;
     tabcontent = document.getElementsByClassName("tabcontent");
     for (i = 0; i < tabcontent.length; i++) {
       tabcontent[i].style.display = "none";
     }
     tablinks = document.getElementsByClassName("tablink");
     for (i = 0; i < tablinks.length; i++) {
       tablinks[i].style.backgroundColor = "";
     }
     document.getElementById(pageName).style.display = "block";
     elmnt.style.backgroundColor = color;
   }
   
   // Get the element with id="defaultOpen" and click on it
   document.getElementById("defaultOpen").click();
</script>

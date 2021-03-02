<style>
    .panel-light-primary {
        border: 1px solid #007aff !important;
    }
</style>
<div class="main-content">
    <div class="wrap-content container" id="container">
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle"> College Course Data</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            College Course Add
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/College_Course/<?= isset($coursemetaDetails) ? 'updateCollegeCourse' : 'saveCollegeCourse' ?>"> 
                                <input type="hidden" name="id" id="id" value="<?= isset($coursemetaDetails) ? $coursemetaDetails[0]->id : '' ?>">
                                <?php $disable=''; if(!empty($coursemetaDetails[0]->id)){
                                    $disable = 'readonly';
                                } ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stream_id">College Name<span class="text-danger">*</span></label>
                                       <select name="college" id="college" <?= $disable ?>>
                                            <?php 

                                            if(!empty($college)){ foreach($college as $row1){
                                                $str = ''; 
                                                 if($coursemetaDetails[0]->college_id == $row1->college_id){
                                                    $str = 'selected';
                                                 }
                                            ?>
                                            <option value="<?= $row1->college_id ?>" <?= $str; ?>><?= $row1->college_name ?></option>
                                            <?php }  } ?>
                                        </select>
                                        <span id="errorcollege" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_id">Stream Name<span class="text-danger">*</span></label>
                                        <select name="stream" id="stream" <?= $disable ?>>
                                            <?php if(!empty($streams)){ foreach($streams as $row){ 
                                                $str1 = ''; 
                                                 if($coursemetaDetails[0]->stream_id == $row->stream_id){
                                                    $str1 = 'selected';
                                                 }

                                            ?>
                                            <option value="<?= $row->stream_id ?>" <?= $str1; ?>><?= $row->stream_name ?></option>
                                            <?php }  } ?>
                                        </select>
                                        <span id="errorstream" style="color: red;"></span>
                                    </div>
                                     <div class="form-group">
                                        <label for="course_id">Course Name<span class="text-danger">*</span></label>
                                        <select name="Course" id="Course" <?= $disable ?>>
                                            <?php if(!empty($course)){ foreach($course as $row){ 
                                                $str1 = ''; 
                                                 if($coursemetaDetails[0]->course_id == $row->course_id){
                                                    $str1 = 'selected';
                                                 }

                                            ?>
                                            <option value="<?= $row->course_id ?>" <?= $str1; ?>><?= $row->course_name ?></option>
                                            <?php }  } ?>
                                        </select>
                                        <span id="errorcourse" style="color: red;"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="course_name">Duration<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="duration" id="duration" value="<?= isset($coursemetaDetails) ? $coursemetaDetails[0]->duration : '' ;?>" >
                                        <span id="errorduration" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_status">Annual Fees<span class="text-danger">*</span></label>
                                        <input type="text" name="annual" id="annual" value="<?=  isset($coursemetaDetails) ? $coursemetaDetails[0]->annual_fees : '' ; ?>" class="form-control">
                                         <span id="errormanual" style="color: red;"></span>
                                    </div>
                                    <?php //echo $coursemetaDetails[0]->international_fees;die; ?>
                                     <div class="form-group">
                                        <label for="course_status">International Fees<span class="text-danger">*</span></label>
                                        <input type="text" name="international" id="international" value="<?= isset($coursemetaDetails) ? $coursemetaDetails[0]->international_fees : '' ?>" class="form-control">
                                        <span id="errorinternational" style="color: red;"></span>
                                    </div>
                                     <div class="form-group">
                                        <label for="course_status">Eligibility<span class="text-danger">*</span></label>
                                        <textarea name="eligibility" id="eligibility" class="form-control"><?= isset($coursemetaDetails) ? $coursemetaDetails[0]->eligibility : '' ?></textarea>
                                        <span id="erroreligibility" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <?=
                                            $sts = '';
                                            if(isset($coursemetaDetails)){
                                                if($coursemetaDetails[0]->status == 1){
                                                    $sts = 'checked';
                                                }
                                                //echo $sts;die;
                                            }
                                        ?>
                                        <label for="course_status">Status</label>
                                        <input type="checkbox" name="college_status" <?= $sts ?> id="college_status" value="1" class="form-control">
                                    </div>
                                    <div class="form-action">
                                        <button type="submit" class="btn btn-primary" name="saveCourseBtn" id="saveCourseBtn">Submit</button>
                                        <button type="reset" class="btn btn-danger" name="cancelCourseBtn" id="cancelCourseBtn">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <!-- end: DYNAMIC TABLE -->
    </div>
</div>

</div>

<?php
    $msg = $this->input->get('msg');
    switch ($msg) {
        case "S":
            $m = "Add sample profile Successfully...!!!";
            $t = "success";
            break;
        case "U":
            $m = "Update Successfully...!!!";
            $t = "success";
            break;
        case "D":
            $m = "Record Delete Successfully...!!!";
            $t = "success";
            break;
        case "M":
            $m = "Email Send Successfully...!!!";
            $t = "success";
            break;
        case "A":
            $m = "Email or Phone alredy exist!!!";
            $t = "error";
            break;
        case "E":
            $m = "Something went wrong, Please try again!!!";
            $t = "error";
            break;
        default:
            $m = 0;
            break;
    }
?>

<script>
    $(document).ready(function () {
        <?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
        <?php endif; ?>

        $('#saveCourseBtn').click(function(){
           /* if($('#meta_title').val() == ''){
                $('#errormetatitle').text('Enter Meta title').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#meta_keyword').val() == ''){
                $('#errormetakeyword').text('Enter Meta keyword').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#meta_description').val() == ''){
                $('#errormetadesc').text('Enter Meta description').fadeIn('slow').fadeOut(5000);
                return false;
            }else*/
             if($('#stream').val() == ''){
                $('#errorstream').text('Enter Stream').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#college').val() == ''){
                $('#errorcollege').text('Enter College').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#Course').val() == ''){
                $('#errorcourse').text('Enter Course').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#duration').val() == ''){
                $('#errorduration').text('Enter Duration').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#annual').val() == ''){
                $('#errormanual').text('Enter Annual Fees').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#international').val() == ''){
                $('#errorinternational').text('Enter International Fees').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#eligibility').val() == ''){
                $('#erroreligibility').text('Enter Eligibility').fadeIn('slow').fadeOut(5000);
                return false;
            }else{
                return true;
            }
            return false;
        });
    });
</script>


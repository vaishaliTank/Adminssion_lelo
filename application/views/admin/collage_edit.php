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
                    <h1 class="mainTitle">College Add</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            College Add
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/course/<?= isset($collegeDetails) ? 'updateCollege' : 'saveCollege' ?>"> 
                                <input type="hidden" name="college_id" id="college_id" value="<?= isset($collegeDetails) ? $collegeDetails->college_id : '' ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="college_name">College Name<span class="text-danger">*</span></label>
                                        <input type="text" name="college_name" id="college_name" class="form-control" placeholder="Enter College Name">
                                        <span id="errorCollegeName" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="address1">Address1<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="address1" id="address1" value="<?= isset($courseDetails) ? $courseDetails->courseid : '' ;?>" placeholder="Enter Address 1">
                                        <span id="errorAddress1" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="address2">Address2</label>
                                        <input type="text" class="form-control" name="address2" id="address2" value="<?= isset($courseDetails) ? $courseDetails->courseid : '' ;?>" placeholder="Enter Address 2">
                                        <span id="errorAddress2" style="color: red;"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="city">City<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="city" id="city" value="<?= isset($courseDetails) ? $courseDetails->course_name : '' ;?>" placeholder="Enter City">
                                        <span id="errorCity" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            $sts = 0;
                                            if(isset($courseDetails)){
                                                if($courseDetails->status == 1){
                                                    $sts = 1;
                                                }
                                            }
                                        ?>
                                        <label for="course_status">College Status</label>
                                        <input type="checkbox" name="college_status" <?= ($sts == 1) ? 'checked' : '' ?> id="college_status" value="1" class="form-control">
                                    </div>
                                    <div class="form-action">
                                        <button type="submit" class="btn btn-primary" name="saveCollegeBtn" id="saveCollegeBtn">Submit</button>
                                        <button type="reset" class="btn btn-danger" name="cancelCollegeBtn" id="cancelCollegeBtn">Cancel</button>
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
            if($('#stream_id').val() == ''){
                $('#errorStreamName').text('Enter Stream Name').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#course_id').val() == ''){
                $('#errorCourseId').text('Enter Course Id').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#course_name').val() == ''){
                $('#errorCourseName').text('Enter Course Name').fadeIn('slow').fadeOut(5000);
                return false;
            }else{
                return true;
            }
            return false;
        });
    });
</script>


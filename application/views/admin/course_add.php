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
                    <h1 class="mainTitle">Course Add</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            Course Add
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/course/<?= isset($courseDetails) ? 'updateCourse' : 'saveCourse' ?>"> 
                                <input type="hidden" name="cid" id="cid" value="<?= isset($courseDetails) ? $courseDetails->course_id : '' ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stream_id">Stream Name<span class="text-danger">*</span></label>
                                        <select name="stream_id" id="stream_id" class="form-control">
                                            <option value="">Select Stream</option>
                                            <?php
                                                if(!empty($streams)){
                                                    foreach ($streams as $stream) {
                                                        if(isset($courseDetails)){
                                                            if($courseDetails->stream_id == $stream->stream_id){
                                                                ?>
                                                                    <option selected="selected" value="<?= $stream->stream_id ?>"><?= $stream->stream_name ?></option>
                                                                <?php 
                                                            }else{
                                                                ?>
                                                                    <option value="<?= $stream->stream_id ?>"><?= $stream->stream_name ?></option>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?>
                                                                <option value="<?= $stream->stream_id ?>"><?= $stream->stream_name ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <span id="errorStreamName" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_id">Course ID<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="course_id" id="course_id" value="<?= isset($courseDetails) ? $courseDetails->courseid : '' ;?>" placeholder="Enter Course Id">
                                        <span id="errorCourseId" style="color: red;"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="course_name">Course Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="course_name" id="course_name" value="<?= isset($courseDetails) ? $courseDetails->course_name : '' ;?>" placeholder="Enter Course Name">
                                        <span id="errorCourseName" style="color: red;"></span>
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
                                        <label for="course_status">Stream Status</label>
                                        <input type="checkbox" name="course_status" <?= ($sts == 1) ? 'checked' : '' ?> id="course_status" value="1" class="form-control">
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


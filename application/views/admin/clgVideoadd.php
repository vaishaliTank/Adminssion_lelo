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
                    <h1 class="mainTitle">College Video Add  </h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            College Video Add 
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/Collage_Video/<?= isset($VideoDetails) ? 'updateCollage_video' : 'saveCollage_video' ?>"> 
                                <input type="hidden" name="video_id" id="video_id" value="<?= isset($VideoDetails) ? $VideoDetails->video_id : '' ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="college_name">College Name<span class="text-danger">*</span></label>
                                        <select name="collage">
                                            <?php foreach($collage as $cl){
                                                $str = '';
                                                if(!empty($VideoDetails)){
                                                    if($VideoDetails->college_id == $cl->college_id){
                                                        $str = 'selected';
                                                    }
                                                }
                                             ?>
                                                <option <?php  echo $str; ?> value="<?php echo $cl->college_id;?>"><?php echo $cl->college_name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="videoname">Video Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="videoname" id="videoname" value="<?= isset($VideoDetails) ? $VideoDetails->video_name : '' ;?>" placeholder="Video Name">
                                        <span id="errorvideoname" style="color: red;"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="videolink">Video Link<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="videolink" id="videolink" value="<?= isset($VideoDetails) ? $VideoDetails->video_link : '' ;?>" placeholder="Video Link">
                                        <span id="errorvideolink" style="color: red;"></span>
                                    </div>

                                    
                                    
                                    <div class="form-group">
                                        <?php
                                            $sts = 0;
                                            if(isset($VideoDetails)){
                                                if($VideoDetails->status == 1){
                                                    $sts = 1;
                                                }
                                            }
                                        ?>
                                        <label for="course_status">Status</label>
                                        <input type="checkbox" name="status" <?= ($sts == 1) ? 'checked' : '' ?> id="status" value="1" class="form-control">
                                    </div>
                                    <div class="form-action">
                                        <button type="submit" class="btn btn-primary" name="saveClgVBtn" id="saveClgVBtn">Submit</button>
                                        <button type="reset" class="btn btn-danger" name="cancelTestBtn" id="cancelTestBtn">Cancel</button>
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

        $('#saveClgVBtn').click(function(){
            
            if($('#videoname').val() == ''){
                $('#errorvideoname').text('Enter Video Name').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#videolink').val() == ''){
                $('#errorvideolink').text('Enter Video Link').fadeIn('slow').fadeOut(5000);
                return false;
            }else{
                return true;
            }
            return false;
        });
    });
</script>


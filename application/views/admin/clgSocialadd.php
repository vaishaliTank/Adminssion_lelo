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
                    <h1 class="mainTitle">College Social Add</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            College Social Add
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/Collage_Social/<?= isset($SocialDetails) ? 'updateCollage_social' : 'saveCollage_social' ?>"> 
                                <input type="hidden" name="social_id" id="social_id" value="<?= isset($SocialDetails) ? $SocialDetails->social_id : '' ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="college_name">College Name<span class="text-danger">*</span></label>
                                        <select name="collage">
                                            <?php foreach($collage as $cl){
                                                $str = '';
                                                if(!empty($SocialDetails)){
                                                    if($SocialDetails->college_id == $cl->college_id){
                                                        $str = 'selected';
                                                    }
                                                }
                                             ?>
                                                <option <?php  echo $str; ?> value="<?php echo $cl->college_id;?>"><?php echo $cl->college_name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="clgemail">College email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="clgemail" id="clgemail" value="<?= isset($SocialDetails) ? $SocialDetails->college_email : '' ;?>" placeholder="First Name">
                                        <span id="errorclgemail" style="color: red;"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="clgphone">College Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="clgphone" id="clgphone" value="<?= isset($SocialDetails) ? $SocialDetails->college_phone : '' ;?>" placeholder="Enter Phone">
                                        <span id="errorvideoname" style="color: red;"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="fblink">Facebook Link<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="fblink" id="fblink" value="<?= isset($SocialDetails) ? $SocialDetails->facebooklink : '' ;?>" placeholder="Enter Facebook Link">
                                        <span id="errorfblink" style="color: red;"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="twlink">Twitter Link<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="twlink" id="twlink" value="<?= isset($SocialDetails) ? $SocialDetails->twitterlink : '' ;?>" placeholder="Enter Twitter Link">
                                        <span id="errortwlink" style="color: red;"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="inlink">Instagram Link<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="inlink" id="inlink" value="<?= isset($SocialDetails) ? $SocialDetails->instagramlink : '' ;?>" placeholder="Enter Instagram Link">
                                        <span id="errorinlink" style="color: red;"></span>
                                    </div>

                                     <div class="form-group">
                                        <label for="linlink">Likedin Link<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="linlink" id="linlink" value="<?= isset($SocialDetails) ? $SocialDetails->linkedinlink : '' ;?>" placeholder="Last Name">
                                        <span id="errorlinlink" style="color: red;"></span>
                                    </div>

                                     <div class="input medium" id="catname_label">
                                        <label for="input1">College Logo</label>
                                        <input type="file" id="college_logo" name="college_logo">
                                        <input type="text" value="<?= isset($SocialDetails) ? $SocialDetails->college_logo : '' ;?>" name="old_logo" style="border:none;">
                                    </div>
                                    
                                    
                                    
                                    <div class="form-action">
                                        <button type="submit" class="btn btn-primary" name="saveClgSBtn" id="saveClgSBtn">Submit</button>
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


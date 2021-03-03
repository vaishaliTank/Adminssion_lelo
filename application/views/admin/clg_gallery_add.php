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
                    <h1 class="mainTitle">College Gallery Add </h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            College Gallery Add 
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/Collage_Gallery/<?= isset($SocialDetails) ? 'updateCollage_social' : 'saveCollage_gallery' ?>"> 
                                <input type="hidden" name="social_id" id="social_id" value="<?= isset($SocialDetails) ? $SocialDetails->social_id : '' ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="college_name">College Name<span class="text-danger">*</span></label>
                                        <select name="collage" id="collage">
                                            
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
                                        <span id="errorclgname" style="color: red;"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image Type<span class="text-danger">*</span></label>
                                        <select name="image" id="image">
                                            
                                            <?php foreach($image as $im){
                                                $str = '';
                                                if(!empty($SocialDetails)){
                                                    if($SocialDetails->college_id == $cl->college_id){
                                                        $str = 'selected';
                                                    }
                                                }
                                             ?>
                                                <option <?php  echo $str; ?> value="<?php echo $im->image_type_id;?>"><?php echo $im->image_type_name;?></option>
                                            <?php }?>
                                        </select>
                                        <span id="errorclgimgtype" style="color: red;"></span>
                                    </div>

                                    
                                     <div class="input medium" id="catname_label">
                                        <label for="input1">Image<span class="star">*</span></label>
                                        <input type="file" id="image_name" value="" size="54" name="image_name[]" class="NFText" >
                                        <span id="errorimage_name" style="color: red;"></span>
                                    </div>
                                    <div class="input medium" id="catname_label">
                                        <label for="input1" class="input1image">&nbsp;</label>
                                    </div>
                                    <div class="input medium mmcbox">
                                        <a href="javascript:void(0);"  class="addmmc btn btn-primary btn-xs"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More</a>
                                    </div>
                                    <div class="form-action">
                                        <button type="submit" class="btn btn-primary" name="saveClgGBtn" id="saveClgGBtn">Submit</button>
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

        $('#saveClgGBtn').click(function(){
            
            if($('#collage').val() == ''){
                $('#errorclgname').text('Select Collage').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#image').val() == ''){
                $('#errorclgimgtype').text('Select Collage Type').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#image_name').val() == ''){
                $('#errorimage_name').text('Select Image').fadeIn('slow').fadeOut(5000);
                return false;
            }else{
                return true;
            }
            return false;
        });
    });


$(document).ready(function() {
    // addd another ip input box for all 
    $('.addmmc').click(function() {         
        //alert("sd");
        $('.input1image').append('<input type="file" name="image_name[]" class="NFText">');
        });
         $('.mmcbox').on('click','.removemmc',function() {
            $(this).parent().remove();
         });
});
</script>


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
                    <h1 class="mainTitle">Event Gallery Add  </h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            Event Gallery Add 
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/Collage_EventGallery/<?= isset($eventGDetails) ? 'updateCollageE_gallery' : 'saveCollageE_gallery' ?>"> 
                                <input type="hidden" name="event_id" id="event_id" value="<?= isset($eventGDetails) ? $eventGDetails->id : '' ?>">
                                <div class="col-md-12">
                                    

                                    
                                    
                                     <div class="input medium" id="catname_label">
                                        <label for="input1">Image<span class="star">*</span></label>
                                        <input type="file" id="image_name" value="" size="54" name="image_name" class="NFText" >
                                        <span id="errorimagname" style="color: red;"></span>
                                    </div>
                                    
                                    <?php if(!empty($eventGDetails)) { ?>
                                        <img src="<?php echo base_url().'/upload/gallery/'.$eventGDetails->gallery_image;?>" height="150" width="150">
                                        <input type="hidden" name="old_img" value="<?php echo $eventGDetails->gallery_image?>">
                                    <?php }?>
                                    
                                    <div class="form-action">
                                        <button type="submit" class="btn btn-primary" name="saveClgGEBtn" id="saveClgGEBtn">Submit</button>
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

        $('#saveClgGEBtn').click(function(){
            
            if($('#image_name').val() == ''){
                $('#errorimagname').text('Select Image').fadeIn('slow').fadeOut(5000);
                return false;
            }else{
                return true;
            }
            return false;
        });
    });



</script>


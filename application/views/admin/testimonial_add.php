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
                    <h1 class="mainTitle">Testimonial  Add</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            Testimonial Add
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/testimonial/<?= isset($testDetails) ? 'updateTestimonial' : 'saveTestimonial' ?>"> 
                                <input type="hidden" name="testiminial_id" id="testiminial_id" value="<?= isset($testDetails) ? $testDetails->id : '' ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="college_name">Customer  Name<span class="text-danger">*</span></label>
                                        <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter Customer Name" value="<?= isset($testDetails) ? $testDetails->customer_name : '' ;?>">
                                        <span id="errorcustomer_name" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="texttest">Testimonial Text<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="texttest" id="texttest" value="<?= isset($testDetails) ? $testDetails->message_text : '' ;?>" placeholder="Testimonial Text">
                                        <span id="errorTesttext" style="color: red;"></span>
                                    </div>
                                    
                                    <div class="input medium" id="catname_label">
                                        <label for="input1">College Image</label>
                                        <input type="file" id="college_image" name="college_image">
                                        <input type="text" value="<?= isset($testDetails) ? $testDetails->customer_image : '' ;?>" name="old_image" style="border:none;">
                                    </div>

                                    
                                    <div class="form-group">
                                        <?php
                                            $sts = 0;
                                            if(isset($testDetails)){
                                                if($testDetails->status == 1){
                                                    $sts = 1;
                                                }
                                            }
                                        ?>
                                        <label for="course_status">Status</label>
                                        <input type="checkbox" name="status" <?= ($sts == 1) ? 'checked' : '' ?> id="status" value="1" class="form-control">
                                    </div>
                                    <div class="form-action">
                                        <button type="submit" class="btn btn-primary" name="saveTestBtn" id="saveTestBtn">Submit</button>
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

        $('#saveTestBtn').click(function(){
            
            if($('#customer_name').val() == ''){
                $('#errorcustomer_name').text('Enter Customer Name').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#texttest').val() == ''){
                $('#errorTesttext').text('Enter Testimonial Text').fadeIn('slow').fadeOut(5000);
                return false;
            
            }else{
                return true;
            }
            return false;
        });
    });
</script>


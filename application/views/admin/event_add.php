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
                    <h1 class="mainTitle">Event Data</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            Event Add
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/Event/<?= isset($eventData) ? 'updateEvent' : 'saveEvent' ?>"> 
                                <input type="hidden" name="id" id="id" value="<?= isset($eventData) ? $eventData[0]->id : '' ?>">
                                <?php $disable=''; if(!empty($coursemetaDetails[0]->id)){
                                    $disable = 'readonly';
                                } ?>
                                <div class="col-md-12">
                                    
                                    <div class="form-group">
                                        <label for="course_name">Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?= isset($eventData) ? $eventData[0]->title : '' ;?>" >
                                        <span id="errortitle" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_status">URL (Please enter complete url)</label>
                                        <input type="text" name="url" id="url" value="<?=  isset($eventData) ? $eventData[0]->link_url : '' ; ?>" class="form-control">
                                         <span id="errormanual" style="color: red;"></span>
                                    </div>
                                    <?php //echo $coursemetaDetails[0]->international_fees;die; ?>
                                     <div class="form-group">
                                        <label for="course_status">Event Start Date<span class="text-danger">*</span></label>
                                        <input type="text" name="sdate" id="sdate" value="<?= isset($eventData) ? $eventData[0]->start_date : '' ?>" class="form-control">
                                        <span id="errorstart" style="color: red;"></span>
                                    </div>
                                     <div class="form-group">
                                        <label for="course_status">Event End Date<span class="text-danger">*</span></label>
                                        <input type="text" name="edate" id="edate" value="<?= isset($eventData) ? $eventData[0]->end_date : '' ?>" class="form-control">
                                        <span id="errorend" style="color: red;"></span>
                                    </div>

                                     <div class="form-group">
                                        <label for="course_status">Event Time (please select 0:00 to 0:00 if you want to make the event time as All Day)</label>
                                         <select name="start_time" id="start_time">
                                        <?php
                                            for($i=0; $i<=24; $i++){
                                                $sel = '';
                                                if($i.':00' == $eventData[0]->start_time){
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value="<?php echo $i.':00';?>" <?= $sel ?>><?php echo $i.':00';?></option>
                                                <?php }
                                            ?>
                                        </select><span class="toText">to</span>
                                        <select name="end_time" id="end_time">
                                            <?php
                                                for($j=0; $j<=24; $j++){
                                                    $sel1 = '';
                                                    if($j.':00' == $eventData[0]->end_time){
                                                    $sel1 = 'selected';
                                                }
                                                ?>
                                                <option value="<?php echo $j.':00';?>" <?= $sel1 ?>><?php echo $j.':00';?></option>
                                                <?php }
                                            ?>
                                        </select>
                                        <span id="erroreligibility" style="color: red;"></span>
                                    </div>
                                     <div class="form-group">
                                        <label for="course_status">Content</label>
                                        <textarea name="content" id="content" class="form-control"><?= isset($eventData) ? $eventData[0]->content : '' ?></textarea>
                                        <span id="erroreligibility" style="color: red;"></span>
                                    </div>

                                    <div class="input medium" id="image_label">
                                        <label class="col-sm-3 control-label" for="file">Upload Event Image<span class="star">*</span> </label>
                                        <div class="col-sm-4"><input type="file" name="event_image" id="event_image" event_image="image" class="form-control"></div>
                                         <span id="errorevent_image" style="color: red;"></span>
                                    </div> 
                                    <div class="clearfix MT20"></div>
                                    <div class="input medium" id="image_label">
                                        <label class="col-sm-3 control-label" for="file">Upload Event Gallery<span class="star">*</span> </label>
                                        <div class="col-sm-4"><input type="file" id="galleryimage" name="image_name[]" multiple class="form-control"></div>
                                         <span id="errorgalleryimage" style="color: red;"></span>
                                    </div>
                                    <div class="clearfix MT20"></div>
                                     <div class="clearfix MT20"></div>  
                                    <div class="form-group">
                                        <?=
                                            $sts = '';
                                            if(isset($eventData)){
                                                if($eventData[0]->status == 1){
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
          
            if($('#title').val() == ''){
                $('#errortitle').text('Enter Title').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#sdate').val() == ''){
                $('#errorstart').text('Enter Start Date').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#edate').val() == ''){
                $('#errorend').text('Enter End Date').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#event_image').val() == ''){
                $('#errorevent_image').text('Enter Event Image').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#galleryimage').val() == ''){
                $('#errorgalleryimage').text('Enter Gallery Image').fadeIn('slow').fadeOut(5000);
                return false;
            }else{
                return true;
            }
            return false;
        });
    });
</script>


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
                    <h1 class="mainTitle">Home Banner Data</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            Home Banner Add
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/Banner/<?= isset($eventData) ? 'updateBanner' : 'saveBanner' ?>"> 
                                <input type="hidden" name="id" id="id" value="<?= isset($eventData) ? $eventData[0]->id : '' ?>">
                                
                                <div class="col-md-12">
                                    
                                    <div class="form-group">
                                        <label for="course_name">Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?= isset($eventData) ? $eventData[0]->title : '' ;?>" >
                                        <span id="errortitle" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_status">Link</label>
                                        <input type="text" name="url" id="url" value="<?=  isset($eventData) ? $eventData[0]->url : '' ; ?>" class="form-control">
                                         <span id="errorlink" style="color: red;"></span>
                                    </div>
                                    <?php $new=$self=$top='';
                                    if(isset($eventData)){
                                            if($eventData[0]->target == '_self'){
                                            $self = 'selected';
                                        }
                                         else if($eventData[0]->target == '_blank'){
                                            $new = 'selected';
                                        }
                                         else if($eventData[0]->target == '_top'){
                                            $top = 'selected';
                                        }
                                    }
                                    
                                     ?>
                                     <div class="input medium" id="target_label">
                                        <label for="input1">Target Window</label>
                                        <select name="target">
                                            <option value="_blank"<?= $new; ?>>New</option>
                                            <option value="_self" <?= $self; ?>>Self</option>
                                            <option value="_top" <?= $top; ?>>Top</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_name">Sort Order<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="sort" id="sort" value="<?= isset($eventData) ? $eventData[0]->sort_order : '' ;?>" >
                                        <span id="errorsort" style="color: red;"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <?=
                                            $sts = '';
                                            $style1 = '';
                                            if(isset($eventData)){
                                                if($eventData[0]->DisplayTime == 'D'){
                                                    $sts = 'checked';
                                                    $style1='display : none';
                                                }
                                                //echo $sts;die;
                                            }else{
                                                $style1='display : none';
                                            }
                                        ?>
                                        
                                          
                                        <label for="course_status">Banner Display Time<span class="text-danger">*</span>: (Please select Specified Time if you want to add the banner for specific dates.)</label>
                                        <input type="checkbox" name="status" <?= $sts ?> id="status" value="D" class="form-control" >
                                    </div>
                                    <div id="time1" style="<?php echo $style1; ?>">
                                        <label>Display Banner:</label>
                                        <div class="form-group">
                                        <label for="course_status">From Date<span class="text-danger">*</span></label>
                                        <input type="text" name="sdate" id="sdate" value="<?= isset($eventData) ? $eventData[0]->start_date : '' ?>" class="form-control">
                                        <span id="errorstart" style="color: red;"></span>
                                    </div>
                                     <div class="form-group">
                                        <label for="course_status">Top Date<span class="text-danger">*</span></label>
                                        <input type="text" name="edate" id="edate" value="<?= isset($eventData) ? $eventData[0]->end_date : '' ?>" class="form-control">
                                        <span id="errorend" style="color: red;"></span>
                                    </div>
                                    <?php $timeZoneArr = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
                                     <div class="form-group">
                                        <label for="course_status">Event Time (please select 0:00 to 0:00 if you want to make the event time as All Day)</label>
                                         <select name="timezone" id="start_time">
                                         <option value="">Select Time Zone</option>
                                        <?php foreach($timeZoneArr as $key=>$zone){?>
                                            <option value="<?php echo $key; ?>"><?php echo $zone; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div style="color:red;">Note: The banner will expire at Midnight of the selected expiration date. </div>

                                        <span id="erroreligibility" style="color: red;"></span>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file">Upload Image </label>
                                        <input type="file" name="event_image" id="event_image" event_image="image" class="form-control">
                                        <input type="hidden" name="old_image" value="<?= isset($eventData) ? $eventData[0]->image : ''; ?>">
                                         <span id="errorevent_image" style="color: red;"></span>
                                    </div> 
                                     
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
                                         <div class="clearfix MT20"></div>
                                        
                                        <label for="course_status">Publish</label>
                                        <input type="checkbox" name="publish" <?= $sts ?> id="college_status" value="1" class="form-control">
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
            }else if($('#sort').val() == ''){
                $('#errorsort').text('Enter Start Date').fadeIn('slow').fadeOut(5000);
                return false;
            }else{
                return true;
            }
            return false;
        });

         $('#status').change(function() {
           if($(this).is(":checked")) {
              alert('htg');
           }
           //'unchecked' event code
        });

         $('#status').on('change',function(){
                alert('hii');
         });
    });

   
</script>


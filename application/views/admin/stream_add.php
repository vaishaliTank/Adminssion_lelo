<style>
    .panel-light-primary {
        border: 1px solid #007aff !important;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
<div class="main-content">
    <div class="wrap-content container" id="container">
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">Stream Add</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            Stream Add
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/stream/<?= isset($streamDetails) ? 'updateStream' : 'saveStream' ?>"> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stream_name">Stream Name<span class="text-danger">*</span></label>
                                        <input type="text" name="stream_name" id="stream_name" value="<?= isset($streamDetails) ? $streamDetails->stream_name : '' ?>" class="form-control" placeholder="Enter Stream Name">
                                        <input type="hidden" name="stream_id" id="stream_id" value="<?= isset($streamDetails) ? $streamDetails->stream_id : '' ?>">
                                        <span id="errorStreamName" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="stream_desc">Stream Desc</label>
                                        <textarea rows="5" class="form-control" name="stream_desc" id="stream_desc" placeholder="Stream Desc"><?= isset($streamDetails) ? $streamDetails->stream_desc : '' ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="stream_college_desc">Stream College Desc</label>
                                        <textarea rows="5" class="form-control" name="stream_college_desc" id="stream_college_desc"  placeholder="Stream College Desc"><?= isset($streamDetails) ? $streamDetails->stream_college_desc : '' ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="stream_course_desc">Stream Course Desc</label>
                                        <textarea rows="5" class="form-control" name="stream_course_desc" id="stream_course_desc"  placeholder="Stream Course Desc"><?= isset($streamDetails) ? $streamDetails->stream_course_desc : '' ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="stream_image">Stream Image<span class="text-danger">*</span></label>
                                        <?php
                                            if(isset($streamDetails)){
                                                if($streamDetails->stream_img != ''){
                                                    ?>
                                                        <img src="<?= base_url() ?>upload/<?= $streamDetails->stream_img ?>" style="width: 100px;height: auto;">
                                                    <?php
                                                }    
                                            }
                                        ?>
                                        <input type="file" name="stream_image" id="stream_image" class="form-control">
                                        <span id="errorStreamImage" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            $sts = 0;
                                            if(isset($streamDetails)){
                                                if($streamDetails->status == 1){
                                                    $sts = 1;
                                                }
                                            }
                                        ?>
                                        <label for="stream_status">Stream Status</label>
                                        <input type="checkbox" name="stream_status" <?= ($sts == 1) ? 'checked' : '' ?> id="stream_status" value="1" class="form-control">
                                    </div>
                                    <div class="form-action">
                                        <button type="submit" class="btn btn-primary" name="saveStreamBtn" id="saveStreamBtn">Submit</button>
                                        <button type="reset" class="btn btn-danger" name="cancelStreamBtn" id="cancelStreamBtn">Cancel</button>
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

        $('#saveStreamBtn').click(function(){
            if($('#stream_name').val() == ''){
                $('#errorStreamName').text('Enter Stream Name').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#stream_image').val() == ''){
                $('#errorStreamImage').text('Choose Stream Image').fadeIn('slow').fadeOut(5000);
                return false;
            }else{
                return true;
            }
            return false;
        });
    });
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#stream_desc' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#stream_college_desc' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#stream_course_desc' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>




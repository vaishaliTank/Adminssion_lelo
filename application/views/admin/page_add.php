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
                    <h1 class="mainTitle">Page Data</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-0 col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            Page Add
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <form name="streamFrm" method="POST" enctype="multipart/form-data" id="streamFrm" action="<?= base_url() ?>admin/Page/<?= isset($pageData) ? 'updatePage' : 'savePage' ?>"> 
                                <input type="hidden" name="id" id="id" value="<?= isset($pageData) ? $pageData[0]->id : '' ?>">
                               
                                <div class="col-md-12">
                                    
                                    <div class="form-group">
                                        <label for="course_name">Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?= isset($pageData) ? $pageData[0]->title : '' ;?>" >
                                        <span id="errortitle" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_status">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" value="<?=  isset($pageData) ? $pageData[0]->name : '' ; ?>" class="form-control">
                                         <span id="errorname" style="color: red;"></span>
                                    </div>
                                   

                                     
                                     <div class="form-group">
                                        <label for="course_status">Content</label>
                                        <textarea name="content" id="content" class="form-control"><?= isset($pageData) ? $pageData[0]->content : '' ?></textarea>
                                        <span id="errorcontent" style="color: red;"></span>
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
            }else if($('#name').val() == ''){
                $('#errorname').text('Enter Name').fadeIn('slow').fadeOut(5000);
                return false;
            }else if($('#content').val() == ''){
                $('#errorcontent').text('Enter Content').fadeIn('slow').fadeOut(5000);
                return false;
            }else{
                return true;
            }
            return false;
        });
    });
</script>


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
                    <h1 class="mainTitle">College Social Manager</h1>
                    <?= $this->session->flashdata('msg') ?>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <form name="" method="POST" id="categoryFrm" action=""> 
                    <div class="col-md-offset-0 col-md-12">
                        <p id="errortxt" style="color: red;"></p>
                        <p id="successtxt" style="color: green;"></p>
                        <a href="<?= base_url() ?>admin/Collage_Social/collegesocial_add" class="btn btn-primary margin-bottom-10 btn-wide"><i class="fa fa-plus"></i> Add New</a>
                        <div class="panel panel-light-primary" id="panel5">
                            <div class="panel-heading">
                                College Social List 
                            </div>
                            <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>College name</th>
                                                <th>College Email</th>
                                                <th>College Phone</th>
                                                <th>Facebook Link</th>
                                                <th>Twiltter Link</th>
                                                <th>Instagram Link</th>
                                                <!-- <th>Google Plus Link</th> -->
                                                <th>Linkden Link</th>
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($sociallist)){
                                                    $sr=0;
                                                    foreach($sociallist as $social){
                                                        $sr++;
                                                        ?>
                                                            <tr>
                                                                <td><?= $sr; ?></td>
                                                                <td><?= $social->college_name ?></td>
                                                                <td><?= $social->college_email ?></td>
                                                                <td><?= $social->college_phone ?></td>
                                                                <td><?= $social->facebooklink ?></td>
                                                                <td><?= $social->twitterlink ?></td>
                                                                <td><?= $social->instagramlink ?></td>
                                                                <td><?= $social->linkedinlink ?></td>
                                                                <!-- <td><?= $social->college_email ?></td> -->
                                                                
                                                                <td>
                                                                    <a class="btn btn-info btn-xs" href="<?= base_url() ?>admin/Collage_Social/collegeS_edit/<?= $social->social_id;?>">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                    <a class="btn btn-danger btn-xs ask" href="<?= base_url() ?>admin/Collage_Social/delete/<?= $social->social_id ?>">
                                                                        <i class="fa fa-close"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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

    });
    
    function featuredStream(str, sid){
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/stream/featured",
            data: {'featured': str,'stream_id': sid},
            dataType: "Json",
            success: function(data){
                if(data.flag == 0){
                    $("#errortxt").text(data.msg).fadeIn('slow').fadeOut(5000);
                    window.setTimeout('location.reload()', 5000);
                }else if(data.flag == 1){
                    $("#successtxt").text(data.msg).fadeIn('slow').fadeOut(5000); 
                    window.setTimeout('location.reload()', 1000);
                }
            }
       });
    }
    
    function courseStatus(sts, cid){
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/course/status",
            data: {'status': sts,'course_id': cid},
            dataType: "Json",
            success: function(data){
                if(data.flag == 0){
                    $("#errortxt").text(data.msg).fadeIn('slow').fadeOut(5000);
                    window.setTimeout('location.reload()', 5000);
                }else if(data.flag == 1){
                    $("#successtxt").text(data.msg).fadeIn('slow').fadeOut(5000); 
                    window.setTimeout('location.reload()', 1000);
                }
            }
       });
    }



</script>




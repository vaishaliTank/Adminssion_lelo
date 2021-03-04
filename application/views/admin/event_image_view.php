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
                    <h1 class="mainTitle">College Gallery Manager</h1>
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
                        
                        <div class="panel panel-light-primary" id="panel5">
                            <div class="panel-heading">
                                College Gallery List 
                            </div>
                            <div id="popwsuccess" class="alert-success"></div>
                            <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                                <div class="content image_view">
                                    <table>
                                        
                                        <tbody>
                                        <tr>
                                            
                                            <?php
                                                if(!empty($List)){
                                                    $sr=1;
                                                    foreach($List as $gallery){
                                                        ?>
                                                        <td style="padding-left:10px; font-weight: bold;"><img src="<?php echo base_url().'upload/event/'.$gallery->gallery_image;?>" width="100" height="100" /><br>
                                                        <a href="<?php echo base_url().'admin/Event/ImageDelete/'.$gallery->event_gallery_id.'/'.$gallery->event_id; ?>">Delete</a><br/>
                                                        </td>
                                                        <?php 
                                                        if($sr % 6 == 0){ ?>
                                                        </tr>
                                                        <tr>
                                                    <?php }
                                                    $sr++;

                                                    }
                                                }
                                            ?>
                                        </tr>
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
    
    
    

    function setfetured(cid,imd){
        alert("dhcbsdc");
    if($("#image_featured_"+imd).prop('checked') == true){  
        var image_featured_vl = $("#image_featured_"+imd).val();
    }else{
        var image_featured_vl = 0;
    } 
    alert(image_featured_vl);  
    $.ajax({
        type: "POST",
        url: base_url+"Collage_Gallery/setFeatured",
        data:"featured=featured&cid="+cid+"&image_id="+imd+"&image_featured_vl="+image_featured_vl,
        //data: $('#frmconsult').serialize(),
        contentType: "application/x-www-form-urlencoded",
        success: function (data) {
            if (data != 'Success') {
                $("#popwsuccess").html(data);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}

/*function setfeturedhome(cid,imd){   
    if($("#home_image_featured_"+imd).prop('checked') == true){ 
        var image_featured_vl = $("#home_image_featured_"+imd).val();
    }else{
        var image_featured_vl = 0;
    }   
    $.ajax({
        type: "POST",
        url: base_url+"Collage_Gallery/setHomeFeatured";
        data:"homefeatured=homefeatured&cid="+cid+"&image_id="+imd+"&image_featured_vl="+image_featured_vl,
        //data: $('#frmconsult').serialize(),
        contentType: "application/x-www-form-urlencoded",
        success: function (data) {
            if (data != 'Success') {
                $("#popwsuccess").html(data);
            }/*else{
                $("#popwsuccess").html(data);
            } 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}*/

</script>




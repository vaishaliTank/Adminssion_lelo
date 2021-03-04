
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
                    <h1 class="mainTitle">Page Manager </h1>
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
                        <a href="<?= base_url() ?>admin/Page/page_add" class="btn btn-primary margin-bottom-10 btn-wide"><i class="fa fa-plus"></i> Add New</a> 
                        <div class="panel panel-light-primary" id="panel5">
                            <div class="panel-heading">
                                 Page List    
                            </div>
                            <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Title</th>
                                                <th>Name</th>
                                                <th>Add Date</th>
                                                <th>View Content</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($List)){
                                                    $sr=0;
                                                    foreach($List as $row){
                                                         if (preg_match("~^(?:f|ht)tps?://~i", $row->link_url)){
                                                            $pageUrl = $row->link_url;
                                                            $viewUrl = 1;
                                                        } else {
                                                            $pageUrl = '/page/'.$row->link_url.'.html';
                                                            $viewUrl = 2;
                                                        }
                                                        $sr++;
                                                        ?>
                                                            <tr>
                                                                <td><?= $sr; ?></td>
                                                                <td><?= $row->title; ?></td>
                                                                <td><?= $row->name; ?></td>
                                                                <!-- <td><?= $pageUrl; ?></td> -->
                                                                <!-- <td><?= $row->stream; ?></td>
                                                                <td><?= $row->email; ?></td>
                                                                <td><?= $row->phone; ?></td> -->

                                                                 <td><?= $newDate = date("d M Y  H:i", strtotime($row->create_date));
                                                               ?></td>
                                                                <td><a class="btn btn-default btn-xs"  id="view" href="javascript:void(0);" onclick="openModel();"></i>View</a>
                                                                <input type="hidden" id="con" value="<?php echo $row->id; ?>">
                                                                </td>
                                                                <td><?php if($row->position == 'f'){ echo "Footer"; } if($row->position == 'h'){ echo "Header"; } if($row->position == 'g'){ echo "General"; } ?></td>
                                                               
                                                                <!-- <td><a class="btn btn-danger btn-xs ask" href="<?= base_url() ?>admin/Lead/deleteUser/<?= $row->user_id ?>">
                                                                        <i class="fa fa-close"></i>
                                                                    </a></td> -->
                                                                 <td>
                                                                    <?php 
                                                                        if($row->visible == 1){ 
                                                                            ?>
                                                                                <a class="btn btn-success btn-xs" href="<?= base_url() ?>admin/Page/status1/<?= $row->id?>/<?= $row->visible ?>">
                                                                                    <i class="fa fa-check"></i>
                                                                                </a>
                                                                            <?php 
                                                                        }else{
                                                                            ?>
                                                                                <a class="btn btn-danger btn-xs" href="<?= base_url() ?>admin/Page/status1/<?= $row->id?>/<?= $row->visible?>">
                                                                                    <i class="fa fa-close"></i>
                                                                                </a>
                                                                            <?php 
                                                                        } 
                                                                    ?>
                                                                </td>
                                                
                                                                 <td>
                                                                    <a class="btn btn-info btn-xs" href="<?= base_url() ?>admin/Page/Page_edit/<?= $row->id;?>">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                    <a class="btn btn-danger btn-xs ask" href="<?= base_url() ?>admin/Page/delete/<?= $row->id ?>">
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
<script type="text/javascript">
   function openModel(){
      
           // $("#MyPopup").modal("show");
            var id = $('#con').val();
            //$('#content1').text($('#con').val());
            //var url = base_url+'admin/Page';
            $.ajax({
               url: "<?php echo base_url().'admin/Page/getdata' ?>",
               type: "POST",
               dataType: "JSON",
               data: {id:id},
              dataType: "html",
              
               success: function (data) {
                var con1 = document.getElementById('content1');
                con1.innerHTML = data;
                $("#MyPopup").modal("show");
                  //alert(data);
               },
               error: function (xhr, ajaxOptions, thrownError) {
                   
               }
           });
            return false;
       
    }
</script>
<div id="MyPopup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
               <p id="content1"></p>
            </div>
            <div class="modal-footer">
                <input type="button" id="btnClosePopup" value="Close" class="btn btn-danger" data-dismiss="modal" />
            </div>
        </div>
    </div>
</div>





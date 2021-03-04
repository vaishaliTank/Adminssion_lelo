
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
                    <h1 class="mainTitle"> User Registration List </h1>
                    <?= $this->session->flashdata('msg') ?>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <a class="pull-right btn btn-primary btn-large" style="margin-right:40px" href="<?php echo base_url().'admin/Lead/createxlsRegister'?>"><i class="fa fa-plus"></i> Download CSV</a>
                <form name="" method="POST" id="categoryFrm" action=""> 
                    <div class="col-md-offset-0 col-md-12">
                        <p id="errortxt" style="color: red;"></p>
                        <p id="successtxt" style="color: green;"></p>
                        <!-- <a href="<?= base_url() ?>admin/Event/event_add" class="btn btn-primary margin-bottom-10 btn-wide"><i class="fa fa-plus"></i> Add New</a> -->
                        <div class="panel panel-light-primary" id="panel5">
                            <div class="panel-heading">
                                 User Registration List    
                            </div>
                            <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                 <th>Name</th>
                                                <th>Father's Name</th>
                                                <th>Qualification</th>
                                                <th>Stream</th>
                                                <th>Email</th>
                                                <th>Phone</th>  
                                                <th>Created On</th>                                              
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($List)){
                                                    $sr=0;
                                                    foreach($List as $row){
                                                      
                                                        $sr++;
                                                        ?>
                                                            <tr>
                                                                <td><?= $sr; ?></td>
                                                                <td><?= $row->uname; ?></td>
                                                                <td><?= $row->fname; ?></td>
                                                                <td><?= $row->qualification; ?></td>
                                                                <td><?= $row->stream; ?></td>
                                                                <td><?= $row->email; ?></td>
                                                                <td><?= $row->phone; ?></td>

                                                                 <td><?= $newDate = date("d M Y  H:i", strtotime($row->created_date));
                                                               ?></td>
                                                               
                                                                <td><a class="btn btn-danger btn-xs ask" href="<?= base_url() ?>admin/Lead/deleteUser/<?= $row->user_id ?>">
                                                                        <i class="fa fa-close"></i>
                                                                    </a></td>
                                                                 
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






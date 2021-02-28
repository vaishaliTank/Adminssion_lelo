<style type="text/css">
    /* -------------- Dashboard panel ------------------- */
    .panel {
        border: 1px solid rgba(0, 0, 0, 0.09) !important;
    }
    .panel.panel-green {
        border: 1px solid #3395ff !important;
    }
    .panel-green .panel-body{
        background-color: #3395ff;
    }
    .panel-icon{
        position: absolute;
        right: 11px;
    }
    .panel-icon i{
        border: 2px dotted;
        border-radius: 50%;
    }
    .panel-parent{
        padding-right: 0;
    }
    .panel-wrapper.referral-panel .panel-body{
        background-color: #dff0d8;
        margin: 0px;
        border-left: 5px solid #eea236;
    }
    .panel-wrapper.referral-panel .panel-body .StepTitle{
        color: #5b5b60;
    }
    .panel-wrapper.invite-panel .panel-body{
        margin: 15px;
        border-left: 5px solid #0099da;
    }
    .panel-wrapper.invite-panel .panel-body .StepTitle{
        color: #0099da;
    }
    .panel-wrapper.invite-panel .panel-body .btn{
        border-radius: 0;
    }
    .right-sidebar .table-wrapper{
        border-left: 5px solid #eea236;
        background: #dff0d8;
    }
    .right-sidebar .table-wrapper table tr td{
        border: 0;
    }
    .control-label-bold{
        font-weight: bold;
    }
    .fans_amt{
        font-weight: bold;
        color: #1234ae;
    }
    .coin_address_label{
        margin-top: 15px;
    }
</style>
<div class="main-content" >
    <div class="wrap-content container" id="container">
        <div class="container-fluid container-fullw bg-white">
            <div class="row">                    
                <div class="col-md-12">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            <h4 class="panel-title text-white">Dashboard</h4>
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                            <h5 class="over-title margin-bottom-15"><span class="text-bold"></span></h5>
                            <div class="col-md-12">   
                                <!-- <div class="col-md-4 panel-parent">
                                    <div class="panel panel-green no-radius main-box-shadow">
                                        <div class="panel-body main-box-shadow-panel">
                                            <h4 class="StepTitle text-green">Total User</h4>
                                            <p class="links cl-effect-1 text-green" style="font-size: 16px;">
                                                <?= $total_user ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>  -->                           
                            </div>
                        </div>
                    </div>

                </div> 

            </div>
        </div>
        <!-- end: DYNAMIC TABLE -->
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

    });
</script>


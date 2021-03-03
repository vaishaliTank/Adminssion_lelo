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
                            <div class="panel-body bg-white" style="border: 1px solid #3395ff;">
                                <div class="table-responsive">   
            <table>
                <tbody>
							<tr>
							<?php
							$sr=0;
							$distd=4; 
                            for($i=0;$i<count($List);$i++){
								?>                            
                                <td style="padding-left:2px; font-weight: bold;">
									<img src="../upload/event/<?php echo $List[$i]->gallery_image; ?>" width="100" height="100" /><br>
                                     <a href="<?= base_url() ?>admin/Event/ImageDelete/<?=$List[$i]->event_gallery_id;?>/<?= $List[$i]->event_id;?>">Delete</a>
                                                                                
								</td>
								<?php 
								if($distd == $sr){
									echo "</tr><tr>";
									$sr=0;
								}else{
									$sr++;
								}	
								?>                                                            
                            <?php } ?>
							</tr>
                       
                    
                </tbody>
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
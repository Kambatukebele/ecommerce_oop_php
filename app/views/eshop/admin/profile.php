<?php $this->view("eshop/header", $data);  ?>
    <section id="main-content">
        <section class="wrapper"> 
            <div style="min-height: 300px; max-width:1000px; margin:auto; ">
            <style>
                .col-md-6{
                    color:#6e93ce;
                }

                #user_text{
                    color:#6e93ce; 
                }
            </style>
                <div class="col-md-4 mb" style="background-color:#eee; text-align:center; box-shadow: 0 0 20px #aaa; border: solid thid #ddd">
                                            <!-- WHITE PANEL - TOP USER -->
                    <div class="white-panel pn">
                        <div class="white-header">
                            <h5 id="user_text">MY ACCOUNT</h5>
                        </div>
                        <p><img src="<?= ASSETS ?>/eshop/admin/img/ui-zac.jpg" class="img-circle" width="80"></p>
                        <p><b id="user_text"><?=$data['user_data']->name; ?></b></p>
                        <div class="row">
                            <div class="col-md-6">
                                <p id="user_text" class="small mt">MEMBER SINCE</p>
                                <p><?=date("jS M Y", strtotime($data['user_data']->date)); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p id="user_text" class="small mt">TOTAL SPEND</p>
                                <p>$ 47,60</p>
                            </div>
                        </div>
                        <hr style="color:black; " />
                        <div class="row">
                            <div class="col-md-6">
                                <p id="user_text" class="small mt" style="cursor:pointer">EDIT</p>
                            </div>
                            <div class="col-md-6">
                                <p id="user_text" class="small mt" style="cursor:pointer">DELETE</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /col-md-4 -->
            </div>
        </section>
    </section>
<?php $this->view("eshop/footer", $data);  ?>
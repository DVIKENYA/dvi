<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--\\\\\\\ container  start \\\\\\-->
<div class="page-content">
    <div class="row">
        <div class="col-md-4">
            <?php echo $this->session->flashdata('msg');  ?>
            <div class="profile_bg">
                <div class="account-status-data">
                    <div class="row">
                        <div class="col-md-4"><img src="<?php echo base_url() ?>assets/images/user.jpg" /></div>
                        <div class="col-md-8">
                            <div class="user-identity">
                                <h4><strong> <?php echo $user_object['user_fname'].' '.$user_object['user_lname'] ;?></strong></h4>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:void(0);" class="add_user" data-toggle="modal" data-target="#myModal"> <i class="fa fa-key"></i> <span> Change password</span> </a>

                    </div>
                </div>
                </br>
                </br>
<!--                <div>-->
<!--                    <small class="">Phone</small></br>-->
<!--                    <abbr title="Phone">--><?php //echo $profile['phone']; ?><!--</abbr>-->
<!--                    </br>-->
<!--                    <small class="">Email</small></br>-->
<!--                    <p> --><?php //echo $profile['email']; ?><!--</p><div class="line"></div>-->
<!--                    <p class="m-t-sm"> </p>-->
<!--                </div>-->


            </div>
            <!--/block-web-->

        </div>
        <!--/col-md-4-->
        <div class="col-md-8">
            <div class="block-web full">
                <ul class="nav nav-tabs nav-justified nav_bg">
                    <li class="active"><a href="#edit-profile" data-toggle="tab"><i class="fa fa-pencil"></i> Edit User Profile</a></li>

                </ul>
                <div class="tab-content">

                    <div class="tab-pane animated fadeInRight active" id="edit-profile">
                        <div class="user-profile-content">
                            <?php echo form_open('',array('class'=>'form-horizontal'));?>
                                <div class="form-group">
                                    <?php
//                                    echo "<pre>";
//                                    print_r($this->session->all_userdata());
//                                    echo "</pre>";
                                    echo form_label('First name','first_name');
                                    echo form_error('first_name');
                                    echo form_input('first_name',set_value('first_name',$profile['first_name']),'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Last name','last_name');
                                    echo form_error('last_name');
                                    echo form_input('last_name',set_value('last_name',$profile['last_name']),'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Phone','phone');
                                    echo form_error('phone');
                                    echo form_input('phone',set_value('phone',$profile['phone']),'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Email','email');
                                    echo form_error('email');
                                    echo form_input('email',set_value('email',$profile['email']),'class="form-control" ');
                                    ?>
                                </div>

                            <?php echo form_submit('submit', 'Save profile', 'class="btn btn-primary btn-lg"');?>
                            <?php echo form_close();?>
                        </div>
                    </div>

                </div>
                <!--/tab-content-->
            </div>
            <!--/block-web-->
        </div>
        <!--/col-md-8-->
    </div>
    <!--/row-->
</div>
</div>
<!--\\\\\\\ container  end \\\\\\-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('users/change_pass');?>
                <div class="col-md-6">
                    <?php
                    echo form_label('Change password','password');
                    echo form_error('password');
                    echo form_password(['name' => 'password', 'id' => 'password' ,'class' => 'form-control', 'placeholder' => 'Enter Password']);
                    ?>
                </div>

                <div class="col-md-6">
                <?php
                echo form_label('Confirm changed password','password_confirm');
                echo form_error('password_confirm');
                echo form_password(['name' => 'password_confirm', 'id' => 'password_confirm' ,'class' => 'form-control', 'placeholder' => 'RE-Enter Password']);
                ?>
            </div>
            </br>
            </br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"');?>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    window.setTimeout(function() {
        $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 2000);
</script>
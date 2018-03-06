<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Control Panel || Admin Login</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assest/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assest/css/icofont.css">

    <script type="text/javascript" src="<?php echo base_url() ?>assest/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assest/js/bootstrap.min.js"></script>
    <style>
    #wrraper{background: url('<?php echo base_url() ?>/assest/images/admin.jpg');font-family: play;}
    .login_Wrapper {background: rgba(0, 0, 0, 0.8) none repeat scroll 0 0; min-height: 631px;}
    .loginBody{margin-top: 150px;}
    .loginForm {background: rgba(255,255,255, 0.20) none repeat scroll 0 0;border-radius: 8px;color: #fff;font-size: 16px;padding: 20px;}
    .meg_alert{font-size: 12px;color:red;padding: 10px 0;}
    .loginBody>form>.input-group{padding: 10px 0;}
    </style>
</head>
<body>
<div id="wrraper">
<div class="login_Wrapper">
    <div class="container">
        <div class="col-md-offset-3 col-sm-offset-2 col-md-6 col-lg-6 col-sm-8 col-md-offset-3 loginBody">
            

            <form action="" method="POST" role="form" class="loginForm" autocomplete="off">
                <h2 class="text-center" style="padding-bottom: 20px"><i class="icofont icofont-ui-user"></i> ADMIN LOGIN </h2>
                <span class="meg_alert">
                <?php 
                    if(isset($_SESSION)) {
                        echo $this->session->flashdata('flash_data');
                    } 
                ?></span>
                

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>

                <button type="submit" class="btn btn-info text-right">LOGIN <i class="icofont icofont-login"></i></button>
            </form>

                
        </div>
    </div>
</div>
</body>
</html>
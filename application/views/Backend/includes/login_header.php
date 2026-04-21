<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title;?></title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/skins/_all-skins.min.css">
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/css/custom.css">
<style type="text/css">
.skin-red .wrapper, .skin-red .main-sidebar, .skin-red .left-side {background-color: #f8f8f8;}
img{ display:inline-block !important;}
.error{font-size: 14px;margin-top: 5px;letter-spacing: 0.2px;}
.lgn_title{font-family: 'Libre Baskerville', serif; text-transform:capitalize; color:#016A70 !important;}
.lgn_title label{display:block;}
.login-box-msg strong{ font-size:16px;}
</style>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.validate.min.js" type="text/javascript"></script>
</head>
<body class="hold-transition skin-red login-page">
	<div class="login-box"> 
	
 		<div class="login-logo" style="font-size:25px;"><?php if(isset($page_title) && $page_title!=''){ ?><a href="#" class="lgn_title"><label class="sName"><?php echo $this->config->item('product_name');?></label> Admin Panel</a><?php } ?></div>
		
		<div class="login-box-body">
			<?php if(isset($page_title1) && $page_title1!=''){ ?><p class="login-box-msg"><strong><?php echo $page_title;?></strong></p><?php } ?>
			<?php if(isset($custom_variable_first) && $custom_variable_first!=''){ ?><p class="login-box-msg"><?php echo $custom_variable_first;?></p><?php } ?>
			<p id="login_err_msg" class="login_err_msg">
 				<?php if(isset($success_msg) && $success_msg!=''){ ?><div class="alert alert-dismissable alert-success"><?php echo $success_msg;?></div><?php }  ?>
				<?php if(isset($error_login) && $error_login!=''){ ?><div class="alert alert-dismissable alert-danger" style="margin:0;"><?php echo $error_login;?></div><?php } ?>
				<?php if(validation_errors() != false) { echo'<div class="alert alert-dismissable alert-danger" style="margin:0;">'. validation_errors().'</div>'; } ?>
			</p>
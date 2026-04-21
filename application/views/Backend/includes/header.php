<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title;?></title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/datatables/dataTables.bootstrap.css">
<link href="<?php echo base_url(); ?>assets/backend/css/datepicker.css" rel="stylesheet" type="text/css" /> 
<link href="<?php echo base_url(); ?>assets/backend/css/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />   
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">  
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/css/custom.css"> 
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="<?php echo base_url(); ?>assets/backend/css/custom.css" rel="stylesheet" type="text/css" /> 
<script src="<?php echo base_url(); ?>assets/backend/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/bootstrap/js/bootstrap.min.js"></script>
<!-- validation script -->
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
function getWardsByZoneId(zoneId,selectedWardId){
	if(zoneId!=''){
		$.ajax({
			url: '<?php echo base_url();?>home/get_wards_by_zoneId?zoneId='+zoneId+'&selectedWardId='+selectedWardId,
			beforeSend: function(){
				$('#fWardId').html('<option value="">-- please wait, data loading --</option>');
			},
			success: function(result, status, xhr){//alert(result);
				$('#fWardId').html(result);
			}
		});	
	}
}
</script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>VC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg fmc" style="color:#016A70;"><?php echo $this->config->item('product_name');?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu"> 
        <ul class="nav navbar-nav">
			<li class="dropdown user user-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<?php if($session_details->image==''){ ?>
					<img alt="User Image" class="user-image" src="<?php echo base_url();?>assets/backend/images/1442581129avatar3.png"   />
				<?php }else{ ?>
					<img src="<?php echo base_url();?>assets/upload/photo/<?php echo $session_details->image;?>" class="user-image" alt="User Image"  />
				<?php } ?>
  				<span class="hidden-xs1 fmc fs16"><?php echo 'Hi, '.ucwords(strtolower($session_details->name)); ?></span>
			</a>
				<ul class="dropdown-menu">
					<li class="user-header">
						<?php if($session_details->image==''){ ?>
							<img src="<?php echo base_url();?>assets/backend/images/1442581129avatar3.png" class="img-circle" alt="User Image" />
						<?php }else{ ?>
							<img src="<?php echo base_url();?>assets/upload/photo/<?php echo $session_details->image;?>" class="img-circle" alt="User Image" />
						<?php } ?>
						<div style="color: rgb(255, 255, 255); font-size: 14px; font-weight: 600; text-align: center; margin-top: 10px;">
							Last Login <br>  
							<?php if(isset($session_details->last_login) && $session_details->last_login>0 && $session_details->last_login!=''){ echo date('F d, Y h:i:s A',$session_details->last_login); }else if(isset($session_details->current_login) && $session_details->current_login>0 && $session_details->current_login!=''){ echo date('F d, Y h:i:s A',$session_details->current_login);}else{echo 'Not Yet';}?> 
						</div>
 					</li>
 					<li class="user-footer">
						<div class="pull-left">
							<a href="<?php echo base_url().$this->config->item('admin_directory_name');?>/profile" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profile</a>
						</div>
						<div class="pull-right">
							<a href="<?php echo base_url().$this->config->item('admin_directory_name');?>/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
						</div>
					</li>
				</ul>
			</li>
            
        </ul>
      </div>
    </nav>

  </header>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar" style="height: auto;">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<?php if($session_details->image==''){ ?>
					<img src="<?php echo base_url();?>assets/backend/images/1442581129avatar3.png" class="img-circle" alt="User Image" />
				<?php }else{ ?>
					<img src="<?php echo base_url();?>assets/upload/photo/<?php echo $session_details->image;?>" class="img-circle" alt="User Image" />
				<?php } ?>
 			</div>
			<div class="pull-left info">
				<p><?php  echo ucwords(strtolower($session_details->name));?></p> 
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
	
	<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			<?php include(APPPATH.'views/Backend/includes/menu.php'); ?>
		</ul>
	</section>
    <!-- /.sidebar -->
  </aside>

<div class="content-wrapper" style="min-height: 647px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo $page_title;?><small></small></h1>
		<?php if(isset($success_msg) && $success_msg!=''){?>
			<div class="alert alert-success "><img style="margin-top:-3px;" src="<?php echo base_url();?>/assets/backend/images/success.png" /> <?php echo $success_msg;?> </div> 
		<?php } ?>
		<?php if(isset($error_msg) && $error_msg!=''){?>
			<div class="alert alert-danger "><img style="margin-top:-3px;" src="<?php echo base_url();?>/assets/backend/images/warning.png" /> <?php echo $error_msg;?> </div>
		<?php } ?>
	</section> 
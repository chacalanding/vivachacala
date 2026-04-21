<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $title;?> </title>
  <!-- Tell the browser to be responsive to screen width -->
  <link href="<?php echo base_url();?>/assets/backend/images/favicon.png" rel="shortcut icon">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/skins/_all-skins.min.css">
  
	<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/datatables/dataTables.bootstrap.css">
	<link href="<?php echo base_url(); ?>assets/backend/css/datepicker.css" rel="stylesheet" type="text/css" />   
	
	<link href="<?php echo base_url(); ?>assets/backend/css/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />  
	<link href="<?php echo base_url();?>assets/backend/plugins/datatables/fixedHeader.dataTables.min.css" rel="stylesheet" type="text/css" />     
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
   <style>  
.breadcrumb_success{
	background: #15a261 none repeat scroll 0 0;
	border-radius: 5px;
	color: #fff;
	font-size: 15px; 
	font-weight: 600; 
	margin-bottom: 0;
	margin-top: 5px;
	padding: 7px 10px 7px 10px;
} 
.breadcrumb_error{
	background: #ffd1d1 none repeat scroll 0 0;
	border-radius: 5px;
	color: #555555;
	font-size: 15px; 
	font-weight: 600;
	margin-bottom: 0;
	margin-top: 5px;
	padding: 7px 10px 7px 10px;
}
.error1{
	 color: #dd4b39;
	 display: inline-block;
    font-weight: 600;
    margin-bottom: 5px;
    max-width: 100%;
}
</style>
  <script src="<?php echo base_url(); ?>assets/backend/js/jquery-1.11.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/highslide/highslide.css" />
<script type="text/javascript">
hs.graphicsDir = '<?php echo base_url(); ?>assets/highslide/graphics/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';
</script>

  <!-- validation script -->
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/dataTables.fixedHeader.min.js"></script>
   

<script src="<?php echo base_url() ?>assets/backend/js/bootstrap-datepicker.js" type="text/javascript"></script>
         

             
                        
</head>
<body class="hold-transition skin-red sidebar-mini" style="background:#f8f8f8;">
 
 <?php 
if(isset($_SESSION['success'])){?>
<div class="col-md-12">
<div class="alert alert-success">
<?php print_r($_SESSION['success']);
unset($_SESSION['success']);  ?>
</div>
</div><div class="clearfix"></div>


<?php }elseif(isset($_SESSION['error'])){?>
<div class="col-md-12">
<div class="alert alert-danger msg-error">
<?php print_r($_SESSION['error']);
unset($_SESSION['error']);  ?>
</div>  
</div><div class="clearfix"></div>

<?php }?>
		
		
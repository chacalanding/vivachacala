<style type="text/css">
.nav-tabs-custom > .nav-tabs > li.active {border-top-color: #D2DE32;}
.tab-content > .active {display: block; }
.tab-pane .box{border-top: 3px solid #d2d6de;box-shadow:0 2px 2px 1px rgba(0, 0, 0, 0.1);}
.nav-tabs-custom > .tab-content {border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;padding: 15px;}
.nav-tabs-custom {background: #fff none repeat scroll 0 0;border-radius: 3px;box-shadow:none;margin-bottom: 20px;}
.table small {display: block;margin-left: 5px; font-size: 95%;margin-top: 2px; font-weight:600;}
.mstus {border: 1px dashed;padding: 1px 10px;margin-bottom: 0;font-size: 14px;}
.accepted {color: green;}
.rejected {color: #a94442;}
.table .btn-group-sm>.btn, .btn-sm {font-size:13px;}
.img_grid .li{position: relative;}
.img_grid .delImg {position: absolute; top: 5px; right: 20px;}
.img_grid .img-responsive{ width: 100%; height: 200px; object-fit:cover;}
.img_grid .sortable_drag li img.img-responsive{width: 150px; height: 100px; object-fit:cover;}
.sortable_drag li {
  position: relative;
}
.add_images_btn img{ width:150px; cursor: pointer;}
</style>

<?php //$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
$actual_link = base_url().$this->config->item('admin_directory_name').'properties/manage/'.$propertyDetails['encryptedPropertyId'].'?tab_id=4';?>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/dynamic_drag_drop/js/jquery-ui-1.10.4.custom.min.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>/assets/frontend/dynamic_drag_drop/css/style.css" />
<script type="text/javascript">
jQuery(function() {
    jQuery('#sortable').sortable({
        axis: 'y',
        opacity: 0.7,
        handle: 'span',
        update: function(event, div) {
            var list_sortable = jQuery(this).sortable('toArray').toString();
    		// change order in the database using Ajax
    		jQuery.ajax({
                url: '<?php echo base_url().$this->config->item('admin_directory_name');?>properties/set_order_images',
                type: 'POST',
                data: {list_order:list_sortable},
                success: function(data) {
                	var redirect_url = '<?php echo $actual_link; ?>';  
                	jQuery(location).attr('href',redirect_url);
                	
                }
            });
        }
    }); // fin sortable
});
</script>

<section class="content">
<input type="hidden" id="hBaseUrl" name="hBaseUrl" value="<?php echo base_url().$this->config->item('admin_directory_name');?>" />
<div class="nav-tabs-custom"  >
		<ul class="nav nav-tabs">
			<li class="<?php if(!isset($_GET['tab_id'])){echo 'active';}?>"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><span style="font-weight:600;"> Basic Info. </span></a></li>
			<li class="<?php if(isset($_GET['tab_id']) && $_GET['tab_id']==2){echo 'active';}?>"><a href="#tab_2" data-toggle="tab" aria-expanded="true"><span style="font-weight:600;"> Additional Info. </span></a></li>
			<?php if($propertyType!=2){ ?><li class="<?php if(isset($_GET['tab_id']) && $_GET['tab_id']==3){echo 'active';}?>"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><span style="font-weight:600;"> Amenities </span></a></li><?php } ?>
			<li class="<?php if(isset($_GET['tab_id']) && $_GET['tab_id']==4){echo 'active';}?>"><a href="#tab_4" data-toggle="tab" aria-expanded="false"><span style="font-weight:600;"> Images </span></a></li>
			<li class="<?php if(isset($_GET['tab_id']) && $_GET['tab_id']==5){echo 'active';}?>"><a href="#tab_5" data-toggle="tab" aria-expanded="false"><span style="font-weight:600;"> Calendar </span></a></li>
			<?php if($propertyType!=2){ ?><li class="<?php if(isset($_GET['tab_id']) && $_GET['tab_id']==6){echo 'active';}?>"><a href="#tab_6" data-toggle="tab" aria-expanded="false"><span style="font-weight:600;"> Reviews </span></a></li><?php } ?>
		</ul>

		<div class="tab-content">
		
			<div class="tab-pane <?php if(!isset($_GET['tab_id'])){echo 'active';}?>" id="tab_1">				
				<form id="proManageFrm" class="form-horizontal" method="post" action="properties/manageBasicEntry" style="margin-top:10px;">
					<?php include(APPPATH.'views/Backend/properties/content/basicInfo.php');?>
					<div class="col-md-12">
						<button type="submit" id="manageBtn" class="btn btn-primary" style="padding:5px 30px;">Save Changes</button>
					</div>
				</form>				
				<div class="clearfix"></div>			 
			</div>
			
			<div class="tab-pane <?php if(isset($_GET['tab_id']) && $_GET['tab_id']==2){echo 'active';}?>" id="tab_2">
				<?php include(APPPATH.'views/Backend/properties/content/additionalInfo.php');?>
			</div>
			<?php if($propertyType!=2){ ?>
			<div class="tab-pane <?php if(isset($_GET['tab_id']) && $_GET['tab_id']==3){echo 'active';}?>" id="tab_3">
				<?php include(APPPATH.'views/Backend/properties/content/amenities.php');?>
			</div>
			<?php } ?>	
			<div class="tab-pane <?php if(isset($_GET['tab_id']) && $_GET['tab_id']==4){echo 'active';}?>" id="tab_4">
				<div class="row img_grid">
				 	<?php include(APPPATH.'views/Backend/properties/content/images.php');?>
				</div>
			</div>
			
			<div class="tab-pane <?php if(isset($_GET['tab_id']) && $_GET['tab_id']==5){echo 'active';}?>" id="tab_5">
 				
				 	<?php include(APPPATH.'views/Backend/properties/content/calender.php');?>
				 
			</div>	
			
			<?php if($propertyType!=2){ ?>
			<div class="tab-pane <?php if(isset($_GET['tab_id']) && $_GET['tab_id']==6){echo 'active';}?>" id="tab_6">
 				<div class="row">
				 	<div class="col-md-12 box-header" style="margin-top: -8px;margin-bottom: 10px;">
						<h3 class="box-title">Reviews only for <span style="font-weight:600;"><?php echo $propertyDetails['name']; ?> </span> <?php if($propertyDetails['propertyType']==0){echo ' Villa';}else{echo 'Business';}?></h3>
						<div class="box-tools pull-right">
							<a onclick="return addReview();"  class="btn btn-primary" style="padding:4px 30px;">Add Review</a>
						</div>
					</div>							 
					<div class="col-md-12">
						<?php include(APPPATH.'views/Backend/properties/content/reviews.php');?>
					</div>
				</div>			
			</div>	
			<?php } ?>		 
		</div>
		
	</div>
	
</section>

<script>
$(function(){	
 	if($('#keyFeatures').length > 0){ CKEDITOR.replace( 'keyFeatures',{height: '180px',});  }
	if($('#addInfo').length > 0){ CKEDITOR.replace( 'addInfo',{height: '180px',});  }
});
</script>
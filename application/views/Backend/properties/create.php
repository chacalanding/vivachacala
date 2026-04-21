<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Add <?php echo $section_status_label;?> Details</h3>
				</div>
				<input type="hidden" id="hBaseUrl" name="hBaseUrl" value="<?php echo base_url().$this->config->item('admin_directory_name');?>" />
				
				<form id="proManageFrm" class="form-horizontal" method="post" action="properties/manageBasicEntry"> 					
					<div class="box-body" style="margin-top:15px;">
						<?php include(APPPATH.'views/Backend/properties/content/basicInfo.php');?>
 					</div>
					<div class="box-footer">
						<button type="submit" id="manageBtn" class="btn btn-primary" style="padding:5px 30px;">Save Changes</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</section>

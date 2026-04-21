<style>
.table small {display: block;margin-left: 5px; font-size: 95%;margin-top: 2px;}
.mstus {border: 1px dashed;padding: 1px 10px;margin-bottom: 0;font-size: 14px;}
.accepted {color: green;}
.rejected {color: #a94442;}
.table .btn-group-sm>.btn, .btn-sm {font-size:13px;}
</style>
<input type="hidden" id="hBaseUrl" name="hBaseUrl" value="<?php echo base_url().$this->config->item('admin_directory_name');?>" />
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Listing</h3>
					<div class="box-tools pull-right">
						<a onclick="return addReview();"  class="btn btn-primary" style="padding:4px 30px;">Add Review</a>
					</div>
				</div>				 
				<div class="box-body row">
					<div class="col-xs-12 table-responsive">						
						 <?php include(APPPATH.'views/Backend/properties/content/reviews.php');?>					
					</div>	 
				</div>		
			</div>
		</div>
	</div>
</section>
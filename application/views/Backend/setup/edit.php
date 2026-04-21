<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12" >
		
		 <form data-toggle="validator" class="form-horizontal" id="frm" method="post" action="" enctype="multipart/form-data">
<?php $wards_prefix = $this->config->item('wards_prefix');?>
<?php $zones_prefix = $this->config->item('zones_prefix');?>		 
          <!-- general form elements -->
          <div class="box">
         
             
              <div class="box-body">
                <div class="col-md-10">
				  
					<input type="hidden" id="parentId" name="parentId" value="0" />
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="inputEmail3"><?php echo $section_status_label;?> Name *</label>
						<div class="col-sm-9">
							<input type="text" class="form-control required" id="txt_name" name="txt_name" placeholder="<?php echo $section_status_label;?> Name" value="<?php echo $setup_masters_details->name;?>"  >
						</div>
					 </div> 
				  
				  </div>
				  

           </div> 
          	  <div class="box-footer">
                <button class="btn btn-primary" type="submit" style="padding:4px 30px;">Update</button>
              </div>
          </div> </form>
        <!--/.col (left) -->
        <!-- right column -->
         
 
      </div>
        <!--/.col (right) -->
   </div>
      <!-- /.row -->
</section>
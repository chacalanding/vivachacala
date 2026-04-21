
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				
				<form data-toggle="validator" id="editfrm" class="form-horizontal"  method="post" action="amenities/update" enctype="multipart/form-data">

                <input type="hidden" id="id" name="id" value="<?php echo $amenitiesDetails->id;?>"/>
				<input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name');?>" />

					<div class="box-body">
					
					<div class="col-md-11">
					        <?php $amenities_categories = $this->config->item('amenities_categories_types_array_config');?>
					        <div class="form-group" style="margin-top:10px;">
								<label class="col-sm-3 control-label" for="catId">Category *</label>
								<div class="col-sm-8">
									<select class="form-control required" id="catId" name="catId">
										<option value="">Select...</option>
										<?php foreach($amenities_categories as $key=>$value){?>
										<option value="<?php echo $key;?>" <?php if($amenitiesDetails->catId==$key){?> selected="selected"<?php } ?>><?php echo $value['name'];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputEmail3">Amenity Name *</label>
								<div class="col-sm-8">
									<input type="text" class="form-control required" id="name" name="name" placeholder="Name" value="<?php echo $amenitiesDetails->name; ?>" />
								</div>
							</div>
							
							<!--<div class="form-group" style="display:block;">
								<label class="col-sm-3 control-label" for="inputEmail3">Svg Image Path *</label>
								<div class="col-sm-8">
									<textarea class="form-control required" id="svg_image" name="svg_image" rows="8"><?php //echo $amenitiesDetails->svg_image; ?></textarea>
								</div>
							</div>-->
							
							<!--<div class="form-group">
								<label class="col-sm-4 control-label" for="roleId">Role *</label>
								<div class="col-sm-8">
									<select class="form-control required" id="roleId" name="roleId">
										<option value="">Select...</option>
										<?php //$pc_role_staffs=$this->config->item('pc_role_staffs_array_config');
										//foreach($pc_role_staffs as $key => $value){ if($value['status']==0){?>
										<option value="<?php //echo $key;?>"<?php  //if($edit->roleId == $key){?> selected="selected"<?php //} ?>><?php //echo $value['name'];//.' &mdash; '.$value['more_details'].'&nbsp;&nbsp;';?></option>
										<?php //} }?>
									</select>
								</div>
							</div>-->

                            <div class="form-group">
								<label class="col-sm-3 control-label">Status *</label>
								<div class="col-sm-8">
									<select class="form-control required" id="is_status" name="is_status"> 
										<option value="">Select...</option>
										<option value="0" <?php  if($amenitiesDetails->is_status==0){?> selected="selected"<?php } ?>>Active</option>
										<option value="1" <?php  if($amenitiesDetails->is_status==1){?> selected="selected"<?php } ?>>Inactive</option>
									</select>
								</div>
							 </div>
						</div>
					</div>
				<div class="box-footer">
				<button type="submit" class="btn btn-primary" style="padding:5px 30px;" id="editbtn" name="submit">Update</button>
				</div>
				</form>
			
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
$(document).ready(function(){
	$('#editfrm').validate({
		ignore: [], 
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
		},
		success: function(element) {
			element.closest('.form-group').removeClass('has-error').addClass('has-success');
			element.remove();
		},
		submitHandler: function(form){
			var ajax_base_url = $('#h_ajax_base_url').val();
			var form = $('#editfrm');
			var url = ajax_base_url+form.attr('action');
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#editbtn').prop("disabled", true);
					$('#editbtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location=result_arr[1];
					}else{
						$('#result_display').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#editbtn').prop("disabled", false);
						$('#editbtn').html('Update');
					}
				},
				error: function(xhr, status, error_desc){
					$('#result_display').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#editbtn').prop("disabled", false);
					$('#editbtn').html('Update');
				}
			});		
			return false;
		}
	});
});
</script>

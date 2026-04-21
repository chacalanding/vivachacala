<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				
				<form id="addFrm" class="form-horizontal" method="post" action="amenities/create_entry">
				
					<input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name');?>" />

					<div class="box-body">

 						<div class="col-md-11">
							
							<div id="result_display"></div>
							<?php $amenities_categories = $this->config->item('amenities_categories_types_array_config');?>
							
							<div class="form-group" style="margin-top:10px;">
								<label class="col-sm-3 control-label" for="catId">Category *</label>
								<div class="col-sm-8">
									<select class="form-control required" id="catId" name="catId">
										<option value="">Select...</option>
										<?php foreach($amenities_categories as $key=>$value){?>
										<option value="<?php echo $key;?>"><?php echo $value['name'];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputEmail3">Amenity Name *</label>
								<div class="col-sm-8">
									<input type="text" class="form-control required" id="name" name="name" value="" />
								</div>
							</div>
							 
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" id="addBtn" class="btn btn-primary" style="padding:5px 30px;" name="submit">Add Now!</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
$(document).ready(function(){
	$('#addFrm').validate({
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
			var form = $('#addFrm');
			var url = ajax_base_url+form.attr('action');
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#addBtn').prop("disabled", true);
					$('#addBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location=result_arr[1];
					}else{
						$('#result_display').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#addBtn').prop("disabled", false);
						$('#addBtn').html('Add Now!');
					}
				},
				error: function(xhr, status, error_desc){
					$('#result_display').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#addBtn').prop("disabled", false);
					$('#addBtn').html('Add Now!');
				}
			});		
			return false;
		}
	});
});
</script>
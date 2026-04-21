<form id="moreInfoFrm" class="" method="post" action="properties/moreInfoEntry">
<input type="hidden" id="morePropertyId" name="morePropertyId" value="<?php if(isset($propertyDetails['propertyId']) && $propertyDetails['propertyId']!=''){echo $propertyDetails['propertyId'];}else{echo '0';}?>" />
 
	<div class="col-md-4">
		 <h4>Key Features</h4>
		 <div class="form-group">		 
			<textarea id="keyFeatures" name="keyFeatures"><?php if(isset($propertyDetails['keyFeatures']) && $propertyDetails['keyFeatures']!=''){echo $propertyDetails['keyFeatures'];}?></textarea>
		</div>
		
		<div class="form-group">
			<label class="control-label" for="metaTitle"> Meta Title </label>
			<input type="text" class="form-control" id="metaTitle" name="metaTitle" value="<?php if(isset($propertyDetails['metaTitle']) && $propertyDetails['metaTitle']!=''){echo $propertyDetails['metaTitle'];}?>" autocomplete="off" />
		</div>
		
		<div class="form-group">
			<label class="control-label" for="metaDesc"> Meta Description </label>
			<textarea id="metaDesc" class="form-control" rows="3" name="metaDesc"><?php if(isset($propertyDetails['metaDesc']) && $propertyDetails['metaDesc']!=''){echo $propertyDetails['metaDesc'];}?></textarea>
		</div>
		
		<div class="form-group">
			<label class="control-label" for="metaKeyword"> Meta Keywords</label>
			<textarea id="metaKeyword" class="form-control" rows="3" name="metaKeyword"><?php if(isset($propertyDetails['metaKeyword']) && $propertyDetails['metaKeyword']!=''){echo $propertyDetails['metaKeyword'];}?></textarea>
		</div>
	</div>
	<?php if($propertyType!=2){?>
	<div class="col-md-4">
		<h4>Additional Information</h4> 
		<div class="form-group">
			<label class="control-label" for="checkIn"> <?php if($propertyType==1){echo 'Open';}else{echo 'Check-in';}?></label>
			<input type="text" class="form-control" id="checkIn" name="checkIn" value="<?php if(isset($propertyDetails['checkIn']) && $propertyDetails['checkIn']!=''){echo $propertyDetails['checkIn'];}?>" autocomplete="off" />
		</div>
		<div class="form-group">
			<label class="control-label" for="checkOut"> <?php if($propertyType==1){echo 'Close';}else{echo 'Check-out';}?></label>
			<input type="text" class="form-control" id="checkOut" name="checkOut" value="<?php if(isset($propertyDetails['checkOut']) && $propertyDetails['checkOut']!=''){echo $propertyDetails['checkOut'];}?>" autocomplete="off" />			
		</div>
		<div class="form-group">
			<textarea id="addInfo" name="addInfo"><?php if(isset($propertyDetails['addInfo']) && $propertyDetails['addInfo']!=''){echo $propertyDetails['addInfo'];}?></textarea>
		</div>
	</div>
	<?php } ?>
	<div class="col-md-4">
		<h4>Location</h4>
		
		<div>
			<div class="form-group">
				<label class="control-label" for="latitude"> Latitude *</label>
				<input type="text" class="form-control" id="latitude" name="latitude" value="<?php if(isset($propertyDetails['latitude']) && $propertyDetails['latitude']!=''){echo $propertyDetails['latitude'];}?>" autocomplete="off" />
			</div>
			<div class="form-group">
				<label class="control-label" for="longitude"> Longitude *</label>
				<input type="text" class="form-control" id="longitude" name="longitude" value="<?php if(isset($propertyDetails['longitude']) && $propertyDetails['longitude']!=''){echo $propertyDetails['longitude'];}?>" autocomplete="off" />			
			</div>
		</div>
		<div class="form-group" style="display:none">
			<label class="control-label" for="locIframeSrc"> iFrame Src Path</label>			
			<textarea rows="10" class="form-control" id="locIframeSrc" name="locIframeSrc"><?php if(isset($propertyDetails['locIframeSrc']) && $propertyDetails['locIframeSrc']!=''){echo $propertyDetails['locIframeSrc'];}?></textarea>
		</div>
	</div>
 
	<div class="col-md-12">
		<button type="submit" id="moreInfoBtn" class="btn btn-primary" style="padding:5px 30px; margin-top:10px;">Save Changes</button>
	</div>
 

</form>

<div class="clearfix"></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#moreInfoFrm').validate({
		ignore: [], 
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
		},
		success: function(element) {
			element.closest('.form-group').removeClass('has-error');
			element.remove();
		},
		submitHandler: function(form){
			var baseUrl = $('#hBaseUrl').val();
			var form = $('#moreInfoFrm');
			var url = baseUrl+form.attr('action');
			var btnText = $('#moreInfoBtn').html();
			for(var instanceName in CKEDITOR.instances){
				CKEDITOR.instances[instanceName].updateElement();
			}
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#moreInfoBtn').prop("disabled", true);
					$('#moreInfoBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location='<?php echo base_url().$this->config->item('admin_directory_name').'properties/manage/'.$propertyDetails['encryptedPropertyId'].'?tab_id=2';?>';
					}else{
						$('#basicInfoResDisplay').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#moreInfoBtn').prop("disabled", false);
						$('#moreInfoBtn').html(btnText);
					}
				},
				error: function(xhr, status, error_desc){
					$('#basicInfoResDisplay').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#moreInfoBtn').prop("disabled", false);
					$('#moreInfoBtn').html(btnText);
				}
			});		
			return false;
		}
	});
});
</script>
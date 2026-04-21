<div class="col-md-12">
	
		<?php
			$amenities_categories = $this->config->item('amenities_categories_types_array_config');
			$amenitiesArr = array();
			if(isset($propertyDetails['amenities']) && $propertyDetails['amenities']!=''){
				$amenitiesArr = explode(',',$propertyDetails['amenities']);
			}
		?>
		<form id="amenitiesFrm" class="form-horizontal" method="post" action="properties/amenitiesEntry">
			<input type="hidden" id="amenitiesPropertyId" name="amenitiesPropertyId" value="<?php if(isset($propertyDetails['propertyId']) && $propertyDetails['propertyId']!=''){echo $propertyDetails['propertyId'];}else{echo '0';}?>" />
		
		<?php foreach($amenities_categories as $key=>$value){
		
			$activeFilterAmenitiesArr = filter_array($activeAmenitiesArr,$key,'catId');
		?>
			<div class="row" style="margin-bottom:20px;">
			<h4 style="font-weight:600; font-size:16px; "><?php echo $value['name'];?> &ndash;</h4>
			<?php foreach($activeFilterAmenitiesArr as $amenity){?>
				<div class="col-md-4">
					<label style="padding:5px;" for="amenityIds<?php echo $amenity['id'];?>"><input <?php if(in_array($amenity['id'],$amenitiesArr)){?> checked="checked"<?php } ?> type="checkbox" id="amenityIds<?php echo $amenity['id'];?>" name="amenityIds[]" value="<?php echo $amenity['id'];?>" /> &nbsp;<?php echo $amenity['name'];?></label>
				</div>
			<?php } ?>
			</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<button type="submit" id="amBtn" class="btn btn-primary" style="padding:5px 30px; margin-top:10px;">Save Changes</button>
			</div>
		</div>
		<div class="clearfix"></div>
		</form>
	
</div>
<div class="clearfix"></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#amenitiesFrm').validate({
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
			var form = $('#amenitiesFrm');
			var url = baseUrl+form.attr('action');
			var btnText = $('#amBtn').html();
			
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#amBtn').prop("disabled", true);
					$('#amBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location='<?php echo base_url().$this->config->item('admin_directory_name').'properties/manage/'.$propertyDetails['encryptedPropertyId'].'?tab_id=3';?>';
					}else{
						$('#basicInfoResDisplay').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#amBtn').prop("disabled", false);
						$('#amBtn').html(btnText);
					}
				},
				error: function(xhr, status, error_desc){
					$('#basicInfoResDisplay').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#amBtn').prop("disabled", false);
					$('#amBtn').html(btnText);
				}
			});		
			return false;
		}
	});
});
</script>
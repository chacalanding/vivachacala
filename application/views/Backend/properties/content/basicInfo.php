<div class="col-md-12">
	<div id="basicInfoResDisplay"></div>
	<input type="hidden" id="propertyId" name="propertyId" value="<?php if(isset($propertyDetails['propertyId']) && $propertyDetails['propertyId']!=''){echo $propertyDetails['propertyId'];}else{echo '0';}?>" />
	<input type="hidden" id="encryptedPropertyId" name="encryptedPropertyId" value="<?php if(isset($propertyDetails['encryptedPropertyId']) && $propertyDetails['encryptedPropertyId']!=''){echo $propertyDetails['encryptedPropertyId'];}else{echo '0';}?>" />
	<input type="hidden" id="propertyType" name="propertyType" value="<?php echo $propertyType;?>" />
</div>
 
	
<div class="col-md-7">
							
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="proName"> <?php echo $section_status_label;?> Name / Title *</label>
		<div class="col-sm-8">
			<input type="text" class="form-control required" id="proName" name="proName" value="<?php if(isset($propertyDetails['name']) && $propertyDetails['name']!=''){echo $propertyDetails['name'];}?>" autocomplete="off" />
		</div>
	</div>

	
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="categoryId">Category *</label>
		<div class="col-sm-8">
			 
				<?php 
				$assignCategoryIdsArr = array();
				if(isset($propertyDetails['categoryId']) && $propertyDetails['categoryId']!=''){
					$assignCategoryIdsArr = explode(',',$propertyDetails['categoryId']);
				}
				$categories = filter_array($setupMastersData,$propertyType,'section_status');
				foreach($categories as $val){ if($val['status']==0){?>
				<label style="display:block;" for="<?php echo $val['id'];?>"> <input <?php if(in_array($val['id'],$assignCategoryIdsArr)){ ?> checked="checked"<?php } ?> type="checkbox" id="<?php echo $val['id'];?>" name="categoryIds[]" value="<?php echo $val['id'];?>" /> &nbsp;<?php echo $val['name'];?></label>
				<?php } }?>
			 
		</div>
	</div>
	
	<?php if($propertyType==1){?>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="businessOwner"> <?php echo $section_status_label;?> Owner *</label>
		<div class="col-sm-8">
			<input type="text" class="form-control required" id="businessOwner" name="businessOwner" value="<?php if(isset($propertyDetails['businessOwner']) && $propertyDetails['businessOwner']!=''){echo $propertyDetails['businessOwner'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="businessOwnerEmail"> <?php echo $section_status_label;?> Owner Email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control email" id="businessOwnerEmail" name="businessOwnerEmail" value="<?php if(isset($propertyDetails['businessOwnerEmail']) && $propertyDetails['businessOwnerEmail']!=''){echo $propertyDetails['businessOwnerEmail'];}?>" autocomplete="off" />
		</div>
	</div>
		
	<?php }else{ if($propertyType==0){ ?>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="guests"> Guests (Upto) *</label>
		<div class="col-sm-8">
			<input type="number" class="form-control required" id="guests" name="guests" value="<?php if(isset($propertyDetails['guests']) && $propertyDetails['guests']!=''){echo $propertyDetails['guests'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="beds"> Beds *</label>
		<div class="col-sm-8">
			<input type="text" class="form-control required" id="beds" name="beds" value="<?php if(isset($propertyDetails['beds']) && $propertyDetails['beds']!=''){echo $propertyDetails['beds'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<?php } ?>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="bedrooms"> Bedrooms *</label>
		<div class="col-sm-8">
			<input type="number" class="form-control number required" id="bedrooms" name="bedrooms" value="<?php if(isset($propertyDetails['bedrooms']) && $propertyDetails['bedrooms']!=''){echo $propertyDetails['bedrooms'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="bathrooms"> Bathrooms *</label>
		<div class="col-sm-8">
			<input type="number" class="form-control number required" id="bathrooms" name="bathrooms" value="<?php if(isset($propertyDetails['bathrooms']) && $propertyDetails['bathrooms']!=''){echo $propertyDetails['bathrooms'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="avgPrice"> High Season / Unit Price *</label>
		<div class="col-sm-8">
			<input type="number" class="form-control number required" id="avgPrice" name="avgPrice" value="<?php if(isset($propertyDetails['avgPrice']) && $propertyDetails['avgPrice']!=''){echo $propertyDetails['avgPrice'];}?>" autocomplete="off" />
		</div>
	</div>
	<?php if($propertyType==0){?>
	 	
 	<div class="form-group">
		<label class="col-sm-4 control-label" for="lowSeason"> Low Season *</label>
		<div class="col-sm-8">
			<input type="number" class="form-control number required" id="lowSeason" name="lowSeason" value="<?php if(isset($propertyDetails['lowSeason']) && $propertyDetails['lowSeason']!=''){echo $propertyDetails['lowSeason'];}?>" autocomplete="off" />
		</div>
	</div>	
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="holidayPrice"> Holiday Price *</label>
		<div class="col-sm-8">
			<input type="number" class="form-control number required" id="holidayPrice" name="holidayPrice" value="<?php if(isset($propertyDetails['holidayPrice']) && $propertyDetails['holidayPrice']!=''){echo $propertyDetails['holidayPrice'];}?>" autocomplete="off" />
		</div>
	</div>	 
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="videoURL"> Video URL</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="videoURL" name="videoURL" value="<?php if(isset($propertyDetails['videoURL']) && $propertyDetails['videoURL']!=''){echo $propertyDetails['videoURL'];}?>" autocomplete="off" />
		</div>
	</div>
	<?php } ?>
	<?php } ?>
	
	<?php if($propertyType==2){ ?>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="isSold"> Is Sold *</label>
		<div class="col-sm-8">
			<select class="form-control required" id="isSold" name="isSold">
				<option value="">Select...</option>
				<option value="1" <?php if(isset($propertyDetails['isSold']) && $propertyDetails['isSold']==1){?> selected="selected"<?php } ?>>Yes</option>
				<option value="0" <?php if(isset($propertyDetails['isSold']) && $propertyDetails['isSold']==0){?> selected="selected"<?php } ?>>No</option>
			</select>			
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="reAge"> Age *</label>
		<div class="col-sm-8">
			<input type="number" class="form-control number required" id="reAge" name="reAge" value="<?php if(isset($propertyDetails['reAge']) && $propertyDetails['reAge']!=''){echo $propertyDetails['reAge'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="reView"> View *</label>
		<div class="col-sm-8">
			<input type="text" class="form-control required" id="reView" name="reView" value="<?php if(isset($propertyDetails['reView']) && $propertyDetails['reView']!=''){echo $propertyDetails['reView'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="reFurnished"> Furnished *</label>
		<div class="col-sm-8">
			<select class="form-control required" id="reFurnished" name="reFurnished">
				<option value="">Select...</option>
				<option value="1" <?php if(isset($propertyDetails['reFurnished']) && $propertyDetails['reFurnished']==1){?> selected="selected"<?php } ?>>Yes</option>
				<option value="0" <?php if(isset($propertyDetails['reFurnished']) && $propertyDetails['reFurnished']==0){?> selected="selected"<?php } ?>>No</option>
			</select>			
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="reParking"> Parking *</label>
		<div class="col-sm-8">
			<input type="text" class="form-control required" id="reParking" name="reParking" value="<?php if(isset($propertyDetails['reParking']) && $propertyDetails['reParking']!=''){echo $propertyDetails['reParking'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="reApproxLand"> Approx. Land *</label>
		<div class="col-sm-8">
			<input type="number" class="form-control number required" id="reApproxLand" name="reApproxLand" value="<?php if(isset($propertyDetails['reApproxLand']) && $propertyDetails['reApproxLand']!=''){echo $propertyDetails['reApproxLand'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="reApproxBuilding"> Approx. Building *</label>
		<div class="col-sm-8">
			<input type="number" class="form-control number required" id="reApproxBuilding" name="reApproxBuilding" value="<?php if(isset($propertyDetails['reApproxBuilding']) && $propertyDetails['reApproxBuilding']!=''){echo $propertyDetails['reApproxBuilding'];}?>" autocomplete="off" />
		</div>
	</div>
	
	<?php } ?>
	 
</div>

<div class="col-md-5">
	<div class="form-group">
		 
		<textarea id="proDesc" name="proDesc"><?php if(isset($propertyDetails['proDesc']) && $propertyDetails['proDesc']!=''){echo $propertyDetails['proDesc'];}?></textarea>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#proManageFrm').validate({
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
			var form = $('#proManageFrm');
			var url = baseUrl+form.attr('action');
			var btnText = $('#manageBtn').html();
			for(var instanceName in CKEDITOR.instances){
				CKEDITOR.instances[instanceName].updateElement();
			}
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#manageBtn').prop("disabled", true);
					$('#manageBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location=result_arr[1];
					}else{
						$('#basicInfoResDisplay').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#manageBtn').prop("disabled", false);
						$('#manageBtn').html(btnText);
					}
				},
				error: function(xhr, status, error_desc){
					$('#basicInfoResDisplay').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#manageBtn').prop("disabled", false);
					$('#manageBtn').html(btnText);
				}
			});		
			return false;
		}
	});
});
</script>
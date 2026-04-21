<div class="form-group">
	<label>Review By *</label>
	<input type="text" class="form-control required" id="reviewBy" name="reviewBy" value="<?php if(isset($reviewDetails['reviewBy']) && $reviewDetails['reviewBy']!=''){echo $reviewDetails['reviewBy'];}?>" autocomplete="off" />
</div>
<div class="form-group">
	<label>Message *</label>
	<textarea class="form-control required" name="reviewMsg" id="reviewMsg" rows="6"><?php if(isset($reviewDetails['message']) && $reviewDetails['message']!=''){echo $reviewDetails['message'];}?></textarea>
</div>
<div class="form-group">
	<label>Rating *</label>
	<select class="form-control required" id="reviewRating" name="reviewRating">
		<option value="">Select...</option>
		<?php for($r=0;$r<=5;$r++){ ?>
		<option value="<?php echo $r;?>" <?php if(isset($reviewDetails['rating']) && $reviewDetails['rating']==$r){?> selected="selected"<?php } ?>><?php echo $r;?></option>
		<?php } ?>
	</select>
</div>
<div class="form-group" style="margin-bottom:0;">
	<label>Location *</label>
	<input type="text" class="form-control required" id="location" name="location" value="<?php if(isset($reviewDetails['location']) && $reviewDetails['location']!=''){echo $reviewDetails['location'];}?>" autocomplete="off" />
</div>
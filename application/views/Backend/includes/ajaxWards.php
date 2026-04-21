<option value="">Select...</option>
<?php foreach($wards_data as $ward){?>
<option value="<?php echo $ward['id'];?>" <?php if(isset($selectedWardId) && $selectedWardId==$ward['id']){?> selected="selected"<?php } ?>><?php echo $this->config->item('wards_prefix').$ward['name'];?></option>
<?php } ?>
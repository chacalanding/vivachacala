<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 style="line-height:30px;" class="box-title">Organization : <?php echo $event_details->organizationName;?><br />
					Member : <?php echo $event_details->firstName.' '.$event_details->lastName.' &mdash; '.$event_details->email;?></h3>
				</div>
				
			<form class="" id="manageEventFrm" action="events/manage_einfo" method="post">
					
					<input type="hidden" id="h_base_url" name="h_base_url" value="<?php echo base_url().$this->config->item('admin_directory_name');?>" />
					<input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name');?>" />
 					<input type="hidden" id="h_organizationId" name="h_organizationId" value="<?php if(isset($event_details->organizationId) && $event_details->organizationId!='' && $event_details->organizationId>0){echo $event_details->organizationId;}else{echo '0';}?>" />
					<input type="hidden" id="h_memberId" name="h_memberId" value="<?php if(isset($event_details->memberId) && $event_details->memberId!='' && $event_details->memberId>0){echo $event_details->memberId;}else{echo '0';}?>" />
 					<input type="hidden" id="h_eventId" name="h_eventId" value="<?php if(isset($event_details->eventId) && $event_details->eventId!='' && $event_details->eventId>0){echo $event_details->eventId;}else{echo '0';}?>" />
					<?php $curTime = strtotime(date('Y-m-d, h:i A'));?>
					<input type="hidden" id="h_previous_event_sts" name="h_previous_event_sts" value="<?php if(isset($event_details->eventId) && $event_details->eventId!='' && $event_details->eventId>0){ if($event_details->eventTime<$curTime){echo 'yes';} }?>" />
				
 
					<div class="box-body" style="padding:20px;">
					
						<div class="row">
							<div id="result_display"></div>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="mb-3">
										<label for="eventTitle" class="control-label">Event Title</label>
										<input type="text" class="form-control required" id="eventTitle" name="eventTitle" placeholder="" autocomplete="off" value="<?php if(isset($event_details->eventTitle) && $event_details->eventTitle!=''){echo $event_details->eventTitle;}?>"  />
									</div>
								</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<div class="mb-3">
										<label for="eventType" class="control-label">Type of Event *</label>
										<?php $event_types = $this->config->item('event_types_array_config');?>
										<select class='form-control required' id='eventType' name='eventType'>
											<option value="">Select...</option>
											<?php foreach($event_types as $key => $value){?>
											<option value="<?php echo $key;?>" <?php if(isset($event_details->eventType) && $event_details->eventType==$key){?> selected="selected"<?php } ?>><?php echo $value['name'];?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="form-group">
									<div class="mb-3">
										<label for="eventLocation" class="control-label">Event Location *</label>
										<input type="text" class="form-control required" id="eventLocation" name="eventLocation" placeholder="" autocomplete="off" value="<?php if(isset($event_details->eventLocation) && $event_details->eventLocation!=''){echo $event_details->eventLocation;}?>"  />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">							
							<div class="col-lg-4">
								<div class="form-group">
									<div class="mb-3">
										<label for="eventDate" class="control-label">Date *</label>
										<input type="date" class="form-control required" id="eventDate" name="eventDate" placeholder="" autocomplete="off" value="<?php if(isset($event_details->eventDate) && $event_details->eventDate!=''){echo date('Y-m-d',$event_details->eventDate);}?>"  />
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<div class="mb-3">
										<label for="eventTime" class="control-label">Time *</label>
										<input type="time" class="form-control required" id="eventTime" name="eventTime" placeholder="" autocomplete="off" value="<?php if(isset($event_details->eventTime) && $event_details->eventTime!=''){echo date('H:i',$event_details->eventTime);}?>"  />
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<div class="mb-3">
										<label for="timeZone" class="control-label">Time Zone *</label>
										<input type="text" class="form-control required" id="timeZone" name="timeZone" placeholder="" autocomplete="off" value="<?php if(isset($event_details->timeZone) && $event_details->timeZone!=''){echo $event_details->timeZone;}?>"  />
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="row">
							
							<div class="col-lg-4">
								<div class="form-group">
									<div class="mb-3">
										<label for="costSts" class="control-label">Cost *</label>
										<select class='form-control required' id='costSts' name='costSts' onchange="return chkCostSts(this.value);">
											<option value="">Select...</option>
											<option value="0" <?php if(isset($event_details->costSts) && $event_details->costSts==0){?> selected="selected"<?php } ?>>Free</option>
											<option value="1" <?php if(isset($event_details->costSts) && $event_details->costSts==1){?> selected="selected"<?php } ?>>Paid</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-4" style="display: <?php if(isset($event_details->costSts) && $event_details->costSts==1){echo 'block';}else{echo 'none';}?>;" id="eCost">
								<div class="form-group">
									<div class="mb-3">
										<label for="eventCost" class="control-label">Add Cost *</label>
										<input type="number" class="form-control <?php if(isset($event_details->costSts) && $event_details->costSts==1){echo 'required';}?>" id="eventCost" name="eventCost" placeholder="" autocomplete="off" value="<?php if(isset($event_details->eventCost) && $event_details->eventCost!=''){echo $event_details->eventCost;}?>"  />
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<div class="mb-3">
										<label for="isStatus" class="control-label">Status *</label>
										<select class='form-control required' id='isStatus' name='isStatus'>
											<option value="0" <?php if(isset($event_details->isStatus) && $event_details->isStatus==0){?> selected="selected"<?php } ?>>Active</option>
											<option value="1" <?php if(isset($event_details->isStatus) && $event_details->isStatus==1){?> selected="selected"<?php } ?>>In-active</option>
										</select>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="mb-3">
										<label for="eventDesc" class="control-label">Description of Event *</label>
										<textarea style="height:150px;" class="form-control required" id="eventDesc" name="eventDesc"><?php if(isset($event_details->eventDesc) && $event_details->eventDesc!=''){echo $event_details->eventDesc;}?></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="mb-3">
										<label for="eventURL" class="control-label">URL Access / Registration</label>
										<input type="text" class="form-control" id="eventURL" name="eventURL" placeholder="" autocomplete="off" value="<?php if(isset($event_details->eventURL) && $event_details->eventURL!=''){echo $event_details->eventURL;}?>"  />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">   
							<div class="col-lg-4">              
								<div class="form-group">
									<label for="logo" class="control-label">Event Image</label>
									<div class="input-group">
										<input type="file" class="<?php //if(isset($event_details->eventImg) && $event_details->eventImg!=''){}else{echo 'required';}?>" id="eventImg" name="eventImg" onchange="readURL(this);" />
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-lg-4 mt-3 mb-2">
								<?php 
								if(isset($event_details->eventImg) && $event_details->eventImg!=''){
									$img = base_url().'assets/upload/events/'.$event_details->eventImg;
								}else{
									$img = '#';
								}
								?>
								<img id="blah" src="<?php echo $img;?>" class="img-fluid" alt="" />
							</div>
						</div>
						
						<?php if(isset($event_details->eventId) && $event_details->eventId!='' && $event_details->eventId>0){ 
						if($event_details->eventTime<$curTime){ ?>
						
						<div class="row" style="margin-top:10px;">
							<div class="col-lg-4">
								<div class="form-group">
									<div class="mb-3">
										<label for="showRecordSts" class="control-label">Recorded Status *</label>
										<select class='form-control required' id='showRecordSts' name='showRecordSts' onchange="return chkRecordedSts(this.value);">
											<option value="1" <?php if(isset($event_details->showRecordSts) && $event_details->showRecordSts==1){?> selected="selected"<?php } ?>>Yes</option>
											<option value="0" <?php if(isset($event_details->showRecordSts) && $event_details->showRecordSts==0){?> selected="selected"<?php } ?>>No</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row" style="display: <?php if(isset($event_details->showRecordSts) && $event_details->showRecordSts==1){echo 'block';}else{echo 'none';}?>;" id="recordFields">
							<div class="col-lg-4" >
								<div class="form-group">
									<div class="mb-3">
										<label for="recordDocType" class="control-label">Document Type *</label>
										<select class='form-control required' id='recordDocType' name='recordDocType' onchange="return chkDocType(this.value);">
											<option value="">Select...</option>
											<option value="1" <?php if(isset($event_details->recordDocType) && $event_details->recordDocType==1){?> selected="selected"<?php } ?>>Video URL</option>
											<option value="2" <?php if(isset($event_details->recordDocType) && $event_details->recordDocType==2){?> selected="selected"<?php } ?>>Upload Doc</option>
										</select>
									</div>
								</div>
							</div>
							
							
							<div class="col-lg-8" style="display:<?php if(isset($event_details->recordDocType) && $event_details->recordDocType==1){echo 'block';}else{echo 'none';}?>;" id="videoURLField">
								<div class="form-group">
									<div class="mb-3">
										<label for="videoURL" class="control-label">YouTube URL *</label>
										<input type="text" class="form-control <?php if(isset($event_details->recordDocType) && $event_details->recordDocType==1){echo 'required';}?>" id="videoURL" name="videoURL" placeholder="For Example - https://youtu.be/Y9ozt29tzgs" autocomplete="off" value="<?php if(isset($event_details->shortCode) && $event_details->shortCode!=''){echo 'https://youtu.be/'.$event_details->shortCode;}?>"  />
									</div>
								</div>
							</div>
							
							<div class="col-lg-4" style="display:<?php if(isset($event_details->recordDocType) && $event_details->recordDocType==2){echo 'block';}else{echo 'none';}?>;" id="upDocField">
								<div class="form-group">
									<div class="mb-3">
										<label for="upDoc" class="control-label">Upload Doc <small>(pdf, word, slides)</small></label>
										<input type="file" class="<?php //if(isset($event_details->eventImg) && $event_details->eventImg!=''){}else{echo 'required';}?>" id="upDoc" name="upDoc" />
									</div>
								</div>
							</div>
							
						</div>
						<?php } } ?>
 
					
					
					</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary" style="padding:5px 50px;" id="manageBtn">Update Now!</button>
				</div>
				</form>
			
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
function chkCostSts(val){
	if(val==1){
		$('#eCost').show();
		$('#eventCost').addClass('required');
	}else{
		$('#eCost').hide();
		$('#eventCost').removeClass('required');
	}
}
function chkRecordedSts(val){
	if(val==1){
		$('#recordFields').show();
		$('#recordDocType').addClass('required');
	}else{
		$('#recordFields').hide();
		$('#recordDocType').removeClass('required');
	}
}
function chkDocType(val){
	if(val==1){
		$('#videoURLField').show();
		$('#videoURL').addClass('required');
		
		$('#upDocField').hide();
		$('#upDoc').removeClass('required');
		
	}else if(val==2){
	
		$('#upDocField').show();
		$('#upDoc').addClass('required');
 	
		$('#videoURLField').hide();
		$('#videoURL').removeClass('required');
	}
}
$(document).ready(function(){
	$('#manageEventFrm').validate({
		ignore: [], 
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
		},
		success: function(element) {
			element.closest('.form-group').removeClass('has-error');
			element.remove();
		},
		submitHandler: function(form){
			var site_base_url = $('#h_base_url').val();
			var ajax_base_url = $('#h_ajax_base_url').val();
			var form = $('#manageEventFrm');
			var url = ajax_base_url+form.attr('action');
			var formData = new FormData($('#manageEventFrm').get(0));
			formData.append('eventImg', $('#eventImg')[0].files[0]);
			<?php if(isset($event_details->eventId) && $event_details->eventId!='' && $event_details->eventId>0){ 
			if($event_details->eventTime<$curTime){ ?>
			formData.append('upDoc', $('#upDoc')[0].files[0]);
			<?php } } ?>
			$.ajax({
				type: "POST",
				url: url,
				enctype: 'multipart/form-data',
				data: formData,
				processData: false,
				contentType: false,
				beforeSend: function(){
					$('#manageBtn').prop("disabled", true);
					$('#manageBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location=result_arr[1];
					}else{
						$('#result_display').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#manageBtn').prop("disabled", false);
						$('#manageBtn').html('Update Now!');
					}
				},
				error: function(xhr, status, error_desc){
					$('#result_display').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#manageBtn').prop("disabled", false);
					$('#manageBtn').html('Update Now!');
				}
			});		
			return false;
		}
	});
});
</script>

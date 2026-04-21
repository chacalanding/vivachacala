<main>
<section class="inner_page_top d-flex align-items-center justify-content-center" >
	<h1 class="text-light pt-5">My Profile</h1>
</section>
<section id="register" class="register pt-5 bg-light">
	<div class="container">
		<div class="row mt-5">
			<div class="reg_sec col-lg-8 mx-auto">
				<div class="title">
				<form class="form-horizontal res_form" id="profileFrm" action="profile/update_entry" method="post" enctype="multipart/form-data">
				
					<input type="hidden" id="h_base_url" name="h_base_url" value="<?php echo base_url();?>" />
					<input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url');?>" />
					<input type="hidden" id="h_memberId" name="h_memberId" value="<?php echo $session_details->memberId;?>" />
					<input type="hidden" id="h_primaryMember" name="h_primaryMember" value="<?php echo $session_details->primaryMember;?>" />
					<input type="hidden" id="h_organizationId" name="h_organizationId" value="<?php echo $organization_details->organizationId;?>" />
					
					<div class="row">
						<div id="result_display"></div>
						<?php if(isset($success_msg) && $success_msg!=''){?>
							<div class="alert alert-success"><?php echo $success_msg;?></div>
						<?php } ?>
					</div>
					
					<div class="row">
						<div class="col-lg-12 fw-500">
							<h5>Organization : <?php echo $organization_details->organizationName;?></h5>							
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-8 fw-500">
							<label class="control-label">Type of Account: <?php echo $this->config->item('organization_types_array_config')[$organization_details->organizationType]['name'];?></label><br />
							<label class="control-label">Type of Subcription : <?php echo $this->config->item('subscription_types_array_config')[$organization_details->subscriptionType]['name']; if($organization_details->organizationType==5){?> <a href="<?php echo base_url().'upgrade_plan';?>">(Upgrade Plan)</a> <?php } ?></label>
						</div>
						<?php $minLink = getPlanningMinLinksCh();
						if(isset($minLink) && $minLink!=''){?>
						<div class="col-lg-4 pull-right fw-500">
							<a href="<?php echo $minLink;?>" target="_blank">Latest Minutes</a>
						</div>
						<?php } ?>
							
					</div>
					
					<?php if($session_details->primaryMember==0){?>
					<div class="row my-3" id="cInsti" style="display:<?php if($organization_details->organizationType==4){echo 'block';}else{echo 'none';}?>;">		 
						<div class="col-lg-12"><label class="control-label">Institutional Account Members <i>(Click update after members are added. Remember you can only invite two additional members including you)</i></label></div>
						<div class="col-lg-12 mb-3">
							<textarea class="form-control" id="instAccountMembers" name="instAccountMembers" placeholder="You have selected an institutional account.  Please add the name and emails of the members of your team.  An account will be created and sent to them via email. If you do not know who you want to add at this time, you can add them later from your profile page." style="height:100px;"><?php echo $organization_details->instAccountMembers;?></textarea>
						</div>               
					</div>
					<?php } ?>
					
					<div class="row mt-3">
						<?php if($organization_details->organizationType==4){?><h5>Member &ndash;</h5><?php } ?>
						<div class="col-lg-6">
							<div class="form-group">
								<div class="mb-3">
									<label for="firstname" class="control-label">First Name *</label>
									<input type="text" class="form-control required" id="firstName" name="firstName" placeholder="First Name" autocomplete="off" value="<?php echo $session_details->firstName;?>" />
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<div class="mb-3">
									<label for="lastname" class="control-label">Last Name *</label>
									<input type="text" class="form-control required" id="lastName" name="lastName" placeholder="Last Name" autocomplete="off" value="<?php echo $session_details->lastName;?>"  />
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-6 mb-3">
							<div class="form-group">
								<label for="email" class="control-label">Email ID / Login ID *</label>
								<input type="text" class="form-control email required" id="emailAddress" name="emailAddress" placeholder="Email"  autocomplete="off" value="<?php echo $session_details->email;?>" />
							</div>
						</div>
						<div class="col-lg-6 mb-3">
							<div class="form-group">
								<label for="contactno" class="control-label">Contact # *</label>
								<input type="number" class="form-control required" id="contactNo" name="contactNo" placeholder="Contact Number" autocomplete="off" value="<?php echo $session_details->contactNo;?>" />
							</div>
						</div>
					</div>
										
					<!--<div class="row">
						<div class="form-group">
							<div class="mb-3">
								<label for="organizationName" class="control-label"><span id="htOrgName">Organization Name</span> *</label>
								<input type="text" class="form-control required" id="organizationName" name="organizationName" placeholder="" autocomplete="off" value="<?php //echo $session_details->organizationName;?>"  />
							</div>
						</div>
					</div>-->
					
					<div class="row" id="cBus" style="display: <?php if($organization_details->organizationType==2){echo 'block';}else{echo 'none';}?>;">		 
						<div class="col-lg-12"><label class="control-label">Would you like to be on the sponsor list?</label></div>
						<div class="col-lg-12 mb-3">
							<label class="optLbl"><input type="radio" <?php if($session_details->sponsorSts==1){?>checked="checked"<?php } ?> name="sponsorSts" id="sponsorSts" value="1"  /> &nbsp;Yes</label>
							<label class="optLbl"><input type="radio" <?php if($session_details->sponsorSts==0){?>checked="checked"<?php } ?> name="sponsorSts" id="sponsorSts" value="0"  /> &nbsp;No</label>
						</div>               
					</div>
					
					<div class="row">
						<div class="form-group">
							<div class="mb-3">
								<label for="address" class="control-label">What is your Role? *</label>
								<input type="text" class="form-control required" id="role" name="role" placeholder="i.e., assessment coordinator, director of..." autocomplete="off" value="<?php echo $session_details->role;?>"  />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 mb-3">
							<div class="form-group">
								<label for="address" class="control-label">Street Address *</label>
								<input type="text" class="form-control required" id="streetAddress" name="streetAddress" placeholder="Street Address" autocomplete="off" value="<?php echo $session_details->streetAddress;?>" />
							</div>
						</div>						
					</div>
					
					<div class="row">
						<div class="col-lg-3 mb-3">
							<div class="form-group">
								<label for="regionId" class="control-label">Region *</label>
								<select class="form-control required" id="regionId" name="regionId">
									<option value="">Select...</option>
									<?php $region=$this->config->item('region_array_config');
									foreach($region as $key => $value){ if($value['status']==0){?>
									<option value="<?php echo $key;?>" <?php if($session_details->regionId==$key){?> selected="selected"<?php } ?>><?php echo $value['name'];//.' &mdash; '.$value['more_details'].'&nbsp;&nbsp;';?></option>
									<?php } }?>
								</select>
							</div>
						</div>
						<div class="col-lg-3 mb-3">
							<div class="form-group">
								<label for="state" class="control-label">State *</label>
								<select class="form-control required" id="state" name="state">
									<option value="">Select...</option>
									<?php $usa_states_array_config=$this->config->item('usa_states_array_config');
									foreach($usa_states_array_config as $key => $value){ if($value['status']==0){?>
									<option value="<?php echo $value['name'];?>" <?php if($session_details->state==$value['name']){?> selected="selected"<?php } ?>><?php echo $value['name'];?></option>
									<?php } }?>
								</select>
							</div>
						</div>
						<div class="col-lg-3 mb-3">
							<div class="form-group">
								<label for="city" class="control-label">City *</label>
								<input type="text" class="form-control required" id="city" name="city" placeholder="City" autocomplete="off" value="<?php echo $session_details->city;?>" />
							</div>
						</div>
						<div class="col-lg-3 mb-3">
							<div class="form-group">
								<label for="zipCode" class="control-label">Zip Code *</label>
								<input type="text" class="form-control required" id="zipCode" name="zipCode" placeholder="Zip Code" autocomplete="off" value="<?php echo $session_details->zipCode;?>" />
							</div>
						</div>
					</div>
					
					<div class="row">                 
						<div class="form-group">
							<label for="logo" class="control-label">Upload Photo / Logo</label>
							<div class="input-group">
								<input type="file" class="" id="profilePic" name="profilePic" onchange="readURL(this);" />
							</div>
						</div>
						<div class="col-lg-4 mt-3 mb-2">
							<?php 
							if(isset($session_details->profilePic) && $session_details->profilePic!=''){
								$img = base_url().'assets/upload/photo/'.$session_details->profilePic;
							}else{
								$img = '#';
							}
							?>
							<img id="blah" src="<?php echo $img;?>" class="img-fluid" alt="" />
						</div>
					</div>
					
					<div class="row">
						<div class="form-group my-4">
							<label class="control-label"><input type="checkbox" <?php if($session_details->isDirectory==1){?>checked="checked"<?php } ?> name="isDirectory" id="isDirectory" value="1" /> &nbsp;I want my information to appear in the <strong>National Assessment Directory</strong> <i>(only subscribers will have access to the directory)</i>.</label>
						</div>
					</div>					 						 
					
					<div class="row">
						<div class="my-2">
							<button type="submit" id="updateBtn" class="btn btn-primary">Update</button>
						</div>
					</div>
	
				</form>				
			</div>
		 </div>
		</div>
	</div>
</section>							
</main>

<script type="text/javascript">
	$(document).ready(function(){
		$('#profileFrm').validate({
			ignore: [], 
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
			},
			success: function(element) {
				element.closest('.form-group').removeClass('has-error').addClass('has-success');
				element.remove();
			},
			errorElement: 'label',
			errorClass: 'error',
			errorPlacement: function (error, element) {
				if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio' || element.prop('type') === 'file') {
					error.insertAfter(element.parent());
				}else {
					error.insertAfter(element);
				}
			},
			submitHandler: function(form){								
				var site_base_url = $('#h_base_url').val();
				var ajax_base_url = $('#h_ajax_base_url').val();
				var form = $('#profileFrm'); 
				var url = ajax_base_url+form.attr('action');
				var formData = new FormData($('#profileFrm').get(0));
				formData.append('profilePic', $('#profilePic')[0].files[0]);				
				$.ajax({
					type: "POST",
					url: url,
					enctype: 'multipart/form-data',
					data: formData,
					processData: false,
					contentType: false,
					beforeSend: function(){
						$('#updateBtn').prop("disabled", true);
						$('#updateBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
					},
					success: function(result, status, xhr){
						var result_arr = result.split('||');
						if(result_arr[0]=='success'){
							$('#result_display').html('<div class="alert alert-success">Profile has been updated successfully!</div>');
							$("html, body").animate({ scrollTop: 0 }, "fast");
							$('#updateBtn').prop("disabled", false);
							$('#updateBtn').html('Update');	
						}else{						
							$('#result_display').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
							$("html, body").animate({ scrollTop: 0 }, "fast");
							$('#updateBtn').prop("disabled", false);
							$('#updateBtn').html('Update');				
						}
					},
					error: function(xhr, status, error_desc){				
						$('#result_display').html('<div class="alert alert-danger"><strong>Error : </strong> '+error_desc+'</div>');
						$("html, body").animate({ scrollTop: 0 }, "fast");
						$('#updateBtn').prop("disabled", false);
						$('#updateBtn').html('Update');
					}
				});
					
				return false;
			}
		});
		$.validator.addMethod("pwcheck", function(value) {
		   return /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,}$/.test(value);
		});
	});	
	
	function getselectValue(val) {
		if(val==2){
			$('#cBus').show();
			$('#htOrgName').html('Business Name');
		}else{
			if(val==1){
				$('#htOrgName').html('University Name');
			}else{
				$('#htOrgName').html('Organization Name');
			}			
			$('#cBus').hide();
		}
		$('.cUniPro').show();
	}
</script>

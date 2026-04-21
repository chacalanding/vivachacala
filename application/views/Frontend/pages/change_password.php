<main>
<section class="inner_page_top d-flex align-items-center justify-content-center" >
	<h1 class="text-light pt-5"><?php echo $title;?></h1>
</section>
<section id="register" class="register pt-5 bg-light">
	<div class="container">
		<div class="row mt-5">
			<div class="reg_sec col-lg-5 mx-auto">
				<div class="title">
				<form class="form-horizontal res_form" id="profileFrm" action="profile/change_password_entry" method="post">
				
					<input type="hidden" id="h_base_url" name="h_base_url" value="<?php echo base_url();?>" />
					<input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url');?>" />
					<input type="hidden" id="h_memberId" name="h_memberId" value="<?php echo $session_details->memberId;?>" />
					<input type="hidden" id="hidden_old_password" name="hidden_old_password" value="<?php echo $session_details->password_v;?>" />
					
					<div class="row">
						<div id="result_display"></div>
					</div>
										
					<div class="row">
						<div class="form-group">
							<div class="mb-3">
								<label for="old_password" class="control-label">Old Password *</label>
								<input type="password" class="form-control required" id="old_password" name="old_password" placeholder="" autocomplete="off" value=""  />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<div class="mb-3">
								<label for="new_password" class="control-label">New Password *</label>
								<input type="password" class="form-control required" minlength="8" id="new_password" name="new_password" placeholder="New Password" autocomplete="off" value="" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<div class="mb-3">
								<label for="confirm_password" class="control-label">Confirm Password *</label>
								<input type="password" class="form-control required" id="confirm_password" name="confirm_password" placeholder="" autocomplete="off" value=""  />
							</div>
						</div>
					</div>
										
					<div class="row">
						<div class="my-2">
							<button type="submit" id="updateBtn" class="btn btn-primary w-100">Update</button>
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
			rules: {
				new_password: {
					required: true,
					pwcheck: true,
					minlength: 8	
				},	
				confirm_password: {
					equalTo: "#new_password",
				}	
			},
			messages: {
				new_password: {
					required: "Password Required",
					pwcheck: "Password must contain at least one uppercase (A-Z) and one lowercase (a-z) and one (0-9) and one special character and at least eight characters.",
					minlength: "Password must contain at least eight characters."
				}
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
				var form = $('#profileFrm'); 
				var url = site_base_url+form.attr('action');				
				$.ajax({
					type: "POST",
					url: url,
					data: form.serialize(), // serializes the form's elements.
					beforeSend: function(){
						$('#updateBtn').prop("disabled", true);
						$('#updateBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
					},
					success: function(result, status, xhr){
						var result_arr = result.split('||');
						if(result_arr[0]=='success'){
							$('#result_display').html('<div class="alert alert-success">Your password has been updated successfully.</div>');
							$("html, body").animate({ scrollTop: 0 }, "fast");
							$('#updateBtn').prop("disabled", false);
							$('#updateBtn').html('Update');	
							$('#profileFrm')[0].reset();
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
</script>

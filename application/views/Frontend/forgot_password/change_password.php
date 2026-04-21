<main>
<section class="inner_page_top d-flex align-items-center justify-content-center" >
	<h1 class="text-light pt-4"><?php echo $page_title;?></h1>
</section>
<section id="register" class="register pt-5 bg-light">
<div d="content-wrap" class="container">
<div class="row mt-5">
			<div class="reg_sec col-lg-5 mx-auto">
				<div class="title">
					<form class="form-horizontal res_form" id="forgotPassFrm" action="forgot_password/recover_password_entry" method="post" enctype="multipart/form-data">
					
						<input type="hidden" id="h_base_url" name="h_base_url" value="<?php echo base_url();?>" />
						<input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url');?>" />
						<input type="hidden" id="encryptId" name="encryptId" value="<?php echo $encryptId;?>" />
						<input type="hidden" id="sha_forgot" name="sha_forgot" value="<?php echo $sha_forgot;?>" />
						
						<div class="row">
							<div id="result_display"></div>
						</div>
						
						<div class="row">
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label for="new_password" class="control-label">New Password *</label>
									<input type="password" name="new_password" id="new_password" class="form-control required" placeholder="New Password" />
								</div>
							</div>
						</div>
 				 	
						<div class="row">
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label for="confirm_password" class="control-label">Confirm Password *</label>
									<input type="password" name="confirm_password" id="confirm_password" class="form-control required" placeholder="Confirm Password" />
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="text-center my-2">
								<button type="submit" id="fpBtn" class="btn btn-primary w-100">Set Password</button>
							</div>
						</div>
						
						 				
					 				 
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
      </div>    
</div>
</section>
</main>
<script type="text/javascript">
$(document).ready(function(){
	$('#forgotPassFrm').validate({
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
		submitHandler: function(form){
			var site_base_url = $('#h_base_url').val();
			var ajax_base_url = $('#h_ajax_base_url').val();
			var form = $('#forgotPassFrm');
			var url = ajax_base_url+form.attr('action');
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#fpBtn').prop("disabled", true);
					$('#fpBtn').html('Please Wait &nbsp;<i class="fas fa-spinner"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						 window.location=result_arr[1];
					}else{
						$('#result_display').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#fpBtn').prop("disabled", false);
						$('#fpBtn').html('Set Password');
					}
					
				},
				error: function(xhr, status, error_desc){
					$('#result_display').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#fpBtn').prop("disabled", false);
					$('#fpBtn').html('Set Password');
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
<main>
<section class="inner_page_top d-flex align-items-center justify-content-center" >
	<h1 class="text-light pt-4"><?php echo $page_title;?></h1>
</section>
<section id="register" class="register pt-5 bg-light">
<div d="content-wrap" class="container">
<div class="row mt-5">
			<div class="reg_sec col-lg-5 mx-auto">
				<div class="title">
					<form class="form-horizontal res_form" id="forgotPassFrm" action="forgot_password/send_mail" method="post" enctype="multipart/form-data">
					
						<input type="hidden" id="h_base_url" name="h_base_url" value="<?php echo base_url();?>" />
						<input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url');?>" />
						
						<div class="row">
							<div id="result_display"></div>
						</div>
						
						<?php 
						if(isset($success_msg) && $success_msg){echo '<div class="row"><div class="alert alert-success">'.$success_msg.'</div></div>';}
						if(isset($error_msg) && $error_msg){echo '<div class="row"><div class="alert alert-danger">'.$error_msg.'</div></div>';}
						?>
						
						<h6 class="fph4">Enter the email addresss with which you registered your account below and we will send you recovery link to reset your password.</h6>
						
						<div class="row">
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<input type="text" class="form-control email required" id="email" name="email" placeholder="Email Address *"  autocomplete="off" value="" />
								</div>
							</div>
						</div>
 				 	
					<div class="row">
					<div class="form-group mb-2">
						<label class="control-label">Enter the text as you see in the image *</label>
						<div class="captacha_sec">
							<div class="col-md-6 captcha_text cfl"><?php echo $captcha_text;?></div>
							<div class="col-md-6 captcha_field cfl">
								<input name="capchta_word" id="capchta_word" class="form-control" value="<?php echo $captcha_text;?>" type="hidden">	            	
								<input name="enter_captcha_txt" id="enter_captcha_txt" class="form-control required" value="" type="text" autocomplete="off" />           	
							</div>
						</div>
					</div>	
					</div>
					
					<div class="row">
						<div class="text-center my-2">
							<button type="submit" id="fpBtn" class="btn btn-primary w-100">Send Reset Email</button>
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
						$('#result_display').html('<div class="alert alert-success">'+result_arr[1]+'</div>');
						$('#forgotPassFrm')[0].reset();
					}else{
						$('#result_display').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
					}
					$('#fpBtn').prop("disabled", false);
					$('#fpBtn').html('Send Reset Email');
				},
				error: function(xhr, status, error_desc){
					$('#result_display').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#fpBtn').prop("disabled", false);
					$('#fpBtn').html('Send Reset Email');
				}
			});		
			return false;
		}
	});
});
</script>
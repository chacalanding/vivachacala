<form role="form" id="login_frm" method="POST" action="<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'/home/check_admin_login';?>">
	<input type="hidden" id="h_base_url" name="h_base_url" value="<?php echo base_url();?>" />
	<?php $cookie_prefix=$this->config->item('cookie_prefix'); ?>		
	<div class="form-group has-feedback">
		<input type="text" name="username" class="form-control" placeholder="Username" value="<?php if(isset($_COOKIE[$cookie_prefix.'admin_username_cookie']) && $_COOKIE[$cookie_prefix.'admin_username_cookie']!=''){ echo $_COOKIE[$cookie_prefix.'admin_username_cookie']; } ?>">
		<span class="glyphicon glyphicon-user form-control-feedback"></span>
	</div>
	
	<div class="form-group has-feedback">
		<input type="password" name="password" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE[$cookie_prefix.'admin_password_cookie']) && $_COOKIE[$cookie_prefix.'admin_password_cookie']!=''){ echo $_COOKIE[$cookie_prefix.'admin_password_cookie']; } ?>">
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<button type="submit" class="btn btn-primary btn-block btn-flat" id="sign_btn" name="submit_login"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign-in</button>
		</div>
	</div>
	
	<div class="row" style="margin-top:5px;">
		<div class="col-md-5">
			<div class="checkbox icheck">
				<label><input type="checkbox" name="remember_me" <?php if(isset($_COOKIE[$cookie_prefix.'admin_username_cookie']) && $_COOKIE[$cookie_prefix.'admin_username_cookie']!=''){?> checked="checked" <?php } ?>> Remember Me</label>
			</div>
		</div>
		<!--<div class="col-md-7" style="margin-top:10px;">		  
			<a style="font-style: italic; font-weight: 600; float:right;" href="<?php //echo base_url().$this->config->item('admin_directory_name');?>/forgot_password"><i class="fa fa-key" aria-hidden="true"></i> I forgot my password</a>
		</div>-->
	</div>
	
</form>
<script type="text/javascript">
$(document).ready(function(){
	$('#login_frm').validate({
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
			var form = $('#login_frm');
			var url = form.attr('action');
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#sign_btn').html('Please Wait <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location=result_arr[1];
					}else{
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$('#login_err_msg').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#sign_btn').html('<i class="fa fa-sign-in" aria-hidden="true"></i> Sign-in');
					}
				},
				error: function(xhr, status, error_desc){				
					$("html, body").animate({ scrollTop: 0 }, "slow");
					$('#login_err_msg').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#sign_btn').html('<i class="fa fa-sign-in" aria-hidden="true"></i> Sign-in');
				}
			});		
			return false;
		}
	});
});
</script>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Sponsor Details</h3>
				</div>
				<form data-toggle="validator" id="frm" class="form-horizontal" id="frm" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="<?php echo $edit->id;?>"/>
					<div class="box-body">
					
					<p id="ret"><?php if(validation_errors() != false) { echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>'; } ?></p>
					<div class="col-md-11">
					        
					        <div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3"> First Name *</label>
								<div class="col-sm-8">
									<input type="text" class="form-control required" id="firstname" name="firstname" placeholder=" First Name" value="<?php echo $edit->firstname; ?>"  >
								</div>
							</div>
                           
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3"> Last Name*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control required" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $edit->lastname; ?>"  >
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">Type Of Origanization*</label>
								<div class="col-sm-8">
                                <select class="form-control required" id="organization" name="organization"> 
										<option value="">Select...</option>
										<option value="1" <?php if($edit->organization==1){?> selected="selected"<?php } ?>>University/College</option>
										<option value="2" <?php if($edit->organization==2){?> selected="selected"<?php } ?>>Business (paid)</option>
										<option value="3" <?php if($edit->organization==3){?> selected="selected"<?php } ?>>Non-profit </option>
									</select>
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">what is your role? *</label>
								<div class="col-sm-8">
									<input type="text" class="form-control required" id="role" name="role" placeholder="what is your role?" value="<?php echo $edit->role; ?>"  >
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">Address *</label>
								<div class="col-sm-8">
									<input type="text" class="form-control required" id="address" name="address" placeholder="Address" value="<?php echo $edit->address; ?>"  >
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">Email *</label>
								<div class="col-sm-8">
									<input type="text" class="form-control required" id="email" name="email" placeholder="Email" value="<?php echo $edit->email; ?>"  >
								</div>
							</div>                            
                            <div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">Password *</label>
								<div class="col-sm-8">
									<input type="text" class="form-control required" id="password" name="password" placeholder="Password" value="<?php echo $edit->password; ?>"  >
								</div>
							</div>                        
                            <div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">Contact Number *</label>
								<div class="col-sm-8">
									<input type="text" class="form-control required" id="contactno" name="contactno" placeholder="Contact Number" value="<?php echo $edit->contactno; ?>"  >
								</div>
							</div>
                            
                            <div class="form-group">
								<label class="col-sm-4 control-label">Status *</label>
								<div class="col-sm-8">
									
									<select class="form-control required" id="is_status" name="is_status"> 
										<option value="">Select...</option>
										<option value="0" <?php if($edit->is_status==0){?> selected="selected"<?php } ?>>Active</option>
										<option value="1" <?php if($edit->is_status==1){?> selected="selected"<?php } ?>>Inactive</option>
									</select>
								</div>
							 </div>

							 <div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3"> Upload Logo *</label>
								<div class="col-sm-8">
								  <input type="hidden"  name="old_logo" value="<?php echo $edit->logo;?>" />
								  <input type="file" class="form-control " id="logo" name="logo"  value="<?php echo $edit->logo;?>" >
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3"> </label>
								<div class="col-sm-8" style="float:left;">
									<img id="blah" src="<?php echo base_url('assets/upload/logo/'. $edit->logo); ?>" alt="" style=" max-width:300px; float:left; max-height:400px; margin:auto; display:block;" />
								</div>						
							</div>

						</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3"> </label>
								<div class="col-sm-8" style="float:left;">
									<img id="blah" src="#" alt="" style=" max-width:100%; float:left; max-height:100%; margin:auto; display:block;" />
								</div>						
							</div>
						</div>
					</div>
				<div class="box-footer">
				<button type="submit" class="btn btn-primary" name="submit">Update Now!</button>
				</div>
				</form>
			
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#blah').attr('src', e.target.result).width(200).height(200);
			$('#blah').show();
		};
		reader.readAsDataURL(input.files[0]);
	}
}
$("frm").submit(function(event){
	event.preventDefault();
	conslole.log('hello');
        $.ajax({
		            url:"<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'sponsor/update';?>",
		            data: $("#frm").serialize(),
		            type: "post",
		            dataType: 'json',
		            success: function(response){
							window.location = "<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'sponsor';?>"		
							return false;		
				}, 
          });
    });
</script>

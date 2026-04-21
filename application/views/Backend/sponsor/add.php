<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Sponsor's Details</h3>
                </div>
                <form data-toggle="validator" id="frm" class="form-horizontal" id="frm" method="post" action="<?php echo $this->config->item('ajax_base_url') . $this->config->item('admin_directory_name') . 'sponsor/create_entry'; ?>" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value=">" />
                    <div class="box-body">

                        <p id="ret"><?php if (validation_errors() != false) {
                                        echo '<div class="alert alert-dismissable alert-danger"><small>' . validation_errors() . '</small></div>';
                                    } ?></p>
                        <div class="col-md-11">

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3"> First Name *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="firstname" name="firstname" placeholder=" First Name" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3"> Last Name*</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="lastname" name="lastname" placeholder="Last Name" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">Type Of Origanization*</label>
                                <div class="col-sm-8">
                                    <select class="form-control required" id="organization" name="organization">
                                        <option value="">Select...</option>
                                        <option value="1" disabled>University/College</option>
                                        <option value="2">Business (paid)</option>
                                        <option value="3" disabled>Non-profit </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">what is your role? *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="role" name="role" placeholder="what is your role?" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">Address *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="address" name="address" placeholder="Address" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">Email *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="email" name="email" placeholder="Email" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">Password *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="password" name="password" placeholder="Password" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">Contact Number *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="contactno" name="contactno" placeholder="Contact Number" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3"> Upload Logo *</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control " id="logo" name="logo" value="">
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
                <button type="submit" class="btn btn-primary" name="submit">Add Now!</button>
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
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result).width(200).height(200);
                $('#blah').show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }





    // $("frm").submit(function(event){
    //     event.preventDefault();
    //     $.ajax({
	// 	            url:$(this).attr('action'),
	// 	            data: $("#frm").serialize(),
	// 	            type: "post",
	// 	            dataType: 'json',
	// 	            success: function(response){
	// 						window.location = "<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'sponsor';?>"		
	// 						return false;		
	// 			}, 
    //       });
    // });
</script>
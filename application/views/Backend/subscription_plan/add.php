<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Details</h3>
                </div>
                <form data-toggle="validator" id="addFrm" class="form-horizontal" method="post" action="subscription_plan/create_entry" >

                <input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url') . $this->config->item('admin_directory_name'); ?>" />


                    <div class="box-body">
                        <div class="col-md-11">

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3"> Plan Title *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="name" name="name" placeholder="Plan Title" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">Cost *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="cost" name="cost" placeholder="Cost" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">Package Fee Text *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="package" name="package" placeholder="Package Fee Text" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">Package Details *</label>
                                <div class="col-sm-8">
                                    <!-- <input type="text" class="form-control required" id="package_details" name="package_details" placeholder="Package Details" value=""> -->
                                    <textarea class="form-control required" name="package_details" id="package_details" row="3" placeholder="Package Details" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="addBtn" class="btn btn-primary" name="submit">Add Now!</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('#addFrm').validate({
            ignore: [],
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                element.closest('.form-group').removeClass('has-error').addClass('has-success');
                element.remove();
            },
            submitHandler: function(form) {
                var ajax_base_url = $('#h_ajax_base_url').val();
                var form = $('#addFrm');
                var url = ajax_base_url + form.attr('action');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    beforeSend: function() {
                        $('#addBtn').prop("disabled", true);
                        $('#addBtn').html('Please Wait &nbsp;<i class="fas fa-spinner"></i>');
                    },
                    success: function(result, status, xhr) { //alert(result);
                        var result_arr = result.split('||')
                        if (result_arr[0] == 'success') {
                            window.location = result_arr[1];
                        } else {
                            $('#result_display').html('<div class="alert alert-danger">' + result_arr[1] + '</div>');
                            $('#addBtn').prop("disabled", false);
                            $('#addBtn').html('Add Now!');
                        }
                    },
                    error: function(xhr, status, error_desc) {
                        $('#result_display').html('<div class="alert alert-danger">' + error_desc + '</div>');
                        $('#addBtn').prop("disabled", false);
                        $('#addBtn').html('Add Now!');
                    }
                });
                return false;
            }
        });
    });
</script>
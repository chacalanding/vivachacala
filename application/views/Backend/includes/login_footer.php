</div>
</div>
<br><br> 
<script src="<?php echo base_url();?>assets/backend/plugins/iCheck/icheck.min.js"></script>
<script>
$(function(){
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
	});
	$('#frm').validate({
		ignore: [], 
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
		},
		success: function(element) {
			element.closest('.form-group').removeClass('has-error').addClass('has-success');
			element.remove();
		},rules: {
			new_password: {
				required: true,			
			},			
			confirm_password: {
				equalTo: "#new_password",
			}			
		}
	}); 
});   
</script> 
</body>
</html>
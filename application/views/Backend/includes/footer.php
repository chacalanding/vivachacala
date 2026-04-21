</div>
<footer class="main-footer">
	Copyright &copy; <?php echo date('Y');?> <a href="#" class="fmc"><?php echo $this->config->item('project_name_page_first');//.' '.$this->config->item('project_name_page_second');?></a> &mdash; All rights reserved.
</footer>
</div>
<script src="<?php echo base_url(); ?>assets/backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/backend/plugins/iCheck/icheck.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/backend/plugins/fastclick/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="<?php //echo base_url(); ?>assets/backend/dist/js/demo.js"></script> -->
<script src="<?php echo base_url() ?>assets/backend/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
$("#modal-container-666931").on('hidden.bs.modal', function(e){window.location.reload(); });
function readURL(input){
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#blah').attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
function readURL1(input){
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#blah1').attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
$(document).ready(function() {
	$('#Date2').datepicker({
		startDate: new Date(),
		format: "dd/mm/yyyy",
		autoclose: true,
		todayHighlight: true		
	});	
	
	$('#Date1').datepicker({
		format: "dd/mm/yyyy",
		autoclose: true,
		todayHighlight: true
	});
	
	$('#Date3').datepicker({
		format: "dd/mm/yyyy",
		autoclose: true,
		todayHighlight: true
	});
	
	$('#Date4').datepicker({
		format: "dd/mm/yyyy",
		autoclose: true,
		todayHighlight: true
	});
	
	$('#fromDate').datepicker({
		format: "dd/mm/yyyy",
		autoclose: true,
		todayHighlight: true
	});
	
	$('#toDate').datepicker({
		format: "dd/mm/yyyy",
		autoclose: true,
		todayHighlight: true
	});
	
	$('#custFromDate').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		todayHighlight: true
	});
	
	$('#cusToDate').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		todayHighlight: true
	});
	
	// Reset the form
	$('#resetButton').on('click', function() {$("#frm")[0].reset();	})
});
 
$(function(){
  
	$('#frm').validate({
		ignore: [], 
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
		},
		success: function(element) {
			element.closest('.form-group').removeClass('has-error').addClass('has-success');
			element.remove();
		}
	});  
	
    $('#table_recordtbl').DataTable({
      "paging": true,
	  "pageLength": 25,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
	
  	if($('#editor').length > 0){
    	CKEDITOR.replace( 'editor',{height: '300px',}); 
	}
	
	if($('#proDesc').length > 0){
    	CKEDITOR.replace( 'proDesc',{height: '225px',}); 
	}
	
	$('.datepicker').datepicker( {autoclose: true, format: 'dd-mm-yyyy'} );
	 
});
</script>  
</body>
</html>
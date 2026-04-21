<form class="search_form" id="rentalSearchFrm" action="<?php echo base_url().'rental';?>" method="GET">
	<input type="text" autocomplete="off" class="form-control" name="checkIn" id="checkIn" value="<?php if(isset($_GET['checkIn']) && $_GET['checkIn']!=''){echo $_GET['checkIn'];}?>" placeholder="Check In" />
	<input type="text" autocomplete="off" class="form-control" value="<?php if(isset($_GET['checkOut']) && $_GET['checkOut']!=''){echo $_GET['checkOut'];}?>" name="checkOut" id="checkOut" placeholder="Check Out"/>
	<select class="form-select" aria-label="Guests" id="guest" name="guest">
		<option value="">Guests</option>
		<?php for($g=1;$g<=24;$g++){?>
		<option value="<?php echo $g;?>" <?php if(isset($_GET['guest']) && $_GET['guest']!='' && $_GET['guest']==$g){?> selected="selected"<?php } ?>><?php echo $g;?></option>
		<?php } ?>
	</select>
	<select class="form-select" aria-label="categoryId" id="cId" name="cId">
		<option value="">All</option>
		<?php $categories = filter_array($setupMastersData,$propertyType,'section_status');
				foreach($categories as $val){ if($val['status']==0){?>
				<option  value="<?php echo $val['id'];?>" <?php if(isset($_GET['cId']) && $_GET['cId']!='' && $_GET['cId']==$val['id']){?> selected="selected"<?php } ?>><?php echo $val['name'];?></option>
				<?php } }?>
	</select>
	<div class="ts_btn_div"><button type="submit" class="vc_btn">search <i data-feather="search"></i></button></div>
</form>

<script type="text/javascript">
$(document).ready(function() {
	$('#rentalSearchFrm').validate({
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
			if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
				error.insertAfter(element.parent().parent());
			}else {
				error.insertAfter(element);
			}
		}
	});
	var date = new Date();
	 
	/*$('#checkIn').datepicker({
		format: "mm/dd/yyyy",
		autoclose: true,
		startDate: date
	}).on('change', function(){
        $('#checkOut').datepicker('show');
    });	
	
	$('#checkOut').datepicker({
		format: "mm/dd/yyyy",
		autoclose: true,
		startDate: date
	});*/
	var date = new Date();
	
	$("#checkIn").datepicker({
	  format: "mm/dd/yyyy",
	  autoclose: true,
	  startDate: date
	}).on('changeDate', function (selected) {
		var startDate = new Date(selected.date.valueOf());
		$('#checkOut').datepicker('setStartDate', startDate);
		$('#checkOut').datepicker('show');
	}).on('clearDate', function (selected) {
		$('#checkOut').datepicker('setStartDate', null);
		$('#checkOut').datepicker('show');
	});
	
	$("#checkOut").datepicker({
	   format: "mm/dd/yyyy",
	   autoclose: true,
	   startDate: date
	});

});
</script>
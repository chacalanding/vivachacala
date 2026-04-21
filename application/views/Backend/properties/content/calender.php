<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/pg-calendar-master/dist/css/pignose.calendar.css" /> 
<script type="text/javascript" src="<?php echo base_url();?>assets/pg-calendar-master/demo/js/moment.latest.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/pg-calendar-master/dist/js/pignose.calendar.js"></script>

<?php
//echo strtotime(date('m/d/Y'));die; 
if(count($highlight_date)>0){
	foreach($highlight_date as $row){
		$highlight_dates[] = "'".date('Y-m-d',$row->reg_date)."'";
	}
	$show_highlighted_dates =  implode(',',$highlight_dates);
}else{
	$show_highlighted_dates = '';
}
?>

<script type="text/javascript">
	function onSelectHandler(date, context) {
		if (date[0] !== null) {
		 var text = date[0].format('YYYY-MM-DD');
		}
		window.location='<?php echo base_url().$this->config->item('admin_directory_name');?>properties/update_calender?date='+text+'&propertyId=<?php echo $propertyDetails['propertyId'];?>';
	}
  
	$(function () {
		$('.calendar').pignoseCalendar({
			<?php if(isset($show_highlighted_dates) && $show_highlighted_dates!=''){	?>
 				disabledDates: [<?php echo $show_highlighted_dates;?>],
 			<?php } ?>
		select: onSelectHandler,
		nearMonths: 1,
	});
	
	   $('.toggle-calendar').pignoseCalendar({
        toggle: true,
		<?php if(isset($show_highlighted_dates) && $show_highlighted_dates!=''){	?>
			disabledDates: [<?php echo $show_highlighted_dates;?>],
			//enabledDates: [<?php echo $show_highlighted_dates;?>],
		<?php } ?>
		
        click: function(event, context) {
			var $this = $(this);
			//alert('Calendar information');
    	},
		/* scheduleOptions: {
          colors: {
            holiday: '#2fabb7',
            seminar: '#5c6270',
            meetup: '#ef8080'
          }
        },
        schedules: [{
          name: 'holiday',
          date: '2017-08-01'
        }, {
          name: 'holiday',
          date: '2017-08-25'
        }, {
          name: 'holiday',
          date: '2017-08-05',
        }],*/
		select: function (date, context) {
		
 		  // alert(console.log(context)); 
          var message = `<h4>Selected Booking Dates</h4><form method="post" action="<?php echo base_url().$this->config->item('admin_directory_name');?>properties/updateCalender">
							   <div class="active-dates"></div><input type="hidden" name="hidden_selected_dates" id="hidden_selected_dates" value="" /><input type="hidden" name="hidden_propertyId" value="<?php echo $propertyDetails['propertyId'];?>" /><input type="hidden" name="hidden_encryptedPropertyId" value="<?php if(isset($propertyDetails['encryptedPropertyId']) && $propertyDetails['encryptedPropertyId']!=''){echo $propertyDetails['encryptedPropertyId'];}else{echo '0';}?>" /><span id="loader_img"></span><input type="submit" class="btn btn-primary" name="booked_date" id="booked_date" style="display:none; margin:2px;" value="Book Dates" /><input type="submit" class="btn btn-danger" name="removed_date" id="removed_date" style="display:none;margin:2px;" value="Remove Dates" onclick="return confirm('Are you sure delete booking date?');" /></form>`;
 							   
			var $target = context.calendar.parent().next().show().html(message);
			var new_array=[];
			var $i=0;
          for (var idx in context.storage.activeDates) {//alert(context);
            var date = context.storage.activeDates[idx];
            if (typeof date !== 'string') {
              continue;
            }
		 	if($i==0){
			
				$('.alert-success').hide();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url().$this->config->item('admin_directory_name');?>properties/ajaxCheckBookedDate?pId=<?php echo $propertyDetails['propertyId'];?>&chkDate='+date,
					beforeSend: function() {
						$('#loader_img').html('Please Wait <i class="fa fa-spinner fa-spin"></i>');
					},
					success: function(result){
						if(result==0){
							$('#booked_date').show();
							$('#removed_date').hide();
						}else{
							$('#removed_date').show();
							$('#booked_date').hide();
						}
						$('#loader_img').html('');
					}
				});
				
			}
			
			new_array.push(date);
            $target.find('.active-dates').append('<span class="ui label default">' + date + '</span>');
			$i++;
          }
		  $('#hidden_selected_dates').val(new_array);
		  
        }
      });

	});
	
function datesBooking(val){
	if(val==1){
		$('#booking_custom').show();
		$('#booking_calenderp').hide();
		$('#icalImport').hide();
	}else if(val==2){
		$('#booking_custom').hide();
		$('#booking_calenderp').hide();
		$('#icalImport').show();
	}else{
		$('#booking_custom').hide();
		$('#icalImport').hide();
		$('#booking_calenderp').show();
	}
}
</script>


<div class="row" style="margin-bottom:20px;">
 	<div class="col-md-3">
		<button type="button" onclick="return datesBooking('0');" class="btn btn-default" style="width:100%;">Calender Booking</button>
	</div>
	<div class="col-md-3">
		<button type="button" onclick="return datesBooking('1');" class="btn btn-default" style="width:100%;">Custom Dates Booking</button>
	</div>
	<div class="col-md-3">
		<button type="button" onclick="return datesBooking('2');" class="btn btn-default" style="width:100%;">Import Ical</button>
	</div>
</div>

<div id="booking_custom" style="display:none;">
	<form id="datesBookingFrm" method="post" action="properties/datesBookingEntry">
		
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
		<input type="hidden" id="calBkPropertyId" name="calBkPropertyId" value="<?php if(isset($propertyDetails['propertyId']) && $propertyDetails['propertyId']!=''){echo $propertyDetails['propertyId'];}else{echo '0';}?>" />
		
		<div id="clBkResDisplay"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Book From *</label>
				<input type="text" id="custFromDate" name="custFromDate" value="" class="form-control required" autocomplete="off" />
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Book To *</label>
				<input type="text" id="cusToDate" name="cusToDate" value="" autocomplete="off" class="form-control required" />
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<button type="submit" id="customDateBkBtn" class="btn btn-primary" style="padding:5px 30px; margin-top:10px;">Save Changes</button>
		</div>
	</div>
	</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#datesBookingFrm').validate({
		ignore: [], 
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
		},
		success: function(element) {
			element.closest('.form-group').removeClass('has-error');
			element.remove();
		},
		submitHandler: function(form){
			var baseUrl = $('#hBaseUrl').val();
			var form = $('#datesBookingFrm');
			var url = baseUrl+form.attr('action');
			var btnText = $('#customDateBkBtn').html();
			
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#customDateBkBtn').prop("disabled", true);
					$('#customDateBkBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location='<?php echo base_url().$this->config->item('admin_directory_name').'properties/manage/'.$propertyDetails['encryptedPropertyId'].'?tab_id=5';?>';
					}else{
						$('#clBkResDisplay').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#customDateBkBtn').prop("disabled", false);
						$('#customDateBkBtn').html(btnText);
					}
				},
				error: function(xhr, status, error_desc){
					$('#clBkResDisplay').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#customDateBkBtn').prop("disabled", false);
					$('#customDateBkBtn').html(btnText);
				}
			});		
			return false;
		}
	});
});
</script>

<div class="row" id="booking_calenderp">
	<div class="col-md-12">
		<div class="booking_indicators">
			 <div class="indi_box"><span class="available_status"></span> Available Dates</div>
			 <div class="indi_box"><span class="booked_status"></span> Booked Dates</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-1"></div>
	<div class="toggle-calendar col-md-5 row" ></div> 
	<div class="date_box col-md-4"><h4>Please select the dates!</h4></div> 
	<div class="col-md-1"></div>
	<div class="clearfix"></div>

</div>


<div id="icalImport" style="display:none; padding:0 30px;">
	<form id="uploadIcalFrm" method="post" action="properties/importIcalCalenderEntry" enctype="multipart/form-data">
		
	 <input type="hidden" id="calImportPropertyId" name="calImportPropertyId" value="<?php if(isset($propertyDetails['propertyId']) && $propertyDetails['propertyId']!=''){echo $propertyDetails['propertyId'];}else{echo '0';}?>" />	
	<div class="row">
		<h4 style="font-weight:600; margin-bottom:20px;">Sync your calendar FROM another calendar for <label><?php echo $propertyDetails['name'];?></label> property only!</h4>
		<div class="col-md-12">
			
			<div id="clUlpResDisplay"></div>
			<!--<div class="form-group">
				<label>Upload .ics File *</label>
				<input type="file" id="uploadIcal" name="uploadIcal" class="required" />
			</div>-->
			
			<div class="form-group">
				<label>iCal Feed URL - 1 *</label>
				<input type="text" id="icalFeedUrlOne" name="icalFeedUrlOne" class="form-control required" value="" autocomplete="off" />
			</div>
			
			<div class="form-group">
				<label>iCal Feed URL - 2</label>
				<input type="text" id="icalFeedUrlTwo" name="icalFeedUrlTwo" class="form-control" autocomplete="off" value="" />
			</div>
			
			<div class="form-group">
				<label>iCal Feed URL - 3</label>
				<input type="text" id="icalFeedUrlThree" name="icalFeedUrlThree" class="form-control" autocomplete="off" value="" />
			</div>			
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<button type="submit" id="importBkBtn" class="btn btn-primary" style="padding:5px 30px;">Synchronize Now</button>
		</div>
	</div>
	</form>	
	<hr />
	<div class="row">
		<h4 style="font-weight:600; margin-bottom:20px;">Sync your calendar TO another calendar or website</h4>
		<?php $exportCalLink = base_url().'export/calendar/'.$propertyDetails['slug'];?>
		<div class="col-md-9">			
			
			<input type="text" readonly="" class="form-control" value="<?php echo $exportCalLink;?>" />
				 			
		</div>
		<div class="col-md-3"><a style="padding:5px 20px; font-size:16px; color:#555;" href="<?php echo $exportCalLink;?>" class="btn btn-primary">Download</a>		</div>
	</div>	
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#uploadIcalFrm').validate({
		ignore: [], 
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
		},
		success: function(element) {
			element.closest('.form-group').removeClass('has-error');
			element.remove();
		},
		submitHandler: function(form){
			var baseUrl = $('#hBaseUrl').val();
 			var btnText = $('#importBkBtn').html();
 			
			var form = $('#uploadIcalFrm');
			var url = baseUrl+form.attr('action');
			var formData = new FormData($('#uploadIcalFrm').get(0));
			//formData.append('uploadIcal', $('#uploadIcal')[0].files[0]);
			
			$.ajax({
				type: "POST",
				url: url,
				enctype: 'multipart/form-data',
				data: formData,
				processData: false,
				contentType: false,
				beforeSend: function(){
					$('#importBkBtn').prop("disabled", true);
					$('#importBkBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					if(result=='success'){
						window.location='<?php echo base_url().$this->config->item('admin_directory_name').'properties/manage/'.$propertyDetails['encryptedPropertyId'].'?tab_id=5';?>';
					}else{
						$('#clUlpResDisplay').html('<div class="alert alert-danger">'+result+'</div>');
						$('#importBkBtn').prop("disabled", false);
						$('#importBkBtn').html(btnText);
					}
				},
				error: function(xhr, status, error_desc){
					$('#clUlpResDisplay').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#importBkBtn').prop("disabled", false);
					$('#importBkBtn').html(btnText);
				}
			});		
			return false;
		}
	});
});
</script>
<script type="text/javascript">
function delete_entry(val, slug) {
	if (val != "") {
		var r = confirm("Are you sure want to delete it!");
		if (r == true) {
			window.location = "<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'inquiries/deleteInquiry?inquiryId=';?>"+val+"&slug="+slug;
		}
	}
}
function update_toggle_swtich_values(propertyId,column_name){
	if(propertyId>0){
		var checkstatus=$('#toggle-event-'+column_name+propertyId).prop('checked');
		if(checkstatus == true){
			var status=0;		
		}else{
			var status=1;		 
		}	
		$.ajax({url: "<?php echo base_url(). $this->config->item('admin_directory_name');?>properties/update_account_status?propertyId="+propertyId+"&column_name="+column_name+"&status="+status, 
			beforeSend: function(){ 
				$('#spinner_'+column_name+'_'+propertyId).html('<i class="fa fa-spinner fa-spin"></i>');
			},
			success: function(result){
				if(result=='success'){
					$('#spinner_'+column_name+'_'+propertyId).html('');
				}
			}
		});
	} 
}
</script>
<style>
.table small {display: block;margin-left: 5px; font-size: 95%;margin-top: 2px; font-weight:600;}
.mstus {border: 1px dashed;padding: 1px 10px;margin-bottom: 0;font-size: 14px;}
.accepted {color: green;}
.rejected {color: #a94442;}
.table .btn-group-sm>.btn, .btn-sm {font-size:13px;}
</style>

<section class="content">
	<div class="row">
		<div class="col-md-12"> 
			<div class="box">   
				  
					<div class="box-body row">
						 
						<div class="col-xs-12 table-responsive">
							<table class="table table-striped " id="table_recordtbl">
								<thead>
									<tr>
										<th width="2%">#</th>
										<th>Full Name</th>
										<th>Contact Info.</th>
										<th><?php echo $section_status_label;?></th>
										
										<?php if($propertyType==0){?>
										<th>Check In</th>
										<th>Check Out</th>
										<?php } ?>
										<th>Message</th>
										<?php if($propertyType>0){?>
 										<th>Inq. On</th>
										<?php } ?>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($inquiriesDataArr as $row) { ?>
										<tr>
											<td><?php echo $i;?></td>
											<td style="font-weight:600;"><?php echo ucwords($row['name']); ?> <?php if($propertyType==0){?><small><?php if(isset($row['enquiryTime']) && $row['enquiryTime']!='' && $row['enquiryTime']>0){echo date('m/d/Y',$row['enquiryTime']);}?> </small> <?php } ?></td>
											<td><?php echo $row['email']; ?> <small><?php echo $row['phoneNo']; ?></small></td>
											<td><?php echo $row['proName']; ?>
											
											<?php if($row['adults']>0){?><small><?php echo 'Adult: '.$row['adults']; ?></small><?php } ?>
											<?php if($row['children']>0){?><small><?php echo 'Children: '.$row['children']; ?></small><?php } ?>
											
											
											</td>
											<?php if($propertyType==0){?>
											<td><?php if(isset($row['checkInDate']) && $row['checkInDate']!='' && $row['checkInDate']>0){echo date('m/d/Y',$row['checkInDate']); }else{echo '&ndash;';}?></td>
											<td><?php if(isset($row['checkOutDate']) && $row['checkOutDate']!='' && $row['checkOutDate']>0){echo date('m/d/Y',$row['checkOutDate']);}else{echo '&ndash;';}?></td>
											<?php } ?>
											<td><?php echo $row['message']; ?></td>
											<?php if($propertyType>0){?>
											<td><?php if(isset($row['enquiryTime']) && $row['enquiryTime']!='' && $row['enquiryTime']>0){echo date('m/d/Y',$row['enquiryTime']);?> <small><?php echo date('h:i A',$row['enquiryTime']);?></small><?php }else{echo '&ndash;';}?></td>
											<?php } ?>
											 
											<td nowrap="nowrap">
												
												<a style="margin-left:3px;" onclick="return delete_entry('<?php echo $row['inquiryId'];?>','<?php echo $section_status_slug;?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php $i++;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
<div class="modal fade" tabindex="-1" role="dialog" id="notification_send">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="display:inline-block">Notification Send</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form id="sendNotificationFrm" method="post" action="users/send_notification">
			<input type="hidden" id="hBaseUrl" name="hBaseUrl" value="<?php echo base_url().$this->config->item('admin_directory_name');?>" />
			<input type="hidden" id="hAjaxUrl" name="hAjaxUrl" value="<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name');?>" />
			<input type="hidden" id="hSelectedIds" name="hSelectedIds" value="" />
			<div class="modal-body" id="message_inner">
				 
					<div id="resMsg"></div>
					<div class="form-group">
						<label>Subject *</label>
						<input type="text" class="form-control required" id="subjectNoti" name="subjectNoti" value="" autocomplete="off" />
					</div>
					<div class="form-group" style="margin-bottom:0;">
						<label>Message *</label>
						<textarea name="MessageNoti" id="editor"></textarea>
					</div>
 			</div> 
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit" id="submitBtn" style="padding:5px 30px;">Send Now!</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding:5px 30px;">Close</button>
			</div> 
		</form>
<script>
$(document).ready(function() {
	$('#sendNotificationFrm').validate({
		ignore: [], 
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
		},
		success: function(element) {
			element.closest('.form-group').removeClass('has-error');
			element.remove();
		},
		submitHandler: function(form){
			var site_base_url = $('#hBaseUrl').val();
			var ajaxUrl = $('#hAjaxUrl').val();
			var form = $('#sendNotificationFrm');
			var url = ajaxUrl+form.attr('action');
			alert(url);
			for(var instanceName in CKEDITOR.instances){
				CKEDITOR.instances[instanceName].updateElement();
			}
			jQuery.ajax({
				type: "POST",
				url: url,
				data: form.serialize(),
				beforeSend: function(){
					$("#submitBtn").attr("disabled",true);
					$('#submitBtn').html('Sending <i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){
					if(result=='success'){
						window.location=site_base_url+'users';
					}else{						
						$('#resMsg').html('<div class="alert alert-danger">'+result+'</div>');
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$('#submitBtn').html('Send Now!');
						$("#submitBtn").attr("disabled",false);
					}					
				},
				error: function(xhr, status, error_desc){				
					$("html, body").animate({ scrollTop: 0 }, "slow");
					$('#resMsg').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#submitBtn').html('Send Now!');
					$("#submitBtn").attr("disabled",false);
				}
			});		
			return false;
		}
	});
});
</script>    
    </div>
  </div>
</div>
			</div>
		</div>
	</div>
</section>
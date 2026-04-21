<script type="text/javascript">
function delete_entry(val, slug) {
	if (val != "") {
		var r = confirm("Are you sure want to delete it!");
		if (r == true) {
			window.location = "<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'properties/delete?encryptedPropertyId=';?>"+val+"&slug="+slug;
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
function sendNotification(){
	var n = $(".case:checked").length;
	if(n>=1){
		$('#notification_send').modal('show');
		var new_array=[];
		$(".case:checked").each(function() {
			var n_total=parseInt($(this).val());
			new_array.push(n_total);
		});
		$('#hSelectedIds').val(new_array);
	}else{
		alert("Please select at least one organization!");
		return false;
	}

}
$(document).ready(function() {
   $("#selectall").click(function () {
	 $('.case').attr('checked', this.checked); 
   });
  $(".case").click(function(){
       if($(".case").length == $(".case:checked").length) {
           $("#selectall").attr("checked", "checked");
       } else {
           $("#selectall").removeAttr("checked");
       }
   }); 
});

$(document).ready(function(){
	$('#priorityFrm').validate({
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
			var form = $('#priorityFrm');
			var url = baseUrl+form.attr('action');
			var btnText = $('#priBtn').html();
			
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#priBtn').prop("disabled", true);
					$('#priBtn').html('Please Wait &nbsp;<i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location='<?php echo base_url().$this->config->item('admin_directory_name').'properties/listing/'.$section_status_slug;?>';
					}else{
						//$('#basicInfoResDisplay').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#priBtn').prop("disabled", false);
						$('#priBtn').html(btnText);
					}
				},
				error: function(xhr, status, error_desc){
					//$('#basicInfoResDisplay').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#priBtn').prop("disabled", false);
					$('#priBtn').html(btnText);
				}
			});		
			return false;
		}
	});
});
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
			<form id="priorityFrm" class="" method="post" action="properties/priorityUpdate">
			
				<input type="hidden" id="hBaseUrl" name="hBaseUrl" value="<?php echo base_url().$this->config->item('admin_directory_name');?>" />  
				<div class="box-header with-border">
					<h3 class="box-title">Listing</h3>
					<div class="box-tools pull-right">
						<button type="submit" id="priBtn" class="btn btn-default" style="padding:4px 30px; margin-right:5px;">Save Priority</button>
						<a href="<?php echo base_url(). $this->config->item('admin_directory_name').'properties/create/'.$section_status_slug;?>" class="btn btn-primary" style="padding:4px 30px;">Add New <?php echo $section_status_label;?></a>
					</div>
				</div> 
					<div class="box-body row">
						 
						<div class="col-xs-12 table-responsive">
							<table class="table table-striped " id="table_recordtbl">
								<thead>
									<tr>
										<th width="2%">#</th><!--<input type="checkbox" id="selectall" />-->
										<th><?php echo $section_status_label;?></th>
										<?php if($propertyType!=1){?><th>Price</th><?php } ?>
										<?php if($propertyType==0){?>
										<th>Guests &amp; Beds</th>
										<?php } if($propertyType==1){?>
										<th>Business</th>
										<?php }else{ ?>
										<th>Bed &amp; Bath</th>
										<?php } ?>
 										<?php if($propertyType==0){?>
										<th>Category</th>
										<th>Special</th>
										<?php } ?>
										<th>Last Updated</th>
										<th>Status</th>
										<th>Priority</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($propertyDataArr as $row) { ?>
										<tr>
											<td><?php echo $i;?>
												<input type="hidden" id="proIds[]" value="<?php echo $row['propertyId'];?>" name="proIds[]" />
											</td>
											<td style="font-weight:600;"><?php echo $row['name']; ?><small><?php 
											
											if(isset($row['categoryId']) && $row['categoryId']!=''){
												$categoryIdsArr = explode(',',$row['categoryId']);
												$showCatArr = array();
												foreach($categoryIdsArr as $catId){
													$resCat = filter_array($setupMastersData,$catId,'id');
													if(count($resCat)>0){
														$showCatArr[] = $resCat[0]['name']; 
													}
												}
												echo $showCat = implode(',  ',$showCatArr);
											}
											?></small></td>
											 <?php if($propertyType!=1){?>
											<td style="font-weight:600;">
											
											<?php if(isset($row['offerPrice']) && $row['offerPrice']!='' && $row['offerPrice']>0){?>
											<?php echo '<s>$'.$row['avgPrice'].'</s>';?><small><?php echo '$'.$row['offerPrice'];?></small>
											
											<?php }else{echo '$'.$row['avgPrice'];} ?>
											
											
											</td>
											<?php } if($propertyType==0){?>
											<td style="font-weight:600;"><?php echo 'Guest: '.$row['guests']; ?><small><?php echo 'Beds: '.$row['beds'];?></small></td>
											<?php } if($propertyType==1){ ?>
											<td><?php echo $row['businessOwner']; ?><small><?php echo $row['businessOwnerEmail']; ?></small></td>
											<?php }else{ ?>
											<td style="font-weight:600;"><?php echo 'Bedroom: '.$row['bedrooms']; ?><small><?php echo 'Bathroom: '.$row['bathrooms'];?></small></td>
											<?php } ?>
											<?php if($propertyType==0){?>
											<td>
												<input <?php if(isset($row['isCategory']) && $row['isCategory']==0){?> checked="checked" <?php } ?> id="toggle-event-isCategory<?php echo $row['propertyId'];?>" onchange="return update_toggle_swtich_values('<?php echo $row['propertyId'];?>','isCategory');" data-toggle="toggle" data-size="mini" data-onstyle="primary" data-offstyle="default" data-on="Yes" data-off="No" type="checkbox">
												<span id="spinner_isCategory_<?php echo $row['propertyId'];?>"></span>
											</td>
											<td>
												<input <?php if(isset($row['isSpecial']) && $row['isSpecial']==0){?> checked="checked" <?php } ?> id="toggle-event-isSpecial<?php echo $row['propertyId'];?>" onchange="return update_toggle_swtich_values('<?php echo $row['propertyId'];?>','isSpecial');" data-toggle="toggle" data-size="mini" data-onstyle="primary" data-offstyle="default" data-on="Yes" data-off="No" type="checkbox">
												<span id="spinner_isSpecial_<?php echo $row['propertyId'];?>"></span>
											</td>
											<?php } ?>
											<td><?php if(isset($row['lastUpdatedOn']) && $row['lastUpdatedOn']!='' && $row['lastUpdatedOn']>0){echo date('m/d/Y',$row['lastUpdatedOn']);?> <small><?php echo date('h:i A',$row['lastUpdatedOn']);?></small><?php }else{echo '&ndash;';}?></td>
											<td>
												<input <?php if(isset($row['isActive']) && $row['isActive']==0){?> checked="checked" <?php } ?> id="toggle-event-isActive<?php echo $row['propertyId'];?>" onchange="return update_toggle_swtich_values('<?php echo $row['propertyId'];?>','isActive');" data-toggle="toggle" data-size="mini" data-onstyle="success" data-offstyle="danger" data-on="Active" data-off="Inactive" type="checkbox">
												<span id="spinner_isActive_<?php echo $row['propertyId'];?>"></span>
											</td>
											<td>
											<select class="form-control" id="proPri<?php echo $row['propertyId'];?>" name="proPri<?php echo $row['propertyId'];?>">
												<option value="0">0</option>
												<?php for($p=1;$p<=count($propertyDataArr);$p++){?>
													<option value="<?php echo $p;?>" <?php if($row['priority']==$p){?> selected="selected"<?php } ?>><?php echo $p;?></option>
												<?php } ?>
											</select>
											</td>
											<td nowrap="nowrap">
												<a class="btn btn-default btn-sm" href="<?php echo base_url().$this->config->item('admin_directory_name').'properties/manage/'.$row['encryptedPropertyId'];?>">Edit</a>
												<a style="margin-left:3px;" onclick="return delete_entry('<?php echo $row['encryptedPropertyId'];?>','<?php echo $section_status_slug;?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php $i++;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
					</form>
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
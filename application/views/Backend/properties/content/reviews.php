<table class="table table-striped " id="<?php if($reviewFor==0){echo 'table_recordtbl';}?>">
	<thead>
		<tr>
			<th width="2%">#</th>
			<th>Review By</th>
			<th>Message</th>
			<th>Updated</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1;
			foreach ($reviewsDataArr as $review) { ?>
				<tr>
					<td><?php echo $i;?></td>
					<td nowrap="nowrap" style="font-weight:600;"><?php echo $review['reviewBy']; ?><small>
					
					
					<?php if($review['rating']==0){?>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<?php }else if($review['rating']==1){?>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<?php }else if($review['rating']==2){ ?>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<?php }else if($review['rating']==3){ ?>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<?php }else if($review['rating']==4){ ?>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
								<?php }else if($review['rating']==5){ ?>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<?php } ?>
								
							</small></td>
					<td><?php echo $review['message']; ?></td>
 					<td><?php if(isset($review['lastUpdatedOn']) && $review['lastUpdatedOn']!='' && $review['lastUpdatedOn']>0){echo date('m/d/Y',$review['lastUpdatedOn']);?> <small><?php echo date('h:i A',$review['lastUpdatedOn']);?></small><?php }else{echo '&ndash;';}?></td>
					<td>
					
					<?php if($review['isActive'] == 1){?>
				                         	<label class="mstus rejected" style="padding:0px 10px;">In-active</label>
				                         <?php }else{ ?>
				                         	<label class="mstus accepted" style="padding:0px 10px;">Active</label>
				                         <?php } ?>
										 
										 </td> 
					<td nowrap="nowrap">
						<a class="btn btn-default btn-sm" id="editReviewLnk<?php echo $review['reviewId'];?>" onclick="return editReview('<?php echo $review['reviewId'];?>');">Edit</a>
						<a style="margin-left:3px;" onclick="return reviewDelete('<?php echo $review['reviewId'];?>','<?php if(isset($propertyDetails['encryptedPropertyId']) && $propertyDetails['encryptedPropertyId']!=''){echo $propertyDetails['encryptedPropertyId'];}?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
			<?php $i++;
			} ?>
	</tbody>
</table>



<div class="modal fade" tabindex="-1" role="dialog" id="reviewModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="reviewPopupTitle" style="display:inline-block">Review : :  Create</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form id="reviewFrm" method="post" action="properties/manageReviewEntry">
 			<input type="hidden" id="reviewPropertyId" name="reviewPropertyId" value="<?php if(isset($propertyDetails['propertyId']) && $propertyDetails['propertyId']!=''){echo $propertyDetails['propertyId'];}else{echo '0';}?>" />
			<input type="hidden" id="reviewEncryptedPropertyId" name="reviewEncryptedPropertyId" value="<?php if(isset($propertyDetails['encryptedPropertyId']) && $propertyDetails['encryptedPropertyId']!=''){echo $propertyDetails['encryptedPropertyId'];}else{echo '0';}?>" />
			<input type="hidden" id="reviewId" name="reviewId" value="0" />
			<input type="hidden" id="reviewFor" name="reviewFor" value="<?php echo $reviewFor;?>" />
 			<div class="modal-body">
				<div id="reviewResMsg"></div>
				<div id="reviewPopupFields">
 					<?php include(APPPATH.'views/Backend/properties/content/reviewFrm.php');?>
				</div>
 			</div> 
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit" id="reviewManageBtn" style="padding:5px 30px;">Save Changes</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding:5px 30px;">Close</button>
			</div> 
		</form>
<script>
function reviewDelete(val, epId) {
	if (val != "") {
		var r = confirm("Are you sure want to delete it!");
		if (r == true) {
			window.location = "<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'properties/reviewDelete?reviewFor='.$reviewFor.'&reviewId=';?>"+val+"&epId="+epId;
		}
	}
}
function editReview(reviewId){
	$('#reviewId').val(reviewId);
	var baseUrl = $('#hBaseUrl').val();
	var url = baseUrl+'properties/ajaxReviewDetails?reviewId='+reviewId;
	jQuery.ajax({
		url: url,
		beforeSend: function(){
			$('#editReviewLnk'+reviewId).html('<i class="fa fa-spinner fa-spin"></i>');
			$('#reviewPopupTitle').html('Review : : Edit');
		},
		success: function(result, status, xhr){
			$('#reviewPopupFields').html(result);
			$('#reviewModal').modal('show');
			$('#editReviewLnk'+reviewId).html('Edit');					
		}
	});	
}
function addReview(){
	$('#reviewId').val('0');
	$('#reviewBy').val('');
	$('#reviewMsg').html('');
	$('#reviewRating').val('');
	$('#reviewPopupTitle').html('Review : : Add');
	$('#reviewModal').modal('show');
}
$(document).ready(function() {
	$('#reviewFrm').validate({
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
			var form = $('#reviewFrm');
			var url = baseUrl+form.attr('action');
			jQuery.ajax({
				type: "POST",
				url: url,
				data: form.serialize(),
				beforeSend: function(){
					$("#reviewManageBtn").attr("disabled",true);
					$('#reviewManageBtn').html('Please Wait <i class="fa fa-spinner fa-spin"></i>');
				},
				success: function(result, status, xhr){
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						window.location=result_arr[1];
					}else{						
						$('#reviewResMsg').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#reviewManageBtn').html('Save Changes');
						$("#reviewManageBtn").attr("disabled",false);
					}					
				},
				error: function(xhr, status, error_desc){
					$('#reviewResMsg').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#reviewManageBtn').html('Save Changes');
					$("#reviewManageBtn").attr("disabled",false);
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
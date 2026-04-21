<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			<div class="box-header with-border">
		  <h3 class="box-title">Today's Notice Board Messages &mdash;</h3>
		   
		</div>
				<form class="form-horizontal" id="frm" method="post" action="">
					<input type="hidden" name="h_old_notice_cnt" id="h_old_notice_cnt" value="<?php echo count($todays_notice_data);?>" />
					<?php if(count($todays_notice_data)>0){?>
						<input type="hidden" name="h_item_cnt" id="h_item_cnt" value="0" />
					<?php }else{ ?>
						<input type="hidden" name="h_item_cnt" id="h_item_cnt" value="1" />
					<?php } ?>
					<div class="box-body">
					
						<p id="ret"><?php if(validation_errors() != false) { echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>'; } ?></p>
						<div class="col-xs-12 table-responsive place_order_basic_info" id="item_tbl">
							<table class="table">
								<thead>
									<tr>
										<th width="1%">#</th>
										<th>Notice Message</th>
										<th width="12%">Status</th>
										<th width="10%">Priority</th>
									</tr>
								</thead>
								<tbody id="append_company_products">
									
									<?php if(count($todays_notice_data)>0){?>
										<?php $i=1;foreach($todays_notice_data as $notice){?>
											<tr>
												<td><?php echo $i;?><input type="hidden" name="old_notice_ids[]" id="old_notice_ids_<?php echo $notice['noticeId'];?>" value="<?php echo $notice['noticeId'];?>" /></td>
												<td><input type="text" class="form-control required" id="old_notice_<?php echo $notice['noticeId'];?>" name="old_notice_<?php echo $notice['noticeId'];?>" value="<?php echo $notice['noticeMsg'];?>" autocomplete="off" /></td>
												<td>
													<select class="form-control required field_width" id="old_status_<?php echo $notice['noticeId'];?>" name="old_status_<?php echo $notice['noticeId'];?>"> 
														<option value="0" <?php if($notice['status']==0){?> selected="selected"<?php } ?>>Active</option>
														<option value="1" <?php if($notice['status']==1){?> selected="selected"<?php } ?>>In-active</option>
													</select>
												</td>
												<td>
													<select class="form-control required" id="old_priority_<?php echo $notice['noticeId'];?>" name="old_priority_<?php echo $notice['noticeId'];?>"> 
														<?php for($pi=1;$pi<=30;$pi++){?>
															<option value="<?php echo $pi;?>" <?php if($notice['priority']==$pi){?> selected="selected"<?php } ?>><?php echo $pi;?></option>
														<?php } ?>
													</select>
												</td>
											</tr>
										<?php $i++;} ?>
									<?php }else{ ?>
									<tr>
										<td>1</td>
										<td><input type="text" class="form-control required" id="notice_1" name="notice_1" value="" autocomplete="off" /></td>
										<td>
											<select class="form-control required" id="status_1" name="status_1"> 
												<option value="0">Active</option>
												<option value="1">In-active</option>
											</select>
										</td>
										<td>
											<select class="form-control required" id="priority_1" name="priority_1"> 
												<?php for($pi=1;$pi<=30;$pi++){?>
													<option value="<?php echo $pi;?>"><?php echo $pi;?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>							
						</div>
						<div class="pull-right"> 
							<button style="padding:3px 15px; margin:0 2px;" class="btn btn-default btn-sm" type="button" id="add_new_item_btn" onclick="return add_new_line_item();"> <i class="fa fa-plus"></i> Add More </button>
							<button style="padding:3px 15px; margin:0 2px;" class="btn btn-danger btn-sm" type="button" onclick="return remove_line_item();">Remove</button>
						</div>
						
 						 
					</div>
				<div class="box-footer">
				<button type="submit" class="btn btn-primary" name="submit_login">Update Now!</button>
				</div>
				</form>
<script>
function add_new_line_item(){
	var item_cnt = parseInt($('#h_item_cnt').val());
	var n_item = item_cnt+1;
	
	var old_notice_cnt = parseInt($('#h_old_notice_cnt').val());
	if(old_notice_cnt>0){
		var n_new_item = old_notice_cnt+n_item;
	}else{
		var n_new_item = n_item;
	}
	var html='<tr class="tr_item"><td>'+n_new_item+'</td><td><input type="text" class="form-control required" id="notice_'+n_item+'" name="notice_'+n_item+'" value="" autocomplete="off" /></td><td><select class="form-control required" id="status_'+n_item+'" name="status_'+n_item+'"> <option value="0">Active</option><option value="1">In-active</option></select></td><td><select class="form-control required" id="priority_'+n_item+'" name="priority_'+n_item+'"> <option value="">0</option> <?php for($pi=1;$pi<=30;$pi++){?><option value="<?php echo $pi;?>"><?php echo $pi;?></option><?php } ?></select></td></tr>';
	$('#append_company_products').append(html);
	$('#h_item_cnt').val(n_item);
}
function remove_line_item(){
	var item_cnt = parseInt($('#h_item_cnt').val());
	var old_notice_cnt = parseInt($('#h_old_notice_cnt').val());
	if(old_notice_cnt>0){
		if(item_cnt>0){
			var n_item = item_cnt-1;
			$('#h_item_cnt').val(n_item);
			$('.tr_item:last').remove();
		}
	}else{
		if(item_cnt>1){
			var n_item = item_cnt-1;
			$('#h_item_cnt').val(n_item);
			$('.tr_item:last').remove();
		}
	}
}
</script>			
			</div>
		</div>
	</div>
</section>

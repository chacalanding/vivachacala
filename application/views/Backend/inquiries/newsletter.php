<script type="text/javascript">
function delete_entry(val) {
	if (val != "") {
		var r = confirm("Are you sure want to delete it!");
		if (r == true) {
			window.location = "<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'inquiries/deleteNewsLetter?newsId=';?>"+val;
		}
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
										<th>Email Address</th>
										<th>Subscriber On</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($newsletterDataArr as $row) { ?>
										<tr>
											<td><?php echo $i;?></td>
											<td style="font-weight:600;"><?php echo $row['email']; ?></td>
											<td><?php if(isset($row['enquiryTime']) && $row['enquiryTime']!='' && $row['enquiryTime']>0){echo date('m/d/Y, h:i A',$row['enquiryTime']); }else{echo '&ndash;';}?></td>
										 
											 
											<td nowrap="nowrap">
												
												<a style="margin-left:3px;" onclick="return delete_entry('<?php echo $row['newsId'];?>');" class="btn btn-danger btn-sm">Delete</a>
											</td>
										</tr>
									<?php $i++;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
 
			</div>
		</div>
	</div>
</section>
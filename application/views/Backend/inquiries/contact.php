<script type="text/javascript">
function delete_entry(val, slug) {
	if (val != "") {
		var r = confirm("Are you sure want to delete it!");
		if (r == true) {
			window.location = "<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'inquiries/deleteInquiry?inquiryId=';?>"+val+"&slug="+slug;
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
										<th>Full Name</th>
										<th>Contact Info.</th>										 
										<th>Message</th>
										<th>Inq. On</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($contactUsDataArr as $row) { ?>
										<tr>
											<td><?php echo $i;?></td>
											<td style="font-weight:600;"><?php echo ucwords($row['name']); ?></td>
											<td><?php echo $row['email']; ?> <small><?php echo $row['phoneNo']; ?></small></td>
											 
											 
											<td><?php echo $row['message']; ?></td>
											 
											<td><?php if(isset($row['enquiryTime']) && $row['enquiryTime']!='' && $row['enquiryTime']>0){echo date('m/d/Y',$row['enquiryTime']);?> <small><?php echo date('h:i A',$row['enquiryTime']);?></small><?php }else{echo '&ndash;';}?></td>
										 
											 
											<td nowrap="nowrap">
												
												<a style="margin-left:3px;" onclick="return delete_entry('<?php echo $row['inquiryId'];?>','contact');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
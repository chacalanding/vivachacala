<script type="text/javascript">
  function delete_entry(val) {
    if (val != "") {
      var r = confirm("Are you sure want to delete it!");
      if (r == true) {
        window.location = "<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'sponsor/delete/';?>" + val;
      }
    }
  }
</script>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			<div class="box-header with-border">
		  <h3 class="box-title">Sponsor List</h3>
<div class="box-tools pull-right">
				    <a style="padding: 4px 15px;vertical-align:top; margin-left:5px;" href="<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'sponsor/add';?>" class='btn btn-primary'>Add Sponsor !</a>
				    </div>
		</div>
				 
					<div class="box-body row">
					
					 
						<div class="col-xs-12 table-responsive">
                        <table class="table " id="table_recordtbl">
								<thead>
									<tr>
										<th width="2%">#</th>
										<th width="10%">logo</th>
										<th width="7%">First Name</th>
										<th width="7%"> Last Name</th>
										<th width="10%">Type of Organization</th>
										<th width="8%">Role</th>
										<th width="12%">Address</th>
										<th width="10%">Email</th>
										<th width="10%">Password</th>
										<th width="7%">Contact Number</th>
										<th width="7%">Status</th>
										<th width="10%">Action</th>
									</tr>
								</thead>
								<tbody id="append_company_products">
									<?php $i = 1;
									foreach ($sponsor_data as $row) { ?>
										<tr>
											<td><?php echo  $i; ?></td>
											<td><img src="<?php echo base_url().'assets/upload/logo/'.$row->logo ?>" alt="logo"></td>
											<td><?php echo  $row->firstname; ?></td>
											<td><?php echo  $row->lastname; ?>1</td>
											<td><?php echo  $row->organization; ?></td>
											<td><?php echo  $row->role; ?></td>
											<td><?php echo  $row->address; ?></td>
											<td><?php echo  $row->email; ?></td>
											<td><?php echo  $row->password; ?></td>
											<td><?php echo  $row->contactno; ?></td>
											<td><?php if ($row->is_status == 1) { ?>
													<label class="mstus rejected" style="padding:0px 10px;">In-active</label>
												<?php } else { ?>
													<label class="mstus accepted" style="padding:0px 10px;">Active</label>
												<?php } ?>
											</td>
											<td>
												<a href="<?php echo $this->config->item('ajax_base_url') . $this->config->item('admin_directory_name') . 'sponsor/edit/' . $row->id; ?>"><i type="button" class="btn btn-success btn-sm">Edit</i></a>
												<a onclick="return delete_entry('<?php echo $row->id; ?>');"><type="button" class="btn btn-danger btn-sm">Delete</type=>
												</a>
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
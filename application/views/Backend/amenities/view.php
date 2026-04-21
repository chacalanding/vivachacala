<script type="text/javascript">
  function delete_entry(val) {
    if (val != "") {
      var r = confirm("Are you sure want to delete it!");
      if (r == true) {
        window.location = "<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'amenities/delete/';?>" + val;
      }
    }
  }
</script>
<style>
.table small {display: block;margin-left: 5px; font-size: 95%;margin-top: 2px;}
.mstus {border: 1px dashed;padding: 1px 10px;margin-bottom: 0;font-size: 14px;}
.accepted {color: green;}
.rejected {color: #a94442;}
.table .btn-group-sm>.btn, .btn-sm {font-size:13px;}
</style>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			<div class="box-header with-border">
		  <h3 class="box-title">Listing</h3>
<div class="box-tools pull-right">
				    <a style="padding: 4px 15px;vertical-align:top; margin-left:5px;" href="<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'amenities/add';?>" class='btn btn-primary'>Add New</a>
				    </div>
		</div>
				 
					<div class="box-body row">
					
					 
						<div class="col-xs-12 table-responsive">
							<table class="table table-striped" id="table_recordtbl">
								<thead>
									<tr>
										<th width="5%">#</th>
										<th>Name / Title</th>
										<th>Category</th>
										<th>Status</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody id="append_company_products">
                                <?php $i = 1;
                                     foreach($member_data as $row){?>
                                     <tr>
                                         <td><?php echo $i; ?></td>
                                         <td style="font-weight:600;"><?php echo $row->name;?></td>
										 <td><?php if($row->catId>0){ echo $this->config->item('amenities_categories_types_array_config')[$row->catId]['name']; }else{echo '&ndash;';}?></td>
                                         <td><?php if($row->is_status == 1){?>
				                         	<label class="mstus rejected" style="padding:0px 10px;">In-active</label>
				                         <?php }else{ ?>
				                         	<label class="mstus accepted" style="padding:0px 10px;">Active</label>
				                         <?php } ?></td>
                                         <td>
                                         <a class="btn btn-success btn-sm" href="<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'amenities/edit/'.$row->id;?>">Edit</a>
                                         <a onclick="return delete_entry('<?php echo $row->id; ?>');" class="btn btn-danger btn-sm">Delete</a>
                                         </td>
                                     </tr>
                                     <?php $i++; }?>
                                     </tbody>
							</table>							
						</div>	 
					</div>
		
			</div>
		</div>
	</div>
</section>
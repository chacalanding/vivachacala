<script type="text/javascript">
function delete_entry(val){
 	if(val!="") {
		var r = confirm("Are you sure want to delete it!");
		if (r == true) {
 		  window.location = '<?php echo base_url().$this->config->item('admin_directory_name');?>/setup/delete/<?php echo $section_status_slug.'/';?>'+val;
 		} 
 	}
} 
</script>
<?php $wards_prefix = $this->config->item('wards_prefix');?>
<?php $zones_prefix = $this->config->item('zones_prefix');?> 
<section class="content">
   <div class="box">	
	<div class="box-header with-border">
		  <h3 class="box-title">Listing</h3>
		  <div class="box-tools pull-right">
				 
				  <a style="padding: 4px 20px; vertical-align:top; " href="<?php echo base_url().$this->config->item('admin_directory_name');?>/setup/add/<?php echo $section_status_slug;?>" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New <?php echo $section_status_label;?></a>
				</div>
		</div>
			   
	  <div class="box-body row">

<div class="col-md-12 table-responsive ">
	<table class="table table-striped" id="table_recordtbl">
		<thead>
			<tr>
				<th width="3%" nowrap="nowrap">#</th>
				<th nowrap="nowrap">Name</th> 
				<th nowrap="nowrap">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php if(count($setup_masters_details)>0){$i=1; foreach ($setup_masters_details as $row) { ?>
		<tr>
			<td><?php echo $i;?></td>
			<td style="font-weight:600;"><?php echo $row->name;?></td>
		
			<td>
				<a href="<?php echo base_url().$this->config->item('admin_directory_name');?>/setup/edit/<?php echo $section_status_slug.'/'.$row->id;?>" class="btn btn-success btn-sm"> Edit</a> 
				<a class="btn btn-danger btn-sm" onclick="return delete_entry('<?php echo $row->id;?>');"> <i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php  $i++; }} ?>
		</tbody>								  
	</table> 
</div>      
</div>    
</div>
</section>  
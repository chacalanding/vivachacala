<script type="text/javascript">
function delete_entry(val){
  if(val!="") {
    var r = confirm("Are you sure want to delete it!");
    if (r == true) {
      window.location = '<?php echo base_url().$this->config->item('admin_directory_name');?>subadmins/delete?id='+val;
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

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
       <div class="box">
      
              <div class="box-header with-border">
                  <h3 class="box-title">Guest Listing</h3>

                    <div class="box-tools pull-right">
           
                      <a style="padding: 4px 15px; vertical-align:top; " href="<?php echo base_url().$this->config->item('admin_directory_name');?>subadmins/add" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Guest</a>
                    </div> 
           
                </div>      
          <!-- start body div -->
          <div class="box-body row">
 
    <div class="col-xs-12 table-responsive">
    <table class="table table-striped" id="table_recordtbl">
      <thead>
        <tr>
          <th width="3%">#</th>
          <th nowrap="nowrap">Name</th> 
          <th nowrap="nowrap">E-Mail</th>
          <th nowrap="nowrap">UserName</th>
          <th nowrap="nowrap">Password</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
       <?php $i=1; foreach ($guest_details as $row) { ?>
            <tr>
              <td><?php echo  $i;?></td>

              <td nowrap="nowrap"  style="font-weight:600;"><?php echo $row->name;?></td> 
                
              <td><?php echo $row->email;?></td>
              <td><?php echo $row->username;?></td>
              <td><?php echo $row->password_v;?></td>
              
			  
			  <td><?php if($row->status == 0){?>
				<label class="mstus accepted" style="padding:0px 10px;">Active</label>
			 <?php }else{ ?>
					<label class="mstus rejected" style="padding:0px 10px;">In-active</label>
			 <?php } ?></td>
			 
										 
										 
              <td>
                <a href="<?php echo  base_url().$this->config->item('admin_directory_name');?>subadmins/edit/<?php echo $row->id;?>" class="btn btn-success btn-sm"> Edit</a> 
                <a class="btn btn-danger btn-sm btn_delete" onclick="return delete_entry('<?php echo $row->id;?>');">Delete</a>
              </td>
            </tr>
                   <?php  $i++; } ?>          
                    
                </tbody>
                                      
      </table>
 
    </div>
      
        </div>
        <!-- /.box-body -->
        <!-- Modal -->    
        </div>
        <!-- /.box-body -->

        
      <!-- /.box -->
    </section>
    
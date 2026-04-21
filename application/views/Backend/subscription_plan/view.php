<script type="text/javascript">
    function delete_entry(val) {
        if (val != "") {
            var r = confirm("Are you sure want to delete it!");
            if (r == true) {
                window.location = "<?php echo $this->config->item('ajax_base_url') . $this->config->item('admin_directory_name') . 'subscription_plan/delete/'; ?>" + val;
            }
        }
    }
</script>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Subscription Plan Details</h3>
                    <div class="box-tools pull-right">
                        <a style="padding: 4px 15px;vertical-align:top; margin-left:5px;" href="<?php echo $this->config->item('ajax_base_url') . $this->config->item('admin_directory_name') . 'Subscription_plan/add'; ?>" class='btn btn-primary'>Add Member !</a>
                    </div>
                </div>

                <div class="box-body row">


                    <div class="col-xs-12 table-responsive">
                        <table class="table" id="table_recordtbl">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="15%"> Plan Title</th>
                                    <th width="15%">Cost</th>
                                    <th width="20%">Package Fee Text</th>
                                    <th width="25%">Package Details</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="append_company_products">
                            <?php $i = 1;
                                     foreach($plan_data as $row){?>
                                     <tr>
                                         <td><?php echo  $i; ?></td>
                                         <td><?php echo $row->name;?></td>
                                         <td>&#36<?php echo $row->cost;?></td>
                                         <td><?php echo $row->package;?></td>
                                         <td><?php echo $row->package_details;?></td>
                                         <td><?php if($row->is_status == 1){?>
				                         	<label class="mstus rejected" style="padding:0px 10px;">In-active</label>
				                         <?php }else{ ?>
				                         	<label class="mstus accepted" style="padding:0px 10px;">Active</label>
				                         <?php } ?></td>
                                         <td>
                                         <a href="<?php echo $this->config->item('ajax_base_url').$this->config->item('admin_directory_name').'subscription_plan/edit/'.$row->id;?>"><i type="button" class="btn btn-success">Edit</i></a>
                                         <a onclick="return delete_entry('<?php echo $row->id; ?>');"><type="button" class="btn btn-danger">Delete</type=></a>
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
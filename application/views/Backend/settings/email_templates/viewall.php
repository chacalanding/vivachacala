<section class="content">
	<div class="box">
		<div class="box-body row"> 
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped" id="table_recordtbl">
					<thead>
						<tr>
							<th width="3%">#</th>
							<th nowrap="nowrap">Purpose</th> 
							<th nowrap="nowrap">Subject</th> 
							<th nowrap="nowrap">Message</th>  
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($email_templates_details as $email_templates) { ?>
						<tr>
							<td><?php echo  $i;?></td>
							<td nowrap="nowrap"><?php echo $email_templates->purpose;?></td> 
							<td nowrap="nowrap"><?php echo $email_templates->subject;?></td> 
							<td nowrap="nowrap"><a class="btn fancybox" href="<?php echo base_url().$this->config->item('admin_directory_name');?>/home/email_templates_message?id=<?php echo $email_templates->id;?>" style="padding:0;">View</a><?php //echo $email_templates->message;?></td> 
							<td nowrap="nowrap"> 
								<?php if($email_templates->status==0){?>
									<span style="color:#D73925; font-size:10px;"><i class="fa fa-circle"></i></span>
								<?php }else{ ?>
									<span style="color:#52AB0B;font-size:10px;"><i class="fa fa-circle"></i></span>
								<?php }?>
							</td>  
							<td>
								<a href="<?php echo base_url().$this->config->item('admin_directory_name');?>/setting/email_templates/edit?id=<?php echo $email_templates->id;?>" class="btn btn-success btn-sm">Edit</a> 					
							</td>
						</tr>
						<?php  $i++; } ?> 			
					</tbody>				  
				</table>			
			</div>      
		</div>   
	</div>
</section>
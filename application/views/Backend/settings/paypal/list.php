<section class="content">
	<div class="box">
		<div class="box-body row">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped " id="table_recordtbl">
					<thead>
						<tr>
							<th width="3%" nowrap="nowrap" style="vertical-align:top;">#</th>
							<th style="vertical-align:top;">Purpose</th> 
							<th style="vertical-align:top;">Paypal IPN</th> 
							<th style="vertical-align:top;">Description</th>
							<th style="vertical-align:top;">Amount</th>
							<th style="vertical-align:top;">Duration</th>
							<th style="vertical-align:top;">Currency Code</th>
							<th style="vertical-align:top;">Status</th>
							<th style="vertical-align:top;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($paypal_details as $paypal) { ?>
						<tr>
							<td><?php echo  $i;?></td>
							<td style="font-weight:600;"><?php echo $paypal->purpose;?></td> 
							<td><?php echo $paypal->paypal_id;?></td> 
							<td><?php echo $paypal->item_name;?></td> 
							<td><?php echo $paypal->amount;?></td>
							<td><?php echo $paypal->duration;?></td>
							<td><?php echo $paypal->currency_code;?></td>
							<td nowrap="nowrap"> 
								<?php if($paypal->status=='paypal'){?>
									<span style="color:#52AB0B; font-size:12px;"><i class="fa fa-circle"></i> </span> Paypal (Live) 
								<?php }else{ ?>
									<span style="color:#D73925;font-size:12px;"><i class="fa fa-circle"></i> </span> Sandbox (Test)
								<?php }?>
							</td>  
							<td>
								<a href="<?php echo base_url().$this->config->item('admin_directory_name');?>/paypal/edit/<?php echo $paypal->id;?>" class="btn btn-success btn-sm"> Edit</a>
							</td>
						</tr>
						<?php  $i++; } ?>
					</tbody>
				</table>
			</div>      
		</div>
	</div>
</section>
<div class="col-md-3">

<div id="open_model_gallery_loading" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Alert</h4>
		</div>
 		<div class="modal-body" style="text-align: center;" id="gallery_slider_modal_body">			
			
		</div>  		 
	</div>
  </div>
</div>
<form method="post" action="" enctype="multipart/form-data">
	<label style="display:none;" for="bgimage"><input type="file" name="bgimage" accept="image/png,image/jpeg" id="bgimage"  /></label>
</form>
<h4>Featured Image</h4>
<img id="default_0" class="img-responsive default_0" src="<?php if(isset($propertyDetails['proImage']) && $propertyDetails['proImage']!=''){ echo base_url().'assets/upload/proImage/small/'.$propertyDetails['proImage']; }else{ echo base_url().'assets/frontend/images/no_img.jpg';}?>" alt="" onclick="return change_image('0','default','<?php echo $propertyDetails['proImage'];?>');" />
<div class="alert alert-danger">Please click on above Featured Image to replace it.</div>
<script>
function change_image(id,status,oldImageName){
	var img = document.getElementById(status+"_"+id);
	$('#bgimage').change(function(e){
		 if(this.files && this.files[0]){
			var file = this.files[0];
			var reader = new FileReader(); 
			reader.onload = function(e){ 
				$("."+status+"_"+id).attr('src', e.target.result);//.width(500).height(300)
				var form = new FormData();          
				form.append('bgimage', file);
				$.ajax({
					url : "<?php echo base_url().$this->config->item('admin_directory_name');?>properties/manageImages?status="+status+'&id='+id+'&oImg='+oldImageName+'&propertyId=<?php echo $propertyDetails['propertyId'];?>',
					type: "POST",
					cache: false,
					contentType: false,
					processData: false,
					data : form,
					beforeSend: function(){
						$("#gallery_slider_modal_body").html('<h4>Please wait image is uploading <i class="fa fa-spinner fa-spin"></i></h4>');
						$("#open_model_gallery_loading").modal('show');
					},
					success: function(response){
						if(response=='success'){
							window.location='<?php echo base_url().$this->config->item('admin_directory_name').'properties/manage/'.$propertyDetails['encryptedPropertyId'].'?tab_id=4';?>';
						}else if(response=='no_size'){
							$("#gallery_slider_modal_body").html('<span style="color:#a94442; line-height:25px;font-size: 17px;font-weight: 600;">You did not use the proper dimensions for this section. Photos must be 1170 by 350.</span>');
							return false;
						}
					}
				});
			};
			reader.readAsDataURL(this.files[0]);
		}
	}).click();	 
}
function proImageDelete(imgId, epId) {
	if (imgId != "") {
		var r = confirm("Are you sure want to delete it!");
		if (r == true) {
			window.location = "<?php echo base_url().$this->config->item('admin_directory_name').'properties/proImageDelete';?>?imgId="+imgId+"&epId="+epId;
		}
	}
}
</script>
</div>

<div class="col-md-9">
<h4>More Images</h4>
	<ul id="sortable" class="sortable_drag mt-3">
		<?php if(count($imagesDataArr)>0){ $img=1;foreach($imagesDataArr as $moreImg){?>
			<?php //if($img==1){?><?php //} ?>
			<li id="<?php echo $moreImg['imgId'];?>">
				<span></span>
				<img style="padding:3px;" id="more_<?php echo $moreImg['imgId'];?>" class="img-responsive more_<?php echo $moreImg['imgId'];?>" src="<?php echo base_url();?>assets/upload/proImage/small/<?php echo $moreImg['imageName'];?>" alt="" onclick="return change_image('<?php echo $moreImg['imgId'];?>','more','<?php echo $moreImg['imageName'];?>');" />
				<a class="delImg btn btn-danger btn-sm" onclick="return proImageDelete('<?php echo $moreImg['imgId'];?>','<?php echo $propertyDetails['encryptedPropertyId'];?>');"> <i class="fa fa-trash"></i> </a>
			</li>
		<?php //if($img==3){?>  <?php //$img=1; }else{ $img++;} ?>
		<?php  } } ?>
	
		
		
	</ul> 
	
	<div class="add_images_btn">
			<img id="more_0" class="more_0" src="<?php echo base_url();?>assets/frontend/images/add_img.jpg" alt="" onclick="return change_image('0','more','');" />
		</div>
</div>
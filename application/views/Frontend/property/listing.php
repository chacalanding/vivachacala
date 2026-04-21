<?php if($propertyType==0){?>
<button type="button" class="vc_btn d-inline-flex justify-content-center d-md-none w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Search Viva Chacala Rentals <i data-feather="search"></i>
</button>

<!-- top serach Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen h-auto">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Search Viva Chacala Rentals</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
	    <div class="search_box inner_page_search_bar">
			<div class="search_wrap">
				<?php include(APPPATH.'views/Frontend/property/search-rental-modal.php');?>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
<div class="search_box inner_page_search_bar d-none d-md-block">
	<div class="search_wrap">
		<?php include(APPPATH.'views/Frontend/property/search-rental.php');?>
	</div>
</div>
<?php } ?>
<script>
function applyCategoryFilter(cId){
  	window.location = '<?php echo base_url().$propertyTypeName.'?cId=';?>'+cId;
}
</script>
<main class="py-3">
	<div class="rental_listing mb-5 pb-5">
	  <div class="container-fluid">
		<div class="row mb-3">
		  <div class="col-12 col-sm-12 col-md-9"><span>Showing <b><?php echo count($propertiesDataArr);?></b> matching listings</span></div>
		  <div class="col-12 col-sm-12 col-md-3">
			<select class="form-select" aria-label="" onchange="return applyCategoryFilter(this.value);">
			<option value="">All</option>
			<?php $categories = filter_array($setupMastersData,$propertyType,'section_status');
				foreach($categories as $val){ if($val['status']==0){?>
				<option  value="<?php echo $val['id'];?>" <?php if(isset($_GET['cId']) && $_GET['cId']!='' && $_GET['cId']==$val['id']){?> selected="selected"<?php } ?>><?php echo $val['name'];?></option>
				<?php } }?>			 
			</select>
		  </div>
		</div>
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-3">
		
		<?php foreach($propertiesDataArr as $proDetails){?>
		
		  <div class="col">
			<div class="unit_card img_zoom">
			  <span class="arrow_btn"><i data-feather="arrow-up-right"></i></span>
			  <div id="listingCarousel<?php echo $proDetails['propertyId'];?>" class="carousel slide listing_carousel">
				<div class="carousel-inner">
				<?php if(isset($proDetails['proImage']) && $proDetails['proImage']!=''){?>	
				  <div class="carousel-item active">
					<img src="<?php echo base_url().'assets/upload/proImage/small/'.$proDetails['proImage'];?>" class="d-block w-100" alt="<?php echo $proDetails['name'];?>" />
				  </div>
				  
				  <?php $moreImagesArr = getMoreImagesCh($proDetails['propertyId'],'4'); if(count($moreImagesArr)>0){ foreach($moreImagesArr as $imgDetails){?>
				<div class="carousel-item">
					<img src="<?php echo base_url().'assets/upload/proImage/small/'.$imgDetails['imageName'];?>" class="d-block w-100" alt="<?php echo $proDetails['name'];?>" />
				</div>
				 <?php } } }else{ ?>  
				 
				 <div class="carousel-item active">
					<img src="<?php echo base_url().'assets/frontend/images/no_img.jpg';?>" class="d-block w-100" alt="" />
				  </div>
				 
				 <?php } ?>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#listingCarousel<?php echo $proDetails['propertyId'];?>" data-bs-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#listingCarousel<?php echo $proDetails['propertyId'];?>" data-bs-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="visually-hidden">Next</span>
				</button>
			  </div>
			  <div class="uc_info">
				<div class="uc_name">
				  <a href="<?php echo base_url().$propertyTypeName.'/'.$proDetails['slug'];?>" target="_blank" class="stretched-link text-truncate"><?php echo $proDetails['name'];?></a>
			<?php if($propertyType==2){?>
				<div class="uc_prices">
				  <b>$<?php echo number_format($proDetails['avgPrice']);?> <span class="prInfo">USD</span> </b>						 
				</div>
				<?php } ?>
			  </div>
				
				
				
				<?php if($propertyType!=1){?>
				  <ul class="uc_features">
				  	<?php if($propertyType==0){?>
					<li><?php echo $proDetails['guests'];?> Guests  </li>    
					<li><?php echo $proDetails['beds'];?> Beds </li>    
					<?php } ?>
					<li><?php echo $proDetails['bedrooms'];?> Bedrooms </li>   
					<li><?php echo $proDetails['bathrooms'];?> Bathrooms</li>
				  </ul>
				  <?php } ?>
				   <?php if($propertyType!=2){?>
				  <div class="ratings">
				  
				  <?php if($proDetails['avgRating']==0){?>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<?php }else if($proDetails['avgRating']==1){?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<?php }else if($proDetails['avgRating']==2){ ?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<?php }else if($proDetails['avgRating']==3){ ?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<?php }else if($proDetails['avgRating']==4){ ?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star"></i>
								<?php }else if($proDetails['avgRating']==5){ ?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<?php } ?>
								
				 
					<small><?php echo $proDetails['reviewsCnt'];?></small>
				  </div>
				  <?php } ?>
				  
				  <?php if($propertyType==0){?>
				<div class="uc_prices">
				  <div class="ucpItem">
					  <small>High Season</small>
					  <b>$<?php echo number_format($proDetails['avgPrice']);?> <span class="prInfo"> <?php echo 'USD/nt';?> </span> </b>
				  </div>
				  <div class="ucpItem">
					  <small>Low Season</small>
					  <b> <?php if(isset($proDetails['lowSeason']) && $proDetails['lowSeason']>0){?>$<?php echo number_format($proDetails['lowSeason']);?> <span class="prInfo"> <?php echo 'USD/nt';?> </span> <?php }else{echo '--';}?> </b>
				  </div>
				  <div class="ucpItem">
					  <small>Holiday</small>
					   <b> <?php if(isset($proDetails['holidayPrice']) && $proDetails['holidayPrice']>0){?>$<?php echo number_format($proDetails['holidayPrice']);?> <span class="prInfo"> <?php echo 'USD/nt';?> </span> <?php }else{echo '--';}?> </b>
				  </div>					 
				</div>
				<?php } ?>
				
			  </div>
			</div>
		  </div>
		  
		  <?php } ?>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		</div>
	  </div>
	</div>
</main>

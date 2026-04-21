<section id="vc_slider" class="slider">
	<div id="vivaCarousel" class="carousel slide vc_carousel" data-bs-ride="carousel">
		<div class="slider_foot">
			<?php if(isset($wheaterData) && $wheaterData!=''){?>
			<div class="sf_item gap-2 d-flex align-items-center">
				<i data-feather="sun"></i> <span><b> Weather</b> <?php echo $wheaterData;//$configurationDetails->weather;?></span>
			</div><?php } ?>
			<div class="sf_item gap-2 d-flex align-items-center">
				<i data-feather="clock"></i> <span><b> Local Time</b> <?php echo date('h:i A');?></span>
			</div>
		</div>
		<div class="carousel-inner">
		  <div class="carousel-item active img_zoom" >
			<div class="slide_text">
				<div class="slide_text_wrap">
					<div class="st_top_text">Escape  .  Experience  .  Embrace</div>
					<div class="st_big_text">Paradise</div>
					<div class="st_btm_text">YOUR OWN PRIVATE MEXICO VACATION</div>
				</div>
			</div>
			<img src="<?php echo base_url();?>assets/frontend/images/slide_one.webp" alt="" />
		  </div>
		  <div class="carousel-item img_zoom" >
			<div class="slide_text">
			  <div class="slide_text_wrap">
				  <div class="st_top_text">Immerse  .  Absorb  .  Bask</div>
				  <div class="st_big_text">BEAUTY</div>
				  <div class="st_btm_text">Exotic and breathtaking nature</div>
			  </div>
			</div>
			<img src="<?php echo base_url();?>assets/frontend/images/viva_beauty.webp" alt="" />
		  </div>
		  <div class="carousel-item img_zoom" >
			<div class="slide_text">
			  <div class="slide_text_wrap">
				  <div class="st_top_text">Unwind  .  Indulge  .  Cherish</div>
				  <div class="st_big_text">COMFORT</div>
				  <div class="st_btm_text">Luxury beyond imagination</div>
			  </div>
			</div>
			<img src="<?php echo base_url();?>assets/frontend/images/viva_comfort.webp" alt="" />
		  </div>
		  <div class="carousel-item img_zoom" >
			<div class="slide_text">
			  <div class="slide_text_wrap">
				  <div class="st_top_text">Explore  .  Discover  .  Conquer</div>
				  <div class="st_big_text">ACTIVITY</div>
				  <div class="st_btm_text">On land and sea</div>
			  </div>
			</div>
			<img src="<?php echo base_url();?>assets/frontend/images/viva_activity.webp" alt="" />
		  </div>
		  <div class="carousel-item img_zoom" >
			<div class="slide_text">
			  <div class="slide_text_wrap">
				  <div class="st_top_text">Rest  .  Rejuvenate  .  Relax</div>
				  <div class="st_big_text">SERVICE</div>
				  <div class="st_btm_text">Unparallelled care and attention</div>
			  </div>
			</div>
			<img src="<?php echo base_url();?>assets/frontend/images/viva_service.webp" alt="" />
		  </div>
		  <div class="carousel-item img_zoom" >
			<div class="slide_text">
			  <div class="slide_text_wrap">
				  <div class="st_top_text">Surf  .  Hike  .  Explore</div>
				  <div class="st_big_text">ADVENTURE</div>
				  <div class="st_btm_text">An undiscovered coastal paradise</div>
			  </div>
			</div>
			<img src="<?php echo base_url();?>assets/frontend/images/viva_adventure.webp" alt="" />
		  </div>
		  <div class="carousel-item img_zoom" >
			<div class="slide_text">
			  <div class="slide_text_wrap">
				  <div class="st_top_text">Lavish  .  Love  .  Luminate</div>
				  <div class="st_big_text">LUXURY</div>
				  <div class="st_btm_text">You deserve to experience it</div>
			  </div>
			</div>
			<img src="<?php echo base_url();?>assets/frontend/images/viva_luxury.webp" alt="" />
		  </div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#vivaCarousel" data-bs-slide="prev">
		  <span aria-hidden="true"><i data-feather="arrow-left"></i></span>
		  <span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#vivaCarousel" data-bs-slide="next">
		  <span aria-hidden="true"><i data-feather="arrow-right"></i></span>
		  <span class="visually-hidden">Next</span>
		</button>
	  </div>
</section>
<button type="button" class="vc_btn d-inline-flex justify-content-center d-md-none w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Search Viva Chacala Rentals <i data-feather="search"></i>
</button>

<!-- top serach Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen h-auto">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="exampleModalLabel">Search Viva Chacala Rentals</h2>
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
<div class="search_box d-none d-md-block">
	<div class="search_wrap">
		<?php include(APPPATH.'views/Frontend/property/search-rental.php');?>
	</div>
</div>
<main class="py-3  px-2 px-sm-4 px-lg-0">
	<section class="home_intro py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="hi_desc mx-auto">
						<div class="title mb-4"><h1><?php echo $top_section_content[0]['title'];?></h1></div>
						<div class="mx-auto">
							<div id="ml_content" class="ml_content">
								<?php echo $top_section_content[0]['content'];?>
							</div>
							<button id="mlBtnMore" class="ml_btn mt-2">Read More</button>
						</div>
						<script>
							var offsetHeight = document.getElementById('ml_content').offsetHeight;
							const btn = document.getElementById('mlBtnMore');

							// ✅ Toggle button text on click
							btn.addEventListener('click', function handleClick() {
							const initialText = 'Read More';

							if (btn.textContent.toLowerCase().includes(initialText.toLowerCase())) {
								btn.innerHTML =
								'Read Less';
							} else {
								btn.textContent = initialText;
							}
							});

							if (offsetHeight < 249){
								$(".hi_desc .ml_btn").addClass("d-none");
							}
							$(".ml_btn").click(function(){
								$(".ml_content").toggleClass("more-less");
							});
						</script>
						
					</div>
				</div>
				<div class="col-md-6">
					<div class="hi_imgs_block">
						<div class="row g-2">
							<div class="col text-end">
							  <div class="img_zoom"><img class="mb-2" src="<?php echo base_url();?>assets/frontend/images/img1.jpg" alt="Chacala vacation rentals"/></div>
							  <a class="vc_btn ms-auto" href="<?php echo base_url().'chacala-vacation-rentals';?>" target="_blank" rel="noopener noreferrer"><span>VIEW OUR VILLAS</span><i data-feather="external-link"></i></a></div>
							<div class="col ">
								<div class="img_zoom"><img class="mb-2" src="<?php echo base_url();?>assets/frontend/images/img2.jpg" alt="Chacala rentals"></div>
								<div class="img_zoom"><img src="<?php echo base_url();?>assets/frontend/images/img3.jpg" alt="Marina Chacala rentals"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="discover py-5">
		<div class="container-fluid px-0">
			<div class="row g-0">
				<div class="col">
					<div class="title title_center">
						<h2>Our collection of private villas and beachfront rentals</h2>
					</div>
					<div class="discover_carousel">
						<?php foreach($categoriesPropertiesDataArr as $catPro){
						
							if(isset($catPro['proImage']) && $catPro['proImage']!=''){
								$proImage = base_url().'assets/upload/proImage/small/'.$catPro['proImage'];
							}else{
								$proImage = base_url().'assets/frontend/images/no_img.jpg';
							} 
							
							$showCat = '';
							if(isset($catPro['categoryId']) && $catPro['categoryId']!=''){
								$categoryIdsArr = explode(',',$catPro['categoryId']);
								$showCatArr = array();
								$ci=1;
								foreach($categoryIdsArr as $catId){
									$resCat = filter_array($setupMastersData,$catId,'id');
									if(count($resCat)>0){
										if($ci==1){ 
											$showCatId = $resCat[0]['id'];
											$showCatName = $resCat[0]['name']; 
										}
										$showCatArr[] = $resCat[0]['name']; 
									}
									$ci++;
								}
								$showCat = implode(',  ',$showCatArr);
							
							
						?>
						<div class="dis_item">
							<div class="dis_card">
								<a href="<?php echo base_url().'chacala-vacation-rentals/'.$catPro['slug'];?>">
									<div class="dis_img img_zoom">
										<span class="arrow_btn "><i data-feather="arrow-up-right"></i></span>
										<img class="img-fluid" src="<?php echo $proImage;?>" alt="<?php echo $catPro['name'];?>" />
									</div>
								</a>
								<div class="dis_info">
									<strong><?php echo $showCat;?></strong>
									<h2><?php echo $catPro['name'];?></h2>
									<div class="di_foot">
										<span>From $<?php echo number_format($catPro['avgPrice']);?> USD/night</span>    
										<span>|</span>    
										<a href="<?php echo base_url().'chacala-vacation-rentals?cId='.$showCatId;?>" rel="noopener noreferrer">More <?php echo $showCatName;?></a>
									</div>
								</div>
							</div>
						</div>
						<?php } } ?>						 
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="current_special py-5">
	  <div class="container">
		<div class="row">
		  <div class="col">
			<div class="title"><h2>Current Specials</h2></div>
		  </div>
		</div>
	  </div>
	  <div class="container-fluid">
		<div class="row">
		  <div class="col">
			<div class="currSpecial_carousel">
			<?php foreach($specialsPropertiesDataArr as $specialPro){
			
					if(isset($specialPro['proImage']) && $specialPro['proImage']!=''){
						$proImage = base_url().'assets/upload/proImage/small/'.$specialPro['proImage'];
					}else{
						$proImage = base_url().'assets/frontend/images/no_img.jpg';
					}
			?>
			  <div class="cs_item">
				<div class="unit_card img_zoom">
				  <span class="arrow_btn"><i data-feather="arrow-up-right"></i></span>
				  <div class="uc_img"><img src="<?php echo $proImage;?>" class="img-fluid" alt="<?php echo $specialPro['name'];?>" /></div>
				  <div class="uc_info">
					<div class="uc_name">
					  <a href="<?php echo base_url().'chacala-vacation-rentals/'.$specialPro['slug'];?>" target="_blank" class="stretched-link"><?php echo $specialPro['name'];?></a>
					  <div class="uc_prices">
						<?php if(isset($specialPro['offerPrice']) && $specialPro['offerPrice']!='' && $specialPro['offerPrice']>0){?>
							<s> $<?php echo number_format($specialPro['avgPrice']);?> </s><b>$<?php echo number_format($specialPro['offerPrice']);?></b>
						<?php }else{ ?>
							<b>$<?php echo number_format($specialPro['avgPrice']);?></b>
						<?php } ?>					  
					</div>
					</div>
					
					<div class="ratings">
						<?php if($specialPro['avgRating']==0){?>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<?php }else if($specialPro['avgRating']==1){?>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<?php }else if($specialPro['avgRating']==2){ ?>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<?php }else if($specialPro['avgRating']==3){ ?>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star"></i>
							<i data-feather="star"></i>
							<?php }else if($specialPro['avgRating']==4){ ?>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star"></i>
							<?php }else if($specialPro['avgRating']==5){ ?>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<i data-feather="star" class="rated"></i>
							<?php } ?>
						<small><?php echo $specialPro['reviewsCnt'];?></small>
					  </div>
				  </div>
				</div>
			  </div>
			  <?php } ?>			  
			</div>
		  </div>
		</div>
		<div class="row">
		  <div class="col">
			<div class="cs_foot_text">
			  <a href="<?php echo base_url().'chacala-vacation-rentals?sps=0';?>" class="vc_btn" rel="noopener noreferrer">Explore All Specials <i data-feather="external-link"></i></a>
			</div>
		  </div>
		</div>
	  </div>
	</section>
	<section class="here_why">
	  <div class="hw_img"><img class="img-fluid" src="<?php echo base_url();?>assets/frontend/images/chacala/Viva_Chacala_01.jpg" alt="Chacala"></div>
	  <div class="hw_block">
		<div class="hw_wrap">
		  <h2><?php echo $book_section_content[0]['title'];?></h2>
		  <?php echo $book_section_content[0]['content'];?>
		  <a href="<?php echo base_url().'why-viva-chacala';?>" class="vc_btn" target="_blank" rel="noopener noreferrer">Here's why!</a>
		</div>
	  </div>
	</section>
	<?php if(count($reviewsDataArr)>0){?>
	<section class="reviews py-5">
	  <div class="container">
		  <div class="row">
			  <div class="col">
				  <div class="title">
					  <h2>Recent Reviews</h2>
				  </div>
				  <div class="home_reviews_carousel">
				  <?php foreach($reviewsDataArr as $reviewDetails){?>
					<div class="review_item">
					  <div class="quote_icon">
						<svg width="30" height="24" viewBox="0 0 30 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						  <path d="M2.54513 3.43692C4.64897 1.15614 7.83247 0 12.0057 0H13.5052V4.22717L12.2996 4.4686C10.2452 4.87947 8.81616 5.68771 8.0514 6.87384C7.65236 7.51283 7.42605 8.24447 7.39461 8.99717H12.0057C12.4034 8.99717 12.7848 9.15516 13.066 9.43637C13.3472 9.71759 13.5052 10.099 13.5052 10.4967V20.9934C13.5052 22.6474 12.1601 23.9925 10.5061 23.9925H1.50896C1.11126 23.9925 0.729847 23.8345 0.44863 23.5533C0.167414 23.272 0.00942878 22.8906 0.00942878 22.4929V14.9953L0.0139274 10.6182C0.000431643 10.4517 -0.284479 6.50795 2.54513 3.43692ZM27.0009 23.9925H18.0038C17.6061 23.9925 17.2247 23.8345 16.9434 23.5533C16.6622 23.272 16.5042 22.8906 16.5042 22.4929V14.9953L16.5087 10.6182C16.4952 10.4517 16.2103 6.50795 19.0399 3.43692C21.1438 1.15614 24.3273 0 28.5005 0H30V4.22717L28.7944 4.4686C26.74 4.87947 25.311 5.68771 24.5462 6.87384C24.1472 7.51283 23.9209 8.24447 23.8894 8.99717H28.5005C28.8982 8.99717 29.2796 9.15516 29.5608 9.43637C29.842 9.71759 30 10.099 30 10.4967V20.9934C30 22.6474 28.6549 23.9925 27.0009 23.9925Z" fill="#D2DE32"/>
						  </svg>
					  </div>
					  <div class="quote_block p-3">
						<em><?php echo $reviewDetails['message'];?></em>
						<div class="quote_foot">
						  <div class="qb_by">
							<div class="ratings">
							  <?php if($reviewDetails['rating']==0){?>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<?php }else if($reviewDetails['rating']==1){?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<?php }else if($reviewDetails['rating']==2){ ?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<?php }else if($reviewDetails['rating']==3){ ?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star"></i>
								<i data-feather="star"></i>
								<?php }else if($reviewDetails['rating']==4){ ?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star"></i>
								<?php }else if($reviewDetails['rating']==5){ ?>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<i data-feather="star" class="rated"></i>
								<?php } ?>
							</div>
							<strong><?php echo $reviewDetails['reviewBy'];?></strong>
						  </div>
						</div>
					  </div>
					</div>
					<?php } ?>					
				  </div>
			  </div>
		  </div>
		  <div class="row">
			<div class="col text-center"><a href="<?php echo base_url().'reviews';?>" class="vc_btn mx-auto my-3" rel="noopener noreferrer">Read All Reviews <i data-feather="external-link"></i></a></div>
		  </div>
	  </div>
	</section>
	<?php } ?>
	<section class="two_blocks py-5">
	  <div class="container">
		<div class="row">
		  <div class="col-md-6">
			<div class="tb_link img_zoom">
			  <div class="tb_img">
				<a href="<?php echo base_url().'about-chacala-mexico';?>" class="stretched-link" rel="noopener noreferrer">
				  <span>Chacala</span>
				  <img src="<?php echo base_url();?>assets/frontend/images/nearby.webp" class="img-fluid" alt="Nearby Chacala" />
				</a>
			  </div>
			</div>
		  </div>
		  <div class="col-md-6">
			<div class="tb_link img_zoom">
			  <div class="tb_img">
				<a href="<?php echo base_url().'marina-chacala';?>" class="stretched-link" rel="noopener noreferrer">
				  <span>Marina Chacala</span>
				  <img src="<?php echo base_url();?>assets/frontend/images/slide_one.webp" class="img-fluid" alt="Marina Chacala" />
				</a>				
			  </div>
			</div>
		  </div>
		</div>
		<div class="row">
		  <div class="col">
			<h2 class="big_foot_txt text-center py-5">We take pride in our attention to detail, personalized service, and commitment to exceeding your expectations.</h2>
		  </div>
		</div>
	  </div>
	</section>
</main>
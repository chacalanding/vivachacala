<?php if($propertyDetails['propertyType']==0){?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/Calendar-PickMeUp/css/pickmeup.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/Calendar-PickMeUp/js/jquery.pickmeup.js"></script>
<?php 

if(count($highlight_date)>0){

	foreach($highlight_date as $row){
		$highlight_dates_datepicker[] = "'".date('m/d/Y',$row->checkin_date)."'";
		$highlightout_dates_datepicker[] = "'".date('m/d/Y',$row->checkout_date)."'";
		
		if(date('m',$row->checkin_date)<=10){
			$hmonth = '0'.(date('m',$row->checkin_date)-1);
			//echo 'less';
		}else{
			$hmonth = date('m',$row->checkin_date)-1;
			//echo 'less';
		}
		
		if(date('d',$row->checkin_date)<10){
			$hday = (date('d',$row->checkin_date));
		}else{
			$hday = date('d',$row->checkin_date);
		}
			
		   $highlight_dates[] = date('Y',$row->checkin_date).$hmonth.$hday;
		 
		//echo '<hr>';		 
		//echo  $new_highlight_dates[] = "'".date('m/d/Y',$row->checkin_date)."'-------".date('Y',$row->checkin_date).$hmonth.$hday;
		 
		if(date('m',$row->checkout_date)<=10){
			$ohmonth = '0'.(date('m',$row->checkout_date)-1);
		}else{
			$ohmonth = date('m',$row->checkout_date)-1;
		}
		
		if(date('d',$row->checkout_date)<10){
			$ohday = (date('d',$row->checkout_date));
		}else{
			$ohday = date('d',$row->checkout_date);
		}
			
		 $highlightout_dates[] = date('Y',$row->checkout_date).$ohmonth.$ohday;
		
	}
	
	
	$show_checkin_dates =  implode(',',$highlight_dates);
	$show_checkout_dates =  implode(',',$highlightout_dates);
  
	  // echo '<pre>';
	 // print_r($highlight_dates);die;
	$checkin_dates_datepiecker =  implode(',',$highlight_dates_datepicker);
	$checkout_dates_datepiecker =  implode(',',$highlightout_dates_datepicker);
	
}else{

	$show_checkin_dates = '';
	$show_checkout_dates = '';
	
	$checkin_dates_datepiecker =  '';
	$checkout_dates_datepiecker =  '';
	
}

?>

<script type="text/javascript">

$(function () {
<?php if(isset($show_checkin_dates) && $show_checkin_dates!=''){	?>
	var checkin_date = [<?php echo $show_checkin_dates;?>];
<?php }else{ ?>
	var checkin_date = [];
<?php } ?>
<?php if(isset($show_checkout_dates) && $show_checkout_dates!=''){	?>
	var checkout_date = [<?php echo $show_checkout_dates;?>];
<?php }else{ ?>
	var checkout_date = [];
<?php } ?>
//var checkin_date = ['2017-08-19','2017-10-15', '2017-10-17', ];
Array.prototype.inArray = function( needle ){
	return Array(this).join(",").indexOf(needle) >-1;
}

var map = {};
for (var k=0; k < checkin_date.length; ++k) {
  map[checkin_date[k]] = true; 
}

function is_in_map(key) {
  try {
    return map[key] === true;
  } catch (e) {
    return false;
  }
}

var map_out = {};
for (var k=0; k < checkout_date.length; ++k) {
  map_out[checkout_date[k]] = true;
}

function is_in_map_out(key) {
  try {
    return map_out[key] === true;
  } catch (e) {
    return false;
  }
}


var cmp_data='';
	$('.calendars3').pickmeup({
		first_day	:0,
		calendars : 3,
		nearmonths: 2,
		mode : 'multiple',
		flat : true,
		<?php if(isset($show_checkin_dates) && $show_checkin_dates!=''){	?>
		//date : checkin_date,
		<?php } ?>
		 render: function(date) {
		 var cmp_data='';
		 var cmonth = parseInt(date.getMonth());
		 if(cmonth<10){
		 	var ncmonth='0'+date.getMonth();
		 }else{
		 	var ncmonth=date.getMonth();
		 }
		 var cday = parseInt(date.getDate());
		 if(cday<10){
 		 	var ncday='0'+date.getDate();
		 }else{
		 	var ncday=date.getDate();
		 }  
		 var cmp_data = date.getFullYear()+''+ncmonth+''+ncday; 
		 // alert(cmp_data);
		 if(is_in_map(cmp_data)===true || is_in_map_out(cmp_data)===true){
		       
			 if(is_in_map(cmp_data)===true && is_in_map_out(cmp_data)===true){
			 	return {
                    selected   : true,
                    class_name : 'selected'
                }
 			 }else if(is_in_map(cmp_data)===true){
			 	return {
                    selected   : true,
                    class_name : 'checkin_booked'
                }
			 }else{
			 	return {
                    selected   : true,
                    class_name : 'checkout_booked'
                }
			 }  
           }else{
		   		return {
                    disabled   : true,
                    class_name : 'disabled'
                }
		   }	
        }
	});
	
});
</script>
	

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
<div class="search_box inner_page_search_bar d-none d-md-block">
	<div class="search_wrap">
		<?php include(APPPATH.'views/Frontend/property/search-rental.php');?>
	</div>
</div>
<?php } ?>


<div class="rental_top_grid">
  <div class="imgs_grid">  
  	<?php 
		$moreImagesArr = getMoreImagesCh($propertyDetails['propertyId'],'0'); 
		if(isset($propertyDetails['proImage']) && $propertyDetails['proImage']!=''){
			$proImage = base_url().'assets/upload/proImage/'.$propertyDetails['proImage'];
		}else{
			$proImage = base_url().'assets/frontend/images/no_img.jpg';
		}
	?>
	<div class="grid_img img_zoom">
	<?php if(count($moreImagesArr)>0){ ?><a href="#" class="vc_btn"data-bs-toggle="modal" data-bs-target="#RentalGallery"><i data-feather="image" class="me-2"></i>View All Photos</a><?php } ?>
	<img class="img-fluid" src="<?php echo $proImage;?>" alt="<?php echo $propertyDetails['name'];?>" /></div>
	
	<?php 
	if(count($moreImagesArr)>0){ 
	$m=1; foreach($moreImagesArr as $imgDetails){ if($m<=4){?>
		<div class="grid_img img_zoom">
			<img class="img-fluid" src="<?php echo base_url().'assets/upload/proImage/small/'.$imgDetails['imageName'];?>" alt="<?php echo $propertyDetails['name'];?>" />
		</div>
	<?php $m++; } } } ?>
  </div>
</div>

<main class="py-3 px-2 px-sm-4 px-lg-0">
	<div class="rental_details mb-5 pb-5 ">
	  <div class="container">
		<div class="row g-lg-5 g-2">
		  <div class="col-lg-7">
			<div class="uc_info border-bottom pb-3 mb-3">
			  <div class="uc_name">
				<h1><?php echo $propertyDetails['name'];?></h1>
				<?php if($propertyDetails['propertyType']==0){?>
				<ul class="uc_features">
 				  <li><?php echo $propertyDetails['guests'];?> Guests  </li>   
				  <li><?php echo $propertyDetails['bedrooms'];?> Bedrooms </li>    
				  <li><?php echo $propertyDetails['beds'];?> Beds </li>    
				  <li><?php echo $propertyDetails['bathrooms'];?> Bathrooms</li>
 				</ul>
				
				<ul class="uc_season_prices">
					<li>High Season/nt:  <b>$<?php echo number_format($propertyDetails['avgPrice']);?> USD<sup>*</sup></b></li>
					<?php if(isset($propertyDetails['lowSeason']) && $propertyDetails['lowSeason']!='' && $propertyDetails['lowSeason']>0){?>
					<li>Low Season:  <b>$<?php echo number_format($propertyDetails['lowSeason']);?> USD<sup>*</sup></b></li>
					<?php } if(isset($propertyDetails['deposit']) && $propertyDetails['deposit']!='' && $propertyDetails['deposit']>0){?>
					<li>Deposit:  <b>$<?php echo number_format($propertyDetails['deposit']);?> USD<sup>*</sup></b></li>
					<?php } ?>
				</ul>
				<p class="mb-0"><small>*Prices are approximate.  Please contact us for a price quote and/or and potential discounts.</small></p>
				<?php } ?>
				<?php if($propertyDetails['propertyType']==2){?>
				<!--Real estate start-->
                    <ul class="re_pro_high mt-4">
                      <li>
                          <div class="reph_box">
                              <div class="reph_icon"><i class="al_icon tag_icon"></i></div>
                              <div class="reph_text">
                                  <small>Price</small>
                                  <strong>$<?php echo number_format($propertyDetails['avgPrice']);?> USD</strong>
                              </div>
                          </div>
                      </li>
                      <li>
                          <div class="reph_box">
                              <div class="reph_icon"><i class="al_icon bed_icon"></i></div>
                              <div class="reph_text">
                                  <small>Bedrooms</small>
                                  <strong><?php echo $propertyDetails['bedrooms'];?></strong>
                              </div>
                          </div>
                      </li>
                      <li>
                          <div class="reph_box">
                              <div class="reph_icon"><i class="al_icon bath_icon"></i></div>
                              <div class="reph_text">
                                  <small>Bathrooms</small>
                                  <strong><?php echo $propertyDetails['bathrooms'];?></strong>
                              </div>
                          </div>
                      </li>
                    </ul>
                    <!--Real estate end-->
				<?php } ?>	
			  </div>
			</div>
			<?php if($propertyDetails['propertyType']==2){?>
			<!--Real estate start-->
                <div class="re_pro_detail_box mb-5">
                      <h4 class="mb-3">Property Details</h4>
                      <ul class="re_pro_features p-0">
                          <li><small>Age</small><span><?php echo $propertyDetails['reAge'];?> Yrs</span></li>
                          <li><small>View</small><span><?php echo $propertyDetails['reView'];?></span></li>
                          <li><small>Approx. Land</small><span><?php echo number_format($propertyDetails['reApproxLand']);?></span></li>
                          <li><small>Furnished</small><span><?php if($propertyDetails['reFurnished']==1){echo 'Yes';}else{echo 'No';}?></span></li>
                          <li><small>Parking</small><span><?php echo $propertyDetails['reParking'];?></span></li>
                          <li><small>Approx. Building</small><span><?php echo number_format($propertyDetails['reApproxBuilding']);?></span></li>
                      </ul>
                </div>
                <!--Real estate end-->
			<?php } ?>		
			<!-- <div class="uc_descp mb-5">
                  <div class="content">
                  	<//?php echo $propertyDetails['proDesc'];?>
                  </div>
                  <button class="ml_btn mt-2" onclick="return readMore(this)">Read More</button>
            </div> -->
			<div class="uc_descp mb-5">
                  <div id="ml_content" class="ml_content">
                  	<?php echo $propertyDetails['proDesc'];?>
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
					$(".uc_descp .ml_btn").addClass("d-none");
				}
				$(".ml_btn").click(function(){
					$(".ml_content").toggleClass("more-less");
				});
			</script>
			<?php if(isset($propertyDetails['videoURL']) && $propertyDetails['videoURL']!=''){?>
			<div class="uc_video mb-5">
			  <h4>Attraction</h4>
			  <div class="uc_vdo_box">
				<iframe width="100%" height="450" src="<?php echo $propertyDetails['videoURL'];?>" title="YouTube video player" frameborder="0" ></iframe>
			  </div>
			</div>
			<?php } ?>
			
			
				
				<?php if(isset($propertyDetails['keyFeatures']) && $propertyDetails['keyFeatures']!=''){ ?>
			<div class="uc_ket_features mb-5">
			  <h4>Key Features</h4>
			  <div class="row row-cols-1 row-cols-sm-2 g-0">
				<div class="col">
				  <?php echo $propertyDetails['keyFeatures'];?>
				</div>				
			  </div>
			</div>
			<?php } 
			
			if(isset($propertyDetails['amenities']) && $propertyDetails['amenities']!=''){ 
			
				$amenitiesArr = explode(',',$propertyDetails['amenities']);
				$amenities_categories = $this->config->item('amenities_categories_types_array_config');
			?>
				<div class="uc_amenities mb-5">
				
					<?php foreach($amenities_categories as $key=>$value){ ?>
					 
					<h4> <?php echo $value['name'];?></h4>
					<ul class="amenities_list">
					<?php
						for($a=0;$a<count($amenitiesArr);$a++){
							$amResArr = filter_array($amenitiesMasterDataArr,$amenitiesArr[$a],'id'); 
							if(count($amResArr)>0){
								if($amResArr[0]['catId']==$key){
 									//if($a==0){ echo '<h4>'.$value['name'].'</h4> <ul class="amenities_list">'; }
 									echo '<li>'.$amResArr[0]['name'].'</li>';
									//if($a==(count($amenitiesArr))){ echo '</ul>';}
								}
							}
						}			 
					?>
					 </ul>
				
			<?php } ?>
			</div>
			<!--<div class="uc_amenities mb-5">
			  <h4>Amenities</h4>
			   <ul class="amenities_list">
			   	<?php //for($a=0;$a<count($amenitiesArr);$a++){?>
					<?php //$amResArr = filter_array($amenitiesMasterDataArr,$amenitiesArr[$a],'id'); if(count($amResArr)>0){echo '<li>'.$amResArr[0]['name'].'</li>';}?>
				<?php //} ?>
			   </ul>
			</div>-->
			<?php } ?>
			<div class="uc_calendar mb-5">
			<?php if($propertyDetails['propertyType']==0){?>
			  <h4>Calendar</h4>
			  <div class="cal_box mb-3">
			  
			  
			  <div class="booking_indicators">
					 <div class="indi_box"><span class="available_status"></span> Available Dates</div>
					 <div class="indi_box"><span class="booked_status"></span> Booked Dates</div>
					 <div class="indi_box"><span class="checkin_status"></span> Check-In Dates</div>
					 <div class="indi_box"><span class="checkout_status"></span> Check-Out Dates</div>
				</div>
				<div class="calendars3" data-pmu-format="Y-m-d"></div>
				</div>
				<?php } ?>
			  
			  <?php if((isset($propertyDetails['checkIn']) && $propertyDetails['checkIn']!='') || (isset($propertyDetails['checkOut']) && $propertyDetails['checkOut']!='') || (isset($propertyDetails['addInfo']) && $propertyDetails['addInfo']!='')){ ?>
			  <h4>Additional Information</h4>
			  <div class="pb-4 border-bottom mb-5 mt-3">
			  	<?php if((isset($propertyDetails['checkIn']) && $propertyDetails['checkIn']!='') || (isset($propertyDetails['checkOut']) && $propertyDetails['checkOut']!='')){ ?>
				<div class="d-flex gap-5 ">
					<?php if(isset($propertyDetails['checkIn']) && $propertyDetails['checkIn']!=''){?>
				  <div class="ai_box">
					<div class="ai_icon">
					  <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M20.8334 35.7524H10.0001C9.11603 35.7524 8.26818 35.4013 7.64306 34.7761C7.01794 34.151 6.66675 33.3032 6.66675 32.4191V12.4191C6.66675 11.5351 7.01794 10.6872 7.64306 10.0621C8.26818 9.43696 9.11603 9.08577 10.0001 9.08577H30.0001C30.8841 9.08577 31.732 9.43696 32.3571 10.0621C32.9822 10.6872 33.3334 11.5351 33.3334 12.4191V20.7524M26.6667 5.75244V12.4191M13.3334 5.75244V12.4191M6.66675 19.0858H33.3334" stroke="#016A70" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M35 30.7524L25 30.7524M25 30.7524L30 25.7524M25 30.7524L30 35.7524" stroke="#016A70" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
					<div>
					  <b><?php if($propertyDetails['propertyType']==1){echo 'Open';}else{echo 'Check-in';}?></b>
					  <span><?php echo $propertyDetails['checkIn'];?></span>
					</div>
				  </div>
				  <?php } if(isset($propertyDetails['checkOut']) && $propertyDetails['checkOut']!=''){?>
				  <div class="ai_box">
					<div class="ai_icon">
					  <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M20.8334 35.7524H10.0001C9.11603 35.7524 8.26818 35.4013 7.64306 34.7761C7.01794 34.151 6.66675 33.3032 6.66675 32.4191V12.4191C6.66675 11.5351 7.01794 10.6872 7.64306 10.0621C8.26818 9.43696 9.11603 9.08577 10.0001 9.08577H30.0001C30.8841 9.08577 31.732 9.43696 32.3571 10.0621C32.9822 10.6872 33.3334 11.5351 33.3334 12.4191V20.7524M26.6667 5.75244V12.4191M13.3334 5.75244V12.4191M6.66675 19.0858H33.3334" stroke="#016A70" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M25 30.7524L35 30.7524M35 30.7524L30 35.7524M35 30.7524L30 25.7524" stroke="#016A70" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
					<div>
					  <b><?php if($propertyDetails['propertyType']==1){echo 'Close';}else{echo 'Check-out';}?></b>
					  <span><?php echo $propertyDetails['checkOut'];?></span>
					</div>
				  </div>
				  <?php } ?>
				</div>
				<?php } if(isset($propertyDetails['addInfo']) && $propertyDetails['addInfo']!=''){?>
				<div class="mt-4"><?php echo $propertyDetails['addInfo'];?></div>
				 <?php } ?>
			  </div>
			  <?php } ?>
			</div>
			 
			
			 <?php if(isset($propertyDetails['latitude']) && $propertyDetails['latitude']!='' && isset($propertyDetails['longitude']) && $propertyDetails['longitude']!='' && $propertyDetails['propertyType']!=1){?>	
 		 
			<div class="uc_location mb-5">
			  <h4>Location</h4>
			  <div class="loc_box">
				 <div class="google_map" id="google_map" data-latitude="<?php echo $propertyDetails['latitude'];?>" data-longitude="<?php echo $propertyDetails['longitude'];?>" style="overflow: hidden;"></div>
			  </div>
			</div>
			 <?php } 
			 if(count($reviewsDataArr)>0){?>
			<div class="uc_reviews mb-5">
			  <h4>Reviews from <?php echo $propertyDetails['name'];?> guests</h4>
			  <div class="review_list">
			  <?php foreach($reviewsDataArr as $reviewDetails){?>
				<div class="review_item">
				  <div class="quote_icon">
					<svg width="30" height="24" viewBox="0 0 30 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					  <path d="M2.54513 3.43692C4.64897 1.15614 7.83247 0 12.0057 0H13.5052V4.22717L12.2996 4.4686C10.2452 4.87947 8.81616 5.68771 8.0514 6.87384C7.65236 7.51283 7.42605 8.24447 7.39461 8.99717H12.0057C12.4034 8.99717 12.7848 9.15516 13.066 9.43637C13.3472 9.71759 13.5052 10.099 13.5052 10.4967V20.9934C13.5052 22.6474 12.1601 23.9925 10.5061 23.9925H1.50896C1.11126 23.9925 0.729847 23.8345 0.44863 23.5533C0.167414 23.272 0.00942878 22.8906 0.00942878 22.4929V14.9953L0.0139274 10.6182C0.000431643 10.4517 -0.284479 6.50795 2.54513 3.43692ZM27.0009 23.9925H18.0038C17.6061 23.9925 17.2247 23.8345 16.9434 23.5533C16.6622 23.272 16.5042 22.8906 16.5042 22.4929V14.9953L16.5087 10.6182C16.4952 10.4517 16.2103 6.50795 19.0399 3.43692C21.1438 1.15614 24.3273 0 28.5005 0H30V4.22717L28.7944 4.4686C26.74 4.87947 25.311 5.68771 24.5462 6.87384C24.1472 7.51283 23.9209 8.24447 23.8894 8.99717H28.5005C28.8982 8.99717 29.2796 9.15516 29.5608 9.43637C29.842 9.71759 30 10.099 30 10.4967V20.9934C30 22.6474 28.6549 23.9925 27.0009 23.9925Z" fill="#D2DE32"/>
					  </svg>
				  </div>
				  <div class="quote_block">
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
						<?php if(isset($reviewDetails['location']) && $reviewDetails['location']!=''){?><span><?php echo $reviewDetails['location'];?></span><?php } ?>
					  </div>
					  <span><?php echo date('M d, Y',$reviewDetails['lastUpdatedOn']);?></span>
					</div>
				  </div>
				</div>
				<?php } ?>				
			  </div>			  
			</div>
			<?php } ?>
		  </div>
		  <div class="col-lg-5">
			<div class="pt-lg-5 sticky-md-top">
			  <div id="onwerInfo">
			  <?php if($propertyDetails['propertyType']==1){ ?>
			  
			  <?php if(isset($propertyDetails['latitude']) && $propertyDetails['latitude']!='' && isset($propertyDetails['longitude']) && $propertyDetails['longitude']!=''){?>	
			  <div class="google_map" id="google_map" data-latitude="<?php echo $propertyDetails['latitude'];?>" data-longitude="<?php echo $propertyDetails['longitude'];?>" style="overflow: hidden;"></div>
			  <?php } ?>	
			  
			  <div class="busOwnerInfo">
			<?php if(isset($propertyDetails['locIframeSrc1']) && $propertyDetails['locIframeSrc1']!=''){?>
			  <iframe src="<?php echo $propertyDetails['locIframeSrc'];?>" width="100%" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			  <?php } ?>
			  
			  
	  
			  
			  <div class="boi_info_details">
					<ul class="boi_info">
						<li><small class="me-1">Owner: </small><b><?php echo $propertyDetails['businessOwner'];?></b></li>
						<li><small class="me-1">Email: </small><b><?php echo $propertyDetails['businessOwnerEmail'];?></b></li>
					</ul>
				</div>
				</div>
			  <?php }else{ ?>
			  	<div class="form_wrap mx-auto mt-lg-3">
				<form id="bookRequestFrm" action="home/bookingRequestEntry" method="post" class="request_booking_form">
					<input type="hidden" id="h_propertyId" name="h_propertyId" value="<?php echo $propertyDetails['propertyId'];?>" />
					<input type="hidden" id="h_propertyType" name="h_propertyType" value="<?php echo $propertyDetails['propertyType'];?>" />
					<input type="hidden" id="h_propertyName" name="h_propertyName" value="<?php echo $propertyDetails['name'];?>" />
					<input type="hidden" id="h_base_url" name="h_base_url" value="<?php echo base_url();?>" />
					<input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url');?>" />
					<h4 class="mb-4">
					<?php if($propertyDetails['propertyType']==0){					
						echo 'Request Booking and/or Info';
					}else if($propertyDetails['propertyType']==1){
						echo 'Contact Owner';
					}else{
						echo 'Send Email to Owner/Seller';
					} ?>
					</h4>
					<div id="resDisplay"></div>
					<div id="bfFields">
						<?php if($propertyDetails['propertyType']==0){?>
						<div class="input-daterange row gx-2">
							<div class="col-sm-6 form-group">
								<input type="text" class="form-control down_arrow input_icon mb-2 text-start" id="rbfArrive" name="rbfArrive" value="" placeholder="Arrive" />
							</div>
							<div class="col-sm-6 form-group">
								<input type="text" class="form-control down_arrow input_icon mb-2 text-start" id="rbfDepart" name="rbfDepart" value="" placeholder="Depart" />
							</div>
						</div>
						
					<script type="text/javascript">
					$(document).ready(function() {
						var date = new Date();	 
						//https://stackoverflow.com/questions/33951780/end-date-must-be-equal-and-greater-than-start-selected-date-in-boostrap
						$('#rbfArrive').datepicker({
							format: "mm/dd/yyyy",
							autoclose: true,
							startDate: date,
							datesDisabled: [<?php echo $checkin_dates_datepiecker;?>], 
							//endDate: new Date
							//todayHighlight: true
						}).on('changeDate', function (selected) {
							var startDate = new Date(selected.date.valueOf());
							$('#rbfDepart').datepicker('setStartDate', startDate);
							$('#rbfDepart').datepicker('show');
						}).on('clearDate', function (selected) {
							$('#rbfDepart').datepicker('setStartDate', null);
							$('#rbfDepart').datepicker('show');
						});
						
						$('#rbfDepart').datepicker({
							format: "mm/dd/yyyy",
							autoclose: true,
							startDate: date,
							datesDisabled: [<?php echo $checkout_dates_datepiecker;?>], 
							//todayHighlight: true
						});
						
					});
					</script>
						<?php } ?>
						<div class="row gx-2">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control required mb-2" id="rbfName" name="rbfName" placeholder="Your Name" />
							</div>
							<div class="col-md-6 form-group">
								<input type="text" class="form-control email required mb-2" id="rbfEMail" name="rbfEMail" placeholder="Email Address" />
							</div>
							<div class="col-md-6 form-group">
								<input type="text" class="form-control required mb-2" id="rbfPhone" name="rbfPhone" placeholder="Phone" />
							</div>
							<?php if($propertyDetails['propertyType']==0){?>
							<?php $adult_children_options = $this->config->item('adult_children_options_array_config');?>
							<div class="col-md-12">
								<div class="row gx-2">
									<div class="col-6 mb-2 form-group">
										<select name="adults" id="adults" class="form-select required">
											<option value="0">Adults</option>
											<?php foreach($adult_children_options as $key=>$value){?>
											<option value="<?php echo $key;?>"><?php echo $value['name'];?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-6 mb-2 form-group">
										<select name="children" id="children" class="form-select">
											<option value="0">Children</option>
											<?php foreach($adult_children_options as $key=>$value){?>
											<option value="<?php echo $key;?>"><?php echo $value['name'];?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="col-md-12 form-group">
								<textarea name="txtMessage" id="txtMessage" class="form-control mb-2" cols="10" rows="3" placeholder="Message"></textarea>
							</div>
							<div class="col-md-12">
								<button type="submit" id="submitBtn" class="vc_btn justify-content-center w-100">Send</button>
							</div>
						</div>
					</div>
				</form>
				<div class="head_phns mt-3 justify-content-center">
					<img src="<?php echo base_url();?>assets/frontend/images/bi_phone-fill.svg" alt=""/>
					<ul class="phn_nmbrs m-0 ps-0">
						<li><small class="me-1">MEX: </small><a href="tel:<?php echo $configurationDetails->mexPhone;?>"><?php echo $configurationDetails->mexPhone;?></a></li>
						<li><small class="me-1">USA: </small><a href="tel:<?php echo $configurationDetails->usaPhone;?>"><?php echo $configurationDetails->usaPhone;?></a></li>
					</ul>
				</div>
				<script>
					$(document).ready(function(){
						$('#bookRequestFrm').validate({
							ignore: [], 
							highlight: function(element) {
								$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
							},
							success: function(element) {
								element.closest('.form-group').removeClass('has-error').addClass('has-success');
								element.remove();
							},			
							errorElement: 'label',
							errorClass: 'error',
							errorPlacement: function (error, element) {
								if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
									error.insertAfter(element.parent().parent());
								}else {
									error.insertAfter(element);
								}
							},
							submitHandler: function(form){
								var btnText = $('#submitBtn').html();
								var site_base_url = $('#h_base_url').val();
								var ajax_base_url = $('#h_ajax_base_url').val();
								var form = $('#bookRequestFrm');
								var url = ajax_base_url+form.attr('action');
								$.ajax({
									type: "POST",
									url: url,
									data: form.serialize(), // serializes the form's elements.
									beforeSend: function(){
										$('#submitBtn').prop("disabled", true);
										$('#submitBtn').html('Please Wait <i class="fas fa-spinner fa-spin"></i>');
									},
									success: function(result, status, xhr){//alert(result);
									console.log('AJAX result:', result);
										var result_arr = result.split('||')
										if(result_arr[0]=='success'){
											$('#resDisplay').html('<div class="alert alert-success my-3 rounded-0" role="alert">'+result_arr[1]+'</div>');
											$('#bookRequestFrm')[0].reset();
											$("div").removeClass("has-error");
											$("div").removeClass("has-success");
											$('#submitBtn').html(btnText);
											//$('#bfFields').remove();
										}else{
											$('#resDisplay').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
											$('#submitBtn').prop("disabled", false);
											$('#submitBtn').html(btnText);
										}
									},
									error: function(xhr, status, error_desc){
										$('#resDisplay').html('<div class="alert alert-danger">'+error_desc+'</div>');
										$('#submitBtn').prop("disabled", false);
										$('#submitBtn').html(btnText);
									}
								});		
								return false;
							}
						});
					});
				</script>
				</div>
				<?php } ?>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</main>
<a href="#onwerInfo" class="flotting_btn shadow-lg d-lg-none"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></a>
<?php if(count($moreImagesArr)>0){ ?>
<div class="modal fade rent_gallery_modal" id="RentalGallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="RentalGalleryLabel" aria-hidden="true">
  <div class="modal-dialog  modal-fullscreen">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body">
          <h3 class="modal-title mx-auto text-center mb-4" id="RentalGalleryLabel"><?php echo $propertyDetails['name'];?></h3>
          <div id="carouselRentalGallery" class="carousel slide rent_gallery" data-bs-ride="carousel">
              <div class="carousel-inner">			  
				<?php $i=1;foreach($moreImagesArr as $imgDetails){?>
				<div class="carousel-item <?php if($i==1){echo 'active';}?>">
					<img src="<?php echo base_url().'assets/upload/proImage/'.$imgDetails['imageName'];?>" class="rental_gallery_img" alt="<?php echo $propertyDetails['name'];?>" />
				</div>				 
				<?php $i++;} ?> 				
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselRentalGallery" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselRentalGallery" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
              
              <!-- <div class="carousel-indicators mt-3">
                  <button type="button" data-bs-target="#carouselRentalGallery" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselRentalGallery" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselRentalGallery" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div> -->
            </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php if(isset($propertyDetails['latitude']) && $propertyDetails['latitude']!='' && isset($propertyDetails['longitude']) && $propertyDetails['longitude']!=''){?>			  
<script>
function initMap(){$('#google_map').each(function(){var map;var latitudeRentalPage=$('#google_map').attr('data-latitude');var longitudeRentalPage=$('#google_map').attr('data-longitude');var defaultLatLng=(latitudeRentalPage&&longitudeRentalPage)? new google.maps.LatLng(latitudeRentalPage,longitudeRentalPage):new google.maps.LatLng(<?php echo $propertyDetails['latitude'];?>,<?php echo $propertyDetails['longitude'];?>);var zoom=(latitudeRentalPage&&longitudeRentalPage)?16:15;var mapOptions={zoom:zoom,center:defaultLatLng,mapTypeId:google.maps.MapTypeId.ROADMAP,styles:[{featureType:"poi",elementType:"labels",stylers:[{visibility:"off"}]}]};map=new google.maps.Map(document.getElementById('google_map'),mapOptions);var markerLatLng=new google.maps.LatLng(latitudeRentalPage,longitudeRentalPage);var marker=new google.maps.Marker({position:markerLatLng,map:map})})}   
</script>
<script defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMJ9w_bJFTF3UE3271-OE25bHgdUK_iKM&callback=initMap"></script>

<?php } ?>	
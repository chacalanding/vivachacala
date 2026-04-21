<div class="page_title">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col"><h1><?php echo $title;?></h1></div>
        </div>
    </div>
</div>

<main class="py-3">
	<div class="rental_listing mb-5 pb-5">
	  <div class="container-lg container-fluid">
		<div class="row">
		  <div class="col">
			<div class="review_list main_review_page">
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
	  </div>
	</div>
</main>
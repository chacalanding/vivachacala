<!DOCTYPE html>
<html lang="en">
<head>
	<?php $version = '3.2.13';?><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url();?>android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>favicon-16x16.png">
    <link rel="manifest" href="<?php echo base_url();?>manifest.json">
	
	<?php if(isset($metaTitle) && $metaTitle!=''){?><title><?php echo $metaTitle;?></title>
	<?php }else{ ?><title><?php if(isset($title) && $title!=''){echo $title.' - ';}?>Viva Chacala</title>
	<?php } ?><meta name="description" content="<?php if(isset($metaDesc) && $metaDesc!=''){ echo $metaDesc; }else{ echo 'Book with Viva Chacala for a Guaranteed Luxury Mexico Tropical Vacation. Best rates on 20+ owner-direct Chacala vacation rentals. No additional fees!'; }?>" />
	<meta name="keywords" content="<?php if(isset($metaKeyword) && $metaKeyword!=''){ echo $metaKeyword; }else{ echo 'Chacala, Marina Chacala, Chacala vacation rentals, Chacala rentals, Marina Chacala rentals'; }?>" />

	<link href="<?php echo base_url();?>assets/frontend/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/media.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/slick.css">
	<script src="<?php echo base_url();?>assets/backend/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/jquery-migrate-1.2.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/frontend/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/jquery.validate.min.js" type="text/javascript"></script>
	<script defer src="<?php echo base_url();?>assets/frontend/js/all.js"></script>
	<script src="<?php echo base_url();?>assets/frontend/js/feather.min.js"></script> 
	
	<!--datepicker-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/css/bootstrap-datepicker.min.css" />
	<script src="<?php echo base_url();?>assets/frontend/js/bootstrap-datepicker.min.js"></script> 
  <!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-VQ16PS1E1T"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-VQ16PS1E1T'); </script>
  <style>
  /*iframe.skiptranslate, .goog-te-banner-frame, #google_translate_element {
    display: none !important;
}
.header_sayulita .select_block .select {
  display: none;
  position: absolute;
  border: 1px solid #dedede;
  background: white;
  z-index: 10;
  -moz-box-shadow: 0 0 5px 0 rgba(34, 25, 25, 0.2);
  -webkit-box-shadow: 0 0 5px 0 rgba(34, 25, 25, 0.2);
  box-shadow: 0 0 5px 0 rgba(34, 25, 25, 0.2);
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
}

.header_sayulita .select_block.selected .select {
  display: block;
}*/
iframe span.indicator{ color:#FF0000 !important }
iframe span.text{ color:#FF0000 !important}
  </style>
</head>
<body>
 
    <header id="header" class="header_sayulita">
	

        <nav class="navbar navbar-expand-xl <?php if(isset($homePageSts) && $homePageSts!='' && $homePageSts==1){echo 'position-absolute';}else{echo 'bg-white';}?> vc_header" data-bs-theme="light">
            <div class="container-fluid">
              <a class="navbar-brand" href="<?php echo base_url();?>">
                <img class="vc_logo" src="<?php echo base_url();?>assets/frontend/images/viva-chacala-logo.svg" alt="Viva Chacala logo" />
                <img class="vc_logo_white" src="<?php echo base_url();?>assets/frontend/images/viva-chacala-logo-white.svg" alt="Viva Chacala logo" />
              </a>
              <button class="navbar-toggler icon_btn order-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                <i data-feather="grid"></i>
              </button>
            <div class="offcanvas offcanvas-start" id="mobileMenu" aria-labelledby="mobileMenu">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mx-auto">
					 	            <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url().'chacala-vacation-rentals';?>">Private Villas</a>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Our Services</a>
                          <ul class="dropdown-menu  dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo base_url().'viva-guest-services';?>">Guest Services</a></li>
							              <li><a class="dropdown-item" href="<?php echo base_url().'viva-owner-services';?>">Owner Services</a></li>
                          </ul>
                        </li>
                        <li class="nav-item dropdown mega_menu">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Explore Chacala</a>
                          <div class="dropdown-menu ">
                            <div class="container">
                              <div class="row">
                                <div class="col">
                                  <ul class="sub_menu_list mb-4">
                                    <li><strong>The Area</strong></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'about-chacala-mexico';?>">Chacala</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'marina-chacala';?>">Marina Chacala</a></li>
                                  </ul>
                                  <ul class="sub_menu_list">
                                    <li><strong>Beaches</strong></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'viva-beaches/#BocaDeChila';?>">Boca de Chila</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'viva-beaches/#LaCaleta';?>">La Caleta</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'viva-beaches';?>">Chacala Beach</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'viva-beaches/#Chacalilla';?>">Chacalilla Beach</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'viva-beaches/#LasCuevas';?>">Las Cuevas</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'viva-beaches/#ElNaranjo';?>">El Naranjo</a></li>
                                  </ul>
                                </div>
                                <div class="col">
                                  <ul class="sub_menu_list">
                                    <li><strong>Activities</strong></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Banana_Boat';?>">Banana Boat</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Birding';?>">Birding </a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Eating_Out';?>">Eating Out</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Festivals';?>">Festivals</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#For_Kids';?>">For Kids</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Open_Water_Swimming';?>">Open Water Swimming</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Saturday_Market';?>">Saturday Market</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Sport_Fishing';?>">Sport Fishing </a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#SUP';?>">SUP</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Surfing';?>">Surfing </a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Hike';?>">Volcano Hike    </a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-activities/#Whale_Watching';?>">Whale Watching</a></li>
                                  </ul>
                                </div>
                                <div class="col">
                                  <ul class="sub_menu_list">
                                    <li><strong>Community</strong></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'community/#atm';?>">ATMs/Money</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'community/#Chacala_Cultural_Foundation';?>">Chacala Cultural Foundation</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'community';?>">Community Calendar</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'community/#El_Jardin_School';?>">El Jardin Montessori</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'community/#Cambiando_Vidas';?>">Cambiando Vidas</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'community/#Getting_Around';?>">Getting Around</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'community/#Medical_Services';?>">Medical Services</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'community/#Safety';?>">Safety</a></li>
                                  </ul>
                                </div>
                                <div class="col">
                                  <ul class="sub_menu_list">
                                    <li><strong>Maps</strong></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-maps/#ab';?>">Area Beaches</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-maps/#cmc';?>">Chacala / Marina Chacala</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-maps/#rm';?>">Regional Map</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url().'chacala-maps/#vh';?>">Volcano Hike Map</a></li>
                                  </ul>
                                </div>
                                <!-- <div class="col">
                                  <ul class="sub_menu_list">
                                    <li><strong>Maps</strong></li>
                                    <li><a class="dropdown-item" href="/">Arriving From The Airport</a></li>
                                    <li><a class="dropdown-item" href="/">Chacala Village</a></li>
                                    <li><a class="dropdown-item" href="/">Hiking Maps</a></li>
                                    <li><a class="dropdown-item" href="/">Local Business Map</a></li>
                                    <li><a class="dropdown-item" href="/">Marina Chacala</a></li>
                                    <li><a class="dropdown-item" href="/">Swim / SUP Routes</a></li>
                                  </ul>
                                </div> -->
                              </div>
                            </div>
                          </div>
                          
                        </li>
						            <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url().'local-chacala-business';?>">Businesses</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url().'chacala-mexico-real-estate';?>">Real Estate</a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">About Us</a>
                          <ul class="dropdown-menu  dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo base_url().'why-viva-chacala';?>">Why VivaChacala?</a></li>
							              <li><a class="dropdown-item" href="<?php echo base_url().'team';?>">Team</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url().'reviews';?>">Reviews</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url().'contact-us';?>">Contact</a></li>
                          </ul>
                        </li> -->
						              
                        <!--<li class="nav-item dropdown">
                        
                         <div class="lang_block select_block en selected"> <div class="selected_text"> <span>ENG</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg> </div> <div class="select px-3 py-2" translate="no"> <div class="en" data-id="en" data-placeholder="ENG"> <span>ENG</span> </div> <div class="es" data-id="es" data-placeholder="ESP"> <span>ESP</span> </div> </div> </div> 
                        </li>-->
                        
                      </ul>
                        <div class="rgt_head_items">
                            <div class="head_phns">
                                <img src="<?php echo base_url();?>assets/frontend/images/bi_phone-fill.svg" alt=""/>
                                <ul class="phn_nmbrs m-0 ps-0">
                            	  <li><small class="me-1">MEX: </small><a href="tel:<?php echo $configurationDetails->mexPhone;?>"><?php echo $configurationDetails->mexPhone;?></a></li>
                            	  <li><small class="me-1">USA: </small><a href="tel:<?php echo $configurationDetails->usaPhone;?>"><?php echo $configurationDetails->usaPhone;?></a></li>
                            	</ul>
                            </div>
                            <div class="lang_block">
                              <div id="google_translate_element"></div>
                              <div class="selected_text"><span class="lang_name"></span></div>  
                            </div>
                      </div>
                    </div>
                </div>
                
            </div>
              <div class="phone_drop dropdown pulse-base d-xl-none order-1 ms-auto me-3">
                <div class="head_phns">
                                <img src="<?php echo base_url();?>assets/frontend/images/bi_phone-fill.svg" alt=""/>
                                <ul class="phn_nmbrs m-0 ps-0">
                            	  <li><small class="me-1">MEX: </small><a href="tel:<?php echo $configurationDetails->mexPhone;?>"><?php echo $configurationDetails->mexPhone;?></a></li>
                            	  <li><small class="me-1">USA: </small><a href="tel:<?php echo $configurationDetails->usaPhone;?>"><?php echo $configurationDetails->usaPhone;?></a></li>
                            	</ul>
                            </div>
                <button class="icon_btn " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo base_url();?>assets/frontend/images/bi_phone-fill.svg" alt="" />
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="#"><small class="me-1">MEX: </small><?php echo $configurationDetails->mexPhone;?></a></li>
                  <li><a class="dropdown-item" href="#"><small class="me-1">USA: </small><?php echo $configurationDetails->usaPhone;?></a></li>
                </ul>
            </div>
            </div>
        </nav>
    </header>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
 	 
	function __construct(){ 
		parent::__construct();
		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title'] = $this->config->item('product_name');   
		$this->load->model('Property_mdl');	
		$this->load->model('Form_entry_mdl');		
		$this->data['configurationDetails'] = $this->Cms_mdl->get_configuration_details(); 
 	}
	
	public function chkEmail(){
		$to = $this->config->item('admin_email_sent_to');
		$message = 'viva msg body fdsfs';
		$title = 'Viva Testing teste ';
		$status = '';
		$subject = 'Subject Viva';
		send_mail($to,$message,$title,$status,$subject, $cc=0);
	}
	
	public function index(){
	
		$apiKey = "16e326e3c0771553debeee7200e97437";
		$cityId = "chacala";
		$googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?appid=".$apiKey."&q=".$cityId;
 		$ch = curl_init();
 		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
 		curl_close($ch);
		$data = json_decode($response);
		$temp = $data->main->temp;		 
 		$this->data['wheaterData'] = round(($temp)-273.15).'&deg; C / '.round(((($temp-273.15)*1.8)+32),1).'&deg; F';
		
		$this->data['homePageSts'] = 1;
		$cms_data = $this->Cms_mdl->front_cms_data();
		$this->data['top_section_content'] = filter_array($cms_data,'2','id');
		$this->data['book_section_content'] = filter_array($cms_data,'5','id');
		$this->data['setupMastersData'] = $this->Setup_mdl->setupMastersData();
		$this->data['propertyType'] = 0;
		$this->data['metaTitle'] = 'Chacala Vacation Rentals | Collection of Private & Beachfront Villas';   
		/*$this->data['sp_content'] = filter_array_two($cms_data,'strategic_partner','page_name','main_content','module_name');
		$this->data['events_array'] = $this->Events_mdl->events_array('upcoming');*/
		$this->data['categoriesPropertiesDataArr'] = $this->Property_mdl->homeCategoriesWiseProperties();
		
		/*$this->data['oceanFrontPropertyDetails'] = $this->Property_mdl->homeCategoriesWiseProperties(1);
		$this->data['largerGroupsPropertyDetails'] = $this->Property_mdl->homeCategoriesWiseProperties(2);
		$this->data['privatePoolsPropertyDetails'] = $this->Property_mdl->homeCategoriesWiseProperties(3);*/
		
		$this->data['specialsPropertiesDataArr'] = $this->Property_mdl->homeSpecialsProperties();
		$this->data['reviewsDataArr'] = $this->Property_mdl->homeChacalaReviewsData();
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/home',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
	public function common_pages(){
		$pageSlug = $this->uri->segment(1);
		$pageName = str_replace('-','_',$pageSlug);
		$this->data['page_content'] = $this->Cms_mdl->cms_details($pageName,'main_content');
		$this->data['title'] = $this->data['page_content']->page_name; 
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/common-inner-pages',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);
	}
	
	public function export_calendar(){
		$propertySlug = $this->uri->segment(3);
		if(isset($propertySlug) && $propertySlug!=''){

			$this->load->model('Property_mdl');
			$propertyDetails = $this->Property_mdl->propertyDetailsArrBySlug($propertySlug);
			$location = $propertyDetails['name'];
			$propertyId = $propertyDetails['propertyId'];
			$propertyReservations = $this->Property_mdl->propertyReservations($propertyId);
			
			if(count($propertyReservations)>0){
				// Set the appropriate headers for an ICS file
				header('Content-Type: text/calendar; charset=utf-8');
				header('Content-Disposition: attachment; filename="'.$propertySlug.'.ics"');
				
				$ics = "BEGIN:VCALENDAR\r\n";
				$ics .= "PRODID:-//Viva Chacala//Calendar Program v0.1//EN\r\n";
				$ics .= "VERSION:2.0\r\n";			
				 
				foreach($propertyReservations as $reserve){  			 
					$DTSTART = date('Ymd\THis',$reserve['checkin_date']);
					$DTEND = date('Ymd\THis',$reserve['checkout_date']);
					$description = 'Reserved';
								
					$ics .= "BEGIN:VEVENT\r\n";
					$ics .= "DTSTART:" . $DTSTART . "\r\n";
					$ics .= "DTEND:" . $DTEND . "\r\n";
					$ics .= "DESCRIPTION:" . $description . "\r\n";
					$ics .= "LOCATION:" . $location . "\r\n";
					$ics .= "END:VEVENT\r\n";			
				}			
				$ics .= "END:VCALENDAR";
				echo $ics;
			}else{
				'No Booked Found.';
			}
			
		}
	}
	
	public function about_us(){ 	
		$this->data['title']='Chacala';
		$this->data['metaTitle'] = "Chacala, Mexico: Unveiling Coastal Paradise and Cultural Riches";
		$this->data['metaDesc'] = "Plan your Chacala vacation to experience a seamless blend of seaside serenity and the cultural tapestry that defines this enchanting destination.";   
		$this->data['metaKeyword'] = "Chacala, Chacala Accommodation, Chacala Beach Retreat, Chacala Coastal Delight, Chacala Mexico, Chacala Vacation Haven";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/about-us',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
	// public function contact_us(){ 
	// 	$this->data['title']='Begin your Marina Chacala Experience!';
	// 	$this->data['metaTitle'] = "Get in Touch with Chacala: Contact Us for Your Coastal Inquiries";
	// 	$this->data['metaDesc'] = "Feel free to contact us for any inquiries, reservations, or information about Chacala.";   
	// 	$this->data['metaKeyword'] = "Chacala Contact, Reach Out to Chacala, Chacala Inquiries, Chacala Reservation Contact, Connect with Chacala";
	// 	$this->load->view('Frontend/includes/header',$this->data);
	// 	$this->load->view('Frontend/pages/contact-us',$this->data);
	// 	$this->load->view('Frontend/includes/footer',$this->data);  			
	// }
	
	public function contactEntry(){ 
		echo $this->Form_entry_mdl->contactEntry();
	}
	
	public function newsletterEntry(){ 
		echo $this->Form_entry_mdl->newsletterEntry();
	}
	
	public function bookingRequestEntry(){ 
		echo $this->Form_entry_mdl->bookingRequestEntry();
	}
	
	public function gallery(){ 	
		$this->data['title']='Gallery';
		$this->data['metaTitle'] = "Chacala Photo Gallery: Visual Splendor of Coastal Tranquility";
		$this->data['metaDesc'] = "Discover the allure of Chacala through our carefully curated photo collection, capturing the timeless beauty of this captivating destination.";
		$this->data['metaKeyword'] = "Chacala Gallery, Chacala Photo Collection, Chacala Scenic Views, Coastal Beauty in Chacala, Explore Chacala in Pictures";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/gallery',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
	// public function why_viva_chacala(){ 	
		// $this->data['title']='Why VivaChacala?';
		// $this->data['metaTitle'] = "Why Chacala: Unveiling the Allure of Mexico's Hidden Gem";
		// $this->data['metaDesc'] = "From pristine beaches to authentic village charm, find out why Chacala is a destination that captivates the hearts of those seeking a truly special getaway.";   
		// $this->data['metaKeyword'] = "Chacala Amenities, Marina Chacala Attractions, Why Marina Chacala, Chacala Serenity, Marina Chacala Beauty";
		// $this->load->view('Frontend/includes/header',$this->data);
		// $this->load->view('Frontend/pages/why-viva-chacala',$this->data);
		// $this->load->view('Frontend/includes/footer',$this->data);  			
	// }
	
	public function activities(){ 	
		$this->data['title']='Chacala: So much to see and do!!!!';
		$this->data['metaTitle'] = "Chacala Activities: Explore Paradise on the Unleash Adventure on the Chacala, Mexico";
		$this->data['metaDesc'] = "Chacala Activities offer a diverse range of adventures, from coastal excursions to water sports and nature exploration.";   
		$this->data['metaKeyword'] = "Chacala Activities, Marina Chacala Adventures, Chacala Water Sports, Chacala Nautical Adventures, Outdoor Fun in Marina Chacala";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/activities',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
	public function marina_chacala(){ 	
		$this->data['title']='Marina Chacala';
		$this->data['metaTitle'] = "Seaside Splendor Awaits at Marina Chacala Hotel: Your Gateway to Coastal Elegance";
		$this->data['metaDesc'] = "Immerse yourself in the serene allure of Marina Chacala, where coastal charm meets luxury living. Explore our range of exclusive waterfront properties, from chic rentals to opulent residences.";   
		$this->data['metaKeyword'] = "Marina Chacala, Marina Chacala Accommodation ,Marina Chacala Property Rentals, Luxury Marina Chacala Residences, Marina Chacala Resort, Marina Chacala Coastal Getaway, Marina Chacala Vacation Resort";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/marina-chacala',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
	// public function teams(){ 	
	// 	$this->data['title']='Team Viva Chacala';
	// 	$this->data['metaTitle'] = "Meet the Chacala Team: Dedicated to Your Coastal Experience";
	// 	$this->data['metaDesc'] = "Welcome to the heart of Chacala, where our dedicated team is committed to enhancing your coastal experience.";   
	// 	$this->data['metaKeyword'] = "Chacala Team, Chacala Team Members, Dedicated Chacala Professionals, Chacala Coastal Experience Experts";
	// 	$this->load->view('Frontend/includes/header',$this->data);
	// 	$this->load->view('Frontend/pages/teams',$this->data);
	// 	$this->load->view('Frontend/includes/footer',$this->data);  			
	// }
	
	public function reviews(){ 	
		$this->data['title']='Reviews';
		$this->data['metaTitle'] = "Chacala Reviews: Hear What Our Guests Have to Say";
		$this->data['metaDesc'] = "Hear the unfiltered stories of travelers who have explored Chacala and let their reviews guide you toward an unforgettable vacation experience on the Marina Chacala, Mexico.";
		$this->data['metaKeyword'] = "Chacala Reviews, Guest Testimonials Chacala, Chacala Feedback, Reviews of Chacala, Chacala Guest Experiences, Chacala Vacation Feedback";
		$this->data['reviewsDataArr'] = $this->Property_mdl->chacalaReviewsData();
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/reviews',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
	public function dining(){ 	
		$this->data['title']='Dining in Chacala Mexico is some of the best in all of Mexico!';
		$this->data['metaTitle'] = "Chacala Dining Delights: Savor Coastal Flavors with a View";
		$this->data['metaDesc'] = "From oceanview caf�s to seaside dining, Chacala invites you to indulge in the finest gastronomy of the Marina Chacala Dining.";   
		$this->data['metaKeyword'] = "Chacala Dining, Marina Chacala Restaurants, Seaside Dining in Chacala, Chacala Beachfront Restaurants, Chacala Oceanview Cafes";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/dining',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
	public function fzfPage(){
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/404',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  
	}
	
	 
	public function guest_services(){ 	
		$this->data['title']='Guest Services';
		$this->data['metaTitle'] = "Chacala, Mexico: Unveiling Coastal Paradise and Cultural Riches";
		$this->data['metaDesc'] = "Viva Chacala Guest Services";   
		$this->data['metaKeyword'] = "24/7 Concierge Service,Daily Maid Service,Personalized Welcome,Vacation Planning,Welcome Gift,Our Preferred Vendors,Private Beach and Beach Club,Resort Community Amenities";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/viva-guest-services',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	public function owner_services(){ 	
		$this->data['title']='Owner Services';
		$this->data['metaTitle'] = "Chacala, Mexico: Unveiling Coastal Paradise and Cultural Riches";
		$this->data['metaDesc'] = "Viva Chacala Owner Services";   
		$this->data['metaKeyword'] = "Vacation Rental Management,Bookings and Digital Marketing	,Property Management,Property Renovations,Real Estate Transaction";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/viva-owner-services',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}


	public function viva_beaches(){ 	
		$this->data['title']='Chacala Beaches';
		$this->data['metaTitle'] = "Chacala Beach";
		$this->data['metaDesc'] = "Chacala Mexico's most beautiful beaches";   
		$this->data['metaKeyword'] = "beautiful beaches, chacala beaches";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/viva-beaches',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}

	public function community(){ 	
		$this->data['title']='Chacala Community';
		$this->data['metaTitle'] = "Chacala Community";
		$this->data['metaDesc'] = "";   
		$this->data['metaKeyword'] = "";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/community',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}

	public function chacala_maps(){ 	
		$this->data['title']='Chacala Maps';
		$this->data['metaTitle'] = "Chacala Maps";
		$this->data['metaDesc'] = "";   
		$this->data['metaKeyword'] = "";
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/chacala-maps',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
	
	
	
	
	
}
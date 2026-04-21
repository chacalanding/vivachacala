<footer>
  <a href="#header" class="btt_btn" aria-label="scroll to top"><i data-feather="arrow-up"></i></a>
  <div class="container">
	<div class="row">
	  <div class="col-md-4 col-6">
		<ul class="footlinks">
		  <li>Discover</li>
		  <!--<li><a href="#">Advertise With Us</a></li>
		  <li><a href="<?php //echo base_url().'why-rent';?>">Why Rent via Vivachacala.com?</a></li>-->
		  <li><a href="<?php echo base_url().'reviews';?>">Reviews</a></li>
		  <li><a href="<?php echo base_url().'chacala-photo-gallery';?>">Gallery</a></li>
		  <li><a href="<?php echo base_url().'about-chacala-mexico';?>">About Us</a></li>
		  <li><a href="<?php echo base_url().'marina-chacala';?>">Marina Chacala</a></li>
		</ul>
	  </div>
	  <div class="col-md-4 col-6">
		<ul class="footlinks">
		  <li>Get Informed</li>
		  <!-- <li><a href="<?php echo base_url().'contact-us';?>">Contact Us</a></li> -->
		  <li><a href="<?php echo base_url().'terms-and-conditions';?>">Terms and Conditions</a></li>
		  <li><a href="<?php echo base_url().'privacy-policy';?>">Privacy Policy</a></li>
		  <li><a href="<?php echo base_url().'disclaimer-and-user-policy';?>">Disclaimer and User Policy</a></li>
		 <!-- <li><a href="<?php //echo base_url().'review-rules-and-guidelines';?>">Review Rules and Guidelines</a></li>-->
		</ul>
	  </div>
	  <div class="col-md-4 col-sm-8 col-12 mt-sm-0 mt-5">
		<div class="newsletter">
		  <strong>Sign up for the newsletter</strong>
		  <p>Subscribe to our newsletter to get curated travel inspirations</p>
			<form id="newsLetterFrm" action="home/newsletterEntry" method="post" class="vc_form  mb-3">
				<input type="hidden" id="nlAjaxURL" name="nlAjaxURL" value="<?php echo $this->config->item('ajax_base_url');?>" />
				<div id="nlResDisplay"></div>
				<div class="input-group" id="nlFields">				
					<input type="text" class="form-control email required" placeholder="Email" id="nlEmailAddress" name="nlEmailAddress" autocomplete="off" />
					<button class="vc_btn" type="submit" id="newsLetterBtn">Subscribe</button>			
				</div>
			</form>
		</div>
		<!--<div class="social_links">
		  <a href="<?php //echo $configurationDetails->social_instagram;?>" target="_blank" rel="noopener noreferrer"><i data-feather="instagram"></i></a>
		  <a href="<?php //echo $configurationDetails->social_facebook;?>" target="_blank" rel="noopener noreferrer"><i data-feather="facebook"></i></a>
		  <a href="<?php //echo $configurationDetails->social_youtube;?>" target="_blank" rel="noopener noreferrer"><i data-feather="youtube"></i></a>
		</div>-->
	  </div>
	</div>
	<div class="row mt-5"><div class="col">
	  <div class="disclaimer"><?php echo $configurationDetails->footerContent;?></div>
	</div></div>
  </div>
</footer>
<script src="<?php echo base_url();?>assets/frontend/js/slick.min.js" ></script>
<script src="<?php echo base_url();?>assets/frontend/js/custom.js" ></script>
<script>
feather.replace();
function readURL(input){
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#blah').attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
$(document).ready(function(){	  		
	$('#newsLetterFrm').validate({
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
				error.insertAfter(element.parent());
			}
		},
		submitHandler: function(form){
			var btnText = $('#newsLetterBtn').html();
			var ajax_base_url = $('#nlAjaxURL').val();
			var form = $('#newsLetterFrm');
			var url = ajax_base_url+form.attr('action');
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#newsLetterBtn').prop("disabled", true);
					$('#newsLetterBtn').html('Please Wait <i class="fas fa-spinner"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						$('#nlResDisplay').html('<div class="alert alert-success my-3 rounded-0" role="alert">Thank you for your message. </div>');
						$('#nlFields').remove();
					}else{
						$('#nlResDisplay').html('<div class="alert alert-danger">'+result_arr[1]+'</div>');
						$('#newsLetterBtn').prop("disabled", false);
						$('#newsLetterBtn').html(btnText);
					}
				},
				error: function(xhr, status, error_desc){
					$('#nlResDisplay').html('<div class="alert alert-danger">'+error_desc+'</div>');
					$('#newsLetterBtn').prop("disabled", false);
					$('#newsLetterBtn').html(btnText);
				}
			});		
			return false;
		}
	});
});
</script>
<style> 

.skiptranslate iframe.skiptranslate {display: none !important;}
iframe.skiptranslate body table span.indicator{ display:none !important;}
 .goog-te-banner-frame.skiptranslate,.goog-te-gadget-simple img,img.goog-te-gadget-icon,.goog-te-menu-value span{display:none!important} .goog-te-menu-frame{box-shadow:none!important} .goog-te-gadget-simple{background-size: 20px 20px;display:inline-block;font-weight:400;line-height: 1.8;padding:0 6px;text-align:center;white-space:nowrap;vertical-align: middle;-ms-touch-action: manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select: none;-moz-user-select:none;-ms-user-select:none;user-select:none;border-left:none!important;border-top:none!important;border-bottom:none!important;border-right:none!important;border-radius: 4px} body{top:0px!important} .darkMode .goog-te-gadget-simple{background-color:transparent!important;background:url("data:image/svg+xml,%3Csvg viewBox=&#39;0 0 24 24&#39; xmlns=&#39;http://www.w3.org/2000/svg&#39;%3E%3Cg style=&#39;fill:none;stroke:%23fefefe;stroke-linecap:round;stroke-linejoin:round&#39;%3E%3Cpath d=&#39;M.5,2V18A1.5,1.5,0,0,0,2,19.5H17L10.5.5H2A1.5,1.5,0,0,0,.5,2Z&#39; /%3E%3Cpath d=&#39;M12,4.5H22A1.5,1.5,0,0,1,23.5,6V22A1.5,1.5,0,0,1,22,23.5H13.5l-1.5-4&#39; /%3E%3Cline x1=&#39;17&#39; x2=&#39;13.5&#39; y1=&#39;19.5&#39; y2=&#39;23.5&#39; /%3E%3Cline x1=&#39;14.5&#39; x2=&#39;21.5&#39; y1=&#39;10.5&#39; y2=&#39;10.5&#39; /%3E%3Cline x1=&#39;17.5&#39; x2=&#39;17.5&#39; y1=&#39;9.5&#39; y2=&#39;10.5&#39; /%3E%3Cpath d=&#39;M20,10.5c0,1.1-1.77,4.42-4,6&#39; /%3E%3Cpath d=&#39;M16,13c.54,1.33,4,4.5,4,4.5&#39; /%3E%3Cpath d=&#39;M10.1,7.46a4,4,0,1,0,1.4,3h-4&#39; /%3E%3C/g%3E%3C/svg%3E") center / 12px no-repeat;background-size: 20px 20px} .headerIcon .gtWgt.gtHide{display:none} .headerIcon .gtWgt .gtIcon{position:absolute;background-color:var(--header-bg)} .darkMode .headerIcon .gtWgt .gtIcon{background-color:var(--dark-bg)} .postComments.gtHide .gtWgt{display:none} .postComments.gtHide .shrBtn{margin-right:0} .postComments .gtWgt .gtLoad{position:relative} .postComments .gtWgt .gtIcon{position:absolute;background-color:var(--body-bg)} .postComments .gtWgt #google_translate_element{margin-right:0} .darkMode .postComments .gtWgt .gtIcon{background-color:var(--dark-bg)} .postComments .gtWgt .gtIcon .goog-te-gadget-simple{background-color:transparent!important;background-size: 18px 18px} .postComments .gtWgt .gtIcon .goog-te-gadget-simple{background-color:transparent!important;background:url("data:image/svg+xml,%3Csvg viewBox=&#39;0 0 24 24&#39; xmlns=&#39;http://www.w3.org/2000/svg&#39;%3E%3Cg style=&#39;fill:none;stroke:%2348525c;stroke-linecap:round;stroke-linejoin:round&#39;%3E%3Cpath d=&#39;M.5,2V18A1.5,1.5,0,0,0,2,19.5H17L10.5.5H2A1.5,1.5,0,0,0,.5,2Z&#39; /%3E%3Cpath d=&#39;M12,4.5H22A1.5,1.5,0,0,1,23.5,6V22A1.5,1.5,0,0,1,22,23.5H13.5l-1.5-4&#39; /%3E%3Cline x1=&#39;17&#39; x2=&#39;13.5&#39; y1=&#39;19.5&#39; y2=&#39;23.5&#39; /%3E%3Cline x1=&#39;14.5&#39; x2=&#39;21.5&#39; y1=&#39;10.5&#39; y2=&#39;10.5&#39; /%3E%3Cline x1=&#39;17.5&#39; x2=&#39;17.5&#39; y1=&#39;9.5&#39; y2=&#39;10.5&#39; /%3E%3Cpath d=&#39;M20,10.5c0,1.1-1.77,4.42-4,6&#39; /%3E%3Cpath d=&#39;M16,13c.54,1.33,4,4.5,4,4.5&#39; /%3E%3Cpath d=&#39;M10.1,7.46a4,4,0,1,0,1.4,3h-4&#39; /%3E%3C/g%3E%3C/svg%3E") center / 12px no-repeat;background-size: 18px 18px} .darkMode .postComments .gtWgt .gtIcon .goog-te-gadget-simple{background-color:transparent!important;background:url("data:image/svg+xml,%3Csvg viewBox=&#39;0 0 24 24&#39; xmlns=&#39;http://www.w3.org/2000/svg&#39;%3E%3Cg style=&#39;fill:none;stroke:%23d1d1d1;stroke-linecap:round;stroke-linejoin:round&#39;%3E%3Cpath d=&#39;M.5,2V18A1.5,1.5,0,0,0,2,19.5H17L10.5.5H2A1.5,1.5,0,0,0,.5,2Z&#39; /%3E%3Cpath d=&#39;M12,4.5H22A1.5,1.5,0,0,1,23.5,6V22A1.5,1.5,0,0,1,22,23.5H13.5l-1.5-4&#39; /%3E%3Cline x1=&#39;17&#39; x2=&#39;13.5&#39; y1=&#39;19.5&#39; y2=&#39;23.5&#39; /%3E%3Cline x1=&#39;14.5&#39; x2=&#39;21.5&#39; y1=&#39;10.5&#39; y2=&#39;10.5&#39; /%3E%3Cline x1=&#39;17.5&#39; x2=&#39;17.5&#39; y1=&#39;9.5&#39; y2=&#39;10.5&#39; /%3E%3Cpath d=&#39;M20,10.5c0,1.1-1.77,4.42-4,6&#39; /%3E%3Cpath d=&#39;M16,13c.54,1.33,4,4.5,4,4.5&#39; /%3E%3Cpath d=&#39;M10.1,7.46a4,4,0,1,0,1.4,3h-4&#39; /%3E%3C/g%3E%3C/svg%3E") center / 12px no-repeat;background-size: 18px 18px}.goog-te-gadget-simple .VIpgJd-ZVi9od-xl07Ob-lTBxed span {text-decoration: none;display: none;}
.goog-tooltip {display: none !important;}
.goog-tooltip:hover {display: none !important;}
.goog-text-highlight {background-color: transparent !important;border: none !important;box-shadow: none !important;}
#goog-gt-tt, .goog-te-balloon-frame{display: none !important;}
.goog-text-highlight { background: none !important; box-shadow: none !important;}</style>
<script type="text/javascript">  
function googleTranslateElementInit() {  
	 new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages:'en,es',layout:google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: true, multilanguagePage: true, gaTrack: true},'google_translate_element');  
}
$(document).ready(function(){
	$('#google_translate_element').on("click", function () {	
		$('.skiptranslate').css('box-shadow', 'none');		 
		$("iframe").contents().find(".VIpgJd-ZVi9od-vH1Gmf").css('border', '1px solid #dddddd');
		$("iframe").contents().find(".VIpgJd-ZVi9od-vH1Gmf div").css('background-color', 'white').css('color', '#222222');
		$("iframe").contents().find(".VIpgJd-ZVi9od-vH1Gmf .indicator").css('display', 'none');
	});
});
</script>
<script>
	history.scrollRestoration = "manual";

$(window).on('beforeunload', function(){
      $(window).scrollTop(0);
});
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
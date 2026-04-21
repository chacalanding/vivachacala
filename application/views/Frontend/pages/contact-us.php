<div class="page_title">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col"><h1><?php echo $title;?></h1></div>
        </div>
    </div>
</div>
<div class="contact_chacala mb-5 pb-5">
    <div class="container">
        <div class="row my-5">            
            <div class="col-lg-8">
                <div class="vc_contact mb-4">
                    <form id="contactFrm" action="home/contactEntry" method="post" class="vc_form">
						<input type="hidden" id="h_base_url" name="h_base_url" value="<?php echo base_url();?>" />
						<input type="hidden" id="h_ajax_base_url" name="h_ajax_base_url" value="<?php echo $this->config->item('ajax_base_url');?>" />
                        <div>
							<h3>Questions about Viva Chacala?</h3>
							<p>Let our Chacala team get back to you right away.</p>
                        </div>
						
						<div id="resDisplay"></div>
						<div id="contactFields">
							<div class="row g-3">
								<div class="col">
									<div class="form-floating form-group mb-3">
										<input type="text" class="form-control required" name="txtName" id="txtName" placeholder="" autocomplete="off" />
										<label for="txtName">Name</label>
									</div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-md-2 g-3">
								<div class="col">
									<div class="form-floating form-group">
										<input type="text" class="form-control email required" id="txtEmail" name="txtEmail" placeholder="name@example.com" autocomplete="off" />
										<label for="email">Email address</label>
									</div>
								</div>
								<div class="col">
									<div class="form-floating form-group mb-3">
										<input type="text" class="form-control required" id="txtPhone" name="txtPhone" placeholder="" />
										<label for="phone">Phone</label>
									</div>
								</div>
							</div>
							<div class="row g-3">
								<div class="col">
									<div class="form-floating mb-3">
										<textarea class="form-control" placeholder="" id="commentMsg" name="commentMsg" style="height: 100px"></textarea>
										<label for="comment">Let us know how we can help you</label>
									</div>
								</div>
							</div>
							<div class="row g-3">
								<div class="col">
									<button type="submit" id="submitBtn" class="vc_btn">Get in touch</button>
								</div>
							</div>
						</div>
                    </form>
<script type="text/javascript">
$(document).ready(function(){
	$('#contactFrm').validate({
		ignore: [], 
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
		},
		success: function(element) {
			element.closest('.form-group').removeClass('has-error').addClass('has-success');
			element.remove();
		},
		submitHandler: function(form){
			var btnText = $('#submitBtn').html();
			var site_base_url = $('#h_base_url').val();
			var ajax_base_url = $('#h_ajax_base_url').val();
			var form = $('#contactFrm');
			var url = ajax_base_url+form.attr('action');
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				beforeSend: function(){
					$('#submitBtn').prop("disabled", true);
					$('#submitBtn').html('Please Wait <i class="fas fa-spinner"></i>');
				},
				success: function(result, status, xhr){//alert(result);
					var result_arr = result.split('||')
					if(result_arr[0]=='success'){
						$('#resDisplay').html('<div class="alert alert-success my-3 rounded-0" role="alert"><h4 class="alert-heading">Awesome!</h4><p class="mb-0">Thank you for your message.  We will get back to you right away.</p> </div>');
						$('#contactFields').remove();
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
            </div>
            <div class="col-lg-4">
                <div class="vc_contact_block">
                    <div class="mb-4">
                    <h5>Talk, chat, or email with our awesome Chacala team!</h5>
                    <small>Interested in Chacala rentals, Chacala activities or Chacala real estate? We are just a phone call, text, or email away.</small>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block">Phone</strong>
                        <div><small>USA:</small> <a href="tel:<?php echo $configurationDetails->usaPhone;?>"><?php echo $configurationDetails->usaPhone;?></a></div>
                        <div><small>MEX:</small> <a href="tel:<?php echo $configurationDetails->mexPhone;?>"><?php echo $configurationDetails->mexPhone;?></a></div>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block">Email</strong>
                        <div><a href="mailto:<?php echo $configurationDetails->emailAddress;?>"><?php echo $configurationDetails->emailAddress;?></a></div>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block">LIVE Chat</strong>
                        <div><a href="https://api.whatsapp.com/send?phone=<?php echo $configurationDetails->whatsUpNo;?>" class="icon_btn p-2"target="_blank"><svg version="1.2" baseProfile="tiny-ps" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 738 741" width="30" height="30"><title>whatsapp-glyph-black-svg</title><style>tspan { white-space:pre }.shp0 { fill: #ffffff } </style><path fill-rule="evenodd" class="shp0" d="M630.06 107.66C699.39 177.04 737.55 269.28 737.51 367.36C737.43 569.77 572.68 734.46 370.3 734.46L370.15 734.46C308.69 734.43 248.3 719.02 194.67 689.78L0 740.82L52.09 550.6C19.96 494.93 3.05 431.77 3.08 367.07C3.16 164.67 167.89 0 370.29 0C468.52 0.04 560.73 38.27 630.06 107.66ZM370.3 672.46C538.52 672.46 675.44 535.58 675.51 367.34C675.54 285.81 643.82 209.15 586.2 151.48C528.57 93.81 451.94 62.03 370.42 62C202.06 62 65.15 198.87 65.08 367.09C65.06 424.74 81.19 480.89 111.74 529.47L119 541.02L88.17 653.61L203.68 623.32L214.83 629.93C261.69 657.73 315.41 672.44 370.17 672.46L370.3 672.46ZM537.71 443.94C546.89 448.54 553 450.83 555.3 454.66C557.59 458.48 557.59 476.85 549.95 498.27C542.3 519.7 505.64 539.26 488.01 541.89C472.2 544.25 452.2 545.24 430.22 538.26C416.9 534.03 399.8 528.38 377.91 518.93C285.87 479.2 225.76 386.56 221.17 380.43C216.58 374.31 183.71 330.7 183.71 285.55C183.71 240.4 207.41 218.21 215.82 209.03C224.23 199.84 234.17 197.55 240.29 197.55C246.4 197.55 252.53 197.61 257.87 197.87C263.5 198.15 271.07 195.73 278.52 213.62C286.16 231.98 304.51 277.13 306.81 281.72C309.1 286.31 310.63 291.67 307.57 297.79C304.51 303.91 302.98 307.74 298.4 313.09C293.81 318.45 288.76 325.05 284.63 329.16C280.04 333.74 275.26 338.7 280.61 347.88C285.96 357.07 304.38 387.11 331.65 411.43C366.7 442.68 396.26 452.36 405.44 456.95C414.62 461.55 419.97 460.78 425.32 454.66C430.67 448.54 448.26 427.88 454.37 418.69C460.49 409.51 466.61 411.04 475.02 414.1C483.43 417.16 528.54 439.35 537.71 443.94Z"/></svg></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
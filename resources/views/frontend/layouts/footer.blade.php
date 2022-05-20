<footer class="footer_sec">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-items pr-4">
					<a class="footer-logo" href="{{ url('/home') }}"> 
						<img class="logo" style="height:50px; width: 50px;" src="{{ asset('frontend/assets/images/logo-white-1.png') }}">
					</a>
					<p class="mt-3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="footer-items">
					<h6>Quick Links</h6>
					<ul class="footer-links">
						<li><a href="javascript:;">About Us</a></li>
						<li><a href="javascript:;">Contact Us</a></li>
						<li><a href="javascript:;">How it Works</a></li>
						<li><a href="javascript:;">FAQ’s</a></li>
						<li><a href="javascript:;">Terms of Use</a></li>
						<li><a href="javascript:;">Privacy Policy</a></li>
						<li><a href="javascript:;">Return Policy</a></li>
						<li><a href="javascript:;">Shipping Policy</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="footer-items">
					<h6>Stay Connected</h6>
					<div class="newsletter">
						<div class="form-group">
							<div class="input-group">
								<input type="" name="" class="form-control" placeholder="Enter your email address">
							</div>
							<button class="btn-medium">Subscribe</button>
						</div>
					</div>
					<ul class="footer-social mt-4">
						<li><a href="javascript:;"><i class="fa fa-facebook"></i></a></li>
						<li><a href="javascript:;"><i class="fa fa-twitter"></i></a></li>
						<li><a href="javascript:;"><i class="fa fa-instagram"></i></a></li>
						<li><a href="javascript:;"><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="copyright">
			<p class="mb-0 text-center">© Copyright 2021. All Rights Reserved.</p>
		</div>
	</div>
</footer>
	<script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.simplePagination.js') }}"></script>
    <!-- price range Slider js -->
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>

    <!-- Chat section js -->
    <script>
    	hideChat(0);

		$('.primeToggle').click(function() {
		  toggleFab();
		});

		//Toggle chat and links
		function toggleFab() {
		  $('.prime').toggleClass('fa-comment');
		  $('.prime').toggleClass('fa-times');
		  $('.prime').toggleClass('is-active');
		  $('.prime').toggleClass('is-visible');
		  $('.primeToggle').toggleClass('is-float');
		  $('.chat').toggleClass('is-visible');
		  $('.fab').toggleClass('is-visible');
		  
		}

		  $('#chat_first_screen').click(function(e) {
		        hideChat(1);
		  });

		  $('#chat_second_screen').click(function(e) {
		        hideChat(2);
		  });

		  $('#chat_third_screen').click(function(e) {
		        hideChat(3);
		  });

		  $('#chat_fourth_screen').click(function(e) {
		        hideChat(4);
		  });

		  	$('#chat_fullscreen_loader').click(function(e) {
			$('.fullscreen').toggleClass('zmdi-window-maximize');
			$('.fullscreen').toggleClass('zmdi-window-restore');
			$('.chat').toggleClass('chat_fullscreen');
			$('.fab').toggleClass('is-hide');
			$('.header_img').toggleClass('change_img');
			$('.img_container').toggleClass('change_img');
			$('.chat_header').toggleClass('chat_header2');
			$('.fab_field').toggleClass('fab_field2');
			$('.chat_converse').toggleClass('chat_converse2');
			//$('#chat_converse').css('display', 'none');
			// $('#chat_body').css('display', 'none');
			// $('#chat_form').css('display', 'none');
			// $('.chat_login').css('display', 'none');
		     // $('#chat_fullscreen').css('display', 'block');
		  });

		function hideChat(hide) {
		    switch (hide) {
		      case 0:
		            $('#chat_converse').css('display', 'none');
		            $('#chat_body').css('display', 'none');
		            $('#chat_form').css('display', 'none');
		            $('.chat_login').css('display', 'block');
		            $('.chat_fullscreen_loader').css('display', 'none');
		             $('#chat_fullscreen').css('display', 'none');
		            break;
		      case 1:
		            $('#chat_converse').css('display', 'block');
		            $('#chat_body').css('display', 'none');
		            $('#chat_form').css('display', 'none');
		            $('.chat_login').css('display', 'none');
		            $('.chat_fullscreen_loader').css('display', 'block');
		            break;
		      case 2:
		            $('#chat_converse').css('display', 'none');
		            $('#chat_body').css('display', 'block');
		            $('#chat_form').css('display', 'none');
		            $('.chat_login').css('display', 'none');
		            $('.chat_fullscreen_loader').css('display', 'block');
		            break;
		      case 3:
		            $('#chat_converse').css('display', 'none');
		            $('#chat_body').css('display', 'none');
		            $('#chat_form').css('display', 'block');
		            $('.chat_login').css('display', 'none');
		            $('.chat_fullscreen_loader').css('display', 'block');
		            break;
		      case 4:
		            $('#chat_converse').css('display', 'none');
		            $('#chat_body').css('display', 'none');
		            $('#chat_form').css('display', 'none');
		            $('.chat_login').css('display', 'none');
		            $('.chat_fullscreen_loader').css('display', 'block');
		            $('#chat_fullscreen').css('display', 'block');
		            break;
		    }
		}
    </script>

    <!-- Price range slider js -->
    <script>
    	function collision($div1, $div2) {
	      var x1 = $div1.offset().left;
	      var w1 = 40;
	      var r1 = x1 + w1;
	      var x2 = $div2.offset().left;
	      var w2 = 40;
	      var r2 = x2 + w2;
	        
	      if (r1 < x2 || x1 > r2) return false;
	      return true;
	      
	    }
	    
		// slider call

		$('#slider').slider({
			range: true,
			min: 0,
			max: 999,
			values: [ 0, 999 ],
			slide: function(event, ui) {
				
				$('.ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[ 0 ]);
				$('.ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[ 1 ]);
				$('.price-range-both').html('<i>$' + ui.values[ 0 ] + ' - </i>$' + ui.values[ 1 ] );
				
		    if ( ui.values[0] == ui.values[1] ) {
		      $('.price-range-both i').css('display', 'none');
		    } else {
		      $('.price-range-both i').css('display', 'inline');
		    }
				
				if (collision($('.price-range-min'), $('.price-range-max')) == true) {
					$('.price-range-min, .price-range-max').css('opacity', '0');	
					$('.price-range-both').css('display', 'block');		
				} else {
					$('.price-range-min, .price-range-max').css('opacity', '1');	
					$('.price-range-both').css('display', 'none');		
				}
				
			}
		});

		$('.ui-slider-range').append('<span class="price-range-both value"><i>$' + $('#slider').slider('values', 0 ) + ' - </i>' + $('#slider').slider('values', 1 ) + '</span>');

		$('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + $('#slider').slider('values', 0 ) + '</span>');

		$('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + $('#slider').slider('values', 1 ) + '</span>');
    </script>

    <!-- FAQs accordian js start -->
	<script>
  		// $("#accordionExample").on("hide.bs.collapse show.bs.collapse", e => {
		//   $(e.target)
		//     .prev()
		//     .find("i:last-child")
		//     .toggleClass("fa-minus fa-plus");
		// });
    </script>

    <script>
		$('.navbar-toggler').click(function() {
			$('.navbar-collapse').toggle();
		    $(".navbar-collapse").toggleClass('show');
		});
    </script>

    <!-- Page loader js -->
    <script>
    	$(window).on('load',function(){
			setTimeout(function(){ 
			$('.page-loader').fadeOut('slow');
			},700);
		});
    </script>

    <!-- sticky header js -->
    <script>
    	$(window).scroll(function() {    
		    var scroll = $(window).scrollTop();
		    if (scroll >= 150) {
		        $(".header_nav").addClass("fixed-top");
		    }
		    else{
		        $(".header_nav").removeClass("fixed-top");
		    }
		});
    </script>

    <script>
    	$(document).on('click', '.select-icon', function(){
			var selectId = $(this).siblings('.options');
			open(selectId);
		});

		function open(elem) {
		    if (document.createEvent) {
		        var e = document.createEvent("MouseEvents");
		        e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
		        elem[0].dispatchEvent(e);
		    } else if (element.fireEvent) {
		        elem[0].fireEvent("onmousedown");
		    }
		}

		/* next view button */
		$('.next').on('click', function() {
			
			$('#flip-toggle').addClass('hover');
			$(this).attr('disabled', true);
			$('.prev').removeAttr('disabled');
			
		});

		/* prev view button */
		$('.prev').on('click', function() {
			
			$('#flip-toggle').removeClass('hover');
			$(this).attr('disabled', true);
			$('.next').removeAttr('disabled');
		});
    </script>
</body>
</html>
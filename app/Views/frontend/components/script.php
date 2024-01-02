<script src="<?=base_url('public/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('public/js/owl-carousel/owl.carousel.min.js')?>"></script>

<script>
	
$(function() {

	$('.toggle-menu').click(function() {
		$('#menu').addClass('active');
	})
	$('#close-menu').click(function() {
		$('#menu').removeClass('active');
	});

	// Owl Carousel
	$(".owl-package").owlCarousel({
		margin: 30,
		responsiveClass:true,
		responsive: {
			0: {
				items: 1,
			},
			768: {
				items: 2,
			},
			992: {
				items: 3,
			}
		}
	});

});

</script>
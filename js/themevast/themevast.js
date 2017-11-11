
jQuery(document).ready(function($){
	jQuery("#back-top").hide();
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#back-top').fadeIn();
			} else {
				jQuery('#back-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		jQuery('#back-top').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});

jQuery(document).ready(function($){
	$('.item-processbar').each(function(){
        var $heightSkill = $(this).attr('data-height'),
        $percentSkill = $(this).attr('data-percent'),
        $bgSkill = $(this).attr('data-bgskill'),
        $bgBar = $(this).attr('data-bgBar');

      $(this).find('.processbar-bg').css({
          "height":$heightSkill,
          "background-color":$bgBar

      });
      $(this).find('.processbar-width').css({
          "height":$heightSkill
      });

      $(this).find('.processbar-width').animate({
          'width':$percentSkill+'%'
      },6000);

      if($bgSkill != ''){
         $(this).find('.processbar-width').css({
            'background-color':$bgSkill
          });
        };
    });
    $(".our-team .owl-carousel").owlCarousel({
        autoplay :false,
        items : 3,
        smartSpeed : 500,
        dotsSpeed : 500,
        rewindSpeed : 500,
        nav : true,
        autoplayHoverPause : true,
        dots : false,
        scrollPerPage:true,
        margin: 30,
        loop: true,
        responsive: {
        0: {
            items: 1,
        },
        480: {
            items:2,
        },
        768: {
            items:2,
        },
        991: {
            items:3,
        },                      
        1200: {
            items:3,
        }
     }
    });
  
  $(".header-wrapper .open-header-sidebar").click(function(){
        $('.header-wrapper').addClass("opened");
        jQuery('.header-wrapper').removeClass("closed");
    });

    $('.header-wrapper .close-header-sidebar').click(function(){
        jQuery('.header-wrapper').removeClass("opened");
        $('.header-wrapper').addClass("closed");
    }) 
    $(".block-categories-icon .open-header-sidebar").click(function(){
        $('.block-categories-icon').addClass("opened");
        jQuery('.block-categories-icon').removeClass("closed");
    });

    $('.block-categories-icon .close-header-sidebar').click(function(){
        jQuery('.block-categories-icon').removeClass("opened");
        $('.block-categories-icon').addClass("closed");
    });
    
  $(".box-setting .icon").click(function(){
	    $(".box-setting .setting").toggle();
	});
  $(".top-search .icon-search").click(function(){
      $(".top-search #search_mini_form").toggle();
  });
  $('#narrow-by-list .list-options').on('click', function () {
     $(this).toggleClass('open');
    });

   $('.link-lightbox').simpleLightboxVideo();
});

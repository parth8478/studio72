/**
*	@name							Accordion
*	@descripton						This $jq plugin makes creating accordions pain free
*	@version						1.3
*	@requires						$jq 1.2.6+
*
*	@author							Jan Jarfalk
*	@author-email					jan.jarfalk@unwrongest.com
*	@author-website					http://www.unwrongest.com
*
*	@licens							MIT License - http://www.opensource.org/licenses/mit-license.php
*/

(function($){
     $.fn.extend({  
         accordion: function() {       
            return this.each(function() {
            	
            	var $jqul = $(this);
            	
				if($jqul.data('accordiated'))
					return false;
													
				$.each($jqul.find('ul, li>div'), function(){
					$(this).data('accordiated', true);
					$(this).hide();
				});
				
				$.each($jqul.find('span.head'), function(){
					$(this).click(function(e){
						activate(this);
						return void(0);
					});
				});
				
				var active = (location.hash)?$(this).find('a[href=' + location.hash + ']')[0]:'';

				if(active){
					activate(active, 'toggle');
					$(active).parents().show();
				}
				
				function activate(el,effect){
					$(el).parent('li').toggleClass('active').siblings().removeClass('active').children('ul, div').slideUp('fast');
					$(el).siblings('ul, div')[(effect || 'slideToggle')]((!effect)?'fast':null);
				}
				
            });
        } 
    }); 
})(jQuery);

jQuery(document).ready(function ($) {
	$("ul.accordion li.parent").each(function(){
        $(this).append('<span class="head"><a href="javascript:void(0)"></a></span>');
      });
	
	$('ul.accordion').accordion();
	
	$("ul.accordion li.active").each(function(){
		$(this).children().next("ul").css('display', 'block');
	});
});
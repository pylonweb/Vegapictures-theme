(function ($) {

	jQuery(document).ready( function($) {
			$('.menu li:first').addClass('first-item');
			$('.menu li:last').addClass('last-item');
		});
		
	function fixmenu(){
		items = $(".page_item").size();
		spaces = items - 1;
		min_space = 10;
		total_width = 0;
		$(".page_item").each(function(){
					total_width += $(this).width();
			})
		if(total_width > (700 - spaces * min_space)){
			$('.page_item').each(function(){
				$(this).children(":first").css("font-size", parseInt($(this).children(":first").css("font-size")) - 1 + "px");
			});
			fixmenu();
		} else {
			space = 700 - total_width;
			rest = space % items;
			space = space-rest;
			space_each = space/spaces;
			//alert("SPACE: "+space+" REST: "+rest+" TOTAL_WIDTH: "+total_width+" SPACE_EACH: "+space_each+" ITEMS: "+items+" SPACES: "+spaces);
			$('.page_item :not(:last)').css("margin-right", space_each + "px");
			n = 0;
			for(rest;rest > 0;rest--){
				obj = $('.page_item:eq('+n+') > a:first');
				obj.css("margin-right", parseInt(obj.css("margin-right")) + 1 + "px");
				n++;
			}
	 	}
	}
		
})(jQuery);	
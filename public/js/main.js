$( document ).ready(function() {
	var window_width=$(window).width();
	
	if(window_width<786){
		$("#navigation_links").addClass('hide_menu');
		$("#navigation_links").removeClass('make_responsive_ul_visible');
	}else{
		$("#navigation_links").removeClass('hide_menu');
		$("#navigation_links").find("li").removeClass('_make_responsive_li_visible');
	}
		
	$( window ).resize(function() {
		var window_width=$(window).width();
		if(window_width<786){
			$("#navigation_links").addClass('hide_menu');
			$("#navigation_links").removeClass('make_responsive_ul_visible');
		}else{
			$("#navigation_links").removeClass('hide_menu');
			$("#navigation_links").find("li").removeClass('_make_responsive_li_visible');
		}
	});
	
	$('.menu-hamburger').click(function() {
		if($("#navigation_links").hasClass('make_responsive_ul_visible')){
			$("#navigation_links").removeClass('make_responsive_ul_visible');
			_hide_responsive_menu_items();
		}else{
			$("#navigation_links").addClass('make_responsive_ul_visible');
			_show_responsive_menu_items();
		}
	});
});

function _show_responsive_menu_items(){
	$("#navigation_links").removeClass('hide_menu');
	$("#navigation_links").find("li").addClass('_make_responsive_li_visible');
}

function _hide_responsive_menu_items(){
	$("#navigation_links").addClass('hide_menu');
	$("#navigation_links").find("li").removeClass('_make_responsive_li_visible');
}

   
   
   
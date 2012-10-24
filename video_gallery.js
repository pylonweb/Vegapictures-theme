var width = new Array();
var heigth = new Array();
var counter = 1;

(function ($) {
	jQuery(document).ready( function($) {	
		VideoJS.setupAllWhenReady();
   	first = video_array.shift();
		video_array.push(first);	
		createThumbs();
		$("#thumb_scroll_back > a").click(function(){
			thumb_scroll_back();
		})
		$("#thumb_scroll_forth > a").click(function(){
			thumb_scroll_forth();
		})
		});
	
	function createThumbs(){
		$("#thumbnails_div").width((video_array.length * 240)-20);
		for(i = 0; i < video_array.length; i++){
			current_video = video_array.shift();
			$("#thumbnails_div").append("<div class='video_thumb_container'>" + createThumb(current_video) + "</div>");
			video_array.push(current_video);
			if(i == video_array.length-1){
				$("#thumbnails_div").children(":last").addClass("last-thumb");
			}
			setupThumb(current_video[0])
		}
	}
	
	// function shuffleThumb(){
	// 	current_video = video_array.shift();
	// 	currentThumb = $("#thumbnails_div").children(":nth-child("+counter+")").children(":first");
	// 	currentThumb.after(createThumb(current_video, false));
	// 	$(".hidden_thumb").fadeIn(1000, function(){
	// 		$(this).removeClass("hidden_thumb");
	// 	});
	// 	currentThumb.fadeOut(1000, function(){
	// 		$(this).remove();
	// 	});
	// 	video_array.push(current_video);
	// 	if(counter >= thumbs){
	// 		$("#thumbnails_div").children(":last").addClass("last-thumb");
	// 		counter = 1;
	// 	} else {
	// 		counter++;
	// 	}
	// 	setupThumb(current_video[0])
	// }
	
	function setupThumb(id){
		thumb_link = $('#' + id + '> .thumb_link');
		thumb_link.click(function(e){
			e.preventDefault();
			element = $(this).parent();
			changeVideo(element);
			
		});

		$(".video_thumb").bind("mouseenter",function(){
			$(this).showThumbDesc();
		}).bind("mouseleave",function(){
			$(this).hideThumbDesc();
		});
	}
	
	function createThumb(video_info){
		return "<div class='video_thumb' style='background-image: url(\"" + video_info[3] + "\");' id='" + video_info[0] + "' data-lang='" + video_info[8] + "' data-id='" + video_info[0] + "' data-desc='" + video_info[2] + "' data-poster='" + video_info[4] + "' data-mp4='" + video_info[5] + "' data-ogv='" + video_info[6] + "' data-webm='" + video_info[7] + "'><a href='#' class='thumb_link'><span class='empty_span'></span></a><div class='thumb_overlay'>" + video_info[1] + "</div></div>";
	}

	function changeVideo(element){
		//alert(video_array[$(element).attr("data-id")]['desc']);
		//new_video = $(element).attr("data-id");
		if(history.pushState){
			history.pushState(null, null,"?video_id=" + $(element).attr("data-id"));
		}
		poster = $(element).attr("data-poster");
		mp4 = $(element).attr("data-mp4");
		ogv = $(element).attr("data-ogv");
		webm = $(element).attr("data-webm");
		new_player = '<div class="video-js-box"> \
		    <video class="video-js" width="700" height="395" controls autoplay preload poster="' + poster + '"> \
		      <source src="' + mp4 + '" type="video/mp4; codecs="avc1.42E01E, mp4a.40.2"" /> \
		      <source src="' + webm + '" type="video/webm; codecs="vp8, vorbis"" /> \
		      <source src="' + ogv + '" type="video/ogg; codecs="theora, vorbis"" /> \
		      <object id="flash_fallback_1" class="vjs-flash-fallback" width="700" height="393" type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf"> \
		        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" /> \
		        <param name="allowfullscreen" value="true" /> \
		        <param name="flashvars" value="config={\'playlist\':[\'' + poster + '\', {\'url\': \'' + mp4 + '\',\'autoPlay\':true,\'autoBuffering\':true, \'scaling\':\'fit\'}]}" /> \
		        <img src="' + poster + '" width="700" height="393" alt="Poster Image" title="No video playback capabilities." /> \
		      </object> \
		    </video> \
		  </div>'
		$('#main_player').html(new_player);
		VideoJS.setupAllWhenReady();
		
	}
	
	function shuffle(o) {
	        for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
	        return o;
	};
	
	$.fn.showThumbDesc = function(){
			return this.each(function() {
				overlay = $(this).children(".thumb_overlay");
				if(overlay.is(":animated")){
					overlay.clearQueue();
				}
				if(!overlay.is(":animated")){
					width["\"" + $(this).attr("data-id") + "\""] = overlay.width();
					heigth["\"" + $(this).attr("data-id") + "\""] = overlay.height();
				}
				overlay.css({"width": width + "px", "overflow": "hidden"});
				if(!overlay.children().size()){
					if($(this).attr("data-lang") == "en"){
						play_string = "Click to play video";
					} else {
						play_string = "Klik for at afspille video";
					}
					overlay.append("<p class='desc-p'>" + $(this).attr("data-desc") + '<div class="play_container">' + play_string + '</div></p>');
				}
				overlay.animate({"margin-top": "0px", "width": 220 - parseInt(overlay.css("padding-left")) - parseInt(overlay.css("padding-right")) + "px", "height": 146 - parseInt(overlay.css("padding-top")) - parseInt(overlay.css("padding-bottom")) + "px"}, 200)
			});
	}
	
	$.fn.hideThumbDesc = function(){
			return this.each(function() {
				overlay = $(this).children(".thumb_overlay");
				if(overlay.is(":animated")){
					overlay.clearQueue();
				}
				overlay.animate({"margin-top": "95px", "width": width["\"" + $(this).attr("data-id") + "\""] + "px", "height": heigth["\"" + $(this).attr("data-id") + "\""] + "px"}, 200);
				overlay.queue(function(){
					$(this).children().remove().queue();
					$(this).dequeue();
				});
			});
	}
	
	function thumb_scroll_back(){
		if(!parseInt($("#thumbnails_div").css("left")) <= 0 && !$("#thumbnails_div").is(":animated")){
			$("#thumbnails_div").animate({"left": parseInt($("#thumbnails_div").css("left")) + 240 + "px"}, 500)
		}
	}
	
	function thumb_scroll_forth(){
		if(!(parseInt($("#thumbnails_div").css("left")) <= -($("#thumbnails_div").width()-700)) && !$("#thumbnails_div").is(":animated")){			
			$("#thumbnails_div").animate({"left": parseInt($("#thumbnails_div").css("left")) - 240 + "px"}, 500)
		}
	}

})(jQuery);	



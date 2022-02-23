// JavaScript Document

//loading
$(document).ready( function(){
	$('#loading').delay(2000).fadeOut();
});

$(document).ready( function(){
    var hsize = $('header').height();
	$('#mainVisual, #main').css("padding-top", hsize + "px");
});

//Anchor link
$(function(){
    if ($(window).width() > 768) {
        $('a[href^="#"]').click(function(){
            var speed = 1000;
            var href= $(this).attr("href");
            var target = $(href == "#" || href == "" ? 'html' : href);
            var position = target.offset().top - $('#concept div h2').height();
            $("html, body").animate({scrollTop:position}, speed, "swing");
            return false;
        });
    }
});
$(function(){
    if ($(window).width() < 767 ) {
        $('a[href^="#"]').click(function(){
            $('.menu-trigger').removeClass('active');
            $('header nav').slideUp();
            var speed = 1000;
            var href= $(this).attr("href");
            var target = $(href == "#" || href == "" ? 'html' : href);
            var position = target.offset().top - $('#header').height();
            $("html, body").animate({scrollTop:position}, speed, "swing");
            return false;
        });
    }
});
$(function() {
    if ($(window).width() > 768) {
		var url = $(location).attr('href');
		if(url.indexOf("?id=") != -1){
			var id = url.split("?id=");
			var $target = $('#' + id[id.length - 1]);
			if($target.length){
				var pos = $target.offset().top - $('#concept div h2').height();
				$("html, body").animate({scrollTop:pos}, 1000);
			}
		}
	}
});
$(function () {
    if ($(window).width() < 767 ) {
		var url = $(location).attr('href');
	 	var headerHight = 120; //ãƒ˜ãƒƒãƒ€ã®é«˜ã•
		if(url.indexOf("?id=") != -1){
			$('.menu-trigger').removeClass('active');
			$('header nav').slideUp();
			var id = url.split("?id=");
			var $target = $('#' + id[id.length - 1]);
			if($target.length){
				var pos = $target.offset().top - $('#header').height();
				$("html, body").animate({scrollTop:pos}, 1000);
			}
		}
	}
});

//menu(sp)
$(function () {
    $('.menu-trigger').on('click', function () {
    $(this).toggleClass('active');
    $('header nav').slideToggle();
        return false;
    });
})

//header tracking
$(window).bind("load", function(){
    if(document.URL.match("hoge") || document.URL.match("hoge") || document.URL.match("hoge")) {
	} else {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 1) {
				$('header').addClass("fixed");
			} else {
				$('header').removeClass("fixed");
			}
		});
	}
});

//Scroll effect(mainVisual)
$(function(){
	if ($(window).width() > 738) {
		$('#stack').stickyStack({
			containerElement: '#stack',
			stackingElement: '#mainVisual',
		});
	}
})

$(document).ready(function(){$(".hamburger").on("click",function(){$(this).toggleClass("open"),$(".mobile-nav").toggleClass("shown")}),$(".mobile-nav .nav > li").has("ul").prepend('<a class="sub-open"></a>').addClass("parent"),$(".mobile-nav .parent > a:not(.sub-open)").dblclick(function(){var t=$(this).attr("href");window.location=t}),$(".mobile-nav .parent > a").on("click",function(){return $(this).parent().toggleClass("on"),!1});var t=$("#list-filter-start").data("start")||"all";$(".mix-container").mixItUp({load:{filter:t}}),$(".footer-testimonials .testimonial").each(function(){$(this).find("blockquote").text().length>300&&$(this).remove()}),$(".footer-testimonials .testimonial-list").slick({infinite:!0,autoplay:!0,autoplaySpeed:7e3,speed:600,cssEase:"ease",arrows:!1,adaptiveHeight:!0})});
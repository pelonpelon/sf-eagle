(function(){jQuery(function(){var t,e,n,a,i,r,o,s,c,h,f,u,l,d;u=$("#mast"),$(document).bind("keypress",function(t){return 114===t.which?location.reload():void 0}),i=$(".promo img"),n=i.attr("src"),i.wrap('<a href="'+n+'" rel="lightbox"></a>'),c=1,s=.9,o=.2,l="#f00",d="#a00",t=$("#page.calendar"),a=t.find("nav"),e=a.find("img"),r=t.find("tr"),e.each(function(){return $(this).mouseenter(function(){return $(this).css("borderColor",l)}),$(this).mouseleave(function(){return $(this).css("borderColor",d)})}),f=function(){return e.each(function(){return $(this).css("opacity",o),$(this).data("state","off")})},f(),e.each(function(){return $(this).data("state","off")}),h=function(t){return e.filter("."+t).click(function(e){var n;return e.preventDefault(),n=$(this).data("state"),"off"===$(this).data("state")?(f(),$(this).data("state","on"),$(this).css("opacity",c),r.fadeOut(100),r.filter("."+t).each(function(){return $(this).fadeIn(500)})):(f(),r.each(function(){return $(this).fadeIn(500)}))})},h("music"),h("bears"),h("leather"),h("special"),$("a[name]").attr("tabindex","0"),$("a[href*=#]:not([href=#])").click(function(){var t,e;return t=$(this),location.pathname.replace(/^\//,"")===this.pathname.replace(/^\//,"")&&location.hostname===this.hostname&&(e=$(this.hash),e=e.length?e:$("[name="+this.hash.slice(1)+"]"),e.length)?($("html,body").animate({scrollTop:e.offset().top},1e3,function(){e.focus(),window.location.hash=t.attr("href").substring(1)}),!1):void 0})})}).call(this);
//# sourceMappingURL=./main.map
(function(e){e.fn.hoverIntent=function(t,n){var r={sensitivity:7,interval:100,timeout:0};r=e.extend(r,n?{over:t,out:n}:t);var i,s,o,u,f=function(e){i=e.pageX;s=e.pageY},l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(o-i)+Math.abs(u-s)<r.sensitivity){e(n).unbind("mousemove",f);n.hoverIntent_s=1;return r.over.apply(n,[t])}o=i;u=s;n.hoverIntent_t=setTimeout(function(){l(t,n)},r.interval)},c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return r.out.apply(t,[e])},h=function(t){var n=jQuery.extend({},t),i=this;i.hoverIntent_t&&(i.hoverIntent_t=clearTimeout(i.hoverIntent_t));if(t.type=="mouseenter"){o=n.pageX;u=n.pageY;e(i).bind("mousemove",f);i.hoverIntent_s!=1&&(i.hoverIntent_t=setTimeout(function(){l(n,i)},r.interval))}else{e(i).unbind("mousemove",f);i.hoverIntent_s==1&&(i.hoverIntent_t=setTimeout(function(){c(n,i)},r.timeout))}};return this.bind("mouseenter",h).bind("mouseleave",h)}})(jQuery);
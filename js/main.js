// Generated by CoffeeScript 1.6.3
(function() {
  var e, t, n, r, i, s, o;
  i = "1";
  s = "0.5";
  e = $("#page.calendar");
  n = e.find("nav");
  t = n.find("img");
  r = e.find("tr");
  t.css({
    opacity: s
  });
  o = function(e) {
    return t.filter("." + e).click(function(n) {
      var o;
      n.preventDefault();
      o = $(this).css("opacity");
      t.css({
        opacity: s
      });
      if (o === i) {
        r.each(function() {
          return $(this).fadeIn(500);
        });
        return t.each(function() {
          return $(this).css({
            opacity: s
          });
        });
      }
      t.each(function() {
        return $(this).css({
          opacity: s
        });
      });
      $(this).css({
        opacity: i
      });
      return r.each(function() {
        $(this).fadeIn(100);
        if (!$(this).hasClass(e)) return $(this).fadeOut(500);
      });
    });
  };
  o("music");
  o("bears");
  o("leather");
  o("special");
}).call(this);
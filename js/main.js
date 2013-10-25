// Generated by CoffeeScript 1.6.3
(function() {
  jQuery(function() {
    var $c, $i, $n, $tr, calendar_button_bright, calendar_button_dim, filter_calendar, m;
    m = $('#mast');
    $(document).bind('keypress', function(e) {
      if (e.which === 114) {
        return location.reload();
      }
    });
    calendar_button_bright = "1";
    calendar_button_dim = "0.5";
    $c = $("#page.calendar");
    $n = $c.find("nav");
    $i = $n.find("img");
    $tr = $c.find("tr");
    $i.css({
      opacity: calendar_button_dim
    });
    filter_calendar = function(crowd) {
      return $i.filter("." + crowd).click(function(e) {
        var this_button_opacity;
        e.preventDefault();
        this_button_opacity = $(this).css("opacity");
        $i.css({
          opacity: calendar_button_dim
        });
        if (this_button_opacity === calendar_button_bright) {
          $tr.each(function() {
            return $(this).fadeIn(500);
          });
          return $i.each(function() {
            return $(this).css({
              opacity: calendar_button_dim
            });
          });
        } else {
          $i.each(function() {
            return $(this).css({
              opacity: calendar_button_dim
            });
          });
          $(this).css({
            opacity: calendar_button_bright
          });
          return $tr.each(function() {
            $(this).fadeIn(100);
            if (!$(this).hasClass(crowd)) {
              return $(this).fadeOut(500);
            }
          });
        }
      });
    };
    filter_calendar("music");
    filter_calendar("bears");
    filter_calendar("leather");
    return filter_calendar("special");
  });

}).call(this);

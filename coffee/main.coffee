# Calendar filtering

calendar_button_bright = "1"
calendar_button_dim = "0.5"

$c = $("#page.calendar")
$n = $c.find "nav"
$i = $n.find "img"
$tr = $c.find "tr"

$i.css opacity: calendar_button_dim


filter_calendar = (crowd) ->
  $i.filter("." + crowd).click (e) ->
    e.preventDefault()
    this_button_opacity = $(this).css "opacity"
    $i.css opacity: calendar_button_dim

    if this_button_opacity == calendar_button_bright
      $tr.each ->
        $(this).fadeIn 500
      $i.each ->
        $(this).css opacity: calendar_button_dim

    else
      $i.each ->
        $(this).css opacity: calendar_button_dim
      $(this).css opacity: calendar_button_bright
      $tr.each ->
        $(this).fadeIn 100
        $(this).fadeOut 500  unless $(this).hasClass(crowd)

filter_calendar "music"
filter_calendar "bears"
filter_calendar "leather"
# filter_calendar "drag"
filter_calendar "special"


jQuery ->
#    console.log "start"
  # keypress to force reload of page
  m = $ ('#mast')
  $(document).bind 'keypress', (e) ->
    location.reload() if e.which is 114
  # add lightbox to Drink Special img
  $promoImg = $(".promo img")
  $imgsrc = $promoImg.attr("src")
  $promoImg.wrap("<a href=\""+$imgsrc+"\" rel=\"lightbox\"></a>")


  # Calendar filtering

  calendar_button_on = 1.0
  calendar_button_hover = 0.9
  calendar_button_dim = 0.2
  mouseenter_color = "#f00"
  mouseleave_color = "#a00"

  $c = $("#page.calendar")
  $n = $c.find "nav"
  $i = $n.find "img"
  $tr = $c.find "tr"

  $i.each ->
    $(this).mouseenter ->
      $(this).css "borderColor", mouseenter_color
    $(this).mouseleave ->
      $(this).css "borderColor", mouseleave_color

  hover_reset = ->
    $i.each ->
      $(this).css "opacity", calendar_button_dim
      $(this).data "state", "off"

  hover_reset()
  $i.each ->
    $(this).data "state", "off"
#        console.log ($(this).attr "class"),
#            ($(this).data "state"),
#            ($(this).css "borderColor")

  filter_calendar = (crowd) ->
    $i.filter("." + crowd).click (e) ->
#            console.log crowd + " " + $(this).data "state"
      e.preventDefault()
      oldButtonState = $(this).data("state")
      if ($(this).data "state") == "off"
        hover_reset()
        $(this).data "state", "on"
        $(this).css "opacity", calendar_button_on
#                console.log crowd + " is " + $(this).data "state"
        $tr.fadeOut 100
        $tr.filter("."+ crowd).each ->
#                    console.log $(this)
          $(this).fadeIn 500
      else
        hover_reset()
        $tr.each ->
          $(this).fadeIn 500

  filter_calendar "music"
  filter_calendar "bears"
  filter_calendar "leather"
  # filter_calendar "drag"
  filter_calendar "special"

#
# gentle scrolling when clicking on menu item
#

  # ADDED: make sections focusable
  $("a[name]").attr "tabindex", "0"

  # end ADDED
  $("a[href*=#]:not([href=#])").click ->
    $linkElem = $(this)
    if location.pathname.replace(/^\//, "") is @pathname.replace(/^\//, "") and location.hostname is @hostname
      target = $(@hash)
      target = (if target.length then target else $("[name=" + @hash.slice(1) + "]"))
      if target.length
        $("html,body").animate { scrollTop: target.offset().top } , 1000, ->
          # ADDED: focus the target
          target.focus()
          # end ADDED
          # ADDED: update the URL
          window.location.hash = $linkElem.attr("href").substring(1)
          return

        # window.location.hash = $(this).attr('href').substring(1, $(this).attr('href').length);
        # end ADDED
        false

  return


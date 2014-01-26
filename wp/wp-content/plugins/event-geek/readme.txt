=== Event Geek ===
Contributors: graphicgeek
Donate link: http://graphicgeek.net/donations/
Tags: event, events, calendar, calendar widget, ajax, free calendar, simple event calendar, sidebar, event calendar, event list, event post type
Requires at least: 3.5
Tested up to: 3.8
Stable tag: 2.5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An easy to use events plugin, with a calendar widget.

== Description ==

An easy to use events plugin built with [jQuery UI](http://jqueryui.com/ "jQuery UI") and AJAX. The philosophy behind this plugin is to keep it simple.

Features Includes:

* Events content added with standard WordPress editor as a custom post type
* jQuery UI based calendar widget
* Display events in a pop-up box with AJAX
* Shortcode to display a list of events on a post or page
* Several calendar styles to choose from, or you can use your own
* Easily customize the event info fields
* Several hooks included for even more customization

[See a Live Demo Here](http://eventgeek.graphicgeek.org/ "Event Geek Live Demo")

== Installation ==

1. Download the zip file and extract the files
1. Upload all the files to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Once activated, you will be able to add events through the "Events" section of the dashboard.
1. Events can be displayed with the Event Geek Widget, or with the '[event_geek_list]' shortcode

== Frequently Asked Questions ==

= How do I make the calendar start on Sunday? =
* Event Geek gets date formating information from the general settings in the WordPress Dashboard (Settings > General).
* To Make the calendar start on Monday, simply change the "Week Starts On" setting.
* To change the date format just select one of the options from the Date Format section.

= How can I use Event Geek in my theme files? =
* You can display the list of events using the following: &lt;?php event_geek_list(); ?&gt;

= How can I customize Event Geek? =
* You can choose a theme for the calendar widget and other style options under Events > Options
* You can also specify the url to your own CSS file for the calendar widget
* To create your own CSS file for the calendar see [jQuery UI Themeroller](http://jqueryui.com/themeroller/ "Roll your own theme")
* For even more customization options, see [graphicgeek.net/event-geek](http://graphicgeek.net/event-geek#hooks "list of Event Geek Hooks")

= Will Event Geek Work in My Language? =
* Yes! The latest calendar widget will use the same language as your installation of WordPress (see: [http://codex.wordpress.org/WordPress_in_Your_Language](http://codex.wordpress.org/WordPress_in_Your_Language))
* The Plugin admin panels are also translated into French and Lithuanian. If you are interested in help me translate into more languages, feel free to [contact me](http://graphicgeek.net/contact/ "Contact Graphic Geek").

= Help, my events aren't showing up in the calendar widget! =
* When creating or updating events, make sure you select the event dates with the datepicker tool.
* Dates entered manually (by typing them in), will not be saved properly, and will not show up in the calendar widget

= I have a suggestion, who do I contact? =
* If you have questions, comments, or feature requests, you can contact [Graphic Geek](http://graphicgeek.net/contact/ "Contact Graphic Geek"), or [leave a comment](http://graphicgeek.net/geek-events/ "Event Geek Page on graphicgeek.net")

= For More Complete Documentation: =
* [eventgeek.graphicgeek.org/documentation](http://eventgeek.graphicgeek.org/documentation "Event Geek Documentation")

== Screenshots ==

1. Set the start and end dates, as well as other event info
2. Select a theme for the calendar widget, and choose the colors for highlighting event days. You can also put in the location of your own css file to style the calendar.
3. The calendar widget on the front end of the site
4. Easily add, remove and arange event info fields, with drag and drop sorting
5. As of version 2.2, you can add categories just like you would with a normal WordPress post
6. You can select event day text and highlight colors for each category

== Changelog ==

= 2.5.2 =
* Added spanish translation
* Fixed glitch with slide indicators on options page
* Add ability to remove event images
* Tested with WordPress 3.8

= 2.5.1 =
* Added hooks for before and after the shortcode content
* Tested with WordPress 3.7.1

= 2.5 =
* Added several more actions and filter
* Moved style and script functions out of gg-functions.php to seperate files
* Tested with WordPress 3.7

= 2.4.1 =
* Fixed "Illegal string offset" bug with shortcode

= 2.4 =
* Make sure user has proper privlages to edit category colors
* Renamed some functions to safeguard against duplication
* Added filter for ajax loader gif
* Added category and "all_dates" options to event_geek_list() template function and event_geek_list shortcode

= 2.3 =
* Added ability to set specific widget highlight and text colors for each category

= 2.2 =
* Added filters for some of the post type options (public, has_archive, supports, rewrite slug)
* Added filters for language options and clicked date
* Added filters for up and down arrows in ajax window
* Added ajax window header and footer actions
* Added template function to display the calendar
* Added event categories
* Added a calendar admin menu icon
* Converted Formated dates in admin columns
* Removed popup option from options page (this is controlled by the widget instead)
* Use html data attribute to store event dates rather than global js variable
* Added Romanian translation

= 2.1 =
* Fixed bug that prevented single day events from showing up with the shortcode or template tag
* Added filters and actions to widget

= 2.0 =
* Added a demo link
* Prevent selection of an end date that is before start date (or a start date that is after an end date)
* Add option to open events on event page rather than in a pop up
* Add option to specify event page (to use in place of pop up and/or to link to in the Widget)
* Add option to include link to event page (specified on the options page) under the widget
* Commented out all occurances of console.log (they were causing a javascript error in ie8)

= 1.9.3 =
* Fixed internationalization problem that caused 1 January 1970 to show in place of start and end dates when using the shortcode or template tag 
* Updated French translation

= 1.9.2 =
* Template tag and shortcode now no longer shows events that have already ended
* Add filter and translation to navigation links (next/previous) in template tag

= 1.9.1 =
* Fixed compatability issues with the latest jquery ui (this makes the widget work with WordPress 3.6)
* Fixed bug with lightbox settings display on options page
* Simplified the javascript enqueues

= 1.9 =
* Added lightbox options
* Added options to easily style the pop up box
* Add "link text" field for links in info box
* Added social links to the options page
* Added Italian translation
* Minor changes to the admin javascript
* Removed some drop shadows, and other minor changes to css
* Promo link on by default (still easy to turn off in options)
* Laid some groundwork for full page calendar feature

= 1.8.1 =
* Changed name of global javascript variable from site_vars to gg_event_site_vars to prevent potential conflicts with other plugins
* Added Lithuanian translation

= 1.8 =
* More foreign language fixes. Users upgrading from older versions may need to re-enter dates and re-save the events
* Added z-index to pop-up
* Enabled translations, and added French translation
* Fixed localaization typo in gg-ajax.php
* Updated options page with gettext

= 1.7 =
* Added mouse wheel scrolling in the pop-up window with jquery.mousewheel.js
* Added customization options for event info
* Improved responsive styling
* Fixed yet another foreign language bug
* Event info is now retrieved with a seperate function
* Added css to make the widget 95% the width of the parent div
* Added donation and support info to the options page
* Added plugin version to global javascript variable to help with future troubleshooting
* New screenshots for current version

= 1.6 =
* Added a template tag for use in themes (makes a paginated events list possible)
* One more multi-language conversion fix using date_i18n function

= 1.5.2 =
* Fixed error that prevented content from appearing in ajax pop up

= 1.5.1 =
* More multi-language bug fixes

= 1.5 =
* Fixed misc sorting bugs
* Store date ranges in standardized format
* More universal php to javascript date conversion function 

= 1.4.1 =
* fixed bug that broke calendar if date format isn't set or isn't recognized

= 1.4 =
* Replaced farbtastic color picker with wp-color-picker
* Added internationalization options to work with WordPress installs in other languages
* Fixed some sorting issues
* Match the date formatting set in WordPress settings
* Store date ranges with wp_localize_script function

= 1.3 =
* Fixed farbtastic javascript error
* Fixed issue with theme thumbs  not appearing on some development sites

= 1.2 =
* Fixed 'modify header' bug

= 1.1 =
* Fixed bug in Javascript that may have broken the AJAX on some development sites* Added Shortcode* Added Readme file and screenshots= 1.0 =* Testing version

== Upgrade Notice ==

= 2.5.2 =
* Added spanish translation
* Fixed glitch with slide indicators on options page
* Add ability to remove event images
* Tested with WordPress 3.8

= 2.5.1 =
* Added hooks for before and after the shortcode content
* Tested with WordPress 3.7.1

= 2.5 =
* Added several more actions and filter
* Moved style and script functions out of gg-functions.php to seperate files
* Tested with WordPress 3.7

= 2.4.1 =
* Fixed "Illegal string offset" bug with shortcode

= 2.4 =
* Make sure user has proper privlages to edit category colors
* Renamed some functions to safeguard against duplication
* Added filter for ajax loader gif
* Added category and "all_dates" options to event_geek_list() template function and event_geek_list shortcode

= 2.3 =
* Added ability to set specific widget highlight and text colors for each category

= 2.2 =
* Added filters for some of the post type options (public, has_archive, supports, rewrite slug)
* Added filters for language options and clicked date
* Added filters for up and down arrows in ajax window
* Added ajax window header and footer actions
* Added template function to display the calendar
* Added event categories
* Converted Formated dates in admin columns
* Removed popup option from options page (this is controlled by the widget instead)
* Added Romanian translation

= 2.1 =
* Fixed bug that prevented single day events from showing up with the shortcode or template tag
* Added filters and actions to widget

= 2.0 =
* Added a demo link
* Prevent selection of an end date that is before start date (or a start date that is after an end date)
* Add option to open events on event page rather than in a pop up
* Add option to specify event page (to use in place of pop up and/or to link to in the Widget)
* Add option to include link to event page (specified on the options page) under the widget
* Commented out all occurances of console.log (they were causing a javascript error in ie8)

= 1.9.3 =
* Fixed internationalization problem that caused 1 January 1970 to show in place of start and end dates when using the shortcode or template tag 
* Updated French translation

= 1.9.2 =
* Template tag and shortcode now no longer shows events that have already ended
* Add filter and translation to navigation links (next/previous) in template tag

= 1.9.1 =
* Fixed compatability issues with the latest jquery ui (this makes the widget work with WordPress 3.6)
* Fixed bug with lightbox settings display on options page

= 1.9 =
* Added lightbox options
* Added options to easily style the pop up box
* Add "link text" field for links in info box
* Added Italian translation

= 1.8.1 =
* Changed name of global javascript variable to prevent potential conflicts with other plugins
* Added Lithuanian translation

= 1.8 =
* More foreign language fixes. Users upgrading from older versions may need to re-enter dates and re-save the events
* Added z-index to pop-up
* Enabled translations, and added French translation
* Fixed localaization typo in gg-ajax.php

= 1.7 =
* Added mouse wheel scrolling in the pop-up window
* Added customization options for event info
* Tweaks to improve responsive styling
* Fixed yet another foreign language bug, hopefully the last
* Added css to make the widget 95% the width of the parent div
* Added donation and support info to the options page

= 1.6 =
* Added a template tag for use in themes (makes a paginated events list possible)
* One more multi-language conversion fix

= 1.5.2 =
* Fixed error that prevented content from appearing in ajax pop up

= 1.5.1 =
* More multi-language bug fixes

= 1.5 =
* Fixed misc sorting bugs
* More universal php to javascript date conversion function

= 1.4.1 =
* fixed bug that broke calendar if date format isn't set or isn't recognized

= 1.4 =
* Replaced farbtastic color picker with wp-color-picker
* Added internationalization options to work with WordPress installs in other languages
* Fixed some sorting issues
* Match the date formatting set in WordPress settings

= 1.3 =
* Fixed farbtastic javascript error
* Fixed issue with theme thumbs  not appearing on some development sites

= 1.2 =
* Fixed 'modify header' bug
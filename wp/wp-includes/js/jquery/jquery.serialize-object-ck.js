/*!
 * jQuery serializeObject - v0.2 - 1/20/2010
 * http://benalman.com/projects/jquery-misc-plugins/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */// Whereas .serializeArray() serializes a form into an array, .serializeObject()
// serializes a form into an (arguably more useful) object.
(function(e,t){"$:nomunge";e.fn.serializeObject=function(){var n={};e.each(this.serializeArray(),function(r,i){var s=i.name,o=i.value;n[s]=n[s]===t?o:e.isArray(n[s])?n[s].concat(o):[n[s],o]});return n}})(jQuery);
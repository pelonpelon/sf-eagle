/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */(function(){tinymce.create("tinymce.plugins.WPDialogs",{init:function(e,t){tinymce.create("tinymce.WPWindowManager:tinymce.InlineWindowManager",{WPWindowManager:function(e){this.parent(e)},open:function(e,t){var n=this,r;if(!e.wpDialog)return this.parent(e,t);if(!e.id)return;r=jQuery("#"+e.id);if(!r.length)return;n.features=e;n.params=t;n.onOpen.dispatch(n,e,t);n.element=n.windows[e.id]=r;n.bookmark=n.editor.selection.getBookmark(1);r.data("wpdialog")||r.wpdialog({title:e.title,width:e.width,height:e.height,modal:!0,dialogClass:"wp-dialog",zIndex:3e5});r.wpdialog("open")},close:function(){if(!this.features.wpDialog)return this.parent.apply(this,arguments);this.element.wpdialog("close")}});e.onBeforeRenderUI.add(function(){e.windowManager=new tinymce.WPWindowManager(e)})},getInfo:function(){return{longname:"WPDialogs",author:"WordPress",authorurl:"http://wordpress.org",infourl:"http://wordpress.org",version:"0.1"}}});tinymce.PluginManager.add("wpdialogs",tinymce.plugins.WPDialogs)})();
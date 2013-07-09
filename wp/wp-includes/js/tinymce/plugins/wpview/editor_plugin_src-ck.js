/**
 * WordPress View plugin.
 */(function(){var e=tinymce.VK,t=tinymce.dom.TreeWalker,n;tinymce.create("tinymce.plugins.wpView",{init:function(r,i){var s=this;if(typeof wp=="undefined"||!wp.mce)return;r.onPreInit.add(function(e){e.schema.addValidElements("div[*],span[*]")});r.onBeforeSetContent.add(function(e,t){if(!t.content)return;t.content=wp.mce.view.toViews(t.content)});r.onSetContent.add(function(e,t){wp.mce.view.render(e.getDoc())});r.onInit.add(function(e){e.selection.onBeforeSetContent.add(function(n,r){var i=s.getParentView(n.getNode()),o,u;if(!i)return;if(!i.nextSibling||s.isView(i.nextSibling)){u=e.getDoc().createTextNode("");e.dom.insertAfter(u,i)}else{o=new t(i.nextSibling,i.nextSibling);u=o.next()}n.select(u);n.collapse(!0)});e.selection.onSetContent.add(function(e,t){if(!t.context)return;var n=e.getNode();if(!n.innerHTML)return;n.innerHTML=wp.mce.view.toViews(n.innerHTML);wp.mce.view.render(n)})});r.onPostProcess.add(function(e,t){if(!t.get&&!t.save||!t.content)return;t.content=wp.mce.view.toText(t.content)});r.onNodeChange.addToTop(function(e,t,n,r,i){var o=s.getParentView(n);if(o){s.select(o);return!1}s.deselect()});r.onKeyDown.addToTop(function(t,r){var i=r.keyCode,o,u;if(!n)return;o=s.getParentView(t.selection.getNode());if(o!==n){s.deselect();return}if(i===e.DELETE||i===e.BACKSPACE)if(u=wp.mce.view.instance(n)){u.remove();s.deselect()}if(r.metaKey||r.ctrlKey||i>=112&&i<=123)return;r.preventDefault()})},getParentView:function(e){while(e){if(this.isView(e))return e;e=e.parentNode}},isView:function(e){return/(?:^|\s)wp-view-wrap(?:\s|$)/.test(e.className)},select:function(e){if(e===n)return;this.deselect();n=e;wp.mce.view.select(n)},deselect:function(){n&&wp.mce.view.deselect(n);n=null},getInfo:function(){return{longname:"WordPress Views",author:"WordPress",authorurl:"http://wordpress.org",infourl:"http://wordpress.org",version:"1.0"}}});tinymce.PluginManager.add("wpview",tinymce.plugins.wpView)})();
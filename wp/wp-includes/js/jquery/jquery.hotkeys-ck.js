/******************************************************************************************************************************

 * @ Original idea by by Binny V A, Original version: 2.00.A 
 * @ http://www.openjs.com/scripts/events/keyboard_shortcuts/
 * @ Original License : BSD
 
 * @ jQuery Plugin by Tzury Bar Yochay 
        mail: tzury.by@gmail.com
        blog: evalinux.wordpress.com
        face: facebook.com/profile.php?id=513676303
        
        (c) Copyrights 2007
        
 * @ jQuery Plugin version Beta (0.0.2)
 * @ License: jQuery-License.
 
TODO:
    add queue support (as in gmail) e.g. 'x' then 'y', etc.
    add mouse + mouse wheel events.

USAGE:
    $.hotkeys.add('Ctrl+c', function(){ alert('copy anyone?');});
    $.hotkeys.add('Ctrl+c', {target:'div#editor', type:'keyup', propagate: true},function(){ alert('copy anyone?');});>
    $.hotkeys.remove('Ctrl+c'); 
    $.hotkeys.remove('Ctrl+c', {target:'div#editor', type:'keypress'}); 
    
******************************************************************************************************************************/(function(e){this.version="(beta)(0.0.3)";this.all={};this.special_keys={27:"esc",9:"tab",32:"space",13:"return",8:"backspace",145:"scroll",20:"capslock",144:"numlock",19:"pause",45:"insert",36:"home",46:"del",35:"end",33:"pageup",34:"pagedown",37:"left",38:"up",39:"right",40:"down",112:"f1",113:"f2",114:"f3",115:"f4",116:"f5",117:"f6",118:"f7",119:"f8",120:"f9",121:"f10",122:"f11",123:"f12"};this.shift_nums={"`":"~",1:"!",2:"@",3:"#",4:"$",5:"%",6:"^",7:"&",8:"*",9:"(",0:")","-":"_","=":"+",";":":","'":'"',",":"<",".":">","/":"?","\\":"|"};this.add=function(t,n,r){if(e.isFunction(n)){r=n;n={}}var i={},s={type:"keydown",propagate:!1,disableInInput:!1,target:e("html")[0]},o=this;i=e.extend(i,s,n||{});t=t.toLowerCase();var u=function(t){var n=t.target;if(i.disableInInput){var r=e(n);if(r.is("input")||r.is("textarea"))return}var s=t.which,u=t.type,a=String.fromCharCode(s).toLowerCase(),f=o.special_keys[s],l=t.shiftKey,c=t.ctrlKey,h=t.altKey,p=t.metaKey,d=!0,v=null;while(!o.all[n]&&n.parentNode)n=n.parentNode;var m=o.all[n].events[u].callbackMap;if(!l&&!c&&!h&&!p)v=m[f]||m[a];else{var g="";h&&(g+="alt+");c&&(g+="ctrl+");l&&(g+="shift+");p&&(g+="meta+");v=m[g+f]||m[g+a]||m[g+o.shift_nums[a]]}if(v){v.cb(t);if(!v.propagate){t.stopPropagation();t.preventDefault();return!1}}};this.all[i.target]||(this.all[i.target]={events:{}});if(!this.all[i.target].events[i.type]){this.all[i.target].events[i.type]={callbackMap:{}};e.event.add(i.target,i.type,u)}this.all[i.target].events[i.type].callbackMap[t]={cb:r,propagate:i.propagate};return e};this.remove=function(t,n){n=n||{};target=n.target||e("html")[0];type=n.type||"keydown";t=t.toLowerCase();delete this.all[target].events[type].callbackMap[t];return e};e.hotkeys=this;return e})(jQuery);
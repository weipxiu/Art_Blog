"use strict";function _typeof(t){return(_typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}!function(){function t(){}t.prototype={init:function(){$(window).width()<1200?this.mobileFnAll():(this.pcFnAll(),this.articleReward(),this.stringEffect()),this.loadBar(),this.informationLazy_load(),this.navReform(),this.navPianoEffect(),this.isNotResources(),this.websiteRunningTime(),this.imagesEnlarge(),this.pageDetailsFabulous(),this.paperPlane(),this.playVideo(),this.customerService(),this.friendshipLink(),this.smiliesEmoticon(),this.randomArticles(),this.commentStyle()},inintMusicNav:function(){1!=localStorage.getItem("off_y")?(localStorage.setItem("off_y",0),$(".nav ul.music-nav > li").removeClass("on"),$(".mod-header_music-icon").removeClass("hover")):(localStorage.setItem("off_y",1),$(".nav ul.music-nav > li").addClass("on"),$(".mod-header_music-icon").addClass("hover"))},loadBar:function(){window.onload=function(){$("header .speed_bar").css({animation:"speed_bar_animation_complete .5s ease-out","animation-fill-mode":"forwards"})}},elementInView:function(t){var e=t.getBoundingClientRect(),i=e.top<window.innerHeight&&0<e.bottom,n=e.left<window.innerWidth&&0<e.right;return i&&n},informationLazy_load:function(){var i=this;function t(){for(var t=document.querySelectorAll(".continar-left .text .Lazy_load"),e=0;e<t.length;e++)i.elementInView(t[e])&&t[e].getAttribute("data-original")&&(console.log("图片加载成功",e),t[e].setAttribute("src",t[e].getAttribute("data-original")),t[e].removeAttribute("data-original"))}t(),$(document).scroll(function(){t()})},navReform:function(){for(var t=$(".header .music-nav").children("li"),e=0;e<t.length;e++){var i=t.eq(e).children("a").html();t.eq(e).children("a").text("").append("<span>"+i+"</span><span>"+i+"</span>"),t.eq(e).hasClass("current-menu-item")&&t.eq(e).addClass("action"),(0<t.eq(e).find("i").length||0<t.eq(e).find("ul").length)&&t.eq(e).children("a").addClass("icon_show")}t.append("<audio src='' autoplay='autoplay'></audio><p></p>"),$("#nav_list .sub-menu").siblings("a").attr("href","javascript:void(0);"),$("#nav_list .sub-menu").siblings("a").find("span").append("<i class='iconfont icon-jiantou menu_arrow'></i>"),$(".os-herder .sub-menu").siblings("a").append("<i class='iconfont iconfont_click icon-xiajiantou'></i>"),$(".header .sub-menu").addClass("nav-min"),$(".os-herder .sub-menu").addClass("slide_slect");$(".header .music-nav").append("<li id='backstage' style='display:none'><a href='/wp-admin/' target='_blank'><span>后台管理</span><span>后台管理</span></a><p></p><audio src='' autoplay='autoplay'></audio></li><li class='js_piano_nav_icon mod-header_music-icon'><audio src='' autoplay='autoplay'></audio><i></i><i></i><i></i><i></i><i></i></li>")},navPianoEffect:function(){var e=this,t=null,i=null,n=null,o=$(".nav ul.music-nav > li:not(.mod-header_music-icon)");$(".header").hover(function(){$(this).css("z-index","12")},function(){t||$(".site-search").is(":visible")?$(".header").css("z-index","12"):$(".header").css("z-index","10")});var a=[];o.mouseenter(function(){clearTimeout(t),$(this).addClass("active"),a.push($(this).index()),$(".header").css("z-index","12"),i=$(this).index(),n=o.eq(i).find("audio"),1==localStorage.getItem("off_y")?($(this).addClass("active"),n.get(0).src="/wp-content/themes/Art_Blog/music/nav_"+parseInt(i+1)+".mp3"):n.get(0).src=""}),o.mouseleave(function(){0<a.length&&setTimeout(function(){o.eq(a[0]).removeClass("active"),a.shift()},250),t=setTimeout(function(){$(".site-search").is(":visible")||$(".header").css("z-index","10")},1e3)}),$(document).keydown(function(t){if(1==localStorage.getItem("off_y")){var e,i=[65,83,68,70,71,72,74,75,76].indexOf(t.keyCode);0<=i&&(e=i+1)<=o.length&&(o.eq(e-1).find("audio").get(0).src="/wp-content/themes/Art_Blog/music/nav_"+e+".mp3",o.eq(e-1).addClass("active"),o.eq(e-1).addClass("keyboard_color"))}}),$(document).keyup(function(){setTimeout(function(){o.removeClass("active"),o.removeClass("keyboard_color")},150)}),$(".mod-header_music-icon").click(function(){1!=localStorage.getItem("off_y")?($(this).addClass("hover"),$(".nav ul.music-nav > li").addClass("on"),$(".nav ul.music-nav > li").removeClass("off"),localStorage.setItem("off_y",1),layer.msg("菜单音乐已开启~",{time:2e3},function(){layer.msg("无需鼠标，导航音乐键盘A-K也可以体验哦~~")})):($(this).removeClass("hover"),$(".nav ul.music-nav li").addClass("off"),$(".nav ul.music-nav li").removeClass("on"),localStorage.setItem("off_y",0),layer.msg("菜单音乐已关闭，期待您的下次体验！",{time:4e3}))}),$(".js_piano_nav_icon").mouseenter(function(){1!=localStorage.getItem("off_y")?layer.tips("开启全站音频",".js_piano_nav_icon",{tips:3,tipsMore:!1,time:2e3}):layer.tips("关闭全站音频",".js_piano_nav_icon",{tips:3,tipsMore:!1,time:2e3})});var s=!0;$(".navto-search a").click(function(){s?$(".header").css("z-index","11"):$(".header").css("z-index","10"),s=!s,$(".site-search.active.pc").toggle(),$(".site-search.active.pc").find("input").focus()}),$(".xis,.navto-search a").click(function(){$(this).find("i").toggleClass("icon-sousuo icon-guanbi3")}),$(".header").addClass("Top"),e.inintMusicNav(),window.onstorage=function(t){e.inintMusicNav()}},isNotResources:function(){0<$(".continar-left .article_not").length&&$("body").css({background:"#fff"})},websiteRunningTime:function(){setInterval(function(){var t=Math.round(new Date(Date.UTC(2016,10,16,0,0,0)).getTime()/1e3),e=function(t){if(!t)return 0;var e=new Array(0,0,0,0,0);return 31536e3<=t&&(e[0]=parseInt(t/31536e3),t%=31536e3),86400<=t&&(e[1]=parseInt(t/86400),t%=86400),3600<=t&&(e[2]=parseInt(t/3600),t%=3600),60<=t&&(e[3]=parseInt(t/60),t%=60),0<t&&(e[4]=t),e}(Math.round(((new Date).getTime()+288e5)/1e3)-t),i=e[0]+"年"+e[1]+"天"+e[2]+"时"+e[3]+"分"+e[4]+"秒";$("#htmer_time").html(i)},1e3)},imagesEnlarge:function(){var t=function(i,n){var o;return["webkit","moz","ms","o",""].forEach(function(t){if(!o){""===t&&(n=n.slice(0,1).toLowerCase()+n.slice(1));var e=_typeof(i[t+n]);e+""!="undefined"&&(o="function"===e?i[t+n]():i[t+n])}}),o};if("number"==typeof window.screenX)for(var e=document.querySelectorAll(".log-text img"),i=0;i<e.length;i++)e[i].addEventListener("click",function(){t(document,"FullScreen")||t(document,"IsFullScreen")?(t(document,"CancelFullScreen"),this.title=this.title.replace("退出","")):t(this,"RequestFullScreen")&&(this.title=this.title.replace("点击","点击退出"))});else layer.alert("亲，这都什么年代了，您还在用这么土的浏览器吗~~",{skin:"layui",title:"请更换浏览器",closeBtn:0,anim:4})},pageDetailsFabulous:function(){setTimeout(function(){$(".page-reward .page-reward-btn .tooltip-item font,.page-reward .page-reward-btn .tooltip-item a").toggleClass("s_show")},2e3),$.fn.postLike=function(){if($(this).hasClass("done"))return!1;$(this).addClass("done");var t=$(this).data("id"),e=$(this).data("action"),i=$(this).children(".count"),n={action:"bigfa_like",um_id:t,um_action:e};return $.post("/wp-admin/admin-ajax.php",n,function(t){$(i).html(t)}),!1},$(document).on("click",".favorite",function(){$(this).postLike()})},paperPlane:function(){var i=this;$(".aircraft").click(function(){$(this).animate({bottom:"0",opacity:"1"},100,function(){setTimeout(function(){$("body,html").animate({scrollTop:0},1200),$(".aircraft").animate({top:"0",bottom:"auto",opacity:"0"},700,function(){setTimeout(function(){$(".aircraft").css({bottom:"50px",top:"auto",opacity:"1"})},500)})},300)})});var n=$(document).scrollTop();500<n&&$(".aircraft").css({display:"block",opacity:"1"});var o=null;function t(){500<(n=$(document).scrollTop())?$(".aircraft").css({display:"block",opacity:"1"}):$(".aircraft").css({display:"none",opacity:"0"}),n<=0?($(".header").addClass("Top"),$(".header").removeClass("hover")):($(".header").removeClass("Top"),$(".header").addClass("hover"));var t=$(".continar-right");if(1200<$(window).width()&&t.length)if(o=$(".continar-left").offset().left+$(".continar-left").outerWidth()+10,(i.elementInView($(".continar-right > div:last-of-type")[0])||n>t.outerHeight())&&!i.elementInView($(".footer")[0]))n>t.outerHeight()-$(window).height()+$(".continar-right > div:last-of-type").outerHeight()-100&&$(".continar-left").outerHeight()>=t.outerHeight()?t.css({position:"fixed",bottom:"0",left:o+"px"}):t.css({position:"static",bottom:"auto",left:"auto"});else if(i.elementInView($(".footer")[0])&&$(".continar-left").outerHeight()>=t.outerHeight()){var e=$(window).height()-($(".continar-left").outerHeight()+($(".continar-left").offset().top-$(document).scrollTop()));t.css({position:"fixed",bottom:e+"px",left:o+"px"})}else t.css({position:"static",bottom:"auto",left:"auto"})}t(),$(document).scroll(function(){t()}),window.onresize=function(){t()}},customerService:function(){$("#wuyousujian-kefuDv").hover(function(){$("#wuyousujian-kefuDv").stop().animate({right:"-100px"},500)},function(){$("#wuyousujian-kefuDv").stop().animate({right:"-196px"},500)})},articleReward:function(){$(".js_reward").click(function(){layer.open({content:$("#reward-popup"),type:1,title:!1,skin:"layui-layer-demo",area:["500px","360px"],shadeClose:!0,success:function(t,e){var i=t[0].childNodes[1];i.childNodes[0].removeAttribute("href"),i.classList.add("cursorStyle"),i.childNodes[0].classList.remove("layui-layer-close2"),i.childNodes[0].classList}})})},stringEffect:function(){String.prototype.gblen=function(){for(var t=0,e=0;e<this.length;e++)127<this.charCodeAt(e)||94==this.charCodeAt(e)?t+=2:t++;return t},$.extend($.easing,{easeOutElastic:function(t,e,i,n,o){var a=1.70158,s=0,r=n;if(0==e)return i;if(1==(e/=o))return i+n;if(s||(s=.3*o),r<Math.abs(n)){r=n;a=s/4}else a=s/(2*Math.PI)*Math.asin(n/r);return r*Math.pow(2,-10*e)*Math.sin((e*o-a)*(2*Math.PI)/s)+n+i}}),$.fn.qin=function(t){var e=$.extend({},{offset:22,duration:500,recline:.1},t);return this.each(function(){var n,c,l,o,t=$(this);!function(t){var e="",i=0;if(t.text().trim().gblen()<38)e=t.text().trim();else for(var n=0;n<38&&e.gblen()<38;n++)e=t.text().trim().slice(0,i)+"...",i++;for(var o="",a=0,s=e.length;a<s;a++)o+="<span>"+e.substr(a,1)+"</span>";t.html(o);var r=[];t.children("span").each(function(){var t=$(this),e=t.position();r.push(e),t.css({top:"0px",left:e.left+"px"}),setTimeout(function(){t.css("position","absolute")},0)}),t.data("stringPosition",r)}(t),c=e,l=(n=t).data("stringPosition"),o=0,n.mouseenter(function(t){var e=n.offset();t.pageX,e.left,o=t.pageY-e.top}),n.mousemove(function(t){var e=n.offset(),a=t.pageX-e.left,i=t.pageY-e.top,s=i-o;if(!(Math.abs(s)>c.offset)){var r=0<s;n.children("span").each(function(t){var e=$(this),i=l[t],n=Math.abs(a-i.left)*c.recline;n*=r?1:-1;var o=i.top+s-n;r&&o<i.top?o=i.top:!r&&o>i.top&&(o=i.top),e.css({top:o+"px"})})}}),n.mouseleave(function(){n.children("span").each(function(t){$(this).stop(!0,!1).animate({top:"0px"},{duration:c.duration,easing:"easeOutElastic"})})})})},$(".mouseover ul li a").qin({offset:20,duration:500,recline:.1})},friendshipLink:function(){!function(t){for(var e=0;e<t.length;e++)t.eq(e).addClass("color-"+(parseInt(8*Math.random(),10)+1))}($(".friendship .daily-list ul li"))},smiliesEmoticon:function(){$("#commentform .iconfont").click(function(){$("#smilies_modal").toggle(),$("#smilies_modal img").each(function(){$(this).attr("src",$(this).attr("data-src"))})})},playVideo:function(){if($("#my-video").length){videojs("my-video");document.getElementById("my-video_html5_api").onerror=function(){layer.alert("通常是由于视频地址错误或未添加视频封面图引起，请检查！",{skin:"layui",title:"视频初始化失败",closeBtn:0,anim:4})}}},randomArticles:function(){for(var t=0;t<=$(".mouseover ul li").length;t++)$(".mouseover ul li").eq(t).find("em").html(t+1)},commentStyle:function(){"none"!=$("#cancel-comment-reply-link").css("display")?$("#reply-title").show():$("#reply-title").hide()},mobileFnAll:function(){var t=!0;$(".btn_menu,.cover").on("touchmove",function(t){t.preventDefault()}),$(".btn_menu,.cover").on("touchstart",function(){$(".os-herder").css("transition","all 0.25s"),$(".cover").toggle(),t?($(".os-herder").css({transform:"translateX(0)"}),$(".continar,.os-headertop").css({transform:"translateX(3.2rem)"}),$(".weipxiu_nav").attr("href","javascript:void(0);")):($(".os-herder").css({transform:"translateX(-3.21rem)"}),$(".continar,.os-headertop").css({transform:"translateX(0)"}),setTimeout(function(){$(".weipxiu_nav").attr("href","/")},800));t=!t,$(".site-search").is(":visible")&&($(".os-headertop .site-search").slideToggle(100),$(".xis").find("i").toggleClass("icon-sousuo icon-guanbi3"))}),$(".os-herder,.site-search").on("touchmove",function(t){t.preventDefault()}),document.addEventListener("touchstart",function(t){1<t.touches.length&&t.preventDefault()});var i=0;document.addEventListener("touchend",function(t){var e=(new Date).getTime();e-i<=300&&t.preventDefault(),i=e},!1),$(".xis").on("touchstart",function(){$(".os-headertop .site-search").slideToggle(100),$(this).find("i").toggleClass("fa-search fa-remove")}),$(".os-herder").on("touchstart","ul.slide-left li:has(.slide_slect) > a",function(t){$(this).parent().siblings("li").find(".slide_slect").slideUp(),$(this).parent().siblings("li").find(".iconfont_click").removeClass("icon-shangjiantou").addClass("icon-xiajiantou"),$(this).siblings(".slide_slect").stop().slideToggle(),$(this).parent().find(".iconfont_click").toggleClass("icon-xiajiantou icon-shangjiantou"),t.stopPropagation()})},pcFnAll:function(){$(".login_alert_close").click(function(){$(".login_alert").slideUp()});$(".nav ul.music-nav li .sub-menu").each(function(t){$(this).find("li").each(function(t){$(this).css("transition-delay",50*t+"ms")})}),$(".nav ul.music-nav li").hover(function(){var e=$(this);$(this).find(".sub-menu li").each(function(t){$(this).css("transition-delay",50*e.find(".sub-menu li").length-50*t+"ms")})},function(){$(this).find(".sub-menu li").each(function(t){$(this).css("transition-delay",50*t+"ms")})}),0<$(".continar-left .article_not").length&&$("body > .continar").css({height:"calc(100% - 280px)"}),document.oncontextmenu=function(t){return layer.msg("别看啦，宝宝好羞涩*^_^*"),!1}}},$(function(){(new t).init()})}(),$(function(){var i=window.location.protocol+"//"+window.location.host+"/",d="ajax_centent",e="searchform",n=new String("/page/").split(", "),s="error",f=!1,h=!1,m=!1,r=!1,o=null;jQuery.browser;function p(t){jQuery(t+"a").click(function(t){if(0<=this.href.indexOf(i)&&1==c(this.href)){t.preventDefault(),this.blur();this.title||this.name,this.rel;try{e=this,jQuery("ul.nav li").each(function(){jQuery(this).removeClass("current-menu-item")}),jQuery(e).parents("li").addClass("current-menu-item")}catch(t){}a(this.href)}var e}),jQuery("."+e).each(function(t){jQuery(this).attr("action")&&(o=jQuery(this).attr("action"),jQuery(this).submit(function(){var t;return t=jQuery(this).serialize(),m||a(o,0,t),!1}))}),jQuery("."+e).attr("action")}function a(t,e,l){if(!m){r=m=!0;var i=t.replace("http://","").replace("https://",""),n=i.indexOf("/"),o=t.indexOf(i),u=t.substring(o+n);if(1!=e&&"function"==typeof window.history.pushState){var a={foo:1e3+1001*Math.random()};history.pushState(a,"ajax page loaded...",u)}jQuery("#"+d),jQuery("#loading").show(),jQuery("#"+d).fadeTo("slow",1,function(){jQuery("#"+d).fadeIn("slow",function(){jQuery.ajax({type:"GET",url:t,data:l,cache:!1,dataType:"html",success:function(t){m=!1;var e=t.split("<title>"),i=t.split("</title>");if(jQuery("#loading").hide(),jQuery(".continar").css({scrollTop:0}),jQuery("html,body,.continar").animate({scrollTop:0},600),2==e.length||2==i.length){var n=(t=t.split("<title>")[1]).split("</title>")[0];jQuery(document).attr("title",jQuery("<div/>").html(n).text())}1==h&&"undefined"!=typeof _gaq&&(l=void 0===l?"":"?"+l,_gaq.push(["_trackPageview",u+l])),t=(t=t.split('id="'+d+'"')[1]).substring(t.indexOf(">")+1);for(var o=1,a="";0<o;){for(var s=t.split("</div>")[0],r=0,c=s.indexOf("<div");-1!=c;)r++,c=s.indexOf("<div",c+1);o=o+r-1,a=a+t.split("</div>")[0]+"</div>",t=t.substring(t.indexOf("</div>")+6)}document.getElementById(d).innerHTML=a,jQuery("#"+d).css("position","absolute"),jQuery("#"+d).css("left","20000px"),jQuery("#"+d).show(),p("#"+d+" "),1==f&&jQuery(document).trigger("ready"),jQuery("#"+d).hide(),jQuery("#"+d).css("position",""),jQuery("#"+d).css("left",""),jQuery("#"+d).fadeTo("slow",1,function(){})},error:function(t,e,i){m=!1,document.title="Error loading requested page!",document.getElementById(d).innerHTML=s}})})})}}function c(t){for(var e in n)return 0<=t.indexOf(n[e])}jQuery(document).ready(function(){p("")}),window.onpopstate=function(t){!0===r&&1==c(document.location.toString())&&a(document.location.toString(),1)}});
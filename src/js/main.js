/**
 * @license
 * 全局js
 */
$(function () {
    var domain_name = window.location.protocol + "//" + window.location.host;
    function speak(text) {
        new Audio(
            'https://tts.baidu.com/text2audio?cuid=baiduid&lan=zh&ctp=1&pdt=311&tex=' + text
        ).play();
    }

    //特色图片懒加载
    $("img.Lazy_load").lazyload({
        effect: "show"
    });

    //文章分类没有资源时候404提示
    if ($(".continar-left .article_not").length > 0) {
        $("body").css({ "background": "#fff" });
    }

    // 通过js改造导航栏DOM结构start
    var node_list = $(".header .music-nav").children('li');
    for (var i = 0; i < node_list.length; i++) {
        var text = node_list.eq(i).children('a').text();
        node_list.eq(i).children('a').text('');
        node_list.eq(i).children('a').append("<span>" + text + "</span>");
        node_list.eq(i).children('a').append("<span>" + text + "</span>");

        //高亮
        if (node_list.eq(i).hasClass('current-menu-item')) {
            node_list.eq(i).addClass('action');
        }
    }
    //追加音乐标签
    node_list.append("<audio src='' autoplay='autoplay'></audio>" + "<p style='opacity: 0'></p>");
    //二级菜单父级禁止跳转
    $("#nav_list .sub-menu").siblings('a').attr('href', 'javascript:void(0);');
    //追加icon
    $("#nav_list .sub-menu").siblings('a').find('span').append("<i class='iconfont icon-jiantou'></i>");
    $(".os-herder .sub-menu").siblings('a').append("<i class='iconfont iconfont_click icon-xiajiantou'></i>");
    //追加二级菜单父级class
    $(".header .sub-menu").addClass('nav-min');
    $(".os-herder .sub-menu").addClass('slide_slect');
    //追加音乐开关
    var dom_node = "<li class='js_piano_nav_icon mod-header_music-icon'>" + "<audio src='' autoplay='autoplay'></audio>" + "<i></i><i></i><i></i><i></i><i></i></li>"
    $(".header .music-nav").append(dom_node);
    //通过js改造导航栏DOM结构end

    // 文章详情页底部评论区域样式兼容
    setTimeout(function () {
        if ($("#reply-title a").is(":hidden")) {
            $("#reply-title").hide();
        }
    })

    //网站运行时间start
    function secondToDate(second) {
        if (!second) {
            return 0;
        }
        var time = new Array(0, 0, 0, 0, 0);
        if (second >= 365 * 24 * 3600) {
            time[0] = parseInt(second / (365 * 24 * 3600));
            second %= 365 * 24 * 3600;
        }
        if (second >= 24 * 3600) {
            time[1] = parseInt(second / (24 * 3600));
            second %= 24 * 3600;
        }
        if (second >= 3600) {
            time[2] = parseInt(second / 3600);
            second %= 3600;
        }
        if (second >= 60) {
            time[3] = parseInt(second / 60);
            second %= 60;
        }
        if (second > 0) {
            time[4] = second;
        }
        return time;
    }

    function setTime() {
        // 博客创建时间秒数，时间格式中，月比较特殊，是从0开始的，所以想要显示5月，得写4才行，如下
        var create_time = Math.round(new Date(Date.UTC(2016, 10, 16, 0, 0, 0))
            .getTime() / 1000);
        // 当前时间秒数,增加时区的差异
        var timestamp = Math.round((new Date().getTime() + 8 * 60 * 60 * 1000) / 1000);
        var currentTime = secondToDate((timestamp - create_time));
        var currentTimeHtml = currentTime[0] + '年' + currentTime[1] + '天' +
            currentTime[2] + '时' + currentTime[3] + '分' + currentTime[4] +
            '秒';
        $('#htmer_time').html(currentTimeHtml)
    }
    setInterval(setTime, 1000);
    // 网站运行时间end

    //点击图片放大全屏start
    var runPrefixMethod = function (element, method) {
        var usablePrefixMethod;
        ["webkit", "moz", "ms", "o", ""].forEach(function (prefix) {
            if (usablePrefixMethod) return;
            if (prefix === "") {
                // 无前缀，方法首字母小写
                method = method.slice(0, 1).toLowerCase() + method.slice(1);
            }

            var typePrefixMethod = typeof element[prefix + method];

            if (typePrefixMethod + "" !== "undefined") {
                if (typePrefixMethod === "function") {
                    usablePrefixMethod = element[prefix + method]();
                } else {
                    usablePrefixMethod = element[prefix + method];
                }
            }
        });

        return usablePrefixMethod;
    };
    if (typeof window.screenX === "number") {
        var eleFull = document.querySelectorAll(".log-text img");
        for (var i = 0; i < eleFull.length; i++)
            eleFull[i].addEventListener("click", function () {
                if (runPrefixMethod(document, "FullScreen") || runPrefixMethod(document, "IsFullScreen")) {
                    runPrefixMethod(document, "CancelFullScreen");
                    this.title = this.title.replace("退出", "");
                } else if (runPrefixMethod(this, "RequestFullScreen")) {
                    this.title = this.title.replace("点击", "点击退出");
                }
            });
    } else {
        layer.alert('亲，现在都什么时代了，你还在用这么土的浏览器~~', {
            skin: 'layui',
            title: "请更换浏览器",
            closeBtn: 0,
            anim: 4 //动画类型
        })
    }
    //点击图片放大全屏end

    // 文章详情页点赞
    setInterval(function () {
        $(".page-reward .page-reward-btn .tooltip-item font,.page-reward .page-reward-btn .tooltip-item a").toggleClass("s_show");
    }, 2000)
    //点赞
    $.fn.postLike = function () {
        if ($(this).hasClass('done')) {
            return false;
        } else {
            $(this).addClass('done');
            var id = $(this).data("id"),
                action = $(this).data('action'),
                rateHolder = $(this).children('.count');
            var ajax_data = {
                action: "bigfa_like",
                um_id: id,
                um_action: action
            };
            $.post("/wp-admin/admin-ajax.php", ajax_data,
                function (data) {
                    $(rateHolder).html(data);
                });
            return false;
        }
    };
    $(document).on("click", ".favorite",
        function () {
            $(this).postLike();
        });

    // 鼠标默认右键功能start
    var mBenu = document.getElementById('menu');
    document.oncontextmenu = function (ev) {
        layer.msg('别看啦，宝宝好羞涩*^_^*');
        return false
    }
    //鼠标默认右键功能end

    /*document.onkeydown = function(ev) {
        var ev = ev || event;
        if (ev.keyCode == 123) {
            return false
        }
        if (ev.ctrlKey == true && ev.keyCode == 83) {
            return false
        }
    }*/
    var searchShow = true;
    $(".navto-search a").click(function () {
        if (searchShow) {
            $('.header').css('z-index', '11');
            searchShow = false;
        } else {
            $('.header').css('z-index', '10');
            searchShow = true;
        }
        $(".site-search.active.pc").stop(true, true).slideToggle(150);
        $(".site-search.active.pc").find('input').focus();
        $(this).find("i").toggleClass("icon-guanbi3");
    });

    $(".header").addClass("Top");

    // 根据缓存状态初始化音乐
    if (localStorage.getItem("off_y") != 1) {
        $(".nav ul.music-nav li > p").css("opacity", "0");
        localStorage.setItem("off_y", 0);
    } else {
        $(".nav ul.music-nav li > p").css("opacity", "1");
        localStorage.setItem("off_y", 1);
        $(".mod-header_music-icon").addClass('hover');
    }

    // 跳动音符start
    $(".mod-header_music-icon").click(function () {
        //clearInterval(time); //清除鼠标离开li时候的定时器
        if (localStorage.getItem("off_y") != 1) {
            $(this).addClass("hover");
            $(".nav ul.music-nav li > p").css("opacity", "1");
            localStorage.setItem("off_y", 1);
            layer.msg('全站音频已开启~', {
                time: 2000 //2秒关闭（如果不配置，默认是3秒）
            }, function () {
                layer.msg('无需鼠标，导航音乐键盘A-K也可以体验哦~~');
            });
            speak("全站音频已开启~")
        } else {
            $(this).removeClass("hover");
            $(".nav ul.music-nav li > p").css("opacity", "0");
            localStorage.setItem("off_y", 0);
            layer.msg('全站音频已关闭，期待您的下次体验！', {
                time: 4000
            });
            speak("全站音频已关闭，期待您的下次体验！")
        }
    });
    // 跳动音符end

    //导航音乐title设置start
    $('.js_piano_nav_icon').mouseenter(function () {
        if (localStorage.getItem("off_y") != 1) {
            layer.tips('开启全站音频', '.js_piano_nav_icon', {
                tips: 3, //3表示下面
                tipsMore: false,
                time: 2000
            });
        } else {
            layer.tips('关闭全站音频', '.js_piano_nav_icon', {
                tips: 3,
                tipsMore: false,
                time: 2000
            });
        }
    })
    //导航音乐title设置end

    //PC二级菜单，钢琴导航start
    var time1 = null;
    var time2 = null;
    var $index = null;
    var musicObj = null;
    var musicList = $(".nav ul.music-nav > li:not(.mod-header_music-icon)");
    $('.header').hover(function () {
        $(this).css("z-index", "12");
    }, function () {
        //如果出现搜索的情况下，头部层级自然还是要比轮播高
        clearTimeout(time1);
        if (!time2 && !$(".site-search").is(":visible")) {
            time1 = setTimeout(() => {
                //避免在正常时候下方轮播分割旋转时候被遮盖 
                $(".header").css("z-index", "10");
            }, 500);
        }
    })
    musicList.mouseenter(function () {
        clearTimeout(time2);
        $(".header").css("z-index", "12");
        $(".header-conter .nav-min").hide();
        $(this).find('ul.nav-min').show()
        $index = $(this).index();
        musicObj = musicList.eq($index).find('audio');
        if (localStorage.getItem("off_y") == 1) {
            $(this).addClass("active").siblings('li').removeClass('active');
            musicObj.get(0).src = "/wp-content/themes/Art_Blog/music/nav_" + parseInt($index + 1) + ".mp3";
        } else {
            musicObj.get(0).src = "";
        }
    })
    musicList.mouseleave(function () {
        $(this).removeClass('active');
        clearTimeout(time2);
        time2 = setTimeout(() => {
            $(".header-conter .nav-min").hide();
            //避免在正常时候下方轮播分割旋转时候被遮盖 
            if (!$(".site-search").is(":visible")) {
                $(".header").css("z-index", "10");
            }
        }, 500);
    })

    function musicdown(number) {
        if (number <= musicList.length) {
            musicList.eq(number - 1).find('audio').get(0).src = "/wp-content/themes/Art_Blog/music/nav_" + (number) + ".mp3";
            musicList.eq(number - 1).addClass("active")
        }
    }

    // 键盘按下
    $(document).keydown(function (event) {
        if (localStorage.getItem("off_y") == 1) {
            //a65 s83 d68 f70 g71 h72 j74 k75 l76
            var keyArr = [65, 83, 68, 70, 71, 72, 74, 75, 76]
            var _index = keyArr.indexOf(event.keyCode)
            if (_index >= 0) {
                musicdown(_index + 1)
            }
        }
    });
    $(document).keyup(function () {
        setTimeout(function () {
            musicList.removeClass("active")
        }, 150);
    });
    //钢琴导航end

    // 飞机
    $(".aircraft").click(function () {
        $(this).animate({
            "bottom": "0",
            "opacity": "1"
        }, 100,
            function () {
                setTimeout(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 1200);
                    $(".aircraft").animate({
                        "top": "0",
                        "bottom": "auto",
                        "opacity": "0"
                    }, 700, function () {
                        setTimeout(function () {
                            $(".aircraft").css({
                                "bottom": "50px",
                                "top": "auto",
                                "opacity": "1"
                            })
                        }, 500)
                    })
                }, 300)
            })
    })

    //客服
    $("#wuyousujian-kefuDv").hover(function () {
        $("#wuyousujian-kefuDv").stop().animate({
            "right": "-100px"
        }, 500)
    },
        function () {
            $("#wuyousujian-kefuDv").stop().animate({
                "right": "-196px"
            }, 500)
        });

    //回到顶部
    var scrollTop = $(document).scrollTop();
    if (scrollTop > 500) {
        $(".aircraft").css({
            "display": "block",
            "opacity": "1"
        })
    }
    $(document).scroll(function () {
        scrollTop = $(document).scrollTop();
        if (scrollTop > 500) {
            $(".aircraft").css({
                "display": "block",
                "opacity": "1"
            })
        } else {
            $(".aircraft").css({
                "display": "none",
                "opacity": "0"
            })
        }
        if (scrollTop <= 0) {
            $(".header").addClass("Top")
            $(".header").removeClass("hover")
        } else {
            $(".header").removeClass("Top")
            $(".header").addClass("hover")
        }
        //var se = document.documentElement.clientHeight;
    });
    var obtn = true;
    $(".btn_menu,.cover").on("touchmove", function (event) {
        event.preventDefault();
    })
    $(".btn_menu,.cover").on("touchstart", myFunction);

    function myFunction() {
        $(".os-herder").get(0).classList.toggle("btn");
        $(".cover").toggle();
        if (obtn) {
            $(".continar,.os-headertop").css({
                "transform": "translateX(160px)"
            })
        } else {
            $(".continar,.os-headertop").css({
                "transform": "translateX(0)"
            })
        }
        if ($(".site-search").is(":visible")) {
            $(".os-headertop .site-search").slideToggle(100);
            $(".xis").find("i").toggleClass("fa-search");
            $(".xis").find("i").toggleClass("fa-remove")
        }
        obtn = !obtn
    }

    //移动端禁止侧边导航上下滚动start
    $(".os-herder,.site-search").on("touchmove", function (event) {
        event.preventDefault();
    });
    //移动端禁止侧边导航上下滚动end

    //子元素允许局部滚动
    $('.os-herder ul.slide-left li .slide_slect').on('touchmove', function (event) {
        return true;
    }, false);

    //禁止ios11自带浏览器缩放功能start
    document.addEventListener('touchstart', function (event) {
        if (event.touches.length > 1) {
            event.preventDefault();
        }
    })
    var lastTouchEnd = 0;
    document.addEventListener('touchend', function (event) {
        var now = (new Date()).getTime();
        if (now - lastTouchEnd <= 300) {
            event.preventDefault();
        }
        lastTouchEnd = now;
    }, false)
    //禁止ios11自带浏览器缩放功能end

    //移动端头部下拉搜索start
    $(".xis").on("touchstart", function () {
        $(".os-headertop .site-search").slideToggle(100);
        $(this).find("i").toggleClass("fa-search");
        $(this).find("i").toggleClass("fa-remove")
    });
    //移动端头部下拉搜索end

    if ($("html,body").width() < 960) {
        $(".nav-s1 > a").html("给我留言");
        $(".log-text").css("width", "100%")
    }
    //.mouseover ul li em序列号
    for (var i = 0; i <= $(".mouseover ul li").length; i++) {
        $(".mouseover ul li").eq(i).find("em").html(i + 1)
    }
    $(".text:lt(3) .new-icon").show();

    // 移动端二级菜单导航start
    $("ul.slide-left li a").on("touchstart", function (e) {
        $(this).parents('li').siblings('li').find('.slide_slect').slideUp();
        $(this).parents('li').siblings('li').find('.iconfont_click').removeClass('icon-shangjiantou').addClass('icon-xiajiantou');

        $(this).siblings(".slide_slect").stop().slideToggle();
        $(this).parent().find(".iconfont_click").toggleClass("icon-xiajiantou");
        $(this).parent().find(".iconfont_click").toggleClass("icon-shangjiantou");
    })
    // 移动端二级菜单导航end

    //留言板手风琴start
    $(".accordion .accordion_center ul li").hover(function () {
        $(this).stop().animate({
            "width": "340px"
        }).siblings("li").stop().animate({
            "width": "172px"
        });
        $(this).find(".slide-item").fadeOut();
        $(this).find(".mask").stop(true, true).fadeIn();
        $(".accordion_center ul li .slide-item .iconfont").css("animation", "arrow_move1 1s .5s infinite alternate");
        //上：暂停首页iconfont动画
        return false;
    }, function () {
        $(this).find(".slide-item").stop(true, false).fadeIn();
        $(this).find(".mask").stop(true, false).fadeOut(); //鼠标离开过后，动画暂停，且不需要完成
    });

    $(".accordion .accordion_center").mouseleave(function () {
        $(".accordion .accordion_center ul li").stop().animate({
            "width": "200px"
        });
        $(".accordion .accordion_center ul li").find(".slide-item").fadeIn();
        $(".accordion .accordion_center ul li").find(".mask").fadeOut();
        $(".accordion_center ul li .slide-item .iconfont").css("animation", "arrow_move 1s .5s infinite alternate");
        //上：开启首页iconfont动画，修复因为鼠标放上li上去导致动画停止后的bug
    });
    //留言板手风琴end

    if ($(document).width() >= 1200) {
        // 底部悬浮登录注册start
        // if (localStorage.getItem("off_login") != 1) {
        //     setTimeout(() => {
        //         $(".login_alert").slideDown();
        //     }, 1000)
        // }
        $(".login_alert_close").click(() => {
            $(".login_alert").slideUp();
            localStorage.setItem("off_login", 1)
        })
        // 底部悬浮登录注册end

        //文章分类没有资源时候404提示
        if ($(".continar-left .article_not").length > 0) {
            $("body > .continar").css({ "height": "calc(100% - 280px)" });
        }
        //点击页面出现爱心
        if (!!window.ActiveXObject || "ActiveXObject" in window) {
            console.log("天啦，偶买噶，您竟然还在用IE？")
        } else {
            ! function (e, t, a) {
                function r() {
                    for (var e = 0; e < s.length; e++) s[e].alpha <= 0 ? (t.body.removeChild(s[e].el), s.splice(e, 1)) : (s[e].y--,
                        s[e].scale += .004, s[e].alpha -= .013, s[e].el.style.cssText = "left:" + s[e].x + "px;top:" + s[e]
                            .y + "px;opacity:" + s[e].alpha + ";transform:scale(" + s[e].scale + "," + s[e].scale +
                        ") rotate(45deg);background:" + s[e].color + ";z-index:99999");
                    requestAnimationFrame(r)
                }

                function n() {
                    var t = "function" == typeof e.onclick && e.onclick;
                    e.onclick = function (e) {
                        t && t(), o(e)
                    }
                }

                function o(e) {
                    var a = t.createElement("div");
                    a.className = "heart", s.push({
                        el: a,
                        x: e.clientX - 5,
                        y: e.clientY - 5,
                        scale: 1,
                        alpha: 1,
                        color: c()
                    }), t.body.appendChild(a)
                }

                function i(e) {
                    var a = t.createElement("style");
                    a.type = "text/css";
                    try {
                        a.appendChild(t.createTextNode(e))
                    } catch (t) {
                        a.styleSheet.cssText = e
                    }
                    t.getElementsByTagName("head")[0].appendChild(a)
                }

                function c() {
                    return "rgb(" + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + ")"
                }

                var s = [];
                e.requestAnimationFrame = e.requestAnimationFrame || e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame ||
                    e.oRequestAnimationFrame || e.msRequestAnimationFrame || function (e) {
                        setTimeout(e, 1e3 / 60)
                    }, i(
                        ".heart{width: 10px;height: 10px;position: fixed;background: #f00;transform: rotate(45deg);-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);}.heart:after,.heart:before{content: '';width: inherit;height: inherit;background: inherit;border-radius: 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;position: fixed;}.heart:after{top: -5px;}.heart:before{left: -5px;}"
                    ), n(), r()
            }(window, document);
        }

        //文字琴弦效果
        (function ($) {
            // 换算字符串长度所占字符
            String.prototype.gblen = function () {
                var len = 0;
                for (var i = 0; i < this.length; i++) {
                    if (this.charCodeAt(i) > 127 || this.charCodeAt(i) == 94) {
                        len += 2;
                    } else {
                        len++;
                    }
                }
                return len;
            }
            // end
            $.extend($.easing, {
                easeOutElastic: function (x, t, b, c, d) {
                    var s = 1.70158;
                    var p = 0;
                    var a = c;
                    if (t == 0) return b;
                    if ((t /= d) == 1) return b + c;
                    if (!p) p = d * .3;
                    if (a < Math.abs(c)) {
                        a = c;
                        var s = p / 4;
                    } else var s = p / (2 * Math.PI) * Math.asin(c / a);
                    return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b;
                }
            });

            $.fn.qin = function (options) {
                var defaults = {
                    offset: 22, // 最大偏移量
                    duration: 500, // 晃动时间
                    recline: 0.1 // 每像素偏移量
                };

                var opt = $.extend({}, defaults, options);

                return this.each(function () {
                    var $ele = $(this);
                    fillSpan($ele);
                    stringAnimate($ele, opt);
                });
            };

            function fillSpan($ele) {
                //通过字符换算，尽可能让所有列长度一致
                var baseContent = ''; //初始化字符串 
                var strLengh = 0; //初始化截取位数
                if ($ele.text().trim().gblen() < 38) {
                    baseContent = $ele.text().trim();
                } else {
                    for (var k = 0; k < 38; k++) {
                        if (baseContent.gblen() < 38) {
                            baseContent = $ele.text().trim().slice(0, strLengh) + '...';
                            //console.log(baseContent,baseContent.gblen())
                        } else {
                            break;
                        }
                        strLengh++;
                    }
                }

                var content = '';
                for (var i = 0, len = baseContent.length; i < len; i++) {
                    content += '<span>' + baseContent.substr(i, 1) + '</span>'
                }
                $ele.html(content);
                var positionArr = []; //存放原始位置
                $ele.children('span').each(function () {
                    var $span = $(this);
                    var position = $span.position();
                    positionArr.push(position);
                    $span.css({
                        top: 0 + "px",
                        left: position.left + "px"
                    });
                    setTimeout(function () {
                        $span.css("position", "absolute");
                    }, 0);
                });
                $ele.data("stringPosition", positionArr);
            }

            function stringAnimate($ele, opt) {
                var positionArr = $ele.data("stringPosition"); // 原始位置 

                var startX = 0; // 初始x轴位置
                var startY = 0; // 初始y轴位置 

                $ele.mouseenter(function (ex) {

                    var offset = $ele.offset();

                    startX = ex.pageX - offset.left; // 鼠标在容器内 x 坐标
                    startY = ex.pageY - offset.top; // 鼠标在容器内 y 坐标
                });

                $ele.mousemove(function (ex) {
                    var offset = $ele.offset();

                    var xPos = ex.pageX - offset.left; // 鼠标在容器内 x 坐标
                    var yPos = ex.pageY - offset.top; // 鼠标在容器内 y 坐标

                    var offsetY = yPos - startY; // Y轴移动距离

                    if (Math.abs(offsetY) > opt.offset) { // 如果偏移超过最大值
                        return;
                    }

                    var ifDown = offsetY > 0; // 是否是向下移动

                    $ele.children("span").each(function (index) {
                        var $span = $(this); // 当前span
                        var position = positionArr[index]; // 当前原始position
                        var reclineNum = Math.abs(xPos - position.left) * opt.recline; // Y 轴移动距离，基于原始位置
                        reclineNum *= ifDown ? 1 : (-1); // 基于向下为正方向

                        var resultY = position.top + offsetY - reclineNum;

                        if (ifDown && resultY < position.top) {
                            resultY = position.top;
                        } else if (!ifDown && resultY > position.top) {
                            resultY = position.top;
                        }

                        $span.css({
                            top: resultY + "px"
                        });

                    });
                });
                $ele.mouseleave(function () {
                    $ele.children("span").each(function (index) {
                        $(this).stop(true, false).animate({
                            top: 0 + "px" //源代码：top: positionArr[index].top + "px"
                        }, {
                            duration: opt.duration,
                            easing: "easeOutElastic"
                        });
                    });
                });
            };

        })(jQuery);
        $(".mouseover ul li a").qin({
            offset: 20, // default , 最大偏移量
            duration: 500, // default , 晃动时间
            recline: 0.1 // default , 每像素偏移量，越小“琴弦绷的越紧”
        });
        //文字琴弦效果end
    } else {
        // 移动端固定导航fixed-bug
        setTimeout(function () {
            var objec = $('.footer').detach();
            $("body > .continar").append(objec);
            $(".footer").css({ "display": "block" });
        }, 500)

        //特色图片懒加载，移动端需要设置滚动事件
        $("img.Lazy_load").lazyload({
            container: $("body > .continar")
        });
    }

    // 当窗口改变时候start
    $(window).resize(function () {
        if ($(document).width() >= 1200) {
            // 当从移动端点开了侧边栏，然后改编窗口到pc端，关闭偏移
            $(".continar,.os-headertop").css({
                "transform": "translateX(0)"
            })
        }
    });
    // 当窗口改变时候end

    //友情链接随机数颜色start
    function randomColor(option) {
        for (var i = 0; i < option.length; i++) {
            option.eq(i).addClass('color-' + (parseInt(Math.random() * 8, 10) + 1))
        }
    }
    randomColor($('.friendship .daily-list ul li'))
    //友情链接随机数颜色end

    //视频播放start
    if ($("#my-video").length) {
        // var delSetInterval = null; //定时器
        var myPlayer = videojs('my-video');
        // videojs.addLanguage("zh-CN",{
        //     "Play": "播放",
        //     "Pause": "暂停",
        //     "Current Time": "当前时间",
        //     "Duration": "时长",
        //     "Remaining Time": "剩余时间",
        //     "Stream Type": "媒体流类型",
        //     "LIVE": "直播",
        //     "Loaded": "加载完毕",
        //     "Progress": "进度",
        //     "Fullscreen": "全屏",
        //     "Non-Fullscreen": "退出全屏",
        //     "Mute": "静音",
        //     "Unmute": "取消静音",
        //     "Playback Rate": "播放速度",
        //     "Subtitles": "字幕",
        //     "subtitles off": "关闭字幕",
        //     "Captions": "内嵌字幕",
        //     "captions off": "关闭内嵌字幕",
        //     "Chapters": "节目段落",
        //     "Close Modal Dialog": "关闭弹窗",
        //     "Descriptions": "描述",
        //     "descriptions off": "关闭描述",
        //     "Audio Track": "音轨",
        //     "You aborted the media playback": "视频播放被终止",
        //     "A network error caused the media download to fail part-way.": "网络错误导致视频下载中途失败。",
        //     "The media could not be loaded, either because the server or network failed or because the format is not supported.": "视频因格式不支持或者服务器或网络的问题无法加载。",
        //     "The media playback was aborted due to a corruption problem or because the media used features your browser did not support.": "由于视频文件损坏或是该视频使用了你的浏览器不支持的功能，播放终止。",
        //     "No compatible source was found for this media.": "无法找到此视频兼容的源。",
        //     "The media is encrypted and we do not have the keys to decrypt it.": "视频已加密，无法解密。",
        //     "Play Video": "播放视频",
        //     "Close": "关闭",
        //     "Modal Window": "弹窗",
        //     "This is a modal window": "这是一个弹窗",
        //     "This modal can be closed by pressing the Escape key or activating the close button.": "可以按ESC按键或启用关闭按钮来关闭此弹窗。",
        //     ", opens captions settings dialog": ", 开启标题设置弹窗",
        //     ", opens subtitles settings dialog": ", 开启字幕设置弹窗",
        //     ", opens descriptions settings dialog": ", 开启描述设置弹窗",
        //     ", selected": ", 选择",
        //     "captions settings": "字幕设定",
        //     "Audio Player": "音频播放器",
        //     "Video Player": "视频播放器",
        //     "Replay": "重播",
        //     "Progress Bar": "进度小节",
        //     "Volume Level": "音量",
        //     "subtitles settings": "字幕设定",
        //     "descriptions settings": "描述设定",
        //     "Text": "文字",
        //     "White": "白",
        //     "Black": "黑",
        //     "Red": "红",
        //     "Green": "绿",
        //     "Blue": "蓝",
        //     "Yellow": "黄",
        //     "Magenta": "紫红",
        //     "Cyan": "青",
        //     "Background": "背景",
        //     "Window": "视窗",
        //     "Transparent": "透明",
        //     "Semi-Transparent": "半透明",
        //     "Opaque": "不透明",
        //     "Font Size": "字体尺寸",
        //     "Text Edge Style": "字体边缘样式",
        //     "None": "无",
        //     "Raised": "浮雕",
        //     "Depressed": "压低",
        //     "Uniform": "均匀",
        //     "Dropshadow": "下阴影",
        //     "Font Family": "字体库",
        //     "Proportional Sans-Serif": "比例无细体",
        //     "Monospace Sans-Serif": "单间隔无细体",
        //     "Proportional Serif": "比例细体",
        //     "Monospace Serif": "单间隔细体",
        //     "Casual": "舒适",
        //     "Script": "手写体",
        //     "Small Caps": "小型大写字体",
        //     "Reset": "重启",
        //     "restore all settings to the default values": "恢复全部设定至预设值",
        //     "Done": "完成",
        //     "Caption Settings Dialog": "字幕设定视窗",
        //     "Beginning of dialog window. Escape will cancel and close the window.": "开始对话视窗。离开会取消及关闭视窗",
        //     "End of dialog window.": "结束对话视窗"
        //   });          

        //播放失败时候处理
        var errVideo = document.getElementById('my-video_html5_api');
        errVideo.onerror = function () {
            layer.alert('通常是由于视频地址错误引起，请检查！', {
                skin: 'layui',
                title: "播放失败",
                closeBtn: 0,
                anim: 4 //动画类型
            })
        };

        // //var howMuchIsDownloaded = 0; //初始化缓冲百分比
        // var eleFull = document.querySelector("#my-video"); //视频对象

        // //视频全屏方法
        // var fullScreen = function (element, method) {
        //     var usablePrefixMethod;
        //     ["webkit", "moz", "ms", "o", ""].forEach(function (prefix) {
        //         if (usablePrefixMethod) return;
        //         if (prefix === "") {
        //             // 无前缀，方法首字母小写
        //             method = method.slice(0, 1).toLowerCase() + method.slice(1);

        //         }
        //         var typePrefixMethod = typeof element[prefix + method];
        //         if (typePrefixMethod + "" !== "undefined") {
        //             if (typePrefixMethod === "function") {
        //                 usablePrefixMethod = element[prefix + method]();
        //             } else {
        //                 usablePrefixMethod = element[prefix + method];
        //             }
        //         }
        //     });
        //     return usablePrefixMethod;
        // };
        // if (typeof window.screenX === "number") {
        //     eleFull.addEventListener("dblclick", function () {
        //         if (fullScreen(document, "FullScreen") || fullScreen(document, "IsFullScreen")) {
        //             fullScreen(document, "CancelFullScreen");
        //             this.title = this.title.replace("退出", "");
        //         } else if (fullScreen(this, "RequestFullScreen")) {
        //             this.title = this.title.replace("点击", "点击退出");
        //         }
        //     });
        // } else {
        //     alert("爷，现在是年轻人的时代，您就暂且休息去吧~~");
        // }

        //初始化加载需要先缓冲到50%+才会播放，避免高清视频卡顿
        /*delSetInterval = setInterval( function() {
            howMuchIsDownloaded = myPlayer.bufferedPercent() //返回当前百分比缓冲0-1
            console.log('当前视频缓冲至：',howMuchIsDownloaded*100 + '%')
            if ( howMuchIsDownloaded > 0.5 ) {
                clearInterval( delSetInterval )
                myPlayer.play();
            }
        }, 1500 )
        */
        //当视频播放完成后，重新加载渲染，随时准备第二次重播
        myPlayer.on("ended", function () {
            myPlayer.play();
            setTimeout(function () {
                myPlayer.pause();
            }, 500);
        });
    }
    //视频播放end
})
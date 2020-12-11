/**
 * @license
 * 全局js
 */
!(function () {
    function App() { }
    App.prototype = {
        init: function () {
            // 终端独立事件方法
            if ($(window).width() < 1200) {
                // 移动端执行函数
                this.mobileFnAll();
            } else {
                // pc端执行函数
                this.pcFnAll();
                // 文章详情页打赏
                this.articleReward();
                // 随机文章列表钢琴效果
                this.stringEffect();
            }
            // 网页顶部加载进度条
            this.loadBar();
            // 信息流图片懒加载
            this.informationLazy_load();
            //头部3D导航DOM改造
            this.navReform();
            // 3D导航跳动音符
            this.navPianoEffect();
            //文章分类没有资源时候404提示
            this.isNotResources();
            //网站运行时间
            this.websiteRunningTime();
            //点击图片放大查看
            this.imagesEnlarge();
            // 文章详情页点赞
            this.pageDetailsFabulous();
            //纸飞机
            this.paperPlane();
            // 侧边栏视频播放器
            this.playVideo();
            // 在线客服
            this.customerService();
            // 友情链接加背景颜色
            this.friendshipLink();
            // 表情包
            this.smiliesEmoticon();
            // 随机文章增加序列号
            this.randomArticles();
            // 文章详情页底部评论区域样式兼容
            this.commentStyle();
        },
        // 网页顶部加载进度条
        loadBar: function () {
            window.onload = function () {
                $("header .speed_bar").css({ 'animation': 'speed_bar_animation_complete .5s ease-out', 'animation-fill-mode': 'forwards' })
            }
        },
        // dom是否在可视区内
        elementInView: function (element) {
            const rect = element.getBoundingClientRect()
            const y = rect.top < window.innerHeight && rect.bottom > 0
            const x = rect.left < window.innerWidth && rect.right > 0
            return y && x
        },
        // 信息流图片懒加载
        informationLazy_load: function () {
            var that = this;
            function lazy_load(){
                var imgList = document.querySelectorAll(".continar-left .text img");
                for (var i = 0; i < imgList.length; i++) {
                    if (that.elementInView(imgList[i]) && imgList[i].getAttribute('data-original')) {
                        imgList[i].setAttribute('src', imgList[i].getAttribute('data-original'));
                        imgList[i].removeAttribute('data-original');
                    }
                }
            }
            lazy_load();
            $(document).scroll(function () {
                lazy_load();
            });
        },
        // 头部3D导航DOM改造
        navReform: function () {
            var node_list = $(".header .music-nav").children('li');
            for (var i = 0; i < node_list.length; i++) {
                var text = node_list.eq(i).children('a').html();
                node_list.eq(i).children('a').text('');
                node_list.eq(i).children('a').append("<span>" + text + "</span>");
                node_list.eq(i).children('a').append("<span>" + text + "</span>");

                //高亮
                if (node_list.eq(i).hasClass('current-menu-item')) {
                    node_list.eq(i).addClass('action');
                }
            }
            //追加音乐标签
            node_list.append("<audio src='' autoplay='autoplay'></audio>" + "<p></p>");
            //二级菜单父级禁止跳转
            $("#nav_list .sub-menu").siblings('a').attr('href', 'javascript:void(0);');
            //追加icon
            $("#nav_list .sub-menu").siblings('a').find('span').append("<i class='iconfont icon-jiantou'></i>");
            $(".os-herder .sub-menu").siblings('a').append("<i class='iconfont iconfont_click icon-xiajiantou'></i>");
            //追加二级菜单父级class
            $(".header .sub-menu").addClass('nav-min');
            $(".os-herder .sub-menu").addClass('slide_slect');
            //追加音乐开关
            var dom_node = "<li id='backstage' style='display:none'><a href='/wp-admin/' target='_blank'><span>后台管理</span><span>后台管理</span></a><p></p>" + "<audio src='' autoplay='autoplay'></audio>" + "</li>" + "<li class='js_piano_nav_icon mod-header_music-icon'>" + "<audio src='' autoplay='autoplay'></audio>" + "<i></i><i></i><i></i><i></i><i></i></li>"
            $(".header .music-nav").append(dom_node);
        },
        // 3D导航跳动音符
        navPianoEffect: function () {
            //PC二级菜单，钢琴导航start
            var that = this;
            var time2 = null;
            var $index = null;
            var musicObj = null;
            var musicList = $(".nav ul.music-nav > li:not(.mod-header_music-icon)");
            $('.header').hover(function () {
                $(this).css("z-index", "12");
            }, function () {
                //如果出现搜索的情况下，头部层级自然还是要比轮播高
                if (!time2 && !$(".site-search").is(":visible")) {
                    //避免在正常时候下方轮播分割旋转时候被遮盖 
                    $(".header").css("z-index", "10");
                } else {
                    $(".header").css("z-index", "12");
                }
            })

            var queue = [];
            musicList.mouseenter(function () {
                clearTimeout(time2)
                $(this).addClass('active');
                queue.push($(this).index())
                $(".header").css("z-index", "12");
                $index = $(this).index();
                musicObj = musicList.eq($index).find('audio');
                if (localStorage.getItem("off_y") == 1) {
                    $(this).addClass("active");
                    musicObj.get(0).src = "/wp-content/themes/Art_Blog/music/nav_" + parseInt($index + 1) + ".mp3";

                } else {
                    musicObj.get(0).src = "";
                }
            })
            musicList.mouseleave(function () {
                if (queue.length > 0) {
                    setTimeout(() => {
                        musicList.eq(queue[0]).removeClass('active');
                        queue.shift();
                    }, 250)
                }
                //避免在正常时候下方轮播分割旋转时候被遮盖 
                time2 = setTimeout(() => {
                    if (!$(".site-search").is(":visible")) {
                        $(".header").css("z-index", "10");
                    }
                }, 1000)
            })

            function musicdown(number) {
                if (number <= musicList.length) {
                    musicList.eq(number - 1).find('audio').get(0).src = "/wp-content/themes/Art_Blog/music/nav_" + (number) + ".mp3";
                    musicList.eq(number - 1).addClass("active")
                    musicList.eq(number - 1).addClass("keyboard_color");
                }
            }

            // 键盘按下
            $(document).keydown(function (event) {
                if (localStorage.getItem("off_y") != 1) return;
                //a65 s83 d68 f70 g71 h72 j74 k75 l76
                var keyArr = [65, 83, 68, 70, 71, 72, 74, 75, 76]
                var _index = keyArr.indexOf(event.keyCode)
                if (_index >= 0) {
                    musicdown(_index + 1)
                }
            });
            $(document).keyup(function () {
                setTimeout(function () {
                    musicList.removeClass("active")
                    musicList.removeClass("keyboard_color")
                }, 150);
            });
            //钢琴导航end

            // 跳动音符start
            $(".mod-header_music-icon").click(function () {
                //clearInterval(time); //清除鼠标离开li时候的定时器
                if (localStorage.getItem("off_y") != 1) {
                    $(this).addClass("hover");
                    $(".nav ul.music-nav > li").addClass("on");
                    $(".nav ul.music-nav > li").removeClass("off");
                    localStorage.setItem("off_y", 1);
                    layer.msg("菜单音乐已开启~", {
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                        layer.msg("无需鼠标，导航音乐键盘A-K也可以体验哦~~");
                    });
                } else {
                    $(this).removeClass("hover");
                    $('.nav ul.music-nav li').addClass('off');
                    $('.nav ul.music-nav li').removeClass('on');
                    localStorage.setItem("off_y", 0);
                    layer.msg('菜单音乐已关闭，期待您的下次体验！', {
                        time: 4000
                    });
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
                } else {
                    $('.header').css('z-index', '10');
                }
                searchShow = !searchShow
                $(".site-search.active.pc").toggle();
                $(".site-search.active.pc").find('input').focus();
            });
            $(".xis,.navto-search a").click(function () {
                $(this).find("i").toggleClass("icon-sousuo icon-guanbi3");
            })

            $(".header").addClass("Top");

            // 根据缓存状态初始化音乐
            if (localStorage.getItem("off_y") != 1) {
                localStorage.setItem("off_y", 0);
            } else {
                localStorage.setItem("off_y", 1);
                $(".nav ul.music-nav > li").addClass("on");
                $(".mod-header_music-icon").addClass('hover');
            }
        },
        //文章分类没有资源时候404提示
        isNotResources: function () {
            if ($(".continar-left .article_not").length > 0) {
                $("body").css({ "background": "#fff" });
            }
        },
        //网站运行时间
        websiteRunningTime: function () {
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
        },
        //点击图片放大查看
        imagesEnlarge: function () {
            var runPrefixMethod = function (element, method) {
                var usablePrefixMethod;
                ["webkit", "moz", "ms", "o", ""].forEach(function (prefix) {
                    if (usablePrefixMethod) return;
                    if (prefix === "") {
                        // 无前缀，方法首字母小写
                        method = method.slice(0, 1).toLowerCase() + method.slice(1);
                    }

                    var typePrefixMethod = typeof element[prefix + method];
                    if (typePrefixMethod + "" == "undefined") return;
                    if (typePrefixMethod === "function") {
                        usablePrefixMethod = element[prefix + method]();
                    } else {
                        usablePrefixMethod = element[prefix + method];
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
                layer.alert('亲，这都什么年代了，您还在用这么土的浏览器吗~~', {
                    skin: 'layui',
                    title: "请更换浏览器",
                    closeBtn: 0,
                    anim: 4 //动画类型
                })
            }
        },
        // 文章详情页点赞
        pageDetailsFabulous: function () {
            setTimeout(function () {
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
        },
        //纸飞机
        paperPlane: function () {
            var that = this;
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

            //回到顶部
            var scrollTop = $(document).scrollTop();
            if (scrollTop > 500) {
                $(".aircraft").css({
                    "display": "block",
                    "opacity": "1"
                })
            }

            // 滚动页面设置
            var offset_left = null;
            function scroll_height() {
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
                // 右侧区域跟随
                var roll_obj = $('.continar-right');
                if ($(window).width() > 1200 && roll_obj.length) {
                    offset_left = $('.continar-left').offset().left + $('.continar-left').outerWidth() + 10;
                    if (
                        (that.elementInView($(".continar-right > div:last-of-type")[0]) || (scrollTop > roll_obj.outerHeight()))
                        && !(that.elementInView($(".footer")[0]))
                    ) {
                        if (scrollTop > roll_obj.outerHeight() - $(window).height() + $(".continar-right > div:last-of-type").outerHeight() - 100 && ($('.continar-left').outerHeight() >= roll_obj.outerHeight())) {
                            roll_obj.css({ "position": "fixed", "bottom": "0", "left": offset_left + "px" });
                        } else {
                            roll_obj.css({ "position": "static", "bottom": "auto", "left": "auto" });
                        }
                    } else if (that.elementInView($(".footer")[0]) && ($('.continar-left').outerHeight() >= roll_obj.outerHeight())) {
                        // 当出现底部时候，始终和左侧水平对齐
                        var position_bot = $(window).height() - ($(".continar-left").outerHeight() + ($(".continar-left").offset().top - $(document).scrollTop())); // 拿到“.continar-left”相对于屏幕底部的距离
                        roll_obj.css({ "position": "fixed", "bottom": position_bot + "px", "left": offset_left + "px" });
                    }
                }
            }
            scroll_height()
            $(document).scroll(function () {
                scroll_height();
            });
            window.onresize = function () {
                scroll_height();
            }
        },
        // 在线客服
        customerService: function () {
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
        },
        // 文章详情页打赏
        articleReward: function () {
            //文章内页打赏
            $(".js_reward").click(function () {
                layer.open({
                    content: $("#reward-popup"),
                    type: 1,
                    title: false,
                    skin: 'layui-layer-demo', //样式类名
                    area: ['500px', '360px'], //宽高
                    shadeClose: true, // 点击遮罩层关闭弹窗
                    success: function (layero, index) {
                        layero[0].childNodes[1].childNodes[0].removeAttribute('href');
                        layero[0].childNodes[1].classList.add('cursorStyle');
                        layero[0].childNodes[1].childNodes[0].classList.remove('layui-layer-close2');
                        layero[0].childNodes[1].childNodes[0].classList.add('layui-layer-close1');
                    }
                });
            });
        },
        // 随机文章列表钢琴效果
        stringEffect: function () {
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
            $(".mouseover ul li a").qin({
                offset: 20, // default , 最大偏移量
                duration: 500, // default , 晃动时间
                recline: 0.1 // default , 每像素偏移量，越小“琴弦绷的越紧”
            });
        },
        // 友情链接加背景颜色
        friendshipLink: function () {
            function randomColor(option) {
                for (var i = 0; i < option.length; i++) {
                    option.eq(i).addClass('color-' + (parseInt(Math.random() * 8, 10) + 1))
                }
            }
            randomColor($('.friendship .daily-list ul li'))
        },
        // 表情包
        smiliesEmoticon: function () {
            $("#commentform .iconfont").click(function () {
                $('#smilies_modal').toggle()
                $("#smilies_modal img").each(function () {
                    $(this).attr('src', $(this).attr('data-src'))
                });
            })
        },
        // 播放视频
        playVideo: function () {
            if ($("#my-video").length) {
                var myPlayer = videojs('my-video');

                //播放失败时候处理
                var errVideo = document.getElementById('my-video_html5_api');
                errVideo.onerror = function () {
                    layer.alert('通常是由于视频地址错误或未添加视频封面图引起，请检查！', {
                        skin: 'layui',
                        title: "视频初始化失败",
                        closeBtn: 0,
                        anim: 4 //动画类型
                    })
                };

                //当视频播放完成后，重新加载渲染，随时准备第二次重播
                // myPlayer.on("ended", function () {
                //     myPlayer.play();
                //     setTimeout(function () {
                //         myPlayer.pause();
                //     }, 500);
                // });
            }
        },
        // 随机文章增加序列号
        randomArticles: function () {
            for (var i = 0; i <= $(".mouseover ul li").length; i++) {
                $(".mouseover ul li").eq(i).find("em").html(i + 1)
            }
        },
        // 文章详情页底部评论区域样式兼容
        commentStyle: function () {
            if ($("#cancel-comment-reply-link").css('display') != 'none') {
                $("#reply-title").show();
            } else {
                $("#reply-title").hide();
            }
        },
        // 移动端执行函数
        mobileFnAll: function () {
            var obtn = true;
            $(".btn_menu,.cover").on("touchmove", function (event) {
                event.preventDefault();
            })
            $(".btn_menu,.cover").on("touchstart", myFunction);

            function myFunction() {
                $(".os-herder").css("transition", "all 0.25s")
                $(".cover").toggle();
                if (obtn) {
                    $(".os-herder").css({
                        "transform": "translateX(0)"
                    })
                    $(".continar,.os-headertop").css({
                        "transform": "translateX(3.2rem)"
                    })
                    $(".weipxiu_nav").attr('href', 'javascript:void(0);')
                } else {
                    $(".os-herder").css({
                        "transform": "translateX(-3.21rem)"
                    })
                    $(".continar,.os-headertop").css({
                        "transform": "translateX(0)"
                    })
                    setTimeout(function () {
                        $(".weipxiu_nav").attr('href', '/')
                    }, 800)
                }
                obtn = !obtn
                if ($(".site-search").is(":visible")) {
                    $(".os-headertop .site-search").slideToggle(100);
                    $(".xis").find("i").toggleClass("icon-sousuo icon-guanbi3");
                }
            }

            //移动端禁止侧边导航上下滚动start
            $(".os-herder,.site-search").on("touchmove", function (event) {
                event.preventDefault();
            });
            //移动端禁止侧边导航上下滚动end

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
                $(this).find("i").toggleClass("fa-search fa-remove");
            });
            //移动端头部下拉搜索end

            // 移动端二级菜单导航start
            $(".os-herder").on("touchstart", 'ul.slide-left li:has(.slide_slect) > a', function (event) {
                $(this).parent().siblings('li').find('.slide_slect').slideUp();
                $(this).parent().siblings('li').find('.iconfont_click').removeClass('icon-shangjiantou').addClass('icon-xiajiantou');

                $(this).siblings(".slide_slect").stop().slideToggle();
                $(this).parent().find(".iconfont_click").toggleClass("icon-xiajiantou icon-shangjiantou");

                event.stopPropagation();
            })
            // 移动端二级菜单导航end
        },
        // PC端执行函数
        pcFnAll: function () {
            // 登录注册悬浮入口
            $(".login_alert_close").click(() => {
                $(".login_alert").slideUp();
            })
            // 底部悬浮登录注册end

            // 二级菜单下拉列表个数兼容无限
            var time = 50;
            $(".nav ul.music-nav li .sub-menu").each(function (i) {
                $(this).find('li').each(function (i) {
                    $(this).css("transition-delay", i * time + 'ms')
                })
            })

            $(".nav ul.music-nav li").hover(function () {
                var that = $(this);
                $(this).find('.sub-menu li').each(function (i) {
                    $(this).css("transition-delay", (that.find('.sub-menu li').length * time - i * time) + 'ms')
                })
            }, function () {
                $(this).find('.sub-menu li').each(function (i) {
                    $(this).css("transition-delay", i * time + 'ms')
                })
            })


            //文章分类没有资源时候404提示
            if ($(".continar-left .article_not").length > 0) {
                $("body > .continar").css({ "height": "calc(100% - 280px)" });
            }

            // 鼠标默认右键功能start
            document.oncontextmenu = function (ev) {
                layer.msg('别看啦，宝宝好羞涩*^_^*');
                return false
            }
            //鼠标默认右键功能end
        }
    };

    $(function () {
        var app = new App();
        app.init();
    });
})();

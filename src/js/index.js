/**
 * @license
 * 首页js
 */
$(function () {
    //var domain_name = window.location.origin;//https://www.weipxiu.com（不兼容IE10及以下）
    var domain_name = window.location.protocol + "//" + window.location.host;
    //网站预加载运动start
    if ($(document).width() >= 1200) {
        //IE浏览器屏蔽部分动效start
        $(".mod-index__feature .img_list_6pic a").removeClass("word_display");
        if (!!window.ActiveXObject || "ActiveXObject" in window) {
            console.log("当前浏览器IE内核，部分效果不可展现！")
        } else {
            //首页轮播下sd导航start
            $("body").on("mouseenter",".mod-index__feature .img_list_6pic a",function(){
                $(this).addClass("word_display")
            })
            $("body").on("mouseleave",".mod-index__feature .img_list_6pic a",function(){
                $(this).removeClass("word_display")
            })
            //首页轮播下sd导航end
        }
        //IE浏览器屏蔽部分动效end

        // 桌面提醒功能
        var set_desktop = function () {
            if (window.Notification) {
                // var button = document.getElementById('button'), text = document.getElementById('text');

                var popNotice = function () {
                    if (Notification.permission == "granted") {
                        var notification = new Notification("官方提示：", {
                            body: '欢迎点击加入"Vue.js3.0技术栈"互相学习、交流！',
                            icon: '/wp-content/themes/Art_Blog/images/tishi.png'
                        })

                        notification.onclick = function () {
                            window.open("https://jq.qq.com/?_wv=1027&k=4BemYKg")
                            notification.close();
                        }
                        layer.ready(function(){
                            if (localStorage.getItem("off_y") == 1) {
                                new Audio(
                                    'https://tts.baidu.com/text2audio?cuid=baiduid&lan=zh&ctp=1&pdt=311&tex=您有一条新的消息，请注意查收！'
                                ).play();
                            }
                        }) 
                    }
                }

                var desktop = function () {
                    if (Notification.permission == "granted") {
                        popNotice();
                    } else if (Notification.permission != "denied") {
                        Notification.requestPermission(function (permission) {
                            popNotice();
                        })
                    }
                }
                desktop();
            } // else {
            //     alert('浏览器不支持Notification');    
            // }
        }
        //set_desktop();
        if (domain_name.indexOf('weipxiu.com') != '-1') {
            setTimeout(function () {
                set_desktop();
            }, 3000);
        }
        // 桌面提醒功能

        // console.log---start
        if (window.console && window.console.log) {
            setTimeout(function () {
                console.log("\n %c 当前主题由唯品秀前端技术博客免费提供 %c  © Jun Li  https://www.weipxiu.com  \n",
                    "color:#FFFFFB;background:#1890ff;padding:5px 0;border-radius:.5rem 0 0 .5rem;",
                    "color:#FFFFFB;background:#080808;padding:5px 0;border-radius:0 .5rem .5rem 0;"
                );
            }, 1500);
        }
        // console.log---end

        $("#hide").show();
        $(".buffer").fadeOut();
        $(".buffer .bar").hide();

        //首页头部导航动画加载
        $(".header.Top").css("WebkitAnimation-duration", ".7s");
        $(".header.Top").css("MsAnimation-duration", ".7s");
        $(".header.Top").css("animation -duration", ".7s");

        //开场背景音乐
        //$("#music").get(0).play();
        setTimeout(function () {
            $("#vedio").animate({
                "bottom": "0"
            }, 1000);
            $(".hide").animate({
                "bottom": "193px"
            }, 1000);
        }, 3500);
    } else {
        //排除PC端执行下列代码
        //移动端只在首页展示sidebar.php模块
        $(".continar-right").show();

        //swiper核心三要素：依赖swiper.js、swiper.css，外面父亲盒子高度
        var swiper1 = new Swiper('.swiper-container1', {
            pagination: '.swiper-pagination', //是否出现小圆点
            //nextButton: '.swiper-button-next',//上一张
            //prevButton: '.swiper-button-prev',//下一张
            slidesPerView: 1, //每一屏幕排几张图片
            effect: 'slide', //轮播方式，左右切换
            paginationClickable: true, //小圆点是否可点击
            spaceBetween: 0, //图片间距
            autoplay: 4500, //自动轮播时间
            speed: 500, //切换一张所需要的时间
            // keyboardControl: true, //键盘左右按钮切换
            // mousewheelControl: false, //鼠标滚轮切换
            autoplayDisableOnInteraction: false, //表示用户操作swiper之后，是否禁止autoplay。默认为 true：停止。false是播放
            loop: true //循环
        });
        //navigator.vibrate([1000, 500, 1000]);
        //手机震动功能，里面是数组-震动时间，第二个为间隔时间
    }
    //网站预加载运动end

    //修改邮件订阅表单类型
    $(".wpm_form .wpm_email input").attr("type", "email")

    // 当窗口改变时候start
    $(window).resize(function () {
        if ($(document).width() >= 1200) {
            if (window.location.href == domain_name || window.location.href == domain_name + '/') {
                $("#js_banner").show();
                $("body > .continar").css("margin-top", "10px");
            }
        } else {

        }
    });
    // 当窗口改变时候end

})
<?php   
/*
Template Name: 时光机  
*/  
?>  
<!doctype html>
<html>
<head>
<title><?php wp_title( '-', true, 'right' ); ?>不忘初心方得始终&nbsp;|&nbsp;唯品秀前端技术博客</title>
<?php get_template_part('common'); ?><style>
a{color: #1890ff;text-decoration: none;}
:not(span){color: #666;}
html{height:auto;}
body{background-image:-webkit-linear-gradient(180deg, #FFFEF9, #EED6CC);background-image:linear-gradient(180deg,#FFFEF9,#EED6CC);}
a:hover{text-decoration: underline;}
#message{width:1200px;margin:80px auto 45px;overflow:hidden;padding:0 50px;}
#header{ height:48px;background:#fff; border-radius:5px; line-height:48px; font-size:16px; font-weight:bold; text-align:center; box-shadow:0 5px 7px rgba(0,0,0,0.2); color:#ed145b;}
#footer{ height:30px; border-radius:5px; line-height:30px; text-align:center; position:relative;z-index:10; margin-top:40px}
#footer a,#footer p{ display:inline-block;}
#footer a{ text-decoration:none;background:#d5ccc8;line-height:22px;padding:0 10px; color:#555; border-radius:2px;box-shadow:0 1px 3px rgba(0,0,0,0.5);margin:0 5px; opacity:0; transition:.5s;}
#footer a:active,#footer .active{box-shadow: 0 1px 3px rgba(0,0,0,0.5);color: #fff;}
#messageList{margin-left:100px;border-left:1px solid #fff;height:0; transition:1s;}
#messageList li{padding:5px 0; position:relative; min-height:100px; -webkit-perspective:800px; -webkit-perspective-origin:left 30px; }
#messageList .box{ -webkit-transform-origin:left 30px; -webkit-transform:rotateY(90deg);-webkit-transform-style:preserve-3d; transition:.6s cubic-bezier(0.280, 0.695, 0.580, 1.450);}
#messageList .pic{width:60px;height:60px;border:5px solid #fff;border-radius:50%; position:absolute;left:-100px;top:0;background:url(<?php echo get_option('weipxiu_options')['time_portrait'] ?>) center no-repeat; box-shadow:inset 0 2px 5px rgba(0,0,0,0.2),0 5px 7px rgba(0,0,0,0.2); background-size:60px 60px}
#messageList .ico{ width:12px;height:12px;background:#f7ebe6;border:3px solid #fff;border-radius:50%;box-shadow:inset 0 2px 5px rgba(0,0,0,0.2),0 5px 7px rgba(0,0,0,0.2); position:absolute;left:-6px;top:23px;}
#messageList .text{margin:0 30px;background:#f7ebe6;line-height:26px;padding:10px;  height:auto;text-indent:2em; border:0}
#messageList .text a{color: #1890ff;color: var(--color);}
#messageList .content{height: 38px;background: #fff; border-radius: 4px 4px 0 0;box-shadow: 0 6px 10px -6px rgba(0,0,0,0.1);
padding-top: 3px;color: #585858;line-height: 34px;font-size: 14px;text-align:center;text-indent: 0;}
#messageList .reply{ -webkit-transform-origin:center -5px; -webkit-transform:rotateX(-180deg);opacity:0;transition:.6s cubic-bezier(0.280, 0.695, 0.580, 1.450); border: 1px solid #fff;box-shadow: 0 3px 7px rgba(0,0,0,0.1);}
.text{opacity: 1}

@media screen and (min-width:768px) and (max-width:1199px) {
	#message{
		width: auto;
    margin: 0.9rem 0 0 0;
    overflow: hidden;
    padding: 0.3rem;
	}
	#messageList{
		margin-left:0
	}
	#messageList .pic{
		display:none
	}
	#messageList .text{
		margin: 0 0 0 0.3rem;
		line-height: 1.6;
		font-size: 0.28rem;
	}
	#messageList .content{
		line-height:0.5rem;
	}
	#footer a{
		padding: 0.05rem 0.1rem;
	}
}

@media screen and (max-width:767px) {
	#message{
		width: auto; 
    margin: 0.9rem 0 0 0;
    overflow: hidden;
    padding: 0.3rem;
	}
	#messageList{
		margin-left:0
	}
	#messageList .pic{
		display:none
	}
	#messageList .text{
		margin: 0 0 0 0.3rem;
	}
	#footer{
		margin-top:0.25rem;
	}
	.home_page,.last_page{
		display:none
	}
}
</style>
</head>
<body>
<!--头部文件引用start-->
	<?php get_header(); ?>
<!--头部文件引用end-->
<div id="message">
    <ul id="messageList">
    	<!--<li>
        	<div class="box">
            	<div class="pic"></div>
                <div class="ico"></div>
                <div class="content text">好好学习</div>
                <div class="reply text">好好学习，天天向上~~</div>
            </div>
        </li>-->
    </ul>
    <footer id="footer">
    	<!--<a href="javascript:;">首页</a><a href="javascript:;" >上一页</a><p><a href="javascript:;" class="active">1</a><a href="javascript:;">2</a><a href="javascript:;">3</a></p><a href="javascript:;">下一页</a><a href="javascript:;">尾页</a>-->
		</footer>
</div>
<!-- 底部引用区域start -->
<?php get_footer()?>
<!-- 底部引用区域end -->
<script>
var date = [{
		time:"抱歉",
		text:"该板块暂无数据哦~"
	}];
<?php
if (get_option('weipxiu_options')['time_machine']) {
?>
date = <?php echo get_option('weipxiu_options')['time_machine'] ?>;
<?php
}
?>
var iPage = 20;
var iNow = 0;
//IE浏览器兼容
if (!!window.ActiveXObject || "ActiveXObject" in window) {
    setInterval(function () {
        $('#messageList .reply').css('opacity', '1')
    }, 1000);
}
createFoot();

function createFoot() {
    var oFooter = document.getElementById("footer");
    var iLenght = Math.ceil(date.length / iPage);
    var sHtml = '<a class="home_page" href="javascript:;">首页</a><a href="javascript:;" >上一页</a><p>';
    for (var i = 0; i < iLenght; i++) {
        sHtml += '<a href="javascript:;">' + (i + 1) + '</a>';
    }
    sHtml += '</p><a class="last_page" href="javascript:;">下一页</a><a href="javascript:;">尾页</a>';
    oFooter.innerHTML = sHtml;
    var aA = oFooter.getElementsByTagName("a");
    var oP = oFooter.getElementsByTagName("p")[0];
    var aBtns = oP.getElementsByTagName("a");
    for (var i = 0; i < aBtns.length; i++) {
        (function (a) {
            aBtns[a].onclick = function () {
                footerHide(a);
            };
        })(i);
    }
    aA[0].onclick = function () {
        footerHide(0);
    };
    aA[1].onclick = function () {
        footerHide(iNow - 1);
    };
    aA[aA.length - 2].onclick = function () {
        footerHide(iNow + 1);
    };
    aA[aA.length - 1].onclick = function () {
        footerHide(aBtns.length - 1);
    };
    create(0);
}

function create(iNub) {
    var oList = document.getElementById("messageList");
    var sHtml = "";
    var iStart = iNub * iPage;
    var iEnd = iStart + iPage;
    iEnd = iEnd > date.length ? date.length : iEnd;
    for (var i = iStart; i < iEnd; i++) {
        sHtml += '<li><div class="box"><div class="pic"></div><div class="ico"></div><div class="content text">' + date[
            i].time + '</div><div class="reply text">' + date[i].text + '</div></div></li>';
    }
    oList.innerHTML = sHtml;
    footerShow(iNub);
}

function footerHide(iNub) {
    var oFooter = document.getElementById("footer");
    var aA = oFooter.getElementsByTagName("a");
    for (var i = 0; i < aA.length; i++) {
        aA[i].style.opacity = 0;
        aA[i].addEventListener("webkitTransitionEnd", function (ev) {
            ev.cancelBubble = true;
        }, false);
    }
    oFooter.style.transition = ".5s .5s";
    oFooter.addEventListener("webkitTransitionEnd", end, false);
    oFooter.style.marginTop = "50px";
    oFooter.style.opacity = 0;

    function end(e) {
        this.removeEventListener("webkitTransitionEnd", end, false);
        listHide(iNub);
    }
}

function listHide(iNub) {
    var oList = document.getElementById("messageList");
    var oFooter = document.getElementById("footer");
    var aLi = oList.children;
    for (var i = 0; i < aLi.length; i++) {
        aLi[i].style.transition = ".5s " + (aLi.length - 1) * 100 + "ms";
        aLi[i].style.opacity = 0;
        aLi[i].style.marginTop = "50px";
        aLi[i].addEventListener("webkitTransitionEnd", function (ev) {
            ev.cancelBubble = true;
        }, false);
    }
    oList.style.transition = "1s .5s";
    oList.style.height = "0px";
    oFooter.style.transition = ".5s 1.5s";
    oFooter.style.opacity = 1;
    oFooter.style.marginTop = "20px";
    oList.addEventListener("webkitTransitionEnd", end, false);

    function end() {
        this.removeEventListener("webkitTransitionEnd", end, false);
        create(iNub);
    };
}

function footerShow(iNub) {
    var oFooter = document.getElementById("footer");
    var aA = oFooter.getElementsByTagName("a");
    var oP = oFooter.getElementsByTagName("p")[0];
    var aBtns = oP.getElementsByTagName("a");
    aBtns[iNow].className = "";
    iNow = iNub;
    aBtns[iNow].className = "active";
    if (iNow == 0) {
        aA[0].style.display = "none";
        aA[1].style.display = "none";
    } else {
        aA[0].style.display = "inline-block";
        aA[1].style.display = "inline-block";
    }
    if (iNow == aBtns.length - 1) {
        aA[aA.length - 1].style.display = "none";
        aA[aA.length - 2].style.display = "none";
    } else {
        aA[aA.length - 1].style.display = "inline-block";
        aA[aA.length - 2].style.display = "inline-block";
    }
    for (var i = 0; i < aA.length; i++) {
        aA[i].style.opacity = 1;
    }
    showList();
}

function showList() {
    var oList = document.getElementById("messageList");
    var iHeight = 0;
    var aLi = oList.children;
    for (var i = 0; i < aLi.length; i++) {
        iHeight += aLi[i].offsetHeight;
        aLi[i].off = true;
    }
    oList.style.height = iHeight + "px";
    oList.addEventListener("webkitTransitionEnd", end, false);

    function end() {
        oList.removeEventListener("webkitTransitionEnd", end, false);
        showLi();
        window.onresize = window.onscroll = function () {
            showLi();
        };
    }
}

function showLi() {
    var oList = document.getElementById("messageList");
    var aLi = oList.children;
    var iTop = (document.body.scrollTop || document.documentElement.scrollTop) + document.documentElement.clientHeight + 350;
    var iTime = 0;
    for (var i = 0; i < aLi.length; i++) {
        if (getTop(aLi[i]) < iTop && aLi[i].off) {
            aLi[i].off = false;
            openLi(aLi[i], iTime);
            iTime += 100;
        }
    }
}

function openLi(obj, iTime) {
    var oBox = obj.children[0];
    var oReply = oBox.children[oBox.children.length - 1];
    oBox.addEventListener("webkitTransitionEnd", end, false);
    setTimeout(function () {
        oBox.style.WebkitTransform = "rotateY(0deg)";
    }, iTime);

    function end() {
        this.removeEventListener("webkitTransitionEnd", end, false);
        oReply.style.opacity = 1;
        oReply.style.WebkitTransform = "rotateX(0deg)";
    };
}

function getTop(obj) {
    var iTop = 0;
    while (obj) {
        iTop += obj.offsetTop;
        obj = obj.offsetParent;
    }
    return iTop;
}
</script>
</body>
</html>

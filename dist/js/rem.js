function defaultfont() {
  var sw = $(window).width();
  var pw = 750;
  var f = 100 * sw / pw;
  if (sw>767 && sw<1000) { f = 70 }
  if (sw>1000 && sw<1200) { f = 100 }
  $('html').css({
    'fontSize': f + 'px',
    'transtion': '0.35s'
  })
}
setTimeout(function () {
  defaultfont()
},
  100);
var w_height = $(window).width();
$(window).resize(function () {
  if ($(window).width() != w_height) {
    setTimeout(function () {
      defaultfont()
    },
      100)
  }
});

// 某宝rem适配文件flexible.js
/*(function flexible (window, document) {
    var docEl = document.documentElement;     //获取文档根节点并保存到变量docEl中(相当于获取到html对象)
    var dpr = window.devicePixelRatio || 1;   //获取像素比，如果window.devicePixelRatio为false是dpr为1，如果window.devicePixelRatio大于1，那么dpr赋值取大的数

    function setBodyFontSize () {
      if (document.body) { //获取到body对象是否存在，个人觉得啰嗦
        document.body.style.fontSize = (12 * dpr) + 'px';
      }
      else {
        document.addEventListener('DOMContentLoaded', setBodyFontSize);
      }
    }
    setBodyFontSize();

    // set 1rem = viewWidth / 10
    function setRemUnit () {
      var rem = docEl.clientWidth / 10
      docEl.style.fontSize = rem + 'px'
    }

    setRemUnit()

    // reset rem unit on page resize
    window.addEventListener('resize', setRemUnit)
    window.addEventListener('pageshow', function (e) {
      if (e.persisted) {
        setRemUnit()
      }
    })

    // detect 0.5px supports
    if (dpr >= 2) {
      var fakeBody = document.createElement('body')
      var testElement = document.createElement('div')
      testElement.style.border = '.5px solid transparent'
      fakeBody.appendChild(testElement)
      docEl.appendChild(fakeBody)
      if (testElement.offsetHeight === 1) {
        docEl.classList.add('hairlines')
      }
      docEl.removeChild(fakeBody)
    }
  }(window, document))*/
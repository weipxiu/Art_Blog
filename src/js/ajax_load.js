/* global $, jQuery */
$(function () {

  /*
   * 第一行 ajaxhome 填写网站的访问网址
   * 第二行 ajaxcontent 填写网站文章的容器id名称，即异步加载的部分
   * 第三行 ajaxsearch_class 填写网站搜索框的容器名称，一般都是id=“searchform”
   * 第四行 ajaxignore_string 是忽略使用ajax加载的链接，比如说feed源等等
   * 第六行 ajaxloading_code 加载时显示的内容，可以设定动画
   * 第七行 ajaxloading_error_code 加载失败时显示的内容，可以设定动画
   */
  var domain_name = `${window.location.protocol}//${window.location.host}`;
  var ajaxhome = `${domain_name}/`;
  var ajaxcontent = 'continar-left';
  var ajaxsearch_class = 'searchform';
  var ajaxignore_string = new String('/page/');
  var ajaxignore = ajaxignore_string.split(', ');
  // var ajaxloading_code = 'loading';
  var ajaxloading_error_code = 'error';

  var ajaxreloadDocumentReady = false;
  // var ajaxscroll_top = true;
  var ajaxisLoad = false;
  var ajaxstarted = false;
  var ajaxsearchPath = null;
  // var ajaxua = jQuery.browser;

  // 没有指定的dom时候不执行
  if (!jQuery(`#${ajaxcontent}`).length) {
    return;
  }

  jQuery(document).ready(function () {
    ajaxloadPageInit('');
  });

  window.onpopstate = function () {
    if (ajaxstarted === true && ajaxcheck_ignore(document.location.toString()) == true) {
      ajaxloadPage(document.location.toString(), 1);
    }
  };

  function ajaxloadPageInit(scope) {
    jQuery(`${scope}a`).click(function (event) {
      if (this.href.indexOf(ajaxhome) >= 0 && ajaxcheck_ignore(this.href) == true) {
        event.preventDefault();
        this.blur();

        /*
         * var caption = this.title || this.name || '';
         * var group = this.rel || false;
         */
        try {
          ajaxclick_code(this);
        } catch (err) {
        }
        ajaxloadPage(this.href);
      }
    });

    jQuery(`.${ajaxsearch_class}`).each(function () {
      if (jQuery(this).attr('action')) {
        ajaxsearchPath = jQuery(this).attr('action'); ;
        jQuery(this).submit(function () {
          submitSearch(jQuery(this).serialize());
          return false;
        });
      }
    });

    if (jQuery(`.${ajaxsearch_class}`).attr('action')) { } else {
    }
  }

  function ajaxloadPage(url, push, getData) {
    if (!ajaxisLoad) {

      /*
       * if (ajaxscroll_top == true) {
       *     jQuery('html,body').animate({ scrollTop: 0 }, 800);
       * }
       */
      ajaxisLoad = true;
      ajaxstarted = true;
      var nohttp = url.replace('http://', '').replace('https://', '');
      var firstsla = nohttp.indexOf('/');
      var pathpos = url.indexOf(nohttp);
      var path = url.substring(pathpos + firstsla);

      if (push != 1) {
        if (typeof window.history.pushState == 'function') {
          var stateObj = { foo: 1000 + Math.random() * 1001 };
          history.pushState(stateObj, 'ajax page loaded...', path);
        } else {
        }
      }

      // jQuery('#' + ajaxcontent).append(ajaxloading_code);
      jQuery('#loading').show();
      jQuery(`#${ajaxcontent}`).fadeTo('slow', 1, function () {
        jQuery(`#${ajaxcontent}`).fadeIn('slow', function () {
          jQuery.ajax({
            type: 'GET',
            url,
            data: getData,
            cache: false,
            dataType: 'html',
            success (data) {
              ajaxisLoad = false;
              var datax = data.split('<title>');
              var titlesx = data.split('</title>');
              jQuery('#loading').hide(); // 移除加载中动画
              jQuery('.continar').css({ scrollTop: 0 });
              jQuery('html,body,.continar').animate({ scrollTop: 0 }, 600);

              if (datax.length == 2 || titlesx.length == 2) {
                var data_title = data.split('<title>')[1];
                var titles = data_title.split('</title>')[0];
                jQuery(document).attr('title', jQuery('<div/>').html(titles)
                  .text());
              }
              data = data.split(`id="${ajaxcontent}"`)[1];
              data = data.substring(data.indexOf('>') + 1);
              var depth = 1;
              var output = '';

              while (depth > 0) {
                var temp = data.split('</div>')[0];
                var i = 0;
                var pos = temp.indexOf('<div');
                while (pos != -1) {
                  i++;
                  pos = temp.indexOf('<div', pos + 1);
                }
                depth = depth + i - 1;
                output = `${output + data.split('</div>')[0]}</div>`;
                data = data.substring(data.indexOf('</div>') + 6);
              }
              document.getElementById(ajaxcontent).innerHTML = output;
              jQuery(`#${ajaxcontent}`).css('position', 'absolute');
              jQuery(`#${ajaxcontent}`).css('left', '20000px');
              jQuery(`#${ajaxcontent}`).show();
              ajaxloadPageInit(`#${ajaxcontent} `);
              if (ajaxreloadDocumentReady == true) {
                jQuery(document).trigger('ready');
              }
              try {
                ajaxreload_code();
              } catch (err) {
              }
              jQuery(`#${ajaxcontent}`).hide();
              jQuery(`#${ajaxcontent}`).css('position', '');
              jQuery(`#${ajaxcontent}`).css('left', '');
              jQuery(`#${ajaxcontent}`).fadeTo('slow', 1, function () { });
            },
            error () {
              ajaxisLoad = false;
              document.title = 'Error loading requested page!';
              document.getElementById(ajaxcontent).innerHTML = ajaxloading_error_code;
            }
          });
        });
      });
    }
  }
  function submitSearch(param) {
    if (!ajaxisLoad) {
      ajaxloadPage(ajaxsearchPath, 0, param);
    }
  }
  function ajaxcheck_ignore(url) {
    for (var i in ajaxignore) {
      if (url.indexOf(ajaxignore[i]) >= 0) {
        return true;
      }
      return false;

    }
  }

  // 成功回调
  function ajaxreload_code() {
    jQuery('.mod-index__feature .img_list_6pic a').removeClass('word_display');
    jQuery('#continar-right').css({ 'position': 'static', 'bottom': 'auto', 'left': 'auto' });
  }

  function ajaxclick_code(thiss) {
    jQuery('ul.nav li').each(function () {
      jQuery(this).removeClass('current-menu-item');
    });
    jQuery(thiss).parents('li')
      .addClass('current-menu-item');
  }
});

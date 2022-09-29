/* global jQuery, tb_show, tb_remove */
jQuery(function () {
  var imgurl,
    targetfield;
  jQuery('input[type="button"]').click(function () {
    targetfield = jQuery(this).siblings('input');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;
  });

  window.send_to_editor = function (obj) {
    imgurl = jQuery('img', obj).attr('src') || jQuery(obj).attr('src');
    jQuery(targetfield).val(imgurl);
    jQuery(targetfield).parent()
      .parent()
      .siblings()
      .find('.preview-img')
      .attr('src', imgurl);
    tb_remove();
  };

  // 记录选中在哪个选项卡下的状态
  var $index = localStorage.getItem('active_index') ? Number(localStorage.getItem('active_index')) : 0;

  /*
   * var domain_name = window.location.protocol + "//" + window.location.host;
   * if (domain_name.indexOf('weipxiu.com') == '-1') {
   *   jQuery('.nav-wrap .nav-list:last').hide()
   * }
   */
  jQuery('.nav-wrap .nav-list').eq($index)
    .addClass('on')
    .siblings()
    .removeClass('on');
  jQuery('.content-wrap').eq($index)
    .show()
    .siblings('.content-wrap')
    .hide();

  // 导航切换
  jQuery('.nav-list').click(function () {
    localStorage.setItem('active_index', jQuery(this).index());
    jQuery(this).addClass('on')
      .siblings()
      .removeClass('on');
    jQuery('.content-wrap').eq(jQuery(this).index())
      .show()
      .siblings('.content-wrap')
      .hide();
    areHeightInt();
  });

  // 判断登录注册入口开关是否打开
  var arr = ['reg_flake', 'popular', 'video', 'snow-flake'];
  arr.forEach(function (item) {
    if (jQuery(`#${item}_on`).is(':checked')) {
      jQuery(`.${item}_show`).css('display', 'block');
    } else {
      jQuery(`.${item}_show`).css('display', 'none');
    };
    jQuery(`#${item}_on`).click(function () {
      jQuery(`.${item}_show`).slideDown();
    });
    jQuery(`#${item}_off`).click(function () {
      jQuery(`.${item}_show`).slideUp();
    });
  });

  // 换肤
  var colorPicker = document.getElementById('colorPicker');
  var replaceSkin = document.getElementById('replace-skin');
  colorPicker.addEventListener('input', watchColorPicker, false);

  function watchColorPicker(event) {
    document.querySelectorAll('p').forEach(function () {
      replaceSkin.value = event.target.value;
    });
  }

  // textarea内容自动撑开
  function areHeightInt() {
    var textareaArr = jQuery('.content-wrap textarea:visible');
    for (var i = 0; i < textareaArr.length; i++) {
      var actualHeight = jQuery(textareaArr[i])[0].scrollHeight;
      if (textareaArr.eq(i).height() < actualHeight) {
        textareaArr.eq(i).css('height', `${jQuery(textareaArr[i])[0].scrollHeight + 20}px`);
      }
    }
  }
  areHeightInt();
});


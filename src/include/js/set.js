jQuery(function() {
  var imgurl,
    targetfield;
  jQuery('input[type="button"]').click(function() {
    targetfield = jQuery(this).siblings('input');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;
  });

  window.send_to_editor = function(obj) {
    imgurl = jQuery('img', obj).attr('src') || jQuery(obj).attr('src');
    jQuery(targetfield).val(imgurl);
    jQuery(targetfield).parent().parent().siblings().find('.preview-img').attr('src', imgurl);
    tb_remove();
  }

  // 导航切换
  jQuery('.nav-list').click(function() {
    jQuery(this).addClass('on').siblings().removeClass('on');
    jQuery('.content-wrap').eq(jQuery(this).index()).show().siblings('.content-wrap').hide();
  });

  //判断侧边栏热门标签开关是否打开
  if(jQuery(".popular_on").is(':checked')){
    jQuery(".popular_show").css("display",'block');
  }else{
    jQuery(".popular_show").css("display",'none');
  };
  jQuery(".popular_on").click(function(){
    jQuery(".popular_show").slideDown();
  })
  jQuery(".popular_off").click(function(){
    jQuery(".popular_show").slideUp();
  })

  //判断侧边视频开关是否打开
  if(jQuery(".video_on").is(':checked')){
    jQuery(".row_content").css("display",'block');
  }else{
    jQuery(".row_content").css("display",'none');
  };
  jQuery(".video_on").click(function(){
    jQuery(".row_content").slideDown();
  })
  jQuery(".video_off").click(function(){
    jQuery(".row_content").slideUp();
  })
});

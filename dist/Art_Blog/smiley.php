<script type="text/javascript">
/* <![CDATA[ */
    function grin(tag) {
    	var myField;
    	tag = ' ' + tag + ' ';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
    		myField = document.getElementById('comment');
    	} else {
    		return false;
    	}
    	if (document.selection) {
    		myField.focus();
    		sel = document.selection.createRange();
    		sel.text = tag;
    		myField.focus();
    	}
    	else if (myField.selectionStart || myField.selectionStart == '0') {
    		var startPos = myField.selectionStart;
    		var endPos = myField.selectionEnd;
    		var cursorPos = endPos;
    		myField.value = myField.value.substring(0, startPos)
    					  + tag
    					  + myField.value.substring(endPos, myField.value.length);
    		cursorPos += tag.length;
    		myField.focus();
    		myField.selectionStart = cursorPos;
    		myField.selectionEnd = cursorPos;
    	}
    	else {
    		myField.value += tag;
    		myField.focus();
    	}
    }
/* ]]> */
</script>
<a href="javascript:grin(':cy:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/cy.gif" alt="" /></a>
<a href="javascript:grin(':hanx:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/hanx.gif" alt="" /></a>
<a href="javascript:grin(':huaix:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/huaix.gif" alt="" /></a>
<a href="javascript:grin(':tx:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/tx.gif" alt="" /></a>
<a href="javascript:grin(':se:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/se.gif" alt="" /></a>
<a href="javascript:grin(':wx:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/wx.gif" alt="" /></a>
<a href="javascript:grin(':zk:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/zk.gif" alt="" /></a>
<a href="javascript:grin(':shui:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/shui.gif" alt="" /></a>
<a href="javascript:grin(':kuk:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/kuk.gif" alt="" /></a>
<a href="javascript:grin(':lh:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/lh.gif" alt="" /></a>
<a href="javascript:grin(':gz:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/gz.gif" alt="" /></a>
<a href="javascript:grin(':ku:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/ku.gif" alt="" /></a>
<a href="javascript:grin(':kel:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/kel.gif" alt="" /></a>
<a href="javascript:grin(':yiw:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/yiw.gif" alt="" /></a>
<a href="javascript:grin(':yun:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/yun.gif" alt="" /></a>

<a href="javascript:grin(':jy:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/jy.gif" alt="" /></a>
<a href="javascript:grin(':dy:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/dy.gif" alt="" /></a>
<a href="javascript:grin(':gg:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/gg.gif" alt="" /></a>
<a href="javascript:grin(':fn:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/fn.gif" alt="" /></a>
<a href="javascript:grin(':fendou:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/fendou.gif" alt="" /></a>
<a href="javascript:grin(':shuai:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/shuai.gif" alt="" /></a>
<a href="javascript:grin(':kl:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/kl.gif" alt="" /></a>

<a href="javascript:grin(':pj:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/pj.gif" alt="" /></a>
<a href="javascript:grin(':fan:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/fan.gif" alt="" /></a>
<a href="javascript:grin(':lw:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/lw.gif" alt="" /></a>
<a href="javascript:grin(':qiang:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/qiang.gif" alt="" /></a>
<a href="javascript:grin(':ruo:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/ruo.gif" alt="" /></a>
<a href="javascript:grin(':ws:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/ws.gif" alt="" /></a>
<a href="javascript:grin(':ok:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/ok.gif" alt="" /></a>

<a href="javascript:grin(':gy:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/gy.gif" alt="" /></a>
<a href="javascript:grin(':qt:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/qt.gif" alt="" /></a>
<a href="javascript:grin(':cj:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/cj.gif" alt="" /></a>
<a href="javascript:grin(':aini:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/aini.gif" alt="" /></a>
<a href="javascript:grin(':bu:')"><img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/smilies/bu.gif" alt="" /></a>
<br />
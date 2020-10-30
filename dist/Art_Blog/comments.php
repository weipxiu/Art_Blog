<?php
if ( post_password_required() )
    return;
?>

<div id="comments" class="responsesWrapper">
    <h3 class="comments-title">共 <span class="commentCount"><?php echo number_format_i18n( get_comments_number() );?></span> 条评论关于"<?php the_title(); ?>"</h3>

    <!-- <nav class="navigation comment-navigation u-textAlignCenter" data-fuck="<? /**php the_ID();*/ ?>">
    <? /** php paginate_comments_links(array('prev_next'=>true)); */ ?>
    </nav> -->

    <!-- 加载表情包start -->
    <div id="smilies_modal" style="display:none">
        <?php get_template_part('smiley'); ?>
    </div>

    <!-- 加载表情包end -->
    <?php if(comments_open()) : ?>
        <div class="respond" role="form">
            <h2 id="reply-title" class="comments-title"><?php comment_form_title( '', '回复给 %s' ); ?> 
                <small>
                    <?php cancel_comment_reply_link(); ?>
                </small>
            </h2>
            <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
                <p class="login_success">您必须<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登录</a>才可以发表评论！</p>
            <?php else : ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="commentform" id="commentform">
                    <?php if ( is_user_logged_in() ) : ?>
                        <textarea class="form-control" rows="5" cols="100" id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" placeholder="请填写正确QQ邮箱，以便于更好的与您取得联系，否则您的留言可能会被删除！" class="form-control" tabindex="1" name="comment"></textarea>
                        <i class="iconfont icon-biaoqing"></i>
                        <span class="warning-text">通过<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>身份已登录&nbsp;|&nbsp;<a class="link-logout" href="<?php echo wp_logout_url(get_permalink()); ?>">注销</a></span>
                    <?php else : ?>
                        <textarea class="form-control" rows="5" cols="100" id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" placeholder="请填写正确QQ邮箱，以便于更好的与您取得联系，否则您的留言可能会被删除！" tabindex="1" name="comment"></textarea>
                        <i class="iconfont icon-biaoqing"></i>
                        <div class="commentform-info">
                            <label id="author_name" for="author">
                                <input class="form-control" id="author" type="text" tabindex="2" value="<?php echo $comment_author; ?>" name="author" placeholder="昵称[必填]" required>
                            </label>
                            <label id="author_email" for="email">
                                <input class="form-control" id="email" type="text" tabindex="3" value="<?php echo $comment_author_email; ?>" name="email" placeholder="QQ邮箱[必填]" required>
                            </label>
                            <label id="author_website" for="url">
                                <input class="form-control" id="url" type="text" tabindex="4" value="<?php echo $comment_author_url; ?>" name="url" placeholder="网址(选填)">
                            </label>
                        </div>
                    <?php endif; ?>
                    <div class="btn-group commentBtn" role="group">
                        <input name="submit" type="submit" id="submit" class="btn btn-sm btn-danger btn-block" tabindex="5" value="发表评论" /></div>
                    <?php comment_id_fields(); ?>
                </form>
            <?php endif; ?>
        </div>

        <p class="comment_title"><i class="iconfont icon-pinglun3"></i>最新评论</p>
        <ol class="commentlist">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
                'type'        =>'comment',
                'callback'    =>'simple_comment',
            ) );
            ?>
            <div class="not_message">暂无留言哦~~</div>
        </ol>
    <?php endif; ?>
</div>
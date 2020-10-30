<?php   
/*
Template Name: 关于博客  
*/  
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title( '-', true, 'right' ); ?>平凡有一点理想&nbsp;-&nbsp;渴望让世界不一样&nbsp;|&nbsp;<?php echo get_bloginfo('description'); ?></title>
    <?php get_template_part('common'); ?>
</head>
    <body>
	<?php get_header();?>

    <!-- 正文区域start -->
    <div class="continar">
         <div class="continar-left" id="details">
             <div class="head_user_b"> 
                   <div class="head_user"> 
                    <div class="head_user_a"> 
                     <div class="head_avatar"> 
                      <a href="javascript:;"> 
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/head_portrait.jpg" class="avatar" width="160" height="160" alt="<?php echo get_bloginfo('name'); ?>" />
                        <span class="verify_1"></span>
                      </a> 
                     </div> 
                     <div class="head_avatar_a">
                      <p>Admin<i class="img-icon icon_male"></i><a href="/author/0?info=vip#user_menu" title="VIP 6" class="vip_aa"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/vip9.png" class="vip_ico vip6" alt="<?php echo get_bloginfo('name'); ?>" /></a></p>
                     </div> 
                     <div class="head_avatar_b">
                        <p> 管理员 </p>
                     </div> 
                     <div class="head_avatar_c"> 
                        <a href="https://jq.qq.com/?_wv=1027&k=4BemYKg">
                            <span class="follow-btn unfollowed" onclick="jinsom_pop_login_style();"><i class="fa fa-plus"></i> 关 注</span>
                        </a>
                     </div> 
                    </div> 
                    <div class="head_user_data">
                         <span>人气：9999+</span> 
                         <span>粉丝：998</span> 
                         <span>关注：1983</span>
                    </div> 
                   </div> 
             </div>
             <div class="log-text">
                 <h2>前言</h2>
                 <ul>
                    <li>
                        我是一个什么样的人？有时候我也会这样问我自己。至少现在我还是个程序员，一个不忘初心的码农。经历过如履薄冰、风餐露宿、加班熬夜，见证过清晨第一缕阳光。体会到生活不易，且行且珍惜。我是程序员，是用代码编织世界的工程师，平凡有一点理想，渴望让世界不一样，<a href="/about-old">更多了解</a>
                    </li>
                 </ul>
                 <h2>花絮</h2>
                 <ul>
                    <li>光阴似箭，转眼我已然毕业四个年头，博客也运行了四年，虽是个小网站，但一路走来也是煞费苦心，亦也有所获。近年来我坚持更新文章，绝大多数教程案例皆是自己尝试可行并结合自己的心得记录下来的，绝非一股脑复制粘贴，许是内容质量不是很好，但也几乎没断过，然而网站流量始终无法再提升，不会SEO的站长真的太苦了。</li>
                    <li>始初做博客只是为找工作，刚毕业没啥经验好歹弄个作品吧，首先也是用网上主题模板，如大前端DUX、更知鸟等，奈何当时才疏学浅，想法却甚多，改别人的代码何况是PHP使得经常无从下手。</li>
                    <li>那索性就自己写个主题吧，要说写个简单自己用的主题并不算很难的事情，但最要命的第一步是“设计”，这让我着实为难，于是乎大量参考，看到哪个网站哪块好看就去结合自己的想法模仿升级做出来，但东拼西凑，总感觉缺少点啥，可能就是缺少协调性、灵魂！于是乎一边借鉴模仿，一边改，断断续续四年才有了现在的模样，其实大家看到的和最初的模样已经迥然不同了。</li>
                    <li>到底还是做出来了，但花费了那么多时间精力，独乐乐不如众乐乐，于是开源给大家一起享用。</li>
                 </ul>
                <h2>博客</h2>
                <ul>
                    <li>
                        程序员经常需要更新自己的技能库，而我们的大脑比不了磁盘，不能永久存储。文字则可以帮助我们去记忆一些东西。隔一段时间去总结这些知识，无疑会提高自己的总结能力与梳理能力。
                    </li>
                    <li>
                        加深自己对某项技术的理解。技术就如同一个花瓶，你不去仔细观察它，那么你只知道它是用来装花的。只有仔细的观察才能发现它身上每个条纹的美感。如果你想深入学习一个技术，那么你应该具有把它捧出来，把它的美讲给其他人听。
                    </li>
                    <li>
                        获得别人的认可。不想当将军的兵不是好士兵，不想成为大牛的程序员不是好程序员。让别人看到自己很厉害的一面，获得别人的认可，可以让自己获得成就感。进而获得更多的学习欲望。
                    </li>
                    <li>
                        提高自己的表达能力。程序员往往不是一个人在工作，更多的时候是团队合作。好的表达使其他同事更能明白你的意思。使团队合作更有序有效的进行。
                    </li>
                    <li>
                        为自己的生活留下足迹。程序员的职业生涯往往很短暂，在以后回眸来看这段经历的时候。这段人生轨迹肯定能让人思绪万千吧。</li>
                    <li>
                        证明自己的能力。面试官面试你的时候，问出的都是很片面的。但是每天日积月累的文章和你在文章中所做的思考是不会骗人的。通过你的博客可以看出一个人对待技术的态度，与思考问题的深度。
                    </li>
                    <li>
                        开源精神。很多人不愿意把自己的成果分享出来，有可能出于各种原因。但是如果把成果分享出来，你就会得到一群志同道合的人的纠正与反馈。无论是对于自己还是对于别人都能得到不同程度的提高。
                    </li>
                </ul>
                <h2>后记</h2>
                <ul>
                    <li>
                    互联网技术是日新月异的，作为技术人员的我们需要保持自己的技术与思想与时俱进。写博客是对于知识的沉淀与广度的扩展，当然看大牛们博客也是一种学习方法，但对于普通人来说写博客往往比博客读者更让人印象深刻。几乎每一个程序员都听说过写博客有很多好处，但真的动手去写的却很少。第一次写博客，也是感觉一直无从下手，不知怎样去写，也确实碍于自己才疏学浅。一个优秀的程序员就应该不断的去激励自己，在日常中检讨自己，与千万优秀人看齐，把优秀当做一直习惯。
                    </li>
                </ul>
             </div>
         </div>
         <!-- 左侧区域end -->
    </div>
    <!-- 正文区域end -->
    
    <?php get_footer()?>
</body>
</html>
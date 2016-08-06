<div class="top-img-wrap">
    <div id="top-slide-wrap" class="top-slide-wrap f-fl">
        <div class="swipe-wrap">
        <?php query_posts("post_type=topslideimg&post_status=publish&posts_per_page=-1");
         if (have_posts()) : while (have_posts()) : the_post(); 
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                ?>
                <a class="top-slide-link" href="<?php echo get_post_meta( get_the_ID(), '_topslideimg_thumbnail_url', true );?>" target="_blank"><?php the_post_thumbnail();?></a>
                <?php
            }
         endwhile;endif; ?>
        </div>
        <div class="top-slide-nav">
        <?php query_posts("post_type=topslideimg&post_status=publish&posts_per_page=-1");
         if (have_posts()) : while (have_posts()) : the_post(); 
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                ?>
                <i class="circle-icon f-img-nav"></i>
               <?php
            }
         endwhile;endif; ?>
        </div>
        <script src="<?php bloginfo('template_url'); ?>/js/lib/swipe.js"></script> <!-- 如果你的主题没有引入了jquery，请自己引入 -->
        <script type="text/javascript">
            $(".top-slide-wrap .f-img-nav").eq(0).addClass("active");
            var top_slide = document.getElementById('top-slide-wrap');
            var a= new Swipe(top_slide,{
                speed: 500,
                auto: 3000, //设置自动切换时间，单位毫秒
                continuous: true,  //无限循环的图片切换效果
                disableScroll: true,  //阻止由于触摸而滚动屏幕
                stopPropagation: false,  //停止滑动事件
                callback: function(index, element) {},  //回调函数，切换时触发
                transitionEnd: function (index, element) {
                    $(".top-slide-wrap .f-img-nav").removeClass("active");
                    $(".top-slide-wrap .f-img-nav").eq(index).addClass("active");
                }
            } );
            $(".top-slide-wrap .f-img-nav").click(function(){
                a.slide($(this).index(), 500); 
            });
         </script>
    </div>
    <a class="top-img f-fl" href="http://baidu.com" target="_blank">
        <img class="top-img-img" src="<?php bloginfo('template_url'); ?>/img/top-img.jpg"/>
    </a>
    <a class="top-img f-fr" href="http://baidu.com" target="_blank">
        <img class="top-img-img" src="<?php bloginfo('template_url'); ?>/img/top-img.jpg"/>
    </a>
</div>
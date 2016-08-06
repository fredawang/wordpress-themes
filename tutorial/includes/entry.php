<?php  if(have_posts()):?>
    <div class="post-wrap">
    <?php while(have_posts()):the_post();?>
        <div class="post" id="<?php the_ID();?>" title="<?php the_title();?>">
            <a class="post-url" href="<?php echo get_post_meta( get_the_ID(), '_topslideimg_thumbnail_url', true );?>" target="_blank">
                <?php if ( has_post_thumbnail() ){
                        the_post_thumbnail('article-image');
                    } else{?>
                    <img src="<?php bloginfo('template_url'); ?>/img/default.jpg"/>
                   <?php }
                 ?>
             </a>
            <div class="post-detail">
                <div class="post-detail-msg">
                    <span class="post-detail-msg-watch" title="浏览">1</span>
                    <span class="post-detail-msg-like" title="收藏">2</span>
                    <span class="post-detail-msg-comment" title="评论">3</span>
                </div>
                <div class="post-detail-title">
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
                <div class="post-detail-last-row">
                    <a class="post-detail-author" href="">
                        <span class="post-detail-author-thumil"><?php echo get_simple_local_avatar( get_the_author_meta( 'ID' ),20);?></span>
                        <span class="post-detail-author-name"><?php the_author();?></span>
                    </a>
                    <div class="post-detail-category"><?php the_category(",")?></div>
                </div>
            </div>
            <div class="postmetadata f-dn">
                类别:<?php the_category(",")?> <br>
                作者：<?php the_author();?><br>
                评论：<?php comments_popup_link('No Comments', '1 Comment »', '% Comments »'); ?><br>
                <?php edit_post_link('Edit', ' | ', ''); ?> 
            </div>
        </div>
    <?php endwhile;?>
    </div>
    <div class="post-navigation">
        <?php
            the_posts_pagination( array(
                'prev_text'          =>上页,
                'next_text'          =>下页,
                'before_page_number' => '<span class="meta-nav screen-reader-text"></span>',
                'after_page_number' => '<span class="meta-nav screen-reader-text"></span>',
            ) );
            //posts_nav_link('-','befor','after'); 
        ?>
    </div>
<?php else: ?>
<div class="post-wrap">
    <div class="post">
        <h2>没有文章</h2>
    </div>
</div>
<?php endif;?>


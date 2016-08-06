<?php
/**
 * Main Template of WFWD WordPress Theme
 *
 * @package   WFWD
 * @version   1.0.9
 * @date      2016.06.17
 * @author    WangFan <wf_cmp_word@126.com>
 * @site      WangFan <www.upfreda.com>
 * @copyright Copyright (c) 2014, Zhiyan
 * @license   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link      http://www.zhiyanblog.com/tinection.html
**/

?>
<?php get_header(); ?>
<?php include_once(TEMPLATEPATH . '/includes/header-login.php'); ?>
<?php include_once(TEMPLATEPATH . '/includes/top-img.php'); ?>
<div class="second-nav-wrap f-ib">
    <div id="second-nav" class="site-navigation primary-navigation" role="navigation">
        <div class="second-nav-menu">
            <a class="active" href="/">首页推荐</a>
        <?php
        $menuParameters = array(  
            'theme_location' => 'nav2',
             'container' => false,  
             'echo' => false,  
             'items_wrap' => '%3$s',  
             'depth' => 1
             );  
         echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );  
        ?>
        </div>
    </div>
</div>
<!--文章列表-->
<div class="post-entry-list">
    <?php $paged = ($_GET['paged'])?$_GET['paged']:1;?>
    <?php query_posts("post_type=post&post_status=publish&posts_per_page=" . $perPageNum . "&paged=". $paged); ?>
    <?php include_once(TEMPLATEPATH . '/includes/entry.php'); ?>
</div>
<div class="home-row-item">
    <div class="home-row-item-title">
        <span class="home-row-item-title-word f-fl">教程</span>
        <a class="home-row-item-title-more f-fr" href="" target="_blank">更多</a>
    </div>
    <div class="post-entry-list">
        <div class="post-wrap">
        <?php $recentPosts = new WP_Query("cat=tutorials");
        $recentPosts->query('showposts=5');?>
        <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
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
                <div class="post-detail-title">
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
                <div class="post-detail-last-row">
                    <a class="post-detail-author" href="">
                        <span class="post-detail-author-thumil"><?php echo get_simple_local_avatar( get_the_author_meta( 'ID' ),20);?></span>
                        <span class="post-detail-author-name"><?php the_author();?></span>
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
</div>
<div class="home-row-item">
    <div class="home-row-item-title">
        <span class="home-row-item-title-word f-fl">原创</span>
        <a class="home-row-item-title-more f-fr" href="" target="_blank">更多</a>
    </div>
    <div class="post-entry-list">
        <div class="post-wrap">
        <?php $recentPosts = new WP_Query("cat=tutorials");
        $recentPosts->query('showposts=5');?>
        <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
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
                <div class="post-detail-title">
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
                <div class="post-detail-last-row">
                    <a class="post-detail-author" href="">
                        <span class="post-detail-author-thumil"><?php echo get_simple_local_avatar( get_the_author_meta( 'ID' ),20);?></span>
                        <span class="post-detail-author-name"><?php the_author();?></span>
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
</div>
<div class="home-row-item">
    <div class="home-row-item-title">
        <span class="home-row-item-title-word f-fl">高清</span>
        <a class="home-row-item-title-more f-fr" href="" target="_blank">更多</a>
    </div>
    <div class="post-entry-list">
        <div class="post-wrap">
        <?php $recentPosts = new WP_Query("cat=tutorials");
        $recentPosts->query('showposts=5');?>
        <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
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
                <div class="post-detail-title">
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
                <div class="post-detail-last-row">
                    <a class="post-detail-author" href="">
                        <span class="post-detail-author-thumil"><?php echo get_simple_local_avatar( get_the_author_meta( 'ID' ),20);?></span>
                        <span class="post-detail-author-name"><?php the_author();?></span>
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
</div>
<div class="home-cat-list">
    <div class="home-cat-list-cat f-fl">
        <div class="home-cat-firstrow">
            <span class="home-cat-firstrow-title">原创</span>
            <a href="" target="_blank" class="home-cat-firstrow-more">更多</a>
        </div>
        <div class="post-entry-list">
            <div class="post-wrap">
            <?php $recentPosts = new WP_Query("cat=tutorials");
            $recentPosts->query('showposts=10');?>
            <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                <div class="post-title">
                    <a href="<?php the_permalink();?>" id="<?php the_ID();?>" title="<?php the_title();?>"><?php the_title();?></a> 
                </div>
            <?php endwhile; ?>
            </div>
        </div>
    </div>
    <div class="home-cat-list-cat f-fl">
        <div class="home-cat-firstrow">
            <span class="home-cat-firstrow-title">教程</span>
            <a href="" target="_blank" class="home-cat-firstrow-more">更多</a>
        </div>
        <div class="post-entry-list">
            <div class="post-wrap">
            <?php $recentPosts = new WP_Query("cat=tutorials");
            $recentPosts->query('showposts=10');?>
            <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                <div class="post-title">
                    <a href="<?php the_permalink();?>" id="<?php the_ID();?>" title="<?php the_title();?>"><?php the_title();?></a> 
                </div>
            <?php endwhile; ?>
            </div>
        </div>
    </div>
    <div class="home-cat-list-cat f-fr">
        <div class="home-cat-firstrow">
            <span class="home-cat-firstrow-title">设计库</span>
            <a href="" target="_blank" class="home-cat-firstrow-more">更多</a>
        </div>
        <div class="post-entry-list">
            <div class="post-wrap">
            <?php $recentPosts = new WP_Query("cat=tutorials");
            $recentPosts->query('showposts=10');?>
            <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                <div class="post-title">
                    <a href="<?php the_permalink();?>" id="<?php the_ID();?>" title="<?php the_title();?>"><?php the_title();?></a> 
                </div>
            <?php endwhile; ?>
            </div>
        </div>
    </div>
    <div class="home-cat-list-cat f-fr">
        <div class="home-cat-firstrow">
            <span class="home-cat-firstrow-title">文章</span>
            <a href="" target="_blank" class="home-cat-firstrow-more">更多</a>
        </div>
        <div class="post-entry-list">
            <div class="post-wrap">
            <?php $recentPosts = new WP_Query("cat=tutorials");
            $recentPosts->query('showposts=10');?>
            <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                <div class="post-title">
                    <a href="<?php the_permalink();?>" id="<?php the_ID();?>" title="<?php the_title();?>"><?php the_title();?></a> 
                </div>
            <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

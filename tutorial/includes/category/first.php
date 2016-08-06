<?php
/**
 * home page Template of WFWD WordPress Theme
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
            <a href="/">首页推荐</a>
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
    <script type="text/javascript">
        $('.second-nav-menu a[href="' + window.location.href + '"]').addClass("active");
    </script>
</div>
<!--文章列表-->
<div class="post-entry-list">
    <?php query_posts("post_type=post&cat=".$_GET['cat']."&post_status=publish&posts_per_page=-1"); ?>
    <?php include_once(TEMPLATEPATH . '/includes/entry.php'); ?>
</div>
    
<?php get_footer(); ?>

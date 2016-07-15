<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">



	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>



	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
<?php if( is_single() || is_page() ) {  
    if( function_exists('get_query_var') ) {  
        $cpage = intval(get_query_var('cpage'));  
        $commentPage = intval(get_query_var('comment-page'));  
    }  
    if( !emptyempty($cpage) || !emptyempty($commentPage) ) {  
        echo '<meta name="robots" content="noindex, nofollow" />';  
        echo "\n";  
    }  
}  
?>  


	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />

	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



	<?php wp_get_archives('type=monthly&format=link'); ?>

	<?php //comments_popup_script(); // off by default ?>

	<?php wp_head(); ?>

</head>

<body>

<div id="header">
<h1><a href="<?php bloginfo('url');?>"><?php bloginfo('name'); ?></a></h1>
<?php bloginfo('description');?>
</div>
<div id="search">
    <h2>搜索</h2>
    <li id="search">
        <?php include(TEMPLATEPATH . '/searchform.php'); ?>
    </li>
    <h2>日历</h2>
    <li id="calendar">
        <?php get_calendar(); ?>
    </li>
</div>
<div id="container">
    <?php if(have_posts()):?>
        <?php while(have_posts()):the_post();?>
            <div class="post" id="<?php the_ID();?>" title="<?php the_title();?>">
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                <div class="entry">
                    <?php the_content();?>
                </div>
                <div class="postmetadata">
                    类别:<?php the_category(",")?> <br>
                    作者：<?php the_author();?><br>
                    评论：<?php comments_popup_link('No Comments', '1 Comment »', '% Comments »'); ?><br>
                    <?php edit_post_link('Edit', ' | ', ''); ?> 
                </div>
            </div>
        <?php endwhile;?>
        <div class="navigation">
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
        <div class="post">
            <h2>没有文章</h2>
        </div>
    <?php endif;?>
</div>
<div>---------------------</div>

<div id="sidebar">
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>
    <?php wp_list_pages('title_li=<h2>Pages</h2>'); ?>
    
    <h2>Categories</h2>
    <ul>
        <?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=1'); ?>
    </ul>
    
    <h2>Archives</h2>
    <?php wp_get_archives("show_post_count=1") ?>
    <select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
      <option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
      <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
    </select>
    <?php get_links_list(); ?>
    
    <li>
        <h2><?php _e('Meta'); ?></h2>
        <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
            </ul>
    </li>
    <?php endif; ?>
</div>
<?php include(TEMPLATEPATH . '/footer.php'); ?>
</body>

</html>
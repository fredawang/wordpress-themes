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
        if( !empty($cpage) || !empty($commentPage) ) {  
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
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/register.css" type="text/css" media="all" /> 
    <body>
        <div class="header-bg">
            <div class="header-wrap">
                <div class="header-logo-wrap f-ib">
                    <img class="logo-img" src="<?php bloginfo('template_url'); ?>/img/logo.png"/>
                </div>
                <div class="header-nav-wrap f-ib">
                    <nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
                        <?php wp_nav_menu( array( 'theme_location' => 'topbar', 'menu_class' => 'nav-menu', 'depth' => 2 ) ); ?>
                    </nav>
                </div>
                
                <div class="header-login-wrap f-ib">
                    <?php if(!is_user_logged_in()){ ?>
                        <a href="http://localhost/xampp/htdocs/wordpress/register" class="register-btn">注册</a>/<a href="wp-login.php" class="login-btn">登录</a>
                    <?php }else{ ?>
                        <?php global $current_user;?>
                            <a href="<?php bloginfo('url'); ?>/wp-admin/profile.php"><?php echo $current_user->display_name;?></a>
                            <a href="<?php bloginfo('url'); ?>/wp-admin/"><?php _e('后台','tinection'); ?></a>
                            <a href="<?php bloginfo('url'); ?>/wp-admin/post-new.php"><?php _e('发布','tinection'); ?></a>
                            <a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="logout"><?php _e('退出','tinection'); ?></a>
                        <?php ?>
                    <?php } ?>
                </div>
                <div class="header-search-wrap f-ib">
                    <?php include_once('includes/searchform.php'); ?>
                </div>
            </div>
        </div>
        <div class="gonggao-wrap">
            <?php query_posts("post_type=gonggao&post_status=publish&posts_per_page=-1");if (have_posts()) : while (have_posts()) : the_post(); ?>
            <li>
                <div class="gonggao-content">
                    <i class="horn-icon"></i>
                    <span class="gonggao-content-content">
                    <?php 
                        //the_time('Y年n月j日G:H');
                        //the_author() ;
                        the_content(); 
                      ?>
                    </span>
                </div>
            </li>
            <?php endwhile;endif; ?>
        </div>

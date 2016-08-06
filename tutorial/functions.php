<?php
//登录界面
function diy_login_page() {
  echo '<link rel="stylesheet" href="' . get_bloginfo( 'template_directory' ) . '/css/login.css" type="text/css" media="all" />' . "\n";
}
add_action( 'login_enqueue_scripts', 'diy_login_page' );
//登录界面结束
 
// 顶部导航
if (function_exists('register_nav_menus')){
        register_nav_menus( array(
            'topbar' => __('顶部导航'),
            'nav2' => __('导航2')
        ));
    }

if ( function_exists('register_sidebar') )
    register_sidebar();
// 顶部导航结束


//every users can only see himself articel on manager control panel
function wpjam_parse_query_useronly( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
        if ( !current_user_can( 'add_user' ) ) {
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}
add_filter('parse_query', 'wpjam_parse_query_useronly' );



//修改主循环的查询  结束

/***
    自定义注册页面

***/
add_action('generate_rewrite_rules', 'ashu_rewrite_rules' );   
/**********重写规则************/  
function ashu_rewrite_rules( $wp_rewrite ){   
    $new_rules = array(   
        'register/?$' => 'index.php?my_custom_page=register',   
    ); //添加翻译规则   
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;   
    //php数组相加   
}   
  
/*******添加query_var变量***************/  
add_action('query_vars', 'ashu_add_query_vars');   
function ashu_add_query_vars($public_query_vars){     
    $public_query_vars[] = 'my_custom_page';   
       
    return $public_query_vars;     
}   
  
  
//模板载入规则   
add_action("template_redirect", 'ashu_template_redirect');   
function ashu_template_redirect(){   
    global $wp;   
    global $wp_query, $wp_rewrite;   
       
    //查询my_custom_page变量   
    $reditect_page =  $wp_query->query_vars['my_custom_page'];   
    if ($reditect_page == "register"){ 
        include(TEMPLATEPATH.'/custom-register.php');   
        die();
    }   
}   
  
/***************激活主题更新重写规则***********************/  
add_action( 'load-themes.php', 'frosty_flush_rewrite_rules' );   
function frosty_flush_rewrite_rules() {   
    global $pagenow, $wp_rewrite;   
    if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )   
        $wp_rewrite->flush_rules();   
} 

/***
    自定义注册页面
    
    结束
***/


/**
 * 自定义用户个人资料信息
 */
add_filter( 'user_contactmethods', 'wpdaxue_add_contact_fields' );
function wpdaxue_add_contact_fields( $contactmethods ) {
	$contactmethods['user_profession'] = '职业';
	$contactmethods['user_city'] = '城市';
	$contactmethods['user_work'] = '目前就职';
	$contactmethods['user_game_age'] = '游戏行业年限';
	$contactmethods['user_qq'] = 'QQ';
	$contactmethods['user_age'] = '年龄';
	$contactmethods['user_university'] = '院校';
	$contactmethods['user_xinlang'] = '新浪微博';
	$contactmethods['user_tengxun'] = '腾讯微博';
	$contactmethods['simple_local_avatar'] = '个人头像';
	unset( $contactmethods['yim'] );
	unset( $contactmethods['aim'] );
	unset( $contactmethods['jabber'] );
	unset( $contactmethods['admin_color'] );
	unset( $contactmethods['display_name'] );
	unset( $contactmethods['first_name'] );
	unset( $contactmethods['last_name'] );
	unset( $contactmethods['comment_shortcuts'] );
	return $contactmethods;
}
/**
 * 自定义用户个人资料信息
 * 结束
 */
 
 /*function loadCustomTemplate($template) {
  global $wp_query;
  if(!file_exists($template))return;
  $wp_query->is_page = true;
  $wp_query->is_single = false;
  $wp_query->is_home = false;
  $wp_query->comments = false;
  // if we have a 404 status
  if ($wp_query->is_404) {
  // set status of 404 to false
    unset($wp_query->query["error"]);
    $wp_query->query_vars["error"]="";
    $wp_query->is_404=false;
  }
  // change the header to 200 OK
  header("HTTP/1.1 200 OK");
  //load our template
  include($template);
  exit;
}
 
function templateRedirect() {
  $basename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
  loadCustomTemplate(TEMPLATEPATH.'/functions/'."/$basename.php");
}
  
add_action('template_redirect', 'templateRedirect');*/


/*编辑文章时
*使用特色图片（缩略图）
*/
add_theme_support('post-thumbnails', array('post','topslideimg'));
add_image_size('article-image', 235, 180,true);
//set_post_thumbnail_size(235, 180,true);
/**
 * WordPress 给“特色图像”模块添加说明文字
 */
add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
	return $content .= '<p>特色图像将用来作为这篇文章的缩略图，请务必为文章选择一个特色图像。</p>';
}
/*编辑文章时
*使用特色图片（缩略图）
*结束
*/


include_once('functions/common.php');
include_once('functions/custom-user-avatar.php');
include_once('functions/topslide.php');  
include_once('functions/post-type.php');  
?>
<?php


 
// to use function wp_nav_menu
if (function_exists('register_nav_menus')){
        register_nav_menus( array(
            'topbar' => __('顶部导航'),
            'nav2' => __('导航2')
        ));
    }

if ( function_exists('register_sidebar') )
    register_sidebar();

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
	$contactmethods['user_link'] = '个人网站';
	$contactmethods['user_xinlang'] = '新浪微博';
	$contactmethods['user_tengxun'] = '腾讯微博';
	unset( $contactmethods['yim'] );
	unset( $contactmethods['aim'] );
	unset( $contactmethods['jabber'] );
	return $contactmethods;
}
/**
 * 自定义用户个人资料信息
 * 结束
 */

include_once('functions/post-type.php');  
?>
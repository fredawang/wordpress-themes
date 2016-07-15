<?php
//登录界面
function diy_login_page() {
  echo '<link rel="stylesheet" href="' . get_bloginfo( 'template_directory' ) . '/css/login.css" type="text/css" media="all" />' . "\n";
}
add_action( 'login_enqueue_scripts', 'diy_login_page' );
//公告
 add_action('init', 'my_custom_init'); 
 function my_custom_init() { 
    $labels = array( 
        'name' => '公告', 
        'singular_name' => 'singularname', 
        'add_new' => '新建公告', 
        'add_new_item' => '新建公告', 
        'edit_item' => '编辑公告', 
        'new_item' => '新公告', 
        'view_item' => '查看公告', 
        'search_items' => '搜索公告', 
        'not_found' => '暂无公告', 
        'not_found_in_trash' => '没有已遗弃的公告', 
        'parent_item_colon' => '', 
        'menu_name' => '公告' ); 
    $args = array( 
        'labels' => $labels, 
        'public' => true, 
        'publicly_queryable' => true, 
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true, 
        'rewrite' => true, 
        'capability_type' => 'post', 
        'has_archive' => true, 
        'hierarchical' => false, 
        'menu_position' => null, 
        'supports' => array('title','editor','author') ); 
    register_post_type('gonggao',$args); 
}
?>
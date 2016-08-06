<?php

//公告
 add_action('init', 'my_custom_init'); 
function my_custom_init() { 
    addGongGao();
    addTopSlideImg();
}

function addGongGao(){
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
        'supports' => array('title','editor') ); 
    register_post_type('gonggao',$args); 
}
function addTopSlideImg(){
    $labels = array( 
        'name' => '顶部轮播图片', 
        'singular_name' => 'topslideimgname', 
        'add_new' => '新建顶部轮播图片', 
        'add_new_item' => '新建顶部轮播图片', 
        'edit_item' => '编辑顶部轮播图片', 
        'new_item' => '新顶部轮播图片', 
        'view_item' => '查看顶部轮播图片', 
        'search_items' => '搜索顶部轮播图片', 
        'not_found' => '暂无顶部轮播图片', 
        'not_found_in_trash' => '没有已遗弃的顶部轮播图片', 
        'parent_item_colon' => '', 
        'menu_name' => '顶部轮播图片' ); 
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
        'supports' => array('title','thumbnail') ); 
    register_post_type('topslideimg',$args); 
}

//注册时上传头像
add_action( 'wp_ajax_nopriv_avatar', 'wp_ajax_nopriv_avatar');
function wp_ajax_nopriv_avatar(){
    $post_data = isset( $_REQUEST['post_data'] ) ? $_REQUEST['post_data'] : array();

	// If the context is custom header or background, make sure the uploaded file is an image.
	if ( isset( $post_data['context'] ) && in_array( $post_data['context'], array( 'custom-header', 'custom-background' ) ) ) {
		$wp_filetype = wp_check_filetype_and_ext( $_FILES['async-upload']['tmp_name'], $_FILES['async-upload']['name'] );
		if ( ! wp_match_mime_types( 'image', $wp_filetype['type'] ) ) {
			echo wp_json_encode( array(
				'success' => false,
				'data'    => array(
					'message'  => __( 'The uploaded file is not a valid image. Please try again.' ),
					'filename' => $_FILES['async-upload']['name'],
				)
			) );

			wp_die();
		}
	}
    //$user_id_being_edited = $user_id; // make user_id known to unique_filename_callback function
    $avatar = wp_handle_upload( $_FILES['file'], array( 'mimes' => $mimes, 'test_form' => false) );
    
    if ( empty($avatar['file']) ) {		// handle failures
        echo esc_attr( $avatar['error'] );
    } else{
        /*var_dump( array(
            'success' => true,
            'data'    => $avatar,
        ) );*/
        wp_send_json_success($avatar);
    }
    wp_die();
}


?>
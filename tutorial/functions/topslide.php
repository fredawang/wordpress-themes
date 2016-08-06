<?php


/**
*顶部轮播图片
*添加输入缩略图对应url的输入框
*/
add_action( 'add_meta_boxes', 'topslideimg_thumbnail_url' );
function topslideimg_thumbnail_url() {
    add_meta_box(
        'topslideimg_thumbnail_url',
        '链接的url',
        'topslideimg_thumbnail_url_meta_box',
        'topslideimg',
        'normal',
        'high'
    );
}
function topslideimg_thumbnail_url_meta_box($post) {

    // 创建临时隐藏表单，为了安全
    wp_nonce_field( 'topslideimg_thumbnail_url_meta_box', 'topslideimg_thumbnail_url_meta_box_nonce' );
    // 获取之前存储的值
    $value = get_post_meta( $post->ID, '_topslideimg_thumbnail_url', true );

    ?>
    <div class="wpuf-fields">
        <input type="text" id="topslideimg_thumbnail_url" name="topslideimg_thumbnail_url" value="<?php echo esc_attr( $value ); ?>" placeholder="输入链接的url" >
    </div>
    <?php
}
add_action( 'save_post', 'topslideimg_thumbnail_url_save_meta_box' );
function topslideimg_thumbnail_url_save_meta_box($post_id){
    
    // 安全检查
    // 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
    if ( ! isset( $_POST['topslideimg_thumbnail_url_meta_box_nonce'] ) ) {
        return;
    }
    
    // 判断隐藏表单的值与之前是否相同
    if ( ! wp_verify_nonce( $_POST['topslideimg_thumbnail_url_meta_box_nonce'], 'topslideimg_thumbnail_url_meta_box' ) ) {
        return;
    }
    // 判断该用户是否有权限
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // 判断 Meta Box 是否为空
    if ( ! isset( $_POST['topslideimg_thumbnail_url'] ) ) {
        return;
    }

    $topslideimg_thumbnail_url = sanitize_text_field( $_POST['topslideimg_thumbnail_url'] );
    update_post_meta( $post_id, '_topslideimg_thumbnail_url', $topslideimg_thumbnail_url );

}
/**
*对顶部轮播图片添加url 结束
*
*/
?>
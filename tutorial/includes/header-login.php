<?php
/**
 * Includes of WFWD WordPress Theme
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
<div class="login-pop-bg">
</div>
<div class="login-pop" id="login-pop" style="display:none; top: 160px; opacity: 0;">
	<div class="login-pop-form">
	<?php if (false){ ?>
	<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
		<div class="login-pop-inptxt-name">
		<label><i class="fa fa-user"></i></label>
		<input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="18" placeholder="<?php _e('请输入用户名','tinection'); ?>" />
		</div>
		<div class="login-pop-inptxt-pass">
		<label><i class="fa fa-lock"></i></label>
		<input type="password" name="pwd" id="pwd" size="18" placeholder="<?php _e('密码','tinection'); ?>"/>
		</div>
		<div class="login-pop-inptxt-submit">
		<input type="submit" name="submit" value="<?php _e('登录','tinection'); ?>" class="button" />
		<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
		<div class="login-pop-forget-pass">
		<a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword"><?php _e('忘记密码 ?','tinection'); ?></a>
		</div>
		<div class="login-pop-register"> 
		<span><?php _e('还不是会员 ?','tinection'); ?></span><a href="<?php bloginfo('url'); ?>/wp-login.php?action=register"><?php _e('现在注册','tinection'); ?></a>
		</div> 
		</div>
	</form>
	<?php } else { ?>
	<strong>
	<?php global $current_user;?>
		<a href="<?php bloginfo('url'); ?>/wp-admin/profile.php"><?php echo $current_user->display_name;?></a>
		<br/>
		<p><a href="<?php bloginfo('url'); ?>/wp-admin/"><?php _e('后台','tinection'); ?></a>
		<a href="<?php bloginfo('url'); ?>/wp-admin/post-new.php"><?php _e('发布','tinection'); ?></a>
		<a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="logout"><?php _e('退出','tinection'); ?></a></p>
	</strong>
	<?php }?>
	</div>
</div>
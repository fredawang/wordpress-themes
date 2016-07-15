<?php     
/* 
Template Name: 自定义注册页面模板  
*/     
?> 
<?php   
require_once(ABSPATH . WPINC . '/registration.php'); //宝航registration.php文件   
global $wpdb, $user_ID; //glocal全局变量   
if (!$user_ID) { //如果存在$user_ID变量，则用户已经登录   
   //接下来的代码都添加在这里.     
}else{   
   wp_redirect( home_url() ); exit; //如果已经登录，重定向到站点首页   
}   
 


if($_POST){   
echo "aaa";
    //验证数据是否全部为空格   
    $username = $wpdb->escape($_REQUEST['username']);   
    if(empty($username)) {   
        echo "用户名不能为空.";   
        exit();   
    }   
    $email = $wpdb->escape($_REQUEST['email']);   
    //验证邮箱格式   
    if( !is_email($email) ) {   
        echo "请输入有效的邮箱地址.";   
        exit();   
    }   
       
    //生成密码   
    $passwd = $wpdb->escape($_REQUEST['passwd']); 
    $re_passwd = $wpdb->escape($_REQUEST['re_passwd']); 
    if($re_passwd != $passwd ){
        echo "两次密码不一致.";   
        exit();
    }
    if(empty($passwd) && strlen($passwd) < 6){
        echo "请输入有效的密码.";   
        exit(); 
    }
    //创建用户   
    $userdata = array(
        'user_login'  =>  $username,
        'user_pass'    =>  $passwd,
        'user_email'   =>  $email  // When creating an user, `user_pass` is expected.
    );
    //$user_id = wp_create_user( $username, $passwd, $email );  
    $user_id = wp_insert_user( $userdata ) ;
    
    if ( is_wp_error($user_id) ) {   
       echo $user_id->get_error_message();//输出错误信息  
    }else{   
        $from = get_option('admin_email');   
        $headers = 'From: '.$from . "\r\n";   
        $subject = "注册成功";   
        $msg = "注册成功.\n你的登陆信息\n用户名: $username\n密码: $passwd";   
        //发送邮件   
        wp_mail( $email, $subject, $msg, $headers );   
        echo "请检查你电子邮件中的登陆信息。";   
        
    }   
       
    exit();   
}else{   
    get_header(); //加载头部问及爱你   
    ?>   
     <script src="http://code.jquery.com/jquery-1.4.4.js"></script> <!-- 如果你的主题没有引入了jquery，请自己引入 -->   
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/register.css" type="text/css" media="all" /> 
    <div id="container">   
    <div id="content">   
    <?php   
    
        //get_option('users_can_register')获取是否允许注册   
        if(get_option('users_can_register')) {   
        ?>   
        <!--<h1>注册</h1>   
        <div id="result"></div> 
        <form id="wp_signup_form" action="" method="post">   
            <label>用户名</label>   
            <input type="text" name="username" class="text" value="" /><br />   
            <label>Email</label>   
            <input type="text" name="email" class="text" value="" /> <br />   
            <label>密码</label>   
            <input type="text" name="passwd" class="text" value="" /> <br />  
            <label>确认密码</label>   
            <input type="text" name="re_passwd" class="text" value="" /> <br />  
           
            <input type="submit" id="submitbtn" name="submit" value="注册" />   
        </form>   -->
        <div class="sinneir">
            <div class="entry full-width clearfix" style="margin-top:30px;">
                <h1 class="h1huiyuanlb">注册页面</h1>	
                <form class="wpuf-form-add" action="" method="post">
                <ul class="wpuf-form">
                <li class="wpuf-el user_login">        
                    <div class="wpuf-label">
                        <label for="wpuf-user_login">用户名 <span class="required">*</span></label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="user_login" type="text" data-required="yes" data-type="text" required="required" name="user_login" placeholder="请用小写字母或数字，不能有空格" value="" size="40">
                        <span class="wpuf-help">个人主页地址将以用户为结尾地址</span>
                    </div>

                </li>
                <li class="wpuf-el nickname">        
                    <div class="wpuf-label">
                        <label for="wpuf-nickname">昵称 <span class="required">*</span></label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="nickname" type="text" data-required="yes" data-type="text" required="required" name="nickname" placeholder="中英文皆可，后续不可更改" value="" size="40">
                        <span class="wpuf-help"></span>
                    </div>

                </li>
                <li class="wpuf-el gsposition">        
                    <div class="wpuf-label">
                        <label for="wpuf-gsposition">职业 <span class="required">*</span></label>
                    </div>
    
                    <div class="wpuf-fields">
                        <select name="gsposition" data-required="yes" data-type="select" required="required">
                            <option value=""> - 请选择职业 -</option>
                            <option value="界面设计师" selected="selected">界面设计师</option>
                            <option value="网页设计师">网页设计师</option>
                            <option value="平面设计师">平面设计师</option>
                            <option value="多媒体设计师">多媒体设计师</option>
                            <option value="游戏特效师">游戏特效师</option>
                            <option value="交互设计师">交互设计师</option>
                            <option value="游戏原画师">游戏原画师</option>
                            <option value="设计爱好者">设计爱好者</option>
                            <option value="学生">学生</option>
                            <option value="其他">其他</option>
                        </select>
                        <span class="wpuf-help"></span>
                    </div>
                </li>
                <li class="wpuf-el user_email">        
                    <div class="wpuf-label">
                        <label for="wpuf-user_email">邮箱 <span class="required">*</span></label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input id="wpuf-user_email" type="email" class="email" data-required="yes" data-type="text" required="required" name="user_email" placeholder="请填写您的常用邮箱" value="" size="40">
                        <span class="wpuf-help">用于接收系统邮件，重设/取回密码、作品评论提示等。</span>
                    </div>

                </li>
                <li class="wpuf-el password">        
                    <div class="wpuf-label">
                        <label for="wpuf-password">密码 <span class="required">*</span></label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input id="pass1" type="password" class="password" data-required="yes" data-type="text" required="required" name="pass1" placeholder="至少6个字符" value="" size="40">
                        <span class="wpuf-help">可用大小写字母，数字和符号，例如：~！@#￥%</span>
                    </div>

                </li>
                <li>        
                    <div class="wpuf-label">
                        <label for="wpuf-pass2">确认密码 <span class="required">*</span></label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input id="pass2" type="password" class="password" data-required="yes" data-type="text" required="required" name="pass2" value="" size="40">
                    </div>

                </li>
                <li>            
                    <div class="wpuf-label">
                    &nbsp;
                    </div>

                    <div class="wpuf-fields">
                        <div id="pass-strength-result" style="display: block;" class="">Strength indicator</div>
                        <!--<script src="http://www.gameui.cn/wp-admin/js/password-strength-meter.js"></script>
                        <script src="http://www.gameui.cn/wp-admin/js/user-profile.js"></script>
                        <script type="text/javascript">
                            var pwsL10n = {
                                empty: "Strength indicator",
                                short: "Very weak",
                                bad: "Weak",
                                good: "Medium",
                                strong: "Strong",
                                mismatch: "Mismatch"
                            };
                            try{convertEntities(pwsL10n);}catch(e){};
                        </script>-->
                    </div>
            
                </li>
                <li class="wpuf-el avatar">        
                    <div class="wpuf-label">
                        <label for="wpuf-avatar">上传头像</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <div id="wpuf-avatar-upload-container" style="position: relative;">
                            <div class="wpuf-attachment-upload-filelist">
                                <a id="wpuf-avatar-pickfiles" class="button file-selector" href="#" style="z-index: 0;">选择图像</a>
                                <span class="wpuf-file-validation" data-required="no" data-type="file"></span>
                                <ul class="wpuf-attachment-list thumbnails"></ul>
                            </div>
                            <div id="p1amfv5if815fm1hs918gjjs1gk20_html5_container" class="plupload html5" style="position: absolute; width: 80px; height: 40px; overflow: hidden; z-index: -1; opacity: 0; top: 0px; left: 0px; background: transparent;">
                                <input id="p1amfv5if815fm1hs918gjjs1gk20_html5" style="font-size: 999px; position: absolute; width: 100%; height: 100%;" type="file" accept="image/jpeg,image/gif,image/png,image/bmp">
                            </div>
                       </div><!-- .container -->

                       <span class="wpuf-help">头像尺寸为75X75像素的方正形，JPG格式为佳，不能超过50KB，文件名不能包含中文</span>

                    </div> <!-- .wpuf-fields -->

                    <!--<script type="text/javascript">
                        jQuery(function($) {
                            new WPUF_Uploader('wpuf-avatar-pickfiles', 'wpuf-avatar-upload-container', 1, 'avatar', 'jpg,jpeg,gif,png,bmp', 50);
                        });
                      </script>-->
                </li>
                <li class="wpuf-el description">        
                    <div class="wpuf-label">
                        <label for="wpuf-description">个人说明</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <textarea class="textareafield" id="description" name="description" data-required="no" data-type="textarea" placeholder="用简短的话语，描述最具个性的你！20-50字为宜。" rows="3" cols="2"></textarea>
                        <span class="wpuf-help"></span>
                    </div>

                </li>
                <li class="wpuf-el yim">        
                    <div class="wpuf-label">
                        <label for="wpuf-yim">城市</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="yim" type="text" data-required="no" data-type="text" name="yim" placeholder="所在城市" value="" size="40">
                        <span class="wpuf-help"></span>
                        
                    </div>

                </li>
                <li class="wpuf-el company">        
                    <div class="wpuf-label">
                        <label for="wpuf-company">目前就职</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="company" type="text" data-required="no" data-type="text" name="company" placeholder="目前就职的公司" value="" size="40">
                        <span class="wpuf-help"></span>
                        
                    </div>

                </li>
                <li class="wpuf-el sina_weibo">        
                    <div class="wpuf-label">
                        <label for="wpuf-sina_weibo">游戏行业年限</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <select name="sina_weibo[]" data-required="no" data-type="select">
                            <option value=""> - 年限 -</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="10+">10+</option>
                        </select>
                        <span class="wpuf-help"></span>
                    </div>
                </li>
                <li class="wpuf-el qq">        
                    <div class="wpuf-label">
                        <label for="wpuf-qq">QQ</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="qq" type="text" data-required="no" data-type="text" name="qq" placeholder="你想让其他人找到你吗？" value="" size="40">
                        <span class="wpuf-help"></span>
                    </div>

                </li>
                <li class="wpuf-el google_plus">        
                    <div class="wpuf-label">
                        <label for="wpuf-google_plus">年龄</label>
                    </div>
    
                    <div class="wpuf-fields">
                        <input class="textfield" id="google_plus" type="text" data-required="no" data-type="text" name="google_plus" placeholder="How old are you？" value="" size="40">
                        <span class="wpuf-help"></span>
                    </div>

                </li>
                <li class="wpuf-el gui_chengshi">        
                    <div class="wpuf-label">
                        <label for="wpuf-gui_chengshi">院校</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="gui_chengshi" type="text" data-required="no" data-type="text" name="gui_chengshi" placeholder="目前就读/毕业于" value="" size="40">
                        <span class="wpuf-help"></span>
                    </div>

                </li>
                <li class="wpuf-el user_url">        
                    <div class="wpuf-label">
                        <label for="wpuf-user_url">个人网站</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="user_url" type="text" data-required="no" data-type="text" name="user_url" placeholder="例如：http://www.gameui.cn" value="" size="40">
                        <span class="wpuf-help"></span>
                    </div>

                </li>
                <li class="wpuf-el aim">        
                    <div class="wpuf-label">
                        <label for="wpuf-aim">新浪微博</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="aim" type="text" data-required="no" data-type="text" name="aim" placeholder="例如：http://weibo.com/gameui" value="" size="40">
                        <span class="wpuf-help"></span>
                    </div>

                </li>
                <li class="wpuf-el qq_weibo">        
                    <div class="wpuf-label">
                        <label for="wpuf-qq_weibo">腾讯微博</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="qq_weibo" type="text" data-required="no" data-type="text" name="qq_weibo" placeholder="例如：http://t.qq.com/gameui_cn" value="" size="40">
                        <span class="wpuf-help"></span>
                    </div>

                </li>        
                <li class="wpuf-submit">
                    <div class="wpuf-label">
                        &nbsp;
                    </div>

                    <input type="hidden" id="_wpnonce" name="_wpnonce" value="59237f21a5"><input type="hidden" name="_wp_http_referer" value="/registration">            <input type="hidden" name="form_id" value="9024">
                    <input type="hidden" name="page_id" value="9026">
                    <input type="hidden" name="action" value="wpuf_submit_register">
                    <input type="submit" name="submit" value="注册">
                </li>
                </ul></form>
            </div>
        </div>
        <!-- END .post -->
          
        <script type="text/javascript">   
            $("#submitbtn").click(function() {   
                $('#result').html('<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" class="loader" />').fadeIn();   
                var input_data = $('#wp_signup_form').serialize();   
                $.ajax({   
                    type: "POST",   
                    url:  "<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",   
                    data: input_data,   
                    success: function(msg){   
                        $('.loader').remove();   
                        $('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');   
                    }   
                });   
                return false;   
            });   
        </script>   
        <?php   
        }else{   
            echo "对不起暂时不开放注册，请以后再试.";   
        } 
    ?>   
    </div>   
    </div>   
    <?php   
        get_footer(); //加载底部文件   
}  
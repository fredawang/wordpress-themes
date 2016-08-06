<?php     
/* 
Template Name: 自定义注册页面模板  
*/     
?> 
<?php 

global $wpdb, $user_ID; //glocal全局变量 
if (!$user_ID) { //如果存在$user_ID变量，则用户已经登录   
   //接下来的代码都添加在这里.     
}else{   
   wp_redirect( home_url() ); exit; //如果已经登录，重定向到站点首页   
}   
 


if($_POST){   
    //验证数据是否全部为空格  
    $username = $wpdb->escape($_REQUEST['user_login']);   
    if(empty($username)) {   
        echo "用户名不能为空.";   
        exit();   
    }   
    $email = $wpdb->escape($_REQUEST['user_email']);   
    //验证邮箱格式   
    if( !is_email($email) ) {   
        echo "请输入有效的邮箱地址.";   
        exit();   
    }   
       
    //生成密码   
    $passwd = $wpdb->escape($_REQUEST['pass1']); 
    $re_passwd = $wpdb->escape($_REQUEST['pass2']); 
    if($re_passwd != $passwd ){
        echo "两次密码不一致.";   
        exit();
    }
    if(empty($passwd) && strlen($passwd) < 6){
        echo "请输入有效的密码.";   
        exit(); 
    }
	$user_nicename = $wpdb->escape($_REQUEST['nickname']); //昵称
	$user_profession = $wpdb->escape($_REQUEST['gsposition']); //职业
	$description = $wpdb->escape($_REQUEST['description']); //个人说明
	$user_city = $wpdb->escape($_REQUEST['user_city']); //城市
	$user_work = $wpdb->escape($_REQUEST['company']); //目前就职
    $user_avatar = $wpdb->escape($_REQUEST['avatar']); //腾讯微博
	$user_game_age = $wpdb->escape($_REQUEST['user_game_age']); //游戏行业年限
	$user_qq = $wpdb->escape($_REQUEST['qq']); //QQ
	$user_age = $wpdb->escape($_REQUEST['user_age']); //年龄
	$user_university = $wpdb->escape($_REQUEST['user_university']); //院校
	$user_url = $wpdb->escape($_REQUEST['user_url']); //个人网站
	$user_xinlang = $wpdb->escape($_REQUEST['user_xinlang']); //新浪微博
	$user_tengxun = $wpdb->escape($_REQUEST['qq_weibo']); //腾讯微博
	
    //创建用户   
    $userdata = array(
        'user_login'  =>  $username,
		'user_nicename' => $user_nicename,
		'user_profession' => $user_profession,
        'user_pass'    =>  $passwd,
        'user_email'   =>  $email,
		'description' => $description,
		'user_city' => $user_city,
		'user_work' => $user_work,
        'simple_local_avatar' => $user_avatar,
		'user_game_age' => $user_game_age,
		'user_qq' => $user_qq,
		'user_age' => $user_age,
		'user_university' => $user_university,
		'user_url' => $user_url,
		'user_xinlang' => $user_xinlang,
		'user_tengxun' => $user_tengxun
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
     <script src="<?php bloginfo('template_url'); ?>/js/lib/plupload.full.min.js"></script> <!-- 如果你的主题没有引入了jquery，请自己引入 -->   
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/register.css" type="text/css" media="all" /> 
    <div id="container">   
    <div id="content">   
    <?php   
    
        //get_option('users_can_register')获取是否允许注册   
        if(get_option('users_can_register')) {   
        ?>
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
                        <span class="wpuf-help">可用大小写字母，数字和符号，例如：~！@#$%</span>
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
                        
                        <script type="text/javascript">
							function setStyle(style){
								var word_map ={
									"weak":"弱",
									"medium":"中",
									"strong":"强"
								}
								var style_map={
									"weak":"short",
									"medium":"good",
									"strong":"strong"
								}
								$("#pass-strength-result").html(word_map[style]);
								$("#pass-strength-result").removeClass("short good strong").addClass(style_map[style]);
							}
                            function checkPassword(Password){
								var rules=[{
									reg:/\d+/,
									weight:2
								},{
									reg:/[a-z]+/,
									weight:4
								},{
									reg:/[A-Z]+/,
									weight:8
								},{
									reg:/[~!@#\$%]/,
									weight:16
								}];
								
								var weight=0;
								for(var j=rules.length-1;j>=0;j--){
									if(rules[j].reg.test(Password)){
										weight|=rules[j].weight;
									}
								}
								
								if(weight<=10){
									return "weak";
								}
								else if(weight<=20){
									return "medium";
								} else{
									return "strong";
								}
							}
                            $("#pass1").keyup(function(){
								var password = $(this).val();
								var style = checkPassword(password);
								setStyle(style);
							});
							$("#pass2").keyup(function(){
								if($("#pass1").val() !== $("#pass2").val()){
									$("#pass-strength-result").html("密码不一致");
									$("#pass-strength-result").removeClass("short good strong").addClass("short");
								} else{
									$("#pass-strength-result").html("密码一致");
									$("#pass-strength-result").removeClass("short good strong").addClass("strong");
								}
							});
							
                        </script>
                    </div>
            
                </li>
                <li class="wpuf-el avatar">        
                    <div class="wpuf-label">
                        <label for="wpuf-avatar">上传头像</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <div class="wpuf-img-container">
                            <img class="wpuf-img-avatar" src=""/>
                            <input type="hidden" class="wpuf-img-avatar-val" name="avatar" >
                        </div>
                        <div id="wpuf-avatar-upload-container" style="position: relative;">
                            <div class="wpuf-attachment-upload-filelist">
                                <a id="wpuf-avatar-pickfiles" class="button file-selector" href="#" style="z-index: 0;">选择图像</a>
                                <span class="wpuf-file-validation" data-required="no" data-type="file"></span>
                                <ul class="wpuf-attachment-list thumbnails"></ul>
                            </div>
                            <!--<div id="p1amfv5if815fm1hs918gjjs1gk20_html5_container" class="plupload html5" style="position: absolute; width: 80px; height: 40px; overflow: hidden; z-index: -1; opacity: 0; top: 0px; left: 0px; background: transparent;">
                                <input id="p1amfv5if815fm1hs918gjjs1gk20_html5" style="font-size: 999px; position: absolute; width: 100%; height: 100%;" name="user-upload-avatar" type="file" accept="image/jpeg,image/gif,image/png,image/bmp">
                            </div>-->
                       </div>
                       
                       <span class="wpuf-help">头像尺寸为75X75像素的方正形，JPG格式为佳，不能超过50KB，文件名不能包含中文</span>
                    </div> 
                    
                    <script type="text/javascript">
                        /*jQuery(function($) {
                            new WPUF_Uploader('wpuf-avatar-pickfiles', 'wpuf-avatar-upload-container', 1, 'avatar', 'jpg,jpeg,gif,png,bmp', 50);
                        });*/
                        var uploader = new plupload.Uploader({
                            browse_button : 'wpuf-avatar-pickfiles' ,//触发文件选择对话框的按钮，为那个元素id
                            url:'/xampp/htdocs/wordpress/wp-admin/admin-ajax.php?action=avatar',//'<?php bloginfo('template_url'); ?>/functions/upload-avatar.php',
                            filters: {
                              mime_types : [ //只允许上传图片和zip文件
                                { title : "Image files", extensions : "jpg,gif,png" }
                              ],
                              max_file_size : '50kb', //最大只能上传50kb的文件
                              prevent_duplicates : true //不允许选取重复文件
                            }
                        }); 
                        uploader.init();
                        uploader.bind('FilesAdded',function(uploader,files){
                            uploader.start();
                        });
                        uploader.bind('FileUploaded',function(uploader,files, res){
                            var resObj = JSON.parse(res.response);
                            console.log(resObj.data.url);
                            $(".wpuf-img-avatar").attr("src", resObj.data.url);
                            $(".wpuf-img-avatar-val").val(resObj.data.url);
                        });
                      </script>
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
                <li class="wpuf-el user_city">        
                    <div class="wpuf-label">
                        <label for="wpuf-user_city">城市</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="user_city" type="text" data-required="no" data-type="text" name="user_city" placeholder="所在城市" value="" size="40">
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
                <li class="wpuf-el user_game_age">        
                    <div class="wpuf-label">
                        <label for="wpuf-user_game_age">游戏行业年限</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <select name="user_game_age" data-required="no" data-type="select">
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
                <li class="wpuf-el user_age">        
                    <div class="wpuf-label">
                        <label for="wpuf-user_age">年龄</label>
                    </div>
    
                    <div class="wpuf-fields">
                        <input class="textfield" id="user_age" type="text" data-required="no" data-type="text" name="user_age" placeholder="How old are you？" value="" size="40">
                        <span class="wpuf-help"></span>
                    </div>

                </li>
                <li class="wpuf-el user_university">        
                    <div class="wpuf-label">
                        <label for="wpuf-user_university">院校</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="user_university" type="text" data-required="no" data-type="text" name="user_university" placeholder="目前就读/毕业于" value="" size="40">
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
                <li class="wpuf-el user_xinlang">        
                    <div class="wpuf-label">
                        <label for="wpuf-user_xinlang">新浪微博</label>
                    </div>
        
                    <div class="wpuf-fields">
                        <input class="textfield" id="user_xinlang" type="text" data-required="no" data-type="text" name="user_xinlang" placeholder="例如：http://weibo.com/gameui" value="" size="40">
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

                    <!--<input type="hidden" id="_wpnonce" name="_wpnonce" value="59237f21a5"><input type="hidden" name="_wp_http_referer" value="/registration">            <input type="hidden" name="form_id" value="9024">
                    <input type="hidden" name="page_id" value="9026">
                    <input type="hidden" name="action" value="wpuf_submit_register">-->
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
                console.log(input_data);
                input_data["avatar"] = $(".wpuf-img-avatar").attr("src");
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
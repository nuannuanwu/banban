<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html style="height: 100%;margin: 0; padding: 0; border: 0;overflow-x: auto;">
<head> 
	<meta charset="UTF-8">
    <?php if('product'==BANBAN_ENVIRONMENT):?>
    <meta property="qc:admins" content="155124117662162166157" /><!-- QQ登录验证 -->
    <?php else: ?>
    <meta property="qc:admins" content="15512415605340061401170166375" /><!-- QQ登录验证 -->
    <?php endif; ?>
	<meta name="renderer" content="webkit|ie-comp">
    <title>班班 - 国内首款基于"班级"为单位，30万老师的家校沟通专属社交应用。班班客服：400 101 3838</title>
    <meta name="keywords" content="班班,班班网,班务管理,作业通知,蜻蜓校信,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,教育,家校,平台,沟通,社交,班费,青豆,老师,家长">
    <meta name="description" content="班班是国内首款基于'班级'为单位，面向老师与家长之间，家长与家长之间的教育专属社交应用。班班是30万老师的家校沟通首选专属工具，比Q群、微信更实用。班班为老师家长提供一种全新的、专属的沟通和社交方式，为班级提供全新的管理增值服务方式。">
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/image/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/newstyle.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
    
    <script type="text/javascript">
//        $(function () {
//            //检测IE
//            if ($.browser.msie && $.browser.version == "6.0") {
//                window.location.href = 'ie6update.html';
//            };
//        }); 
    </script>
    <style>
        .error_info{display: inline;}
        .login-type .other-login .navMod{
            margin-top:5px;
            text-align: left;
        }
        .login-type .other-login .navMod .return{
            display: inline-block;
            margin-right:5px;
            vertical-align: middle;
        }
        .login-type .other-login .navMod a{
            color: #333!important;
            background-color: #f3f3f3!important;
            border-color: #d7d7d7;  
            font-size:12px!important;
            padding:2px 15px!important;
            border-radius: 2px!important;
            margin-right:15px;
        }
        .login-type .other-login .navMod a:hover{
            border-color: #d7d7d7!important;
        } 
        .reminder{ width: 548px; background-color: #fff; border:1px solid #ccc; position: fixed; right:20px; bottom:20px; z-index: 100; box-shadow: 0 0 5px #ccc; -moz-box-shadow: 0 0 5px #ccc;-webkit-box-shadow: 0 0 5px #ccc;-o-box-shadow: 0 0 5px #ccc;-ms-box-shadow: 0 0 5px #ccc;}
        .reminderTit{ height:44px; line-height: 44px;font-family: "微软雅黑"; font-size: 17px; color: #fff; background:#f59201 url('/image/xiaoxin/reminderIco.png') no-repeat 15px 12px; padding-left:45px;}
        .reminder em.colse{ position: absolute; right:0; top:0; width:44px; height:44px; display: block; text-indent: -999em; overflow:hidden; font-family:"微软雅黑"; font-size: 20px; color: #FFF; cursor: pointer; font-style: normal;background:url('/image/xiaoxin/reminderIco.png') no-repeat center -68px;}
        .reminder em.colse:hover{ opacity: 0.8;}
        .reminderCom{ font-size: 13px;font-family: "微软雅黑"; padding:20px;}
        .reminderCom span{ color: #f37112;}
    </style> 
</head>
<body style="position: relative; zoom: 1;min-width:1000px;margin:0 auto;">
    <div id="layoutBodyBox" class="layoutBox" style="overflow: hidden;zoom: 1;">
        <div id="contentBox">
        
        <!-- <div class="reminder" >
            <em class="colse">x</em>
            <div class="reminderTit">系统公告</div> 
            <div class="reminderCom">尊敬的班班用户：<br/> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;由于各位上帝的高度热情支持与关注，班班用户数量呈火山爆发式增长，服务器对日后的工作强度表示压力山大。为此需要给服务器配备更强劲的动力，让各位上帝享用到更嗨的产品，更舒心的服务。5月30日（本周六）7:30至10:00，我们将对服务器硬件配置进行整体升级，届时班班应用、网页端将暂停营业，不过班班官网还阔以正常开门迎客哦。服务器加油增能期间给您带来的不便请各位上帝多多理解！阿门！
            <span> 400-101-3838</span>
                <p style=" text-align: right;">深圳蜻蜓互动科技有限公司</p>
                <p style=" text-align: right;">2015年3月27日</p>
            </div>
		</div> -->
        <div id="bannerBox" class="bannerBox" style="width: 100%;">
            <div id="banner" class="banner" style="background-color:#E5E4DA;">
                <?php include('theader.php'); ?> 
                <div class="formBox" style="position: relative;">
                    <div class="login">
                        <div class="login-type" id="loginType">
                            <div class="login-btns">
                                 <a href="javascript:;" class="active border-right">班班登录</a><a href="javascript:;" id="thirdBtn" class="border-left">合作机构登录</a>
                            </div>

                            <!-- 班班登录 -->
                            <div class="login-c">
                                <!-- <div class="title">
                                    帐号登录
                                </div> -->
                                <!-- form -->
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'formBoxRegister',
                                    // Please note: When you enable ajax validation, make sure the corresponding
                                    // controller action is handling ajax validation correctly.
                                    // There is a call to performAjaxValidation() commented in generated controller code.
                                    // See class documentation of CActiveForm for details on this.
                                    'enableAjaxValidation'=>false,
                                )); ?>
                                <div class="loginBar ">
                                    <div class="input userName">
                                        <span class="valueSpan" style="color: rgb(153, 153, 153); display: block;">手机号</span>
                                        <input id="username" name="ULoginForm[username]" value="" type="text" maxlength="30" id="ContentPlaceHolder1_txtTelephone" class="textInput" size="11" autocomplete="off" value="<?php echo $model->username; ?>">
                                    </div>
                                    <div class="input password">
                                        <span class="valueSpan" style="color: rgb(153, 153, 153);">密码</span>
                                        <input id="password" name="ULoginForm[password]" value=""  type="password" maxlength="16" id="ContentPlaceHolder1_txtPwd" class="textInput" autocomplete="off">
                                    </div>
                                    <div class="rememberme">
                                        <a href="<?php echo Yii::app()->createUrl('site/getpwd');?>" class="right green">忘记密码？</a> 
                                        <!--<a href="<?php echo Yii::app()->createUrl('banban/default/activeverify');?>" class="right green" style="margin-right: 10px;">激活帐号</a>-->
                                        <input id="rememberme" type="checkbox" style=" display: none;" name="rememberme" >
                                        <label id="remembermeInfo" class="remembermeInfo" tip="0"><em class="unCheked"></em>下次自动登录</label>
                                        <input id="remembermeHidden" type="hidden" name="ULoginForm[rememberMe]" value="0">
                                    </div>
                                    <div class="clearfix" style="height: 24px; padding:5px 0px;">
                                        <span class="errorSpan" style="color: #EE0000;">
                                            <?php echo $form->error($model,'role',array('class'=>'error_info')); ?> 
                                            <?php echo $form->error($model,'username',array('class'=>'error_info')); ?>  
                                            <?php echo $form->error($model,'password',array('class'=>'error_info')); ?> 
                                            <?php echo $notTeacherError ? $notTeacherError : '';?>
                                        </span>
                                        <span class="errorSpan errorSpanTip"  style="color: #EE0000;"></span>
                                    </div> 
                                    <div class="botton">
                                        <div id="lbtnLogin" class="btn loginBtn" style="float:left; background-color: #f59201;" alt="老师登录" title="家长请下载手机应用客户端登录使用">
                                            老师登录
                                        </div>
                                        <a title="老师注册有大礼包赠送哦" href="<?php echo Yii::app()->createUrl('openregister/index')?>"  id="lbtnLogin" class="btn blueBtn"style="background-color: #f5f4eb; color: #000000;" alt="班班注册">
                                            注  册
                                        </a>
                                    </div>
                                </div>
                                <?php $this->endWidget(); ?>
                                <div class="qq-weixin-wrapper" style=" ">
                                    <a href="<?php echo Yii::app()->createUrl('connect/qq')?>" class="left"> 
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/qq.png" />
                                        <span>QQ登录</span>
                                    </a>
                                    <a href="<?php echo $wxLoginUrl; ?>" class="right">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/weixin.png" />
                                        <span>微信登录</span>
                                    </a>
                                </div>
                            </div>
                            <!-- 班班登录 end -->

                            <!-- 第三方登录 -->
                            <div class="login-c other-login" style="display:none;position:relative;">
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'formBoxThird',
                                    // Please note: When you enable ajax validation, make sure the corresponding
                                    // controller action is handling ajax validation correctly.
                                    // There is a call to performAjaxValidation() commented in generated controller code.
                                    // See class documentation of CActiveForm for details on this.
                                    'enableAjaxValidation'=>false,
                                )); ?> 
                                    <div class="other-login-type">
                                    <?php foreach($loginSets as $v ):?>
                                        <a id="area_<?php echo isset($v['areaid'])?$v['areaid']:'';?>" href="javascript:;" data-url="<?php echo isset($v['loginurl'])?$v['loginurl']:'';?>" data-id="<?php echo isset($v['areaid'])?$v['areaid']:'';?>">
                                        <img src="<?php echo isset($v['logo'])?$v['logo']:''; ?>" alt="返回" />
                                        </a>
                                    <?php endforeach;?>
                                    </div>
                                    <div class="other-login-c">
                                        <div class="navMod">
                                            <a href="javascript:;" class="btn return-btn" ><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt=""></a>
                                            <img id="type-logo" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/loginType1.jpg" style="margin-bottom: 10px;width:120px;vertical-align: middle;"/>
                                        </div>
                                        <div class="loginBar ">
                                            <div class="input userName">
                                                <span class="valueSpan" style="color: rgb(153, 153, 153); display: block;">用户名</span>
                                                <input type="hidden" name="areaId" id="unionLoginId"/>
                                                <input id="thirdUsername"  style="width:216px;" name="unionAccount" type="text" maxlength="30" class="textInput" size="11" autocomplete="off" value="<?php echo $model->username; ?>">
                                            </div>
                                            <div class="input password" style="margin-bottom:0;">
                                                <span class="valueSpan" style="color: rgb(153, 153, 153);">密码</span>
                                                <input id="thirdPassword"  style="width:216px;"  name="unionPwd" type="password" maxlength="16" class="textInput" autocomplete="off">
                                            </div>
                                            <div class="thirdErrorSpan thirdErrorSpanTip" style="color: #EE0000;text-align: left;margin:5px 0;height:24px;">&nbsp;<?php echo $unionLoginError;?></div>
                                            <a id="thirdLoginBtn"  class="btn" href="javascript:void(0);" style="display:block; border: 1px solid #f59201; padding:6px 20px;background-color: #f59201;">
                                                登录
                                            </a>
                                        </div>
                                    </div>
                                    <div class="loading" id="loading"></div>
                                 <?php $this->endWidget(); ?> 
                            </div>
                            <!-- 第三方登录 end -->
                        </div> 
                         <!-- form -->
                    </div>
                </div>
            </div>
        </div>
        <div id="download" class="download">
            <ul class="downloadListBox">
                <li style=" width: 52.66%;">
                    <div class="fleft" style=" border: 1px #E5E4DA solid; padding: 5px;">
                        <a class="icogfxz">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban//logo/erxiaoxin150.png" width="100" high="100" alt="班班二维码下载"/>
                        </a> 
                        <p >扫描二维码下载</p>
                    </div>
                    <div style=" margin-left: 130px; ">
                        <div style=" text-align: left; color: #000000; font-size: 16px; margin: 20px 0;">免费发送到手机：</div>
                        <div style=" width: 260px; height: 40px; overflow: hidden; border: 1px #cccccc solid; border-radius: 3px; text-align: left;" >
                            <form style="width: 100%; margin-top: 2px; ">
                                <div class="input sendPhoneCode" style=" position: relative;">
                                    <a href="javascript:;" id="sendPhoneBtn" class="btns btns-orange" style=" float: right; text-decoration: none; margin-right: 5px;  padding: 5px 20px;">发送</a>
                                        <span class="valueSpan" style="display: block;  position: absolute;  left: 10px;  top: 0; font-size: 14px; height: 34px;  line-height: 38px; z-index: 5;color: rgb(153, 153, 153); border: none;">请输入手机号</span>
                                        <input id="sendPhoneCode" class="textInput"  type="text" maxlength="11" style=" height: 36px; line-height: 36px; border: none; margin-left: 10px;" onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')" value=""/>
                                 </div>
                               
                            </form>
                        </div>
                        <div id="senPhoneTip" class="colorS" style="font-size:13px; text-align: left; color: #EE0000;"></div>
                    </div>
                </li>
                <li style=" width: 23.3%;">
                    <div style=" text-align: left; color: #000000; font-size: 16px; margin: 20px 0;">&nbsp;</div>
                    <a class="iocM icogfIos" href="<?php echo WEB_IOS_DOWNLOAD_URL;?>" target="_blank" title="班班ios下载">iPhone版下载</a>  
                </li>
                <li style=" width: 23.3%;">
                    <div style=" text-align: left; color: #000000; font-size: 16px; margin: 20px 0;">&nbsp;</div>
                    <a class="iocM icogAndroid" href="<?php echo WEB_ANDROID_MOLO_DOWNLOAD_URL;?>" target="_blank" title="班班安卓下载">Android版下载</a> 
                </li> 
            </ul>
        </div>
        <?php include('tfooter.php'); ?> 
        
        </div>
        <div id="popupBox" class="reminder"  style=" display: none; height: 300px; overflow: hidden; z-index: 10101; border: none;">
            <em class="colse" onclick="hidePormptMaskWeb('#popupBox')">x</em>
            <div class="reminderTit">合作学校管理平台</div> 
            <div class="reminderCom"> 
                  <div class="formBox" style="position: relative;">
                      <div class="login" style=" width: 80%; border: none; background: none;">
                        <div class="login-type">
                            <div class="loginBar ">
                                <div class="input userName">
                                    <span class="valueSpan" style="color: rgb(153, 153, 153); display: block;">用户名</span>
                                    <input type="hidden" name="areaId" id="unionLoginId"/>
                                    <input id="thirdUsername"  style="width:216px;" name="unionAccount" type="text" maxlength="30" class="textInput" size="11" autocomplete="off" value="<?php echo $model->username; ?>">
                                </div>
                                <div class="input password" style="margin-bottom:0;">
                                    <span class="valueSpan" style="color: rgb(153, 153, 153);">密码</span>
                                    <input id="thirdPassword"  style="width:216px;"  name="unionPwd" type="password" maxlength="16" class="textInput" autocomplete="off">
                                </div>
                                <div class="thirdErrorSpan thirdErrorSpanTip" style="color: #EE0000;text-align: left;margin:5px 0;height:24px;">&nbsp;<?php echo $unionLoginError;?></div>
                                <a id="thirdLoginBtn"  class="btn" href="javascript:void(0);" style="display:block; border: 1px solid #f59201; padding:6px 20px;background-color: #f59201;">
                                    登录
                                </a>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div> 
    </div>
    <script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/banban/input.js'); ?>"></script>
<!--    <script type="text/javascript" src="--><?php //echo MainHelper::AutoVersion('/js/banban/index.js'); ?><!--"></script>-->
    <!--<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>-->
    <script type="text/javascript">
        function AutoHeight() {//根据浏览器大小控制网页大小
            var Height_Page = window.document.body.clientHeight; 
            var Height_Page_Using = document.documentElement.clientHeight;
            var Width_Page = window.document.body.clientWidth;
            var Width_Page_Using = document.documentElement.clientWidth;
            var Banner =document.getElementById("banner"); 
            if(getBrowser() == "msie7.0" || getBrowser() == "msie6.0" || getBrowser() == "msie5.0"){  
                //var Width_Sider = Sider.offsetWidth;
                //var Height_Crumb = Crumb.offsetHeight; 
                //若以上无效，则采用(主要是IE6.0，5.0需要)
                if(Height_Page > Height_Page_Using){
                    Height_Page = Height_Page_Using;
                }
                if(Width_Page>Width_Page_Using){
                    Width_Page =Width_Page_Using;
                }
                initPage(Height_Page);
                if(Width_Page<920){
                    Banner.style.width='780px';
                }else{
                    Banner.style.width='920px';
                }
            }else{
                initPage(Height_Page);  
            }
        }
         //页面初始化
        function  initPage(pageHeight){
            var Layout = document.getElementById("layoutBodyBox");  
            var Banner =document.getElementById("bannerBox"); 
            var Dow = document.getElementById("download"); 
            var Footer = document.getElementById("footer"); 
            var Height = Layout.offsetHeight,Dh =Dow.offsetHeight,Bh =Banner.offsetHeight,Fh=Footer.offsetHeight;
            if(Height>pageHeight){
                pageHeight = Height; 
                Dow.style.marginBottom =(pageHeight-Dh-Bh-Fh)+"px";
            }else{
               Dow.style.marginBottom =(pageHeight-Dh-Bh-Fh)+"px";
            }
            Layout.style.height = pageHeight+"px";
        }
       
        function getBrowser() {//浏览器判断
            var Sys = {};
            var ua = navigator.userAgent.toLowerCase();
            var re = /(msie|firefox|chrome|opera|version).*?([\d.]+)/;
            var m = ua.match(re);
			if(m&&m[1]){
				Sys.browser = m[1].replace(/version/, "'safari");
				Sys.ver = m[2];
				return Sys.browser + Sys.ver;
			}else{
				return '';
			}
        } 
        window.onresize = function() {//改变浏览器大小的时候触发
            AutoHeight(); 
        };
        window.onload = function() {//页面加载触发
            AutoHeight(); 
        }; 
//        //选择老师
//        $("[rel=selectStatus]").click(function(){
//            $(this).addClass('status');
//            $(this).siblings('a').removeClass('status'); 
//            $("#radioBoxValue").val($(this).attr('tip'));
//        });
        //记住密码
        $("#remembermeInfo").click(function(){
            var tip = $(this).attr('tip');
            if(tip=='0'){
                $("#rememberme").attr("checked",'checked');
                $("#remembermeInfo").find('em').removeClass('unCheked').addClass('cheked');
                $("#remembermeHidden").val('1');
                $(this).attr('tip','1');
            }else{
                $("#remembermeInfo").find('em').removeClass('cheked').addClass('unCheked');
                $("#remembermeHidden").val('0');
                $("#rememberme").removeAttr("checked");
                $(this).attr('tip','0');
            } 
        });
        function loginSubmit(){
            var username =$("#username").val();
            var password =$("#password").val();
            if(username==""||password==""){
               $('.errorSpanTip').text('用户名或密码不能为空');
               $('.error_info').text('');
            }else{
                
                $('#formBoxRegister').submit();
            } 
        }
        $('#lbtnLogin').click(function(){ 
            loginSubmit();
        });

        $('#password').keydown(function(){
            var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
            if (event.keyCode == 13){
                loginSubmit();
            }
        });

        $('#thirdPassword').keydown(function(){
            var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
            if (event.keyCode == 13){
                var username =$("#thirdUsername").val();
                var password =$("#thirdPassword").val();
                 if(username=="" || password==""){
                    $('.thirdErrorSpan').text('用户名或密码不能为空');
                    //$('.error_info').text('');
                }else{
                     $('#formBoxThird').submit();
                }
              

            }
        });

        var loginType = function(){
            var loginBox=$('#loginType');
            loginBox.find('.login-btns').on('click','a',function(){
                var type = $(this).index();
                $(this).addClass('active').siblings().removeClass('active');
                loginBox.find('.login-c').eq(type).show().siblings('.login-c').hide();
                $('.other-login-type').show();
                $('.other-login-c').hide();
            });

            $('.other-login-type').on('click','a',function(){
                var id=$(this).data('id');
                var url=$(this).data('url');
                var imgUrl=$(this).find('img').attr('src');
                $('#type-logo').attr('src',imgUrl);
                $(this).parent().hide();
                $('.other-login-c').show();
                $('#thirdLoginBtn').attr('data-id',id);
                $('#unionLoginId').val(id);
                $('#thirdLoginBtn').attr('data-url',url);
                
            })
            $('.return-btn').click(function(){
                 $('.other-login-type').show();
                 $('.other-login-c').hide();
                 $('.thirdErrorSpan').text('');
            })

             $('#thirdLoginBtn').click(function() {
                var username =$("#thirdUsername").val();
                var password =$("#thirdPassword").val();
                 if(username=="" || password==""){
                    $('.thirdErrorSpan').text('用户名或密码不能为空');
                    //$('.error_info').text('');
                }else{
                     $('#formBoxThird').submit();
                }
            });
        }

        $(function() {
            loginType();
            var third = parseInt('<?php echo (int)Yii::app()->request->getParam('areaId')?>');
            if (third) {
                $('#thirdBtn').click();
                //$('.other-login-type').find('a:eq('+ <?php echo (int)Yii::app()->request->getParam('id')-1?> +')').click();
                $('#area_' + third).click();
            }
        });
    </script>
    <script type="text/javascript">
        $(function(){
            function ajaxPost(url,mobile){
                var str ="xx";
                $.ajax({  
                    url:url,   
                    type : 'POST',
                    data : {mobile:mobile},
                    dataType : 'json',  
                    async : false,
                    contentType : 'application/x-www-form-urlencoded', 
                    success : function(mydata) {
                        str = mydata;                
                    },  
                    error : function() {  
                        // alert("calc failed");  
                        str = "系统繁忙,请稍后再试";
                    }  
                });
                return str;
            }
            
            $('#sendPhoneBtn').click(function(){
                var phone = $('#sendPhoneCode').val(),url = '<?php echo Yii::app()->createUrl('ajax/sendsmsbydownload');?>'; 
                var text ='';
                if(phone){
                    var str = ajaxPost(url,phone);
                    if (str.status == 1) {
                        var textColor = "#B4EB7C";
                    } else {
                        var textColor = "#EE0000";
                    }
                    text = str.msg;
                    $('#senPhoneTip').text(text).css('color', textColor);
                }else{
                    text = '请输入手机号';
                    $('#senPhoneTip').text(text).css('color', textColor);
                } 
                $('#sendPhoneCode').val('');
            });
            $('#sendPhoneCode').live('focus',function(e){
                $('#senPhoneTip').text('');
            });
        });
    </script>
     <script type="text/javascript"> 
          
        $(".reminder .colse").click(function() {
            $(this).parent('.reminder').hide();
        });

        $(document).ready(function() {
            window.setTimeout(function() {
                if ($('#username').val() != "") {
                    var textInputs = $('.login').find('.textInput');
                    textInputs.each(function (i, item) {
                        $(item).parent().find(".valueSpan").hide();
                    });
                }
            }, 400);
        });
     </script>
    <?php //Yii::app()->msg->printMsg();?>
</body>
</html> 

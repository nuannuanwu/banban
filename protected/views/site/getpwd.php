<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html style=" height: 100%;">
<head> 
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit|ie-comp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
    <meta name="keywords" content="班班,班班网,班务管理,作业通知,蜻蜓校信,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,教育,家校,平台,沟通,社交,班费,青豆,老师,家长">
    <meta name="description" content="班班是国内首款基于'班级'为单位，面向老师与家长之间，家长与家长之间的教育专属社交应用。班班是30万老师的家校沟通首选专属工具，比Q群、微信更实用。班班为老师家长提供一种全新的、专属的沟通和社交方式，为班级提供全新的管理增值服务方式。">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/getpwd.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script> 
    <style>
        .error_info{display: inline;}
    </style>

</head>
<body id="layoutBodyBox"  style=" height: 100%;" >
    <div id="contentBox" class="layout_div">
        <div class="header">
             <div class="tell">
                <p>客服电话</p>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/telIco.png"/> 
            </div> 
            <div class="logo" style="line-height: 96px;">
                <a href="<?php echo Yii::app()->createUrl('')?>"> 
                    <img style=" display: inline-block; float: left;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/logo.png"/>
                </a>
                <div class="muneBox" style="">
                    <a href="<?php echo Yii::app()->createUrl('site/login')?>" >首页</a>
                    <a href="<?php echo Yii::app()->createUrl('site/banban')?>">班班介绍</a>
                    <a href="<?php echo Yii::app()->createUrl('dynamic/banbandynamic')?>">班班动态</a> 
                </div> 
            </div>
        </div>
        <div class="layout_main">
            <h1 class="headTitle">欢迎您注册使用班班产品！</h1>
            <div class="layout_conrent">
                <div class="rSubBox fright"> 
                    <div class="imgBox">
                        <img width="150px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/erxiaoxin.png">
                        <h3>扫描二维码，下载班班手机应用</h3>
                    </div>
                    <ul>
                        <li>功能丰富，专业教育互动平台</li>
                        <li>互动形式多样，体验更佳</li>
                        <li>随时随地，自由沟通</li>
                    </ul>
                </div>
                <div class="mainBox"> 
                    <div class="formBox">
                        <div id="getPwdBox1" class="forgetpas ">
                            <h2>忘记密码</h2>
                            <p>
                                <span class="title">手机号：</span> 
                                <input type="text" class="moblie border" autocomplete="off" id="mobile" maxlength="11" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                                <input id="statusPhone" name="uid" type="hidden" value="">                               
                            </p> 
                            <p style=" color: #999;  padding-right: 22px; margin-bottom: 0;">
                                <span class="title">&nbsp;</span>为了验证身份，我们会给您发送验证短信。
                            </p>
                            <p class="error">
                                <span class="title">&nbsp;</span>
                                <span class="errorCTip"></span>
                            </p> 
                            <p class="btnBox">
                                <span class="title">&nbsp;</span>
                                <a href="javascript:;" tid="0" id="btnGetVerifyCode" class="btn btnColor1">下一步</a>
                            </p>
                        </div>
                        <div id="getPwdBox2" class="forgetpas" style="display:none;">
                            <h2>设定密码</h2>
                            <form id="formBoxRegister" action="" method="post">
                                <p>
                                    <span class="title">验证码：</span>
                                    <input class="code border" autocomplete="off" type="text" name="User[code]" id="user_code" value="">
                                    <input class="code" type="hidden" name="" id="codeVerify"> 
                                    <a href="javascript:;" id="codeBnt" class="codeBnt">重新发送</a>
                                    <input id="statusT" name="uidsss" type="hidden" value="0">
                                    <input id="user_mobile" name="User[mobile]" value="" type="hidden" >
                                </p> 
                                <p>
                                    <span class="title">输入新密码：</span>
                                    <input class="moblie border" autocomplete="off" type="password" maxlength="16" name="User[pwd]" id="user_password" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')">
                                    <input id="statusPhone" name="uid" type="hidden" value="">
                                </p>
                                <p style=" margin-bottom: 0;">
                                    <span class="title">确认新密码：</span>
                                    <input class="moblie border" autocomplete="off" type="password" maxlength="16" name="User[newpwd]" id="newpwd">
                                    <input id="statusPhone" name="uid" type="hidden" value="">
                                </p>
                                <p style=" color: #999;  padding-right: 22px; margin-bottom: 0;">
                                    <span class="title">&nbsp;</span>密码可以是6-16位数字、字母或两者组合。
                                </p>
                                <p class="error">
                                    <span class="title">&nbsp;</span>
                                    <span class="errorText"></span>
                                </p> 
                                <p class="btnBox">
                                    <span class="title">&nbsp;</span>
                                    <input id="userId" name="userId" type="hidden" name="" value="">
                                    <a href="javascript:;" tid="0" id="btnEditPwd" class="btn btnColor1">完成</a>
                                </p>
                            </form>
                        </div>
                    </div> 
                </div> 
            </div> 
        </div>
        <div class="footer">
         <p><!-- <a href="http://www.qthd.com/about.aspx?type=lianxi" target="_blank">联系我们</a>｜<a href="http://www.qthd.com/joinus.aspx" target="_blank">招聘信息</a>
             ｜<a href="http://www.qthd.com/about.aspx?type=lianxi" target="_blank">关于蜻蜓校信</a>
          ｜深圳蜻蜓互动科技有限公司 --> <a href="http://www.miibeian.gov.cn">粤ICP备14076064号-4</a></p>
        </div>
    </div>
     
    <div id="sensitiveWords">
        <div id="changeMobilePhone" class="popupBox" style="width: 396px;">
            <div class="headerde">确认手机号码<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#changeMobilePhone')" > </a></div>
            <div id="iSremindOk" class="remindInfo" style=" padding: 40px;" >
               
            </div> 
            <div class="popupBtn" style="text-align: center; padding:20px 0 0 0px;">
                <a id="iSGetCodeOk" href="javascript:void(0);"  class="btn btn-orange" data-val="">确认</a>&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#changeMobilePhone')" class="btn btn-default">取消</a>
            </div>
        </div>
    </div>

    <div id="passSuccess">
        <div id="passSuccessBox" class="popupBox" style="width: 396px;">
            <div class="headerde">温馨提示<a href="<?php echo Yii::app()->createUrl('site/login'); ?>" class="close" onclick="hidePormptMaskWeb('#passSuccessBox')" > </a></div>
            <div class="remindInfo" style=" padding: 40px;text-align:center;" >
                密码修改成功！
            </div> 
            <div class="popupBtn" style="text-align: center; padding:20px 0 0 0px;">
                <a id="ispassOk" href="<?php echo Yii::app()->createUrl('site/login'); ?>"  class="btn btn-orange" data-val="">确认</a>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/banban/input.js'); ?>"></script> 
    <script type="text/javascript">
    $(function(){
         var urls ="<?php echo Yii::app()->createUrl('ajax/sendmobilecode');?>";
         var urly ="<?php echo Yii::app()->createUrl('site/getpwd');?>"; 
        //计时器
        var countdown = 60;
        var off =true;
        function settime(val) { 
            if(!off){
              return;
            }
            if (countdown == 0) {  
                //val.removeAttribute("disabled");	
                val.text("重新发送"); 
                //val.value="免费获取验证码"; 
                val.css({background:'#39a9f6',color:"#ffffff"});
                countdown = 60; 
                return;
            } else { 
                //val.setAttribute("disabled",'disabled'); 
                val.text("(" + countdown + "s)后再发送"); 
                //val.value="（" + countdown + "）后再次获取";
                countdown--; 
            } 
            setTimeout(function() { 
                settime(val);
            },1000); 
         }
         //
         function ajaxPost(url,mobile){
            var str ="";
            $.ajax({  
                url:url,   
                type : 'POST',
                data : {ty:2,mobile:mobile},
                dataType : 'text',  
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {
                    str = mydata;
                    if (str == 2) {
                        str = '超过发送限制';
                    } else if(str == 3){
                        str = '该手机号码已绑定';
                    } else if (str == 0) {
                        str = '该手机号码未注册';
                    }
                },
                error : function() { 
                    str = "系统繁忙，请稍后再试";
                }  
            });
            return str;
        } 
         
        $("#mobile").keydown(function(){
            $('.errorCTip').text('');
        });
        
        //获取验证码
        $('#iSGetCodeOk').click(function(){
        	hidePormptMaskWeb('#changeMobilePhone');
            var mobile =$("#mobile").val(); 
            var str =ajaxPost(urls,mobile); 
            if(str==1){
                $('#getPwdBox2').show();$('#getPwdBox1').hide();
                $("#user_mobile").attr('value',mobile);
                $(this).css({background:'#cccccc',color:"#999999"});
                settime($('#codeBnt')); 
             }else{
                $('.errorCTip').text(str);
             }
        }); 
        
        $('#codeBnt').click(function(){            
            if(parseInt(countdown)==60){ 
            	var mobile =$("#mobile").val(); 
                var str =ajaxPost(urls,mobile); 
                if(str==1){
                    $(this).data('status',false);
                    $("#user_mobile").attr('value',mobile);
                    $(this).css({background:'#cccccc',color:"#999999"});
                    settime($(this)); 
                 }else{
                    $('.errorText').text(str);  
                 }
            }            
        }); 
        //确认手机
        $('#btnGetVerifyCode').click(function(){  
            var mobile =$("#mobile").val(); 
            var eg =/^((1)+\d{10})$/;
            //var role =$("#radioBoxValue").val();
            var strIfo ='我们将把验证码短信发送至手机：<span class="orange">'+mobile+'</span>' 
            if(mobile!=""){
                if(eg.test(mobile)){
                    $("#iSremindOk ").html(strIfo);
                    showPromptsRemind('#changeMobilePhone');
                }else{
                    $('.errorCTip').text('请输入正确的手机号码');
                } 
            }else{
              $('.errorCTip').text('手机号不能为空');
            } 
        });
        
        //修改密码
        $('#btnEditPwd').click(function(){ 
            setPwds(); 
        });
        //修改密码enter
        $('#newpwd').keydown(function(){
            var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
            if (event.keyCode == 13){
                setPwds(); 
            }
        });
        function setPwds(){
            var code = $.trim($('#user_code').val());
            var pwd =  $.trim($('#user_password').val());
            var newpwd = $.trim($('#newpwd').val());
            var mobile = $.trim($('#user_mobile').val());
            var f = checkPassword(pwd); 
            if(code==""){
                $('.errorText').text('请输入验证码').css("color",'red'); 
            }else{
                if(pwd!=""){
                    if(pwd.length>16||pwd.length<6){ 
                        $('.errorText').text('密码由6-16位数字、字母或组合').css("color",'red'); 
                    }else{
                        if(pwd!=newpwd){
                            $('#newpwd').val('');
                            $('.errorText').text('两次输入密码不一致').css("color",'red'); 
                        }else{
                            if(!f){
                                    $(".errorText").text("密码由6-16位数字、字母或组合").css("color",'red'); 
                             }else{
                                var url = "<?php echo Yii::app()->createUrl('site/resetpwd'); ?>";
                                var code = $.trim($('#user_code').val());
                               
                                $.ajax({  
                                    url:url,   
                                    type : 'POST',
                                    data : {mobile:mobile,code:code,pwd:pwd},
                                    dataType : 'text',  
                                    contentType : 'application/x-www-form-urlencoded',  
                                    async : false,  
                                    success : function(mydata) {

                                        if(mydata=='success'){
                                            showPromptsRemind('#passSuccessBox');
                                        }else{
                                             $('.errorText').text(''+mydata).css("color",'red'); 
                                        }
                                    },  
                                    error : function() { 
                                        str = "系统繁忙，请稍后再试";
                                    }  
                                });
                            } 
                        } 
                    } 
                }else if(pwd==""||newpwd==""){
                     $('.errorText').text('请输入密码').css("color",'red'); 
                }
            }
        } 
        //验证密码 
        function checkPassword(pwd) {
            // 长度为6到16个字符
            var reg = /^[0-9 | A-Z | a-z]{6,16}$/;
            //alert(reg.test(pwd));
            if (!reg.test(pwd)) {
                return false;
            }else{
                return true;
            }
            //return false;
            // 全部重复
//            var repeat = true;
//            // 连续字符
//            var series = true; 
           // var len = pwd.length;
//            var first = pwd.charAt(0);
//            for (var i = 1; i < len; i++) {
//                repeat = repeat && pwd.charAt(i) == first;
//                series = series && pwd.charCodeAt(i) == pwd.charCodeAt(i - 1) + 1;
//            }
           
        }
});
    </script>
</body>
</html>
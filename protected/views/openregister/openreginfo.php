<html style="height: 100%; overflow: hidden; margin: 0; padding: 0; border: 0;">
<head> 
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit|ie-comp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="keywords" content="班班,班班网,班班介绍,班务管理,作业通知,蜻蜓校信,蜻蜓班班,校信,校信通,校讯通,家校互动,家校沟通,班费,家校,青豆">
    <meta name="description" content="班班面向老师开放注册，是教育专属应用；班班让老师家长沟通更便捷，免费沟通还可得福利；班班多家属关注功能,与您共同呵护孩子成长。">
    <title>班班注册 - 免费开放注册，30万老师的家校沟通专属社交应用。班班客服：400 101 3838</title>
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/image/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/getpwd.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
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
    </style>
</head>
<body id="layoutBodyBox" style=" width: 100%; height: 100%; overflow-x:hidden; overflow-y:auto;"> 
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
            <h1 class="headTitle">欢迎您注册使用班班产品！！</h1>
            <div class="layout_conrent">
                <div class="rSubBox fright">
<!--                    <div class="imgBox">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/openregister/logo1.png">
                    </div>-->
                    <div class="imgBox">
                        <img width="160px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/erxiaoxin.png">
                        <h3>扫描二维码，下载班班手机应用</h3>
                    </div>
                    <ul>
                        <li>功能丰富，专业教育互动平台</li>
                        <li>互动形式多样，体验更佳</li>
                        <li>随时随地，自由沟通</li>
                    </ul>
                </div>
                <div class="mainBox"> 
                    <div class="step"> 
                        <span class="stepBg"><span class="stepCon" style="width:55%;"></span></span>
                        <ul class="stepText">
                            <li>手机注册 </li><li class="personalSettings">填写个人设定 </li><li>完成 </li>
                        </ul> 
                    </div>
                    <div class="formBox">
                        <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('openregister/openreginfo');?>" method="post">
                            <h2>个人设定</h2>
                            <p>
                               <span class="title">您的姓名：</span>
                               <input type="text" placeholder="真实的名字便于家长了解" autocomplete="off" class="text border" maxlength="10" name="name" id="name">
                               <input type="hidden" name="phone" value="<?php echo $phone?>">
                            </p> 
                            <p>
                                <span class="title">登录密码：</span>
                                <input type="password" placeholder="密码由6-16位数字、字母或两者组合。" autocomplete="off" maxlength="16" class="text border" name="password" id="password" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')">
                            </p>
                            <p>
                                <span class="title">确认密码：</span>
                                <input type="password"  placeholder="再次确认密码" autocomplete="off" maxlength="16" class="text border" name="pwdconfirm" id="pwdconfirm">
                            </p>
                            <p class="error">
                                <span class="title">&nbsp;</span>
                                <span class="errorText"></span>
                            </p> 
                            <p class="">
                                <span class="title">&nbsp;</span>
                                <a style=" width: 90px;" href="<?php echo Yii::app()->createUrl('openregister/index')?>" class="btn btnColor2">返 回</a>
                                <a style=" width: 90px;" href="javascript:;" id="postFormBtn" class="btn btnColor1">提 交</a>
                            </p>
                        </form>
                    </div> 
                </div> 
            </div> 
        </div>
        <div class="footer">
            <p><!-- <a href="http://www.qthd.com/about.aspx?type=lianxi" target="_blank">联系我们</a>｜<a href="http://www.qthd.com/joinus.aspx" target="_blank">招聘信息</a>
             ｜<a href="http://www.qthd.com/about.aspx?type=lianxi" target="_blank">关于蜻蜓校信</a>
          ｜深圳蜻蜓互动科技有限公司  --><a href="http://www.miibeian.gov.cn">粤ICP备14076064号-4</a></p>
        </div>
    </div>
    <script>
        $(function(){ 
            $("#name,#password,#pwdconfirm").keydown(function(){
                $('.errorText').text('');
            }); 
            $("#schoolName").keydown(function(){
                $('.errorTextsname').text('');
            });
            $("#schoolName").focusout(function(){
                var urls= '<?php echo Yii::app()->createUrl("ajax/checkschool")?>'; 
                var sname =$.trim($("#schoolName").val());
                if(sname){
                    var str =ajaxSchoolPost(urls,sname);
                    if(str.status=='0'){
                        $("#schoolNameTure").val(0); 
                        $('.errorTextsname').text('该学校暂时不支持开放注册,请联系客服').css({color:"red"});
                    }else if(str.status=='2'){ 
                        $("#schoolNameTure").val(1); 
                        $("#schoolNameSid").val(str.sid);
                        $('.errorTextsname').text(' ').css({color:"#434343"});
                    }else{
                        $("#schoolNameTure").val(1); 
                        $('.errorTextsname').text(' ').css({color:"#434343"});
                    } 
                } 
            });
        });
        
        //修改密码enter
        $('#pwdconfirm').keydown(function(){
            var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
            if (event.keyCode == 13){
                $('#postFormBtn').click(); 
            }
        });
        $('#postFormBtn').click(function(){
            var egt = /[\u4e00-\u9fa5]/;
            var name = $('#name').val();
            var sname = $('#schoolName').val();
            var pwd = $('#password').val();
            var pwdconf = $('#pwdconfirm').val(); 
            var nameTure =$("#schoolNameTure").val();
            if(name){
                if(name.match(egt) !== null) {
                                if(pwd){
                                    if(checkPassword(pwd)){
                                        if(pwdconf){
                                            if(pwd==pwdconf){
                                                $('#formBoxRegister').submit(); 
                                            }else{
                                              $('.errorText').text('您两次输入的密码不一致').css({color:"red"});  
                                            } 
                                        }else{
                                           $('.errorText').text('请再次输入密码').css({color:"red"});   
                                        } 
                                    }else{
                                       $('.errorText').text('密码由6-16位数字、字母或两组合').css({color:"red"}); 
                                    } 
                                }else{
                                   $('.errorText').text('请输入密码').css({color:"red"});   
                                }    
                } else {
                  $('.errorText').text('请使用中文字填写姓名').css({color:"red"});
                }

                 
            }else{
               $('.errorText').text('请输入您的姓名').css({color:"red"});
            }
            
        });
        //验证 学校名
        function ajaxSchoolPost(url,sname){
            var str ="";
            $.ajax({  
                url:url,
                type : 'POST',
                data : {sname:sname},
                dataType : 'text',  
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {
                    var date =$.parseJSON(mydata);
                    str = date; 
                },  
                error : function() { 
                    //str = "系统繁忙,请稍后再试";
                }  
            });
            return str;
        }
         function checkPassword(pwd) {
        // 长度为6到16个字符
            var reg = /^[0-9 | A-Z | a-z]{6,16}$/;
            //alert(reg.test(pwd));
            var len = pwd.length;
            if(len>=6&&len<=16){
                if (!reg.test(pwd)) {
                    return false;
                }else{
                    return true;
                }  
            }else{
               return false; 
            }
        }
    </script>
</body>
</html>
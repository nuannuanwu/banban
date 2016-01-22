<html >
<head> 
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <title>班班注册 - 免费开放注册，30万老师的家校沟通专属社交应用。班班客服：400 101 3838</title>
    <meta name="keywords" content="班班,班班网,班班介绍,班务管理,作业通知,蜻蜓校信,蜻蜓班班,校信,校信通,校讯通,家校互动,家校沟通,班费,家校,青豆">
    <meta name="description" content="班班面向老师开放注册，是教育专属应用；班班让老师家长沟通更便捷，免费沟通还可得福利；班班多家属关注功能,与您共同呵护孩子成长。">
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/image/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/getpwd.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>  
    <style>
        .error_info{display: inline;}
    </style>
</head>
<body id="layoutBodyBox"  style="overflow-x:auto;">
    <div id="contentBox" class="layout_div">
        <div class="header">
            <div class="tell">
                <p>客服电话</p>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/telIco.png"/> 
            </div> 
            <div class="logo" style="line-height: 96px;">
                <a href="<?php echo Yii::app()->createUrl('')?>"> 
                    <img style=" display: inline-block; float: left;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/logo.png" alt="班班应用"/>
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
<!--                    <div class="imgBox">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/openregister/logo1.png">
                    </div>-->
                    <div class="imgBox">
                        <img width="150px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/erxiaoxin.png" alt="班班下载二维码">
                        <h3>扫描二维码，下载班班手机应用</h3>
                    </div>
                    <ul>
                        <li>功能丰富，专业教育互动平台</li>
                        <li>互动形式多样，体验更佳</li>
                        <li>随时随地，自由沟通</li>
                    </ul>
                </div>
                <div class="mainBox">
                    <div class="formBox"><p class="info" style=" font-size: 16px; margin-bottom: 20px; color: #FD9558;">为了验证您的真实身份，需要使用一个手机号码进行注册。</p></div>
                    <div class="step" > 
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/oStepBg_1.png" alt="">
                    </div>
                    <div class="formBox">
                        <!--<h2>手机注册</h2>-->
                        <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('openregister/index');?>" method="post">
                            <input type="hidden" name="Openregister[codeerror]" id="codeerror" value="<?php echo isset($errorInfo) ? $errorInfo : '';?>"/>
                            <p>
                                <span class="title">手机号：</span>
                                <input  class="moblie border" autocomplete="off" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" autocomplete="off" type="text" maxlength="11" name="Openregister[phone]" value="<?php echo isset($data['phone'])?$data['phone']:'';?>" id="phone" placeholder="账号">
                            </p>
                            <p> 
                                <span class="title">验证字符：</span>
                                <input type="text" class="input" id="ehong-code-input" name="captcha_code" maxlength="4" style="width: 100px;letter-spacing: 2px;margin: 0px 8px 0px 0px;border: 1px solid #e3e3e3;"/>
                                <img src="/ajax/getcaptcha" id="captcha" title="看不清，点击换一张" align="absmiddle"  style=" display: inline-block;vertical-align: -10px;"> 
                                <a href="javascript:;" onclick="refreshCode()">看不清，换一组</a> 
                            </p>
                            <p style=" margin-bottom: 0;">
                                <span class="title">短信验证码：</span>
                                <input class="code border" autocomplete="off" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" type="text" name="Openregister[code]"  maxlength="6" id="code" value="">
                                <!--input class="code" type="hidden" name="" id="codeVerify"--> 
                                <a href="javascript:;" id="codeBnt" class="codeBnt">获取验证码</a>
                                <input id="statusT" name="uidsss" type="hidden" value="0">
                            </p>
                            <p style=" color: #666666; text-align: left; padding-top: 3px; padding-right: 22px;">
                                <span class="title">&nbsp;</span>
                                <span class="codeRemind"><?php echo isset($errorInfo) ? '<font color="red">'.$errorInfo . '</font>' : '';?></span>
                            </p> 
                            <p>
                               <span class="title">您的姓名：</span>
                               <input type="text" placeholder="真实的名字便于家长了解" autocomplete="off" class="text border" maxlength="20" name="Openregister[name]" value="<?php echo isset($data['name'])?$data['name']:'';?>" id="name">
                            </p> 
                            <p>
                                <span class="title">登录密码：</span>
                                <input type="password" placeholder="密码由6-16位数字、字母或组合。" autocomplete="off" maxlength="16" class="text border" name="Openregister[password]" value="" id="password" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')">
                            </p>
                            <p>
                                <span class="title">确认密码：</span>
                                <input type="password"  placeholder="再次确认密码" autocomplete="off" maxlength="16" class="text border" name="pwdconfirm" id="pwdconfirm" value="">
                            </p>
                            <!--
                            <p class="relativePhone" >
                                <span class="title">邀请人手机号：</span>
                                <input  class="moblie border" autocomplete="off" autocomplete="off" type="text" name="Openregister[invitephone]" maxlength="11" name="phone1" id="invitePhone" value="<?php echo isset($data['invitephone'])?$data['invitephone']:'';?>" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" placeholder="非必填，填写会给邀请人奖励哦">
                                <a href="<?php echo Yii::app()->createUrl('site/invitedetail');?>" target="__blank" class="relativeRule" >详情</a>
                            </p>
                            -->
                            <p class="error">
                                <span class="title">&nbsp;</span>
                                <span class="errorText"></span>
                            </p> 
                            <p class="btnBox">
                                <span class="title">&nbsp;</span>
                                <a href="javascript:;" tid="0" id="postFormBtn" class="btn btnColor1">立即验证</a></p>
                            <p class="agreement" style="text-align: center;"><!-- <input id="checkIDo" checked="checked" type="checkbox" > -->&nbsp;<a href="<?php echo Yii::app()->request->baseUrl; ?>/mobile/clause" target="_blank"><用户使用协议></a></p>
                            
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
        //刷新字符
        function refreshCode(){
            var securimage_url = '<?php echo Yii::app()->createUrl('ajax/getcaptcha'); ?>';
            document.getElementById('captcha').src = securimage_url + '?' + Math.random();
        }
        $(function(){ 
            //计时器
            var countdown = 60;
            var off =true;
            function settime(val) { 
                if(!off){
                  return;
                }
                if (countdown == 0) {  
                    ///val.removeAttribute("disabled");
                    val.css({background:'##E7E7E7',color:"#333333"});  
                    val.text("获取验证码"); 
                    countdown = 60; 
                    return;
                } else { 
                    val.css({background:'#cccccc',color:"#ffffff",cursor: "default",borderColor:'#adadad'});  
                    val.text("再次获取("+countdown+"s)"); 
                    countdown--; 
                } 
                setTimeout(function() { 
                    settime(val);
                },1000); 
            }
            $("#phone,#code,#ehong-code-input").live('keydown',function(){
                $('.errorText').text(''); 
                $('.codeRemind').text('');
            }); 
            
            
            $('#codeBnt').live('click',function(){ 
                var inputCV = $("#ehong-code-input").val();
                // var urlStr ='<?php echo Yii::app()->createUrl("ajax/checkcaptcha");?>'
                var obj = $(this);
                if(parseInt(countdown)==60){
                    off =true;
                    var url ='<?php echo Yii::app()->createUrl("ajax/sendmobilecode")?>';
                    var eg =/^((1)+\d{10})$/;
                    var phone =$.trim($('#phone').val()); 
                    if(phone){
                        if(eg.test(phone)){
                            if(inputCV==""){
                                  $('.codeRemind').html('<font color="red">请输入验证字符结果</font>'); 
                            }else{
                                var flag ='';   
                                $.post(url,{mobile:phone, ty:1,code:inputCV},function(data){//请求验证码
                                    if(data == 1){
                                        settime(obj);
                                        $('.codeRemind').text('验证码已发送到手机，请查收。');
                                        refreshCode();
                                    }else if(data == 2){
                                       $('.codeRemind').text('超过发送次数限制');
                                    }else if(data == 3){
                                       $('.codeRemind').html('<font color="red">该手机号码已注册</font>');
                                    }else if(data==4){
                                        $('.codeRemind').html('<font color="red">该手机号码已注册</font>');
                                    }else if(data==5){
                                      $('.codeRemind').html('<font color="red">验证字符结果有误</font>'); 
                                    } 
                                }); 
                            }   
                        }else{
                           $('.errorText').text('您输入的手机号码无效，请重新输入').css({color:"red"}); 
                        }     
                    }else{
                        $('.errorText').text('手机号不能为空！').css({color:"red"});;
                    }
                }
            });
            //enter
            $('#code').keydown(function(){
                var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
                if (event.keyCode == 13){
                     var tid = $("#postFormBtn").attr("tid");
                     if(tid=='0'){
                         pstCode(); 
                     } 
                }
            });
            $('#name').focusout(function(){
                 var name = $('#name').val();
                  var egt =/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\s]+$/;
                 if(getByteLen(name)<=20&&getByteLen(name)>0){
                    if(egt.test(name)) { 
                    }else {
                        $('.errorText').text('姓名只允许中英文数字以及()_-.和空格组成').css({color:"red"});  
                    } 
                }else{
                    $('.errorText').text('姓名不能超过10个汉字（或20个英文字符）').css({color:"red"});
                 } 
            });
        // 请求验证码
        $("#postFormBtn").click(function(){   
             pstCode();  
        });
        $('#checkIDo').change(function(){
            if($(this).attr('checked')){
                $('.errorText').text('');
                $("#postFormBtn").attr("tid",'0');
                $("#postFormBtn").removeClass('codeBntDisabled');
            }else{
                $("#postFormBtn").attr("tid",'1');
                $("#postFormBtn").addClass('codeBntDisabled');
            }
        });
        //验证 验证码
        function pstCode(){
            var eg =/^((1)+\d{10})$/;
            var code = $.trim($("#code").val());
            var mobile = $.trim($("#phone").val()); 
            var invitPhone = $.trim($("#invitePhone").val()); 
            var status = $("#statusT").val();
            var egt =/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\s]+$/;
            var name = $('#name').val();
            var sname = $('#schoolName').val();
            var pwd = $('#password').val();
            var pwdconf = $('#pwdconfirm').val(); 
            //var nameTure =$("#schoolNameTure").val();
            //var verify = $.trim($('#codeVerify').val());
            //var url ='<?php //echo Yii::app()->createUrl("ajax/checkphonenum");?>';
            var tid = $("#postFormBtn").attr("tid");
            if(mobile==""){
                $('.errorText').text('手机号不能为空！').css({color:"red"});
                return;
            }else{
                if(eg.test(mobile)){ 
                    if(code==""){
                        $('.errorText').text('请输入正确的短信验证码').css({color:"red"});
                        return;
                    }else{ 
                        if(eg.test(invitPhone)||invitPhone==""){
                            if(tid=='0'){ 
                                if(getByteLen(name)<=20&&getByteLen(name)>0){
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
                                               $('.errorText').text('密码由6-16位数字、字母或组合').css({color:"red"}); 
                                            } 
                                        }else{
                                           $('.errorText').text('请输入密码').css({color:"red"});   
                                        }    
                                    } else {
                                      $('.errorText').text('姓名只允许中英文数字以及()_-.和空格组成').css({color:"red"});                                   
                                    } 
                                }else{
                                   $('.errorText').text('姓名不能超过10个汉字（或20个英文字符）').css({color:"red"});
                                } 
                            }else{
                                $('.errorText').text('注册前需要同意用户使用协议。').css({color:"red"});
                            }
                        }else{
                            $('.errorText').text('您输入邀请人的手机号码无效，请重新输入').css({color:"red"});
                        } 
                    }
                }else{
                    $('.errorText').text('您输入的手机号码无效，请重新输入').css({color:"red"});
                }
            }
        }
            $("#name,#password,#pwdconfirm,#sname").keydown(function(){
                $('.errorText').text('');
            }); 
            $("#schoolName").keydown(function(){
                $('.errorText').text('');
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
         
        //修改密码enter
        $('#pwdconfirm').keydown(function(){
            var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
            if (event.keyCode == 13){
                $('#postFormBtn').click(); 
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
    /** 
     * 计算字符串的字节数 
     * @param {Object} str 
     */   
    function  getByteLen(str){   
        var l=str.length;   
        var n = l;   
        for ( var i=0;i <l;i++){  
            if( str.charCodeAt(i) <0 ||str.charCodeAt(i)> 255){  
                n++;   
            }   
        }   
        return n;   
    }   
    });
    </script>
</body>
</html>
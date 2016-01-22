<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html style=" height: 100%; overflow: hidden; margin: 0; padding: 0; border: 0; ">
<head> 
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit|ie-comp"> 
    <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/image/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/style.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
    <style type="text/css">
        /*------按钮样式---------*/ 
        .btn {display: inline-block; padding: 6px 20px; margin-bottom: 0; margin-right: 0px; font-size: 16px; font-weight: normal;   text-align: center; white-space: nowrap; vertical-align: middle; cursor: pointer; background-image: none; border: 1px solid transparent; border-radius: 3px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; -o-user-select: none; user-select: none; outline: none;}
       
        .btn-orange {color: #ffffff; background-color: #f59201; border-color: #f59201; }
        .btn-orange:hover, .btn-orange:focus {color: #ffffff; opacity: 0.8; filter:alpha(opacity=80);text-decoration: none; background-position: 0 -15px;-webkit-transition: background-position .1s linear; } 
        .btn-default { color: #333333; background-color: #f3f3f3; border-color: #d7d7d7; }
        #swithIdentity_3 .switchBox{ text-align:center; margin: 0 auto; margin-top: 6%; }
        #swithIdentity_3 .switchBox .title{ text-align: center; font-size: 20px; margin-bottom: 35px; color: #f59201;} 
        #swithIdentity_3 .switchBox p{ margin: 10px 0; font-size: 14px;  } 
        #swithIdentity_3 .switchBox p.info{ margin-bottom: 20px;} 
        #swithIdentity_3 .identityBox img{ display: inline; }
        #swithIdentity_3 .switchBox a.mr80{ margin-right: 25px; } 
        .identityBox p{ margin-bottom: 30px; font-size: 16px;  }
        #swithIdentity_3 .identityBox{ width: 660px; background: #FFFFFF; border: 2px  dotted #d2d2d2; margin: 0 auto; margin-top: 40px; border-radius: 15px; padding: 60px 60px 30px 60px; position: relative; }
       .identityBox ul { overflow: hidden; }
       .identityBox ul  li{ float: left; width: 126px; text-align: center; margin: 0 26px; }
       .imgBox{ width: 98px; height: 98px;  display: inline-block; margin-bottom: 30px;  }
       .titLable{ position: absolute; width: 146px; height: 38px; text-align: center; line-height: 38px; top:-20px; left:250px; background: #f5f4eb; border: 2px  dotted #d2d2d2; border-radius: 15px; }



        #swithIdentity_2 .switchBox{ text-align:center; margin: 0 auto; margin-top: 6%; }
        #swithIdentity_2 .switchBox .titleT{ text-align: center; font-size: 20px; margin-bottom: 35px; color: #f59201;} 
        #swithIdentity_2 .switchBox p{ margin: 10px 0; font-size: 14px; }
        #swithIdentity_2 .switchBox p.info{ margin-bottom: 20px;}
        #swithIdentity_2 .identityBox{ width: 660px; background: #FFFFFF; border: 2px  dotted #d2d2d2; margin: 0 auto; margin-top: 50px; border-radius: 15px; padding: 60px 60px 30px 60px; position: relative;}
       .identityBox ul { overflow: hidden; }
       .identityBox ul  li{ float: left; width: 126px; text-align: center; margin: 0 26px; }
       .imgBox{ width: 98px; height: 98px;  display: inline-block; margin-bottom: 30px;  }
       .titLable{ position: absolute; width: 146px; height: 38px; text-align: center; line-height: 38px; top:-20px; left:250px; background: #f5f4eb; border: 2px  dotted #d2d2d2; border-radius: 15px; }
        .formBox{ margin: 0 auto; padding-left: 55px;}
        .formBox h2{ color: #333333; font-size: 18px; margin: 45px 0; }
        .openReginfo h2{margin: 25px 0; text-align: left; }
        .formBox p{ text-align: left;  margin-bottom: 10px; margin-left: 10%; }
        .formBox p span.title{ display:inline-block; width: 98px; text-align: right;  }
        .formBox p.btnBox{margin-bottom: 30px; }
        .formBox p.info{ color: #999999; text-align: center; overflow: hidden; }
        .formBox p.relativePhone{ position: relative; }
        .formBox p a.relativeRule{ position: absolute; top:6px; right: 26px; color: #993300; text-decoration: none;}
        .formBox p a.relativeRule:hover{ text-decoration: underline; }
        .formBox p.error .errorCTip ,.formBox p.error .errorText{ color: #993300;}
        .formBox p.agreement{ text-align: center; }
        .formBox p.agreement a{ color: #933100;} 
        .formBox input[type="text"],.formBox input[type="password"]{ height: 35px; line-height: 25px; border: none; padding: 0 5px; border-radius: 3px; }
        .formBox input.border{ border: 1px solid #e3e3e3; }
        .formBox input.text{ width: 280px; }
        .formBox input.moblie{width: 280px;}
        .formBox input.code{width: 182px; }
        .formBox .codeBnt{ width: 90px; text-decoration: none; color: #333333; background-color: #E7E7E7; text-align: center; display: inline-block; padding: 8px 0px; margin-bottom: 0; font-size: 13px; font-weight: normal;  text-align: center; white-space: nowrap; vertical-align: middle; cursor: pointer; background-image: none; border: 1px solid #e2e2e2; border-radius: 3px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; -o-user-select: none; user-select: none; outline: none;}
        .formBox .codeBnt:hover{ opacity: 0.8;}
    </style>
</head>
<body style="height: 100%; overflow: hidden; margin: 0; padding: 0; border: 0;">
    <div id="bodyBox" style=" min-width: 780px; overflow-x: hidden; overflow-y:auto; zoom: 1;  position: relative;  background: #e5e4da; margin: 0 auto;">
        <div id="layoutBodyBox" class="layoutBodyBox" style=" overflow: hidden;" > 
        <div id="headerBox" class="headerBox" style="height: 67px;" >
            <div class="logoBox">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo_ioc.png" />
            </div>
            <div class="userBox">
                <div  style=" position: absolute; zoom: 1; left: 0; top:20px;">
                    <span class="name"><?php echo Yii::app()->user->getRealName(); ?></span>
                </div>
            </div>
        </div> 
        <div id="layoutBox" class="layoutBox" style=" margin: 0 auto; overflow: hidden;">
            <?php if( !(Yii::app()->user->getInstance() instanceof stdClass) && Yii::app()->user->getInstance()->identity > 0 && Member::isExistsClassByUser()):?>
            <div id="swithIdentity_3" style=" overflow: hidden; zoom: 1;" >
                <div class="switchBox">
                    <div class="title">欢迎您使用班班！</div>
                    <p class="info">班班是以“班级”为单位的家校沟通平台，使用前需要先添加班级。</p>
                    <div class="identityBox" >
                        <div class="titLable">身份选择</div>
                        <ul>
                            <li>
                                <p>我是<span>班主任</span></p>
                                <div class="imgBox"><img width="98px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/teacherP_ico.png" /></div>
                                <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('class/create', array('tmpIdentity'=>Constant::TEACHER_IDENTITY)); ?>">创建班级 </a> 
                            </li> 
                            <li> 
                                <p>我是<span>任课老师</span></p>
                                <div  class="imgBox"><img width="98px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/teacher_ico.png" /></div> 
                                <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('class/chooseclass', array('tmpIdentity'=>Constant::TEACHER_IDENTITY)); ?>">加入班级</a> 
                            </li>
                            <li>
                                <p>我是<span>学生家长</span></p>
                                <div  class="imgBox"><img width="98px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/patriarch_ico.png" /> </div>
                                <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('class/chooseclass', array('tmpIdentity'=>Constant::FAMILY_IDENTITY)); ?>">加入班级</a> 
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else:?>
            <div id="swithIdentity_2" style=" overflow: hidden; zoom: 1;" >
                <div class="switchBox">
                    <div class="titleT">欢迎您使用班班！</div>
                    <p class="info">第一次登陆需要完善一下基本信息。</p>
                    <div class="identityBox" >
                        <div class="titLable">完善信息</div>
                        <div class="formBox">
                         <form id="formBoxRegister" action="" method="post">
                            <p>
                                <span class="title">您 的 姓 名：</span>
                                <input  class="moblie border" autocomplete="off" autocomplete="off" type="text" maxlength="11" name="third[name]" id="name" value="<?php echo $name;?>">
                                <input id="statusPhone" name="uid" type="hidden" value="">
                            </p>
                            <p>
                                <span class="title">手　机　号：</span>
                                <input  class="moblie border" autocomplete="off" autocomplete="off" type="text" maxlength="11" name="third[phone]" id="phone" value="<?php echo $phone;?>" >
                                <input id="statusPhone" name="uid" type="hidden" value="">
                            </p>
                            <p style=" margin-bottom: 0;">
                                <span class="title">验　证　码：</span>
                                <input class="code border" autocomplete="off" type="text" name="third[code]" id="code">
                                <!--input class="code" type="hidden" name="" id="codeVerify"--> 
                                <a href="javascript:;" id="codeBnt" class="codeBnt">获取验证码</a>
                                <input id="statusT" name="uidsss" type="hidden" value="0">
                            </p>
                            <p style=" color: #999; text-align: right; padding-right: 22px; height: 20px; margin-bottom: 0;">
                                <!--验证码30分钟内有效-->
                            </p>
                            <p style="margin-top: 0; margin-bottom: 0;">
                                <span class="title">邀请人号码：</span>
                                <input  class="moblie border" autocomplete="off" autocomplete="off" type="text" maxlength="11" name="third[invite_phone]" id="phoneSt" value="" ><span style=" color: #999999;">（选填）</span>
                                <input id="statusPhone" name="uid" type="hidden" value="">
                            </p>
                            <p class="error">
                                <span class="title">&nbsp;</span>
                                <span class="errorText"></span>
                            </p> 
                            <p class="btnBox">
                                <span class="title">&nbsp;</span>
                                <a href="<?php echo Yii::app()->createUrl('site/login');?>" class="btn btn-orange">返回</a>
                                
                                <a href="javascript:;" tid="0" id="postFormBtn" class="btn btn-orange">立即验证</a>
                            </p>
                        </form>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                
            </div> 
        </div> 
    </div>
   </div>
    <script type="text/javascript">
        var subR ='0';
        function AutoHeight() {//根据浏览器大小控制网页大小
            var Height_Page = window.document.body.clientHeight;
            var Width_Page = window.document.body.clientWidth;
            var Height_Page_Using = document.documentElement.clientHeight;
            var Width_Page_Using = document.documentElement.clientWidth;
            if(getBrowser() == "msie7.0" || getBrowser() == "msie6.0" || getBrowser() == "msie5.0"){  
                //var Width_Sider = Sider.offsetWidth;
                //var Height_Crumb = Crumb.offsetHeight; 
                //若以上无效，则采用(主要是IE6.0，5.0需要)
                if(Height_Page > Height_Page_Using){
                    Height_Page = Height_Page_Using;
                }
               if(Width_Page > Width_Page_Using){
                    Width_Page = Width_Page_Using;
                }
                initPage(Height_Page,Width_Page); 
            }else{
                initPage(Height_Page,Width_Page);  
            } 
        }
        //页面初始化
        function  initPage(pageHeight,pageWidth){ 
            var Layout = document.getElementById("layoutBox");  
            var HeaderBox = document.getElementById('headerBox'); 
            var LayoutBody = document.getElementById('layoutBodyBox');
            var  bodyBox = document.getElementById('bodyBox');
            bodyBox.style.height= pageHeight+'px';
            if(LayoutBody.clientHeight>pageHeight){
                pageHeight = LayoutBody.clientHeight;
            } 
            LayoutBody.style.height = pageHeight+"px";  
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
        }
        window.onload = function() {//页面加载触发
            AutoHeight(); 
        } 
    </script>
    <script>
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

            $("#phone,#sname,#code").keydown(function(){
                $('.errorText').text('');
            });

            $('#codeBnt').click(function(){
                //$("#code").val('');
                if(parseInt(countdown)==60){
                    off =true;
                    var url ='<?php echo Yii::app()->createUrl("ajax/sendthird")?>';
                    var eg =/^((1)+\d{10})$/;
                    var phone =$.trim($('#phone').val()); 
                    if(phone){
                        if(eg.test(phone)){
                             var date = ajaxPhonePost(url,phone);
                             if(date.status == "0"){
                                if(date.msg){
                                  $('.errorText').text(date.msg).css({color:"red"});
                                }else{
                                  $('.errorText').text('您输入的手机已注册').css({color:"red"});
                                }
                                $("#statusT").val(0);
                             }else if(date.status == "2"){
                                $('#statusPhone').val(date.uid);
                                $("#statusT").val(1);
                                settime($(this));
                                $('.errorText').text('验证码已发送到手机，请查收').css({color:"#434343"});
                             }else{
                                settime($(this));
                                $("#statusT").val(1);
                                $('.errorText').text('验证码已发送到手机，请查收').css({color:"#434343"});
                             }
                        }else{
                           $('.errorText').text('您输入的手机号码格式不正确').css({color:"red"}); 
                        } 
                    }else{
                        $('.errorText').text('手机号不能为空').css({color:"red"});;
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
        });
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
            var name = $("#name").val();
            var mobile = $("#phone").val(); 
            var status = $("#statusT").val();
            var mobileSt = $("#phone").val();
            //var verify = $.trim($('#codeVerify').val());
            var url = '<?php echo Yii::app()->createUrl("ajax/sendthird");?>';
            var tid = $("#postFormBtn").attr("tid");
            if (name == "") {
                $('.errorText').text('姓名不能为空！').css({color:"red"});
                return;
            }
            if(mobile==""){
                $('.errorText').text('手机号不能为空！').css({color:"red"});
                return;
            }else{
                if(eg.test(mobile)){ 
                    if(code==""){
                        $('.errorText').text('验证码不能为空').css({color:"red"});
                        return;
                    }else{
                        if(eg.test(mobileSt)){
                            $('#formBoxRegister').submit(); 
                        }else{
                            $('.errorText').text('您输入的邀请人手机号码格式不正确').css({color:"red"});
                        }
                        /*var date = ajaxCodePost(url,mobile,code);
                        //alert(date.status+"--11--"+date.msg);
                        if(date.status=='0'){ 
                            $('.errorText').text(date.msg).css({color:"red"}); 
                        } else {
                            if(tid=='0'){ 
                                 $('#formBoxRegister').submit();
                            }else{
                                $('.errorText').text('注册前需要同意用户使用协议。').css({color:"red"});
                            } 
                        }*/
                    }
                }else{
                    $('.errorText').text('您输入的手机号码格式不正确').css({color:"red"});
                }
            }
        }
        //请求验证码 并验证手机
        function ajaxPhonePost(url,phone){
            var str ="";
            $.ajax({  
                url:url,   
                type : 'POST',
                data : {phone:phone},
                dataType : 'json',  
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {
                    var date =mydata;
                    str = date;
                },
                error : function() { 
                    //str = "系统繁忙,请稍后再试";
                } 
            });
            return str;
        }
        //请求验证验证码
        function ajaxCodePost(url,phone,code){
            var str ="";
            $.ajax({  
                url:url,   
                type : 'POST',
                data : {phone:phone,code:code},
                dataType : 'json',
                contentType : 'application/x-www-form-urlencoded',  
                async : false,
                success : function(mydata) {
                    var date = mydata;
                    str = date;
                },  
                error : function() { 
                    //str = "系统繁忙,请稍后再试";
                }
            });
            return str;
        } 
    </script>
    <?php Yii::app()->msg->printMsg(); ?>
    
    <?php if($laterJump > 0):?>
    <script>  
        function jumpurl(){  
          location='<?php echo Yii::app()->createUrl('class/create');?>';  
        }  
        setTimeout('jumpurl()',3000);  
    </script> 
    <?php endif;?>
</body>
</html>  
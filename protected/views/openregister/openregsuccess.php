<html style="height: 100%; overflow: hidden; margin: 0; padding: 0; border: 0;">
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
        .identityBox img{ display: inline; }
       .switchBox a.mr80{ margin-right: 25px; } 
       .identityBox p{ margin-bottom: 30px; font-size: 16px;  }
       .identityBox{ width: 320px; background: #FFFFFF;  margin: 0 auto; margin-top: 40px;  display: inline-block; }
       .identityBox ul { overflow: hidden; }
       .identityBox ul  li{ float: left; width: 126px; text-align: center; margin: 0 5%; }
       .identityBox ul  li p { font-size: 14px; } .identityBox ul  li p span{  color: #993300; margin-left: 5px;}
       .identityBox .imgBox{ width: 98px; height: 98px;  display: inline-block; margin-bottom: 30px;  } 
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
                    </div>-->
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
                     <div class="step" > 
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/oStepBg_2.png" alt="">
                    </div>
                    <div class="formBox successBox" style=" width: 500px;">
<!--                        <div class="imgBox" style=" padding-top: 20px; text-align: center;">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tipSussess.png">
                        </div>-->
                        <div class="successInfo"> 注册成功 </div>
                        <p class="info" style=" margin-left: 0; color: #999999;">班班是以“班级”为单位的家校沟通平台，使用前需要先添加班级，请依照您的身份，选择：</p>
<!--                        <div class="successBtnBox">
                            <a href="<?php //echo $url;?>" id="linkBtn" class="btn btnColor1">创建一个班级(5)</a> 
                        </div>-->
                        <div class="identityBox" > 
                            <ul>
                                <li>
                                    <p>我是<span>班主任</span></p>
                                    <div class="imgBox">
                                        <img width="98px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/teacherP_ico.png" />
                                    </div>
                                    <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('class/create', array('tmpIdentity'=>Constant::TEACHER_IDENTITY)); ?>">创建班级 </a> 
                                </li> 
                                <li> 
                                    <p>我是<span>任课老师</span></p>
                                    <div  class="imgBox">
                                        <img width="98px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/teacher_ico.png" />
                                    </div> 
                                    <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('class/chooseclass', array('tmpIdentity'=>Constant::TEACHER_IDENTITY, 'ty'=>'t')); ?>">加入班级</a> 
                                </li>
                                <!--
                                <li>
                                    <p>我是<span>学生家长</span></p>
                                    <div  class="imgBox">
                                        <img width="98px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/patriarch_ico.png" />
                                    </div>
                                    <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('class/chooseclass', array('tmpIdentity'=>Constant::FAMILY_IDENTITY, 'ty'=>'g')); ?>">加入班级</a> 
                                </li>
                                -->
                            </ul>
                        </div>
                    </div>
                    <div style=" text-align: center; font-size: 15px; margin-top: 30px;">
                        家长请下载<a target="_blank" href="<?php echo Yii::app()->createUrl('site/app');?>" style=" color:#A04721; vertical-align: baseline;">手机应用客户端</a>登录使用
                    </div>
                </div> 
            </div> 
        </div>
        <div class="footer">
            <p><a href="http://www.qthd.com/about.aspx?type=lianxi" target="_blank">联系我们</a>｜<a href="http://www.qthd.com/joinus.aspx" target="_blank">招聘信息</a>
             ｜<a href="http://www.qthd.com/about.aspx?type=lianxi" target="_blank">关于蜻蜓校信</a>
          ｜深圳蜻蜓互动科技有限公司 <a href="http://www.miibeian.gov.cn">粤ICP备14076064号-4</a></p>
        </div>
    </div> 
    <script>
        $(function(){
            //settime($('#linkBtn')); 
        }); 
             //计时器
            var countdown = 10;
            var off =true;
            function settime(val) { 
                if(!off){
                  return;
                }
                if (countdown == 0) {  
                    ///val.removeAttribute("disabled");
                    //val.css({background:'#ffffff',color:"#333333"});  
                    val.text("创建一个班级"); 
                    //countdown = 5; 
                     window.location.href="<?php echo Yii::app()->createUrl('class/create');?>";
                    return;
                } else { 
                    //val.css({background:'#cccccc',color:"#ffffff",cursor: "default",borderColor:'#adadad'});  
                    val.text("创建一个班级（"+countdown+"）"); 
                    countdown--; 
                } 
                setTimeout(function() { 
                    settime(val);
                },1000); 
            }
    </script>
</body>
</html>
 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta  name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"> 
    <meta content="yes" name="apple-mobile-web-app-capable" /> 
    <meta content="black" name="apple-mobile-web-app-status-bar-style" /> 
    <meta content="telephone=no" name="format-detection" /> 
    <title>话题分享有礼</title>
    <meta name="description" content="">
    <meta name="keywords" content=""> 
    <style>
        ,* { tap-highlight-color: transparent }
        * { -webkit-tap-highlight-color: transparent; }
        html,body{ width: 100%; height: auto; padding: 0;  margin: 0 auto; background-color: #fa784d;}
        body{ position: relative;}
        p,div{ padding: 0; margin: 0;}
        a{ text-decoration: none; color: #4c4c4c; }
        .f-left{ float: left; }
        .f-right{ float: right; }
        .layout{ position: relative; max-width:750px; height: 100%; margin:0 auto; overflow:hidden; font-family: "黑体"; } 
        .layout-main {position: relative; width: 100%; padding: 0px; margin: 0 auto;  min-width:280px;}
        .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
        .img-box{ position: relative; width: 100%; }
        .img-box img{display:block; max-width: 100%; height: auto; }
        .b-p{ position: absolute;left: 0; top:0%; width: 100%; text-align: center; }
        .b-p .t-t{ margin-bottom: 5px; font-size: 18px; color:#f6f3b6;}
        .b-p .t-c{ width: 60%; text-align: center; font-size: 32px; color:#f8dd5e; margin-bottom: 3%; margin: 0 auto; }
        .c-box{ padding-bottom: 5%; text-align: center; margin: 0 auto;}
        .c-box p{ color: #f59201; margin: 3px 0; font-size: 17px; }
        .banner{position: relative; width: 90%;  margin: 0 auto; text-align: center; padding: 0; font-size:14px;  margin-bottom: 15px; overflow: hidden; }
        .btn{ display: inline-block; width: 75%; height: 40px; line-height: 40px;   padding: 0px 8px; font-size: 18px; background-color: #f59201; border: 1px solid #f59201; border-radius: 6px; color: #ffffff; }
        .line { height: 30px; line-height: 30px; color: #ffffff; background:url('/image/banban/mobile/clas/line_web1.png') center no-repeat; background-size: 100%; text-align: center;  }
        .e-box{ position: fixed; left: 0; bottom: 10%;  width: 100% ;margin: 0 auto; text-align: center; }
        .e-box .up-ioc{ position: absolute; left: 0; top:0; width: 100%; height: auto; }
       
    </style>
    <script type="text/javascript">
         function JId(idd){
            var obj = {};
            if( typeof( idd ) === 'string'){
                var idName = idd.substr(1, idd.length ); 
                if( idd.substr(0,1) === '#' ){
                    obj = document.getElementById(idName);
                } else if( idd.substr(0,1) === '.'){
                    obj =  document.getElementsByName(idName);
                    //obj = obj.length ? document.getElementsByClassName(idName) : null;
                    //alert(obj.length);
                    //alert( obj[0].className )
                } else if( idd == 'document' ){
                     obj = document;
                } else {
                    obj = document.getElementsByTagName(idd);
                    //alert(idd)
                }
            } else {
                obj = idd;
            }
            return obj;
        }
    </script>
</head>
<body <?php if($ac=='webac'): ?>style=" background-color:#fa784d; "<?php endif; ?>>  
    <div class="page page-1" style="">
        <div id="layout" class="layout" style=" background-color: #fef0bf; <?php if($bt=='web'): ?>width: 430px;<?php endif; ?>"> 
            <div class="layout-main" >
                <div class="c-box" style=" display: none; padding: 5% 0;">
                    <p> 您已经领取过班费卡了哦~</p>
                    <p>班费已放入账户 <?php echo $mobile; ?></p>
                </div>
                <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/p_sc_01.jpg" />
                </div>
                 <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/p_sc_02.jpg" /> 
                </div>
                <?php if($bt=='app'): ?>
                    <div  style="padding: 0; margin:6% 0; overflow: hidden;  text-align: center;">
                        <a href="<?php echo APP_MOLO_DOWNLOAD_URL; ?>" class="btn" style=" background-color: #f59201;">立即下载赚班费</a>
                    </div>
                <?php endif; ?>
                <div class="c-box">
                    <p>班班，能赚班费涨知识的家校沟通神器</p>
                </div>
                <?php if($bt=='web'): ?>
                    <div style=" width: 76.67%; margin: 0 auto; padding-bottom: 20px;">
                        <form id="formBoxRegister" action="" method="post">
                            <div style=" margin: 10px 0; font-size: 18px;">
                                免费发送短信到手机下载
                            </div>
                            <div style=" padding: 20px 0;">
                                <div style="display: inline-block; position: relative; width: 60%; padding: 0 10px; border-radius: 0px; height: 42px; border: 1px solid #d7d7d7; background: #ffffff; overflow: hidden;">
                                    <input name="recmobile" id="webPlaInput" type="text" maxlength="11" autocomplete="off" onfocus="plasInpt('webPlaInput','webPlatext');"  onblur="plastt('webPlaInput','webPlatext');" style=" position: relative; z-index: 2; width:98%; height: 40px; font-size: 16px; color: #827c7c; padding: 0; margin: 0; border: none; outline: none; background: none;"   value="<?php echo $mobile;?>" />
                                    <div onmousedown="hideThis('webPlatext');" id="webPlatext" style="display: block; position: absolute; width: 100%; top:0; left: 5%; font-size: 18px; height: 42px; line-height: 42px; color: #827c7c;z-index: 1;">输入手机号</div>
                                </div>
                                <input type="submit" class="btn" value="发 送" style=" width: 30%; margin-top: 1px; height: 42px; float: right;  background: #f59201;" />
                            </div>
                        </form>
                    </div>
                    <div class="img-box" style=" text-align: center;">
                        <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/t_s3.png" /> 
                    </div>
                     <div class="img-box" style=" text-align: center; margin: 40px 0;">
                        <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/erweima.jpg" />
                        <p style=" font-size: 18px; margin-top: 15px;">二维码扫描下载</p>
                    </div>
                    <div  style="padding: 0; margin: 30px; overflow: hidden;  text-align: center;">
                        <a href="<?php echo WEB_IOS_DOWNLOAD_URL; ?>" class="btn" style=" color: #000000;">IOS下载</a>
                    </div>
                    <div  style="padding: 0; margin: 30px; overflow: hidden;  text-align: center;">
                        <a href="<?php echo WEB_ANDROID_MOLO_DOWNLOAD_URL; ?>" class="btn" style=" color: #000000;">Android下载</a>
                    </div>
                    <div class="c-box">
                        <p>班班，能赚班费涨知识的家校沟通神器</p>
                    </div>
                <?php endif; ?>
                <?php Yii::app()->msg->printMsg();?> 
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.onload = function (){
            if(JId('#layout')){
                JId('#layout').style.height = setHeight()+'px';
            }
            plasInpt('webPlaInput','webPlatext');
        };
        window.onresize = function (){
            if(JId('#layout')){
                JId('#layout').style.height = setHeight()+'px';
            }
        };  
        function setHeight(){
            var hPage = window.document.body.clientHeight; 
            var hPageUsing = document.documentElement.clientHeight;
            if(hPageUsing > hPage){
                hPage = hPageUsing;
            }
            return hPage; 
        }
        function hideThis(objT){ 
            var target = JId('#'+objT);
            target.style.display="none";
        }
        function plastt(objI,objT){
            var pinput = JId('#'+objI),
                target = JId('#'+objT);
           if(pinput.value==""){
                 target.style.display="block";
            }else{ 
                target.style.display="none";
            }
        }
        function plasInpt(objI,objT){
            var pinput = JId('#'+objI),
                target = JId('#'+objT);
            target.style.display="none"; 
        } 
    </script>
</body>
</html>
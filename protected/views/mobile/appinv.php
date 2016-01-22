<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
    <meta content="telephone=no" name="format-detection">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"> 
    <meta content="yes" name="apple-mobile-web-app-capable" /> 
    <meta content="black" name="apple-mobile-web-app-status-bar-style" /> 
    <meta content="telephone=no" name="format-detection" /> 
    <title>邀请有礼</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <style>
        ,* { tap-highlight-color: transparent }
        * { -webkit-tap-highlight-color: transparent; }
        html,body{ width: 100%; height: auto; padding: 0; margin: 0 auto; background-color: #fef0bf;}
        p,div{ padding: 0; margin: 0;}
        a{ text-decoration: none; color: #4c4c4c; }
        .f-left{ float: left; }
        .f-right{ float: right; }
        .layout{ position: relative; max-width:640px; height: 100%; margin:0 auto; overflow:hidden; font-family: "黑体";background-color: #fef0bf;}
        .page1,.page2,.page3{ width: 100%; min-height: 100%; margin: 0 auto; overflow: hidden; }
        .layout-main {position: relative; width: 100%; padding: 0px; margin: 0 auto;  min-width:280px;}
        .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
        .img-box{ position: relative; width: 100%; }
        .img-box img{display:block; max-width: 100%; height: auto; vertical-align:text-bottom; }
        .b-p{ position: absolute;left: 0; top:15%; width: 100%; text-align: center; }
        .b-p .t-t{ margin-bottom: 5px; font-size: 18px; color:#f6f3b6;}
        .b-p .t-c{ width: 60%; text-align: left; font-size: 16px; color:#3a2801; margin-bottom: 10px; margin: 0 auto; }
        .btn{ display: inline-block; width: 75%; height: 40px; line-height: 40px;   padding: 0px 8px; font-size: 18px; background-color: #fe6057; border: 1px solid #f59201; border-radius: 6px; color: #ffffff; }
        .line { width: 100%; height: 30px; line-height: 30px; padding: 20px 0; color: #000000; background:url('/image/banban/mobile/clas/line3.png') center no-repeat; background-size: contain; text-align: center;  }
        .e-box{ width: 60%; min-height:100px; margin: 0 auto; text-align: center; overflow: hidden;  } 
    </style> 
</head>
<body> 
    <div class="page1" style="">
        <div class="layout"> 
            <div class="layout-main">
                <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/t_ss.png" />
                </div>
                 <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/t_ss1.png" />
                    <div class="b-p"> 
                        <div class="t-c">
                            邀请其他老师和家长注册班班，最高可得10元班费卡，被邀请的老师完成教师认证后，你可另外再得10元班费卡。
                        </div>
                        <div style="color:#fdebbe; font-size: 18px;">班费劵</div>
                    </div>
                </div>
                <div  style="position: relative; padding: 0; margin: 30px; overflow: hidden;  text-align: center; z-index: 100;">
                    <a href="javascript:shareBtn('<?php echo Yii::app()->createAbsoluteUrl('mobile/invprize');?>?uid=<?php echo $uid; ?>',' 这么巧，你也缺钱啊！','别点，我真的不是刻意在炫富！','<?php echo Yii::app()->request->hostInfo;?>/image/banban/logo/logo.png');" class="btn">马上邀请</a>
                </div> 
                <div class="line">
                    <span>扫码注册</span>
                </div>
                <div class="e-box" style=" padding-bottom: 10px;">
                    <div class="img-box">
                        <img style="max-width: 237px; display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/erxiaoxin150.png"/>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/api/base64.js"></script>
    <script type="text/javascript"> 
        var browser = {
            versions: function() {
                var u = navigator.userAgent, app = navigator.appVersion;
                return {//移动终端浏览器版本信息 
                    trident: u.indexOf('Trident') > -1, //IE内核
                    presto: u.indexOf('Presto') > -1, //opera内核
                    webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/), //是否为移动终端
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
                    iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
                    iPad: u.indexOf('iPad') > -1, //是否iPad
                    webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
                };
            }(),
            language: (navigator.browserLanguage || navigator.language).toLowerCase()
        }
        function shareBtn(url,title,descs,imgUrl) { 
            var sObj ='{"url":"'+Base64.encode(url)+'","title":"'+Base64.encode(title)+'","descs":"'+Base64.encode(descs)+'","imgUrl":"'+Base64.encode(imgUrl)+ '"}';// 
            //var sts = Base64.encode(title); 
            //console.log(sts+"-----"+Base64.decode(sts));
            //window.location.href = url+'?'+sObj;
            if (browser.versions.iPhone){ //苹果客户端   
                window.location.href = "js-call://share/"+sObj;
            }else if (browser.versions.android){//Android客户端  
                PayHelper.share(url,title,descs,imgUrl);
            }else{ 
                
            }
        } 
    </script>
</body>
</html>
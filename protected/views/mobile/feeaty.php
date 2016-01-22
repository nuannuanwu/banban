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
    <title>100元班费免费拿</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <style>
        ,* { tap-highlight-color: transparent }
        * { -webkit-tap-highlight-color: transparent; }
        html,body{ width: 100%; height: auto; padding: 0; margin: 0 auto;}
        p,div{ padding: 0; margin: 0;}
        a{ text-decoration: none; color: #4c4c4c; } 
        .f-left{ float: left; }
        .f-right{ float: right; }
        .layout{ position: relative; max-width:430px; height: 100%; margin:0 auto; overflow:hidden; font-family: "黑体";background-color: #fef0bf;}
        .page1,.page2,.page3{ width: 100%; min-height: 100%; margin: 0 auto; overflow: hidden; }
        .layout-main {position: relative; width: 100%; padding: 0px; margin: 0 auto;  min-width:280px;}
        .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
        .i-b{ position: relative; width: 100%; min-height: 60px; margin: 0 auto; }
        .i-b img{display:block; max-width: 100%; height: auto; vertical-align:text-bottom; }
        .b-gb{ width: 100%; background: url('/image/banban/mobile/feeaty/t_bg.jpg') repeat-y; background-size: contain; text-align: center; padding: 1% 0;}
        .b-p{ position: absolute;left: 0; width: 100%; text-align: center;  }
        .btn{ display: inline-block; width: 75%;  padding: 6% 8px; margin-bottom: 3%; font-size: 1.0em; color: #ffffff; background:url('/image/banban/mobile/feeaty/btn_bg.png') center no-repeat; background-size: contain; }
        .l-t{ color:#fb495b; font-size: 1.0em; padding: 3% 0;}
        .l-r{font-size: 0.9em; padding:1% 0 3% 0 ; color: #f9f4f4;}
        .t-t{ margin: 3% auto; color:#fb495b; font-size: 0.9em;}
        .txt-b{ width: 75%; margin: 0 auto; padding-left:0%; }
        .txt-b li{ text-align: left;margin: 2% auto;  color: #f9f4f4; font-size: 0.7em;} 
         p.last{ text-align: center; margin: 4% auto;color: #f9f4f4; font-size: 0.7em;}
    </style> 
</head>
<body> 
    <div class="page1" style="">
        <div class="layout"> 
            <div class="layout-main">
                <div  class="i-b">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/feeaty/t_1.jpg" alt="班班提款机"/>
                    <div id="throbTip" class="b-p" style="top:15%;">
                        <div class="i-b" style=" width: 75%; text-align: center;">
                            <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/feeaty/t_t.png" alt="100元班费免费拿，班费取现不排队" />
                        </div>
                    </div>
                </div>
                <?php if(isset($type) && $type=='share'):?>
                <div  class="i-b"> 
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/feeaty/t_3_1.jpg" alt=""/>
                </div> 
                <?php else:?>
                 <div  class="i-b"> 
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/feeaty/t_3.jpg" alt=""/>
                </div> 
                <div class="b-gb">
                    <?php foreach($classes as $class):?>
                    <a class="btn" href="javascript:;" onclick="shareBtn('<?php echo Yii::app()->createAbsoluteUrl('mobile/classinvaty');?>?uid=<?php echo Yii::app()->request->getParam('uid');?>&cid=<?php echo $class->cid->val; ?>','<?php echo $class->name->val; ?>的老师家长，快到班里来~','新学期作业、通知从这里发送、接收。大家尽快加一下班哦~~','<?php echo Yii::app()->request->hostInfo;?>/image/banban/logo/logo.png')">邀请<?php echo $class->name->val; ?>家长</a>
                    <?php endforeach; ?>
                    <p class="l-t">成功邀请≥30人，班费提现不排队！</p>
                </div> 
                <?php endif;?>
                <div  class="i-b" style=" min-height: 10px;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/feeaty/t_4.jpg" alt=""/>
                </div>
                <div class="b-gb">
                    <h3 class="t-t">活动细则</h3>
                    <ol class="txt-b">
                        <li>活动从15年12月21日开始至16年1月22日结束</li>
                        <li>活动只针对12月21日前已建立的班级</li>
                        <li>班级新增成员不包含班级老师，必须为活动期间内新激活家长用户</li>
                        <li>通过电脑后台导入的家长，算为最先导入老师的班级成员</li>
                         <li>通过app端邀请激活的家长算为最先加入的班级成员</li>
                         <li>班级每新增10人即奖励该班班主任10元班费卡，100元封顶</li>
                         <li>活动期间，前500个新增成员≥30人的班级，获得班费提现不排队特权</li>
                         <li>班费提现不排队特权有效期为获得之日起至16年2月22日止</li> 
                    </ol>
                    <p class="last">更多问题请拨打 4001013838</p>
                </div>
                <div  class="i-b">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/feeaty/t_5.jpg" alt=""/>
                    <div class="b-p" style="top:13%;">
                        <div class="i-box" style="width: 85%; margin: 0 auto;">
                            <a href="http://schoolseason.banban.im/Envoy/index.html">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/feeaty/b_link.jpg" alt="班班大使"/>
                            </a>
                        </div>
                    </div>
                </div>
                <div  class="i-b" style=" min-height: 10px;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/feeaty/t_6.jpg" alt="活动最终解释权归深圳蜻蜓互动科技有限公司所有"/>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/api/base64.js"></script>
    <script type="text/javascript">
        window.onload = function (){ 
            jump();
        }; 
        var numb=18,flag = -1;
        function jump(){  
            var tips = document.getElementById('throbTip');
            if(numb==16){ flag =1; } if(numb==18){ flag = -1; } 
            numb= numb+flag;
            tips.style.top = numb +"%";  
            setTimeout("jump()",360);
        } 
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
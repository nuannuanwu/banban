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
    <title>班班家长调查问卷</title>
    <meta name="description" content="">
    <meta name="keywords" content="">  
    <style>
        ,* { tap-highlight-color: transparent }
        * { -webkit-tap-highlight-color: transparent; }
        html,body{ width: 100%; height: auto; padding: 0;  margin: 0 auto; background-color: #fff;}
        body{ position: relative;}
        p,div{ padding: 0; margin: 0;}
        a{ text-decoration: none; color: #4c4c4c; }
        .f-left{ float: left; }
        .f-right{ float: right; }
        .layout{ position: relative; max-width:450px; height: 100%; margin:0 auto;  overflow:hidden; font-family: "黑体"; } 
        .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
        .img-box{ position: relative; width: 100%; }
        .img-box img{display:block; max-width: 100%; height: auto; } 
         .b-p{ position: absolute;left: 0; top:0%; width: 100%; text-align: center; }
        .btn{ display: inline-block; width: 75%; height: 40px; line-height: 40px;   padding: 0px 8px; font-size: 18px; background-color: #f59201; border: 1px solid #f59201; border-radius: 6px; color: #ffffff; } 
        .t-title{ font-weight: 100; }
        .iQpage{ width: 100%; margin: 0 auto;  background:url('/image/banban/mobile/survey/bg.jpg') repeat-y; background-size: contain; filter:alpha(opacity:0); opacity:0; overflow: hidden; }
        .iQpage .t-c{ padding:1% 12%; background:url('/image/banban/mobile/survey/t_c.jpg') repeat-y; background-size: contain; font-size: 14px; }
        .iQpage .c-c{ display: block; position: relative; width: 100%; background:url('/image/banban/mobile/survey/c_c.jpg') repeat-y; background-size: contain; }
        .c-c .oplist{width: 100%; padding: 0; margin: 0 auto; overflow: hidden;  }
        .oplist li{ position: relative; list-style-type: none; height: 50px; line-height: 100%;  margin-top: 3%; overflow: hidden; } 
        .oplist li a{ display: block; position: absolute; left:0; top:22%;  width: 68%;  padding-left: 22%;  height: 50px; font-size: 14px; vertical-align: middle; color: #f0f6f9; overflow: hidden;} 
        .rBg{background:url('/image/banban/mobile/survey/h_bg.jpg') repeat-y; background-size: contain;}
        .jiathis_style_32x32 .jiathis_txt{
            margin-right: 6px;
        }
    </style>
   </head>
   <body>
        <div style=" display: none;">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/pic_logo.jpg" />
        </div>
       <div id="layout" class="layout"> 
           <section id ="iQp_1>" class="iQpage" style="display: block; opacity: 1;">
                <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_h.jpg"/>
                </div> 
                <div class="img-box">
                    <?php if($status==1||$status==2):?>
                        <?php if($status==1):?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_r_1.jpg"/>
                            <?php else:?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_r_3.jpg"/>
                            <?php endif;?>
                    <div class="b-p" style="top:35%;">
                        <span style=" font-size:32px; color:#eb5251;">&nbsp;<?php echo $money;?></span>
                    </div>
                    <?php else:?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_r_6.jpg"/>
                    <?php endif;?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/l_line.jpg"/>
                </div>

                <div class="img-box" style=" z-index: 1;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_n.jpg"/>
                    <div class="b-p" style="top:0%;">
                        <span style=" font-size:30px; color:#eb5251;">&nbsp;<?php echo $score;?>&nbsp;分</span>
                    </div>
                </div>
                <div class="rBg" style=" position: relative; width: 100%; margin: 0 auto;">
                    <div class="img-box" style=" width: 35%; margin: 0 auto; padding-top:10px;">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/grade_<?php echo $resultLevel->title;?>.jpg"/>
                        <div id="stampSpic" class="b-p" style=" width: 70%; left: 40%; top:45%; opacity: 0; z-index: 999;">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/stamp.png" />
                        </div>
                    </div>
                    <div style=" width: 76%; margin: 5% auto; font-size: 16px; color: #595959;">
                       <?php echo $resultLevel->desc;?>
                    </div>
                    <div class="img-box"> 
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/l_line.jpg"/>
                    </div> 
                </div>
                <div class="rBg" style="position: relative; width: 100%; min-height: 20px; padding-top: 3%;">
                    <a id="btnShareA" style=" display: none;" href="javascript:;"  onclick="shareBtn('<?php echo Yii::app()->createAbsoluteUrl('mobile/survey/'.$id,array('uid'=>$uid));?>', '<?php echo $sharetitle?$sharetitle:'测试';?>', '<?php echo $sharedesc?$sharedesc:'调查问卷测试';?>', '<?php echo Yii::app()->request->hostInfo;?>/image/banban/logo/logo.png')" class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/feng.png" />
                    </a> 
                    <div id="btnShareA2" style=" display: none; width:100%; margin: 0 auto; text-align: center; color: #00b7ee; font-size: 13px; padding: 3% 0;">每成功邀请一个新伙伴，再得最高10元班费卡</div>
                </div>
                <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_f.jpg"/>
                </div> 
            </section>
       </div>
       <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/banban/move3.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/api/base64.js"></script> 
       <script type="text/javascript"> 
        function getByClass(oParent, sClass){
            var aEle=oParent.getElementsByTagName('*');
            var aResult=[]; 
            for(var i=0;i<aEle.length;i++) {
                if(aEle[i].className==sClass) {
                        aResult.push(aEle[i]);
                }
            } 
            return aResult;
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
        };
        window.onload = function (){
            var layout = document.getElementById('layout'); 
            var iQp = getByClass(layout,'iQpage');
            for(var i=0; i< iQp.length; i++){
                iQp[i].style.height = setHeight()+'px'; 
            }
            if (browser.versions.iPhone) { //苹果客户端 
            } else if (browser.versions.android) {//Android客户端
                document.getElementById('btnShareA').style.display = 'block';  
                document.getElementById('btnShareA2').style.display = 'block';
            }else{
            }
            var stPic = document.getElementById('stampSpic');
            MotionFrames.startMove(stPic,{left :-100,top:-100},1,function(){
                MotionFrames.startMove(stPic,{left :55,top:55,opacity:100},0);
            });
            
        };
        function setHeight(){
            var hPage = window.document.body.clientHeight; 
            var hPageUsing = document.documentElement.clientHeight;
            if(hPageUsing > hPage){
                hPage = hPageUsing;
            }
            return hPage; 
        }
        
        
        function shareBtn(url, title, descs, imgUrl) {
            var sObj = '{"url":"' + Base64.encode(url) + '","title":"' + Base64.encode(title) + '","descs":"' + Base64.encode(descs) + '","imgUrl":"' + Base64.encode(imgUrl) + '"}';// 
            if (browser.versions.iPhone) { //苹果客户端
                window.location.href = "js-call://share/" + sObj;
            } else if (browser.versions.android) {//Android客户端
                PayHelper.share(url, title, descs, imgUrl);
            }else {
            }
        }

       </script>
   </body>
</html>

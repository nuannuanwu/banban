<!doctype html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>班班——萌娃这么晒，绝对是真爱</title>
    <meta name="viewport" content="width=640,target-densitydpi=device-dpi,user-scalable=no"> 
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"> 
    <meta content="yes" name="apple-mobile-web-app-capable">     
    <meta content="black" name="apple-mobile-web-app-status-bar-style">     
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" id="viewport" content="width=640">
     <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/image/favicon.ico">
    <style> 
        body,p,b,dl,dd,table,td,th,input,button,textarea,xmp,pre,img,form,div,ul,ol,li,h1,h2,h3,h4,h5,h6,header,section,nav,footer{margin:0;padding:0;}
        img,iframe,acronym{border:0;}
        *{-webkit-appearance: none;}
        ol,ul,li{list-style:none;}
        img,input,label,button{vertical-align:middle;}
        a {star:expression(this.onFocus=this.blur()); text-decoration:none; } 
        body,html{ width:100%; height:100%; background: #F59201;}
        #warps { width:640px; height:1008px; position:relative; overflow:hidden; margin:0 auto;}
        .photo_ok{ width:640px;  position: relative; margin-top:10px;}
        .photo_ok .imgInfo{ color: #292929; width:599px; margin: 0 auto; text-align: center; }
        .imgInfo>img{ width: 100%; }
        .photo_ok_img{ width:599px; height:468px; margin: 0 auto; background:url('/image/banban/babyface/loading.gif') no-repeat center center;   }
        .photo_ok_img>img{ max-width:100%;}
        .photo_ok_text{ padding-top:15px; width:100%; text-align:center; margin-top: 20px;} 
        .photo_ok_text img{ width: 35%;}
        .photo_ok_text1{ display: block; font-family:"黑体"; font-size:28px; width:100%; text-align:center; padding-top:15px; line-height:160%; color: #fff;}
        .again{ overflow: hidden; display: block; height: 40px; text-align: center; margin-top: 30px; width: 100%;}
        .again a{ text-decoration: underline; color: #FFFFFf; font-size: 28px;}
    </style>
    <body>
        <div id="warps" style=" width:640px; height: 100%; overflow: hidden; position: relative;">
            <div class="photo_ok" style="">
                <div class="imgInfo">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/babyface/t_<?php echo $imgtype;?>.png"/>
                </div>
                <div class="photo_ok_img">
                    <img src="<?php echo $fileNme;?>">
                </div>
                <span class="photo_ok_text1">变身完成！<br>最拉风的萌娃照新鲜出品，<br>还不快晒晒萌娃新造型！<br>长按上方图片保存到本地相册,并分享给好友 </span>
                <div class="photo_ok_text" id="shareRemind"> 
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/babyface/shareBtn.png"/>
                </div> 
                <div class="again">
                    <a href="<?php echo Yii::app()->createUrl('/wxdev/babyface');?>">再试一次</a>
                </div>
            </div>
            <div id="pupTier" style="display: none; width: 100%; height: 100%; background: #000; position: absolute; left: 0; top:0; opacity: 0.7; z-index: 999;" >
                <div class="share">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/babyface/share.png">
                </div> 
            </div> 
        </div>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/banban/babyface/jquery.1.4.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/banban/babyface/zepto.min.js"></script> 
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript"> 
            var strPolarBearWebRoot  = '<?php echo Yii::app()->createAbsoluteUrl('/wxdev/wxshaer');?>'+'?fn='+'<?php echo $fileNme;?>'+'&p='+'<?php echo $imgtype;?>';
            var strPolarBearPicRoot = 'http://www.banban.im'+'<?php echo $fileNme;?>';
        </script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/banban/babyface/wcs.js"></script>
        <script>
            $(document).ready(function () {
                //分享提示
                $('#shareRemind').click(function(){
                    $('#pupTier').show();
                });
                $('#pupTier').click(function(){
                    $(this).hide();
                });
            });
        </script>
        <script>
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage["appId"];?>',
            timestamp: <?php echo $signPackage["timestamp"];?>,
            nonceStr: '<?php echo $signPackage["nonceStr"];?>',
            signature: '<?php echo $signPackage["signature"];?>',
            jsApiList: [
              // 所有要调用的 API 都要加到这个列表中
               //'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'translateVoice',
            'startRecord',
            'stopRecord',
            'onRecordEnd',
            'playVoice',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'closeWindow',
            'scanQRCode',
            'chooseWXPay',
            'openProductSpecificView',
            'addCard',
            'chooseCard',
            'openCard'
            ]
        });
  
</script>
<script>
    //百度统计
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?1ef1ca666d51f73f124385c51037c5d0";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
</script> 
    </body>
</html>
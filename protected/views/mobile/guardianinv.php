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
    <title>邀请关注人</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <style>
         ,* { tap-highlight-color: transparent }
        * { -webkit-tap-highlight-color: transparent; }
        html,body{ width: 100%; height: auto; padding: 0;  margin: 0 auto; background-color: #fff;}
        body{ position: relative;}
        p,div{ padding: 0; margin: 0;}
        .layout{ position: relative; max-width:750px; height: 100%; margin:0 auto;  font-family: "黑体"; background:url('/image/banban/mobile/g_bg.jpg'); background-size: contain; z-index: 1; } 
        .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
        .img-box{ position: relative; width: 100%; margin: 0 auto; margin-top: 5%; margin-bottom:2%; }
        .img-box img{display:block; max-width: 100%; height: auto; } 
        .img-box img.pic{ border-radius: 100%; -moz-border-radius: 100%; -webkit-border-radius: 100%;}
        .b-p{ position: absolute;left: 0; width: 100%; text-align: center; }
        .b-c{ }
        .b-c p{ padding: 2% 0; color: #4f4f4f; }
        .b-c p span.u-nme{ color:#f59201;}
    </style> 
   
</head>
<body>
    <div id="layout" class="layout">
        <div class="b-p b-c" style="top:10%;">
            <p><span class="u-nme">“<?php echo $user->name?$user->name:''; ?>”</span></p>
            <p>邀请您关注他的孩子</p>
            <div class="img-box" style=" width: 100px; height: 100px;">
                <img class="pic" width="100" height="100" src="<?php
                echo preg_match('/^http/',$child->photo)? $child->pboto:(STORAGE_QINNIU_XIAOXIN_TX.'/'.$child->photo); ?>" onerror="javascript:this.src='<?php echo Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png';?>'" />
            </div> 
            <p><span class="u-nme"><?php echo $child->name; ?></span></p> 
            <p><?php echo count($child->info)?$child->info[0]->cName:''; ?></p>
            <p><?php echo count($child->info)?$child->info[0]->schoolName:''; ?></p>
        </div> 
        <div class="b-p" style=" bottom: 5%;"> 
            <div class="img-box"> 
                <a class="" href="http://t.cn/Ry2M2cG"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/btn_g.png" /></a> 
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function JId(idd){
            var obj = {};
            if( typeof( idd ) === 'string'){
                var idName = idd.substr(1, idd.length ); 
                if( idd.substr(0,1) === '#' ){
                    obj = document.getElementById(idName);
                }   
            } else {
                obj = idd;
            }
            return obj;
        }
        window.onload = function(){ 
            JId('#layout').style.height = setHeight()+'px'; 
        };
        function setHeight(){
            var hPage = window.document.body.clientHeight; 
            var hPageUsing = document.documentElement.clientHeight;
            if(hPageUsing > hPage){
                hPage = hPageUsing;
            }
            return hPage; 
        } 
    </script>
</body>
</html>
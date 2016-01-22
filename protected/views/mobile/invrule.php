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
    <title>千万班费等你来拿</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/api/min.slip.js"></script>  
    <style>
        ,* { tap-highlight-color: transparent }
        * { -webkit-tap-highlight-color: transparent; }
        html,body{ width: 100%; height: auto; padding: 0;  margin: 0 auto; background-color: #fef0bf;}
        body{ position: relative;}
        p,div{ padding: 0; margin: 0;}
        a{ text-decoration: none; color: #4c4c4c; }
        .f-left{ float: left; }
        .f-right{ float: right; }
        .layout{ position: relative; max-width:750px;  background-color: #FA754A; height: 100%; margin:0 auto; overflow:hidden; font-family: "黑体"; } 
        .layout-main {position: relative; width: 100%; padding: 0px; margin: 0 auto;  min-width:280px;}
        .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
        .img-box{ position: relative; width: 100%; }
        .img-box img{display:block; max-width: 100%; height: auto; vertical-align:text-bottom; }
        .b-p{ position: absolute;left: 0; top:0%; width: 100%; text-align: center; }
        .b-p .t-t{ margin-bottom: 5px; font-size: 18px; color:#f6f3b6;}
        .b-p .t-c{ width: 60%; text-align: center; font-size: 32px; color:#f8dd5e; margin-bottom: 3%; margin: 0 auto; }
        .c-box{ min-height:80px; padding-bottom: 5%; text-align: center; margin: 0 auto;}
        .c-box p{ color: #f59201; margin: 5px 0; font-size: 17px; }
        .banner{position: relative; width: 100%;  margin: 0 auto; text-align: center; padding: 0; font-size:17px;  margin-bottom: 15px; overflow: hidden; }
        .btn{ display: inline-block; width: 75%; height: 40px; line-height: 40px;   padding: 0px 8px; font-size: 18px; background-color: #f59201; border: 1px solid #f59201; border-radius: 6px; color: #ffffff; }
        .line { height: 30px; line-height: 30px; padding: 10% 0;  color: #FFFFFF; background:url('/image/banban/mobile/clas/line2.png') center no-repeat; background-size: 100%; text-align: center;  }
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
<body>
    <div id="layout" class="layout"> 
        <div class="layout-main">
            <div class="img-box">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/invit/i_tl_01.jpg" />
            </div>
            <div class="banner"> 
                <div class="line"> 活动规则 </div>
                <div class="" style=" width: 85%; margin: 0 auto; text-align: left; color: #FFFFFF; line-height: 30px;">
                    <p>1.每推荐一名新用户注册班班，即可获得1~10元随机班费卡奖励；</p>
                    <p>2.被推荐用户完成班班教师认证，推荐人可另外获得10元班费卡奖励。</p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript"> 
        window.onload = function (){
            if(JId('#layout')){
                JId('#layout').style.height = setHeight()+'px';
            }
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
    </script>
</body>
</html>
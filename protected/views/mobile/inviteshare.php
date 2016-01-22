<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
        <meta http-equiv="cleartype" content="on">
        <title>班班使用条款</title>
        <style>
            ,* { tap-highlight-color: transparent }
            * { -webkit-tap-highlight-color: transparent; }
            html,body { width: 100%; height: auto; padding: 0; margin: 0 auto; font-size: 16px; background-color: #f5f5f3;} 
            ul,ul li{ list-style: none;padding:0; margin:0; }
            input:focus { outline:none; }
            a{ text-decoration: none; }
            .f-left{ float: left; }
            .f-right{ float: right; } 
            .layout{ position: relative; max-width:640px; min-width:280px; margin:0 auto; padding-bottom: 80px; overflow:hidden; font-family: "黑体";}
            .layout-main {position: relative; width: 100%; padding: 0px; margin: 0 auto;}
            .i-box{ position: relative; width: 100%; text-align: center;}
            .i-box img{ max-width: 100%; height: auto; display: inline-block; vertical-align:text-bottom;  *vertical-align: auto;}
            .box{ width: auto; padding:0 15px 15px 15px; margin: 0 auto;  margin-bottom: 15px; overflow: hidden; }
            .s-t{ font-size:20px; color: #f59201; text-align: center; padding: 15px 0; }
            .b-cent{width: 100%; min-height: 150px;}
            .b-txt{ position: absolute; left: 10%; top:32%; width: 80%; min-height: 100px; font-size: 14px;}
            .b-txt p{ padding: 0; margin: 0; }
            .b-txt p span{ color: #f59201; }
            .b-t{ height: 30px; line-height: 30px; padding-bottom: 10px; color: #777777; font-size: 15px; text-align: center; } 
            .line { height: 30px; line-height: 30px; padding: 20px 0; background:url('/image/banban/mobile/tc/line.png') center no-repeat; background-size: 100%; text-align: center;  }
            .u-box { position: relative; width: 100%; } 
            .e-box{ width: 60%; min-height:100px; margin: 0 auto; overflow: hidden;  }
        </style> 
    </head>
    <body> 
        <div id="content" class="layout">
            <div class="layout-main">
                <div class="b-cent i-box">
                    <div class="b-txt">
                        <p>1.每推荐一名新用户注册班班，即可获得<span>1~10元</span>随机班费卡奖励； </p>
                        <p>2.被推荐用户完成班班教师认证，推荐人可另外获得<span>10元</span>班费卡奖励。 </p>
                    </div>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/tc/in_b.jpg"/>
                </div>
                <div class="line" style=" padding-bottom: 0;">
                    <span>短信推荐</span>
                </div>
                <div class="u-box"> 
                    <div class="b-t">请输入您要推荐的用户的手机号码</div> 
                    <form id="fileToUploadForm" enctype="multipart/form-data" method="post" action=""> 
                        <div class="i-box" style="position: relative; min-height: 30px; overflow: hidden" > 
                            <input type="tel"  name="fileSToUpload" maxlength="11" autocomplete="off" onchange="chengUpFlie();" id="fileToUpload" placeholder="手机号码" style=" position: absolute; left: 6.5%; top:2px; width: 82%; height: 75%; border: none; font-size: 16px; ">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/tc/t_input.png"/> 
                        </div>
                        <div class="row i-box" style=" margin-top: 20px; min-height: 30px;">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/tc/in_btn.png"/>
                            <input type="submit" value="" style=" position: absolute; left: 5%; top:0; width: 90%; height: 100%; opacity: 0;" />
                        </div>
                    </form>
                </div>
                <div class="line">
                    <span>扫码注册</span>
                </div>
                <div class="e-box">
                    <div class="i-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/tc/erlog.jpg"/>
                    </div>
                </div>
            </div>
        </div> 
    <script type="text/javascript"> 
        function chengUpFlie(){ 
            var formPost = document.getElementById('fileToUploadForm');
            formPost.submit(); 
        }  
    </script>
    </body>
</html>
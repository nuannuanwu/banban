<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content=""> 
        <meta name="MobileOptimized" content="320">
        <meta http-equiv="cleartype" content="on">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
        <meta content="yes" name="apple-mobile-web-app-capable" /> 
        <meta content="black" name="apple-mobile-web-app-status-bar-style" /> 
        <meta content="telephone=no" name="format-detection" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/mobile.css'); ?>">
        <title>班班，免费家校沟通新模式！</title>
        <style>
            .containter{
                max-width:640px;
                min-width:320px;
                margin:0 auto;
                overflow:hidden; 
            }
            .containter img{
                max-width:100%;
                vertical-align:middle;
            }
            .scroll{
                position: fixed;
                right: 10px;
                bottom: 50px;
                cursor: pointer;
            }
        </style>
    </head>
    <body >
         <div class="containter">
             <div class="shareBox"  style=" background-color: #F6F1DE;">
                <div class="imgBox" style="max-width:640px;">
                     <div style=" padding: 2% 2%; background:url(/image/banban/share/bg_web.png) repeat-y; overflow: hidden;">
                        <div class="pic" style=" float: left; width:13%; overflow: hidden; background:url(<?php echo $user->photo?$user->photo:Yii::app()->request->baseUrl.'/image/banban/share/pic_app.png';?>) no-repeat; background-size:85%; height: 100px;">
                            <!--<img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/pic_app.png" alt="">--> 
                        </div>
                         <div style=" margin-left: 13%;">
                             <div style=" font-size: 14px; color: #808080; margin-bottom: 5px; margin-left: 5px;"><?php echo $user->name; ?></div>
                             <div style="background:url(/image/banban/share/msBg_app.png) no-repeat; background-size:88%; overflow: hidden;">
                                 <div style=" font-size: 14px; color: #000000; padding: 1.5% 16% 4% 6%; line-height: 20px;">
                                     大家好！我在班班<?php if($role=='1'):?>创建了<?php else: ?>加入了<?php endif;?>“<span style=" color: #f59201;"><?php echo $class->name; ?></span>” 快来一同加入吧。
                                 </div>
                             </div>
                        </div>
                     </div> 
                 </div> 
                 <div class="imgBox">
                     <img class="return"  src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/coede_app.jpg" alt=""> 
                 </div> 
                 <div class="imgBox" style=" overflow: hidden; background:url(/image/banban/share/coede_app1.jpg) center repeat-y; background-size: contain;"> 
                     <div style="width: 64.815%; overflow: hidden; text-align: center; background:url(/image/banban/share/coedeBg_app.png) center no-repeat;  background-size: contain; color: #674f0d; padding: 12px 0;  margin: 0px auto;  font-size: 32px;"> 
                         <?php echo ($class->classcode ? $class->classcode : "未分配"); ?>
                     </div> 
                 </div>
                 <div class="imgBox" style=" position: relative; padding-top:20px;  background:url(/image/banban/share/coede_app1.jpg) center repeat-y; background-size: contain;">
                     <div style=" width: 100%; text-align: center;  position: absolute; color: #674f0d;font-size: 13px; left:0; top:0%;"> 
                        <div style=" width: 65%; display: inline-block;">加入班级时，输入<span style=" color: #f59201;">班级代码</span>或<span style=" color: #f59201;"><?php if($role=='1'):?>我的手机号<?php else: ?>班主任手机号<?php endif;?></span>，就可以加入“<span style=" color: #f59201;"><?php echo $class->name; ?></span>” 
                        </div>  
                     </div>
                     <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/join_app.jpg" alt=""> 
                 </div>
                <div class="imgBox" style=" background:url(/image/banban/share/joinBtnBg_app.jpg) center no-repeat; background-size: cover;">
                    <a href="http://app.banban.im/install" style=" width:65.5555555%;display: block;   margin: 0 auto; ">
                        <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/joinBtn_app.png" alt=""> 
                    </a>
                </div>
                 <div class="imgBox">
                     <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/explain_app.jpg" alt=""> 
                 </div>
                 <div class="imgBox">
                     <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/function1_app.jpg" alt=""> 
                 </div>
                 <div class="imgBox">
                     <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/function2_app.jpg" alt=""> 
                 </div> 
             </div>
         </div>  
    </body>
</html>
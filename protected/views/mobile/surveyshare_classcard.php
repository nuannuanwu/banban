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
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/banban/move3.js"></script>
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
                    <?php if($status==0||$status==1993):?>
                    <?php if($status==0):?>
                            <!--成功领取-->
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_r_4.jpg"/>
                            <?php elseif($status==1993):?>
                            <!--已经领取了-->
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_r_5.jpg"/>
                            <?php endif;?>
                    <div class="b-p" style="top:45%;">
                        <span style=" font-size:32px; color:#eb5251;">&nbsp;<?php echo sprintf("%.2f",$money['amt']/100);?></span>
                    </div>
                    <?php elseif($status==1992):?>
                        <!--已经注册过-->
                        <div class="rBg" style=" position: relative; width: 100%; margin: 0 auto;">  
                            <img style=" padding: 10% 0;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/b_r.jpg"/>
                        </div>
                    <?php else:?>
                         <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_r_6.jpg"/>
                    <?php endif;?>
                </div> 
                <div class="rBg" style=" position: relative; width: 100%; margin: 0 auto;">
                    <?php if($status==0||$status==1993):?> 
                     <div style=" width: 76%; margin: 0% auto; padding: 4% 0; font-size: 16px; color: #00b7ee;">
                        班费卡已放入<?php echo $mobilephone;?>账户中
                     </div>
                     <?php endif;?>
                     <div class="img-box"> 
                         <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/l_line.jpg"/>
                     </div> 
                 </div>  
                <div class="rBg" style=" position: relative; width: 100%; margin: 0 auto;">  
                    <?php if($bt=='web'):?><!--pc端下载-->
                    <div class="img-box" style=" width: 76%;  margin: 0 auto; padding-top: 5%; text-align: center;">  
                        <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/erweima.jpg" /><!--二维码-->
                    <?php else:?>
                    <div class="img-box" style=" width: 76%;  margin: 0 auto; padding-top: 15%;"> 
                    <a href="<?php echo APP_MOLO_DOWNLOAD_URL; ?>"> <!--手机端-->  
                        <?php if($status!=1992):?>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/btn_r.jpg"/>
                        <?php else:?>
                        <!--已经注册过-->
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/btn_r1.jpg"/>
                        <?php endif;?>
                    </a>
                    <?php endif;?>
                    </div>
                    <div style=" width: 80%; margin: 0% auto; padding-top: 5%; text-align: center; font-size: 12px; color: #00b7ee;">
                        班班，能赚班费涨知识的家校沟通神器
                    </div>
                    <div style=" width: 80%; text-align: center; line-height: 25px; margin: 0% auto;  padding: 10% 0; font-size: 12px; color: #00b7ee;">
                        为老师减负，为家长补习<br/>
                        发作业，发通知，最尽责的老师都在这里<br/>
                        名校？成绩？给家长最全面的教育咨询
                    </div>
                </div> 
                <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_f.jpg"/>
                </div> 
            </section>
       </div>
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
        window.onload = function (){
            var layout = document.getElementById('layout');
            layout.style.height = setHeight()+'px'; 
            var iQp = getByClass(layout,'iQpage');
            for(var i=0; i< iQp.length; i++){
                iQp[i].style.height = setHeight()+'px'; 
            } 
        }
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

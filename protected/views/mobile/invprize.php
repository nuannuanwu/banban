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
    <title>邀请有礼</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <style>
        ,* { tap-highlight-color: transparent }
        * { -webkit-tap-highlight-color: transparent; }
        html,body{ width: 100%; height: auto; padding: 0;  margin: 0 auto; background-color: #fda36e;}
        body{ position: relative;}
        p,div{ padding: 0; margin: 0;}
        a{ text-decoration: none; color: #4c4c4c; }
        .f-left{ float: left; }
        .f-right{ float: right; }
        .layout{ position: relative; max-width:750px; height: 100%; margin:0 auto; padding-bottom: 10%; overflow:hidden; font-family: "黑体"; } 
        .layout-main {position: relative; width: 100%; padding: 0px; margin: 0 auto;  min-width:280px;}
        .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
        .img-box{ position: relative; width: 100%; }
        .img-box img{display:block; max-width: 100%; height: auto; }
        .b-p{ position: absolute;left: 0; top:0%; width: 100%; text-align: center; }
        .b-p .t-t{ margin-bottom: 5px; font-size: 21px; color:#ffffff;}
        .b-p .t-c{ width: 60%; text-align: center; font-size: 42px; color:#ffffff; margin-bottom: 3%; margin: 0 auto; }
        .c-box{ padding-bottom: 5%; text-align: center; margin: 0 auto;}
        .c-box p{ color: #f59201; margin: 3px 0; font-size: 17px; }
        .banner{position: relative; width: 90%;  margin: 0 auto; text-align: center; padding: 0; font-size:14px;  margin-bottom: 15px; overflow: hidden; }
        .btn{ display: inline-block; width: 75%; height: 40px; line-height: 40px;   padding: 0px; font-size: 18px; background-color: #f59201; border: 1px solid #f59201; border-radius: 6px; color: #ffffff; }
        .line { height: 30px; line-height: 30px; color: #ffffff; background:url('/image/banban/mobile/clas/line2.png') center no-repeat; background-size: 100%; text-align: center;  }
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
<body <?php if($ac=='webac'): ?>style=" background-color:#f97249; "<?php endif; ?>> 
    <?php if(!$ac): ?>
    <div id="container" >
        <div class="page page-1">
            <div class="layout" style=" background-color:#FA7248; <?php if($bt=='web'): ?>width: 430px;<?php endif; ?>"> 
                <div class="layout-main">
                    <div class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/invit/i_t_01.jpg" />
                        <div class="b-p" style="top:26%; text-align: left;">
                            <div style=" width: 56%; margin-left: 13%; font-size: 16px; color: #ffffff;"><span><?php echo $user->name; ?>送你了一张班费卡</span></div>
                        </div>    
                    </div>
                     <div class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/invit/i_t_02.jpg" /> 
                    </div>
                    <div class="u-box"> 
                        <form id="formBoxRegister" action="" method="post">
                           <div style=" width: 100%; margin: 0 auto; padding: 0; overflow: hidden;">
                               <div id="p1" style=" margin-bottom: 10px; padding-top: 5%; font-size: 15px; color: #ffffff; text-align: center;">
                                   班班，能赚班费涨知识的家校沟通神器
                               </div>
                               <div style=" width: 81%; padding:5% 0; margin: 0 auto;">
                                   <div style="display: inline-block; position: relative; width: 98%; padding: 0px; border-radius: 6px; height: 42px; border: 1px solid #d7d7d7; background: #ffffff; overflow: hidden;">
                                       <input name="sendmobile" id="webPlaInput" type="text"  maxlength="11" autocomplete="off" onfocus="plasInpt('webPlaInput','webPlatext');"  onblur="plastt('webPlaInput','webPlatext');" style=" position: relative; z-index: 100; text-align: center; width:98%; height: 40px; line-height: 40px; font-size: 16px; color: #827c7c; padding: 0; margin: 0; border: none; outline: none; background: none;"  value="">
                                       <div id="webPlatext"  onmousedown="hideThis('webPlatext');" style="display: block; position: absolute; width: 100%; top:0; left: 0%; font-size: 18px; height: 42px; line-height: 42px; color: #827c7c; text-align: center; z-index: 1;">输入手机号</div>
                                   </div>
                                   <div  style="padding: 0; margin:0 auto; margin-top:3%;  overflow: hidden;  text-align: center;">
                                        <!--<input type="submit" class="btn" value=" 立即领取" style=" width: 100%; margin-top: 1px; height: 42px; font-size: 18px; background: #f59201;" />--> 
                                        <a href="javascript:chengUpFlie();" class="btn" style=" width: 98%; margin-top: 1px; height:40px; font-size: 18px;" >立即领取</a>
                                    </div>
                               </div>
                           </div> 
                        </form>
                    </div>
                    <?php if($bt=='app'): ?>
                    <div style="text-align: center;  ">
                        <a href="<?php echo Yii::app()->createUrl('mobile/invrule'); ?>" style=" color: #ffffff; font-size: 17px;"> 查看活动规则 &gt;&gt;</a>
                    </div>
                    <?php else: ?>
                    <div class="banner"> 
                        <div class="line"> 活动规则 </div>
                        <div class="" style=" text-align: left; color: #ffffff; line-height: 22px;">
                            <p>1.每推荐一名新用户注册班班，即可获得0.5~10元随机班费卡奖励；</p>
                            <p>2.被推荐用户完成班班教师认证，推荐人可另外获得10元班费卡奖励。</p>
                        </div>
                    </div>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
        <div class="page page-2" style="">
            <div class="layout" style="background-color: #ffffff; <?php if($bt=='web'): ?>width: 430px;  padding-bottom: 30px;<?php endif; ?>"> 
                <div class="layout-main">
                    <div class="img-box" style="padding: 10% 0;">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/a_03.jpg" />
                    </div>
                    <div  class="c-box" style=" ">
                        <p>班班，为老师减负，为家长补习</p>
                        <p>发作业，发通知， 最尽责的老师都在这里</p>
                        <p>名校？成绩？给家长最全面的教育资讯</p> 
                    </div>
                    <div class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/a_04.jpg" />
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/a_05.jpg" />
                    </div>
                    <div  style="padding: 0; margin: 0 auto; margin-top: 10%; overflow: hidden;  text-align: center;">
                        <?php if($bt=='app'): ?>
                            <a class="btn" href="<?php echo APP_MOLO_DOWNLOAD_URL; ?>" style=" width: 80%; margin-top: 1px; height: 42px; font-size: 18px; background: #f59201;">去看看</a>
                            <?php else: ?>
                            <a class="btn" href="<?php echo Yii::app()->createUrl('mobile/invprizescan'); ?>" style=" width: 80%; margin-top: 1px; height: 42px; font-size: 18px; background: #f59201;">去看看</a>
                        <?php endif ?>
                        <!-- <a href="" class="btn" style=" width: 80%; margin-top: 1px; height: 42px; font-size: 18px; background: #f59201;" >去看看</a>  -->
                    </div>
                </div>
            </div>
        </div> 
    </div> 
    <?php endif; ?> 
    <?php if($ac=='appac'): ?>
        <div class="page page-1" style="">
            <div id="layout" class="layout" style=" background-color: #fa754b;"> 
                <div class="layout-main">
                    <div class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/invit/i_td_01.jpg" />
                        <div class="b-p" style=" top:30%;">
                            <div class="t-t">恭喜您得到</div>
                            <div class="t-c"><?php echo sprintf("%.2f",round(Yii::app()->request->getParam('money')/100,2)); ?>元 
                            </div>
                            <div style="color:#fdebbe; font-size: 16px;">班费卡</div>
<!--                            <div style=" width: 72%;  margin: 0 auto; font-size: 17px; line-height: 25px; color: #f6f3b6;  margin-top:3%;">
                                加上你的<?php echo sprintf("%.2f",round(Yii::app()->request->getParam('money')/100,2)); ?>,你们班可能有很多班费了， 你造吗！Y(^o^)Y
                            </div>-->
                        </div> 
                    </div> 
                     <div class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/invit/i_td_02.jpg" /> 
                    </div>
                    <div style=" width: 98%;padding-top: 2%; margin: 0 auto;  color: #ffffff; font-size: 17px; line-height: 30px; text-align: center;">
                        <p>班费卡要在2周内用掉哦 O(∩_∩)O~</p>
                    </div> 
                    <div  style=" margin: 5% auto; overflow: hidden;  text-align: center;">
                        <a href="<?php echo APP_MOLO_DOWNLOAD_URL; ?>" class="btn" style=" height: 42px; line-height: 42px; background-color: #f3b409;">上APP赚更多</a>
                    </div>
                    <div style=" width: 98%; margin: 0 auto;  color: #ffffff; font-size: 17px; line-height: 30px; text-align: center;">
                        <p> 班班，能赚班费涨知识的家校沟通神器</p>
                    </div> 
                </div>
            </div>
        </div> 
    <?php endif; ?> 
    </div> 
    <?php if($ac=='webac'): ?>
    <div class="page page-1" style="background: #fb784e;">
        <div id="layout" class="layout" style=" max-width: 430px; background: #FA7248; "> 
            <div class="layout-main">
                <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/invit/i_td_01.jpg" />
                     <div class="b-p" style=" top:30%;">
                        <div class="t-t" style=" margin-bottom: 5px;">恭喜您已经抢到了</div>
                        <div class="t-c" style=" font-size: 44px;  margin-bottom: 5px;">
                            <?php echo sprintf("%.2f",round(Yii::app()->request->getParam('money')/100,2)); ?>元
                        </div>
                        <div style="color:#fdebbe; font-size: 14px; " >班费卡</div>
<!--                        <div style=" width: 72%;  margin: 0 auto; font-size: 18px; line-height: 25px; color: #f6f3b6;  margin-top:5%;">
                            加上你的<?php echo sprintf("%.2f",round(Yii::app()->request->getParam('money')/100,2)); ?>,你们班可能有很多班费了， 你造吗！Y(^o^)Y
                        </div>-->
                    </div> 
                </div>
                 <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/invit/i_td_02.jpg" />
                   
                </div>
                <div style=" width: 80%; margin: 0 auto; padding-bottom: 20px;">
                    <form id="formBoxRegister" action="" method="post">
                    <div style=" margin: 10px 0; font-size: 18px; color: #ffffff;">
                        免费发送短信到手机下载
                    </div>
                    <div style=" padding: 20px 0;">
                        <div style="display: inline-block; position: relative; width: 60%; padding: 0 10px; border-radius: 0px; height: 42px; border: 1px solid #d7d7d7; background: #ffffff; overflow: hidden;">
                            <input name="recmobile" id="webPlaInput" type="text" maxlength="11" autocomplete="off"  onfocus="plasInpt('webPlaInput','webPlatext');"  onblur="plastt('webPlaInput','webPlatext');" style=" position: relative; z-index: 2; width:98%; height: 40px; font-size: 16px; color: #827c7c; padding: 0; margin: 0; border: none; outline: none; background: none;"  value="<?php echo Yii::app()->request->getParam('mobile'); ?>">
                            <div onmousedown="hideThis('webPlatext');" id="webPlatext" style="display: block; position: absolute; width: 100%; top:0; left: 5%; font-size: 18px; height: 42px; line-height: 42px; color: #827c7c;z-index: 1;">输入手机号</div>
                        </div>
                        <input type="submit" class="btn" value=" 发送" style=" width: 30%; margin-top: 1px; height: 42px; float: right;  background: #f59201;" />
                    </div>
                </form>
                </div>
                <div class="line" style=" text-align: center;">其他下载方式
                    <!--<img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/t_s3.png" />--> 
                </div>
                 <div class="img-box" style=" text-align: center; margin: 30px 0;">
                    <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/erweima.jpg" />
                    <p style=" font-size: 18px; margin-top: 15px; color: #ffffff;">二维码扫描下载</p>
                </div>
                <div  style="padding: 0; margin: 30px; overflow: hidden;  text-align: center;">
                    <a href="<?php echo WEB_IOS_DOWNLOAD_URL; ?>" class="btn" style=" color: #ffffff;">IOS下载</a>
                </div>
                <div  style="padding: 0; margin: 30px; overflow: hidden;  text-align: center;">
                    <a href="<?php echo WEB_ANDROID_MOLO_DOWNLOAD_URL; ?>" class="btn" style=" color: #ffffff;">Android下载</a>
                </div>
                 
            </div> 
        </div> 
    </div>
    <?php endif; ?>                                                                                                                                                 
    <?php Yii::app()->msg->printMsg();?> 
<script type="text/javascript"> 
    window.onload = function (){
        if(JId('#layout')){
            JId('#layout').style.height = setHeight()+'px';
        }
        var defmobile = JId("#webPlaInput");
        if(defmobile.value!=""){
            plasInpt('webPlaInput','webPlatext');
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
    function chengUpFlie(){ 
        var formPost = document.getElementById('formBoxRegister');
        formPost.submit(); 
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
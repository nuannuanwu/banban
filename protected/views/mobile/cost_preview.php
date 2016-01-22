<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0, user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"> 
    <meta content="yes" name="apple-mobile-web-app-capable" /> 
    <meta content="black" name="apple-mobile-web-app-status-bar-style" /> 
    <meta content="telephone=no" name="format-detection" /> 
    <title>晒班费</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <style>
        ,* { tap-highlight-color: transparent }
        * { -webkit-tap-highlight-color: transparent; }
        html,body{ width: 100%; height: auto; padding: 0; margin: 0 auto; background-color: #FE8E04;}
        body{ position: relative;}
        p,div{ padding: 0; margin: 0;}
        a{ text-decoration: none; color: #4c4c4c; }
        .f-left{ float: left; }
        .f-right{ float: right; }
        .c-y{ color: #f59201;}
        .btn{ display: inline-block; width: 75%; height: 40px; line-height: 40px;   padding: 0px 8px; font-size: 16px; background-color: #f59201; color: #F79301; border: 1px solid #f59201; border-radius: 6px; color: #ffffff; }
        .layout{ position: relative; max-width:640px; height: 100%; margin:0 auto; padding-bottom: 5%; overflow:hidden; font-family: "黑体";background-color: #fef0bf;}
        .layout-main {position: relative; width: 100%; padding: 0px; margin: 0 auto;  min-width:280px;}
        .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
        .img-box{ position: relative; width: 100%; }
        .img-box img{display:block; max-width: 100%; height: auto; vertical-align:text-bottom; }
        .card-box{ position: absolute; left: 0; width: 100%; margin: 0 auto; text-align: center; overflow: hidden; border: none;  }
        .c-title {font-size: 19px; color: #ff8601; }
        .c-center{  }
        .c-bottom{ margin-top: 3%; font-size: 17px; color: #603b0f; } 
        .c-box{ min-height:80px; padding-bottom: 5%; text-align: center; margin: 0 auto;}
        .c-box p{ color: #f59201; margin: 5px 0; font-size: 17px; }
        .btnBox { padding: 0; margin: 0 auto; margin-top: 10%; overflow: hidden;  text-align: center;}
        .btnBox .btn{ width: 80%; margin-top: 0px; height: 42px; font-size: 18px; background: #f59201;} 
        .e-box{ position: fixed; left: 0; bottom: 10%;  width: 100% ;margin: 0 auto; text-align: center; }
        .e-box .up-ioc{ position: absolute; left: 0; top:0; width: 100%; height: auto; }
        .o-nav{ position: absolute; left: -8%; top:4%; width: 20%; height: 54%; background: url("/image/banban/mobile/clas/o_nav.png") center no-repeat; }
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
<body style="<?php if($ac=='webac'): ?>background-color: #FEF0BF;<?php endif; ?> "> 
<?php if($ac!='webac'): ?>
    <div id="container" >
        <div class="page">
            <div class="layout" style="background-color: #e1550b; <?php if($bt=='web'): ?>width: 430px;<?php endif; ?>"> 
                <div class="layout-main">
                    <div class="img-box" style=" min-height: 120px;">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_pm_01.jpg" />
                        <div class="card-box" style="top:10%; left: 9%; width: 16%;">
                            <div class="img-box"  style=" margin: 0 auto; border-radius: 50%; -moz-border-radius: 50%; -webkit-border-radius: 50%; overflow: hidden; " >                      
                                <img src="<?php echo STORAGE_QINNIU_XIAOXIN_TX.$user->icon; ?>?imageView2/1/w/150/h/150" onerror="javascript:this.src='<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_i_01.jpg'"/>
                            </div> 
                        </div> 
                        <div class="card-box" style="left:30%; top:10%; width: 65%; overflow: visible;">
                            <div class="" style="margin-bottom: 6%;text-align: left; color: #ffffff; font-size: 16px;">
                               <?php echo $user->name; ?>
                            </div>
                            <div class="hi-txt" style=" position: relative; width:90%; padding:3% 2% 3% 8%; text-indent: 2em;  border-radius: 15px;  background-color: #fef0bf; text-align: left; color:#b66834;  font-size:17px;">
                                HI,今天我又为班赚了一笔，我们已经有<?php printf('%0.2f',$feeInfo[0]['dBalance']);?>元班费了~
                                <span class="o-nav"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="img-box" style=" min-height: 200px;">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_pm_02.jpg" />
                        <div class="card-box" style="top:0; color: #d42820;"> 
                            <div style="font-size: 17px;"><?php echo isset($class) ? $class->name : '未知班级';?></div>
                            <div class="c-center">
                                <p >班费累积总额</p>
                                <p><span style=" <?php if($bt=='web'): ?> font-size: 38px;<?php else:?>font-size: 32px;<?php endif; ?>"><?php printf('%0.2f',$feeInfo[0]['dTotalIncome']);?>元</span></p>
<!--                                <div class="c-bottom" >
                                    班费当前余额 <span style=" color: #F10D0C;font-size: 18px;font-weight: 700;"><?php printf('%0.2f',$feeInfo[0]['dBalance']);?>元</span>
                                </div>-->
                            </div>
                         </div>
                    </div> 
                    <div class="btnBox">  
                        <?php if($bt=='app'): ?>
                        <a class="btn" href="<?php echo APP_MOLO_DOWNLOAD_URL; ?>">马上领班费</a>
                        <?php else: ?>
                        <a class="btn" href="<?php echo Yii::app()->request->url.'&ac=webac'; ?>">马上领班费</a>
                        <?php endif ?>
                        <div style=" width: 98%; margin: 5% auto;  color: #ffffff; font-size: 17px; line-height: 30px; text-align: center;">
                            <p> 班班，能赚班费涨知识的家校沟通神器</p>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>  
        <div class="page" style="position: relative;">
            <div class="layout" style=" background-color: #e1550b; <?php if($bt=='web'): ?>width: 430px;<?php endif; ?>"> 
                <div class="layout-main">
                    <div class="img-box" style=" min-height: 200px;">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_pm_03.jpg" />
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_pm_04.jpg" />
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_pm_05.jpg" />
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_pm_06.jpg" /> 
                    </div> 
                    <div class="img-box i-box" style=" min-height: 100px;">
                       <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_pm_07.jpg" /> 
                        <div class="card-box" style="top:10%;">
                            <?php if($bt=='app'): ?>
                            <a class="btn" href="<?php echo APP_MOLO_DOWNLOAD_URL; ?>">上班班花班费</a>
                            <?php else: ?>
                            <a class="btn" href="<?php echo Yii::app()->request->url.'&ac=webac'; ?>">上班班花班费</a> 
                            <?php endif ?>
                        </div>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_pm_07.jpg" />
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_pm_07.jpg" /> 
                    </div> 
                </div> 
            </div>
            
        </div>
        <div class="page">
            <div class="layout" style=" background-color: #ffffff; <?php if($bt=='web'): ?>width: 430px;<?php endif; ?>"> 
                <div class="layout-main">
                    <div class="img-box" style="padding: 10% 0;">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/a_03.jpg" />
                    </div>
                    <div class="c-box" style=" ">
                        <p>班班，为老师减负，为家长补习</p>
                        <p>发作业，发通知， 最尽责的老师都在这里</p>
                        <p>名校？成绩？给家长最全面的教育资讯</p> 
                    </div>
                    <div class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/a_04.jpg" />
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/a_05.jpg" />
                    </div>
                    <div class="btnBox"  style="">
                        <?php if($bt=='app'): ?>
                        <a class="btn" href="<?php echo APP_MOLO_DOWNLOAD_URL; ?>">去看看</a>
                        <?php else: ?>
                        <a class="btn" href="<?php echo Yii::app()->request->url.'&ac=webac'; ?>">去看看</a>
                        <?php endif ?>
                    </div> 
                </div>
            </div>
        </div> 
    </div> 
    <?php else: ?> 
        <div class="page" style=" background-color: #FE8E04;">
            <div class="layout" style=" background-color: #FEBD5F; max-width: 430px;"> 
                <div class="layout-main">
                    <div class="img-box" style=" padding: 20px 0; text-align: center;">
                        <img style="display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/logo150.png" />
                    </div>
                    <div style="width: 55%; font-size: 21px; margin: 0 auto; text-align: center; padding: 20px 0;">
                        班班，能赚班费涨知识的家校沟通神器  
                    </div>

                    <div style=" width: 80%; margin: 0 auto; padding: 20px 0;">
                        <div style=" margin-bottom: 10px; font-size: 18px;">
                            &nbsp;免费发送短信到手机下载
                        </div>
                        <div style=" padding: 20px 0;">
                            <form id="formBoxRegister" action="" method="post">  
                            <div style="display: inline-block; position: relative; width: 60%; padding: 0 10px; border-radius: 0px; height: 42px; border: 1px solid #d7d7d7; background: #ffffff; overflow: hidden;">
                                <input id="webPlaInput" type="text" name="recmobile" maxlength="11" autocomplete="off" onfocus="plasInpt('webPlaInput','webPlatext');"  onblur="plastt('webPlaInput','webPlatext');" style=" position: relative;  width:98%; height: 40px; line-height: 40px; font-size: 16px; color: #827c7c; padding: 0; margin: 0; border: none; outline: none; background: none;z-index: 100;"  value="">
                                <div onmousedown="hideThis('webPlatext');" id="webPlatext" style="display: block; position: absolute; width: 100%; top:0; left: 5%; font-size: 18px; height: 42px; line-height: 42px; color: #827c7c;z-index: 1;">输入手机号</div>
                            </div>
                            <input type="submit" class="btn" value=" 发送" style=" width: 30%; margin-top: 1px; height: 42px; float: right;  background: #f59201;" />
                        </form>
                        </div>
                    </div>
                    <div class="img-box" style=" text-align: center;">
                        <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/t_s3.png" />
                    </div>
                     <div class="img-box" style=" text-align: center; margin: 40px 0;">
                        <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/erweima.jpg" />
                        <p style=" font-size: 18px; margin-top: 15px;">二维码扫描下载</p>
                    </div>
                    <div  style="padding: 0; margin: 30px; overflow: hidden;  text-align: center;">
                        <a href="<?php echo WEB_IOS_DOWNLOAD_URL; ?>" class="btn" style=" color: #000000;">IOS下载</a>
                    </div>
                    <div  style="padding: 0; margin: 30px; overflow: hidden;  text-align: center;">
                        <a href="<?php echo WEB_ANDROID_MOLO_DOWNLOAD_URL; ?>" class="btn" style=" color: #000000;">Android下载</a>
                    </div>
                    <?php Yii::app()->msg->printMsg();?> 
                </div> 
            </div> 
        </div>
        <?php endif ?> 
    </div>
    <script type="text/javascript"> 
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
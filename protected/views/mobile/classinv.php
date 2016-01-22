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
<title>邀请老师和家长</title>
<meta name="description" content="">
<meta name="keywords" content="">
<style type="text/css">
    ,* { tap-highlight-color: transparent }
    * { -webkit-tap-highlight-color: transparent; }
    html,body{ width: 100%; height: auto; padding: 0; margin: 0 auto;  background:url('/image/banban/mobile/clas/classinv/bg_body.png');}
    p,div{ padding: 0; margin: 0;}
    a{ text-decoration: none; color: #4c4c4c; }
    a.c_1{ color: #fe7e00;}
    .f-left{ float: left; }
    .f-right{ float: right; }
    .layout{ max-width:430px; height: 100%; margin:0 auto;overflow:hidden; font-family: "黑体";}
    .layout-main {position: relative; width: 100%; padding: 0px; margin: 0 auto;  min-width:280px;}
    .layout-header{ position: relative; width: 100%; min-height:200px; margin-bottom: 10%; background: #ffa822; }
    .header{ min-height: 230px;}
    .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
    .img-box{ position: relative; width: 100%; }
    .img-box img{display:block; max-width: 100%; height: auto; vertical-align:text-bottom; *vertical-align: auto; }
    .pic{ margin: 0 auto; border-radius: 50%; -moz-border-radius: 50%; -webkit-border-radius: 50%; overflow: hidden;  }
    .card-box{ position: absolute; left: 0; width: 100%; margin: 0 auto; text-align: center; overflow: hidden; border: none;  }
    .h-box{ width: 100%; line-height: 22px; background-color: #ffffff; }
    .n_txt{margin-bottom:3%;  text-align: left; color: #ffffff; font-size: 16px;}
    .hi-txt{position: relative;  width: 92%;  padding: 4%; margin: 0 auto; border-radius: 12px; background-color: #ffffff; text-align: left; font-size: 17px;  color: #5a5555;  text-align: left; z-index:1; } 
    .hi-txt span{ color: #ff3c22;}
    .hi-txt .i-nav{ display: block; position: absolute; left: -3%; top:10%; width: 25px; height: 16px; background:url('/image/banban/mobile/clas/classinv/nav_ioc.png'); background-size: contain;}
    .input-box{position: relative; width: 80%; border-radius: 6px; margin: 0 auto; height: 42px; border: 1px solid #d7d7d7; background: #ffffff; overflow: hidden;}
    .input-box .input{width:98%; height: 40px; font-size: 16px; color: #827c7c; padding: 0; margin: 0; margin-left: 5px; border: none; outline: none; background: none; z-index: 2;}
    .input-box .input-tip{display: block; position: absolute;  top:0; left: 3%; width: 97%; height: 42px; text-align: left; font-size: 18px;  line-height: 42px; color: #827c7c;z-index: 1;}
    input[type='button'].input-btn{width:100%; margin: 0 auto; margin-top: 1px; height: 42px; background: #f59201;}
    .post-Tip{width: 76%; height: 18px; margin: 3px auto; color: red;}
    .btn{ display: inline-block; width: 75%; height: 40px; line-height: 40px;   padding: 0px 8px; font-size: 18px; background-color: #f59201; color: #F79301; border: 1px solid #f59201; border-radius: 6px; color: #ffffff; }
    .btnBox { padding: 0; margin: 0 auto; margin-top: 5%; overflow: hidden;  text-align: center;}
    .btnBox .btn{ width: 80%; margin: 5% 0; height: 42px; font-size: 18px; background: #f59201;}
    .t-footer{ padding-bottom: 10%; text-align: center; }
    .logo{ text-align: center; padding-top: 5%;}
    .p-txt{ width: 80%; margin: 15px auto;  line-height: 26px; font-size: 15px; color: #ffffff;}
    .p-txt span{ color: #ff3c22;}
    .b-Box{padding: 0; margin: 30px; overflow: hidden;  text-align: center;}
</style> 
    
</head>
<body> 
    <div id="container">
        <?php if(isset($state) && $state=='result'): ?>
        <!-- 提交后页面-->
        <section class="layout">
            <header class="layout-header" style=" min-height: 300px;">
                <div class="img-box logo"> 
                    <img style="display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/logo150.png" />
                </div>
                <div class="p-txt">
                    班班下载地址已发送短信至手机！赶快下载班班，输入班级代码<span><?php echo ($class ? $class->code : "未分配"); ?></span>，就可以加入<span><?php echo $class->name; ?></span>了！ 
                 </div>
                <div class="card-box" style="bottom:-5%;">
                    <div class="img-box" style=" margin-bottom: 0;">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/classinv/h_footer.png"/>
                    </div>
                </div>
            </header>
            <div class="layout-main" > 
                <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/classinv/centent1.jpg"/>
                </div>
            </div>
            <footer> 
                 <div class="img-box" style=" text-align: center; margin: 40px 0;">
                    <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/erweima.jpg" />
                     <p style=" font-size: 18px; margin-top: 15px; color: #777777;">二维码扫描下载</p>
                </div>
                <div class="b-Box">
                    <a href="<?php echo WEB_IOS_DOWNLOAD_URL; ?>" class="btn" style=" color: #ffffff;">IOS下载</a>
                </div>
                <div class="b-Box" >
                    <a href="<?php echo WEB_ANDROID_MOLO_DOWNLOAD_URL; ?>" class="btn" style=" color: #ffffff;">Android下载</a>
                </div> 
            </footer>
        </section> 
        <!-- /提交后页面-->
        <?php else: ?>
        <!-- 输入收手机号页-->
        <section class="layout">
            <header class="layout-header">
                <div class="img-box header">
                    <div class="card-box" style="top:10%; left: 3%; width: 13%;">
                        <div class="img-box pic">                      
                            <img src="<?php echo STORAGE_QINNIU_XIAOXIN_TX.$user->icon; ?>?imageView2/1/w/60/h/60" onerror="javascript:this.src='<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/c_i_01.jpg'"/>
                        </div> 
                    </div>
                    <div class="card-box" style="left:18%; top:15%; width: 80%; overflow: visible;"> 
                        <div class="n_txt">
                            <?php echo $user->name; ?> 
                        </div> 
                        <div class="hi-txt" style=" <?php if($bt=='web'): ?> font-size:21px;<?php else:?> font-size:17px;<?php endif; ?>"> 
                            嗨，咱们在班班终于有自己的地盘了：<span><?php echo $class->name; ?></span>，班级代码为<span><?php echo ($class ? $class->code : "未分配"); ?></span>。赶快输入手机号码加入班级吧！
                            <i class="i-nav"></i>
                        </div>   
                    </div>
                </div>
                <div class="card-box" style="bottom:-5%;">
                    <div class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/classinv/h_footer.png"/>
                    </div>
                </div> 
            </header>
            <div class="layout-main"> 
                <div class="img-box" style=" margin-bottom: 10px;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/clas/classinv/centent.png"/>
                </div> 
                <form id="formBoxRegister" action="" method="post" onsubmit="return check();"> 
                    <div class="box">
                        <div class="input-box">
                            <input name="recmobile" id="webPlaInput" class="input" type="text" maxlength="11" autocomplete="off" placeholder="" onfocus="plasInpt('webPlaInput','webPlatext');"  onblur="plastt('webPlaInput','webPlatext');"  value="">
                            <span  id="webPlatext" class="input-tip">输入手机号</span>
                        </div>
                        <div id="postBtnTip" class="post-Tip">&nbsp;<?php echo Yii::app()->request->getParam('error'); ?></div>
                        <div style="width: 80%; margin: 0 auto;">
                            <input id="postBntRegister" type="submit" class="btn input-btn" style=" width: 100%;" value=" 接受邀请 " />
                        </div> 
                    </div> 
                </form>  
            </div>
            <footer class="t-footer">
                <a class="c_1" href="http://schoolseason.banban.im/introduce/index.html">班班是什么？</a>
            </footer>
        </section>
        <!-- /输入收手机号页-->
        <?php endif; ?>
        <?php // Yii::app()->msg->printMsg();?>
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
      
    var tObj = JId('#webPlatext');
    if(tObj){
        tObj.onmousedown = function(e){
           var pinput  =JId('#webPlaInput'),
            postBtnTip =JId('#postBtnTip');
            if(this){ 
                this.style.display="none"; 
                postBtnTip.innerHTML = " ";
                pinput.focus();
            } 
            if ( e && e.preventDefault ){  
                    e.preventDefault(); //阻止默认浏览器动作(W3C) 
            }else{ 
                window.event.returnValue = false; //IE中阻止函数器默认动作的方式 
                return false;
            }
        }
    }
    function plastt(objI,objT){ 
        var pinput = JId('#'+objI),
            target = JId('#'+objT),
            postBtnTip =JId('#postBtnTip');
       if(pinput.value==""){
             target.style.display="block";
        }else{ 
            target.style.display="none";
            postBtnTip.innerHTML = " "; 
        } 
   }
    function plasInpt(objI,objT){
        var pinput = JId('#'+objI),
            target = JId('#'+objT),
            postBtnTip =JId('#postBtnTip');
        target.style.display="none"; 
        postBtnTip.innerHTML = " ";
    }  
    function check(){
        var eg =/^((1)+\d{10})$/;
        var oPostBtn = JId('#postBntRegister'),
        oPostForm = JId('#formBoxRegister'),
        pinput = JId('#webPlaInput'),
        postBtnTip =JId('#postBtnTip');  
        var inputV = pinput.value;  
         if(inputV !=""){ 
            if(eg.test(inputV)){ 
                postBtnTip.innerHTML =" "
                return true;
            }else{
                postBtnTip.innerHTML ="输入的手机号有误"
                return false;
            } 
        }else{
            postBtnTip.innerHTML ="请输入手机号"
            return false;
        } 
    } 
     
   
</script>
</body>
</html>

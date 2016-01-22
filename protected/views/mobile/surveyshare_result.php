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
        .rBg{background:url('/image/banban/mobile/survey/h_bg.jpg') repeat-y; background-size: contain;}
    </style>
   </head>
   <body>
        <div style=" display: none;">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/pic_logo.jpg" />
        </div>
       <div id="layout" class="layout"> 
           <section id ="iQp_1" class="iQpage" style="display: block; opacity: 1;">
                <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_h.jpg"/>
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
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/grade_<?php echo $resultLevel?$resultLevel->title:'';?>.jpg"/>
                        <div id="stampSpic" class="b-p" style=" width: 70%; left: 40%; top:45%; opacity: 0; z-index: 999;">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/stamp.png" />
                        </div>
                    </div>
                    <div style=" width: 76%; margin: 5% auto; font-size: 16px; color: #595959;">
                       <?php echo $resultLevel?$resultLevel->desc:'';?>
                    </div>
                    <div class="img-box" style=" padding: 3% 0;"> 
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/l_line.jpg"/>
                    </div> 
                </div>
               <div class="rBg" style="z-index:1;">
                   <div class="img-box"  style="width: 76%; margin: 0 auto;">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/ibput_bg.png"/>
                        <div class="b-p" style="width: 100%; top:10%; background:none; z-index: 999;">
                            <form id="postFormR" method="post" action="<?php echo Yii::app()->createUrl("/mobile/surveyshare/$id");?>" style="background:none;">
                             <input id="mobilePhoneInput" name="mobilephone"  type="text" onfocus="plasInpt('errormsgTip');"  onblur="plasInpt('errormsgTip');" maxlength="11" autocomplete="off" placeholder="请输入手机号领取班费卡" style=" width: 94%; height:27px; font-size: 13px; color: #333333; padding: 0; margin: 0; border: none; outline: none; background: none; background-color: #E5E5E5;" value="" />
                             <input type="hidden" name="uid" value="<?php echo $uid;?>"  />
                             <input type="hidden" name="id" value="<?php echo $id;?>"  />
                             <input type="hidden" name="score" value="<?php echo $score;?>"  />
                             <input type="hidden" name="level" value="<?php echo  $resultLevel?$resultLevel->title:'';?>"  />
                            </form>
                        </div> 
                   </div>
               </div>
               
               <div class="rBg" style="position: relative; width: 100%; min-height: 60px; ">
                   <div id="errormsgTip" style=" width: 68%;  padding:1%; height: 20px; margin: 0 auto; color: #eb5251;">
                        <?php if($errormsg) echo $errormsg ;?>
                   </div>
                   <a href="javascript:;" id="postBtnC" class="img-box" style=" display: block; width: 78%; margin: 0 auto; padding-bottom: 4%; overflow: hidden;">
                       <img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/btn_p.jpg" />
                    </a>
               </div>
                <div class="rBg" style="position: relative; width: 100%; min-height: 60px; ">
                    <div style=" width: 100%; text-align: center; margin: 0 auto; color: #00b7ee; font-size: 12px;">班费提现，为孩子购买学习资料，加强家长能力</div> 
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
            var stPic = document.getElementById('stampSpic');
            MotionFrames.startMove(stPic,{left :-100,top:-100},1,function(){
                MotionFrames.startMove(stPic,{left :55,top:55,opacity:100},0);
            });
            var postBtnC =document.getElementById('postBtnC');
            
            
            postBtnC.onclick = function(){ //提交表单
                var mobilePhoneInput = document.getElementById('mobilePhoneInput').value;
                var postFormR = document.getElementById('postFormR');
                //alert(mobilePhoneInput);
                if(mobilePhoneInput){
                     postFormR.submit(); 
                }  
            }
        }
        function plasInpt(objI){
            var pinput = document.getElementById(objI);
            pinput.innerHTML=""; 
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

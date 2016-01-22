<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta content="telephone=no" name="format-detection" />
        <meta http-equiv="cleartype" content="on">
        <title>教师认证</title>
        <style>
            ,* { tap-highlight-color: transparent }
            * { -webkit-tap-highlight-color: transparent; }
            html,body { width: 100%; height: auto; padding: 0; margin: 0 auto; font-size: 16px; background-color: #f5f5f3;} 
            ul,ul li{ list-style: none;padding:0; margin:0; }
            input{ outline:none;border:none; }
            input:focus{outline:none;border:none;}
            a{ text-decoration: none; }
            .f-left{ float: left; }
            .f-right{ float: right; } 
            .layout{ position: relative; max-width:640px; min-width:280px; margin:0 auto; padding: 0px; overflow:hidden; font-family: "黑体";}
            .layout-main {position: relative; width: 100%; padding: 0px; margin: 0 auto;}
            .btn{ display: inline-block; width: 75%; height: 40px; line-height: 40px;   padding: 0px 8px; font-size: 18px; background-color: #f59201; border: 1px solid #f59201; border-radius: 6px; color: #ffffff; }
            .box-m{ margin-bottom: 10px; }
            .i-box{ position: relative; width: 100%; }
            .i-box img{ max-width: 100%; height: auto; display: inline-block; vertical-align:text-bottom; }
            .box{ width: auto; padding:0 15px 15px 15px; margin: 0 auto;  margin-bottom: 15px; overflow: hidden; }
            .s-t{ font-size:20px; color: #f59201; text-align: center; padding: 15px 0; }
            .b-cent{ min-height: 150px; padding-top: 10px; margin-top: 15px; border: 1px #dbdbdb solid; border-radius: 10px;background-color:#ffffff; }
            .b-t{ line-height: 30px; padding-bottom: 10px; color: #777777; font-size: 14px; text-align: center;border-bottom: 1px #dbdbdb solid; } 
            .b-o{color: #666666;}
            .l-box {padding: 15px; overflow: hidden;}
            .l-box li{ margin-bottom: 10px; overflow: hidden; }
            .l-box li.last{ margin-bottom: 0;}
            .l-box li .l-pic{ float: left; width: 40px; height: 40px; background: url('/image/banban/mobile/tc/pic.png') no-repeat; background-size: 100%;background-position: center 0px;  }
            .l-box li .pic1{ background-position: center -58px; }
            .l-box li .pic2{ background-position: center -120px; }
            .l-box li .pic3{ background-position: center -179px; } 
            .l-box li .l-itme{ margin-left:50px; line-height: 22px; padding: 0 0 10px  2px; border-bottom: 1px #dbdbdb solid; }
            .l-box li .last{border-bottom:none;}
            .l-box .l-t{ color: #000000; font-size: 16px; }
            .l-box .l-inf{ color: #999999;font-size: 13px; }
            .line { height: 30px; line-height: 30px; padding: 20px 0; background:url('/image/banban/mobile/tc/line.png') center no-repeat; background-size: 100%; text-align: center;  }
            .u-box { position: relative; width: 100%; }
            .f-detail{ overflow: hidden; padding: 10px 0; margin: 0 auto; font-size: 14px; }  
            .f-share{ text-align: center; }
            .f-title{ text-align: center; font-size: 14px; color: #999999; margin-bottom: 10px; }
            .p-title{ text-align: center; font-size: 14px; color: #999999; background-color: #ffffff; padding: 5px 0; border-bottom: 1px #f2f2f2 solid; line-height: 30px;}
            .f-share a{ display: inline-block; width:55px; margin:0 15px; text-align: center; }
            .f-share a span{ display: block; color: #000000; font-size: 13px; margin-top: 5px; }
            .r-box .dec{ position: absolute; left: 20%; top:-11px; color: #ffffff; }
            .r-box .dec1{ left: 46%; }
            .r-box{ position: relative; margin: 2% 0; }
            .r-box .r-t{ padding: 10px 0px; line-height: 24px; font-size: 14px; color: #777777; }
            .r-t span{ color: #f59201; }
            .contact{ margin: 2% 0; font-size: 14px; color: #f59201; }
            .contact p{ margin: 2% 0;}
        </style> 
    </head>
    <body> 
        <div id="content" class="layout">
            <div class="layout-main">
                <div class="box">
                    <?php if($type!=1):?>
                    <div id="fileToUploadForm" class="fileToUploadForm">
                        <div id="msgTypeR" class="s-t" style=" display: none;"></div> 
                        <div class="b-cent">
                            <?php if($type!=2):?>
                            <div class="b-t">完成教师身份认证，您将拥有如下特权:</div>
                            <?php else: ?>
                            <div class="b-t">你已获得认证教师身份，您将拥有如下特权:</div>
                            <?php endif; ?>
                            <ul class="l-box">
                                <li>
                                    <div class="l-pic"></div>
                                    <div class="l-itme">
                                        <div class="l-t">
                                            尊贵标识
                                        </div>
                                        <div class="l-inf">
                                            特有的老师标记，您的身份尊贵无比。
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="l-pic pic1"></div>
                                    <div class="l-itme">
                                        <div class="l-t">
                                            商品特权
                                        </div>
                                        <div class="l-inf">
                                           在青豆商城内兑换认证教师独享商品。
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="l-pic pic2"></div>
                                    <div class="l-itme">
                                        <div class="l-t">
                                            班费特权
                                        </div>
                                        <div class="l-inf">
                                            班级班费可以提现。
                                        </div>
                                    </div></li>
                                <li class="last">
                                    <div class="l-pic pic3"></div>
                                    <div class="l-itme last">
                                        <div class="l-t">
                                            敬请期待
                                        </div>
                                        <div class="l-inf">
                                            更多认证教师特权准备开启，敬请期待...
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php if($type==0):?>  
                            <div class="i-box"   style=" margin-top: 5%;">
                                <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/tc/t_d.png" /> 
                            </div> 
                            <div class="r-box">
                                <!--<span class="dec"  style="*top:4px;"><s>◆</s></span>-->
                                <div class="r-t">
                                    请上传您手持自己教师证的照片，并保证照片内证件内容完整清晰，班班会在7个工作日内完成您的认证申请
                                </div>
                                <div class="u-box" style=" margin: 0 0 5% 0;"> 
                                    <!-- 未认证 --> 
                                    <div class="i-box box-m" style="position: relative; text-align: center; " >
                                        <a href="javascript:hotograph();" class="btn" style="  width: 80%; margin: 0 auto; ">拍照认证</a> 
                                    </div>  
                                </div>
                                <div class="contact">
                                    如有疑问请联系班班客服
                                    <p>电话：400-101-3838 &nbsp;QQ：1919036624</p>  
                                </div>
                            </div> 
                        <?php endif;?>  
                    </div>
                    <div id="typeVerification" style="display: none">
                        <div class="s-t" style=" padding: 5% 0;">审核中...</div>
                        <div class="i-box" style=" width: 46%; margin: 5% auto;">
                            <img style=" display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/tc/ioc_p.png" /> 
                        </div>
                        <div style="color: #777777; text-align: center; margin-top: 5%;">
                            信息审核中...<br />结果将在7个工作日内通知您
                        </div>
                        <div class="contact" style="text-align: center;">
                            如有疑问请联系班班客服 
                            <p>电话：400-101-3838 &nbsp;QQ：1919036624</p>  
                        </div>
                    </div> 
                    <?php endif;?>
                    <?php if($type==1):?>
                    <div id="typeVerifications">
                        <div class="s-t" style=" padding: 5% 0;">审核中...</div>
                        <div class="i-box" style=" width: 46%; margin: 5% auto;">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/tc/ioc_p.png" /> 
                        </div>
                        <div style="color: #777777; text-align: center; margin-top: 5%;">
                            信息审核中...<br /><br />结果将在7个工作日内通知您
                        </div> 
                        <div class="contact" style="text-align: center;">
                            如有疑问请联系班班客服
                            <p>电话：400-101-3838 &nbsp;QQ：1919036624</p>  
                        </div>
                    </div> 
                    <?php endif;?>
                </div>
            </div>
        </div> 
    <script type="text/javascript">
        var browser = {
            versions: function() {
                var u = navigator.userAgent, app = navigator.appVersion;
                return {//移动终端浏览器版本信息 
                    trident: u.indexOf('Trident') > -1, //IE内核
                    presto: u.indexOf('Presto') > -1, //opera内核
                    webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/), //是否为移动终端
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
                    iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
                    iPad: u.indexOf('iPad') > -1, //是否iPad
                    webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
                };
            }(),
            language: (navigator.browserLanguage || navigator.language).toLowerCase()
        };
          
        function hotograph() {
            if (browser.versions.iPhone){ //苹果客户端
                window.location.href = "js-call://photo/";
            }else if (browser.versions.android){//Android客户端  
                PayHelper.photo();
            }else{ 
            } 
        } 
        function  awaitingVerification(str){ 
            if(str){
                document.getElementById('fileToUploadForm').style.display="none";
                document.getElementById('typeVerification').style.display="block"; 
            }else{
                var typeS = document.getElementById('msgTypeR');
                typeS.innerHTML = "拍的照片不能用，请重新拍照"; 
                typeS.style.display="block";
                setInterval(function(){ typeS.style.display="none"; },300); 
            }
        } 
    </script>
    </body>
</html>
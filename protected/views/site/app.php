<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title>班班手机版</title>
    <link rel="stylesheet" href="/css/banban/skylake/stylesheets/app.css">
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
</head>
<body>
	<div class="floor f1">
		<div class="container bg-header">
			<div class="top fix">
                <a class="top-left pull-left" href="/"></a>
                <div class="top-right pull-right">
                    <p>客服电话</p>
                    <p class="phone-number"><i class="icon-phone"></i>400 101 3838</p>
                </div>
			</div>
            <div class="download fix">
                <div class="qr-code pull-left">
                    <img width="150" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/erxiaoxin150.png" alt=""/>
                    <p>扫描二维码下载</p>
                </div>
                <div class="pull-left">
                    <p class="text">免费发送到手机</p>
                    <div class="fee-send">
                        <label id="spcLabel" for="sendPhoneCode">输入手机号</label>
                        <input id="sendPhoneCode" type="text" maxlength="11" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />
                        <a id="send" href="javascript:;">发送</a>
                    </div>
                    <div id="senPhoneTip"></div>
                    <div class="platform fix">
                        <a href="<?php echo WEB_IOS_DOWNLOAD_URL; ?>" target="_blank"><i class="icon-apple"></i><span>iPhone版</span></a>
                        <a href="<?php echo WEB_ANDROID_MOLO_DOWNLOAD_URL; ?>" target="_blank"><i class="icon-android"></i><span>Android版</span></a>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="floor f2">
		<div class="container">
            <div class="ct-inner fix">
                <div class="intro-image pull-left">
                    <img src="/image/banban/apppage/f2_show_page.png" alt=""/>
                </div>
                <div class="intro-text pull-right">
                    <h1 class="title">实时推送</h1>
                    <p class="subtitle">新消息实时推送，不遗漏信息</p>
                    <p class="introduction">支持作业通知、家长通知、在校表现等多种通知模式</p>
                    <p class="introduction">各种通知分类管理，便于查看</p>
                    <ul class="function-list">
                        <li><span class="icon-sprite icon-1"></span><span>作业通知</span></li>
                        <li><span class="icon-sprite icon-2"></span>紧急通知</span></li>
                        <li><span class="icon-sprite icon-3"></span>在校表现</span></li>
                        <li><span class="icon-sprite icon-4"></span>考试成绩</span></li>
                        <li><span class="icon-sprite icon-5"></span>学校通知</span></li>
                    </ul>
                </div>
            </div>
		</div>
	</div>
	<div class="floor f3">
		<div class="container fix">
            <div class="ct-inner-ext fix" style="padding-top: 30px;">
                <div class="intro-mix">
                    <h1 class="title">方便快捷</h1>
                    <p class="subtitle">随时随地查看，不局限电脑旁</p>
                    <p class="introduction">支持电脑网页、智能手机、平板电脑等多种设备</p>
                    <p class="introduction">支持Android系统、IOS系统</p>
                    <div class="intro-mix-img">
<!--                        <img src="/image/banban/apppage/f3_show_page.jpg" alt=""/>-->
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="floor f4">
        <div class="container">
            <div class="ct-inner fix">
                <div class="intro-image pull-left">
                    <img src="/image/banban/apppage/f4_show_page.png" alt=""/>
                </div>
                <div class="intro-text pull-right">
                    <h1 class="title">互动沟通</h1>
                    <p class="subtitle">老师、家长在线互动沟通</p>
                    <p class="introduction">支持老师与老师、老师与家长、家长与家长</p>
                    <p class="introduction">在线实时互动沟通</p>
                </div>
            </div>
        </div>
	</div>
	<div class="floor f5">
        <div class="container">
            <div class="ct-inner-ext fix">
                <div class="intro-mix">
                    <h1 class="title">教育内容</h1>
                    <p class="subtitle">关注教育内容，不仅贴心，而且周到</p>
                    <p class="introduction">教育内容量身打造，给您更专业的教育资讯，育儿经验等</p>
                    <div class="intro-mix-img-2">
                        <img src="/image/banban/apppage/f5_show_page.png" alt=""/>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <a id="toTop" class="scroll" style="display: none;" href="javascript:;"></a>

        <script type="text/javascript">
           showScroll();
            function showScroll(){
                $(window).scroll( function() { 
                    var scrollValue=$(window).scrollTop();
                    scrollValue > 100 ? $('a[class=scroll]').fadeIn():$('a[class=scroll]').fadeOut();
                } );	
                $('#toTop').click(function(){
                    $("html,body").animate({scrollTop:0},200);	
                });	
            }

        </script>
        <script type="text/javascript">
            $(function(){
                function ajaxPost(url,mobile){
                    var str ="";
                    $.ajax({  
                        url:url,   
                        type : 'POST',
                        data : {mobile:mobile},
                        dataType : 'JSON',  
                        async : false,
                        contentType : 'application/x-www-form-urlencoded',  
                        success : function(mydata) {
                            str = mydata; 
                        },  
                        error : function() {  
                            // alert("calc failed");  
                            str = "系统繁忙,请稍后再试";
                        }  
                    });
                    return str;
                }
                $('#send').click(function(){
                    var phone = $('#sendPhoneCode').val(),url = '<?php echo Yii::app()->createUrl('ajax/sendsmsbydownload');?>'; 
                    var text ='';
                    if(phone){
                        var str = ajaxPost(url,phone);  
                        text = str.msg ;
                        if (str.status == 1) {
                            var textColor = "#B4EB7C";
                        } else {
                            var textColor = "#EE0000";
                        }
                        $('#senPhoneTip').text(text).css('color', textColor);
                    }else{
                        text = '请输入手机号';
                        $('#senPhoneTip').text(text).css('color',"#EE0000");
                    }
                    
                    $('#sendPhoneCode').val(''); 
                });
                $('#sendPhoneCode').live('focus', function(e){
                    $('#spcLabel').addClass('hidden');
                    $('#senPhoneTip').text('');
                });
                $('#sendPhoneCode').live('blur', function(e){
                    var that = $(this);
                    if (that.val() == "") {
                        $('#spcLabel').removeClass('hidden');
                    }
                });
            });
        </script>
    </body>
</html>
<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head> 
    <meta charset="UTF-8">
    <?php if('product'==BANBAN_ENVIRONMENT):?>
    <meta property="qc:admins" content="155124115362162166157" />
    <?php else: ?>
    <meta property="qc:admins" content="15512415605340061401170166375" /><!-- QQ登录验证 -->
    <?php endif; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"> 
    <meta name="renderer" content="webkit|ie-comp">
    <meta http-equiv="Pragma" content="no-cache"> 
    <meta http-equiv="Cache-Control" content="no-cache"> 
    <meta http-equiv="Expires" content="0"> 
    <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
    <meta name="keywords" content="班班,班班网,班务管理,作业通知,蜻蜓校信,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,教育,家校,平台,沟通,社交,班费,青豆,老师,家长">
    <meta name="description" content="班班是国内首款基于'班级'为单位，面向老师与家长之间，家长与家长之间的教育专属社交应用。班班是30万老师的家校沟通首选专属工具，比Q群、微信更实用。班班为老师家长提供一种全新的、专属的沟通和社交方式，为班级提供全新的管理增值服务方式。">
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/image/favicon.ico">
    <link href="<?php echo MainHelper::AutoVersion('/css/xiaoxin/bootstrap.css'); ?>" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/style.css'); ?>">
    <link href="<?php echo MainHelper::AutoVersion('/css/banban/pegStyle.css'); ?>" rel="stylesheet" type="text/css"/>
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/common.js'); ?>" type="text/javascript"></script>
    <style>
        body{ min-width:980px;font-family: "Helvetica Neue", "Helvetica, Arial", "Hiragino Sans GB", "Hiragino Sans GB W3", "WenQuanYi Micro Hei", "Microsoft YaHei UI", "Microsoft YaHei", "sans-serif";}
    </style>
</head>
<body>
    <?php if(Yii::app()->user->isGuest){
        $this->redirect(Yii::app()->createUrl('site/login'));
    }?>
    <div id="layoutBodyBox" class="layoutBodyBox"> 
        <?php include('header.php'); ?>
        <?php 
            $identity = Yii::app()->user->getCurrIdentity();
            $gotoold = Yii::app()->session['gotoold'];
            unset(Yii::app()->session['gotoold']);
        ?>
        <?php if($identity->isTeacher):?>
            <?php include('sidebar.php'); ?>
            <div id="layoutBox" class="layoutBox">
        <?php endif;?>
            <?php echo $content; ?>
        <?php if($identity->isTeacher || $identity->isPatriarch || $identity->isFocus):?> 
            </div>
        <?php endif;?>
    </div> 
    <input id="reminderCookieType" type="hidden" value="christmass_"> 
    <!-- 系统公告-->
    <!--div id ="reminderCookie" class="reminder"  style=" display: none;">
        <em class="colse">x</em>
        <div class="reminderTit">系统公告</div> 
        <div class="reminderCom">亲爱的班班用户，您好：<br/> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;为了给大家提供更好的服务，班班将于今天（2015年10月10日）晚上23：30~01:30对服务器进行升级，升级期间将暂停所有服务，给您带来的不便敬请谅解，请大家和我们一起期待一个更好的班班。<span> 400-101-3838</span>
            <p style=" text-align: right;">深圳蜻蜓互动科技有限公司</p>
            <p style=" text-align: right;">2015年10月10日</p>
        </div>
    </div-->
  <!-- /系统公告-->
  
<!--活动-->
<div id="popupBoxActivity" class="popupBox" style=" width: 920px; top:45%; border-radius: 5px; padding: 5px;"> 
    <div class="centent" style="position: relative; text-align: center; text-indent: 0em;"> 
        <a class="" href="javascript:;" onclick="hidePormptMaskWeb('#popupBoxActivity')" style=" display: inline-block; position: absolute; right: 5px; top:5px; width:41px; height: 40px; background:url('/image/banban/activity/colse.png'); "></a>
        <img style="display: inline-block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/gif_jpg.jpg"> 
    </div> 
    <div style=" padding: 10px 0; text-align: center;">
        <a class="btn btn-default" href="javascript:;" onclick="hidePormptMaskWeb('#popupBoxActivity')" > 我知道了</a>
    </div>
 </div> 
<!--/活动-->
 
 <?php Yii::app()->msg->printMsg();?> 
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" >
    //提醒设置Cookie
    var cookieValue = $('#reminderCookieType').val();
    $(".reminder .colse").click(function(){ 
        //delCookie("reminderCookie");
        $(this).parent('.reminder').hide();
        CookieOperate.setCookie('reminderCookie',cookieValue,'d365');
    });
    
    //显示活动
    //cookieType(cookieValue,'#reminderActive');
    //显示公告
    cookieType(cookieValue,'#reminderCookie');
    
    //活动按钮
//    $('[rel=christmasActiveInfo]').click(function(){
//         $("#reminderActive").show(); 
//    }); 
//    
    //cookie状态
    function cookieType(cookieValue,obj){
        var Val = CookieOperate.getCookie("reminderCookie");
        if(Val==cookieValue){
            $(obj).hide();
        }else{
            $(obj).show();
        }
    }
    // 保持页面高度
    var global={
        resizeH:function(){
            var c=$('.mainBox'),
            HeaderBox = document.getElementById('headerBox'),
            SubnavBox = document.getElementById('subnavBox'),
            h=$(window).height(); 
            if(SubnavBox){
                if(SubnavBox.offsetHeight>(h-HeaderBox.offsetHeight)){
                    c.css({'minHeight': SubnavBox.offsetHeight+'px'});
                }else{
                    c.css({'minHeight': (h-HeaderBox.offsetHeight)+'px'});
                }
            }else{ 
                c.css({'minHeight': (h-HeaderBox.offsetHeight)+'px'}); 
            }
            var showId =$(".promptMask").attr('id');
            if(showId){
                $("#"+showId).css('height', h+"px");
            }
        } 
    };
    $(function(){
        global.resizeH();
        
         
    });
    $(window).resize(function(event) {
        global.resizeH();
    }); 
</script> 
<script>
    //百度统计
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?1ef1ca666d51f73f124385c51037c5d0";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
</script> 
</body>
</html>
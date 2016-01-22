<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>班班动态 - 千万红包免费送，注册建班即送50元话费红包！班班客服：400 101 3838</title>
    <meta name="keywords" content="班班,班班网,班班动态,班务管理,作业通知,蜻蜓校信,蜻蜓班班,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,家校,青豆">
    <meta name="description" content="班班面向老师开放注册，千万红包免费送，注册建班即送50元话费红包！日常使用礼更多，立即注册班班体验吧！">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/newstyle.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
    <style> 
     .layout_div{width: 1000px; margin: 0 auto; overflow: hidden; clear: both; background:#fff; text-align:center; } 
    .containter{
        width:1183px;
        margin:0 auto;
        overflow:hidden;
    }
    .containter{
        width:1000px;
        margin:0 auto;
    }
    .containter img{
        max-width:100%;
        vertical-align:middle;
    }
    .containter .header-img{
        position:relative;
    }
    .containter .header-img .register{
        position:absolute;
        top: 382px;
        left: 436px;
    }
    .containter .header-img .register img{
        width:80%;
    }
    .scroll{
        position: fixed;
        right: 30px;
        bottom: 50px;
        cursor: pointer;
    }

</style>  
</head>
<body> 
    <div id="contentBox" class="layout_div">
        <?php include('theader.php'); ?> 
    </div>
	    <div class="containter">
		 	   <div class="header-img">
		 	   		<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img1.jpg" alt="班班,千万红包免费送"/> 
		 	   		<a href="http://www.banban.im/index.php/openregister/index" class="register"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/btn1.jpg"/> </a>
		 	   </div>
		 	   <div class="center">
		 	   		<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img2.jpg" alt="班班活动流程及班班活动细则"/> 
		 	   </div>
		 	   <div >
		 	   		<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img3.jpg" alt="关于班班，班班介绍及功能"/> 
		 	   </div>
		 </div>
        <?php include('tfooter.php'); ?>  
		 <div class="scroll" id="scroll" style="display: none;">
		 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/top.png"/> 
	    </div> 
	</body>
</html>
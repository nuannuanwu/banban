<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>班班介绍 - 免费开放注册，30万老师的家校沟通专属社交应用。班班客服：400 101 3838</title>
    <meta name="keywords" content="班班,班班网,班班介绍,班务管理,作业通知,蜻蜓校信,蜻蜓班班,校信,校信通,校讯通,家校互动,家校沟通,班费,家校,青豆">
    <meta name="description" content="班班产品介绍 - 班班面向老师开放注册，是教育专属应用；班班让老师家长沟通更便捷，免费沟通还可得福利；班班多家属关注功能,与您共同呵护孩子成长。">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/newstyle.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
   <style>
        body,a ,p,input,h1,h2,h3,h4,h5,h6,ul,li,dl,dt,dd,form{margin:0;padding:0;list-style:none;vertical-align:middle;}
        img{
            border:none;
        }
        .container{
            background:#FFF;
        }
        .bgColor1{
            background:#FaFaFa;
        }
        .container .content{
            width:902px;
            margin:0 auto;
        }
        .container .content img{
            vertical-align:middle;
        }
        .y{
            background:#EFEEE8;
        }
        .scroll{
            position: fixed;
            right: 30px;
            bottom: 50px;
            cursor: pointer;
        }
        .layout_div{width: 1000px; margin: 0 auto; overflow: hidden; clear: both; background:#fff; text-align:center; } 
    </style> 
         
</head>
<body> 
    <div id="contentBox" class="layout_div">
        <?php include('theader.php'); ?>
    </div>
	    <div class="container y">
	    	 <div class="content ">
	    	 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/p1.jpg" alt="班班免费开放注册,家校沟通进入班时代"/> 
	    	 </div>
	    </div>
        <div class="container bgColor1">
	    	 <div class="content ">
	    	 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/p2.jpg" alt="班班功能,老师发送通知,家长轻松接收"/> 
	    	 </div>
	    </div>
	    <div class="container y">
	    	 <div class="content ">
	    	 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/p3.jpg" alt="用班班赚班费得青豆,免费沟通获收益"/> 
	    	 </div>
	    </div>
	    <div class="container bgColor1">
	    	 <div class="content ">
	    	 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/p4.jpg" alt="班班多家长关注功能,与您的家人共同呵护孩子成长"/> 
	    	 </div>
	    </div>
	    <div class="scroll" id="scroll" style="display: none;">
	        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/top.png"/>
	    </div>
        <?php include('tfooter.php'); ?>  
</body>
</html>
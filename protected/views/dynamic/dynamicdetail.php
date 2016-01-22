<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo $model->title;?></title>
		<meta name="keywords" content="班班,班班网,关于班班,班务管理,作业通知,蜻蜓校信,蜻蜓班班,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,家校,青豆">
		<meta name="description" content="'班班'是国内首款基于'班级'为单位，面向老师开放注册建班，老师家长免费使用的新型社交应用，班班为老师和家长提供一种全新的、专属的沟通和社交方式。">
        <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/newstyle.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/dynamic.css'); ?>">
        <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
	</head>
	<body>
    <div id="contentBox" class="layout_div">
        <?php include('theader.php'); ?>
    </div>
     	<div style="border-top:8px solid #F59201;">
		   <div class="container abouts"> 
				<div class="content-box">
					<!--<p class="center"><img src="<?php echo STORAGE_QINNIU_XIAOXIN_TX.$model->image; ?>" alt="蜻蜓互动前台"/> </p>-->
					<h1><?php echo $model->title;?></h1>
                    <p class="datetime"><?php echo substr($model->creationtime,0,10);?></p> 
                    <div><?php echo htmlspecialchars_decode($model->addesc);?></div>
                    <div style="margin-top: 110px;">
                        <a href="javascript:window.history.go(-1)" class="btn btn-orange right"> 返 回 </a>
                    </div>
				</div> 
			</div>
		</div>
        <?php include('tfooter.php'); ?>
        <div class="scroll" id="scroll" style="display: none;">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/top.png"/> 
        </div>
    </body>
</html>

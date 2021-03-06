<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>行业资讯 - 班班资讯及行业资讯。班班客服：400 101 3838</title>
    <meta name="keywords" content="班班,班班网,班班资讯,班班行业资讯,班务管理,作业通知,蜻蜓校信,蜻蜓班班,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,青豆">
    <meta name="description" content="班班行业资讯，关于班班的资讯及行业资讯。">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/newstyle.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/dynamic.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
</head>
<body>
<div id="contentBox" class="layout_div">
    <?php include('theader.php'); ?>
</div>
<div style="border-top:8px solid #F59201;">
    <div class="container about">
        <div class="sidebar">
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('dynamic/banbandynamic')?>" >产品动态</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('dynamic/banbanactivity')?>">活动推广</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('dynamic/banbannews')?>" class="active">行业资讯</a></li>
            </ul>
        </div>
        <div class="content-box">
            <ul class="list">
                <?php if(is_array($list['model'])):?>
                    <?php foreach($list['model'] as $val):?>
                        <li>
                            <h2><?php echo $val->title;?></h2>
                            <p class="datetime"><?php echo substr($val->creationtime,0,10);?></p>
                            <p><?php echo $val->summery;?> </p>
                            <p><a class="lookColor" href="<?php echo Yii::app()->createUrl('dynamic/dynamicdetail/'.$val->id);?>">阅读全文</a></p>
                            <p class="imgbox"><img width="600" src="<?php echo  STORAGE_QINNIU_XIAOXIN_TX.$val->image ;?>" alt="<?php echo $val->title;?>"> </p>
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
                <!--
                <li>
                    <h2>产品更名</h2>
                    <p class="datetime">2015-03-10</p>
                    <p>"班班"是由深圳蜻蜓互动科技有限公司针对老师、家长交流刚需而研发的一款移动互联网教育社交应用。是国内首款基于"班级"为单位，面向老师开放注册建班，老师家长免费使用的新型社交应用，为老师和家长提供一种全新的、专属的沟通和社交方式。 <a class="lookColor" href="">阅读全文</a></p>

                    <p><img width="600" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/about.jpg" alt="蜻蜓互动前台"> </p>
                </li>
                -->
            </ul>
            <div class="page" >
                <?php
                $this->widget('CLinkPager',array(
                        'header'=>'',
                        'firstPageLabel' => '首页',
                        'lastPageLabel' => '末页',
                        'prevPageLabel' => '<',
                        'nextPageLabel' => '>',
                        'pages' => $list['pages'],
                        'maxButtonCount'=>5
                    )
                );
                ?>
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
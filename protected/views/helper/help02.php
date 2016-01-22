<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/help.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon10"></span>老师新手指南
        </div>
        <div class="box">
            <div class="hListBox">
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('helper/help08');?>">
                            <span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/help/c_pic6.png" />
                            </span>
                            <div class="info">
                                <p class="name">加入班级</p>
                                <p class="text">我如何加入一个班级？</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('helper/help14');?>">
                            <span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/help/c_pic4.png" />
                            </span>
                            <div class="info">
                                <p class="name">收看消息</p>
                                <p class="text">如何查看老师发布的消息</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('helper/help16');?>">
                            <span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/help/c_pic5.png" />
                            </span>
                            <div class="info">
                                <p class="name">查看班费</p>
                                <p class="text">如何查看为班级挣的班费?</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="helpListBox">
                <ul>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help03');?>">　●　什么是班班？</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help04');?>">　●　我可以怎样使用班班？</a></li>  
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help05');?>">　●　注册与登录</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help06');?>">　●　在班班我可以干什么？</a></li>  
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help15');?>">　●　我如何查看我孩子所在的班级</a></li>  
                </ul>
            </div>
            <div class="btnBox">
                <!--<a href="<?php echo Yii::app()->createUrl('helper/help12');?>" class="btn btn-default">我还是老师我如何使用班班？</a>-->
            </div>
        </div> 
    </div>
</div>
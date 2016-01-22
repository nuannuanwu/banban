<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/help.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon10"></span>老师新手指南
        </div>
        <div class="box" style="display: none;">
            <div class="helpCentent">
                <div class="helpBox publicHepl">
                    <span class="helpT"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/help/ht_3.png" /></span>
                    <div class="helpListBox ">
                        <ul>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help03');?>">　●　什么是班班？</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help04');?>">　●　我可以怎样使用班班？</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help05');?>">　●　注册与登录</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help06');?>">　●　在班班我可以干什么？</a></li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="helpCentent">
                <div class="helpBox teacherHepl" style="">
                    <span class="helpT"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/help/ht_2.png" /></span>
                     <div class="helpListBox" style="height: 306px;">
                        <ul>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help08');?>">　●　创建班级</a> </li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help09');?>">　●　添加成员 </a> </li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help10');?>">　●　收发消息</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help07');?>">　●　怎样管理班级？</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help11');?>">　●　我如何管理我的班费？</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help12');?>">　●　作为任课老师，我如何加入班级？</a></li>
                        </ul>
                    </div>
                </div>
                <div class="helpBox statusHepl">
                    <span class="helpT"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/help/ht_1.png" /></span>
                    <div class="helpListBox " style="height: 306px;">
                        <ul>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help13');?>">　●　加入班级</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help14');?>">　●　收看消息</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help16');?>">　●　查看班费</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('helper/help15');?>">　●　我如何查看我孩子所在的班级</a></li>  
                        </ul>
                    </div>
                </div>
            </div> 
        </div>  

        <div class="box"> 
            <div class="hListBox">
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('helper/help08');?>">
                            <span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/help/c_pic1.png" />
                            </span>
                            <div class="info">
                                <p class="name">创建班级</p>
                                <p class="text">我要怎么创建班级？</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('helper/help09');?>">
                            <span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/help/c_pic2.png" />
                            </span>
                            <div class="info">
                                <p class="name">添加成员</p>
                                <p class="text">为班级添加成员。</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('helper/help10');?>">
                            <span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/help/c_pic3.png" />
                            </span>
                            <div class="info">
                                <p class="name">收发消息</p>
                                <p class="text">如何发布作业、消息等？</p>
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
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help07');?>">　●　怎样管理班级？</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help11');?>">　●　我的班费和班费卡</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help12');?>">　●　作为任课老师，我如何加入班级？</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help17');?>">　●　我的青豆</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help18');?>">　●　邀请有礼</a></li>
                </ul>
            </div>
            <div class="btnBox" style="display: none;">
                <div class="remind">
                    <span> 如果您同时也是家长，需要退出并以“家长”身份重新登录后，查看家长“帮助”。 </span>
                </div>  
                <!--<a href="<?php echo Yii::app()->createUrl('helper/help13');?>" class="btn btn-default">我还是孩子家长我如何使用班班？</a>-->
            </div>
           
            <div class="hListBox" style="display: none;">
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('helper/help13');?>">
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
            <div class="helpListBox" style="display: none;">
                <ul>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help03');?>">　●　什么是班班？</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help04');?>">　●　我可以怎样使用班班？</a></li>  
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help05');?>">　●　注册与登录</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help06');?>">　●　在班班我可以干什么？</a></li>  
                    <li><a href="<?php echo Yii::app()->createUrl('helper/help15');?>">　●　我如何查看我孩子所在的班级</a></li>  
                </ul>
            </div>
            <div class="btnBox" style="display: none;">
                <div class="remind">
                    <span> 如果您同时也是老师，需要退出并以“老师”身份重新登录后，查看老师“帮助”。</span>
                </div> 
                <!--<a href="<?php echo Yii::app()->createUrl('helper/help12');?>" class="btn btn-default">我还是老师我如何使用班班？</a>-->
            </div> 
             
        </div> 
    </div>
</div>




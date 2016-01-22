<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
<meta content="telephone=no" name="format-detection">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"> 
<meta content="yes" name="apple-mobile-web-app-capable" /> 
<meta content="black" name="apple-mobile-web-app-status-bar-style" /> 
<meta content="telephone=no" name="format-detection" /> 
<title><?php echo $topic->title;?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/phpemoji/emoji.css'); ?>"> 
<!-- If you'd like to support IE8 --> 
<style type="text/css">
    ,* { tap-highlight-color: transparent }
    * { -webkit-tap-highlight-color: transparent; }
    html,body{ width: 100%; height: auto; padding: 0; margin: 0 auto; background-color: #f5f5f3;}
    p,div{ padding: 0; margin: 0;}
    a{ text-decoration: none; color: #4c4c4c; }
    .f-left{ float: left; }
    .f-right{ float: right; }
    .layout{ position: relative; max-width:640px; min-width:280px; margin:0 auto;  font-family: "黑体";}
    .layout-main {position: relative; width: 100%; padding: 0px; padding-bottom: 80px; margin: 0 auto;}
    .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;background-color:#ffffff; }
    .img-box{ position: relative; width: 100%; }
    .img-box img{ width: 100%; height: auto; vertical-align:text-bottom;  *vertical-align: auto;}
    .img-box img.pic{ width: 30px; height: 30px; }
    .box-left{ width: 9%; float: left; }
    .box-rigth{ width: 88%; margin-left: 12%; }
    .m-margin{ margin-right: 16% }
    .m-margin5{ margin-right: 10px;}
    .btn{ display: inline-block; height: 22px; line-height: 22px;  padding: 0px 8px; font-size: 15px; background-color: #FFFFFF; color: #F79301; border: 1px solid #F79301; border-radius: 3px 3px; }
    .btnD{ display: block; background-color: #F79301; color: #FFFFFF; height: 45px; line-height: 45px; font-size: 18px; padding: 0; border-radius: 5px 5px; -webkit-border-radius: 5px 5px; }
    .txt{ color: #777777; font-size: 17px; word-wrap : break-word; white-space:normal; }
    .header { display: block; height: 32px; line-height: 32px; overflow: hidden; }
    .banner{position: relative; width: 100%; min-height: 120px; margin: 0 auto; padding: 0; margin-bottom: 15px; overflow: hidden; }
    .p-btn{ position: absolute; right: 8px; bottom: 10px; }
    .u-box{ position: relative; width: 30px; height: auto; border-radius: 50%; -webkit-border-radius: 50%; -moz-border-radius: 50%; }
    .u-box .v-ap{ position: absolute; width: 15px; right: -3px; bottom: -3px;  }
    .u-box img{ border-radius: 50%; -webkit-border-radius: 50%; -moz-border-radius: 50%;}
    .u-info{ margin-bottom: 8px; }
    .u-info .name{ color: #777777;  font-size: 16px; margin-top: 5px;}
    .u-info .time{ color: #a6a6a6; font-size: 12px; margin-top: 3px;}
    .c-box{width: 100%; padding-bottom: 20px; border-bottom: 1px #f2f2f2 solid;}
    .c-img{ min-height: 120px; }
    .c-box img{ border-radius: 5px; }
    .f-detail{ overflow: hidden; padding: 10px 0; margin: 0 auto; font-size: 14px; } 
    .atlas-count{ display: block; position: absolute; right: 0; bottom: 1px;  font-size: 15px; padding:5px 10px; color: #ffffff; border-radius:0 0 5px 0; background-color: #000000; opacity: 0.5; }
    .c-txt{ font-size: 17px; color: #4c4c4c; margin-bottom:10px; text-align: justify; }
    .itme{ width: auto; height: 30px; line-height: 30px; color: #a6a6a6; display: inline-block; padding: 2px 10px; background-color: #f5f5f5; border-radius: 15px; } 
    a.on,a.active:active,a.active:hover,a.active:link{ color: #f59201; background-color: #ffedd1;}
    .header .datetime{ font-size: 16px; color: #a2a2a2; padding: 8px 0;  } 
    .info{ width: 100%; word-wrap : break-word; white-space:normal; padding: 0; margin: 0 auto; line-height: 24px;}
</style>
</head>
<body>
    <div style="display:none">
        <span><?php echo $topic->summary;?></span>
        <?php if($topic->pic):?>
            <img src="<?php echo strpos($topic->pic, 'http://') === false ? STORAGE_QINNIU_XIAOXIN_TX . $topic->pic : $topic->pic;?>" />
        <?php endif; ?>
    </div>
    
    <div id="layout" class="layout" <?php if($bt=='web'): ?> style="width: 430px; height: 500px;"<?php endif; ?>>
        <div class="layout-main">
            <div class="box" style=" margin-bottom: 0;">
                <a href="<?php echo ($bt=='web'? Yii::app()->createUrl('/mobile/classinvscan') : APP_MOLO_DOWNLOAD_URL );?>" class="header">
                    <div class="box-left img-box">
                        <img class="pic" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/logo.png"/>
                    </div>
                    <div class="box-rigth">
                        <div class="f-right">
                            <span class="btn">打开</span>
                        </div>
                        <div class="m-margin">
                            <span class="txt">班班：为孩子加油，为老师分忧.</span> 
                        </div> 
                    </div>
                </a> 
            </div>
             <?php if($topic->pic):?>
            <div class="banner">               
                <a href="javascript:popupBox('#popupBoxs','#popMask');" class="img-box">
                    <img src="<?php echo strpos($topic->pic, 'http://') === false ? STORAGE_QINNIU_XIAOXIN_TX . $topic->pic : $topic->pic;?>" />
                </a>
                <?php if(isset($topic->action) && $topic->action->btnUrl != ''):?>
                    <a href="<?php echo $topic->action->btnUrl;?>" target="_blank" class="btn p-btn"><?php echo $topic->action->text;?></a>
                <?php endif;?>
            </div>
            <?php endif;?>
            <?php
                $i = 0; 
                foreach($posts as $post):
                $i++;
                if($i > 3) break;
            ?>
            <div class="box">
                <div class="box-left img-box">
                    <div class="u-box">
                        <img class="pic" src="<?php echo $post->senderObject->photo ? STORAGE_QINNIU_XIAOXIN_TX . $post->senderObject->photo.'?imageView2/1/w/30/h/30' : Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png'; ?>" onerror="javascript:this.src='<?php echo Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png';?>'" />
                        <?php if($post->senderObject->identity==1): ?>
                        <div class="v-ap">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/v.png"/>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="box-rigth">
                    <div class="u-info">
                        <p class="name"><?php echo $post->senderObject->senderName; ?></p>
                        <p class="time"><?php echo MainHelper::tmspan($post->publishTime); ?></p>
                    </div>
                    <div class="c-box">
                        <div class="c-txt">
                            <a href="<?php echo Yii::app()->createUrl('/mobile/posts',array('uid'=>$uid,'postid'=>$post->msgId));?>">
                                <?php
                                    //$post->describe = '其它文本'. $post->describe . '其它文本#banban://1?ttt=123&xx=中文参数;content=按钮文本;#其它文本';
                                    $post->describe = preg_replace('/#banban:\/\/.*?;content=(.*?);#/', '<font color="#1E90FF">$1</font>', $post->describe);
                                    $post->describe = preg_replace('/#http:\/\/.*?;content=(.*?);#/', '<font color="#1E90FF">$1</font>', $post->describe);
                                    echo $post->describe; 
                                ?>
                            </a>
                        </div>
                        <?php if(isset($post->videourls) && $post->videourls):?>
                        <?php foreach($post->videourls as $video): ?>
                            <?php //echo $video->height; ?> 
                            <?php //echo $video->width; ?>  
                            <div class="v-box" style=" position: relative; overflow: hidden;">
                                <video class="video-js" controls="controls" preload="auto" width="100%"  height="300px"  poster="<?php echo strpos($video->pictureUrl, 'http://') === false ? STORAGE_QINNIU_XIAOXIN_TX . $video->pictureUrl : $video->pictureUrl; ?>" data-setup="{}">
                                      <source src="<?php echo strpos($video->videoUrl, 'http://') === false ? STORAGE_QINNIU_XIAOXIN_TX . $video->videoUrl : $video->videoUrl; ?>" type='video/mp4'>
                                </video> 
                            </div>
                        <?php endforeach; ?> 
                        <?php endif;?>
                        <?php if(isset($post->picurls) && $post->picurls):?>
                        <div class="img-box c-img"> 
                            <a href="<?php echo Yii::app()->createUrl('/mobile/posts',array('uid'=>$uid,'postid'=>$post->msgId));?>">
                                <img class="ac" src="<?php echo count($post->picurls) ? (strpos($post->picurls[0]->url, 'http://') === false ? STORAGE_QINNIU_XIAOXIN_TX . $post->picurls[0]->url : $post->picurls[0]->url) : ""; ?>" />
                                <?php if(count($post->picurls) > 1):?>
                                <span class="atlas-count">多图</span>
                                <?php endif;?>
                            </a>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="f-detail">
                        <a href="javascript:popupBox('#popupBoxs','#popMask');" class="itme m-margin5"> 赞 <?php if($post->likeNum!=0) echo $post->likeNum; ?></a>
                        <a href="javascript:popupBox('#popupBoxs','#popMask');" class="itme"> 回复 <?php echo $post->commentNum; ?></a>
                        <a href="javascript:popupBox('#popupBoxs','#popMask');" class="itme f-right"> 分享 <?php echo $post->shareNum >= 10000 ? ceil($post->shareNum/1000) . 'K' : $post->shareNum; ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
             <div style="position: fixed; left: 0; bottom: -2px; width: 100%; border-top:1px #f2f2f2 solid; z-index: 10; text-align: center; ">
                <a href="javascript:popupBox('#popupBoxs','#popMask');" class="img-box" style=" display: block; <?php if($bt=='web'): ?>width: 430px;<?php else: ?> max-width: 750px;<?php endif; ?> margin: 0 auto;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/entry.jpg" />
                </a>
            </div> 
    
            <div id="popupBoxs" class="popupBox" style=" display: none; position: fixed; left: 0;<?php if($bt=='web'): ?> top: 30%;<?php else: ?>  bottom: 10px;<?php endif; ?> width: 100%; z-index: 20;">
                <div style=" margin: 0 auto; <?php if($bt=='web'): ?>width: 430px;<?php else: ?> max-width: 750px;<?php endif; ?>">
                    <div style="position: relative; width:100%; margin: 0 auto;">
                        <a href="<?php echo Yii::app()->createUrl('mobile/getgiftbypost', array('uid'=>$uid));?> " class="close" style=" position: absolute; right: 2%; top:2%; width: 32px; height: 32px; z-index: 25;">
                            <img style=" max-width: 100%;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/close.png" />
                        </a> 
                        <div class="img-box" style=" width:100%; min-height: 150px; padding: 0; display: block;  margin: 0 auto;  ">
                            <img style=" display: block;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/pup_t.png" />
                        </div> 
                        <div style="width:100%; margin: 0 auto;">
                            <div style=" width: 93.734%; font-size: 19px; background-color: #ffffff; text-align: center; border:none; border-radius: 0 0 10px 10px; padding: 20px 0; margin:0px auto;">
                                <a class="btn btnD" style="width:80%; margin: 0 auto;" href="<?php echo $bt == 'web' ? Yii::app()->createUrl('mobile/classinvscan') : APP_MOLO_DOWNLOAD_URL;?>">上APP玩转班班</a>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div id="popMask" class="" style="display: none; position: absolute; left: 0; top:0px; width: 100%; height: 100%; background-color: #000000; opacity: 0.6; z-index: 15;"></div>
        </div> 
    </div> 
    <script type="text/javascript">
        
        function $(idd){
            var obj = {};
            if( typeof( idd ) === 'string'){
                var idName = idd.substr(1, idd.length );
                //alert(idName)
                if( idd.substr(0,1) === '#' ){
                    obj = document.getElementById(idName);
                } else if( idd.substr(0,1) === '.'){
                    obj =  document.getElementsByName(idName);
                 //obj = obj.length ? document.getElementsByClassName(idName) : null;
                 //alert(obj.length);
                 //alert( obj[0].className )
                } else if( idd == 'document' ){
                    obj = document;
                } else {
                    obj = document.getElementsByTagName(idd);
                 //alert(idd)
                }
            } else {
                obj = idd;
            }
            return obj;
        }
        window.onload = function (){
            $('#layout').style.height = setHeight()+'px';
        };
        window.onresize = function() {//改变浏览器大小的时候触发
            $('#layout').style.height = setHeight()+'px';
        }
        function setHeight(){
            var hPage = window.document.body.clientHeight; 
            var hPageUsing = document.documentElement.clientHeight;
            if(hPageUsing > hPage){
                hPage = hPageUsing;
            }
            return hPage;
            
        } 
        function popupBox(str,mStr){
            $(str).style.display = "block";
            popMask(mStr);
        }
        function popMask(str){ 
            $(str).style.display = "block";
            $(str).style.height = setHeight()+'px';
        }
        function closeBtn(str,mStr){
            $(str).style.display = "none";
            $(mStr).style.display = "none";
        }
    </script>
</body>
</html>

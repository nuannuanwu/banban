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
<title><?php echo $post->msg->title;?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/phpemoji/emoji.css'); ?>"> 
<style type="text/css">
    ,* { tap-highlight-color: transparent }
    * { -webkit-tap-highlight-color: transparent; }
    html,body{ width: 100%; height: auto; padding: 0; margin: 0 auto; background-color: #f5f5f3;} 
    a{ text-decoration: none; }
    .f-left{ float: left; }
    .f-right{ float: right; }
    .layout{ position: relative; max-width:750px; min-width:280px; margin:0 auto;  font-family: "黑体";}
    .layout-main {position: relative; width: 100%; padding: 0px;  padding-bottom: 80px; margin: 0 auto; }
    .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;background-color:#ffffff; }
    .img-box{ position: relative; width: 100%; }
    .img-box img{ width: 100%; height: auto; vertical-align:text-bottom; *vertical-align: auto;}
    .img-box img.pic{ width: 30px; height: 30px; }
    .box-left{ width: 9%; float: left; }
    .box-rigth{ margin-left: 12%; }
    .m-margin{ margin-right: 16% }
    .m-margin5{ margin-right: 10px;}
    .btn{ display: inline-block; height: 22px; line-height: 22px;  padding: 0px 8px; font-size: 15px; background-color: #FFFFFF; color: #F79301; border: 1px solid #F79301; border-radius: 3px 3px; }
    .btnD{ display: block; background-color: #F79301; color: #FFFFFF; height: 45px; line-height: 45px; font-size: 18px; padding: 0; border-radius: 5px 5px; -webkit-border-radius: 5px 5px; }
    .txt{ color: #777777; font-size: 17px; word-wrap : break-word; white-space:normal; }
    .header { display: block; height: 32px; line-height: 32px; overflow: hidden; }
    .banner{position: relative; width: 100%; min-height: 120px; margin: 0 auto; padding: 0; margin-bottom: 15px; overflow: hidden; }
    .p-btn{ position: absolute; right: 8px; bottom: 10px; }
    .p-b{ position: absolute; width: 100%; text-align: center; z-index: 1; }
    .u-box{ position: relative; width: 30px; height: auto; border-radius: 50%; -webkit-border-radius: 50%; -moz-border-radius: 50%; }
    .u-box .v-ap{ position: absolute; width: 50%; right: -3px; bottom: -3px;  }
    .u-box img{ border-radius: 50%; -webkit-border-radius: 50%; -moz-border-radius: 50%;}
    .u-info{ margin-bottom: 8px; }
    .u-info p{ padding: 0; margin: 0;}
    .u-info p.name{ color: #777777;  font-size: 16px; margin-top: 5px;}
    .u-info p.time{ color: #a6a6a6; font-size: 12px; margin-top: 3px;}
    .c-box{width: 100%; padding-bottom: 20px; }
    .c-img{ min-height: 120px; }
    .c-box img.ac{ border-radius: 5px; }
    .atlas-count{ display: block; position: absolute; right: 0; bottom: 1px;  font-size: 15px; padding:5px 10px; color: #ffffff; border-radius:0 0 5px 0; background-color: #000000; opacity: 0.5; }
    .c-txt{ font-size: 17px; color: #4c4c4c; margin-bottom:10px; text-align: justify; line-height: 22px; }    
    .c-txt p{ line-height: 22px; padding: 0px 0; margin: 0 auto;}
    .f-detail{ overflow: hidden; padding: 0px 0; margin: 0 auto; font-size: 14px; }
    .f-d a{ cursor: default;}
    .f-share{ text-align: center; }
    .f-title{ text-align: center; font-size: 14px; color: #999999; margin-bottom: 10px; }
    .p-title{ text-align: center; font-size: 14px; color: #999999; background-color: #ffffff; padding: 5px 0; border-bottom: 1px #f2f2f2 solid; line-height: 30px;}
    .f-share a{ display: inline-block; width: 10.3333%; margin:0 10px; }
    .p-box { position: relative; height: 34px; padding: 5px 10px 5px 0;  overflow: hidden;  }
    .p-box .pitme{ width: 30px; float: left; margin-right: 6px; margin-bottom: 10px; }
    .itme{ width: auto; height: 30px; line-height: 30px; color: #a6a6a6; display: inline-block; padding: 2px 10px; background-color: #f5f5f5; border-radius: 15px; } 
    a.on,a.active:active,a.active:hover,a.active:link{ color: #f59201; background-color: #ffedd1;}
    .header .datetime{ font-size: 16px; color: #a2a2a2; padding: 8px 0;  } 
    .info{ width: 100%; word-wrap : break-word; white-space:normal; padding: 0; margin: 0 auto; line-height: 24px;}
    .playBox{position: absolute;top:0%; left: 0%; width: 100%; height: 100%; text-align: center; z-index: 10; }
    .playBtn{ display: inline-block; width: 60px;  height:60px; margin-top: 25%; background: url('/image/banban/mobile/posts/play.png') center no-repeat; } 
</style> 
</head>
<body>
<?php if(!function_exists('emoji_unified_to_html')){
    require_once('protected/extensions/PHPEmoji/emoji.php');
} ?>
    <div id="layout" class="layout" <?php if($bt=='web'): ?> style=" width: 430px; height: 500px;"<?php endif; ?>>
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
            <div class="box">
                <div class="box-left img-box">
                    <div class="u-box ">
                        <img class="pic" src="<?php echo $post->msg->senderObject->photo ? STORAGE_QINNIU_XIAOXIN_TX . $post->msg->senderObject->photo.'?imageView2/1/w/30/h/30' : Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png'; ?>"  onerror="javascript:this.src='<?php echo Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png';?>'"/>
                        <?php if($post->msg->senderObject->identity==2): ?>
                        <div class="v-ap">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/v.png"/>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="box-rigth">
                    <div class="u-info">
                        <p class="name"><?php echo emoji_unified_to_html($post->msg->senderObject->senderName); ?></p>
                        <p class="time"><?php echo MainHelper::tmspan($post->msg->publishTime);?></p>
                    </div> 
                </div>
                <div class="c-box">
                <?php if(count($post->content)):?>
                <?php foreach ($post->content as $contentItem):?>
                    <div class="c-txt">
                        <?php
                            
                            if(isset($contentItem->text) && $contentItem->text ){
                                //$content = '其它文本'. $post->content[0]->text . '其它文本#banban://1?ttt=123&xx=中文参数;content=按钮文本;#其它文本';
                                $content = $contentItem->text;              
                                $pos = strpos($contentItem->text, 'ontent=');
                                if($pos) {
//                                     $pos += 7;
//                                     $pos2 = strpos($post->content[0]->text, ';', $pos);
//                                     $content = substr($post->content[0]->text, $pos, $pos2 - $pos);
                                    $content = preg_replace('/#banban:\/\/.*?;content=(.*?);#/', '<font color="#1E90FF">$1</font>', $content);	
                                    $content = preg_replace('/#http:\/\/.*?;content=(.*?);#/', '<font color="#1E90FF">$1</font>', $content);
                                   // $content = preg_replace('/;#/', '', $content);
                                    echo '<p>' . implode("</p><p>", explode("\n", emoji_unified_to_html($content))) . '</p>';
                                    
                                }else{
                                    echo '<p>' . implode("</p><p>", explode("\n", emoji_unified_to_html($contentItem->text))) . '</p>';
                                }
                                                                
                            }else{
                                echo isset($contentItem->text) && $contentItem->text ? '<p>' . implode("</p><p>", explode("\n", emoji_unified_to_html($contentItem->text))) . '</p>' : "";
                            }
                        ?>
                    </div>
                    <?php if($contentItem->video->videoUrl):?>
                        <?php //echo $contentItem->video->height; ?> 
                        <?php //echo $contentItem->video->width; ?> 
                        <div class="v-box" style=" position: relative; overflow: hidden;">
                            <video class="video-js" controls="controls" preload="auto" width="100%"  height="300px" poster="<?php echo isset($contentItem->video->pictureUrl) && $contentItem->video->pictureUrl ? (strpos($contentItem->video->pictureUrl, 'http://') === false ? STORAGE_QINNIU_XIAOXIN_TX . $contentItem->video->pictureUrl : $contentItem->video->pictureUrl): ''; ?>" data-setup="{}">
                                  <source src="<?php echo isset($contentItem->video->videoUrl) && $contentItem->video->videoUrl ? (strpos($contentItem->video->videoUrl, 'http://') === false ? STORAGE_QINNIU_XIAOXIN_TX . $contentItem->video->videoUrl : $contentItem->video->videoUrl):''; ?>" type='video/mp4'>
                            </video> 
                        </div>
                    <?php endif;?>
                    
                    <?php if($contentItem->picture->url):?>
                    <div class="img-box c-img">
                        <img src="<?php echo isset($contentItem->picture->url) && $contentItem->picture->url ? (strpos($contentItem->picture->url, 'http://') === false ? STORAGE_QINNIU_XIAOXIN_TX . $contentItem->picture->url : $contentItem->picture->url) : ''; ?>" />
                    </div>
                    <?php endif;?>
                <?php endforeach;?>
                <?php endif;?>
                </div>                  
                <div class="f-detail f-d" style=" margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px #f2f2f2 solid;">
                    <a href="javascript:popupBox('#popupBoxs','#popMask');" class="itme m-margin5"> 赞  <?php if($post->msg->likeNum!=0) echo $post->msg->likeNum;?></a>
                    <a href="javascript:popupBox('#popupBoxs','#popMask');" class="itme"> 回复 <?php echo $post->msg->commentNum;?></a>
                    <a href="javascript:popupBox('#popupBoxs','#popMask');" class="itme  f-right"> 分享 
                        <?php echo $post->msg->shareNum >= 10000 ? ceil($post->msg->shareNum/1000) . 'K' : $post->msg->shareNum; ?>  
                    </a>  
                </div>
                <div class="f-detail f-share">
                    <div class="f-title"><?php echo $post->msg->shareNum; ?>位老师/家长已分享</div>
                    <a href="javascript:popupBox('#popupBoxs','#popMask');" class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/penyou.png">
                    </a>
                    <a href="javascript:popupBox('#popupBoxs','#popMask');" class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/weixin.png">
                    </a>
                    <a href="javascript:popupBox('#popupBoxs','#popMask');" class="img-box">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/qq.png">
                    </a>
                </div>
            </div> 
            <div class="p-title">
                共有<?php echo $post->msg->likeNum;?>人点赞
            </div>             
            <?php $likers = $post->likers;?>            
            <div class="box">
                <div class="p-box">
                    <?php if(count($likers)):?>
                    <?php foreach ($likers as $liker):?>                    
                    <div class="img-box u-box pitme">
                        <img class="pic" src="<?php echo $liker->photo ? STORAGE_QINNIU_XIAOXIN_TX . $liker->photo :  Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png'; ?>"/>
                        <?php if($liker->authentication):?>
                        <div class="v-ap">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/v.png"/>
                        </div>
                        <?php endif;?>
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>            
            <div class="p-title"> 
                共有<?php echo $post->msg->commentNum;?>条回帖 
            </div>  
            <?php if(isset($post->comments) && count($post->comments)):?>
            <?php $comments = $post->comments;?>
            <?php
            $i = 0; 
            foreach ($comments as $comment):
                $i++;
                if($i > 3) break;
            ?>
            <div class="box">
                <div class="box-left img-box">
                    <div class="u-box">
                        <img class="pic" src="<?php echo $comment->content->sender->photo ? STORAGE_QINNIU_XIAOXIN_TX . $comment->content->sender->photo : Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png';;?>"  onerror="javascript:this.src='<?php echo Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png';?>'"/>
                        <?php if($comment->content->sender->identity == 1):?>
                        <div class="v-ap">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/v.png"/>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="box-rigth">
                    <div class="u-info">
                        <div class="f-detail" style=" float: right;"> 
                            <a href="javascript:popupBox('#popupBoxs','#popMask');" class="itme active"> 赞 <?php echo isset($comment->content->likeCount) && $comment->content->likeCount ? $comment->content->likeCount : ' ';?></a>
                        </div>
                        <div style=" margin-right: 65px;">
                            <p class="name"><?php echo emoji_unified_to_html($comment->content->sender->senderName);?></p>
                            <p class="time"><?php echo MainHelper::tmspan($comment->sendTime);?></p> 
                        </div>
                        
                    </div>
                    <div class="c-box">                        
                        <div class="c-txt">
                            <?php if(count($comment->content->content)):?> 
                                <?php foreach ($comment->content->content as $commentItem):?>
                                <?php echo isset($commentItem->text) && $commentItem->text ? emoji_unified_to_html($commentItem->text) : '';?>
                                <br/>
                                <?php if(isset($commentItem->picture->url) && $commentItem->picture->url):?>
                                <div class="img-box">
                                    <img  src="<?php echo isset($commentItem->picture->url) && $commentItem->picture->url ? ( strpos($commentItem->picture->url, 'http://') === false ? STORAGE_QINNIU_XIAOXIN_TX . $commentItem->picture->url . '?imageView2/2/w/500' : $commentItem->picture->url) : ''; ?>" />
                                </div>    
                                <?php endif;?>                                
                                <?php endforeach;?> 
                            <?php endif;?>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
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
                                <a class="btn btnD" style="width:80%; margin: 0 auto;" href="<?php echo ($bt=='web'? Yii::app()->createUrl('/mobile/classinvscan') : APP_MOLO_DOWNLOAD_URL );?>">上APP玩转班班</a>
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
                if( idd.substr(0,1) === '#' ){
                    obj = document.getElementById(idName);
                }   
            } else {
                obj = idd;
            }
            return obj;
        } 
        function getByClass(oParent, sClass){ //
            var aEle=oParent.getElementsByTagName('*');
            var aResult=[]; 
            for(var i=0;i<aEle.length;i++) {
                if(aEle[i].className==sClass) {
                        aResult.push(aEle[i]);
                }
            } 
            return aResult;
        }
        function defaultEvent(e){ //
             if ( e && e.preventDefault ){  
                     e.preventDefault(); //阻止默认浏览器动作(W3C) 
             }else{ 
                 window.event.returnValue = false; //IE中阻止函数器默认动作的方式 
                 return false;
             }
         }
         
        window.onload = function (){
            $('#layout').style.height = setHeight()+'px'; 
        }
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
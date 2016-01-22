<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon3"></span>我的班费卡 > 规则
        </div>
        <div class="box" style="padding:15px 25px;">
            <nav class="navMod navModDone" >
                <a href="<?php echo Yii::app()->createUrl('expense/index'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <?php include 'exprulesim.php'; ?>
        </div>
    </div>
</div>
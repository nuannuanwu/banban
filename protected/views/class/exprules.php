<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<style>
.expense-rule h1 {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: bold;
    color: #585858;
}

.title-2 {
    margin-top: 40px;
}

.intro-list li {
    line-height: 20px;
}

.expense-rule .tips {
    margin-top: 20px;
    margin-bottom: 20px;
    color: #f59201;
}
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
           <span class="icon icon1"></span>我的班班 > 班费 > 规则
        </div>
        <div class="box"> 
		    <nav class="navMod navModDone" >
		        <a href="<?php echo Yii::app()->createUrl('expense/expdetail/'.$class->cid);?>?authority=<?php echo $class->authority; ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
		    </nav>
            <?php echo $this->renderPartial('//expense/exprulesim'); ?>
        </div>
    </div>
</div>
<header>
    <div class="headerBox">
        <a class="logo" href="<?php echo Yii::app()->createUrl('login/index');?>"></a>
        <div class="mainMenu">
            <?php $action = $this->getAction()->getId(); // action  $action="login"; ?>
            <a href="<?php echo Yii::app()->createUrl('login/index');?>" class="<?php if($action=='index'){echo 'on';} ?>">作业通知</a>
            <a href="<?php echo Yii::app()->createUrl('login/educationconcept');?>" class="<?php if($action=='educationconcept'){echo 'on';} ?>">教育观</a>
            <a href="<?php echo Yii::app()->createUrl('login/companynews');?>" class="<?php if($action=='companynews'){echo 'on';} ?>" >公司动态</a>
            <a href="<?php echo Yii::app()->createUrl('login/cooperation');?>" class="<?php if($action=='cooperation'){echo 'on';} ?>" >合作</a>
            <a href="<?php echo Yii::app()->createUrl('login/joinus');?>" class="<?php if($action=='joinus'){echo 'on';} ?>" >加入我们</a>
        </div>

        <div class="user fright <?php echo $userinfo?'':'none';?>">
            <?php  $photo=$userinfo&&$userinfo->icon?STORAGE_QINNIU_XIAOXIN_TX.$userinfo->icon:Yii::app()->request->baseUrl.'/image/banban/login/imgs/touxiang.jpg';?>
            <img width="53" style=" display:inline; vertical-align:middle; border-radius: 50%;" src="<?php  echo $photo;?>">  <a href="<?php  echo Yii::app()->createUrl('site/logout'); ?>">退出</a>
        </div>

        <div class="tell fright"> 
             客服热线 <b>400 101 3838</b>
        </div> 
    </div> 
</header>
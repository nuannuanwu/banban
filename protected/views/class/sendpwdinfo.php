<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > 班级属性
        </div>
        <div class="box">
            <nav class="navMod navModDone" >
                <a href="<?php echo Yii::app()->createUrl('class/'.($type==1?'students/':'teachers/').$class->cid); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="formBox">
                <h1 class="invite-head">批量导入<?php echo $type==1?'学生':'老师';?></h1>
                <?php if($nums>0):?>
                <h2 class="invite-done-head">已成功发送“注册邀请短信”<?php echo $nums;?>名！</h2>
                <?php else:?>
                <h2 class="invite-done-head">未发送注册邀请短信</h2>
                <?php endif;?>



                <?php if(is_array($exists) &&!empty($exists)):?>
                <h3 class="uninvite-head">以下用户已存在，不发送短信（<?php echo count($exists);?>）！</h3>
                <table class="uninvite-table">
                    <?php foreach($exists as $val):?>
                    <tr>
                        <td class="name"><?php echo $val['name'];?></td>
                        <td class="phone"><?php echo $val['mobile'];?></td>
                    </tr>
                    <?php endforeach;?>
                    <!--
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    -->
                </table>
                <?php endif;?>
                <!--
                <h3 class="uninvite-head">以下用户已接受3次邀请而还未注册，不发送短信（4）！</h3>
                <table class="uninvite-table">
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                </table>
                -->
                <div class="invite-action">
                    <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('class/'.($type==1?'students/':'teachers/').$class->cid); ?>">返回“<?php echo $class->name;?>”</a>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/index.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/stcombobox.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/stcombobox.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        //提交

    });
</script>

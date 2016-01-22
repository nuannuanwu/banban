<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > 班级属性 > 转让班主任
        </div>
        <div class="box">
            <nav class="navMod navModDone">
                <a class="btn btn-default" href="<?php echo Yii::app()->createUrl('class/classinfo', array('cid' => $class->cid, 'ac' => $ac)); ?>">
                    <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png"alt="">返回
                </a>
            </nav>
            <p style="margin-top: 20px;color: #f37112;">提醒：更换班主任后，您将失去对班级所有管理权限。</p>
            <h2 class="class-attr-head">〓 选择转让老师</h2>
            <form id="transferForm" action="<?php echo Yii::app()->createUrl('class/master/'.$class->cid);?>" method="post">
                <ul class="class-attr-list">
                <?php foreach($teachers as $val):?>
                    <?php if($val->uid != $uid):?>
                    <li>
                        <span><input id="t_<?php echo $val->uid;?>" type="radio" value="<?php echo $val->uid;?>" name="uid"/></span>
                        <label for="t_<?php echo $val->uid;?>" class="attr-mark-text"><?php echo $val->name;?></label>
                    </li>
                    <?php endif;?>
                <?php endforeach;?>
                <?php if (count($teachers) <= 1) echo '<li style="color: #666;">无可转让老师</li>'; ?>
                </ul>
            </form>
            <h2 class="class-attr-head">〓 规则</h2>
            <ul class="class-attr-list">
                <li>
                    <span class="class-info">老师创建班级后默认成为该班级班主任，创建后可更换班主任身份给其他老师。</span>
                </li>
                <li>
                    <span  class="class-info">一个老师最多只能同时担任三个班级的班主任。</span>
                </li>
            </ul>
            <div class="invite-action">
                <a id="saveChange" class="btn btn-orange" href="javascript:;">保存</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#saveChange').on('click', function() {
        //TODO
        $('#transferForm').submit();
    });
</script>
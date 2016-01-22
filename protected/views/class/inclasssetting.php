<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
           <span class="icon icon1"></span>我的班班 > 班级属性
        </div>
        <div class="box"> 
        <nav class="navMod navModDone" >
                <a href="<?php echo Yii::app()->createUrl('class/classinfo',array('cid'=>$class->cid, 'ac'=>$ac)); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="formBox" style="">
                <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('class/inclasssetting');?>" method="post">
                    <input type="hidden" id="cid" name="Class[cid]" value="<?php echo $class->cid;?>" />
                    <input type="hidden" id="cid" name="ac" value="<?php echo $ac;?>" />
                    <h2 class="class-attr-head">进班设置</h2>
                    <ul class="class-attr-list">
                        <li><input id="radio1" name="Class[inclass]" type="radio" value="0" <?php echo $class->joinverify == 0 ? 'checked="checked"' : '';?>/><label for="radio1">允许任何人加入</label></li>
                        <li><input id="radio2" name="Class[inclass]" type="radio" value="1" <?php echo $class->joinverify == 1 ? 'checked="checked"' : '';?>/><label for="radio2">需要班主任验证才能加入</label><span style="vertical-align: middle; color: #999999;">（如您装有班班手机应用，请确认已更新至v3.8最新版）</span></li>
                        <li><input id="radio3" name="Class[inclass]" type="radio" value="2" <?php echo $class->joinverify == 2 ? 'checked="checked"' : '';?>/><label for="radio3">禁止任何人加入</label></li>
                    </ul>
                    <table class="tableForm" >
                        <tbody>
                            <tr>
                                 <td>  
                                    <a id="submitBtn" href="javascript:;" class="btn btn-orange">保　存</a>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </form>
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
    $('#submitBtn').click(function() {
        $("#formBoxRegister").submit();
    });
});
</script>

<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > 加入班级
        </div>
        <div class="box"> 
            <div class="listTopTite bBottom">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/set_1.png">
            </div> 
            <div class="formBox">
                <div class="formBox" style="">
                    <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('class/chooseclass');?>" method="post" id="searchForm">
                    <input type="hidden" name="ty" id="ty" value="<?php echo $ty?>" />
                        <table class="tableForm">
                            <tbody> 
                                <tr>
                                    <td>
                                        <span class="inputTitle"style=" float: left; color: #000000; font-weight: 700; margin-top: 7px;">查找班级：</span>
                                        <div style=" margin-left:70px;">
                                            <div class="inputBox"><input id="className" style="width:410px;" name="search"  placeholder="" value="" maxlength="11" class="lg" type="text" datatype="*1-11" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" nullmsg="请输入班级代码或班主任手机号！" errormsg="请输入班级代码或班主任手机号有误!"> </div>
                                            <span id="tipCheck" class="Validform_checktip"></span>  
                                            <div class="info" style="display: none;">请输入班级代码或班主任手机号!<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div> 
                                            <input id="isOkType" type="hidden" value="1">
                                            <a class="btn btn-orange" id="submitBtn" style="height: 36px; *height: 22px;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/search_ioc.png"></a>
                                            <p style="color: #999; margin: 5px;">请输入班级代码或班主任手机号</p>
                                        </div> 
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </form>
                    <?php if(isset($classList) && !empty($classList)):?>
                    <div class="resultBox fieldsetBox" >
                        <fieldset>  
                            <legend><!--如果结果条数大于三,请判断下将 style="margin-left: 20px;" 加在legend 下-->
                                <?php echo isset($type) && $type==2 ? '班主任手机号' : '班级代码'?>为 
                                <span class="orange"><?php echo isset($search) && $search ? $search : '';?></span> 的查找结果
                            </legend> 
                            <ul class="resultList">          
                                <?php foreach ($classList as $class):?>
                                <li> <!--如果结果条数只有一条，请将 style="margin-left: 20px;" 加在li 下-->
                                    <div class="classPicS">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/class_pic_4.png">
                                    </div>
                                    <div class="cInfoBox">
                                        <div class="name">
                                            <a href="javascript:;" title="<?php echo $class->cName->val;?>">
                                                <?php echo $class->cName->val;?>
                                            </a>
                                        </div>
                                        <p class="infos ipic_1">代　码：<?php echo $class->classCode->val;?></p>
                                        <p class="infos ipic_2" >
                                            <a href="javascript:;" title="<?php echo $class->masterName->val;?>">
                                                班主任：<?php echo $class->masterName->val;?>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="addBtnBox" style="text-align: right;">
                                    
                                        <?php if($class->joinverify->val != 2):?>
                                        <a href="<?php echo Yii::app()->createUrl('class/perfectinfo', array('classCode'=>$class->classCode->val, 'search'=>$search, 'ty'=>$ty));?>" class="btn btn-default addBtn" style="">
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/addCbtn.png">加入
                                        </a>
                                        <?php else:?>
                                        <a href="javascript:;" style="color: #999999" title="该班级已设置为禁止任何人加入">禁止加入</a>
                                        <?php endif;?>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul> 
                        </fieldset>  
                    </div>
                    <?php elseif(isset($classList) && empty($classList)):?>
                    <div class="resultBox fieldsetBox" >
                        <fieldset>  
                             <legend><?php echo isset($type) && $type==2 ? '班主任手机号' : '班级代码'?>为 <span class="orange"><?php echo isset($search) && $search ? $search : '';?></span> 的查找结果</legend> 
                            <div class="noTip">
                                <img width="98px" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tip.png">
                               <p>亲，你找的班级不存在啦！</p>
                            </div>
                             </fieldset>  
                    </div>
                    <?php endif;?>
            </div>
        </div> 
    </div>
</div>  
<script type="text/javascript">
$(function() {

    //提交
    $('#submitBtn').click(function(){
        $("#formBoxRegister").submit();
    });
});
</script>

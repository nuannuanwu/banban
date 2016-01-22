<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > 加入班级
        </div>
        <div class="box"> 
            <div class="listTopTite bBottom">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/set_2.png">
            </div> 
             <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('class/inclassdone');?>" method="post">
                <input type="hidden" name="classCode" value="<?php echo $classCode&&$classCode != ''?$classCode:'';?>"/>
                <input type="hidden" name="ty" value="<?php echo $ty?$ty:'';?>"/>
                <div class="formBox inclassBox"> 
                    <ul class="resultList" style=" margin-top: 30px;">
                        <li>
                            <div class="classPicS">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/class_pic_4.png">
                            </div>
                            <div class="cInfoBox">
                                <div class="name"><a href="javscript:;" title="<?php echo $class?$class->cName->val:'';?>"><?php echo $class?$class->cName->val:'';?></a></div>
                                <p class="infos ipic_1">代　码：<?php echo $class?$class->classCode->val:'';?></p>
                                <p class="infos ipic_2" ><a href="javscript:;" title="<?php echo $class?$class->masterName->val:'';?>">班主任：<?php echo $class?$class->masterName->val:'';?></a></p>
                            </div> 
                        </li> 
                    </ul>  
                </div>
                <div class="inclassDone fieldsetBox" style=" width: 436px; position: relative;">
                <?php if($ty == 'g'): ?>
                    <!--
                   <fieldset> 
                       <legend>孩子信息</legend>
                       <div class="tableForm" style="margin-top: 10px; height: 125px;">
                           <div class="rowBox">
                               <span class="inputTitle"style=" float: left; text-align: right; color: #000000; width: 80px; margin-top: 7px;">孩子姓名：</span>
                               <div class="inputBox" style=" display: block; position: relative; zoom: 1;margin-left: 86px;*margin-left: 0px;">
                                   <input id="nameUids" type="text" placeholder="真实姓名" name="studentName" value="" maxlength="20" class="mediumLx" type="text" datatype="*1-20,namestr" nullmsg="请输入孩子姓名！" tiptext="姓名" errormsg="姓名只允许中英文数字以及()_-.和空格组成！"> 
                                   <div  class="info infoTip" style="display: none; top:-10px; width: 300px; position: absolute; zoom: 1;left: 280px; *left:290px;">为方便班主任辨认，同一班级内不允许出现相同名字的学生。如果您要加入的班内确实有同名学生，请联系班主任给予协商。<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div> 
                                    <p class="codeTip" style=" position: absolute; left: 285px; *left:290px; top:5px; height: 40px; display: inline-block; ">
                                        <span class="Validform_checktip"  style="margin-left: 0px;"> 
                                         <?php if(isset($msg) && $msg):?>  
                                            <span class="Validform_checktip Validform_wrong" style="margin-left: 0px; white-space:pre-wrap;overflow: visible; display: inline-block; width: 300px;"><?php echo $msg;?> </span>    
                                           <?php endif;?>  
                                         &nbsp;</span> 
                                    </p>
                                </div> 
                                <span class="Validform_checktip codeTips" style="margin-left: 78px; *margin-left: 76px; height: 20px; display:none;">&nbsp;</span>
                                <span class="Validform_checktip Validform_wrong errorTexts" style="margin-left: 78px; *margin-left: 76px; height: 20px; display:none;">&nbsp; </span>                                                               <p class="codeTipT">&nbsp;</p>
                           </div> 
                           <div class="rowBox">
                               <span class="inputTitle" style=" float: left; color: #000000; text-align: right; width: 80px; margin-top: 7px;">与孩子关系：</span>
                               <div class="inputBox" style="display: block; position: relative; zoom: 1;margin-left: 86px;*margin-left: 0px;">
                                   <input type="text" tiptext="称谓"  id="relation" placeholder="请填写孩子对您的称谓，如：爸爸、妈妈" name="relation" value="" maxlength="20" class="mediumLx" type="text" datatype="*1-20,namestr" nullmsg="请填写孩子对您的称谓，如：爸爸、妈妈！" errormsg="称谓只允许中英文数字以及()_-.和空格组成！">
                               </div> 
                               <span class="Validform_checktip codeTips" style="margin-left: 78px; *margin-left: 76px; display:none;">&nbsp;</span>
                               <span class="Validform_checktip Validform_wrong errorTexts" style="margin-left: 78px; *margin-left: 76px; display:none;">&nbsp; </span> 
                           </div>
                       </div>
                   </fieldset>
                   -->
                <?php endif; ?>
                <?php if($class): ?>
                    <fieldset> 
                       <legend>老师信息</legend>
                       <div class="tableForm" style=" height: 80px; margin-top: 10px;">
                           <div class="rowBox" > 
                                <span class="inputTitle" style=" float: left; text-align: right; color: #000000; width: 80px; margin-top: 7px; height: 40px;">任教科目：</span>
                                <div style="position: relative; margin-left: 86px;*margin-left: 0px; zoom: 1;">
                                    <div class="inputBox" style="display: block; position: relative;  zoom: 1;"> 
                                        <input type="text" tiptext="任教科目" placeholder="" id="subjectName" name="subjectName" value="" maxlength="20" class="mediumLx" type="text" datatype="*1-20,subjectstr" nullmsg="任教科目不能为空" errormsg="只允许中英文数字以及()_-.,和空格组成！">
                                        <div class="info infoTip" style="  display: none; width: 300px; top:-10px;  position: absolute; left: 280px; *left:290px;">同一个用户只能以老师身份加入班级一次（包括班主任创建班级时），否则加入失败。<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
<!--                                        <span style="color: #999;">多科目，请用逗号区分。如：语文，数字</span>--> 
                                        <div style="height: 20px;">
                                            <span class="codeTip">
                                                <?php if(isset($msg) && strpos($msg, 'teacher')>0): ?>
                                                    <span class="Validform_checktip Validform_wrong"  style="margin-left: 0;">您已是当前班级的老师，不能重复加入</span>
                                                <?php endif;?>
                                               &nbsp; 
                                           </span> 
                                             &nbsp; 
                                        </div>
                                    </div>  
                                    <span class="Validform_checktip codeTips" style=" display:none; margin-left: 0;"></span>
                                    <span class="Validform_checktip Validform_wrong errorTexts" style="display:none; margin-left:0px;"></span> 
                               </div>
                           </div>
                       </div>
                   </fieldset>
                <?php endif; ?>
                </div>
                <div class="btnBox" style="margin-top: 20px;">
                    <a href="<?php echo Yii::app()->createUrl('class/chooseclass',array('search'=>$search,'ty'=>$ty));?>" class="btn btn-default"> 上一步</a>
                    <a href="javascript:;" id="submitBtn" class="btn btn-orange"> 加入班级</a>   
                </div>
            </form>
        </div>
    </div> 
</div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script>
    $(function(){
        Validform.int("#formBoxRegister");
        //input 获取/失去焦点事件
        $('input[type=text]').keypress(function(){
            $(this).next('.infoTip').show();  
            $(this).parents('.rowBox').find('.codeTip').hide();
            $(this).parents('.rowBox').find('.infoTips').show();
            $(this).parents('.rowBox').find('.codeTips').show();
            $(this).parents('.rowBox').find('.errorTexts').hide();
            $('.codeTip').hide();
        });
        $('input[type=text]').focus(function(){
            $(this).next('.infoTip').show(); 
            $(this).parents('.rowBox').find('.codeTip').hide();
            $(this).parents('rowBox').find('.infoTips').show();
            $(this).parents('rowBox').find('.codeTips').show();
            $(this).parents('rowBox').find('.errorTexts').hide();
            $('.codeTip').hide();
        });
//        $('input[type=text]').focusout(function(){
//            $(this).next('.infoTip').hide(); 
//            $('.codeTip').hide();
//            $('.infoTips').show();            
//        });
        $('input[type=text]').focusout(function(){
            var name = $(this).val();
            var text = $(this).attr('tiptext');
            $(this).parents('.rowBox').find('.codeTipT').hide();
            if(getByteLen(name)<=20){ 
                $(this).next('.infoTip').hide(); 
                $(this).parents('.rowBox').find('.codeTip').hide();
                $(this).parents('.rowBox').find('.infoTips').show();
                $(this).parents('.rowBox').find('.codeTips').show();
                $(this).parents('.rowBox').find('.errorTexts').hide(); 
                $('.codeTip').hide();
           }else{  
                $(this).parents('.rowBox').find('.codeTip').hide();
                $(this).parents('.rowBox').find('.infoTips').hide();
                $(this).parents('.rowBox').find('.codeTips').hide();
                $(this).parents('.rowBox').find('.errorTexts').text(text+'不能超过10个汉字（或20个英文字符）').show();
                $('.codeTip').hide();
            } 
       });
        $("#submitBtn").click(function(){
            if($("#nameUids").length > 0){
            	var name = $('#nameUids').val();
                var relation =$('#relation').val()
            	if(getByteLen(name)<=20&&getByteLen(name)>0){
                    if(getByteLen(relation)<=20&&getByteLen(relation)>0){
                        $("#formBoxRegister").submit();
                    }else{
                        $('.codeTip').hide();
                        $('.codeTipT').hide();
                        $('.infoTips').hide();
                        $('.infoTips').hide();
                        if(relation==""){ 
                            $("#formBoxRegister").submit();
                            $('.codeTips').show();
                        }else{
                            $('.errorTexts').text('称谓不能超过10个汉字（或20个英文字符）!').show();  
                        }
                    }
               }else{
                    $('.codeTip').hide();
                    $('.codeTipT').hide();
                    $('.infoTips').hide();
                    $('.infoTips').hide();
                    if(name==""){ 
                        $("#formBoxRegister").submit();
                        $('.codeTips').show();
                    }else{
                        $('.errorTexts').text('姓名不能超过10个汉字（或20个英文字符）!').show();
                    }
                }
            }else{
                var subjectName = $("#subjectName").val();
                if(getByteLen(subjectName)<=20&&getByteLen(subjectName)>0){
                     $("#formBoxRegister").submit(); 
                }else{
                    $('.codeTip').hide();
                    $('.codeTipT').hide();
                    $('.infoTips').hide();
                    $('.infoTips').hide();
                    if(subjectName==""){ 
                        $("#formBoxRegister").submit();
                        $('.codeTips').show();
                    }else{
                        $('.errorTexts').text('科目不能超过10个汉字（或20个英文字符）！').show();  
                    } 
                } 
            }
        });
        /** 
         * 计算字符串的字节数 
         * @param {Object} str 
         */   
        function  getByteLen(str){   
            var l=str.length;   
            var n = l;   
            for ( var i=0;i <l;i++){  
                if( str.charCodeAt(i) <0 ||str.charCodeAt(i)> 255){  
                    n++;   
                }   
            }   
            return n;   
        }
    });
</script>

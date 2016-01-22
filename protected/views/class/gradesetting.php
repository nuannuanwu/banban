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
                <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('class/gradesetting');?>" method="post">
                    <input type="hidden" id="cid" name="Class[cid]" value="<?php echo $class->cid?>" />
                    <input type="hidden" id="cid" name="ac" value="<?php echo $ac;?>" />
                    <table class="tableForm">
                        <tbody> 
                            <tr>
                                <td>
                                    <span class="inputTitle"style=" float: left; color: #000000; font-weight: 700; margin-top: 7px;">班级名称：</span>
                                    <div style=" margin-left:70px;">
                                        <div class="inputBox" style="display: inline-block; *display: inline; width: 430px; position: relative;">
                                            <input id="className" style="width:410px;" url="<?php echo Yii::app()->createUrl('class/classexist');?>" name="Class[name]"  placeholder="请输入班级名称" value="<?php echo $class->name;?>" maxlength="20" class="lg" type="text" datatype="*1-20,namestr" nullmsg="请输入班级名称！" errormsg="只允许中英文数字以及()_-.和空格组成！">
                                            <span style=" *display: inline-block; color: red; *line-height: 32px;" > * </span> 
                                            <div class="info" style="display: none; position: absolute; right: -320px;background:#fff;">班级名称不能超过10个汉字（或20个英文字符）！<span class="dec" style="*top:8px;"><s class="dec1">◆</s><s class="dec2">◆</s></span></div> 
                                        </div>
                                        <span id="tipCheck" class="Validform_checktip"></span>  
                                        <span id="tipChecks" class="Validform_checktip"></span>
                                        <input id="isOkType" type="hidden" value="1">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="attributeBox" class="tableForm" style=" margin-top: 5px; ">
                        <tbody>
                           <!--
                            <tr>
                                <td>
                                    <span class="inputTitle"style=" float: left; margin-top: 4px;">类　　型：</span>
                                    <div style=" margin-left:70px;">
                                        <div class="inputBox" >

                                        </div>
                                        <span class="Validform_checktip" ></span>
                                    </div> 
                                </td>
                            </tr>
                            -->
                            <tr> 
                                <td class="gradesClass" >
                                    <span class="inputTitle" style=" float: left; margin-top: 4px;">年　　级：</span>
                                    <div style=" margin-left:70px;">
                                        <div class="inputBox">
                                                <?php $i=0; $j="0"; foreach($grades as $k=>$val):?>
                                                    <input rel="gradesRadio" id="grades_<?php echo $i;?>" class="grades_<?php echo $k;?>" stid="<?php echo $k;?>" value="<?php echo $k;?>" type="radio" name="Class[grade]" <?php if($k==$gradeInfo){ echo 'checked="checked"';} ?>>
                                                    <label rel="gradesRadio"  class="grades_<?php echo $k;?>" for="grades_<?php echo $i;?>"><?php echo $val;?></label>
                                                <?php $i++;endforeach;?>
                                        </div>
                                        <span class="Validform_checktip gradesTip" ></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="tableForm" >
                        <tbody> 
                            <tr>
                                 <td>  
                                    <a id="submitBtn" href="javascript:;" class="btn btn-orange">保　存</a>
                                    <!--<input type="submit" class="btn btn-orange"  value="下一步">-->
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
    //表单验证控件
    Validform.int("#formBoxRegister");
    //  $('#className').keydown(function(){
    //      $('#schoolNameTip').removeClass('Validform_wrong').text('');
    //  });
    
    //班级属性
    $('[rel=noOffBnt]').click(function(){
        var tip = $(this).attr('tip');
        if(tip=='0'){
            $('#attributeBox').show();
            $(this).attr('tip','1').find('span').removeClass('on').addClass('off');
        }else{
            $(this).attr('tip','0').find('span').removeClass('off').addClass('on');
            $('#attributeBox').hide()
        }
    });

    //显示年级
    $('[rel=schooltypeCheck]').click(function(){ 
        var _this = $(this),stid =_this.attr('stid');
        if(_this.attr('checked')=="checked"){ 
            $('[rel=gradesRadio]').hide();
            $('.grades_'+stid).show();
            $('[rel=gradesRadio]:checked').removeAttr('checked'); 
            $('.grades_'+stid).first().attr('checked','checked');
            if($('.grades_'+stid).length==0){
                $('.grades_other').attr('checked','checked');
            }
        }else{
            $('[rel=gradesRadio]:checked').removeAttr('checked'); 
            $('.gradesTip').find('span').empty().removeClass('Validform_right').removeClass('Validform_wrong');
            $('.grades_'+stid).hide();
        }
    }); 

    $('#schoolname-ddi').live('focus',function(){
        $('#schoolNameTip').removeClass('Validform_wrong').text('');
        $("#schoolsign").css('display','inline');
    });
    $('#schoolname-ddi').live('blur',function(){
        $("#schoolsign").css('display','none');
    });
    
    //班级名称规则判断
    $('input[type=text]').keypress(function(){
        $('#tipChecks').hide().addClass('Validform_wrong');
        $('#tipCheck').hide();
    });
    $('input[type=text]').focus(function(){ 
        $('#tipChecks').hide().removeClass('Validform_wrong');
        $('#tipCheck').hide(); 
    });
    $('input[type=text]').focusout(function(){
        var name = $(this).val(); 
        if(getByteLen(name)<=20&&getByteLen(name)>0){ 
            $('#tipChecks').hide().removeClass('Validform_wrong');;
            $('#tipCheck').show();
       }else{
            if(name==""){ 
                $('#tipChecks').hide();
                $('#tipCheck').show(); 
            }else{ 
                $('#tipChecks').text('班级名称不能超过10个汉字（或20个英文字符）').show().addClass('Validform_wrong');
                $('#tipCheck').hide();
            } 
        } 
   });
     
    
     //提交
    $('#submitBtn').click(function(){
        var classname =$.trim($("#className").val());
        var cityname =$("#selectAreas").find('option:checked').val();
        var sname = $.trim($('#schoolname-ddi').val());
        var schoolname = $("#schoolnameInput").val();
        if(getByteLen(classname)<=20){ 
            if(schoolname && cityname == 0){
                $('#areaTip').removeClass('Validform_right').addClass('Validform_wrong').text('填写学校名称后地区为必填！');
            }else{
                $("#formBoxRegister").submit();
                $('#tipCheck').show(); 
            } 
        }else{ 
            if(classname==""){ 
                $("#formBoxRegister").submit();
                $('#tipCheck').show(); 
            }else{ 
                $('#tipCheck').hide();
                $('#tipChecks').text('班级名称不能超过10个汉字（或20个英文字符）!').show().addClass('Validform_wrong'); 
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

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
                <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('class/schoolsetting');?>" method="post">
                    <input type="hidden" id="cid" name="Class[cid]" value="<?php echo $class->cid;?>" />
                    <input type="hidden" id="cid" name="ac" value="<?php echo $ac;?>" />
                    <input type="hidden" id="cid" name="Class[schoolid]" value="<?php echo $class->tSchool->scid;?>" />
                    <input type="hidden" id="oldSchool" name ="oldSchool" value="<?php echo $class->tSchool->name == '未知学校'?'':$class->tSchool->name ;?>" />
                    <table id="attributeBox" class="tableForm" style=" margin-top: 5px; ">
                        <tbody> 
                            <tr>
                                <td>
                                    <span class="inputTitle" style=" float: left; margin-top: 6px;">学校名称：</span>
                                    <div style=" margin-left: 70px; ">
                                        <!--<div id="schoolname" class="inputBox" style=" float: left;"></div>-->
                                        <div class="inputBox">
                                            <input id="schoolnameInput" style="width:410px;" name="Class[schoolname]" maxlength="40" value="<?php echo $class->tSchool->name == '未知学校'?'':$class->tSchool->name;?>" class="lg" type="text"  autocomplete="off" nullmsg="请输入学校名称！" errormsg="只允许中英文数字以及()_-.和空格组成！"></div>
                                        <span id="schoolNameTip" class="Validform_checktip" ></span>
                                        <div class="info" id="schoolsign" style="display: none;">学校名称不能超过20个汉字（或40个英文字符）!<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                    </div>
                                    <div style=" margin-left: 70px; color: #999999; margin-top: 5px; ">
                                        为给您提供精准的服务，<span style="color:red;">请务必填写全称</span>，与学校官网名称一致，例如<br/>“深圳外国语学校东海附属小学”。避免使用“南山实验”这样的简称。
                                    </div>
                                    <input id="isOkType" type="hidden" value="1">
                                </td>   
                            </tr>
                            <tr>
                                <td>
                                    <span class="inputTitle" style=" float: left;margin-top: 6px;">城　　市：</span>
                                    <div style=" margin-left:70px;">
                                        <div class="inputBox">
                                            <select id="selectProvinces" name="Class[pid]" url="<?php echo Yii::app()->createUrl('ajax/getcity');?>" class="sx" next="selectCity" >
                                                <option value="0">请选择</option>
                                                <?php foreach($province_list as $province):?>
                                                <option <?php if ((isset($area['province']) && $province['aid'] == $area['province']) || $currAreaIds['provId'] == $province['aid']) echo 'selected'; ?> value="<?php echo $province['aid'];?>"><?php echo $province['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                           
                                            <select id="selectCity" name="Class[aid]"  <?php if(empty($city_list)):?> style="display: none;" <?php endif;?>  url="<?php echo Yii::app()->createUrl('ajax/getcity');?>" class="sx" next="selectAreas">
                                                <option value="0">请选择</option>
                                                <?php foreach($city_list as $city_item):?>
                                                <option <?php if ( $currAreaIds['cityId'] == $city_item['aid']) echo 'selected'; ?> value="<?php echo $city_item['aid'];?>"><?php echo $city_item['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                           

                                        </div>
                                        <span id="areaTip" class="Validform_checktip"></span>
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

    //选择区域
    function ajaxpsot(url, cid, next, sid){ // sid -> 选中id
        $.getJSON(url+"?id="+cid,function(data){
            if(data&&data.data){   
                var str="<option value='0'>请选择</option>";
                if(data.data.length==0){
                    $("#"+next).html("<option value='0'>请选择</option>").hide();
                }else{
                    $.each(data.data,function(i,v){
                        if ((sid != null && sid == v.aid)){
                            str+='<option selected value="'+ v.aid+'">'+ v.name+'</option>';
                        }else{
                            str+='<option value="'+ v.aid+'">'+ v.name+'</option>';
                        }
                    });
                    $("#"+next).html(str).show();
                    var nnext= $("#"+next).attr("next"); 
                }
            }else{
                alert('添加失败');
            }
        });
    }

    //
    $("#selectProvinces").change(function(){
        var _this = $(this),val =$(this).val(),urls = _this.attr('url'),next = _this.attr('next');
        if(val!=="0"){
            ajaxpsot(urls,val,next, null);
        }else{
            var currid = $(this).attr('id');
            if(currid == 'selectProvinces'){
                $(this).next().html("<option value='0'>请选择</option>");
                $(this).next().next().html("<option value='0'>请选择</option>");
            }else if(currid == 'selectCity'){
                $(this).next().html("<option value='0'>请选择</option>");
            }
        }
    });
    
    var _thiss = $("#selectProvinces"),vals =_thiss.val(),urlss = _thiss.attr('url'),nexts = _thiss.attr('next');
    var _thisss = $("#selectCity"),nextss = _thisss.attr('next');
    
    $("#selectAreas").change(function(){
       var aval = $(this).val()
        if(aval!="0"){
            $('#areaTip').removeClass('Validform_wrong').addClass('Validform_right').text('验证通过！');
        }else{
            $('#areaTip').removeClass('Validform_right').addClass('Validform_wrong').text('填写学校名称后地区为必填！');
        }
    });
    $('#schoolnameInput').focus(function(){
        $('#schoolNameTip').removeClass('Validform_wrong').text('');
        $("#schoolsign").css('display','inline');
    }); 
    $('input[type=text]').focusout(function(){
        var name = $(this).val();
         var rge =/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\s]+$/;
        $("#schoolsign").css('display','none'); 
        if(getByteLen(name)<=40&&getByteLen(name)>0){ 
            if(rge.test(name)){  
                 $('#schoolNameTip').removeClass('Validform_wrong').addClass('Validform_right').text('验证通过'); 
            }else{ 
                $('#schoolNameTip').text('只允许中英文数字以及()_-.和空格组成！').show().addClass('Validform_wrong');
            }  
       }else{
            if(name==""){ 
                $('#schoolNameTip').text('请输入学校名称！').show().addClass('Validform_wrong'); 
            }else{  
                $('#schoolNameTip').text('学校名称不能超过20个汉字（或40个英文字符）').show().addClass('Validform_wrong'); 
            } 
        } 
   });
     
    
     //提交
    $('#submitBtn').click(function(){
        var rge =/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\s]+$/;
        var schoolname =$.trim($("#schoolnameInput").val());
        var cityname =$("#selectCity").find('option:checked').val();
        if(cityname=="0"){
            cityname=$("#selectProvinces").val();
        }

        if((getByteLen(schoolname)<=40)&&(getByteLen(schoolname)>0)&&(cityname!="0")){
            if(rge.test(schoolname)){ 
                $("#formBoxRegister").submit();  
            }else{ 
                $('#schoolNameTip').text('只允许中英文数字以及()_-.和空格组成！').show().addClass('Validform_wrong');
            }
        }else{
            if((getByteLen(schoolname)==0)&&(cityname =="0")){
            	$('#schoolNameTip').text('学校名称不能超过20个汉字（或40个英文字符）!').show().addClass('Validform_wrong');
            	$('#areaTip').removeClass('Validform_right').addClass('Validform_wrong').text('填写学校名称后地区为必填！');
            }else{ 
                if((cityname=="0")&&(getByteLen(schoolname)>0)){
                 $('#areaTip').removeClass('Validform_right').addClass('Validform_wrong').text('填写学校名称后地区为必填！'); 
                 if(rge.test(schoolname)){   
                 }else{ 
                     $('#schoolNameTip').text('只允许中英文数字以及()_-.和空格组成！').show().addClass('Validform_wrong');
                   } 
                } else if((cityname!="0")&&(getByteLen(schoolname)==0)){
                    $('#schoolNameTip').text('学校名称不能为空!').show().addClass('Validform_wrong');
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
   
        
//        if(cityname==""||classname==""){
//            $("#formBoxRegister").submit();
//        }else{
//            if(sname!=""){
//                if(sname.length>0&&sname.length<=20){
//                    $("#schoolnameInput").val(sname);
//                    // alert($("#schoolnameInput").val())
//                     $("#formBoxRegister").submit(); 
//                }else{
//                    $('#schoolNameTip').removeClass('Validform_right').addClass('Validform_wrong').text('学校名称不能大于20个字!');
//                } 
//            }else{ 
//                $('#schoolNameTip').removeClass('Validform_right').addClass('Validform_wrong').text('请输入（选择）学校名称'); 
//            }
//        }
    
});
</script>

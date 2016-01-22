<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/group.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon7"></span>紧急通知 > 编辑分组
        </div>
        <div class="box">
            <nav class="navMod">
                <a href="<?php echo Yii::app()->createUrl('group/index'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="formBox">
                <form id="formBoxRegister" action="" method="post">
                    <table class="tableForm">
                        <tbody> 
                            <tr>
                                <td>
                                    <span class="inputTitle">分组名称：</span>
                                    <div class="inputBox"><input name="Group[name]" value="<?php echo $group->name;?>" placeholder="请输入分组名称" class="lg" type="text" datatype="*1-20" nullmsg="请输入分组名称！" errormsg="分组名称不能大于20个字！ "></div>
                                    <span class="Validform_checktip" ></span>  
                                    <div class="info" style="display: none;">分组名称不能大于20个字！<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="inputTitle">所在学校：</span>
                                    <div class="inputBox">
                                        <select id="class_school" name="Group[sid]" datatype="*" nullmsg="请选择学校！"> 
                                            <?php foreach($schools as $school):?>
                                            <option value="<?php echo $school['sid'];?>" <?php if($school['sid']==$group->sid) {echo "selected='selected'";}?>><?php echo $school['schoolname'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <span class="Validform_checktip schoolTip" ></span>
                                    <span id="schoolTipS" class="Validform_checktip Validform_wrong" style="display: none;">请选择学校！</span>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                    <div class="listTopTite ">成员名单</div>
                    <table class="tableForm">
                        <tbody>
                            <tr>
                                <td>  
                                    <div class="memberBox">
                                        <ul id="memberList">
                                            <?php foreach($members as $member):?>
                                                    <li class="userCheck"><em class="userIco"></em><span><?php echo $member['name']; ?></span><a rel="deleItime" class="deleIco" href="javascript:void(0);"></a><input id="checkbox_<?php echo $member['member']; ?>" class="userCheck_<?php echo $member['member']; ?>" type="hidden" name="Group[uid][]" value="<?php echo $member['member']; ?>"></li>
                                            <?php endforeach;?>
                                            <li class="memberBtn"><a rel="addUserBtn" href="javascript:void(0);" tip="0" ><em class="addBtnIco"></em> 添加成员</a></li>
                                        </ul>
                                    </div>
                                    <div id="cuntUserCheck" class="cuntMember" >已选择了<span class="red"><?php echo count($members);?></span>人
                                        <span id="cuntTip" style="display: none;" class="Validform_checktip Validform_wrong">至少添加一个成员</span></div>
                                    <span class="Validform_checktip" ></span>
                                    <div id="cacheBox" style="display: none;"> 
                                    </div>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                    <table class="tableForm">
                        <tbody> 
                            <tr>
                                <td> 
                                    <input id="submitForm" type="button" class="btn btn-orange"  value="保 存">
                                    <input id="visitVal" type="hidden" value="0">
                                    <a rel="dele" href="javascript:;" data-href="<?php echo Yii::app()->createUrl('group/delete/'.$group->gid); ?>" class="btn btn-default">删 除</a>
                               </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div> 
    </div>
</div> 
<div id="uersBox" class="">
    <div id="addUersBox" class="popupBox" style="width: 640px; height: 495px;">
        <div class="header">添加成员 <a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#addUersBox')" > </a></div>
        <div id="select_member" class="remindInfo"> 
        </div> 
        <div class="popupBtn">
            <a id="saveMemberBtn" href="javascript:void(0);"  class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#addUersBox')" class="btn btn-default">取 消</a>
        </div>
    </div>
</div>
<div id="remindBox" class="popupBox">
    <div class="remindInfo">
        <div id="remindText" class="centent">是否删除当前分组？</div>
    </div>
    <div class="popupBtn">
        <a id="deleLink" href=""  class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#remindBox')" class="btn btn-default">取 消</a>
    </div>
</div>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
   //表单验证控件
    Validform.int("#formBoxRegister");
    
    //类型选择
    $('[rel=btnRadioSex]').click(function(){
        $("#memberList").find('.userCheck').remove();
        var uid =$(this).attr('uid');
        $('[rel=btnRadioSex]').removeClass('btn-raed').addClass('btn-default');
        $(this).addClass('btn-raed');
        $('input[rel=radioSex]').val(uid); 
    });
    //删除操作
    $('[rel=dele]').click(function(){
        var url = $(this).data('href');
        $('#deleLink').attr('href',url);
        showPromptsRemind('#remindBox');
    });
    //指定访问人请求数据
    function jaxaAddVisitMember(tid,sid,ty){  
        var url = "<?php echo Yii::app()->createUrl('group/getmember');?>";
        $.ajax({  
            url:url,   
            type : 'POST',
            data : {tid:tid,ty:ty,sid:sid},
            dataType : 'text',  
            contentType : 'application/x-www-form-urlencoded',  
            async : false,  
            success : function(mydata) {   
                var show_data =mydata;
                $("#cacheVisitBox").empty();
                $("#popMember").empty();
                $("#popMember").append(show_data); 
            },  
            error : function() {  
                    // alert("calc failed");  
            }  
        });
    } 
     //请求数据
    function jaxaAddMember(tid,sid,ty){  
        var url = "<?php echo Yii::app()->createUrl('group/getmember');?>";
        $.ajax({  
            url:url,   
            type : 'POST',
            data : {tid:tid,ty:ty,sid:sid},
            dataType : 'text',  
            contentType : 'application/x-www-form-urlencoded',  
            async : false,  
            success : function(mydata) {   
                var show_data =mydata;
                $("#cacheBox").empty();
                $("#popMember").empty();
                $("#popMember").append(show_data); 
            },  
            error : function() {  
                    // alert("calc failed");  
            }  
        });
    }
     
    //指定访问人请求数据
    function jaxaAddVisitUers(sid,ty){ 
        var url = "<?php echo Yii::app()->createUrl('group/member');?>";
        $.ajax({  
            url:url,   
            type : 'POST',
            data : {sid:sid,ty:ty},
            dataType : 'text',  
            contentType : 'application/x-www-form-urlencoded',  
            async : false,  
            success : function(mydata) {   
                var show_data =mydata;
                $("#select_member").empty();
                $("#select_member").append(show_data);
                showPromptPush('#addUersBox');
            },  
            error : function() {  
                    // alert("calc failed");  
            }  
        });
    }
     //请求数据
    function jaxaAddUers(sid,ty){ 
        var url = "<?php echo Yii::app()->createUrl('group/member');?>";
        $.ajax({  
            url:url,   
            type : 'POST',
            data : {sid:sid,ty:ty},
            dataType : 'text',  
            contentType : 'application/x-www-form-urlencoded',  
            async : false,  
            success : function(mydata) {   
                var show_data =mydata;
                $("#select_member").empty();
                $("#select_member").append(show_data);
                showPromptPush('#addUersBox');
            },  
            error : function() {  
                    // alert("calc failed");  
            }  
        });
    }
    //改变学校
    $("#class_school").change(function(){
        $("#memberList").find('.userCheck').remove();
        $('#schoolTipS').hide();
        $('.schoolTip').show();
    });
    
    //弹出选择面板
    $("[rel=addUserBtn]").live('click',function(){ 
        var sid = $("#class_school").find('option:selected').val();
        var ty = $('input[rel=radioSex]').val();
        if(sid==""){
             $('#schoolTipS').show();
             $('.schoolTip').hide();
         }else{
           jaxaAddUers(sid,ty);
           //var userCheck = $("#memberList").html();
           //$('#cacheBox').append(userCheck); 
       //$('#cacheBox').find('.memberBtn').remove();
           $('#cuntTip').hide(); 
         }
         $("#visitVal").val('0');
    });
    
    //指定访问人弹出选择面板
    $("[rel=addVisitUserBtn]").live('click',function(){ 
         var sid = $("#class_school").find('option:selected').val();
         var ty = '1';
         if(sid==""){
             $('#schoolTipS').show();
             $('.schoolTip').hide();
         }else{
           jaxaAddVisitUers(sid,ty);
           //var userCheck = $("#memberVisitList").html();
          // $('#cacheVisitBox').append(userCheck); 
          // $('#cacheVisitBox').find('.memberBtn').remove();
           $('#cuntVisitTip').hide(); 
         }
         $("#visitVal").val('1');
    });
    
    //选择班级
    $('#teacher_class').live('change',function(){
        var ty = $('input[rel=radioSex]').val();
        var tid = $("#teacher_class").find('option:selected').val();
        var sid = $("#class_school").find('option:selected').val();
        if ($(this).val() != '') {
             if($("#visitVal").val()=="1"){
                jaxaAddVisitMember(tid,sid,1);
            }else{
                jaxaAddMember(tid,sid,ty);
            }
        }else{
            $('#popMember').html('');
        };
       
        //alert($("#visitVal").val()); 
    }); 
    
    //添加成员
    $('[rel=chekedItime]').live('click',function(){
        var usid = $(this).data('usid');
        var type = $(this).attr('uit');
        var name =$(this).data('name');  
        //$(".userCheck_"+usid).parent('li').remove();
        if($("#visitVal").val()=="1"){//指定访问人
            $(".userChecks_"+usid).parent('li').remove();
            if(parseInt(type)==0){
                var itme ='<li class="userCheck"><em class="userIco"></em><span>'+name+'</span><a rel="deleItime" class="deleIco" href="javascript:void(0);"></a><input id="checkboxs_'+usid+'" class="userChecks_'+usid+'" type="hidden" style="display: none;" name="Group[accessids][]" value="'+usid+'"></li>';
                $(this).parent('li').addClass('checked');
                $("#cacheVisitBox").append(itme);
                $(this).attr('uit',1);
            }else{
                $(this).attr('uit',0);
                $(this).parent('li').removeClass('checked');
                $("#checkboxs_"+usid).parent('li').remove();
            } 
        }else{
            $(".userCheck_"+usid).parent('li').remove();
            if(parseInt(type)==0){
                var itme ='<li class="userCheck"><em class="userIco"></em><span>'+name+'</span><a rel="deleItime" class="deleIco" href="javascript:void(0);"></a><input id="checkbox_'+usid+'" class="userCheck_'+usid+'" type="hidden"  name="Group[uid][]" value="'+usid+'"></li>';
                $(this).parent('li').addClass('checked');
                $("#cacheBox").append(itme);
                $(this).attr('uit',1);
            }else{
                $(this).attr('uit',0);
                $(this).parent('li').removeClass('checked');
                $("#checkbox_"+usid).parent('li').remove();
            } 
        }
    }); 
    
    //保存选中
    $('#saveMemberBtn').live('click',function(){
        if($("#visitVal").val()=="1"){ //指定访问人保存选中
            var box = $("#cacheVisitBox").html();
            $("#memberVisitList .memberBtn").before(box);
            var cunt =$("#memberVisitList").find('li').length - 1;
            hidePormptMaskWeb('#addUersBox');
            $('#cuntUserVisitCheck').find('span.red').html(cunt);
            $("#cacheVisitBox").empty();
        }else{
            var box = $("#cacheBox").html();
            $("#memberList .memberBtn").before(box);
            var cunt =$("#memberList").find('li').length - 1;
            hidePormptMaskWeb('#addUersBox');
            $('#cuntUserCheck').find('span.red').html(cunt);
            $("#cacheBox").empty();
        }
    }); 
    
    //删除成员
    $('#memberList [rel=deleItime]').live('click',function(){
        $(this).parent('li').remove(); 
        var cunt =$("#memberList").find('li').length - 1;
        $('#cuntUserCheck').find('span.red').html(cunt);  
    });
    
    $('#memberVisitList [rel=deleItime]').live('click',function(){
        $(this).parent('li').remove(); 
        var cunt =$("#memberVisitList").find('li').length - 1;
        $('#cuntUserVisitCheck').find('span.red').html(cunt); 
    });
    
    
    $('#submitForm').click(function(){
        var cunt =$("#memberList").find('li').length;
        if(cunt>1){
            $('#formBoxRegister').submit();
        }else{
            $('#cuntTip').show();
        } 
    });
});
    
</script>
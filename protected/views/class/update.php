<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox"> 
<!--    <div id="submenuBoxR" class="submenuBoxR" viwe="show">
        <div style="text-align: center;">
            <img width="105px" style="display: inline;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/erxiaoxin.png" />
        </div>
    </div>-->
    <div id="contentBox" class="cententBox">
<!--        <div class="playerBox" style="position: relative;"> 
            <a id="player" class="playerOn" href="javascript:;" onclick="onClickHide('#submenuBoxR')"><em></em></a> 
        </div>-->
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > <?php echo $class->name; ?>
        </div>
        <div class="box">
            <!--
            <div class="titleBox">
                <ul class="titleTable">
                    <li><a href="<?php echo Yii::app()->createUrl('class/update/'.$class->cid);?>" class="focus" >基本信息</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('class/teachers/'.$class->cid);?>" >老师</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('class/students/'.$class->cid);?>" >学生</a></li>
                </ul>
            </div>
            -->
            <div class="formBox" style="min-height: 550px;">
                <form id="formBoxRegister" action="" method="post">
                    <table class="tableForm">
                        <tbody> 
                            <tr>
                                <td>
                                    <span class="inputTitle">班级名称：</span>
                                    <div class="inputBox"><input id="className" maxlength="20" name="Class[name]" url="<?php echo Yii::app()->createUrl('xiaoxin/class/Isexist');?>" placeholder="请输入班级名称" value="<?php echo $class->name; ?>" class="lg" type="text" datatype="*1-20" nullmsg="请输入班级名称！" errormsg="班级名称不能大于20个字!"></div>
                                    <input id="schoolId" type="hidden" name="Class[schoolid]" value="<?php echo $class->sid; ?>">
                                    <input id="schoolCid" type="hidden" name="cid" value="<?php echo $class->cid;?>">
                                    <span id="tipCheck" class="Validform_checktip" ></span>
                                    <div class="info" style="display: none;">班级名称不能大于20个字!<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                    <input id="isOkType" type="hidden" value="0">
                                </td>
                            </tr> 
                            <tr>
                                <td>
                                    <span class="inputTitle">班级介绍：</span>
                                    <div class="inputBox"><textarea name="Class[info]" placeholder="介绍一下您的班级吧" datatype="*1-100" nullmsg="" errormsg="班级介绍不能大于100个字！" style="width: 400px; height: 100px" class=" " type="text" datatype="*" nullmsg="请输入班级介绍！" errormsg="班级介绍不能为空！"><?php echo $class->info; ?></textarea></div>
                                    <span class="Validform_checktip" ></span>  
                                </td>
                            </tr>
                            <tr>
                             <td> 
                                <span class="inputTitle"></span>
                                <a href="javascript:;" id="submitBtn" class="btn btn-orange">确 定</a>
                                <!--<input type="submit" class="btn btn-raed"  value="确 定">--> 
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                <div class="updateBox bTop" >
                    <div class="title" style="font-size: 16px;">更改班主任</div>
                    <div class="remind">
                        <span> 该操作会撤销您的班主任身份，请谨慎操作。</span>
                    </div>
                    <div style="position: relative; width: auto; display: inline-table;">
                        <a href="javascript:void(0);" id="changeBtn" class="btn btn-orange" >更改班主任</a> 
                        <div id="techerList" style="display:none; position:absolute; left: 120px; top: 0px; float: left; overflow-x: hidden; overflow-y: auto; height:200px; " class="courseBox">
                            <ul>
                            <?php foreach($teachers as $teacher): ?> 
                                <li><a rel="changeTeachers" href="javascript:void(0);"  data-href="<?php echo Yii::app()->createUrl('/xiaoxin/class/master/'.$class->cid);?>?uid=<?php echo $teacher['userid']; ?>"><?php echo $teacher['name']; ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <div class="updateBox bTop bBottom" style="display: none;">
                    <div class="title">解散班级</div>
                    <div class="remind">
                        <span> 该操作不可撤销，解散班级后，班级成员将不能访问班级的一切数据，请谨慎操作。</span>
                    </div>
                    <a rel="departClass" href="javascript:void(0);" data-href="<?php echo Yii::app()->createUrl('/xiaoxin/class/depart/'.$class->cid);?>" class="btn btn-raed">解散班级</a>
                </div>
            </div> 
        </div> 
    </div>
</div> 
<div id="remindBox" class="popupBox"> 
    <div class="remindInfo"> 
        <div id="remindText" class="centent"> </div>
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
    //Validform.int("#formBoxRegister");
    clickTarget('#changeBtn','#techerList');
    //显示老师列表
    $('#changeBtn').click(function(){
        $('#techerList').show();
    });
    //转让班主任
    $('[rel=changeTeachers]').click(function(){
        var text="是否转让当前班班主任?该操作会撤销您的班主任身份.";
        var url = $(this).data('href');
        $("#remindText").empty();
        $("#remindText").append(text);
        $('#deleLink').attr('href',url);
        showPromptsRemind('#remindBox');  
    });
    $('[rel=departClass]').click(function(){
        var text="是否解散班当前班级? 解散班级后，班级成员将不能访问班级的一切数据.";
        var url = $(this).data('href');
        $("#remindText").empty();
        $("#remindText").append(text);
        $('#deleLink').attr('href',url);
        showPromptsRemind('#remindBox');  
    });
});
    $('#className').keydown(function(){
        $('#tipCheck').removeClass('Validform_wrong').text(''); 
    });
    //判断班级名称是否可用
    $('#className').keyup(function(){
        var cname = $.trim($(this).val());
        var url = $(this).attr("url"); 
        var cid = $('#schoolCid').val();
        var sid = $('#schoolId').val();
        if(cname){
            $.ajax({
                url:url,   
                type : 'POST',
                data : {sid:sid,cid:cid,cname:cname},
                dataType : 'json',  
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {   
                    var show_data =mydata;
                    if(show_data.status=='1'){
                        $('#isOkType').val('0');
                        $('#tipCheck').removeClass('Validform_wrong').addClass('Validform_right').text('通过验证'); 
                    }else{
                       $('#isOkType').val('1');
                        $('#tipCheck').removeClass('Validform_right').addClass('Validform_wrong').text('输入班级名称已存在，请从新输入'); 
                    } 
                },  
                error : function() {  
                    // alert("calc failed");  
                }  
            });
        }
    });
    //提交
    $('#submitBtn').click(function(){
        var cname = $.trim($('#className').val());
        var types = $('#isOkType').val();
        if(cname){
            if(types=='0'){
                $("#formBoxRegister").submit();
            }else{
                $('#tipCheck').removeClass('Validform_right').addClass('Validform_wrong').text('输入班级名称已存在，请从新输入'); 
            }
        }else{
           $('#tipCheck').removeClass('Validform_right').addClass('Validform_wrong').text('请输入班级名称'); 
        }
    });
</script>

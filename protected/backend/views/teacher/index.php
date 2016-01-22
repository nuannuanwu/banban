<style>
    #message,.message{ font-size: 18px; width: 265px; margin: 0px auto; position:absolute ; right: 20px; bottom:0px; display: none; z-index: 10000; border-radius: 5px;}
    #message .messageType,.message .messageType{ padding:8px 15px; line-height: 30px; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;}
    #message .success,.message .success{  border: 1px solid #fbeed5; background-color: #e95b5f; color: #fbe4e5; }
    #message .error,.message .error{border: 1px solid #eed3d7; background-color: #eeeeee; color: red; }
    .table td select{ width: 81px; }

</style>
<div class="box">
    <div class="tableBox">
        <?php include('_search.php'); ?>
        <table class="table table-bordered table-hover" width="100%" border="0" cellpadding="0" cellspacing="0">
            <thead>
            <tr style="background-color: #e8e8e8;">
                <th width="80px"><input type="checkbox" id="checkAll">&nbsp;&nbsp;全选</th>
                <th width="15%">姓名</th>
                <th width="15%">绑定手机</th>
                <th width="20%">学校（部门 &nbsp;&nbsp;职务）</th>
                <th width="15%">创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if (count($teachers['model'])): ?>
                <?php foreach ($teachers['model'] as $teacher):?>
                    <tr>
                        <td class="checkSub"><input value="<?php echo $teacher['userid'];?>" type="checkbox"></td>
                        <td><?php echo $teacher['username'];?></td>
                        <td>
                            <?php 
                                $memberinfo = Member::model()->findByPk($teacher['userid']);
//                                if($memberinfo->isnewuser==1){
//                                    $remoteurl = OLD_PLATFORM_DOMAIN."/xiaoxin/default/remote?identity=1&plant=backend&userid=".$teacher['userid'];
//                                }else{
//                                    $remoteurl = "/site/remote?identity=1&plant=backend&userid=".$teacher['userid'];
//                                }
                                $remoteurl = "/site/remote?identity=1&plant=backend&userid=".$teacher['userid'];
                            ?>
                            <a href="<?php echo $remoteurl; ?>" target="_blank" style=" padding-left: 25px;" class="<?php echo $teacher['client']?'client':''?>"><span class=""></span><?php echo $teacher['mobilephone'];?></a>
                        </td>
                        <td>
                            <div class="partSelectP">
                                <?php $deptname = $teacher['deptname']?$teacher['deptname']:'无部门'; ?>
                                <?php $dutyname = empty($teacher['duty'])?'无职务':$teacher['duty']; ?>
                                <?php echo $teacher['schoolname'];?><?php echo '（'.$deptname.' &nbsp;&nbsp;'.$dutyname.'）'; ?>
                                <?php if($teacher['schoolnum']>1):?>
                                    <span class='partSelectIcon'></span>
                                    <div class="partSelect">
                                        <div class="partSelectSub">
                                            <span class="navIcoTop"></span>
                                        </div>
                                        <div class="box">
                                            <?php foreach($teacher['schoolarr'] as $dd):?>
                                                <?php  echo $dd['deptname']."（".$dd['schoolname']." &nbsp;&nbsp;".$dd['duty']."）</br>";?>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>
                        </td>
                        <td><?php echo substr($teacher['creationtime'],0,16);?></td>
                        <td>
                            <a href="<?php echo Yii::app()->createUrl('teacher/update/'.$teacher['userid']); ?>">编辑</a>
                            &nbsp;&nbsp;
                            <!-- <a rel="setPwd" href="javascript:void(0);" data-href="<?php echo Yii::app()->createUrl('range/initmemberpwd').'?ids='.$teacher['userid']; ?>">重置密码</a>
                            &nbsp;&nbsp; -->
                            <a rel="deleLink" href="javascript:void(0);" data-href="<?php echo Yii::app()->createUrl('teacher/delete').'?ids='.$teacher['userid']; ?>">删除</a>
                            &nbsp;&nbsp;<input  class="noticeright" uid="<?php echo $teacher['userid'];?>" type="checkbox" value="<?php echo  $teacher['issmsauth'];?>" <?php echo $teacher['issmsauth']==1?"checked='checked'":""?>/><span style="margin-left:3px;color: #428bca;">紧急通知</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" align="center" style=" font-size: 21px; padding: 100px 0;">
                        暂无数据
                    </td>
                </tr>
            <?php endif; ?>
          
            </tbody>
        </table>
        <div class="batchOperation clearfix" style="float:left;">
             <a href="javascript:;" class="btn btn-primary" style="margin-right:10px;" rel="checkDel">批量删除</a>
             <a href="javascript:;" class="btn btn-primary" rel="batchPass">批量重置密码</a>
             <span class="Validform_checktip " id="batchTip" style="display:none;"><span class="Validform_checktip Validform_wrong" >请勾选列表！</span> </span>
        </div>
        <div id="pager" style="  margin-top: 30px;">
            <?php
            $this->widget('CLinkPager',array(
                    'header'=>'',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '末页',
                    'prevPageLabel' => '上一页',
                    'nextPageLabel' => '下一页',
                    'pages' => $teachers['pages'],
                    'maxButtonCount'=>9
                )
            );
            ?>
        </div>
    </div>
</div>
<div id="popupBox" class="popupBox" style="min-height: 170px;">
    <div id="popupInfo" style="padding: 30px;">
        <div class="centent">温馨提示：当前老师将从所有关联学校中删除，是否删除当前老师？</div>
    </div>
    <div style="text-align: center;">
        <a id="isOk" href="" class="btn btn-primary">确定</a> &nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#popupBox');" class="btn btn-default">取消</a>
    </div>
</div>

<div id="popupBoxRset" class="popupBox">
    <div id="popupInfo" style="padding: 30px;">
        <div class="centent">温馨提示：是否重置密码？</div>
    </div>
    <div style="text-align: center;">
        <a id="isSetPwd" href="javascript:void(0);" tip="0" url="" class="btn btn-primary">确定</a> &nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#popupBoxRset');" class="btn btn-default">取消</a>
    </div>
</div>


<div id="checkAllBox" class="popupBox" style="min-height: 170px;">
    <div id="popupInfo" style="padding: 30px;">
        <div class="centent">温馨提示：所选老师将从所有关联学校中删除，是否删除所选老师？</div>
    </div>
    <div style="text-align: center;">
        <a id="delOk" href="javascript:;" class="btn btn-primary">确定</a> &nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#checkAllBox');" class="btn btn-default">取消</a>
    </div>
</div>

<div id="batchBox" class="popupBox">
    <div id="popupInfo" style="padding: 30px;">
        <div class="centent">温馨提示：是否批量重置密码？</div>
    </div>
    <div style="text-align: center;">
        <a id="batchOk" href="javascript:;" tip="0" class="btn btn-primary">确定</a> &nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#batchBox');" class="btn btn-default">取消</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/popupVeiw.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/stcombobox/stcombobox.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/stcombobox/index.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/business/stcombobox/stcombobox.css"/> 
<script type="text/javascript">
    $(document).ready(function() {  
        // 学校名称json列表数据
        var schoolData = <?php echo UserAccess::getUserSchoolsJson( Yii::app()->user->id );?>;
         var url = "<?php echo Yii::app()->createUrl('range/getschoolgrade');?>";  
        var obj ={
            types : true,
            selectid : 'selecttid', 
            url : url, 
            grade : 0,
            teacher:0,
            department:1,
            class:0 
        };
        StcBox.int(schoolData,obj );
        var sname = $('#statesComboInput').attr('sname'); 
        if(sname){
            $('.stc-input').val(sname); 
        } 
    });
</script>
<script type="text/javascript">

    $(function () {
        $(".noticeright").on("click",function(){
            var userid=$(this).attr("uid"),
                value=parseInt($(this).val(),10),
                url="<?php echo Yii::app()->createUrl('teacher/noticeright');?>";
            window.location.href=url+"?userid="+userid+"&value="+value;
        })
        //删除提醒
        $('[rel=deleLink] ').click(function () {
            var urls = $(this).data('href');
            $("#isOk").attr('href', urls);
            showPromptsIfonWeb('#popupBox');
        });
        
         //重置密码
        $('[rel=setPwd] ').click(function () {
            var urls = $(this).data('href');
            $("#isSetPwd").attr('url', urls);
            showPromptsIfonWeb('#popupBoxRset');
        });

        //批量删除
        $('[rel=checkDel] ').click(function () {
            var str=[],
            inputCheckedNum=$('.checkSub').find('input:checked').length;
            if (inputCheckedNum != 0) {
                 $('.checkSub').find('input').each(function(index, el) {
                    var val=$(el).val();
                    if ($(el).is(':checked')) {
                        str.push(val);
                    };
                });
                str=str.join(',');
                var urls ="<?php echo Yii::app()->createUrl('teacher/delete')?>?ids="+str;
                $("#delOk").attr('href', urls);
                showPromptsIfonWeb('#checkAllBox');
            }else{
               $('#batchTip').show();
            };
           
        });

        //批量重置密码
        $('[rel=batchPass]').click(function(event) {
            var str=[],
            inputCheckedNum=$('.checkSub').find('input:checked').length;
            if (inputCheckedNum != 0) {
                 $('.checkSub').find('input').each(function(index, el) {
                    var val=$(el).val();
                    if ($(el).is(':checked')) {
                        str.push(val);
                    };
                });
                str=str.join(',');
                var urls ="<?php echo Yii::app()->createUrl('range/initmemberpwd')?>?ids="+str;
                $("#batchOk").attr('data-href', urls);
                showPromptsIfonWeb('#batchBox');
            }else{
                 $('#batchTip').show();
            };
        });
        
        $("#batchOk").click(function(event) {
            $("#message,.message").remove();
            var urls = $(this).data('href');
            var tip = $(this).attr('tip');
            if(tip=='0'){ 
                $(this).attr('tip','1');
                $.getJSON(urls,{},function(data){
                   if(data&&data.msg=='success'){
                       var tishi = '<div class="message"><div class="messageType success" id="type-success"><span >✔</span>&nbsp;&nbsp;密码已重置成功</div></div>';
                       $('body').append(tishi);
                       // $('#checkAll').removeAttr('checked');
                       // $('.checkSub').find('input').removeAttr('checked')
                   }else{
                       var tishi = '<div class="message"><div class="messageType success" id="type-success"><span >✔</span>&nbsp;&nbsp;密码重置失败</div></div>';
                       $('body').append(tishi);
                   }
                   $('.message').show();
                   setTimeout( function() { $('.message').slideUp("slow");},3000); 
                   hidePormptMaskWeb('#batchBox');
                   $(this).attr('tip','0');
               });
            }
        });
         //全选和不选
        $('#checkAll').click(function(event) {
            var _left=$(this);
            if (_left.is(':checked')) {
                $('.checkSub').find('input').attr('checked','checked');
                $('#batchTip').hide();
            }else{
                $('.checkSub').find('input').removeAttr('checked')
            };
        });

        $('.checkSub').on('click', 'input', function(event) {
             var inputNum=$('.checkSub').find('input').length,
                 inputCheckedNum=$('.checkSub').find('input:checked').length;
            if (inputCheckedNum == inputNum) {
                $('#checkAll').attr('checked','checked');
            }else{
                $('#checkAll').removeAttr('checked');
            };
            if(inputCheckedNum !=0){
                 $('#batchTip').hide();
            }

        });


        $('.partSelectIcon').hover(function () {
            $(this).parent('.partSelectP').addClass('partSelectPHigh');
            $(this).next().show();

        }, function () {
            $(this).parent('.partSelectP').removeClass('partSelectPHigh');
            $(this).next().hide();

        });

        //年级联动
        $("#selectsid").change(function () {
            var datas = $(this).val();
            var url = $(this).attr('url');
            var option = '<option value="">全部</option>';
            if (datas) {
                $.getJSON(url, {sid: datas, department: 1}, function (mydata) {
                    if (mydata && mydata.departments) {
                        $.each(mydata.departments, function (i, v) {
                            option = option + '<option value="' + i + '">' + v + '</option>';
                        });
                    }
                    $("#selecttid").html(option);
                });
            } else {
                $("#selecttid").html(option);
            }
        });
        $('#isSetPwd').click(function(){ 
            $("#message,.message").remove();
            var url = $(this).attr('url');
             var tip = $(this).attr('tip');
            if(tip=='0'){ 
                $(this).attr('tip','1');
                $.ajax({
                url:url,
                type : 'Get',
                data : {cid:""},
                dataType : 'json',
                contentType : 'application/x-www-form-urlencoded',
                async : false,
                success : function(mydata) {
                    hidePormptMaskWeb('#popupBoxRset');
                    if(mydata&&mydata.msg=='success'){
                        var tishi = '<div id="message"><div class="messageType success" id="type-success"><span >✔</span>&nbsp;&nbsp;密码已重置为'+mydata.password+'</div></div>';
                        $('body').append(tishi); 
                    }else{ 
                        var tishi = '<div id="message"><div class="messageType success" id="type-success"><span >✘</span>&nbsp;&nbsp;密码重置失败</div></div>';
                        $('body').append(tishi);
                    }
                        $('#message').show();
                        setTimeout( function() { $('#message').slideUp("slow");},3000); 
                        $(this).attr('tip','0');
                    }
                });
            }
        });

       
    });
</script>



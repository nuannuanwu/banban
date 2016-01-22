<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<style>
    body{
        min-width:1024px;
    }
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > <?php echo $class->name; ?> > 添加学生
        </div>
        <div class="box"> 
            <div class="listTopTite bBottom">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class_step_2.png">
            </div> 
            <div class="formBox">
                <div class="classTableBox invtesBox"> 
                    <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('/class/scimport/'.$class->cid);?>?ty=import" method="post">
                        <table class="tableForm" id="tableFormAdd">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="classInfoTitle" >
                                        〓 检查导入信息
                                        </div>
                                        <div class="danwonInfo">根据您提供的文件，本次操作可以成功添加 <span><?php echo $total; ?></span> 名学生</div>
                                        <div class="stList" >
                                            <table class="table table-bordered" style=" width: 686px;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%;"><div style="width:40px;">序号</div></th>
                                                        <th style="width: 15%;"><div style="width:90px;">学生姓名</div></th>
                                                        <th style="width: 9%;">学号</th>
                                                        <th style="width: 9%;">家长手机号</th>
                                                        <th style="width: 9%;">家属1手机号</th>
                                                        <th style="width: 9%;">家属2手机号</th>
                                                        <th style="width: 9%;">家属3手机号</th>
                                                        <th style="width: 9%;">家属4手机号</th>

                                                        <th>状态</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($data as $d): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $d['seque'] ?>
                                                        </td>
                                                        <td>
                                                             <div style="width:64px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                                                <?php echo $d['name']; ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="width:96px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo isset($d['studentid'])?$d['studentid']:''; ?></div>
                                                        </td>
                                                        <td>
                                                            <div style="width:96px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo isset($d['mobile'])?$d['mobile']:''; ?></div>
                                                        </td>
                                                      <td>
                                                            <div style="width:96px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo isset($d['mobile2'])?$d['mobile2']:''; ?></div>
                                                        </td>
                                                        <td>
                                                           <div style="width:96px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo isset($d['mobile3'])?$d['mobile3']:''; ?></div>
                                                        </td>
                                                        <td>
                                                            <div style="width:96px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo isset($d['mobile4'])?$d['mobile4']:''; ?></div>
                                                        </td>
                                                        <td>
                                                            <div style="width:96px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo isset($d['mobile5'])?$d['mobile5']:''; ?></div>
                                                        </td>

                                                        <td>
                                                            <?php echo $d['error'] ? ("<a href='#' title='".$d['msg']."'><span class='icoBox errorIco'></span></a>") : '<span class="icoBox succesIco">　</span>'; ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td> 
                                </tr> 
<!--                                <tr>
                                    <td>
                                        <div class="classInfoTitle" >
                                        〓 说点什么
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inputBox">
                                            <textarea style="width: 486px; height: 98px;" name="desc" maxlength="110" value="欢迎加入<?php echo $class->name; ?>" placeholder="对学生说点什么吧"  datatype="*1-100" nullmsg="信息不能为空！" errormsg="信息不能大于100个字！">欢迎加入<?php echo $class->name; ?></textarea> 
                                        </div>
                                         <span class="Validform_checktip" ></span> 
                                    </td>
                                </tr>-->
                                <tr>
                                    <td>
                                        <p>&nbsp;</p>
                                        <a href="<?php echo Yii::app()->createUrl('class/scupload?cid='.$class->cid);?>" class="btn btn-default">返回</a>
                                        &nbsp;&nbsp;&nbsp;
                                        <?php if($total>0):?>
                                        <a href="javascript:;" url="<?php echo Yii::app()->createUrl('class/scimport/'.$class->cid);?>?ty=import" tip="0" id="postBnt" class="btn btn-orange">下一步</a>
                                        <?php else:?>
                                           <!-- <a href="javascript:void(0)"  tip="0"  class="btn btn-default">下一步</a>-->
                                        <?php endif;?>
                                        <span class="loadingTip" style="display:none; color: #999; margin-left: 15px; " id="addSuccess"><img style="display: inline;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/onLoad.gif">&nbsp;正在导入数据，请稍后...</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </form> 
                </div>
            </div>
        </div> 
    </div>
</div> 
<div id="inviteBox" class="popupBox" style=" width: 600px;">
    <div class="header"><span id="popup_title">发送邀请</span> <a href="javascript:void(0);" class="close" id="closeId" > </a></div>
    <div class="remindInfo">
        <p style=" color: #999; margin-bottom: 5px;">立即为新成员发送短信邀请</p>
        <div id="remindText" class="centent" style="text-indent: 0em;padding: 5px; border: 1px solid #f1f1f1; height: 200px;">
            <?php
            $str = sprintf(Constant::getFrontFamilySendPwdSms(),$class->s->name,$userinfo->name,'***********','******');
			$str=str_replace("未知学校的",'',$str);
            echo $str;
            ?>
        </div>
    </div>
    <p id="rTips" style=" display: none; text-align: center; margin-bottom: 10px;"><span class="Validform_checktip Validform_loading">正在处理...</span></p>
    <div class="popupBtn">
        <a id="delayPostBtn" href=""  class="btn btn-orange">稍后发送</a>&nbsp;&nbsp;&nbsp;
        <a id="isPostBnts" tip="0" href="javascript:void(0);" url="<?php echo Yii::app()->createUrl('class/sendpwd/');?>" cid ="<?php echo $class->cid;?>"  class="btn btn-orange">发送邀请</a>&nbsp;&nbsp;&nbsp;
        <!--<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#inviteBox')" class="btn btn-default">取 消</a>--> 
    </div>
</div>

<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    
    //邀请操作
    $('#isPostBnts').click(function(){
        var tip =$(this).attr('tip');
        var url = $(this).attr('url');
        var cid = $(this).attr('cid');
        if(tip=='0'){
            $(this).attr('tip','1');
            $(this).removeClass('btn-orange').addClass('btn-default');
            $('#rTips').show();
            $.ajax({  
                url:url,   
                type : 'POST', 
                data:{cid:cid},
                dataType : 'json',              
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {
                    var data =mydata;  
                     if(data.status=="1"){
                        var urlstr = data.url;
                        window.location.href = urlstr;
                    }
                },  
                error : function() { 
                    //str = "系统繁忙,请稍后再试";
                }  
            }); 
        }
    });
    
    //完成添加操作
    $('#postBnt').click(function(){
        var url =$(this).attr('url'); 
        var tip =$(this).attr('tip');
        $(".loadingTip").show();
        if(tip=='0'){ 
            $(this).attr('tip','1').removeClass('btn-orange').addClass('btn-default');
            $.ajax({  
                url:url,   
                type : 'POST', 
                dataType : 'json',              
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {
                    var data =mydata; 
                    var urlstr = data.url; 
                    if(data.status=="1"){ 
                            $("#delayPostBtn").attr('href',urlstr);
                            $("#closeId").attr('href',urlstr);
                            $("#addSuccess").text('已成功导入!');
                            window.location.href = mydata.url;
                        //  showPromptPush('#inviteBox');
                            //if(data&&data.first=='1'){
                             //    $("#popup_title").text("创建班级成功");
                           // }
                            //$(".loadingTip").hide(); 
                        }else{
                            window.location.href = mydata.url;                        
                        }
                },  
                error : function() { 
                        //str = "系统繁忙,请稍后再试";
                }  
            }); 
        } 
    });
    
    
});
</script>

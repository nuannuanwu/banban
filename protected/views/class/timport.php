<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
             <span class="icon icon1"></span>我的班班 > <?php echo $class->name; ?> > 添加老师
        </div>
        <div class="box">
            <div class="formBox">
                <div class="classTableBox invtesBox"> 
                    <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('/class/timport/'.$class->cid);?>?ty=import" method="post">
                        <table class="tableForm" id="tableFormAdd">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="classInfoTitle" >
                                        〓 检查导入信息
                                        </div>
                                        <div class="danwonInfo">根据您提供的文件，本次操作可以成功添加 <span><?php echo $total; ?></span> 名老师</div>
                                        <div class="stList">
                                            <table class="table table-bordered" >
                                                <thead>
                                                    <tr>
                                                        <th>序号</th>
                                                        <th>姓名</th>
                                                        <th>手机号</th>
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
                                                            <?php echo $d['name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $d['mobile']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $d['error'] ? '<a href="#" title="'.($d['msg']?$d['msg']:'手机名字不正确').'"><span class="icoBox errorIco">'.'</span></a>' : '<span class="icoBox succesIco"> </span>'; ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td> 
                                </tr> 
                                <tr style="display: none;">
                                    <td>
                                        <div class="classInfoTitle" >
                                        〓 说点什么
                                        </div>
                                    </td>
                                </tr>
                                <tr style="display: none;">
                                    <td>
                                        <div class="inputBox">
                                            <textarea style="width: 486px; height: 98px;" name="desc" maxlength="110" value="欢迎加入<?php echo $class->name; ?>" placeholder="对学生说点什么吧"  datatype="*1-100" nullmsg="信息不能为空！" errormsg="信息不能大于100个字！">欢迎加入<?php echo $class->name; ?></textarea> 
                                        </div>
                                         <span class="Validform_checktip" ></span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>&nbsp;</p>
                                        <!-- <input class="btn btn-raed" type="submit" value="保  存"> -->
                                        <a href="<?php echo Yii::app()->createUrl('/class/tupload?cid='.$class->cid);?>" class="btn btn-default">返回</a>
                                        &nbsp;&nbsp;&nbsp;
                                        <?php if($total>0):?>
                                        <a href="javascript:;" url="<?php echo Yii::app()->createUrl('/class/timport/'.$class->cid);?>?ty=import" tip="0" id="postBnt" class="btn btn-raed btn-orange">下一步</a>
                                        <?php else:?>
                                        <!--<a href="javascript:void(0)" url="" tip="0"  class="btn btn-raed default">下一步</a>-->
                                        <?php endif;?>
                                        &nbsp;&nbsp;&nbsp;

                                        <span class="loadingTip" style="display:none; color: #999; margin-left: 15px; " id="addSuccess"><img style="display: inline;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/onLoad.gif">&nbsp;正在导入数据，请稍后...</span>
                                        <!--<a  class="btn btn-raed" href="<?php echo Yii::app()->createUrl('/class/simport/'.$class->cid);?>?ty=import" >保  存</a>-->
                                        <!--&nbsp;&nbsp;<a class="btn btn-default" href="<?php echo Yii::app()->createUrl('/class/supload/'.$class->cid);?>" >返回</a>-->
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
    <div class="header"><span id="popup_title">发送邀请</span> <a href="<?php echo Yii::app()->createUrl('/class/students/'.$class->cid);?>" class="close"> </a></div>
    <div class="remindInfo">
        <p style=" color: #999; margin-bottom: 5px;">立即为新成员发送短信邀请</p>
        <div id="remindText" class="centent" style="text-indent: 0em;padding: 5px; border: 1px solid #f1f1f1; height: 200px;">
            <?php $str = sprintf(Constant::getFrontTeacherSendPwdSms(),'***',$class->s->name,$userinfo->name,'**********','******');
                   $str=str_replace("未知学校的",'',$str);
				   echo $str;
            ?>
        </div>
    </div>
    
    <div class="popupBtn">
        <a id="delayPostBtn" href="<?php echo Yii::app()->createUrl('/class/teachers/'.$class->cid);?>" class="btn btn-orange">稍后发送</a>
        <a id="isPostBnts" tip="0" href="javascript:void(0);" url="<?php echo Yii::app()->createUrl('/class/sendpwd/');?>" cid ="<?php echo $class->cid;?>"  class="btn btn-orange">发送邀请</a>&nbsp;&nbsp;&nbsp;
    </div>
</div>

<script src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/prompt.js'); ?>" type="text/javascript"></script>
<link href="<?php echo MainHelper::AutoVersion('/js/xiaoxin/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/intValidform.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    //邀请操作
    $('#isPostBnts').click(function(){
        var url = $(this).attr('url');
        var cid = $(this).attr('cid');
        var tip = $(this).attr('tip');
        if(tip=='0'){
            $(this).attr('tip','1').removeClass('btn-orange').addClass('btn-default');
            $('#rTips').show();
            $.ajax({  
                url:url,   
                type : 'POST', 
                data:{cid:cid,importType:'1',type:2},
                dataType : 'json',              
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {
                    var data =mydata;  
                     if(data.status=="1"){
                        var urlstr = '<?php echo Yii::app()->createUrl('/class/teachers/'.$class->cid);?>';
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
                        $("#addSuccess").text('已成功导入!');
                        if(data&&data.first=='1'){
                          //  $("#popup_title").text("创建班级成功");
                        }
                        window.location.href = mydata.url;
                       // showPromptPush('#inviteBox');
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

    //表单验证控件
    Validform.int("#formBoxRegister");
});
</script>

<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/send.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox"> 
<!--        <div class="titleHeader bBttomT">
            <span class="icon icon7"></span>学校通知
        </div>-->
        <div class="senNavbox">
            <ul class="applicationList bBttomT">
               <li>
                    <div class="applicationItme">  
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/send?noticetype=').Constant::NOTICE_TYPE_1;?>" noticetype="<?php echo Constant::NOTICE_TYPE_1;?>">
                            <span class="fleft sendPic" ><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app1.png"/></span>
                            <span class="send-info applicationTitle">布置作业 </span>
                            <span class="send-info applicationInfo">给学生布置作业</span>
                            <!--<span class="navIco"></span>-->
                        </a> 
                    </div>
                </li>
                <li>
                    <div class="applicationItme">  
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/send?noticetype=').Constant::NOTICE_TYPE_2;?>" noticetype="<?php echo Constant::NOTICE_TYPE_2;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app2.png"/></span>
                            <span class="send-info applicationTitle">通知家长 </span>
                            <span class="send-info applicationInfo">给家长发送通知</span>
                            <!--<span class="navIco"></span>-->
                        </a>
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/send?noticetype=').Constant::NOTICE_TYPE_3;?>" noticetype="<?php echo Constant::NOTICE_TYPE_3;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app4.png"/></span>
                            <span class="send-info applicationTitle">在校表现</span>
                            <span class="send-info applicationInfo">学生在班级的表现</span>
                            <!--<span class="navIco"></span>-->
                        </a>  
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/sendexam');?>" class=" " noticetype="<?php echo Constant::NOTICE_TYPE_4;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app5.png"/></span>
                            <span class="send-info applicationTitle">发布成绩</span>
                            <span class="send-info applicationInfo">发布学生考试成绩</span>
                             <span class="new">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/notice/new_ioc.png"/>
                            </span>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <a rel="noticetypeBtn" href="javascript:;" class="focus"  noticetype="<?php echo Constant::NOTICE_TYPE_5;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app6.png"/></span>
                            <span class="send-info applicationTitle">紧急通知</span>
                            <span class="send-info applicationInfo">发送紧急短信通知</span>
                            <!--<span class="navIco"></span>-->
                        </a>
                    </div>
                </li> 
            </ul>
        </div>
        <div class="box" style="max-width:860px; min-height: 720px; *height: 520px;">
            <div class="formBox">
                <form id="formBoxRegister" action="" method="post">
                    <table class="tableForm" style="margin-top: 0;">
                        <tbody>
                            <tr class="typeRemark">
                               <td  style=" width: 58px; vertical-align: middle;" align="right">
                                    <span style="display: inline-block;width: 58px;"></span> 
                                </td>
                                <td style=" font-size: 14px;">
                                    为确保所有成员收到，可由班主任以短信方式发送，短信仅发给家长。
                                </td>
                            </tr>
                            <tr>
                                <td  style=" width: 58px; vertical-align: top;" align="right">
                                    <span style="display: inline-block;width: 58px; margin-top: 6px;">收件人：</span> 
                                </td>
                                <td width="99%" style="">
                                    <div class="form-group" style="display: inline;">
                                        <select name="sendcid" id="classId" style="width: 100%;" datatype="*" nullmsg="请选择班级" errormsg="请选择班级">
                                            <option value="">请选择您担任班主任的班级</option>
                                           <?php foreach($classs as $class):?> 
                                            <option value="<?php echo $class->cid;?>" <?php if(!$class) echo "selected='selected'";?>><?php echo $class->name;?><?php echo ($class->tSchool&&$class->tSchool->name)?("（".$class->tSchool->name."）"):'';?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <!--<span class="Validform_checktip"></span>--> 
                                </td>
                            </tr>
                            <tr  class="errorTip">
                                <td> <span style="display: inline-block;width: 58px;"></span> </td> <td id="errorTipS"></td>
                            </tr>
                            <tr>
                                <td style=" vertical-align: top;" align="right">
                                    <span style=" display: inline-block; margin-top: 5px; padding-top: 20px;">内　容：</span>
                                </td>
                                <td>
                                    <div class="pReceiver pReceiverdiv" style="display: none;">
                                        称谓：<span id="oCheckTitle">xxx，您好。</span>
                                        <input id="oCheckTitleValue" type="hidden" name="receivertitle" value="xxx，您好。"/>  
                                    </div>
                                    <div class="inputBox">
                                        <textarea id="textTareaCentent" name="content" maxlength="195" placeholder="请在这里填写发送内容，不超过195个字(三条短信)" style=" width: 100%; *width:99%; line-height: 20px; height: 120px; border:1px solid #aaa; border-radius: 3px; padding: 5px; *padding: 5px 2px;"><?php echo $noticeinfo_content?trim($noticeinfo_content):'';?></textarea>
                                    </div>
                                    <div class="tReceiverBox" style="margin-top: 10px;"> 
                                        <div class="textareaErrorTip">（短信使用由班费折算，1条短信折算0.1元班费。）</div>
                                    </div> 
                                </td>
                            </tr>
                            <tr style=" display: none;">
                                <td></td>
                                <td> 
                                    <div>
                                        <input id="cOneself3" type="checkbox" value="1" name="issendsms" ><label for="cOneself3">同时发送短信</label>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                </td>
                                <td>
                                    <div class="">
                                        <a href="javascript:void(0)"  tip="1" id="send" class="btn btn-orange" style="display: none;">立刻发送</a>
                                        <a href="javascript:void(0)" id="sendDisabled" class="btn btn-disabled">立刻发送</a>
                                       <!--<span style=" color: #aaa;">(默认同时给自己发送一条消息)</span>-->
                                        <span class="loadingTip" style="display:none; color: #999; margin-left: 15px; " id="addSuccess"><img style="display: inline;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/onLoad.gif">&nbsp;</span>
                                        <input type="hidden" name="sendself" value="0"/><!--表扬 or批评-->
                                        <!--<a href="" class="btn btn-default">定时发送</a>-->
                                        <input type="hidden" name="noticetype" value="<?php echo Constant::NOTICE_TYPE_4;?>"/><!-- 1布置作业　,2--通知家长,4--在校表现-->
                                        <input type="hidden" name="receivename" value="一班"/><!--表扬 or批评-->
                                        <input type="hidden" name="willsendcount" value="0"/><!--表扬 or批评-->
                                        <input type="hidden" name="sid" value="0"/><!--表扬 or批评-->
                                        <!--
                                        <input type="hidden"  value="32701-1-681001" name="Group[uid][]"/>
                                        <input type="hidden"  value="高101" name="receivename"/>
                                        <input type="hidden"  value="32701" name="sid"/>
                                        -->
    <!--                                        <input type="submit" class="btn btn-orange" value=" 立刻发送 ">
                                        <input type="submit" class="btn btn-default" value=" 定时发送 ">-->
                                        <input id="totalClassFeeInput" type="hidden" value="" />
                                        <input id="studentcountInput" type="hidden" value="" />
                                        <input id="unbindstudentcountInput" type="hidden" value="" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>  
                </form> 
            </div>
        </div> 
    </div>
</div> 
 
<div id="noteRemBox" class="popupBox">
    <div class="header">
            发送紧急通知
            <a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#noteRemBox')" > </a>
        </div>
    <div class="remindInfo">
        <div id="remindTextBox" class="centent"style=" padding: 20px 0;">  
        </div>
    </div>
    <div class="popupBtn">
        <a id="send11" style=" display: none;" href="javascript:void(0);" class="btn btn-orange">确认发送</a>
        <a class="btn btn-orange" href="javascript:void(0);"  onclick="hidePormptMaskWeb('#noteRemBox')">　取 消　</a>
    </div>
</div>
<div id="msgNotRemBox" class="popupBox">
    <div class="header">
            提示
            <a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#msgNotRemBox')" > </a>
        </div>
    <div class="remindInfo">
        <div class="centent"style=" padding: 20px 0;">
            短信内容含有敏感词“<span id="msgParticular" class="c_o "></span>”，无法发送。请修改内容后重试。
        </div>
    </div>
    <div class="popupBtn"> 
        <a class="btn btn-orange" href="javascript:void(0);"  onclick="hidePormptMaskWeb('#msgNotRemBox')">　我知道了　</a>
    </div>
</div>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script type="text/javascript"> 
    $(function(){
        var sms_sign="<?php echo SMS_SIGN;?>";//短信签名
        $('#classId').change(function(){
            var url = '<?php echo Yii::app()->createUrl('/notice/getclassinfo');?>',cids = $('#classId').find('option:selected').val(); 
            if(cids){
                $.post(url,{cid:cids},function(result){
                    result=$.parseJSON(result);
                    if(result.status){
                        var date = result.data, str='', str1=''; 
                        if(parseInt(date.studentcount)>0){
                            str ='<div style="color:#999999;">共'+date.studentcount+'名学生 ';
                            if(parseInt(date.unbindstudentcount)>0){
                                 str1 ='<span class="selectUserTip c_o">(提示，有'+date.unbindstudentcount+'名学生家长未绑定手机号，将无法接收短信：'+date.unbindstudentnames+'。)<span></div>';
                            }
                        }else{
                            str ='<div class="c_o">该班级尚无学生，无法发送短信。</div>';
                        }
                        $("#totalClassFeeInput").val(date.totalClassFee);
                        $("#studentcountInput").val(date.studentcount);
                        $("#unbindstudentcountInput").val(date.unbindstudentcount);
                        $("#errorTipS").html(str+str1);
                        $('#textTareaCentent').keyup();
                    }
                });
            }else{
                $("#errorTipS").html('');
            }
        });
        $('#textTareaCentent').keyup(function(){
            var cunt = 6,
            strC='',//输入内容
            stxt='',//错误提醒
            strvr ='',//短信条数、班费使用情况
            stCunt=0,//发短信人数
            duanxin=0,//内容长度可发几条短信
            cids= $('#classId').find('option:selected').val(),//班级id
            cSt=$('#studentcountInput').val(),//学生数
            sFee = parseFloat($("#totalClassFeeInput").val()), //班费
            cNpSt= $("#unbindstudentcountInput").val(); //未绑定手机号人数
            stCunt = parseInt(cSt)-parseInt(cNpSt);//发短信人数
            //console.log('----stCunt----'+stCunt); 
            strC = $(this).val();
            if(cids){
                if(strC.length){
                    var e =/^\s+$/gi; 
                    if(!e.test(strC)){
                        if(parseInt(cSt)>0){
                            if(stCunt>0){ 
                                cunt += $.trim(strC).length;
                                if(strC.length<=195){
                                    if(cunt<=70){
                                       duanxin = 1;
                                    }else{
                                        duanxin = Math.ceil(cunt/67); 
                                    } 
                                    //console.log('--duanxin---'+duanxin);
                                    var cuntFee =parseFloat(((parseInt(duanxin)*parseInt(stCunt))*0.1).toFixed(2));//需要使用多少班费
                                    if(cuntFee<=sFee){
                                        strvr ='<div>（需使用<span class="c_o"><i>'+parseInt(duanxin*stCunt)+'条</i></span>短信，折算班费<span class="c_o"><i>'+cuntFee+'元</i></span>。班费扣除后剩余<span class="c_r"><i>'+parseFloat((sFee-cuntFee).toFixed(2))+'元</i></span>。）<a href="<?php echo Yii::app()->createUrl('/helper/help11');?>" target="_blank" class="c_r" style="text-decoration:underline;vertical-align: initial;">如何挣班费</a>';
                                        showHideSend(true);
                                    }else{
                                        strvr = '<div>（需使用<span class="c_o"><i>'+parseInt(duanxin*stCunt)+'条</i></span>短信，折算班费<span class="c_o"><i>'+cuntFee+'元</i></span>。班费目前剩余<span class="c_r"><i>'+sFee+'元</i></span>,已不足发送本次短信。）<a href="<?php echo Yii::app()->createUrl('/helper/help11');?>" target="_blank" class="c_r" style="text-decoration:underline;vertical-align: initial;">如何挣班费</a>';
                                        showHideSend(false);
                                    }
                                }
                                //console.log('--cunt--'+cunt);
                                $('.tReceiverBox').html(strvr);
                            }else{
                                stxt ='<div class="c_o">该班级所有学生家长均未绑定手机号，无法发送短信。</div>';
                                $("#errorTipS").html(stxt);
                                showHideSend(false);
                            } 
                            //console.log('--cunt---'+cunt);
                        }else{
                            stxt ='<div class="c_o">该班级尚无学生，无法发送短信。</div>';
                            $("#errorTipS").html(stxt);
                            showHideSend(false);
                        }
                    }else{ //
                        strvr ='<div class="c_o">不能输入纯空格</div>';
                        $('.tReceiverBox').html(strvr);
                        showHideSend(false);
                    }
                }else{
                    strvr ='<div class="textareaErrorTip">（短信使用由班费折算，1条短信折算0.1元班费。）</div>';
                    $('.tReceiverBox').html(strvr);
                    showHideSend(false); 
                }
            }else{
                stxt ='<div class="c_o">请选择班级</div>';
                $("#errorTipS").html(stxt);
                showHideSend(false);
            } 
           
        });
        function showHideSend(flag){//显示隐藏提交按钮
         if(flag){
             $('#sendDisabled').hide();
             $('#send').show();
         }else{
             $('#send').hide();
             $('#sendDisabled').show();
         }
        }
        $('#textTareaCentent').focus(function(){
            var cids= $('#classId').find('option:selected').val(),stxt='';
            if(cids){
                $('#textTareaCentent').keyup();
            }else{
                stxt='<div class="c_o">请选择班级</div>';
                $("#errorTipS").html(stxt);
                showHideSend(false); 
            }
        }); 
        //发送短信
        $("#send").click(function(){ 
            var tip = $(this).attr('tip');
            if(tip=='1'){ 
                var content= $.trim($("#textTareaCentent").val());
                var url="<?php echo Yii::app()->createUrl('/notice/checkbadword');?>";
                $.getJSON(url,{content:content},function(data){
                    if(data&&data.status=='1'){ //有敏感词
                        showPromptPush("#msgNotRemBox");
                        $('#msgParticular').html(data.msg); 
                    }else{ 
                        $("#formBoxRegister").submit();
                        $(this).attr('tip','0');
                    }
                });

            }
        }); 
    }); 
</script>

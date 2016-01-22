<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > <?php echo $class->name; ?>
        </div>
        <div class="box">
            <nav class="navMod navModDone" >
                <div class="fareBox">
                    <span class="ico"></span>
                    <a href="<?php echo Yii::app()->createUrl('expense/expdetail/'.$class->cid, array('authority'=>$class->authority,'from'=>'teachers'));?>">班费余额：&yen;&nbsp;<?php echo isset($classFeeList[0])?substr(sprintf("%.3f", $classFeeList[0]['dBalance']),0,-1):0;?></a>
                </div>
                <a href="<?php echo Yii::app()->createUrl('class/index'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
                <a href="<?php echo Yii::app()->createUrl('class/classinfo',array('cid'=>$class->cid, 'ac'=>$class->authority,'from'=>'teachers'));?>" class="btn btn-default">班级属性</a> 
                <div class="bdsharebuttonbox" style="display: inline-block; *display: inline;" data-tag="share_1">
                    <a  href="javascript:;" style="background-image: none;" rel="shareShow" tip="0" class="btn btn-default" data-cmd="sqq">分享班级信息</a>
                </div>
                <?php if($isMaster):?>
                <a href="javascript:;" rel="fastInviteBtn" class="btn btn-default">一键短信邀请</a> 
                <a href="javascript:;" onclick="showPromptsRemind('#addTeacherBox');" class="btn btn-default">单个添加老师</a>   
                <?php endif;?>
            </nav>
            <div class="titleBox">
                <ul class="titleTable">
                    <li><a href="<?php echo Yii::app()->createUrl('/class/students/'.$class->cid."?ac=".$class->authority);?>">学生</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/class/teachers/'.$class->cid."?ac=".$class->authority);?>" class="focus">老师</a></li>
                </ul>
            </div>
            <div class="classMemberBox" >
                <table class="table"> 
                    <tbody>
                        <tr class="tableHead">
                            <th width="22%"><div style="text-align: left;">姓名</div></th> 
                            <th width="12%"><div style="text-align: left;">科目</div></th>
                            <th width="15%">手机号码</th>
                            <th width="10%">app使用状态</th>
                            <th width="15%">进班时间</th> 
                            <th width="15%" style="<?php echo !$isMaster?'display:none':'';?>">操作</th>
                          
                        </tr>
                        <?php if(count($data['datas'])): ?>
                            <?php foreach($data['datas'] as $member): ?>
                                <tr>
                                    <td>
                                        <div style="text-align: left;" title="<?php echo $member['name']; ?>"> 
                                            <?php if($member['type']==1):?>
                                                <b><?php echo $member['name']; ?></b>
                                                <a href="javascript:;" style=" vertical-align: -1px; cursor: text;"  >（班主任）</a>
                                            <?php else: ?>
                                                <?php echo $member['name']; ?>

                                            <?php endif; ?> 
                                        </div>
                                    </td>
                                    <td style="text-align:left;">

                                        <div class="inputBox" >
                                            <div style="float: left; width: 100px; height: 30px; line-height: 30px; overflow: hidden;text-overflow: ellipsis;  white-space: nowrap; cursor: pointer;word-break: break-all;" rel="<?php echo (Yii::app()->user->id == $member['userid'])? 'studentidInputEdit':'';?>" title="<?php echo $member['subject'];?>">
                                                <?php echo $member['subject'];?>
                                                </div> 
                                            <input rel="editInput"  maxlength="20"  cid="<?php echo $class->cid;?>" userid="<?php echo $member['userid'];?>" style="display: none;  width: 100px;" type="text" class=" medium" oldvalue="<?php echo $member['subject'];?>" value="<?php echo $member['subject'];?>" placeholder="输入科目" >
                                        </div>

                                    </td>
                                    <td><?php echo $member['mobilephone']; ?></td>
                                    <td> <?php if($member&&$member['appstate']==1):?>
                                            <span>已激活</span>
                                        <?php else:?>
                                            <span class="colorP">未安装激活</span>
                                        <?php endif;?></td>

                                    <td><?php echo date('Y/m/d',$member['creationtime']); ?></td>
                                    <td class="operation" style="<?php echo !$isMaster?'display:none':'';?>">
                                        <?php if($isMaster&&$member['type']!==1):?>
                                            <a href="javascript:void(0);"  rel="remove_member" data-href="<?php echo Yii::app()->createUrl('class/removeteacher/'.$member['userid']);?>?cid=<?php echo $class->cid; ?>">移 除</a>
                                        <?php else: ?>
<!--                                        <a href="javascript:;" onclick="showPromptsRemind('#changeMaster');" title="点击更换班主任">更换班主任</a>-->
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="remindBox">
                                <td colspan="6" style=" padding: 0;">
                                    <div class="noContent" style="background: #FFF; padding-bottom: 20px;"> 
                                        <span ><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tip.png"></span>
                                        <p>空空如也</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div id="pager">    
                    <?php    
                        $this->widget('CLinkPager',array(    
                            'header'=>'',    
                            'firstPageLabel' => '首页',    
                            'lastPageLabel' => '末页',    
                            'prevPageLabel' => '上一页',    
                            'nextPageLabel' => '下一页',    
                            'pages' => $data['pager'],    
                            'maxButtonCount'=>9    
                            )    
                        );    
                    ?>    
                </div>  
                <div class="classBtnBox colorTip">
                    提示：如果希望更多成员加入班级，请点击页面上方“分享班级信息”，让其它老师和学生家长通过此信息找到并加入班级
                </div>
            </div> 
        </div> 
    </div>
</div>
<div id="changeMaster" class="popupBox">
    <div class="header">更换班主任 <a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#changeMaster')" > </a></div>
    <div class="remindInfo">
        <p class="red">（提醒：更换班主任后，您将失去对该班级所有管理权限。）</p>
        <div id="remindText" class="centent" style="text-indent: 0em;">
            <ul class="teacherListBox" >
                <?php if(count($teachers_old)):?>
                <?php $i=0; foreach($teachers_old as $val):?>
                <li>
                    <input rel="changeBtn" id="teacher_<?php echo $i; ?>"  type="radio" name="changemaster" url="<?php echo Yii::app()->createUrl('class/master').'/'.$class->cid.'?uid='.$val->uid;?>" value="<?php echo $val->uid;?>">
                    <label  for="teacher_<?php echo $i; ?>"><?php echo $val->name;?></label>
                </li>
                <?php $i++; endforeach;?>
                <?php else:?>
                    <li style="color:#993300;width:100%;text-align:center;padding-left:0;margin-top:10px;">暂无更多老师</li>
                <?php endif;?>
            </ul> 
        </div> 
        <div style="color: #999999; margin-top: 15px; ">
            <p>规则：</p>
            1.老师创建班级后默认成为该班级班主任，创建后可更换班主任身份给其它老师。<br/>
            2.一个老师最多只能同时担任三个班级的班主任。
        </div> 
    </div>
    <div class="popupBtn" style=" padding-top: 10px;">
        <a id="changeMasterBtn"  href="" class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#changeMaster')" class="btn btn-default">取 消</a>
    </div>
</div>

<div id="addTeacherBox" class="popupBox" style="width: 500px;">
    <div class="header">添加老师 <a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#addTeacherBox')" > </a></div>
        <form name="addform" id="formBoxRegister" method="post" action="<?php echo Yii::app()->createUrl("class/pinvite").'/'.$class->cid;?>">
            <div class="remindInfo"> 
                <div id="remindText" class="centent" style=" padding:0; text-indent: 0em;">
                    <div class="tableForm"> 
                        <div class="rowElem">
                            <span class="name">老师手机号 <b class="red">*</b> ：</span>
                            <div class=" inputBox">  
                                <input id ="teacherMobile" name="Teacher[mobile]" type="text" maxlength="11" class="lg" placeholder="11位手机号，如：137xxxx0028"  datatype="phone" nullmsg="请输入老师手机号！" errormsg="输入的手机号格式不正确!">
                                <span class="red">&nbsp;</span>
                            </div>
                            <span id="teacherMobileTips" class="Validform_checktip">&nbsp;</span>
                        </div>
                        <div class="rowElem">
                            <span class="name">老师姓名 <b class="red">*</b> ：</span>
                            <div class=" inputBox">
                                <span id="textMobile" style=" display: none; width: 320px; height: 36px;"></span>
                                <input id="teacherName" name="Teacher[name]" type="text" maxlength="8" class="lg" placeholder="请务必输入真实姓名" datatype="*1-8" nullmsg="请输入老师姓名！" errormsg="老师姓名不能大于8个字!">
                                <span class="red">&nbsp;</span>
                            </div>
                            <span class="Validform_checktip">&nbsp;</span>
                        </div>
                        <div class="rowElem">
                            <span class="name">任教科目 <b class="red">*</b> ：</span>
                            <div class=" inputBox"> 
                                <input id ="teacherMobile" name="Teacher[subject]" type="text" maxlength="11" class="lg" placeholder="如：语文"  datatype="*1-10" nullmsg="请输入任教科目！" errormsg="任教科目不能大于10个字!">
                                <span class="red">&nbsp;</span>
                            </div>
                            <span class="Validform_checktip">&nbsp;</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="popupBtn" style=" padding-bottom: 10px;">
                <input type="submit" class="btn btn-orange" value="确 定" >
                <!--<a id="addTeacherBtn"  href="javascript:;" class="btn btn-orange">确 定</a>-->
                &nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#addTeacherBox')" class="btn btn-default">取 消</a>
            </div>
        </form>
</div>
<div id="changeClassBox" class="popupBox">
    <div class="header">更改班级名称 <a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#changeClassBox')" > </a></div>
    <form name="addform" id="formBoxRegister1" method="post" action="<?php echo Yii::app()->createUrl("class/update").'/'.$class->cid;?>">
        <div class="remindInfo"> 
            <div id="remindText" class="centent" style=" padding:0; text-indent: 0em;">
                <div class="tableForm"> 
                    <div class="rowElem">
                        <div class=" inputBox">
                            <input id="changeClassName" name="Class[name]" type="text"
                                   maxlength="20" class="lg" placeholder="请输入班级名称"
                                   value="<?php echo $class->name;?>" datatype="*1-20" nullmsg="请输入班级姓称！"
                                   errormsg="班级姓称不能大于20个字!">
                            <span class="red">*</span>
                        </div>
                        <span class="Validform_checktip" ></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="popupBtn" style=" padding-bottom: 10px;">
            <input type="submit" class="btn btn-orange" value="确 定" >
            <!--<a id="addTeacherBtn"  href="javascript:;" class="btn btn-orange">确 定</a>-->
            &nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#changeClassBox')" class="btn btn-default">取 消</a>
        </div>
    </form> 
</div>
<div id="disbandBox" class="popupBox">
    <div class="header">退出班级<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#disbandBox')"> </a></div>
    <div class="remindInfo">
        <div id="remindText" class="centent">您是班主任，不能直接退出班级，需要先转让班主任身份给其他任课老师后，才能退出。</div>
    </div>
    <div class="popupBtn">
        <a id="disbandLink" href="<?php echo Yii::app()->createUrl('class/mastersetting/'.$class->cid);?>" class="btn btn-orange">转让班主任</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#disbandBox')" class="btn btn-default">取 消</a>
    </div>
</div>
<div id="postRemindBox" class="popupBox">  
    <div class="remindInfo" style="padding-top: 30px;">
        <div class="centent">一个班级一天只能发送一次“一键短信邀请”给老师。</div>
    </div>
    <div class="popupBtn" style="margin:10px 0 0 0;">
        <a href="javascript:;" onclick="hidePormptMaskWeb('#postRemindBox')"  class="btn btn-orange">确 定</a> 
    </div>
</div>
<div id="remindBox" class="popupBox"> 
    <div class="remindInfo"> 
        <div id="remindText" class="centent">是否移除当前老师？ </div>
    </div>
    <div class="popupBtn">
        <a id="deleLink" href="" class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#remindBox')" class="btn btn-default">取 消</a>
    </div>
</div> 
 
<div id="fastInviteBox" class="popupBox" style=" width: 500px;">
    <div class="header">一键短信邀请 <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#fastInviteBox')" class="close"> </a></div>
     <div class="remindInfo">
         <?php if($needSendpwdNum==0||$teachersnum==0):?>
           <?php if($teachersnum==0):?>
             <p>没有老师可邀请</p>
           <?php else:?>
            <p>所有老师都已激活，不需要邀请</p>
         <?php endif;?>
         <?php else:?>
        <div id="remindTexts" class="centent" style="text-indent: 0em;padding: 10px; min-height: 150px;">
            <p style="color:#f59201; text-align: center; ">对尚未安装激活“班班手机客户端APP”的任课老师发送短信邀请。</p>
            <div style="position: relative; padding-left: 80px; margin-top: 10px;">
                <b style=" display: block; position: absolute; left: 0px; top:0; zoom: 1;">短信内容：</b> 
                各位老师你们好：我是<?php echo $class->name;?>的班主任<?php echo $userinfo->name;?>老师。班级通知、家庭作业、考试成绩...都可以从这里发给学生家长。请大家尽快下载班班手机应用：<?php echo SITE_MSG_DOWNLOAD_SHORT_URL; ?>。下载后，登录
                您的账号：xxxxxxx，密码：xxxxxx，就能找到咱们班了。客服电话：400 101 3838。
            </div>
         </div>
        <?php endif;?>
    </div> 
    <div class="popupBtn">
        <?php if($needSendpwdNum==0||$teachersnum==0):?>
            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#fastInviteBox')" class="btn btn-default">关闭</a>
         <?php else:?>
        <a href1="javascript:void(0);" tid="0" cid="<?php echo $class->cid;?>" href="<?php echo Yii::app()->createUrl('class/sendpwd?cid='.$class->cid.'&type=1&import=3');?>" class="btn btn-orange">发送邀请</a>&nbsp;&nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#fastInviteBox')" class="btn btn-default">稍后发送</a>
        <?php endif;?>
    </div>
</div>


<div id="leavebandBtn" class="popupBox">
    <div class="remindInfo">
        <div id="remindText" class="centent">是否退出当前班级？</div>
    </div>
    <div class="popupBtn">
        <a id="leavebandLink" href=""  class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#leavebandBtn')" class="btn btn-default">取 消</a>
    </div>
</div>
<!-- begin 单个添加后-->
<div id="inviteBoxSingle" class="popupBox" style=" width: 600px;">
    <div class="header">添加成功 <a href="<?php echo Yii::app()->createUrl('class/students/'.$class->cid."?ac=".$class->authority);?>" class="close"> </a></div>
    <div class="remindInfo">
        <div class="toLeadInfo">
            <h1 class="tPicR" style=" height: 20px; line-height: 20px; margin-bottom: 10px; padding-left: 30px; "><b>已完成添加！</b></h1>
            <p style=" padding-left: 30px;">
                成功添加1名。 <p/>
            <p style=" padding-left: 30px;">您可以给老师发送<span style="color: #f59201;">“一键短信邀请”</span>，提醒他们下载登录班班手机应用。
            </p>
        </div>
        <div id="remindText" class="centent" style="text-indent: 0em;padding: 10px; margin-top: 30px; border: 1px #999999 dashed; height: 150px;">
            <p style="color:#f59201; text-align: center; ">一键短信邀请</p>
            <div style="position: relative; padding-left: 100px; margin-top: 10px;">
                <b class="tPicM" style=" display: block; position: absolute; left: 0px; top:0; zoom: 1;">短信内容：</b>
                各位老师你们好：我是<?php echo $class->name;?>的班主任<?php echo $userinfo->name;?>老师。班级通知、家庭作业、
                考试成绩...都可以从这里发给学生家长。 请大家尽快下载班班手机应用：
                <?php echo SITE_MSG_DOWNLOAD_SHORT_URL; ?>。下载后，登录您的账号：XXXXXXX，
                密码：xxxxxx，就能找到咱们班了。客服电话：4001013838 。
            </div>
        </div>
    </div>
    <div class="popupBtn">
        <a id="sendPwdPost" href1="javascript:void(0);" tid="0" cid="<?php echo $class->cid;?>" href="<?php echo Yii::app()->createUrl('class/sendpwd?cid='.$class->cid.'&import=2&mobiles='.$mobiles.'&type=1');?>" class="btn btn-orange">完成</a>&nbsp;&nbsp;&nbsp;
        <a id="delayPostBtn" href="<?php echo Yii::app()->createUrl('class/teachers/'.$class->cid."?ac=".$class->authority);?>" class="btn btn-default">取消</a>
    </div>
</div>
<!-- end-->
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/shaerclass.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){ 
        //表单验证控件
        Validform.int("#formBoxRegister");
        Validform.int("#formBoxRegister1");
        //解散班级
        $('[rel=disbandBtn]').click(function(){
            var url = $(this).attr('url');
             $('#disbandLink').attr('href',url);
            showPromptsRemind('#disbandBox');
        });
        var isimport="<?php echo $import;?>",
            mobiles="<?php echo $mobiles;?>";
        if(isimport==1&&mobiles.length>0){
            showPromptsRemind('#inviteBoxSingle');
        }
        $("#teacherMobile").blur(function(){ 
            var mobile= $.trim($(this).val());
            if(mobile){
                var url="<?php echo Yii::app()->createUrl('ajax/getuserbymobile');?>";
                $.getJSON(url,{mobile:mobile},function(data){
                    if(data&&data.status=='1'){
                        $("#teacherName").val(data.data.name);
                         $("#teacherMobileTips").find('span').text('该手机已注册');
                        $("#textMobile").text(data.data.name).css('display','inline-block');
                        $("#teacherName").hide();
                    }else{
                        $("#textMobile").text('').hide();
                        $("#teacherName").show(); 
                    }
                })
            }
            //console.log(mobile);
           // alert(mobile);
        })

        $("#btn_invitesms").click(function(){
            //弹窗提示发送邀请短信
            //$("#inviteBox .toLeadInfo").hide();
            showPromptsRemind('#inviteBox');
        })
        
        // 显示效果
       $('[rel=studentidInputEdit]').hover(function(){ 
            $(this).addClass('bordBox');
        },function(){
            $(this).removeClass('bordBox');
        });
        //编辑科目
        $('[rel=studentidInputEdit]').click(function(){ 
            var text =$.trim($(this).text());
            $(this).hide();
            $(this).siblings('input[type=text]').show();
            $(this).siblings('input[type=text]').val(text).focus();
        });
        $('[rel=fastInviteBtn]').click(function(){ 
            var url ='<?php echo Yii::app()->createUrl('/ajax/Checksendsms?cid='.$class->cid."&type=1&userid=".Yii::app()->user->id);?>';
             $.ajax({  
                url:url,   
                type : 'POST', 
                data:{},
                dataType : 'json',              
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {
                    var data =mydata;   
                    if(data&&(parseInt(data.status)==0)){
                        showPromptsRemind('#fastInviteBox');
                    }else{
                        showPromptsRemind('#postRemindBox');
                    }  

                },  
                error : function() { 
                    //str = "系统繁忙,请稍后再试";
                }  
            }); 

        });

        //提交 
        $('[rel=editInput]').keydown(function(){  
            var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异 
            var rge =/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\,，\s]+$/;
            if (event.keyCode == 13){
                var that=this;
                var stIdV =$(this).val(),userId =$(this).attr('userid'),cid=$(this).attr("cid"),oldstudentid=$(this).attr('oldvalue');
                var url ='<?php echo Yii::app()->createUrl('/class/updatesubject');?>?ver=<?php echo rand(0,9999);?>';
                if(stIdV!=oldstudentid){   
                     if(rge.test(stIdV)){
                        if(getByteLen(stIdV)<=20){
                            $.ajax({  
                               url:url,
                               type : 'POST',
                               data : {subject:stIdV,userid:userId,cid:cid},
                               dataType : 'json',  
                               contentType : 'application/x-www-form-urlencoded',  
                               async : false,  
                               success : function(mydata) {
                            	   if(mydata.status == 1){
                                       $(that).siblings('[rel=studentidInputEdit]').text(stIdV).show();
                                       $(that).val(stIdV).hide();
                                       $(that).attr("oldvalue",stIdV);
                            	   }else{
                                	   alert("系统繁忙，请稍后再试");
                            	   }
                               },  
                               error : function() { 
                                   alert("系统繁忙，请稍后再试");
                               }  
                            });
                        }else{
                            alert('科目不能超过10个汉字（或20个英文字符）！');
                        }
                    }else{
                        alert('科目只允许中英文数字以及()_-.，和空格组成');
                    }
                }
            }else{
                $(that).siblings('[rel=studentidInputEdit]').show();
                $(that).hide();
            }  
        });
        
        $('[rel=editInput]').focusout(function(){ 
                var that=this;
                var rge =/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\,，\s]+$/;
                var stIdV =$(this).val(),userId =$(this).attr('userid'),cid=$(this).attr("cid"),oldstudentid=$(this).attr('oldvalue');
                var url ='<?php echo Yii::app()->createUrl('/class/updatesubject');?>?ver=<?php echo rand(0,9999);?>';
                if(stIdV!=oldstudentid){
                    if(rge.test(stIdV)){
                        if(getByteLen(stIdV)<=20){
                            $.ajax({  
                               url:url,
                               type : 'POST',
                               data : {subject:stIdV,userid:userId,cid:cid},
                               dataType : 'json',  
                               contentType : 'application/x-www-form-urlencoded',  
                               async : false,  
                               success : function(mydata) {
                                   if(mydata.status == 1){
                                	   $(that).siblings('[rel=studentidInputEdit]').text(stIdV).show();
                                       $(that).val(stIdV).hide();
                                       $(that).attr("oldvalue",stIdV);
                                   }else{
                                	   alert("系统繁忙，请稍后再试");
                                   }
                                   
                               },
                               error : function() { 
                                   alert("系统繁忙，请稍后再试");
                               }  
                           }); 
                        }else{
                            alert('科目不能超过10个汉字（或20个英文字符）！');                            
                        }
                    }else{
                        alert('科目只允许中英文数字以及()_-.，和空格组成');
                    }
            }else{
                $(that).siblings('[rel=studentidInputEdit]').show();
                $(that).hide();
            }  
        });
        
        // 邀请
        $('#inviteBtn').click(function(){
            var encodeCid = $(this).attr('ecid');
           
            location.href="<?php echo Yii::app()->createUrl('/class/inviteclassmates?cid=');?>"+encodeCid+"&ty=1";
                          
        });

        $("#sendPwdPost").click(function(){
            var url = $(this).attr('url');
            var cid = $(this).attr('cid');
            var tid = $(this).attr('tid');
            if(tid=="0"){
                $(this).attr('tid','1');
                $.ajax({  
                    url:url,   
                    type : 'POST', 
                    data:{cid:cid,ty:1},
                    dataType : 'json',              
                    contentType : 'application/x-www-form-urlencoded',  
                    async : false,  
                    success : function(mydata) {
                        var data =mydata;   
                        location.reload();

                    },  
                    error : function() { 
                        //str = "系统繁忙,请稍后再试";
                    }  
                }); 
            }
        });

        //非班主任退出班级
        $('[rel=leavebandBtn]').click(function(){
            var url = $(this).attr('url');
            $('#leavebandLink').attr('href',url);
            showPromptsRemind('#leavebandBtn');
        });

        //删除操作
        $('[rel=remove_member]').click(function(){ 
            var url = $(this).data('href');  
            $('#deleLink').attr('href',url);
            showPromptsRemind('#remindBox');
        });
        function getQueryString(url,name) {
            var reg = new RegExp("(^|[?&])" + name + "=([^&]*)(&|$)", "i");
            var r = url.match(reg);
            if (r != null) return unescape(r[2]); return null;
        }
        //改变班主任
        $('[rel=changeBtn]').click(function(){
            var url = $(this).attr('url'); 
            $('#changeMasterBtn').attr('href',url);
            /*
            var uid=getQueryString(url,"uid"); 
            var queryurl="<?php echo Yii::app()->createUrl('/class/uidmaster');?>";
            $.getJSON(queryurl,{uid:uid},function(data){
                if(data&&data.status=='0'){
                    $(".master_select").text(data.name);
                    showPromptPush('#isLeavePopupBox');
                }else{
                    $('#changeMasterBtn').attr('href',url);
                }
            });
            */
            //$('#changeMasterBtn').attr('href',url);
        });
        //显示设置弹框
        $('[rel=updateLinkBtn]').click(function(e){ 
           clickTarget('[rel=updateLinkBtn]','.courseBox');
            var hst = '-5px'; 
            var boxs =$(this).siblings('.courseBox');
            if(boxs.height()>200){ 
                hst =-(boxs.height()/2)+'px'; 
            }else{ 
            }
            boxs.css({top:hst}); 
            $('.courseBox').hide();
            boxs.show();
            //safariOptimize($('.courseBox ul li a em'));
        });
        function ajaxUpdate(url,sid,sname,cid,tid,obj){
            $.ajax({  
                url:url,   
                type : 'POST',
                data : {sid:sid,sname:sname,cid:cid,tid:tid},
                dataType : 'text',  
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {   
                    var show_data =mydata;
                   //alert(show_data);
                    
                },  
                error : function() {  
                        // alert("calc failed");  
                }  
            });
        }
        //设置课程
//        $('[rel=updateLink]').click(function(){
//            var obj = $(this);
//            var url = obj.data("url");
//            var type =obj.data("type");
//            var sid = obj.attr('sid'), sname = obj.attr('sname'), cid = obj.attr('cid'), tid=obj.attr('tid');  
//            if(parseInt(type)==0){
//                ajaxUpdate(url,sid,sname,cid,tid,obj);
//            }
//            $(this).parents('.courseBox').hide();
//        });
    });
    $('[rel=shareShow]').click(function(){
            var tip = $(this).attr('tip');
            if(tip=="0"){
                $(this).attr('tip','1');
               $('#shareBox').show(); 
            }else{
                $(this).attr('tip','0');
                $('#shareBox').hide();
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
//    $('.shareHide').click(function(){
//            $('#shareBox').hide();
//            $('[rel=shareShow]').attr('tip','0');
//    });
    var shareUrl = '<?php echo Yii::app()->createAbsoluteUrl('mobile/classinv', array('classid'=>$class->cid,'uid'=>Yii::app()->user->id,'role'=>'1'));?>';
    var bdTexts = '<?php echo $class->name ? $class->name : '';?>的老师家长，快到班里来~';
    var bdDescs =  '新学期作业、通知从这里发送、接收。大家尽快加一下班哦~~';
    var bdPic = '<?php echo $domain = Yii::app()->request->hostInfo; ?>';
    var type="<?php echo $isMaster?1:0;?>";
//    if(type==0){
//         shareUrl = '<?php echo Yii::app()->createAbsoluteUrl('mobile/classinv', array('classid'=>$class->cid,'uid'=>Yii::app()->user->id,'role'=>'2'));?>';
//         bdTexts ='我加入了“<?php echo $class->name ? $class->name : '';?>”，欢迎您加入！';
//         bdDescs =  '为了更好的进行班级沟通，我在“班班”加入了我们的班级（<?php echo $class->name?$class->name:'';?>），班级代码为<?php echo $class->code ? $class->code : '';?>。班班是免费家校平台，方便我们班的家长老师快捷联络、收发孩子通知作业，注册后输入班级代码加入我们的班集体！我们都在等着你！';
//    }
    ShareClass.int(shareUrl,bdTexts,bdDescs,bdPic);
</script>
<style>
    #messageBox{ font-size: 18px;  margin: 0px auto; position:absolute; right: 40%;  bottom:20px; display: none; z-index: 10000; border-radius: 5px;}
    #messageBox .messageType{ padding:8px 15px; line-height: 30px; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;}
    #messageBox .success{  border: 1px solid #fbeed5; background-color: #f59201; color: #ffffff; }
    #messageBox .error{border: 1px solid #eed3d7; background-color: #f59201; color: #ffffff; }
   // #message .messageType span{  float: left;}
</style>
<div id="messageBox"> 
    <div class="messageType success"><span id="icon-11">✔</span>&nbsp;&nbsp;不存在未使用用户，未发送邀请</div>
</div> 

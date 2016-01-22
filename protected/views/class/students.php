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
                    <a href="<?php echo Yii::app()->createUrl('expense/expdetail/'.$class->cid, array('authority'=>$class->authority,'from'=>'students'));?>">班费余额：&yen;&nbsp;<?php echo isset($classFeeList[0])?substr(sprintf("%.3f", $classFeeList[0]['dBalance']),0,-1):0;?></a>
                </div>
                <a href="<?php echo Yii::app()->createUrl('class/index'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
                <a href="<?php echo Yii::app()->createUrl('class/classinfo',array('cid'=>$class->cid, 'ac'=>$class->authority,'from'=>'students'));?>" class="btn btn-default">班级属性</a>
                <div class="bdsharebuttonbox" style="display: inline-block; *display: inline;" data-tag="share_1">
                    <a  href="javascript:;" style=" background-image: none;" rel="shareShow" tip="0" class="btn btn-default" data-url="<?php echo Yii::app()->createAbsoluteUrl('mobile/classinv', array('classid'=>$class->cid,'uid'=>Yii::app()->user->id,'role'=>'1'));?>" data-cmd="sqq">分享班级信息</a>
                </div> 
                <?php if($isMaster):?> 
                <a href="javascript:;" rel="fastInviteBtn"  class="btn btn-default">一键短信邀请</a>
                <a href="javascript:;" onclick="showPromptsRemind('#addStudentBox');" class="btn btn-default">单个添加学生</a>
                <a href="<?php echo Yii::app()->createUrl('class/supload', array('cid'=>$class->cid));?>" class="btn btn-default">一键导入学生</a>
                <!--<a rel="disbandBtn" href="javascript:;" url="<?php echo Yii::app()->createUrl('class/mastersetting/'.$class->cid);?>" class="btn btn-default">退出班级</a>-->
                <?php else:?>
                    <!--<a rel="leavebandBtn" url="<?php echo Yii::app()->createUrl('class/leaveclass').'?cid='.$class->cid; ?>" href="javascript:;" class="btn btn-default">退出班级</a>-->
                <?php endif;?> 
            </nav>
          <!--  <div class="classTitle"><?php echo $class->name; ?><span class="sName"> -- <?php echo $schoolname; ?></span></div>-->
            <div class="titleBox">
                <ul class="titleTable">
                    <li><a href="<?php echo Yii::app()->createUrl('class/students/'.$class->cid."?ac=".$class->authority);?>" class="focus">学生</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('class/teachers/'.$class->cid."?ac=".$class->authority);?>">老师</a></li>
                </ul>
            </div>
            <div class="classMemberBox">
                <table class="table">
                    <tbody>
                        <tr class="tableHead"> 
                            <th width="12%"><div class="name">姓名</div></th> 
                           <!-- <th width="16%"><div class="" style="width: 80px; text-align: left;" >学号</div></th>-->
                            <th width="15%"><div class="name " style="width: 100px; padding-left: 0px;">家长</div></th> 
                            <th width="15%">app使用状态</th>
                            <th width="12%">进班时间</th>
                            <th width="8%" style="<?php echo !$isMaster?'display:none':'';?>">操作</th>
                        </tr>
                        <?php if(count($data['datas'])): ?>
                        <?php foreach($data['datas'] as $student): ?>
                        <tr rel="<?php $guradians= $student['guradians']; if(count($guradians)){echo $guradians[0]['mobile'];} ?>">
                            <td rel="<?php echo $student['id']; ?>"><div class="name" title="<?php echo $student['name']; ?>"><?php echo $student['name']; ?></div></td>

                            <td class="operation">
                                <?php $isclient = count($guradians)?(int)$guradians[0]['client']:0;  ?> 
                                <div style=" position: relative; width: 280px; padding-left: 0px; font-size: 14px;">
                                    <div class="mobileBox fright"  style="position: relative;">
                                        <a href="javascript:void(0);" title="手机号"<?php if(count($guradians)>1): ?> class="mobileHovrer" rel="updateLinkBtn" <?php endif; ?>>&nbsp;</a>
                                        <?php if(count($guradians)>1): ?>
                                        <div class="courseBox">
                                            <ul>
                                                <?php foreach($guradians as $vv=>$gur): ?>
                                                        <li>
                                                            <a href="javascript:void(0);" rel="updateLink" class="typeBox" data-url="" data-type="1" >
                                                                <span style=" display: inline-block; text-overflow : ellipsis;white-space : nowrap;">
                                                                <?php echo $gur['role']?$gur['role']:'家长'; ?></span>
                                                                <span style=" display: inline-block; margin-right: 5px;">：<?php echo $gur['name']; ?></span> 
                                                                <span style=" display: inline-block; margin-right: 5px;">：<?php echo $gur['mobile']; ?></span>
                                                                <?php if($gur&&$gur['appstate']==1):?>
                                                                <span style="display: inline-block;">已激活</span>
                                                                <?php else:?>
                                                                    <span class="colorP" style="display: inline-block;">未安装激活</span>
                                                                <?php endif;?>
                                                            </a>
                                                        </li>
                                                <?php endforeach; ?> 
                                            </ul>
                                        </div>
                                        <?php endif;?> 
                                    </div>
                                    <?php $role=isset($guradians[0]['role'])?$guradians[0]['role']:'家长';
                                         // $role=($role=='关注人'?'家长':$role);
                                          $guradians0=isset($guradians[0])?$guradians[0]:null;
                                    ;?>
                                    <a href="javascript:void(0);" class="none" title="">
                                        <span style="margin-right:5px;"><?php echo $role;?>：</span>
                                        <span style=" display: inline-block;text-overflow : ellipsis;white-space : nowrap; margin-right:5px;"><?php echo $guradians0?$guradians0['name']:"";?></span> <?php echo isset($guradians[0]['mobile'])?$guradians[0]['mobile']:''; ?></a>
                                </div>
                            </td>
                            <td>
                                <?php if($guradians0&&$guradians0['appstate']==1):?>
                                已激活
                                <?php else:?>
                                <span class="colorP">未安装激活</span>
                                <?php endif;?>
                                </td>
                            <td><?php echo date('Y/m/d',$student['creationtime']); ?></td>
                            <td class="operation" style="<?php echo !$isMaster?'display:none':'';?>">
                                <a href="javascript:void(0);" data-href="<?php echo Yii::app()->createUrl('class/removestudent/'.$student['student']);?>?cid=<?php echo $class->cid; ?>" rel="dele">移除</a>
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
                   <!--
                    <a  href="javascript:;" data-href="<?php echo Yii::app()->createUrl('class/sinvite/'.$class->cid);?>" onclick="showPromptsRemind('#addStudentBox')" class="btn btn-default"> 添加学生 </a>-->
                <!--    <a href="<?php echo Yii::app()->createUrl('class/supload?cid='.$class->cid);?>" class="btn btn-default">批量添加学生</a>-->
                    
                  <!--  <a href="javascript:;" needSendpwd="<?php echo $needSendpwdNum;?>" cid="<?php echo $class->cid;?>" ecid="<?php echo BaseUrl::encode($class->cid);?>" id="inviteBtn" class="btn btn-orange">重新邀请</a>-->
                   
                    <!--<a href="<?php echo Yii::app()->createUrl('class/anewpinvite/'.$class->cid);?>?ty=1" class="btn btn-default">重新邀请</a>-->
                </div>
            </div>
        </div>
    </div>
</div>
<div id="addStudentBox" class="popupBox" style=" width: 500px;">
    <div class="header">添加学生 <a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#addStudentBox')" > </a></div>
    <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('class/sinvite').'/'.$class->cid;?>" method="post">
        <div class="remindInfo"> 
            <div id="remindText" class="centent" style=" padding:0; text-indent: 0em;">
                <div class="tableForm"> 
                    <div class="rowElem">
                        <span class="name">学生姓名 <b class="red">*</b> ：</span>
                        <div class=" inputBox"> 
                            <input id="studentName" name="Student[name]"  type="text" maxlength="8" class="lg" placeholder="请输入真实姓名"  datatype="*1-8" nullmsg="请输入学生姓名！" errormsg="孩子姓名不能大于8个字!" /> 
                            <span class="red">&nbsp;</span> 
                        </div>
                       <span class="Validform_checktip" >&nbsp;</span>
                    </div>
                    <div class="rowElem">
                        <span class="name">家长手机号 <b class="red">*</b> ：</span>
                        <div class="inputBox"> 
                            <input id ="studentPMobile" name="Student[mobile]"  type="text" maxlength="11" class="lg" placeholder="11位手机号，如：137xxxx0028" datatype="phone" nullmsg="请输入家长手机号！" errormsg="输入的手机号格式不正确!" />
                            <span class="red">&nbsp;</span>
                        </div>
                        <span class="Validform_checktip" >&nbsp;</span>
                    </div>
                    <div class="rowElem">
                        <span class="name">关注人1手机号：</span>
                        <div class="inputBox"> 
                            <input  type="text" name="Student[mobile1]" maxlength="11" class="lg" placeholder="11位手机号，如：137xxxx0028" datatype="phone" ignore="ignore" nullmsg="请输入关注人手机号！" errormsg="输入的手机号格式不正确!" />
                            <span class="red">&nbsp;</span>
                        </div>
                        <span class="Validform_checktip" >&nbsp;</span>
                    </div>
                     <div class="rowElem">
                        <span class="name">关注人2手机号：</span>
                        <div class="inputBox"> 
                            <input  type="text" name="Student[mobile2]" maxlength="11" class="lg" placeholder="11位手机号，如：137xxxx0028" datatype="phone" ignore="ignore" nullmsg="请输入关注人手机号！" errormsg="输入的手机号格式不正确!" />
                            <span class="red">&nbsp;</span>
                        </div>
                         <span class="Validform_checktip" >&nbsp;</span>
                    </div>
                     <div class="rowElem">
                        <span class="name">关注人3手机号：</span>
                        <div class="inputBox"> 
                            <input  type="text" name="Student[mobile3]" maxlength="11" class="lg" placeholder="11位手机号，如：137xxxx0028" datatype="phone" ignore="ignore" nullmsg="请输入关注人手机号！" errormsg="输入的手机号格式不正确!" />
                            <span class="red">&nbsp;</span>
                        </div>
                         <span class="Validform_checktip" >&nbsp;</span>
                    </div>
                    <div class="rowElem">
                        <span class="name">关注人4手机号：</span>
                        <div class="inputBox"> 
                            <input type="text" name="Student[mobile4]" maxlength="11" class="lg" placeholder="11位手机号，如：137xxxx0028" datatype="phone" ignore="ignore" ignore="ignore"  nullmsg="请输入关注人手机号！" errormsg="输入的手机号格式不正确!" />
                            <span class="red">&nbsp;</span>
                        </div>
                        <span class="Validform_checktip" >&nbsp;</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="popupBtn" style=" padding-bottom: 10px;">
            <input class="btn btn-orange" type="submit" value="确 定">
            <!--<a id="addStudentBtn"  href="javascript:;" class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;-->
            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#addStudentBox')" class="btn btn-default">取 消</a>
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
                            <input id="changeClassName" name="Class[name]" type="text" value="<?php echo $class->name;?>" maxlength="20" class="lg" placeholder="请输入班级名称" datatype="*1-20" nullmsg="请输入班级姓称！" errormsg="班级姓称不能大于20个字!">
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
        <div class="centent">您是班主任，不能直接退出班级，需要先转让班主任身份给其他任课老师后，才能退出。</div>
    </div>
    <div class="popupBtn">
        <a id="disbandLink" href="<?php echo Yii::app()->createUrl('class/mastersetting/'.$class->cid);?>" class="btn btn-orange">转让班主任</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#disbandBox')" class="btn btn-default">取 消</a>
    </div>
</div>
<div id="postRemindBox" class="popupBox"> 
    <div class="remindInfo" style="padding-top: 30px;">
        <div class="centent">一个班级一天只能发送一次“一键短信邀请”给学生。</div>
    </div>
    <div class="popupBtn" style="margin:10px 0 0 0;">
        <a href="javascript:;" onclick="hidePormptMaskWeb('#postRemindBox')"  class="btn btn-orange">确 定</a> 
    </div>
</div>
<div id="remindBox" class="popupBox">
    <div class="remindInfo">
        <div id="remindText" class="centent">是否删除当前学生？</div>
    </div>
    <div class="popupBtn">
        <a id="deleLink" href=""  class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#remindBox')" class="btn btn-default">取 消</a>
    </div>
</div>
<!-- begin 单个添加后-->
<div id="inviteBoxSingle" class="popupBox" style=" width: 600px;">
    <div class="header">添加成功 <a href="<?php echo Yii::app()->createUrl('class/students/'.$class->cid."?ac=".$class->authority);?>" class="close"> </a></div>
    <div class="remindInfo">
        <div class="toLeadInfo">
            <h1 class="tPicR" style=" height: 20px; line-height: 20px; margin-bottom: 10px; padding-left: 30px; "><b>已完成添加！</b></h1>
            <p style=" padding-left: 30px;">
                成功添加学生<?php echo $totalstudent;?>名，家长及关注人<?php echo $totalguardian;?>名。 <p/>
            <p style=" padding-left: 30px;">您可以给家长及关注人发送<span style="color: #f59201;">“一键短信邀请”</span>，提醒他们下载登录班班手机应用。
            </p>
        </div>
        <div id="remindText" class="centent" style="text-indent: 0em;padding: 10px; margin-top: 30px; border: 1px #999999 dashed; height: 150px;">
            <p style="color:#f59201; text-align: center; ">一键短信邀请</p>
            <div style="position: relative; padding-left: 100px; margin-top: 10px;">
                <b class="tPicM" style=" display: block; position: absolute; left: 0px; top:0; zoom: 1;">短信内容：</b>
                各位家长你们好：我是<?php echo $class->name;?>的班主任<?php echo $userinfo->name;?>老师。班级通知、家庭作业、
                考试成绩...都会从这里发给大家。 请大家尽快下载班班手机应用：
                <?php echo SITE_MSG_DOWNLOAD_SHORT_URL; ?>。下载后，登录您的账号：XXXXXXX，
                密码：xxxxxx，就能找到咱们班了。客服电话：4001013838 。
            </div>
        </div>
    </div>
    <div class="popupBtn">
        <a id="sendPwdPost" href1="javascript:void(0);" tid="0" cid="<?php echo $class->cid;?>" href="<?php echo Yii::app()->createUrl('class/sendpwd?cid='.$class->cid.'&import=2&mobiles='.$mobiles.'&type=0');?>" class="btn btn-orange">完成</a>&nbsp;&nbsp;&nbsp;
        <a id="delayPostBtn" href="<?php echo Yii::app()->createUrl('class/students/'.$class->cid."?ac=".$class->authority);?>" class="btn btn-default">取消</a>
    </div>
</div>
<!-- end-->
<!--下面是完成导入后-->
<div id="inviteBox" class="popupBox" style=" width: 600px;">
    <div class="header">导入成功 <a href="<?php echo Yii::app()->createUrl('class/students/'.$class->cid."?ac=".$class->authority);?>" class="close"> </a></div>
     <div class="remindInfo">
        <div class="toLeadInfo">
            <h1 class="tPicR" style=" height: 20px; line-height: 20px; margin-bottom: 10px; padding-left: 30px; "><b>已完成导入！</b></h1>
            <p style=" padding-left: 30px;">
                共成功导入学生<?php echo $totalstudent;?>名，家长及关注人<?php echo $totalguardian;?>名。 <p/>
            <p style=" padding-left: 30px;">您可以给家长及关注人发送<span style="color: #f59201;">“一键短信邀请”</span>，提醒他们下载登录班班手机应用。 
            </p>
        </div>  
        <div id="remindText" class="centent" style="text-indent: 0em;padding: 10px; margin-top: 30px; border: 1px #999999 dashed; height: 150px;">
            <p style="color:#f59201; text-align: center; ">一键短信邀请</p>
            <div style="position: relative; padding-left: 100px; margin-top: 10px;">
                <b class="tPicM" style=" display: block; position: absolute; left: 0px; top:0; zoom: 1;">短信内容：</b>
                各位家长你们好：我是<?php echo $class->name;?>的班主任<?php echo $userinfo->name;?>老师。班级通知、家庭作业、
                 考试成绩...都会从这里发给大家。 请大家尽快下载班班手机应用：
                 <?php echo SITE_MSG_DOWNLOAD_SHORT_URL; ?>。下载后，登录您的账号：XXXXXXX，
                 密码：xxxxxx，就能找到咱们班了。客服电话：4001013838 。 
            </div>
         </div>
    </div>
    <div class="popupBtn"> 
        <a id="sendPwdPost" href1="javascript:void(0);" tid="0" cid="<?php echo $class->cid;?>" href="<?php echo Yii::app()->createUrl('class/sendpwd?cid='.$class->cid.'&type=0&import=1');?>" class="btn btn-orange">完成</a>&nbsp;&nbsp;&nbsp;
        <a id="delayPostBtn" href="<?php echo Yii::app()->createUrl('class/students/'.$class->cid."?ac=".$class->authority);?>" class="btn btn-default">取消</a>
    </div>
</div>

<!--这个是点击一键邀请　-->
<div id="fastInviteBox" class="popupBox" style=" width: 500px;">
    <div class="header">一键短信邀请 <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#fastInviteBox')" class="close"> </a></div>
     <div class="remindInfo"> 
         <?php if($classstudentnoactivenum==0||$classstudentnum==0):?>
             <?php if($classstudentnum==0):?>
             <p>当前没有学生可以邀请</p>
             <?php else:?>
                 <p>所有家长均已激活，不需要邀请 </p>
             <?php endif;?>
         <?php else:?>
        <div id="remindTexts" class="centent" style="text-indent: 0em;padding: 10px; min-height:150px;">
            <p style="color:#f59201; text-align: center; ">对尚未安装激活“班班手机客户端APP”的学生发送短信邀请。</p>
            <div style="position: relative; padding-left: 80px; margin-top: 10px;">
                <b style=" display: block; position: absolute; left: 0px; top:0; zoom: 1;">短信内容：</b> 
                各位家长你们好：我是<?php echo $class->name;?>的班主任<?php echo $userinfo->name;?>老师。班级通知、
                家庭作业、考试成绩...都会从这里发给大家。请大家尽快下载班班手机应用：<?php echo SITE_MSG_DOWNLOAD_SHORT_URL; ?>。下载后，登录您的账号：xxxxxxx，密码：xxxxxx，就能找到咱们班了。客服电话：400 101 3838。
            </div>
         </div>
         <?php endif;?>
    </div>
    <div class="popupBtn">
        <?php if($classstudentnoactivenum==0||$classstudentnum==0):?>
            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#fastInviteBox')" class="btn btn-default">关闭</a>
        <?php else:?>
        <a href1="javascript:void(0);" tid="0" cid="<?php echo $class->cid;?>" href="<?php echo Yii::app()->createUrl('class/sendpwd?cid='.$class->cid.'&type=0&import=3');?>" class="btn btn-orange">发送邀请</a>&nbsp;&nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#fastInviteBox')" class="btn btn-default">稍后发送</a>
        <?php endif;?>

    </div>
</div>



<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/shaerclass.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        var isimport='<?php echo $import;?>',
            totalstudent='<?php echo $totalstudent;?>',
            totalguardian='<?php echo $totalguardian;?>';
        if(isimport==1){
            //弹窗提示发送邀请短信
            showPromptsRemind('#inviteBox');
        }
        if(isimport==2){
            showPromptsRemind('#inviteBoxSingle');
        }
        
        //表单验证控件
        Validform.int("#formBoxRegister");
        Validform.int("#formBoxRegister1");
        //解散班级
        $('[rel=disbandBtn]').click(function(){
            var url = $(this).attr('url')
             $('#disbandLink').attr('href',url);
            showPromptsRemind('#disbandBox');
        });
       // 显示效果
       $('[rel=studentidInputEdit]').hover(function(){ 
            $(this).addClass('bordBox');
        },function(){
            $(this).removeClass('bordBox');
        });

        //非班主任退出班级
        $('[rel=leavebandBtn]').click(function(){
            var url = $(this).attr('url');
            $('#leavebandLink').attr('href',url);
            showPromptsRemind('#leavebandBtn');
        });
        //编辑学号
        $('[rel=studentidInputEdit]').click(function(){ 
            var text =$.trim($(this).text());
            $(this).hide();
            $(this).siblings('input[type=text]').show();
            $(this).siblings('input[type=text]').val(text).focus();
        });

        $('[rel=fastInviteBtn]').click(function(){ 
            var url ='<?php echo Yii::app()->createUrl('/ajax/Checksendsms?cid='.$class->cid."&type=0&userid=".Yii::app()->user->id);?>';
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
            if (event.keyCode == 13){ 
                var that=this;
                var stIdV =$(this).val(),userId =$(this).attr('userid'),cid=$(this).attr("cid"),oldstudentid=$(this).attr('oldvalue');
                var url ='<?php echo Yii::app()->createUrl('/class/updatestudentid');?>?ver=<?php echo rand(0,9999);?>';
                if(stIdV!=oldstudentid){ 
                    $.ajax({  
                       url:url,
                       type : 'POST',
                       data : {studentid:stIdV,userid:userId,cid:cid},
                       dataType : 'json',  
                       contentType : 'application/x-www-form-urlencoded',  
                       async : false,  
                       success : function(mydata) {
                           if(mydata.status){
                        	   $(that).siblings('[rel=studentidInputEdit]').text(stIdV).show();
                               $(that).val(stIdV).hide();
                               $(that).attr("oldvalue",stIdV);
                           }else{
                               alert("系统繁忙，请稍后再试");
                           }                           
                       },  
                       error : function() { 
                           str = "系统繁忙，请稍后再试";
                       }  
                    }); 
                }
            }else{
                $(that).siblings('[rel=studentidInputEdit]').show();
                $(that).hide();
            }  
        });
        $('[rel=editInput]').focusout(function(){ 
                var that=this;
                var stIdV =$(this).val(),userId =$(this).attr('userid'),cid=$(this).attr("cid"),oldstudentid=$(this).attr('oldvalue');
                var url ='<?php echo Yii::app()->createUrl('/class/updatestudentid');?>?ver=<?php echo rand(0,9999);?>';
                if(stIdV!=oldstudentid){
                $.ajax({  
                   url:url,
                   type : 'POST',
                   data : {studentid:stIdV,userid:userId,cid:cid},
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
                       str = "系统繁忙，请稍后再试";
                   }  
               }); 
            }else{
                $(that).siblings('[rel=studentidInputEdit]').show();
                $(that).hide();
            }  
        });
        // 邀请 
        $('#inviteBtn').click(function(){  
            var encodeCid = $(this).attr('ecid');
            location.href="<?php echo Yii::app()->createUrl('/class/inviteclassmates?cid=');?>"+encodeCid+"&ty=2";
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
                    data:{cid:cid,ty:2},
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
//         //添加班主任
//        $('#addStudentBtn').click(function(){
//            var name = $.trim($('#teacherName').val()),mobile = $.trim($('#teacherMobile').val());
//            if(name==""){
//                $('.errorTip').text('老师姓名不能为空');
//            }else{
//                if(mobile==""){
//                    $('.errorTip').text('老师手机不能为空');
//                }
//            }
//        });
         //删除操作
        $('[rel=dele]').click(function(){
            var url = $(this).data('href');
            $('#deleLink').attr('href',url);
            showPromptsRemind('#remindBox');
        });
        //显示设置弹框
        $('[rel=updateLinkBtn]').click(function(e){
            clickTarget('[rel=updateLinkBtn]','.courseBox');
            $('.courseBox').hide();
            var hst = '25px';
            var boxs =$(this).siblings('.courseBox');
            if(boxs.height()>150){
                hst =-(boxs.height()/2)+'px';
                boxs.css({right:'120px'});
            }else{
                boxs.css({right:'-150px'});
            }
            boxs.css({top:hst});
            boxs.show();
        });
        function ajaxUpdate(url){
            $.ajax({
                url:url,
                type : 'POST',
                dataType : 'text',
                contentType : 'application/x-www-form-urlencoded',
                async : false,
                success : function(mydata) {
                    var show_data =mydata;

                },
                error : function() {
                        // alert("calc failed");
                }
            });
        }
        //设置课程
        $('[rel=updateLink]').click(function(){
            var url = $(this).data("url");
            var type = $(this).data("type");
            if(parseInt(type)==0){
                ajaxUpdate(url);
            }
            $(this).parents('.courseBox').hide();
        });
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
    
    var shareUrl = '<?php echo Yii::app()->createAbsoluteUrl('mobile/classinv', array('classid'=>$class->cid,'uid'=>Yii::app()->user->id,'role'=>'1'));?>';
    var bdTexts = '<?php echo $class->name ? $class->name : '';?>的老师家长，快到班里来~';
    var bdDescs =  '新学期作业、通知从这里发送、接收。大家尽快加一下班哦~~';
    var bdPic = '<?php echo $domain = Yii::app()->request->hostInfo; ?>';
    var type="<?php echo $isMaster?1:0;?>";
    ShareClass.int(shareUrl,bdTexts,bdDescs,bdPic);
</script>
<style>
    #messageBox{ font-size: 18px;  margin: 0px auto; position:absolute; right: 40%; bottom:20px; display: none; z-index: 10000; border-radius: 5px;}
    #messageBox .messageType{ padding:8px 15px; line-height: 30px; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;}
    #messageBox .success{  border: 1px solid #fbeed5; background-color: #e95b5f; color: #fbe4e5; }
    #messageBox .error{border: 1px solid #eed3d7; background-color: #e95b5f; color: #fbe4e5; }
   // #message .messageType span{  float: left;}
</style>
<div id="messageBox"> 
    <div class="messageType success"><span id="icon-11">✔</span>&nbsp;&nbsp;不存在未使用用户，未发送邀请</div>
</div> 
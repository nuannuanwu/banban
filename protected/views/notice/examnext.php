<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/send.css'); ?>">
<style>
    #examcid {color: #999;}
    #examcid option {color: #000;}
</style>
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox"> 
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
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/sendexam');?>" class="focus" noticetype="<?php echo Constant::NOTICE_TYPE_3;?>">
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
                        <?php $userinfo=Yii::app()->user->getInstance();?>
                        <?php if($userinfo&&$userinfo->teacherauth==2):?>
                            <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/schoolnotice');?>"  noticetype="<?php echo Constant::NOTICE_TYPE_5;?>">
                        <?php else:?>
                            <a rel="teacherauthBtn" href="javascript:;" onclick="showPromptPush('#teacherauthBox')" >
                        <?php endif;?> 
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app6.png"/></span>
                            <span class="send-info applicationTitle">紧急通知</span>
                            <span class="send-info applicationInfo">发送紧急短信通知</span>
                            <!--<span class="navIco"></span>-->
                        </a>
                    </div>
                </li> 
            </ul>
        </div>
        <div class="box" style="max-width:860px; min-height: 720px;">
            <form class="formBox" id="form1" method="post" action=""> 
            	<div class="examPvbox"> 
            		<div class="title">
                        <h1>发布成功</h1>
                        <div class="c_o" >已给<?php echo $num;?>名学生成功发布成绩</div>
                    </div> 
                    <?php if(is_array($unbindstudents)&&count($unbindstudents)):?>

                    <div class="tableTitle">以下学生尚未安装激活“班班手机客户端App”，不能及时查看成绩，提醒一下他们吧！</div>
            		<table id="suListBox" class="table table-bordered tableC">
            			<thead>
            				<tr>
	            				<th>姓名</th>
                                <?php foreach($header as $head):?>
	            				<th><?php echo $head;?></th>
                                <?php endforeach?>

            				</tr>
            			</thead>
            			<tbody>
                        <?php foreach($unbindstudents as $val):?>
            				<tr>
            					<td><?php echo $val['name'];?></td>
                                <?php if(is_array($val['score'])&&count($val['score'])):?>
                                <?php foreach($val['score'] as $kk=>$vv):?>
            					<td><?php echo $vv;?></td>
                                <?php endforeach;?>
                                <?php endif;?>
            				</tr>
                        <?php endforeach;?>
            			</tbody>
            		</table> 
                    <!-- <input type="submit" class="btn btn-orange" style="width:100px;" value=" 发 布 ">  -->
                    <a href="javascript:;" class="btn btn-orange" rel="fastInviteBtn" >一键短信提醒</a>
                    <?php endif;?>
                    
            	</div>
                <?php if(is_array($notmatchdata)&&count($notmatchdata)):?>
            	<div class="examPvbox"> 
            		<div class="tableTitle">以下学生尚未加入班级，无法接收成绩，请将他们加入班级吧！</div>
            		<table id="suListBox" class="table table-bordered tableC">
            			<thead>
            				<tr>
	            				<th>姓名</th>
                                <?php foreach($header as $head):?>
                                    <th><?php echo $head;?></th>
                                <?php endforeach?>
            				</tr>
            			</thead>
            			<tbody>
                        <?php foreach($notmatchdata as $val):?>
            				<tr>
            					<td>
            					    <?php echo $val['name'];?>
            					</td>
                                <?php if(is_array($val['score'])&&count($val['score'])):?>
                                    <?php foreach($val['score'] as $kk=>$vv):?>
                                        <td><?php echo $vv;?></td>
                                    <?php endforeach;?>
                                <?php endif;?>
            				</tr>
                            <?php endforeach;?>
            			</tbody>
            		</table>
                    <a href="<?php echo Yii::app()->createUrl('/class/supload?cid='.$cid);?>" class="btn btn-orange">一键导入学生</a>
                    <?php endif;?>
            	</div> 
            </form>
        </div>
    </div>
</div>
<div id="teacherauthBox" class="popupBox">
    <div class="header">提示<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#teacherauthBox')" > </a></div>
    <div class="remindInfo" >
        <div  class="centent" style="color: #000000;">只有通过“教师认证”，才能使用“紧急通知”功能。请先在班班手机客户端上申请“教师认证”。</div>
    </div>
    <div class="popupBtn">
        <a  href="javascript:void(0);" onclick="hidePormptMaskWeb('#teacherauthBox')" class="btn btn-orange">确 定</a>
    </div>
</div>
<div id="inviteRimrdBox" class="popupBox"> 
    <div class="remindInfo" >
        <div id="invitR" class="centent" style="color: #000000;"> </div>
    </div>
    <div class="popupBtn">
        <a  href="javascript:void(0);" onclick="hidePormptMaskWeb('#inviteRimrdBox')" class="btn btn-orange">确 定</a>
    </div>
</div>
<!--这个是点击一键邀请　-->
<div id="fastInviteBox" class="popupBox" style=" width: 500px;">
    <div class="header">一键短信提醒 <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#fastInviteBox')" class="close"> </a></div>
     <div class="remindInfo"> 
         
        <div id="remindTexts" class="centent" style="text-indent: 0em;padding: 10px; min-height:150px;">
            <p style="color:#f59201; text-align: center; ">对尚未安装激活“班班手机客户端APP”的学生发送短信提醒。</p>
            <div style="position: relative; padding-left: 80px; margin-top: 10px;">
                <b style=" display: block; position: absolute; left: 0px; top:0; zoom: 1;">短信内容：</b> 
                家长你好：我是<?php echo $class->name;?>的班主任<?php echo $userinfo->name;?>老师。有您的孩子的考试成绩已发给您，请您尽快登录班班手机应用查看。今后的班级通知、
                家庭作业、考试成绩...都会从这里发给您。您的登陆账号：xxxxxxx，密码：xxxxxx。若你还未未下载班班，下载地址：<?php echo SITE_APP_DOWNLOAD_SHORT_URL;?>。客服电话：400 101 3838。
            </div>
         </div> 
    </div>
    <div class="popupBtn"> 
        <a href1="javascript:void(0);" id="sendinvite" tid="0" cid="<?php  echo $class?$class->cid:0;?>" shref="<?php echo Yii::app()->createUrl('class/sendpwd?cid='.$cid.'&import=2&mobiles='.$mobiles.'&type=0&ajax=1&sendexam=1');?>" class="btn btn-orange">发送提醒</a>&nbsp;&nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#fastInviteBox')" class="btn btn-default">关闭</a>
        
    </div>
</div>

<div id="hasesendInviteBox" class="popupBox" style=" width: 500px;height:300px;">
    <div class="header">提示 <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#hasesendInviteBox')" class="close"> </a></div>
    <div class="remindInfo">
        <div id="remindTexts" class="centent" style="text-indent: 0em;padding: 10px; min-height:150px;">
            <p style="padding-left:20px; ">你已经发送过邀请了。</p>
        </div>
    </div>
    <div class="popupBtn">
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#hasesendInviteBox')" class="btn btn-default">我知道了</a>

    </div>
</div>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/My97DatePicker/WdatePicker.js'); ?>" type="text/javascript"></script>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/api/plupload-2.1.2/js/plupload.full.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        //$('#examcid').children().css({color : "#000"});
        $('[rel=fastInviteBtn]').click(function(){
            var url='<?php echo Yii::app()->createUrl("/notice/invite?cid=".$class->cid);?>';
            $.getJSON(url,{},function(data){
                if(data&&data.status=='1'){
                    showPromptsRemind('#hasesendInviteBox');
                }else{
                    showPromptsRemind('#fastInviteBox');
                }
            })

        });
        $("#sendinvite").click(function(){
            var url = $(this).attr("shref");
            $.getJSON(url,function(data){
                if(data){

                    hidePormptMaskWeb("#fastInviteBox");
                   // var total=data.total?data.total:0;
                    //显示一下邀请成功,“已成功邀请以上同学家长”
                    var msg=data.status?'已成功邀请以上同学家长':'邀请失败，请重试';
                     $('#invitR').html(msg);
                     showPromptsRemind('#inviteRimrdBox'); 
                }
            })
        })
    });
</script>

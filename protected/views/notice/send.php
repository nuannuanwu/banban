<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/send.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox"> 
        <div class="senNavbox">
            <ul class="applicationList bBttomT">
               <li>
                    <div class="applicationItme">  
                        <a rel="noticetypeBtn" href="javascript:;" class="focus"  noticetype="<?php echo Constant::NOTICE_TYPE_1;?>">
                            <span class="fleft sendPic" ><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app1.png"/></span>
                            <span class="send-info applicationTitle">布置作业 </span>
                            <span class="send-info applicationInfo">给学生布置作业</span>
                            <!--<span class="navIco"></span>-->
                        </a> 
                    </div>
                </li>
                <li>
                    <div class="applicationItme">  
                        <a rel="noticetypeBtn" href="javascript:;" noticetype="<?php echo Constant::NOTICE_TYPE_2;?>"> 
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app2.png"/></span>
                            <span class="send-info applicationTitle">通知家长 </span>
                            <span class="send-info applicationInfo">给家长发送通知</span>
                            <!--<span class="navIco"></span>-->
                        </a>
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <a rel="noticetypeBtn" href="javascript:;" noticetype="<?php echo Constant::NOTICE_TYPE_3;?>">
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
                        <?php $userinfo=Yii::app()->user->getInstance();?>
                        <?php if($userinfo&&$userinfo->teacherauth==2):?>
                            <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/schoolnotice');?>" class=" " noticetype="<?php echo Constant::NOTICE_TYPE_5;?>">
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
        <div class="box" style="max-width: 860px; min-height: 720px; *height: 520px;">
            <div class="formBox">
                <form id="formBoxRegister" action="" method="post">
                    <table class="tableForm">
                        <tbody>
                            <tr class="typeRemark" style="display: none;">
                               <td  style=" width: 58px; vertical-align: middle;" align="right">
                                    <span style="display: inline-block;width: 58px;"></span> 
                                </td>
                                <td style=" font-size: 14px;">
                                    <input id="radioId1" type="radio" name="evaluatetype" checked="checked" value="0">
                                    <label for="radioId1">表扬</label>
                                    
                                    <input id="radioId2" type="radio" name="evaluatetype" value="1">
                                    <label for="radioId2">批评</label>
                                </td>
                            </tr>
                            <tr>
                                <td style=" width: 58px; vertical-align: top; padding: 0;" align="right"></td> 
                                <td style=" padding: 0;">
                                    <div id="checkedCountBox"  class="colorP" style=" display:none; color: #f59201; font-size: 13px;">
                                        已选<span id="checkedCountC">0</span>个班级，<span id="checkedCountS">0</span>名学生
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td  style=" width: 58px; vertical-align: top;" align="right">
                                    <span style="display: inline-block;width: 58px; margin-top: 6px;">收件人：</span> 
                                </td>
                                <td width="99%" style=""> 
                                    <div class="inputUserBox" style=" ">
                                        <div id="toAreaCtrlBox"  class="schoolCheckUser"> 
                                            <ul id="selectCacheBox" class="checkedBox"> 
                                            </ul>
                                        </div>
                                        <a href="javascript:;" rel="addTtmeBtn"  class="btn btn-default addTtmeBtn"><em></em></a>
                                    </div>
                                   
                                </td>
                            </tr>
                            <tr class="errorTip">
                                <td>
                                    <span style="display: inline-block;width: 58px;"></span>
                                </td>
                                <td> 
                                    <div class="red selectUserTip"></div>
                                </td>
                            </tr>
                            <tr>
                                <td style=" vertical-align: top; padding-bottom: 0;" align="right">
                                    <span style=" display: inline-block; margin-top: 5px; padding-top: 20px;">内　容：</span>
                                </td>
                                <td style="padding-bottom: 0;">
                                    <div class="pReceiver" style="display: none;">
                                        家长称谓：XXX的家长，您好。
                                        <input type="hidden" name="receivertitle" value="xxx的家长，您好。"/>
                                    </div>
                                    <div class="inputBox">
                                        <textarea id="textTareaCentent" name="content" placeholder="请在这里填写发送内容" style=" width: 100%; *width:99%; line-height: 20px; height: 120px; border:1px solid #aaa; border-radius: 3px; padding: 5px; *padding: 5px 2px;"><?php echo $noticeinfo_content?$noticeinfo_content:'';?></textarea>
                                    </div>
                                    <div class="tReceiverBox" style="margin-top:10px;">
                                        <div style="float: right;"><?php echo $userinfo?$userinfo->name:'';?>老师</div>
                                        <div style=" float: right;display:none;">
                                            <span>老师签名：</span>
                                           <!-- <input type="hidden" name="sendertitle" value="<?php echo $myusesign;?>"/>-->

                                        </div>
                                        <div class="red textareaErrorTip" style=" margin-right: 240px;"> 
                                        </div>
                                    </div> 
                                </td>
                            </tr> 
                            <!--<tr> <td></td> <td> <div> <input id="cOneself" type="checkbox" name="sendself"><label for="cOneself">将自己加为收件人</label> </div> </td>  </tr>-->
                            <tr>
                                <td style="padding: 0;"> 
                                </td>
                                <td style="padding: 0;">
                                    <div class=" ">
                                        <a href="javascript:void(0)" id="send" tip="0" class="btn btn-orange">立刻发送</a>
                                        <!--<a href="" class="btn btn-default">定时发送</a>-->
                                        <input type="hidden" name="noticetype" value="<?php echo Constant::NOTICE_TYPE_1;?>"/><!-- 1布置作业　,2--通知家长,4--在校表现-->
                                        <input type="hidden" name="receivename" value="一班"/><!--表扬 or批评-->
                                        <!--
                                        <input type="hidden"  value="32701-1-681001" name="Group[uid][]"/>
                                        <input type="hidden"  value="高101" name="receivename"/>
                                        <input type="hidden"  value="32701" name="sid"/>
                                        -->
    <!--                                        <input type="submit" class="btn btn-orange" value=" 立刻发送 ">
                                        <input type="submit" class="btn btn-default" value=" 定时发送 ">-->
                                        <span id="upFileLoading" class="Validform_checktip Validform_loading" style="display: none;" > 正在发送中，请稍等...</span>
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
<div id="viewPopupBox">
    <div id="addItmePopupBox" class="popupBox" style="width: 270px; border:1px solid #c1c0b9;">
        <div class="opupBoxTile">添加签名</div>
        <!--<div class="header">更换手机绑定<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#addItmePopupBox')" > </a></div>-->
        <div class="remindInfo  setTime" style=" padding:15px 20px;" > 
            <input id="signInput" class="inputText" style="width: 100%;" type="text" value="" > 
        </div>
        <div class="popupBtn" style="text-align: center;">
            <a id="addSignBtn" href="javascript:void(0);"  class="btn btn-orange" data-val="">完　成</a>
            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#addItmePopupBox')" class="btn btn-default">取　消</a>
        </div>
    </div>
    <div id="isLeavePopupBox" class="popupBox" style="width: 428px; height: 260px;"> 
        <div class="header">确认导航<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#isLeavePopupBox')" > </a></div>
        <div class="remindInfo  setTime" style=" padding:60px 40px;" > 
            提示：未保存的内容将会丢失。确定要离开此页吗？
        </div>
        <div class="popupBtn" style="text-align: center;">
            <a id="" href="javascript:void(0);"  class="btn btn-orange" data-val="">确　定</a>
            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#isLeavePopupBox')" class="btn btn-default">取　消</a>
        </div>
    </div>
    <div id="selectPopupBox" class="popupBox" style="width: 600px; min-height: 300px; position: absolute; "> 
        <div class="header">选择收件人<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#selectPopupBox')" > </a></div>
        <div class="box" style=" padding: 0;">
            <div class="selectTableBox" style=" position: relative;">
                <input id="searchInput" placeholder="输入学生姓名查找" class="select" type="text" style=" width: 100%; " />
                <span class="searchpic"></span>
            </div> 
            <div class="schoolClassBox" style="max-height:360px; overflow-x: hidden; overflow-y: auto; margin-bottom: 20px; padding: 5px 15px 15px 15px; "> 
                <div class="bBttomT" style=" padding: 10px 5px;">
                    <input rel="checkedAllBtn" id="checkedAllInputBtn" tip="0" type="checkbox" >
                    <label class="checkedClassAll checkedOff" tip="0" rel="checkedAllBtn" for="checkedAllInputBtn" style=" cursor: pointer; color: #f59201;">全部选择<span style=" color: #999999;">（点击班级名称，展开学生名单）</span></label> 
                    <!--<a rel="checkedAllBtn" tip="0"   href="javascript:;">全部选择</a>
                    --> 
                </div>
                <div id="schoolClassBox_personage" class="schoolClassListBox" >
                    <?php if(is_array($cids)&&count($cids)):?>
                    <?php $i=0; foreach($cids as $val):?>
                    <div rel="removeListClass" id="schoolClassBox_personage_<?php echo $val['sid'];?>_<?php echo $val['cid'];?>" class="schoolItmeBox" <?php if($i!=0) echo 'style="display:none1;"';?> >
                        <div id="classUser_<?php echo $val['sid'];?>_<?php echo $val['cid'];?>" sid="<?php echo $val['sid'];?>" cid="<?php echo $val['cid'];?>" class="classUserBox">
                            <div class="checkedClassTitle"> 
                                <input rel="checkBoxAll" sid="<?php echo $val['sid'];?>" cid="<?php echo $val['cid'];?>" cname="<?php echo $val['classname'].'（'.$val['schoolname'].'）';?>" id="all_<?php echo $val['sid'];?>_<?php echo $val['cid'];?>" type="checkbox" >
                                <label class="checkedClassAll checkedOff" tip="0" rel="checkBoxAll" for="_all_<?php echo $val['sid'];?>_<?php echo $val['cid'];?>"> <?php echo $val['classname'];?>
                                    <span>（<?php echo $val['schoolname']?$val['schoolname']:'未知学校';?>）</span>
                                </label> 
                            </div>
                            <ul id="classUserListBox_<?php echo $val['sid'];?>_<?php echo $val['cid'];?>" class="userBoxUl userItmeBox"  style="display:none;">
                                <?php if(is_array($val['students'])&&count($val['students'])): $count=count($val['students']); foreach($val['students'] as $person):?>
                                <li>
                                    <a tip="0" id="user_<?php echo $val['sid'];?>_<?php echo $val['cid'];?>_<?php echo $person['student'];?>" class="userItme" href="javascript:;" cname="<?php echo $val['name'];?>" tpyid="0"  ulen="<?php echo$count;?>" sid="<?php echo $val['sid'];?>" cid="<?php echo $val['cid'];?>" userid="<?php echo $person['student'];?>" uname="<?php echo $person['name'];?>">
                                        <?php echo $person['name'];?><span></span>
                                    </a>
                                </li>
                                <?php endforeach;
                                else:?>
                                    <li><span style=" margin: 10px 0; color: #999999;">暂无学生</span><li>
                                <?php endif;?>
                            </ul>
                        </div>


                    </div>
                    <?php $i++; endforeach;?>
                    <?php else:?>
                        暂无班级
                    <?php endif;?>
                </div> 
            </div>
        </div>
        <div class="popupBtn" style="text-align: center;">
            <a id="saveMemberBtn" href="javascript:void(0);"  class="btn btn-orange">确　定</a>
            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#selectPopupBox')" class="btn btn-default">取　消</a>
        </div>
    </div>
</div>
<div id="disbandBox" class="popupBox">
    <div class="remindInfo">
        <div id="remindText" class="centent">最多只能添加5个自定义签名!</div>
    </div>
    <div class="popupBtn">
        <a id="disbandLink" href="javascript:void(0);" onclick="hidePormptMaskWeb('#disbandBox')" class="btn btn-orange">确 定</a>
    </div>
</div>
<div id="tipBox" class="popupBox" style=" font-size:14px; ">
    <div class="header">兑奖提示<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#tipBox')" > </a></div>
    <div class="remindInfo  setTime" style=" padding:30px 20px;" > 
        恭喜您！<br/>
        您的《注册建班大礼包》已达到兑奖条件！请立刻兑换。<br/>
        或忽略提示，自行打开“我的礼包”中查看详情及兑换。<br/>
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a id="addSignBtn" href="<?php echo Yii::app()->createUrl('gift/index');?>"  class="btn btn-orange" data-val="">立即兑换</a>
        <a href="javascript:void(0);"  class="btn btn-default" id="ignoreTip">忽略提示</a>
    </div>
</div>
<div id="realNameBox" class="popupBox" style=" font-size:14px; ">
    <div class="header">设置真实姓名<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#realNameBox')" > </a></div>
    <div class="remindInfo  setTime" style=" padding:30px 20px;" > 
       作为班主任/任课老师，需要您先设置真实姓名，方便与学生家长沟通。
       <br/>
       姓名：<input type="text" name="realName" id="realName" value="输入真实姓名"/>
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a id="addSignBtn" href="#"  class="btn btn-orange" data-val="">下一步</a>
    </div>
</div>
<div id="teacherauthBox" class="popupBox">
    <div class="header">提示<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#teacherauthBox')" > </a></div>
    <div class="remindInfo">
        <div class="centent" style="color: #000000;">只有通过“教师认证”，才能使用“紧急通知”功能。请先在班班手机客户端上申请“教师认证”。</div>
    </div>
    <div class="popupBtn">
        <a  href="javascript:void(0);" onclick="hidePormptMaskWeb('#teacherauthBox')" class="btn btn-orange">确 定</a>
    </div>
</div>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
    
    <?php ///if(strpos('tmp'.Yii::app()->user->getRealName(), '用户') > 0):?>
        <script type="text/javascript">
         //showPromptPush('#realNameBox');
        </script> 
    <?php //endif;?>
<script type="text/javascript"> 
    $(function(){
        var evalute="<?php echo $evalute;?>";
        $("input[name=evaluatetype]").each(function(i,index){
            if($(index).val()==evalute){
                $(index).attr("checked",true);
            }
        })
        $('#textTareaCentent').focus(function(){
            $('.textareaErrorTip').text('');
        });
        $("#send").click(function(){
            var len = $('#selectCacheBox').find('li').length;
            var conten = $.trim($("#textTareaCentent").val());
            var tip = $(this).attr('tip');
            if(tip=="0"){ 
                if(len>0){
                    if(conten==""){
                        $('.textareaErrorTip').text('请输入内容');
                    }else{
                        if(conten.length>0&&conten.length<=1000){
                            $('#upFileLoading').show();
                            $(this).attr('tip','1');
                            $(this).addClass('btn-default').removeClass('btn-orange');
                            $("#formBoxRegister").submit();
                        }else{
                            $('.textareaErrorTip').text('内容不能超过1000个字');
                        } 
                    }
                }else{
                    if(conten==""){
                        $('.textareaErrorTip').text('请输入内容');
                    }
                    $('.selectUserTip').text('请添加收件人');
                }
            }
            
        });
        //选择消息类别
        $("[rel=noticetypeBtn]").on("click",function(){ 
            var noticetype=$(this).attr("noticetype");
            if(parseInt(noticetype)==3){
                $('.typeRemark').show()
            }else{
                $('.typeRemark').hide();
            }
            $(this).parents('ul.applicationList').find('a').removeClass('focus');
            $(this).addClass('focus');
            $("input[name=noticetype]").val(noticetype);
        });
        var noticetype="<?php echo $noticetype;?>";
        if(noticetype==1||noticetype==2||noticetype==3){
            $("a[noticetype="+noticetype+"]").click();
        }

        //添加签名判断
        $(document).on('click','[rel=addItmeBtn]',function(){
            var len = $(this).parents('ul.sOptionList').find('li').length; 
            if(len<8){
                showPromptPush('#addItmePopupBox');
            }else{
                showPromptPush('#disbandBox');
            }
            global.resizeH(); 
        });
        //添加签名
        $('#addSignBtn').click(function(){
            var sign = $.trim($('#signInput').val()); 
            if(sign!=''){
                var url="<?php echo Yii::app()->createUrl('sign/insert');?>";
                $.post(url,{name:sign},function(data){
                    if(data&&data.status=='1'){
                        var str = '<li><a rel="addOption" href="javascript:;"><input id="radio_'+data.id+'"  value="'+sign+'" sname="'+sign+'"  type="radio" name="radio"><label for="radio_'+data.id+'">'+sign+'</label><span rel="colseBtn" signs="'+data.id+'" class="icoBtn closeIco"></span></a></li>'
                        //$('[rel=addItmeBtn]').parent('li input').removeAttr("checked");
                        $('[rel=addItmeBtn]').parent('li').before(str);
                        //$('.signName').text(sign);
                        //$("input[name=sendertitle").val(sign);
                    }else{
                        alert('添加失败');
                    }
                },'json');
                hidePormptMaskWeb('#addItmePopupBox');
            }
        });
        
        //选择签名
        $(".sOptionBox").on('click','input',function(){
           var check ="checked";
           var name = $(this).attr('sname'); 
          // $('[rel=colseBtn]').addClass('closeIco');
           if(check =="checked"){
               $('.signName').text(name);
               $("input[name=sendertitle]").val(name);
               //$("ul.sOptionBox").hide();
              // $(this).parent('a').find('[rel=colseBtn]').removeClass('closeIco');
           }
        });
        //删除签名
        $(document).on('click','.closeIco',function(){
            var _this = $(this), url="<?php echo Yii::app()->createUrl('sign/del');?>";
            var id=parseInt($(this).attr("signs"));
            if(id>0){
                $.post(url,{id:id},function(data){
                    if(data&&data.status=='1'){
                        _this.parents('li').remove();
                        var first=$("input[name=radio]").eq(0).attr('sname');
                        $('.signName').text(first);
                        $("input[name=sendertitle]").val(first);
                    }
                },'json');
            }

        });
        
        //showPromptPush('#isLeavePopupBox');
//        $("[rel=addItmeBtn]").click(function(){  
//        });
        
        //弹框
        $('[rel=addTtmeBtn]').click(function(){
//            var box =$("#schoolClassBox_personage").find("a");
//            box.each(function(k,v){
//                var type = v.getAttribute('severtype');
//                var cid  = v.getAttribute('cid');
//                var sid  = v.getAttribute('sid');
//                 if(type=='1'){
//                    $(this).removeClass('checked');
//                    $(this).attr('tip','0'); 
//                 }
//                 if(type=='2'){ 
//                     $(this).addClass('checked');
//                     $(this).attr('tip','1'); 
//                 }
//                 v.setAttribute('severtype','0');
//                 $("#memberBoxId").find('a.checked').attr('tip','1');
//            });
//            var sid = $('#selectSchoolItme').find('option:selected').val();
//            $('#schoolClassBox_personage').find('input[severtype=1]').attr('severtype','1'); 
//            $('#schoolClassBox_personage').find('input[severtype=1]').removeAttr('checked');
            showPromptPush('#selectPopupBox'); 
            $('.selectUserTip').text('');//提醒
        });
        //选择类型
        $('[rel=selectSchool]').click(function(){
            $('[rel=selectSchool]').removeClass('focus');
            $(this).addClass('focus');
            var sid = $(this).attr('sid');
            var tip = $(this).attr('tip');
            $('.schoolClassListBox').hide();
            $('#schoolClassBox_'+sid).show();
            if(tip =='0'){
               //ajax请求
              $(this).attr('tip','1'); 
            } 
        });
        //选择学校
//        $('#selectSchoolItme').change(function(){
//            var sid = $(this).val();
//            $('.schoolItmeBox').hide(); 
//            $("#schoolClassBox_personage_"+sid).show();
//            var box =$("#schoolClassBox_personage_"+sid).find('a');
//            box.each(function(k,v){
//                var type = v.getAttribute('severtype');
//                //var id  =
//                 if(type=='1'){//没保存  取消
//                    $(this).removeClass('checked');
//                    $(this).attr('tip','0'); 
//                 }
//                 if(type=='2'){ //保存 选中
//                     $(this).addClass('checked');
//                     $(this).attr('tip','1'); 
//                 }
//                 v.setAttribute('severtype','0');//统一初始化
//                 $("#schoolClassBox_personage").find('a.checked').attr('tip','1');
//            });
//            $('input[rel=checkBoxAll]').removeAttr('checked');
//            $('[rel=checkedAllBtn]').attr('tip','0').removeAttr('checked');
//        });
        
        //展开班级
       $(document).on('click','.checkedClassAll',function(){
           var tip = $(this).attr('tip');
           if(tip=='0'){
               $(this).attr('tip','1');
               $(this).removeClass('checkedOff').addClass('checkedOn');
               $(this).parent('.checkedClassTitle').next('.userItmeBox').show();
           }else{
               $(this).attr('tip','0');
               $(this).removeClass('checkedOn').addClass('checkedOff');
               $(this).parent('.checkedClassTitle').next('.userItmeBox').hide();
           } 
       }); 
        //全部全选
        $(document).on('click','[rel=checkedAllBtn]',function(){
            var _this =$(this);
            var tip =_this.attr('tip');
            //var sid = $('#selectSchoolItme').val();
            var box = $('#schoolClassBox_personage');
            if(tip=='0'){
                $('[rel=checkedAllBtn]').attr({tip:'1',checked:'checked'});
                box.find('[rel=checkBoxAll]').attr('checked','checked');
                box.find('a.userItme[tip=0]').click(); 
            }else{
                $('[rel=checkedAllBtn]').attr('tip','0').removeAttr('checked');
                box.find('[rel=checkBoxAll]').removeAttr('checked');
                box.find('.userItme').removeClass('checked');  
                box.find('.userItme').attr('tip','0'); 
            } 
            
            
             
        });
        //选择人
        $(document).on('click','.userItme',function(){
            var _this =$(this);
            var tip =_this.attr('tip');
            var sid=_this.attr('sid'),cid=_this.attr('cid'),userid=_this.attr('userid'),ulen =_this.attr('ulen');
            //$('#userChecked_'+sid+'_'+cid+'_'+userid).remove(); 
            if(tip=='0'){
                if($("#checkboxs_"+sid+"_"+cid+'_'+userid).length>0){ //是否保存过
                    $(this).attr('severtype','0'); //保存过 
                }else{
                    $(this).attr('severtype','1'); //没保存过  
                }  
                _this.addClass('checked');
                _this.attr('tip','1');
            }else{
                if($("#checkboxs_"+sid+"_"+cid+'_'+userid).length>0){ //是否保存过
                    $(this).attr('severtype','2'); //保存过 
                }else{
                    $(this).attr('severtype','0'); //没保存过  
                }  
               _this.removeClass('checked');
                _this.attr('tip','0');
            } 
            var clssBox = $('#classUserListBox_'+sid+'_'+cid);
            var ckeckLen = clssBox.find('a[tip=1]').length;
            if(parseInt(ckeckLen)>=parseInt(ulen)){
                // clssBox.find('li.checkedItme').hide(); 
                //clssBox.find('li.className').find('.checkInfo').text('（全部）');
                $('#all_'+sid+'_'+cid).attr({checked:'checked',severtype:'1'});
            }else{
                //clssBox.find('li.checkedItme').show();
                //clssBox.find('li.className').find('.checkInfo').text('（部分）');
                $('#all_'+sid+'_'+cid).attr('severtype','0');
                $('#all_'+sid+'_'+cid).removeAttr('checked');
            }
            var schoolBox = $('#schoolClassBox_personage');
            var schoolckeckLen = schoolBox.find('a[tip=1]').length;
            var schoolaLen = schoolBox.find('a').length;
            if(parseInt(schoolckeckLen)>=parseInt(schoolaLen)){
                $('[rel=checkedAllBtn]').attr({tip:'1',checked:'checked'}); 
            }else{
                $('[rel=checkedAllBtn]').attr('tip','0').removeAttr('checked');
            }
            
        });
        //班级全选
        $('[rel=checkBoxAll]').change(function(){ 
            var _this =$(this); 
            var sid = _this.attr('sid'),cid = _this.attr('cid'),cname = _this.attr('cname'); 
            var cbox = $('#classUserListBox_'+sid+'_'+cid); 
            if(_this.attr('checked')=='checked'){ 
               // _this.parent().find('.checkInfo').text('（全选）'); 
                cbox.find('a.userItme[tip=0]').click(); 
            }else{
                cbox.find('.userItme').removeClass('checked'); 
               // _this.parent().find('.checkInfo').text('（部分选择）');
                cbox.find('.userItme').attr('tip','0');
                $('[rel=checkedAllBtn]').attr('tip','0').removeAttr('checked');
            } 
        }); 
        //删除已选
        $(document).on('click','.delBtn',function(){
            var _this =$(this).parent();
            var sid=_this.attr('sid'),cid=_this.attr('cid'),userid=_this.attr('userid');
            $('#user_'+sid+'_'+cid+'_'+userid).click();
            $('#user_'+sid+'_'+cid+'_'+userid).removeClass('checked').attr('tip','0');;
            _this.parent().remove(); 
            $('#all_'+sid+'_'+cid).removeAttr('checked');
            var box = $("#selectCacheBox"),asClass=[],userCount=0;
             box.find('a').each(function(k,v){ 
                 vcid = v.getAttribute('cid');
                 userCount++; 
                if(asClass.indexOf(vcid)<0){
                  asClass.push(vcid);
                } 
             });
            $('#checkedCountC').text(asClass.length);
            $('#checkedCountS').text(userCount);
            if(asClass.length>0){ 
                $('#checkedCountBox').show();
            }else{
                $('#checkedCountBox').hide();
            }
            
        }); 
        //保存选中
        $('#saveMemberBtn').live('click',function(){  
            $("#schoolClassBox_personage").find("a").attr('severType','0'); //个人
            $("#schoolClassBox_personage").find("li").find('a').attr('tip','0'); 
            $("#schoolClassBox_personage").find('a.checked').attr('tip','1');
            var str = '',userids=[],classCount =0,userCount = 0,aClass=[]; 
            $("#selectCacheBox").empty();
            var box = $("#selectCacheClass").html();
            var box = $('#schoolClassBox_personage');
            box.find('a[tip=1]').each(function(k,v){ 
                sid = v.getAttribute('sid');
                cid = v.getAttribute('cid');
                tpyid = v.getAttribute('tpyid');
                userid =v.getAttribute('userid');
                uname = v.getAttribute('uname');  
                str +='<li id="userChecked_'+sid+'_'+cid+'_'+userid+'" class="checkedItme"><a href="javascript:;" title="'+uname+'" sid="'+sid+'" cid="'+cid+'" userid="'+userid+'" uname="'+uname+'"><input style="display: none;" name="Group[uid][]" type="checkbox" checked="checked" value="'+sid+'_'+tpyid+'_'+userid+'_'+cid+'" ><span class="delBtn"></span><span class="text">'+uname+'</span></a></li>';
                userCount++;  
                if($.inArray(cid,aClass)<0){
                  aClass.push(cid);
                } 
            });
            
            box.find('input[rel=checkBoxAll]').attr('severType','0');
            $("#selectCacheBox").append(str); 
            $('#checkedCountC').text(aClass.length);
            $('#checkedCountS').text(userCount);
            if(aClass.length>0){ 
                $('#checkedCountBox').show();  
            }else{
                 $('#checkedCountBox').hide();  
            }
            
            hidePormptMaskWeb('#selectPopupBox');
            global.resizeH();  
        });
        
        //搜索操作
        $('#searchInput').bind('keypress',function(event){
            if(event.keyCode == "13") { 
                var sTxt = $.trim($('#searchInput').val()).toLowerCase();
                var arr = sTxt.replace(/\s+/g, ' ').split(' ');
                var box = $('#schoolClassBox_personage');
                var aItme = box.find('.userItme');
                var allItme = box.find('.checkedClassAll');
                $.each(allItme,function(k,v){ //关闭上一次打开的班级列表
                    if($(this).attr('tip')=='1'){
                        $(this).click(); 
                    } 
                });
                aItme.removeClass('searchB');//清除上一次搜索
                if(sTxt){ //判断有没有输入 
                    $.each(aItme,function(k,v){
                        var text =$.trim(v.getAttribute('uname')).toLowerCase(); 
                        for(var i=0;i<arr.length;i++) { 
                            if(text.search(arr[i])!=-1){//检测存不存在当前输入的学生姓名
                                $(this).addClass('searchB'); 
                                var upOn = $(this).parents('.schoolItmeBox').find('.checkedClassAll');
                                if(upOn.attr('tip')!='1'){
                                    upOn.click();
                                }  
                            }else{
                                //box.find('.checkedClassAll').click();
                            }
			} 
                    });
                }
            }
        }); 
        
    }); 
</script>

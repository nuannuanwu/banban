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
                        <a rel="noticetypeBtn" href="javascript:;" class="focus" noticetype="<?php echo Constant::NOTICE_TYPE_3;?>">
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
            <form class="formBox" id="form1" method="post" action="<?php echo Yii::app()->createUrl('/notice/sendexam');?>">
            	 <nav class="navMod navModDone" >
        			<a href="<?php echo Yii::app()->createUrl('/notice/sendexam');?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回上一步</a>
        		</nav>

            	<div class="examPvbox" style="margin-top: 30px;"> 
            		<div class="title">
            			<h1>成绩预览</h1>
            		</div>
            		<div class="tableTitle c_o">本次可正常发布成绩（<?php echo $successnum;?>名）
                        <?php  echo (empty($repeatfamily)&&empty($nomatchnames))?'<a id="slide_down" href="javascript:;" tip="0" class="upDownBtn"  rel="upDown">（点击收起）</a>':'<a id="slide_down" href="javascript:;" tip="1" class="upDownBtn downB" rel="upDown">（点击展开）</a>';?>
                    </div>
            		<table id="suListBox" class="table table-bordered tableC <?php  echo (empty($repeatfamily)&&empty($nomatchnames))?'':'hide';?>" >
            			<thead>
            				<tr>
	            				<th>姓名</th>
                                <?php foreach($header as $head):?>
	            				<th><?php echo $head;?></th>
                                <?php endforeach;?>
            				</tr>
            			</thead>
            			<tbody>
                           <?php foreach($data as $val):?>
                            <?php if(!array_key_exists($val['userid'],$repeatfamily)):?>
            				<tr>
            					<td><?php echo $val['name'];?></td>
                                <?php foreach($val['score'] as $k=>$v):?>
                                    <td>
                                        <div class="inputBox" > 
                                            <?php echo $v;?> 
                                            <input rel="editInput" name="Student[<?php echo $val['userid'];?>][<?php echo $k;?>]" userid="<?php echo $val['userid'];?>" style="display: none;  width: 100px;" type="text" class="medium" oldvalue="<?php echo $v;?>" value="<?php echo $v;?>" placeholder="请输入分数" >
                                        </div>
                                    </td>
                                <?php endforeach;?>
            				</tr>
                           <?php endif;?>
                            <?php endforeach;?>
            			</tbody>
            		</table>
            	</div> 
                <?php if($repeatfamily&&is_array($repeatfamily)&&count($repeatfamily)):?>
            	<div class="examPvbox"> 
            		<div class="tableTitle">以下学生在班级中有重名，为确保无误，可按实际情况直接在下方修改。否则将对重名学生发布相同成绩：</div>
            		<table id="repeatSuListBox" class="table table-bordered tableC">
            			<thead>
            				<tr>
	            				<th>姓名</th>
                                <?php foreach($header as $head):?>
                                    <th><?php echo $head;?></th>
                                <?php endforeach;?>
            				</tr>
            			</thead>
            			<tbody>
                           <?php foreach($repeatfamily as $userid=>$val):?>
            				<tr>
            					<td>
            						<span class="c_o"><?php echo $val['name'];?></span>
            						<p style="font-size: 12px;"><?php $famile=isset($repeatfamily[$userid])?$repeatfamily[$userid]:null; echo $famile?$famile['role']:'';?></p>
            					</td>
                               <?php if(is_array($val['score'])&&count($val['score'])):?>
                                   <?php $index=0;;?>
                                   <?php foreach($val['score'] as $kk=>$vv):?>
            					<td>
            						<div class="inputBox" >
                                        <div style=" display: inline-block; width: 60px;  height: 36px;  line-height: 36px; overflow: vertical-align: middle; hidden;text-overflow: ellipsis;  white-space: nowrap; cursor: pointer;word-break: break-all; border: 1px solid #d8d8d8;" rel="studentidInputEdit" >
                                             <?php echo $vv;?>
                                        </div> 
                                        <input rel="editInput" name="Student[<?php echo $userid;?>][<?php echo $kk;?>]" userid="<?php echo $userid;?>" style="display: none;  width: 60px;" type="text" class="medium" oldvalue="<?php echo $vv;?>" value="<?php echo $vv;?>" placeholder="请输入分数" >
                                    </div>
                                </td>
                                       <?php $index++;;?>
                                   <?php endforeach;?>
                               <?php endif;?>


            				</tr>
                            <?php endforeach;?>
            			</tbody>
            		</table>
            	</div>
                <?php endif;?>
                <?php if(count($nomatchnames)):?>
                <div class="examPvbox"> 
                    <div class="tableTitle">成绩中未包含以下学生，请检查成绩表格，并<b>“返回上一步”</b>，重新上传。否则将不对以下学生发布成绩（<?php echo count($nomatchnames);?>名）：
                        <div class="c_o"><?php echo implode('、',$nomatchnames);?></div>
                    </div>
                </div>
                <?php endif;?>
                <div class="examPvbox">
                	<div class="tableTitle">
                        <input type="hidden" name="cid" value="<?php echo $params['cid'];?>"/>
                        <input type="hidden" name="examtype" value="<?php echo $params['examtype'];?>"/>
                        <input type="hidden" name="examdate" value="<?php echo $params['examdate'];?>"/>
                        <input type="hidden" name="examsubject" value="<?php echo $params['examsubject'];?>"/>
                        <input type="hidden" name="examname" value="<?php echo $params['examname'];?>"/>
                		<!-- <input  type="submit" class="btn btn-orange" style="width:100px;" value=" 发 布 "> -->
                        <a href="javascript:;" id="submitBntform" class="btn btn-orange"> 发 布</a>
                	</div>
                </div>

            </form>
        </div>
    </div>
</div> 
<div id="templateReminBox" class="popupBox">
    <div class="header">提示<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#templateReminBox')" > </a></div>
    <div class="remindInfo" >
        <div class="centent" style="color: #000000;">
            重名学生有部分科目成绩未填写，请补充后再发布；
        </div>
    </div>
    <div class="popupBtn">
        <a id="downErorrBnt"  href="javascript:void(0);" onclick="hidePormptMaskWeb('#templateReminBox')" class="btn btn-orange">确定</a>
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
       
        Validform.int("#form1"); 
        $('a.[rel=upDown]').click(function(){
            var tip = $(this).attr('tip');
            if(tip=="0"){
                $(this).attr('tip',1);
                $(this).text('点击展开');
            }else{
                $(this).text('点击收起');
                $(this).attr('tip',0)
            }
        	$(this).toggleClass('downB'); 
        	$('#suListBox').toggleClass('hide');
        }); 
        // 显示效果
       $('[rel=studentidInputEdit]').hover(function(){ 
            $(this).addClass('bordBox');
        },function(){
            $(this).removeClass('bordBox');
        });
        //编辑科目
        $('[rel=studentidInputEdit]').click(function(){ 
            var text =$.trim($(this).text());
            if(text=="请输入分数"){
                text = '';
            }
            $(this).hide();
            $(this).siblings('input[type=text]').show();
            $(this).siblings('input[type=text]').val(text).focus();
        });
         
         
        $('[rel=editInput]').keydown(function(){  
            var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异 
            if (event.keyCode == 13){ 
                return  false;  
            }  
        });
        
        $('[rel=editInput]').focusout(function(){ 
            var that=this; 
            var stIdV =$(this).val(),oldstudentid= $(this).attr('oldvalue');  
            if(stIdV==""){
                stIdV ="请输入分数"
            }
            $(that).siblings('[rel=studentidInputEdit]').text(stIdV).show();
            $(that).hide();  
             
        });
   
    
        //发布成绩
        $('#submitBntform').click(function(){
            var box = $('#repeatSuListBox').find('input[rel=editInput]');
            var sizel = 0;
            box.each(function(v,e){
                var val = this.value; 
                if(val==''){ sizel = 1; }
            });
            if(sizel==0){
                $('#form1').submit();
            }else{
              showPromptPush('#templateReminBox');
              return;
            }

        });

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
</script>

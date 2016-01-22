<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班
        </div>
        <div class="box">
            <nav class="navMod">
                <a href="<?php echo Yii::app()->createUrl('class/index'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
                <a href="<?php echo Yii::app()->createUrl('class/classinfo',array('cid'=>$class->cid,'ac'=>'notmasterteachers'));?>" class="btn btn-default">班级属性</a>
                <div class="bdsharebuttonbox" style="display: inline-block; *display: inline;" data-tag="share_1">
                    
                    <a  href="javascript:;" style=" background-image: none;" rel="shareShow" tip="0" class="btn btn-default" data-cmd="sqq">分享班级信息</a>
                   
                </div>
                <a rel="disbandBtn" url="<?php echo Yii::app()->createUrl('class/leaveclass').'?cid='.$class->cid; ?>" href="javascript:;" class="btn btn-default">退出班级</a>
            </nav>
            <div class="classTitle"><?php echo $class->name; ?><span class="sName"> -- <?php echo $class?$class->tSchool->name:'';; ?></span></div>
            <div class="titleBox">
                <ul class="titleTable">
                    <li><a href="<?php echo Yii::app()->createUrl('/class/notmasterstudents/'.$class->cid);?>">学生</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/class/notmasterteachers/'.$class->cid);?>" class="focus">老师</a></li>
                </ul>
            </div>
            <div class="classMemberBox" >
                <table class="table">
                    <tbody>
                    <tr class="tableHead">
                        <th width="15%"><div style="text-align: left;">姓名</div></th>
                        <th width="12%"><div style="text-align: left; padding-left: 5px;">&nbsp;科目</div></th> 
                        <th width="15%">手机号码</th>
                        <th width="10%">使用状态</th>
                        <th width="20%">进班时间</th> 
                    </tr>
                    <?php if(count($data['datas'])): ?>
                        <?php foreach($data['datas'] as $member): ?>
                            <tr>
                                <td>
                                    <div style=" text-align: left;">
                                        <div  style=" padding-left: 5px; display: inline-block;" title="<?php echo $member['name']; ?>"><?php echo $member['name']; ?></div>
                                        <?php if($member['type']==1):?>
                                        （班主任）
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td style="text-align:left;">
                                    <div class="inputBox" >
                                    <?php if(Yii::app()->user->id == $member['userid']):?>
                                        <div style="float: left;width: 100px; height: 30px; line-height: 30px; overflow: hidden;text-overflow: ellipsis;  white-space: nowrap;cursor: pointer;word-break: break-all;" rel="studentidInputEdit" title="<?php echo $member['subject'];?>">
                                            &nbsp; <?php echo $member['subject'];?>
                                        </div>                                        
                                        <input rel="editInput"  maxlength="20"  cid="<?php echo $class->cid;?>" userid="<?php echo $member['userid'];?>" style="display: none; width: 100px;" type="text" class=" medium" oldvalue="<?php echo $member['subject'];?>" value="<?php echo $member['subject'];?>" placeholder="输入科目" ></div>
                                    <?php else:?>
                                    <div style="float: left;width: 100px; height: 30px; line-height: 30px; overflow: hidden;text-overflow: ellipsis;  white-space: nowrap;cursor: pointer;word-break: break-all;" title="<?php echo $member['subject'];?>">
                                         &nbsp; <?php echo $member['subject'];?>
                                    </div>
                                    <?php endif;?>
                                </td>
                                <td><?php echo $member['mobilephone']; ?></td>
                                <?php $appactive=$member['appactive'];$appstate=isset($member['client'])?$member['client']:0;
                                $stateclass1=$appactive?(!$appstate?"iphoneIco1":"iphoneIco"):"";
                                $statetitle1=$appactive?(!$appstate?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";

                                $webactive=$member['webactive'];$webstate=isset($member['web'])?$member['web']:0;
                                $stateclass2=$webactive?(!$webstate?"pcIco1":"pcIco"):"";
                                $statetitle2=$webactive?(!$webstate?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";
                                ?>
                                <td class="typeBox">
                                    <span class="iphoneGuradians <?php echo $stateclass2;?>" title="<?php echo $statetitle2;?>"></span>
                                    <span class="pcGuradians <?php echo $stateclass2;?>" title="<?php echo $statetitle2;?>"></span>
                                </td>
                                <td><?php echo date('Y/m/d',strtotime($member['creationtime'])); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="remindBox">
                            <td colspan="5" style=" padding: 0;">
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
            </div>
        </div>
    </div>
</div>
 
<div id="disbandBox" class="popupBox">
    <div class="remindInfo">
        <div id="remindText" class="centent">是否退出当前班级？</div>
    </div>
    <div class="popupBtn">
        <a id="disbandLink" href=""  class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#disbandBox')" class="btn btn-default">取 消</a>
    </div>
</div>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/shaerclass.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){ 
        //退出班级
        $('[rel=disbandBtn]').click(function(){
            var url = $(this).attr('url');
            $('#disbandLink').attr('href',url);
            showPromptsRemind('#disbandBox');
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
            $(this).hide();
            $(this).siblings('input[type=text]').show();
            $(this).siblings('input[type=text]').val(text).focus();
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
                               dataType : 'text',  
                               contentType : 'application/x-www-form-urlencoded',  
                               async : false,  
                               success : function(mydata) {
                                   $(that).siblings('[rel=studentidInputEdit]').text(stIdV).show();
                                   $(that).val(stIdV).hide();
                                   $(that).attr("oldvalue",stIdV);
                               },  
                               error : function() { 
                                   str = "系统繁忙，请稍后再试";
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
                               dataType : 'text',  
                               contentType : 'application/x-www-form-urlencoded',  
                               async : false,  
                               success : function(mydata) {
                                   $(that).siblings('[rel=studentidInputEdit]').text(stIdV).show();
                                   $(that).val(stIdV).hide();
                                   $(that).attr("oldvalue",stIdV);
                               },
                               error : function() { 
                                   str = "系统繁忙，请稍后再试";
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
    });
    var shareUrl = '<?php echo Yii::app()->createAbsoluteUrl('mobile/classintro', array('classid'=>$class->cid,'uid'=>Yii::app()->user->id,'role'=>'2'));?>';
    var bdTexts ='我加入了“<?php echo $class->name ? $class->name : '';?>”，欢迎您加入！';
    var bdDescs =  '为了更好的进行班级沟通，我在“班班”加入了我们的班级（<?php echo $class->name?$class->name:'';?>），班级代码为<?php echo $class->code ? $class->code : '';?>。班班是免费家校平台，方便我们班的家长老师快捷联络、收发孩子通知作业，注册后输入班级代码加入我们的班集体！我们都在等着你！';
    ShareClass.int(shareUrl,bdTexts,bdDescs);
    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班
        </div>
        <div class="box">
             <nav class="navMod">
                <a href="<?php echo Yii::app()->createUrl('class/index'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
                <a href="<?php echo Yii::app()->createUrl('class/classinfo',array('cid'=>$class->cid,'ac'=>'notmasterstudents'));?>" class="btn btn-default">班级属性</a>
                <div class="bdsharebuttonbox" style="display: inline-block; *display: inline;" data-tag="share_1">
                    
                    <a  href="javascript:;" style=" background-image: none;" rel="shareShow" tip="0" class="btn btn-default" data-cmd="sqq">分享班级信息</a>
                  
                </div>
                <a rel="disbandBtn" url="<?php echo Yii::app()->createUrl('class/leaveclass').'?cid='.$class->cid; ?>" href="javascript:;" class="btn btn-default">退出班级</a>
            </nav>
            <div class="classTitle"><?php echo $class->name; ?><span class="sName"> -- <?php echo $class?$class->tSchool->name:''; ?></span></div>
            <div class="titleBox">
                <ul class="titleTable">
                    <li><a href="<?php echo Yii::app()->createUrl('class/notmasterstudents/'.$class->cid);?>" class="focus">学生</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('class/notmasterteachers/'.$class->cid);?>">老师</a></li>
                </ul>
            </div>
            <div class="classMemberBox"> 
                <table class="table">
                    <tbody>
                    <tr class="tableHead">
                        <th width="12%"><div class="name">姓名</div></th>
                        <th width="16%"><div class="" style="width: 80px; text-align: left;" >学号</div></th>
                        <th width="15%"><div class="name " style="width: 100px; padding-left: 0px;">家长</div></th>
                        <th width="18%"> 使用状态</th>
                        <th width="12%">进班时间</th>
                    </tr>
                    <?php if(count($data['datas'])): ?>
                        <?php foreach($data['datas'] as $student): ?>
                            <tr rel="<?php $guradians= $student['guradians']; if(count($guradians)){echo $guradians[0]['mobile'];} ?>">
                                <td rel="<?php echo $student['id']; ?>"><div class="name" title="<?php echo $student['name']; ?>"><?php echo $student['name']; ?></div></td>
                                <td><div class="name" style="width: 80px;" ><?php echo $student['studentid']; ?></div></td>
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
                                                                <span style=" display: inline-block;text-overflow : ellipsis;white-space : nowrap;">
                                                                <?php if($vv==0) {echo $gur['role']?($gur['role']=='关注人'?'家长':$gur['role']):'家长';}else { echo $gur['role']=='家长'?'关注人':$gur['role'];}; ?></span>
                                                                    <span style=" display: inline-block; margin-right: 5px;">：<?php echo $gur['name']; ?></span>
                                                                    <span style=" display: inline-block; margin-right: 5px;">：<?php echo $gur['mobile']; ?></span>
                                                                    <?php $appactive=$gur['appactive'];$appstate=isset($gur['client'])?$gur['client']:0;
                                                                    $stateclass1=$appactive?(!$appstate?"iphoneIco1":"iphoneIco"):"";
                                                                    $statetitle1=$appactive?(!$appstate?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";

                                                                    $webactive=$gur['webactive'];$webstate=isset($gur['web'])?$gur['web']:0;
                                                                    $stateclass2=$webactive?(!$webstate?"pcIco1":"pcIco"):"";
                                                                    $statetitle2=$webactive?(!$webstate?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";
                                                                    ?>
                                                                    <span class="iphoneGuradians <?php echo $stateclass1;?> " title="<?php echo $statetitle1;?>">&nbsp;</span>
                                                                    <span class="pcGuradians <?php echo $stateclass2;?> " title="<?php echo $statetitle2;?>">&nbsp;</span>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                        <?php $role=isset($guradians[0]['role'])?$guradians[0]['role']:'家长';
                                        $role=($role=='关注人'?'家长':$role);
                                        $guradians0=isset($guradians[0])?$guradians[0]:null;
                                        ;?>
                                        <a href="javascript:void(0);" class="none" title="">
                                            <span style="margin-right:5px;"><?php echo $role;?>：</span>
                                            <span style=" display: inline-block; text-overflow : ellipsis;white-space : nowrap; margin-right:5px;"><?php echo $guradians0?$guradians0['name']:"ddss";?></span>
                                            （<?php echo isset($guradians[0]['mobile'])?$guradians[0]['mobile']:''; ?>）</a>
                                    </div>
                                </td>
                                <td class="typeBox">
                                    <?php $appactive=isset($guradians[0])?$guradians[0]['appactive']:0;
                                    $appstate=isset($guradians[0])?$guradians[0]['client']:0;
                                    $stateclass1=$appactive?(!$appstate?"iphoneIco1":"iphoneIco"):"";
                                    $statetitle1=$appactive?(!$appstate?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";

                                    $webactive=isset($guradians[0])?$guradians[0]['webactive']:0;$webstate=isset($guradians[0])?$guradians[0]['web']:0;
                                    $stateclass2=$webactive?(!$webstate?"pcIco1":"pcIco"):"";
                                    $statetitle2=$webactive?(!$webstate?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";
                                    ?>
                                    <span class="iphoneGuradians <?php echo $stateclass1;?> " title="<?php echo $statetitle1;?>">&nbsp;</span> &nbsp;
                                    <span class="pcGuradians <?php echo $stateclass2;?> " title="<?php echo $statetitle2;?>">&nbsp;</span>&nbsp;
                                </td>
                                <td><?php echo date('Y/m/d',strtotime($student['creationtime'])); ?></td> 
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
    <div class="header">退出班级<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#disbandBox')"> </a></div>
    <div class="remindInfo">
        <div id="remindText" class="centent">退出班级后，您将不能发送作业，通知等消息给该班级。</div>
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
        //显示设置弹框
        $('[rel=updateLinkBtn]').click(function(e){
            clickTarget('[rel=updateLinkBtn]','.courseBox');
            $('.courseBox').hide();
            var hst = '-5px';
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
         
    });
     var shareUrl = '<?php echo Yii::app()->createAbsoluteUrl('mobile/classintro', array('classid'=>$class->cid,'uid'=>Yii::app()->user->id,'role'=>'2'));?>';
    var bdTexts ='我加入了“<?php echo $class->name ? $class->name : '';?>”，欢迎您加入！';
    var bdDescs =  '为了更好的进行班级沟通，我在“班班”加入了我们的班级（<?php echo $class->name?$class->name:'';?>），班级代码为<?php echo $class->code ? $class->code : '';?>。班班是免费家校平台，方便我们班的家长老师快捷联络、收发孩子通知作业，注册后输入班级代码加入我们的班集体！我们都在等着你！';
    ShareClass.int(shareUrl,bdTexts,bdDescs);
    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
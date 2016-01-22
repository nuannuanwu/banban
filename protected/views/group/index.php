<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/group.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT"> 
            <span class="icon icon7"></span>紧急通知 > 我的分组
        </div>
        <div class="box">
            <nav class="navMod"><!--家长不要显示创建班级按niu--> 
                 <a href="<?php echo Yii::app()->createUrl('notice/schoolnotice'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
                <a rel="addClass" href="<?php echo Yii::app()->createUrl('group/create')?>" class="btn btn-default">创建分组</a> 
            </nav>
            <div class="classBox"> 
                <div class="schoolItme"> 
                    <ul class="classListBox">
                        <?php if(is_array($groups)):?>
                        <?php foreach($groups as $val):?> 
                        <li> 
                            <a href="<?php if($userid==$val->creater) {$action="update";}else{ $action="view";} echo Yii::app()->createUrl('group/'.$action.'/'.$val->gid)?>" class="" sid="" cid="<?php echo $val->creater.':'.$userid;?>">
                                <?php if($userid==$val->creater):?> <em></em><?php endif;?>
                                <h3 class="name " title="<?php echo $val->name;?>"><?php echo $val->name;?></h3>
                                <p class="info" title="<?php echo $val->s?$val->s->name:'';?>">学校：<?php echo $val->s?$val->s->name:'';?></p>
                                <!--<p class="info">分组类型:：<?php echo $val->type==0?'学生组':'老师组';?></p>-->
                                <p class="info">人数：<?php echo GroupMember::getGroupMemberNum($val->gid);?>人</p> 
                            </a>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
             </div>
        </div> 
    </div>
</div>
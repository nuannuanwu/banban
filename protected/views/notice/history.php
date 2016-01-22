<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<style>
    .tableHead th{
        padding:8px 0!important;
    }
    
</style>
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon2"></span>已发送（<?php echo $count;?>条）
        </div>
        <div class="box">
            <div class="tabBox">
                <span>
                    <a href="" class="on">通知列表</a><a href="<?php echo Yii::app()->createUrl('/notice/smshistory');?>">短信列表</a>
                </span>
            </div>
            <div class="tableBox inbox">
                <table class="table" id="msgList">
                    <tr class="tableHead">
                        <th class="first"></th>
                        <th style="width:90%">
                            <table class="sub-table">
                                <tr class="tableHead">
                                    <th style="width:16%;">类型</th>
                                    <th>收件人</th>
                                    <th style="width:25%;">时间</th>
                                    <th style="width:12%;"><span style="cursor:pointer;" title="已读学生数 /总学生数。只要该学生有一个家长（或家属）已读消息，该学生即视为已读">已读</span></th>
                                </tr>
                            </table>
                        </th> 
                    </tr>
                    <?php if(!empty($data['model'])):?>
                    <?php foreach($data['model'] as $val):?>
                    <tr  class="msg-tr" style="cursor:pointer;"  data-href="<?php echo Yii::app()->createUrl('notice/historydetail/'.$val['noticeid']); ?>">
                        <td class="first">
                            <i class="<?php echo $val['showclass'];?>"></i>
                        </td>
                        <td style="padding:8px 0;">
                            <table class="sub-table" >
                                <td style="width:16%;" class="sub-first noRead" ><?php echo $val['typedesc'];?></td>

                                <td ><?php echo $val['receivename'];?></td>
                                <td style="width:25%;"><?php echo $val['showtime'];?></td>
                                <td style=" width:12%;">
                                    <span ><?php
                                        if(($val['noticetype']==1 ||$val['noticetype']==2||$val['noticetype']==3) &&$val['platform']!=0){
                                            echo $val['percent']."%";
                                        }else{
                                            echo '';
                                            }?>
                                    </span>
                                    </td>
                            </table>
                            <div class="summary">
                                    <a class="noRead">
                                    <?php echo strip_tags($val['content']);?>
                                    </a>
                            </div>
                        </td> 
                    </tr>
                    <?php endforeach;?>
                    <?php else:?>
                        <!-- 空数据区域 -->
                        <tr>
                            <td colspan="4">
                                <div class="tip">
                                    <p class="p-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tip.png" alt="" style="margin:50px 0 0;"></p>
                                    <p style="font-size:20px;color:#999;margin:10px 0 30px;">空空如也</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif;?>
                </table>
                <div id="page1" >
                    <?php
                    $this->widget('CLinkPager',array(
                            'header'=>'',
                            'firstPageLabel' => '首页',
                            'lastPageLabel' => '末页',
                            'prevPageLabel' => '<',
                            'nextPageLabel' => '>',
                            'pages' => $pages,
                            'maxButtonCount'=>5
                        )
                    );
                    ?>
				</div>
            </div>
        </div> 
    </div>
</div>
<script>
    var msgList=function(){
        var listBox=$('#msgList');
        listBox.on('click','.msg-tr',function(){
            var url=$(this).data('href');
            window.location=url;
        })
    };

    $(function(){
        msgList();
    })
</script>

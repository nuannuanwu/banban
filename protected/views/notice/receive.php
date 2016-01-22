<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<style>
    .tableHead th{
        padding:8px 0!important;
    }

</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon2"></span>收件箱（<?php echo $count;?>条）
        </div>
        <div class="box">
           <!--  <nav class="navMod">
                <a href=" " class="btn btn-default">删除</a>
                <a href=" " class="btn btn-default">全部清空</a>
                <a href=" " class="btn btn-default">转发</a>
            </nav> -->
            <div class="tableBox inbox">
                <table class="table" id="msgList" >
                    <tr class="tableHead">
                        <th class="first"></th>
                        <th style="width:90%;">
                            <table class="sub-table">
                                <tr class="tableHead">
                                    <th style="width:25%;">类型</th>
                                   <th>发件人</th>
                                    <!--<th style="width:29%;">收件人</th>-->
                                    <th style="width:20%;">时间</th>
                                </tr>
                            </table>
                        </th> 
                    </tr>
                    <?php if(!empty($data)):?>
                    <?php foreach($data as $val):?>
                    <tr class="msg-tr" style="cursor:pointer;"  data-href="<?php echo Yii::app()->createUrl('notice/receivedetail/'.$val['noticeid'].'?index='.$val['index'])."&targteid=".$val['targteid']; ?>">
                        <td class="first">
                            <i class="<?php echo $val['showclass'];?>"></i>
                        </td>
                        <td style="padding:8px 0;">
                            <table class="sub-table">
                                <tr class="<?php echo ($val["read"] == 1) ? 'read' : 'noRead'; ?>">
                                    <td style="width:25%;" class="<?php echo ($val["read"] == 1) ? 'noRead' : 'sub-first'; ?>"><?php echo $val['typedesc']; ?></td>
                                    <td style=" " class="<?php echo ($val["read"] == 1) ? 'read' : ''; ?>">
                                        <?php

                                            echo $val['sendertitle'];
                                        ?>
                                    </td>
                                    <!--
                                    <td style="width:29%;" class="<?php echo ($val["read"] == 1) ? 'read' : ''; ?>">
                                        <?php echo $val['receivertitle'];?>
                                       </td>
                                       -->
                                    <td style="width:20%;" class="<?php echo ($val["read"] == 1) ? 'read' : ''; ?>"><?php echo $val['showtime']; ?></td>
                                </tr>
                            </table>
                            <div class="summary">
                                <a <?php if($val["read"]==1) echo 'class="noRead"';?> >
                                    <?php echo  strip_tags($val['content']);?>
                                </a>
                            </div>
                        </td> 
                    </tr>
                    <?php endforeach;?>
                    <?php else:?>

                    <!-- 空数据区域 -->
                    <tr>
                        <td colspan="6">
                             <div class="tip">
                                <p class="p-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tip.png" alt="" style="margin:50px 0 0;"></p>
                                <p style="font-size:20px;color:#999;margin:10px 0 30px;">空空如也</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif;?>
                    <!-- 空数据区域 end-->

                </table>
                <div id="page1" >
                    <?php
                    if($pages){
                        //$pages['param']='2=2';
                        $this->widget('CLinkPager',array(
                            'header'=>'',
                            'firstPageLabel' => '首页',
                            'lastPageLabel' => '末页',
                            'prevPageLabel' => '<',
                            'nextPageLabel' => '>',
                            'pages' => $pages,
                            'maxButtonCount'=>5,

                        )
                        );
                    }                    
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
    }

    $(function(){
        msgList();
    })
</script>


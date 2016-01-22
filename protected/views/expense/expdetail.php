<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<style>
    #bdshare{
        display: inline-block;
       *display: inline;
        *_zoom: 1; 
        font-size: 0px;
        float:none!important;
        padding:0;
        z-index: 1;
        vertical-align:top;
    }
    .disnext{
        background:#adadad!important;
    }
    .disnext:hover,.disnext:focus{
        color:#8c8c8c!important;
        cursor:default;
    }
</style>
<div id="disbandBox" class="popupBox">
    <div class="header">提示<a id="remindCloseBtn" href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#disbandBox')"> </a></div>
    <div class="remindInfo">
        <div id="remindText" class="centent"><?php echo $transferCheck['msg']; ?></div>
    </div>
    <div class="popupBtn">
        <a id="remindCloseBtn1" href="javascript:;" onclick="hidePormptMaskWeb('#disbandBox')" class="btn btn-orange">我知道了</a>
    </div>
</div>

<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon3"></span>我的班班 > 班费
        </div>
        <div class="box" style="padding:15px 25px;">
            <nav class="navMod" style="margin-bottom: 20px;">
                <a href="<?php echo Yii::app()->createUrl('class/'.($from?$from:'students')).'/'.$class->cid; ?>/" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
                    <?php if($transferCheck['showbutton']):?> <!--是否是班主任判断，班主任显示转让，非班主任不显示转让按纽-->
                        <?php if($transferCheck['enable']):?>
                            <!--认证老师才能转出-->
                           <a id="rollOutBnt" href="javascript:;" class="btn btn-default">转出</a>
                        <?php else:?>
                            <!--不是认证老师费窗提示-->
                           <a id="transfer" href="javascript:;" class="btn btn-default">转出</a>
                        <?php endif;?>
                    <?php endif;?>
            </nav>
            <a class="ex-rule-link" href="<?php echo Yii::app()->createUrl('class/exprules/'.$class->cid, array('authority'=>$class->authority,'from'=>$from));?>">
                <i class="question-mark-icon"></i>班费规则
            </a>
            <div class="class-reward">
                 <ul class="list sub-list" >
                     <li class="list-li">
                         <div class="list-header <?php echo ($class->authority == 1 || $class->authority == 2) ? 'bg-blue' : ($class->authority == 3 ? 'bg-green' : ($class->authority == 4 ? 'bg-brown' : ''));?> clearfix"> <!--bg-green bg-brown 分别是家长 关注人 -->
                             <p class="class-name"><?php echo $class->name;?></p>
                             <p class="school-name"><?php echo $class->tSchool->name;?></p>
                         </div>
                         <div class="list-money">
                             <div class="cnt-box left">
                                 <p class="cnt-total"><?php printf('￥%0.2f',$feeInfo[0]['dBalance']);?></p>
                                 <p class="cnt-total-label">当前余额</p>
                             </div>
                             <div class="cnt-box right">
                                 <p class="cnt-ext">累计金额：<span><?php printf('￥%0.2f',$feeInfo[0]['dTotalIncome']);?></span></p>
                                 <p class="">今日赚取：<span><?php printf('￥%0.2f',$feeInfo[0]['dToday']);?></span></p>
                                 <p class="">历史最高：<span><?php printf('￥%0.2f',$feeInfo[0]['dMax']);?></span></p>
                             </div>
                         </div>
                         <?php if($isMaster):?>
                         <div class="class-icon class-icon-logo"></div>  <!--identity-->
                         <?php endif;?>
                     </li>
                 </ul>

                 <div class="rule reward-origin">
                    <div class="tit">班费流水</div>
                     <table class="table">
                            <tr class="tableHead">
                                <th style="width:20%;">姓名</th>
                                <th style="width:30%;">类型</th>
                                <th style="width:30%;">日期</th>
                                <th style="width:20%;">金额</th>
                            </tr>
                             <tbody  id="content" style="border-top:none;">
                             <?php if($lastOrderNum):?>
                            <?php foreach ($feedetail as $fee):?>                          
                            <tr>

                                <td><?php echo $fee['strName'];?></td>
                                <td>
                                    <?php 
                                        echo str_replace(array($fee['strName'],')','('),array('','',''),$fee['sEventName']);
                                        echo isset($fee['paydesc']) && $fee['paydesc'] ? '（' . $fee['paydesc'] . '）' : '';
                                    ?>
                                </td>
                                <td><?php echo date('Y/m/d',$fee['timestamp']);?></td>
                                <td>
                                    <?php if($fee['sEventID'] != ClassFeeEventID::EVENT_DEPOSIT&&$fee['sEventID'] != ClassFeeEventID::EVENT_SENDNOTICE&&$fee['sEventID'] != ClassFeeEventID::EVENT_MALL_CONSUME): ?>
                                        <span class="green">+ <?php printf('￥%0.2f',$fee['dValue']);?></span>
                                    <?php else:?>
                                        <span class="red">- <?php printf('￥%0.2f',$fee['dValue']);?></span>
                                    <?php endif;?>
                                    
                                </td>
                            </tr>                           
                            <?php endforeach;?>
                            <?php else:?>
                             <tr><td colspan="4" align="center">暂无数据，快去挣班费吧！</td></tr>
                            <?php endif;?>
                            </tbody>
                        </table>

                        <?php if(isset($feedetail) && $feedetail):?>
                        <div class="pages">
                            <a href="javascript:;" class="active" data-order="0" data-num="1" style="/*background:#ADADAD;*/">1</a>                 
                                    
                            <div style="text-align: center;margin-top:20px;">
                                <a style="border-radius:0;width:auto;height:auto;padding:6px 80px;line-height: normal;<?php if(!$showNext) echo 'display: none;';?>" href="javascript:;" id="nextbtn" data-nextnum="1" data-order="<?php echo $lastOrderNum;?>">下一页</a></div>
                        </div>
                        <?php endif;?>
                 </div>                  
            </div>              
        </div> 
        
    </div>
</div>
<input id="ispopup" type="hidden" value="<?php echo Yii::app()->request->getParam('popup');?>">
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //统计请求
        function transferPsst(){
            var url = '<?php echo Yii::app()->createUrl('temp/transclick')?>';
            $.post(url,{},function(data){ });
        }
        
        $('#transfer').on('click', function() {
            showPromptsRemind('#disbandBox');
            transferPsst();
        });

        var ispop = $('#ispopup').val();
        if(ispop=='popup'){ 
           var sHref  = '<?php echo Yii::app()->createUrl('expense/expdetail/'.$class->cid,array('authority'=> $class->authority,'from'=>$from)); ?>';
           $('#remindCloseBtn,#remindCloseBtn1').attr('href',sHref).removeAttr('onclick');
           showPromptsRemind('#disbandBox');
        }

        //
        $('#rollOutBnt').click(function(){
            var sUrl ='<?php echo Yii::app()->createUrl('expense/transfer', array('cid'=>$class->cid, 'authority'=> $class->authority));?>';
            transferPsst();
            window.location.href = sUrl; 
        });

        $(".pages").on('click','a',function(){
            var obj = $(this);
            var order = obj.data('order');
            var btnid = obj.attr('id');
            var num = obj.data('num');
            var url = '<?php echo Yii::app()->createUrl('expense/expdetailajax/' . $class->cid, array('authority'=>$class->authority));?>';
            var nextbtnEle = $("#nextbtn");
            var currClass = nextbtnEle.attr('class');
            if(btnid == 'nextbtn'){
                nextbtnEle.addClass('disnext');
            }
            if(currClass != 'disnext'){
                $.post(url,{order:order},function(data){
                    if(data.status == 1){
                        var lastorder = data.lastorder;
                        if(data.detail.length > 0){
                            var htmlStr = '';
                            $("#content").html('');
                            $.each(data.detail,function(i,n){
                                htmlStr += '<tr>';
                                htmlStr += '<td>' + n.strName + '</td>';
                                htmlStr += '<td>' + n.evnetstr + '</td>';
                                htmlStr += '<td>' + n.timestr + '</td>';
                                htmlStr += '<td>' + n.moneystr + '</td>';
                                htmlStr += '</tr>';
                            });
                            $("#content").html(htmlStr);

                            var activeEle = $(".pages .active");
                            var currv = activeEle.data('num');

                            if(btnid == 'nextbtn'){
                                currv += 1;

                                tmpNext = activeEle.next();
                                if(tmpNext.data('num') == currv){
                                    tmpNext.addClass('active');
                                    activeEle.removeClass('active');
                                }else{
                                    activeEle.after('<a href="javascript:;" class="active" data-order="'+order+'" data-num="'+currv+'">'+currv+'</a>');
                                    activeEle.removeClass('active');
                                }

                                nextbtnEle.data('order', lastorder);
                                nextbtnEle.data('nextnum', currv);

                            }else{
                                if(num != currv){
                                    obj.addClass('active');
                                    activeEle.removeClass('active');
                                }

                                if(num == 10) nextbtnEle.hide();

                                nextbtnEle.data('order', lastorder);
                            }

                            var dis = nextbtnEle.css('display');
//                      alert(currv + ',,' + dis);
                            if(currv == 10 && dis != 'none'){
                                nextbtnEle.hide();
                            }else{
                                var tmpnextnum = nextbtnEle.data('nextnum');
//                          alert(tmpnextnum + '/' + num);
                                if(tmpnextnum != num)
                                    nextbtnEle.show();
                            }

                            if(!data.showNext){
                                nextbtnEle.hide();
                            }
                        }

                    }else{
                        nextbtnEle.hide();
                    }
                    nextbtnEle.removeClass('disnext');
                },'json');
                $("body").scrollTop(400);
            }
        });
    });
</script>





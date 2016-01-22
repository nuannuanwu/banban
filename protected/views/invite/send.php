<style type="text/css"> 
    .succesT{ margin: 20px 0; font-size: 18px; color: #EB6A05; }
    .typBox{ padding: 10px 0; }
    .typBox .typT{ font-size: 14px; margin-bottom: 10px; }
    .typBox p{ margin-bottom: 6px; font-weight: 700; }
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon8"></span>邀请有礼>短信推荐
        </div>
        <div class="box">
            <nav class="navMod navModDone" >
                <a href="<?php echo Yii::app()->createUrl('invite/index'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="box " >
                <div class="succesT">
                  <?php echo $result['msg'];?>
                </div>
                <?php if(count($result['registers'])): ?>
                <div class="typBox">
                    <div class="typT">以下用户已注册，不发送短信（<?php echo count($result['registers']);?>）：</div>
                    <?php foreach($result['registers'] as $item):?>
                    <p><?php echo $item;?></p>
                    <?php endforeach;?>
                </div>
                <?php endif; ?>
                <?php if(count($result['threeInvited'])): ?>
                <div class="typBox">
                    <div class="typT">以下用户已接收三次推荐短信而未注册，不发送短信（<?php echo count($result['threeInvited']);?>）：</div>
                    <?php foreach($result['threeInvited'] as $item):?>
                    <p><?php echo $item;?></p>
                    <?php endforeach;?>
                </div>
                 <?php endif; ?>
            </div>
        </div> 
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon4"></span>我的青豆 （<?php echo JceHelper::getBeanInfo(Yii::app()->user->id);?>）
        </div>
        <div class="box">
            <div class="class-reward bean" >
              <?php $identity = Yii::app()->user->getCurrIdentity();?>
              <?php if($identity->isTeacher): ?>
  				       <p style="margin:20px 0 20px;color: #f59201;">提醒：目前只在班班手机应用上使用时才会奖励青豆。</p>
             		 <div class="bean-rule">
            		 	<!-- <div class="tit">青豆奖励规则：</div> -->
                  <h1>什么是青豆？</h1>
                  <!-- 老师 -->
                  <p>青豆是对使用班班APP的用户进行奖励的载体，青豆可在班班APP内兑换对应的礼品。</p>
                  <h1 class="title-2">青豆的奖励规则是什么？青豆获取途径有哪些？</h1>
                  <!-- 老师 -->
                  <ul> 
                    <li>1.  用户只有使用班班APP或者参与班班官网指定的活动才可以获得青豆。</li>
                    <li>2.  用户每天登录班班可一次性获得2个青豆，重复登录也只能获得一次。</li>
                    <li>3.  每天晒一次班费，可以获得5个青豆。</li>
                    <!-- <li>4.  用户在话题下每发布一个帖子可获得3个青豆，每天最多可获得6个青豆。</li>
                    <li>5.  用户每回复一个已发布的帖子可获得1个青豆，每天最多可获得2个青豆。</li>  -->
                    <li>4.  每位班级成员读取未读消息，发通知的老师将获得3个青豆奖励，每天最多可获得300个青豆。</li>
                  </ul>
                  <h1 class="title-2">怎样使用青豆？</h1>
                  <!-- 老师 -->
                  <p>目前可通过“青豆派兑”将青豆兑换成相应的礼品，具体礼品及礼品兑换方式以“青豆派兑”为准。</p>
                  <h1 class="title-2">其他说明</h1>
                  <!-- 老师 -->
                  <ul> 
                    <li>1.  秉承公平公正的原则，班班平台将严厉打击刷青豆的行为，一旦有用户被界定存在违规刷青豆行为，班班平台将有权回收青豆和对相应用户账户进行封号处理，并保留追究法律责任的权利。</li>
                    <li>2.  班班青豆的解释权归蜻蜓互动所有。</li>
                  </ul>
                  <!-- 老师 end -->
            		 </div>
                <!-- 家长 -->
                <?php elseif($identity->isPatriarch || $identity->isFocus): ?>
                 <p style="margin:20px 0 50px;">提醒：目前只在班班手机应用上使用时才会奖励青豆。</p>
                 <div class="rule">
                  <div class="tit">青豆奖励规则：</div>
                  <ul>
                    <li>本人帐号激活后，一次性奖励20青豆。</li>
                    <li>对收到的消息通知进行评论，每次评论奖励1个青豆，每天上限2个。</li>
                    <li>每天登录共奖励2个青豆，不区分登录次数。</li>
                    <li>班级成员可多次参与“挣班费”活动，每天最多只计两次有效点击，每次有效点击给自己奖励5个青豆的同时，再给班主任奖励2个青豆。</li>
                    <li>每天晒一次班费，可以获得5个青豆。</li>
                  </ul>
                 </div>
               <!-- 家长 end -->
               <?php endif; ?>
           </div>
        </div>
    </div>
</div>

<style>
    .imgboxs{ width: 70%; margin: 0 auto;}
    .imgbox{ margin: 0 auto;  padding: 0; border: none; font-size:0; line-height: 0; outline: none;list-style:none;}  
    .imgbox img{ vertical-align:bottom; display: block;}
    .imgbox img.imgico{ width: 100%; display: block; border: none;}
    .imgbox .awardList {margin: 0 auto; padding: 30px 0 30px 0px; background-color: #c4dce4; }
    .awardList li{  width: 550px;  margin-bottom: 20px; font-size: 18px; margin: 0 auto; }
    .awardList li span.color1{ color: #ff0000; font-size: 24px; }
    .awardList li span.color2{ color: #1f4c00; font-size: 24px; }
    .awardList li a { margin-left: 30px; }
    .awardList li a img { display: inline; vertical-align: -6px; }
    /* 窗口宽度在1300px以下, 1000以上 */
@media screen and (min-width: 800px) and (max-width: 1250px){
    .imgboxs{ width: 100%;font-size:0;} 
}
@media screen and (min-width:0px) and (max-width: 800px){ 
    .imgboxs{width: 600px;font-size:0;}
 
}
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
           <div class="titleHeader bBttomT">
                <span class="icon icon8"></span>邀请有礼
            </div>
        <div class="box" style=" padding-top: 0;">
<!--                <div class="imgbox">
                    <div class="awardBox"> 
                        <ul class="awardList">
                            <li>您现在可领取30元话费的次数：<span class="color1"><?php echo $okNum;?></span> 次 
                                <?php if($okNum>0): ?>
                                    <a href="<?php echo Yii::app()->createUrl('gift/invite');?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/linkBtn.png"/></a>
                                <?php endif; ?>
                            </li>
                            <li>您尚在等待的领取次数（尚未达到条件）:   <span class="color2"><?php echo $notNum;?></span> 次</li>
                            <li>您已领取话费总计：<span class="color2" style=" font-size: 19px;">30元 x <?php echo $exchangeNum;?> = </span><span class="color1"><?php echo $exchangeMoney;?>元</span></li>
                        </ul> 
                    </div>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/award.jpg" />
                </div>-->
                <div class="imgboxs">
                    <div class="imgbox">
                        <img class="imgico" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/header.jpg" />
                    </div>
                    <div class="imgbox">
                        <img class="imgico" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/banner.jpg" />
                    </div>
                    <div class="imgbox">
                        <img class="imgico" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/set_tep1.jpg"/> 

                    </div>
                    <div class="imgbox" >
                        <img class="imgico" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/set_tep2.jpg"/> 
                    </div>
                    <div class="imgbox"> 
                        <img class="imgico" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/title.jpg" />
                    </div>
                    <div  class="imgbox">  
                        <img  class="imgico"src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/rule.jpg" />
                    </div> 
                    <div  class="imgbox">
                        <img class="imgico" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/footer.jpg" />
                    </div>
                </div>
            </div>
         </div>
    </div> 
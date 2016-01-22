<div id="headerBox" class="headerBox" style="height: 67px;">
    <div class="logoBox">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo_ioc.png" />
    </div>
    <div class="userBox">
        <div  style=" position: absolute; zoom: 1; left: 0; top:20px; height: 26px; overflow: hidden;">
            <?php $userinfo=Yii::app()->user->getInstance();?>
            <a class="name" href="javascript:;" title="<?php echo $userinfo->name; ?>" style="max-width: 105px; overflow: hidden;text-overflow: ellipsis; white-space: nowrap;">
                <?php if($userinfo&&$userinfo->teacherauth==2):?>
                <img style=" display: inline-block; width: 24px; vertical-align: bottom;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/v.png" title="认证老师" />
                <?php endif;?>
                <?php $connectInfo = Yii::app()->user->getThreeUserInfo(); ?>
                <?php if($connectInfo && $connectInfo['type']): ?> 
                    <?php if($connectInfo['type']==1): ?> 
                    <img style=" display: inline-block; height: 22px; vertical-align: bottom;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/qico.png" /> 
                    <?php else: ?> 
                    <img style=" display: inline-block; height: 22px; vertical-align: bottom;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/wx.png" /> 
                    <?php endif; ?>
                <?php endif; ?>
                <?php echo $userinfo->name; ?>
            </a>
            <?php $identity = Yii::app()->user->getCurrIdentity();?>
            <div class="siteBox">
                <div class="siteListBox" >
                    <i class="sitIco sitIco_l"></i>
                    <i class="sitIco sitIco_r"></i>
                    <div class="sitLists">
                        <?php if($identity->isTeacher || $identity->isPatriarch || $identity->isFocus):?>
                            <a href="<?php echo Yii::app()->createUrl('site/account'); ?>">设置</a>
                            <em>|</em>
                            <a href="<?php echo Yii::app()->createUrl('helper/help01'); ?>">帮助</a>
                            <em>|</em>
                            <a href="<?php echo Yii::app()->createUrl('site/app');?>" target="_blank">手机版</a>
                            <em>|</em>
                        <?php endif;?>
                        <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">退出</a> 
                    </div>
                </div>
            </div> 
        </div>
        
        <div id="dropdown_qqkfu" style=" position: absolute; width:99px ;top:15px; right:135px; cursor: pointer; ">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/qq/qqBtn.png" />
            <div class="qqkf" id="qqkf" style="display: none;" >
                <div class="qq-tit" ></div>
                <div class="qq-listBox">
                    <ul class="qq-list" > 
                        <li>
                              <div class="q-person">
                                  <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=318602664&site=qq&menu=yes">318602664</a>
                              </div>
                        </li>
                        <li>
                              <div class="q-person">
                                  <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2050745544&site=qq&menu=yes">2050745544</a>
                              </div>
                        </li>

                        <li>
                              <div class="q-person">
                                  <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1919036624&site=qq&menu=yes">1919036624</a>
                              </div>
                        </li> 
                    </ul>
                </div>
                <div class="qq-fot" ></div>
            </div>
        </div>
        <div class="old-site"> 
            <ul>
                 <?php  if($userinfo && isset($userinfo->isnewuser) && $userinfo->isnewuser == 1):?>
               <!-- <li>
                    <a href="<?php echo Yii::app()->createUrl('site/gotooldplantform');?>">回到旧版</a>
                </li>-->&nbsp;
                <?php endif;?> 
                <!--<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tell_pic.png" /></li>-->
            </ul>  
        </div> 
    </div>
</div>
<script type="text/javascript">
    (function($){
        $.fn.hoverDelay = function(options){
            var defaults = {
                hoverDuring: 200,
                outDuring: 200,
                hoverEvent: function(){
                    $.noop();
                },
                outEvent: function(){
                    $.noop();    
                }
            };
            var sets = $.extend(defaults,options || {});
            var hoverTimer, outTimer;
            return $(this).each(function(){
                $(this).hover(function(){
                    clearTimeout(outTimer);
                    hoverTimer = setTimeout(sets.hoverEvent, sets.hoverDuring);
                },function(){
                    clearTimeout(hoverTimer);
                    outTimer = setTimeout(sets.outEvent, sets.outDuring);
                });    
            });
        }      
    })(jQuery);
</script>
<script> 
    //下拉菜单        
    $("#dropdown_qqkfu").each(function(){
        var that = $(this); 
        that.hoverDelay({
            hoverDuring: 100,
            outDuring: 1000,
            hoverEvent: function(){ 
                //that.addClass('on');  
                $("#qqkf").show();
            },
            outEvent: function(){
                 //that.removeClass('on'); 
                 $("#qqkf").hide();
            }
        }); 
    }); 
</script>

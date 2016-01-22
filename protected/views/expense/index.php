<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>"
      xmlns="http://www.w3.org/1999/html">
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
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon3"></span>我的班费卡
        </div> 
        <div class="box" style="padding:15px 25px 50px;">
            <div style=" padding-bottom: 15px;">
                <span style=" font-size: 16px; font-weight: 700; margin-right: 15px; color: #333333;">可用总额：<i style=" font-style: normal;font-weight: 100;"><?php echo $transInfo['amt']; ?></i></span>
                <?php if($transInfo['enable']):?>
                    <?php if($transInfo['clickable']): ?>
                        <a href="<?php echo Yii::app()->createUrl('expense/transfercard'); ?>" class="btn btn-orange">转出</a> 
                    <?php else: ?>
                       <a href="javascript:;" class="btn btn-default" style=" cursor: default; background: #d7d7d7;">转出</a>
                    <?php endif; ?>
                    <span style=" color: #999999;">（最低累计50元方可转出）</span>
                <?php endif; ?>
                       
            </div>
            <a class="ex-rule-link" href="<?php echo Yii::app()->createUrl('expense/exprules');?>">
                <i class="question-mark-icon"></i>班费卡规则
            </a>
            <div class="expense-rule">
                <p class="tips">（提示：完整操作，需在班班手机客户端上进行）</p>
            </div>
            <div class="expense-bd class-reward">
                <div id="tab-0" class="card">
                	<ul class="my-expense-cards clearfix">
                    <?php if(is_array($usableCards) && count($usableCards)):?>
                        <?php $tag_class=array(0=>'tag-other',1=>'tag-normal',2=>'tag-activity');?>
                        <?php foreach($usableCards as $val):?>
                        <li>
                            <a href="javascript:;">
                                <span class="tag <?php echo isset($tag_class[$val['category']])?$tag_class[$val['category']]:'';?>"></span>
                                <p class="expense">￥ <span class=""><?php echo $val['money'];?></span></p>
                                <p class="card-type"><?php echo $val['name'];//isset($category_arr[$val['category']])?$category_arr[$val['category']]:'';?></p>
                                <p class="card-date">有效期: <?php echo $val['endtime'];?></p>
                                <span class="bag"></span>
                            </a>
                        </li>
                        <?php endforeach;?>
                        <?php else:?>
                            <p class="no-card-tips">无可用的班费卡</p>
                        <?php endif;?>
                        <?php $over_class=array(0=>'tag-other',1=>'status-used',2=>'status-overdue');?>
						
                        <?php foreach($unusableCards as $val):?>
                            <li class="over">
                                <a href="javascript:;">
                                    <span class="tag tag-over"></span>
                                    <p class="expense">￥ <span class=""><?php echo $val['money'];?></span></p>
                                    <p class="card-type"><?php echo $val['name'];?></p>
                                    <p class="card-date">有效期: <?php echo $val['endtime'];?></p>
                                    <span class="bag"></span>
                                    <span class="status <?php echo isset($over_class[$val['status']])?$over_class[$val['status']]:'';?>"></span>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <div id="page1" >
                        <?php
                        $this->widget('CLinkPager',array(
                                'header'=>'',
                                'firstPageLabel' => '首页',
                                'lastPageLabel' => '末页',
                                'prevPageLabel' => '<',
                                'nextPageLabel' => '>',
                                'pages' => $pager,
                                'maxButtonCount'=>5
                            )
                        );
                        ?>
                    </div>

                </div>
                <div id="tab-1" class="card hidden">
                    <ul class="list clearfix" id="class-list">
                        <li class="list-li" data-href="<?php echo Yii::app()->createUrl('expense/expdetail/', array('authority'=>1));?>">
                            <div class="list-header bg-blue clearfix">
                                <p class="class-name">刺杀13班</p>
                                <p class="school-name">中国广东省深圳市南山区高级刺杀学校9分校</p>
                            </div>
                            <div class="list-money">
                                <div class="cnt-box left">
                                    <p class="cnt-total"><?php printf('￥%0.2f',5555); ?></p>
                                    <p class="cnt-total-label">当前余额</p>
                                </div>
                                <div class="cnt-box right">
                                    <p class="cnt-ext">累计金额：<span><?php printf('￥%0.2f',2222);?></span></p>
                                    <p class="">今日赚取：<span><?php printf('￥%0.2f',1222);?></span></p>
                                    <p class="">历史最高：<span><?php printf('￥%0.2f', 1800);?></span></p>
                                </div>
                            </div>
                            <div class="class-icon class-icon-logo"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script type="text/javascript" id="bdshare_js" data="type=tools" ></script>
<script type="text/javascript" id="bdshell_js"></script
<script type="text/javascript">
    document.getElementById("bdshell_js").src = "<?php echo Yii::app()->request->baseUrl; ?>/js/banban/bdshare.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>> -->
<script>
	$(function(){
		$('#classdiv').on('click','a',function(){
			e.stopPropagation();
		});
		$('#classdiv').on('click','li',function(){
			var url = $(this).data('href');
			window.location=url;
		});
        /*$('.expense-hd a').click(function() {
            $('.expense-hd a').removeClass('current');
            var that = $(this);
            that.addClass('current');
            $('.expense-bd .card').addClass('hidden');
            $('#tab-' + that.attr('data-target')).removeClass('hidden');
        });*/

        $("#next").click(function(){



        })
	})
</script>
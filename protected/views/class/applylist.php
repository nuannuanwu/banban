<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<style>
    .disnext{
        background:#adadad!important;
    }
    .disnext:hover,.disnext:focus{
        color:#8c8c8c!important;
        cursor:default;
    }
</style>
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > 进班申请消息
        </div>
        <div class="box">
            <nav class="navMod navModDone" >
                <a href="<?php echo Yii::app()->createUrl('class/index'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="classTitle">进班申请消息</div>
            <div class="class-apply-msg">
                <table class="table table-hover">
					<?php if(isset($applylist) && count($applylist)): ?>
                    <tr class="tableHead">
                        <th width="15%"><div class="name">申请人</div></th>
                        <th width="50%"><div class="" style="width: 80px;">内容</div></th>
                        <th width="25%"><div class="name " style="width: 120px;">申请时间</div></th>
                        <th width="10%"></th>
                    </tr>
                    <tbody  id="content">
                    <?php foreach($applylist as $key=>$value):?>
                    <tr>
                        <td><?php echo $value->userName;echo $value->phone?'（'.$value->phone.'）':'';?></td>
                        <td><?php echo $value->content;?></td>
                        <td><?php echo $value->createTime; $lastIndex = $value->index;?></td>
                        <?php if( 0 == $value->status ): ?>
                        <td id="apply_<?php echo $value->id;?>"><div class="apply-btn">
                                <a href="javascript:;" rel="linkBnts" pid="<?php echo $value->id;?>" flag="1" cid="<?php echo $value->cid;?>" txt="是否同意“<?php echo $value->userName;?>”<?php if( false == $value->subject ): ?> 同学<?php else:?>老师<?php endif;?>入班申请？">同意</a>
                                <a href="javascript:;" rel="linkBnts" pid="<?php echo $value->id;?>" flag="2" cid="<?php echo $value->cid;?>" txt="是否拒绝“<?php echo $value->userName;?>”<?php if( false == $value->subject ): ?> 同学<?php else:?>老师<?php endif;?>入班申请？">拒绝</a>
                            </div>
                        </td>
                        <?php else:?>
                        <td><span class="apply-result"><?php echo 2==$value->status?'已拒绝':(1==$value->status?'已同意':'');?></span></td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach;?>
                    <?php else:?>
                    <tr class="remindBox">
                        <td colspan="4" style=" padding: 0;">
                            <div class="noContent" style="background: #FFF; padding-bottom: 20px;">
                                <span ><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tip.png"></span>
                                <p>空空如也</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif;?>
                    </tbody>
                </table>
                <?php if(isset($applylist) && $applylist):?>
                <div id="page1" class="pages">
                    <?php $this->widget('CLinkPager',array(
                            'header'=>'',
                            'firstPageLabel' => '首页',
                            'lastPageLabel' => '末页',
                            'prevPageLabel' => '<',
                            'nextPageLabel' => '>',
                            'pages' => $pages,
                            'maxButtonCount'=>5
                        )
                    ); ?>
                </div>
                <?php endif;?>
        </div> 
    </div>
</div>
</div>
<div id="remindBox" class="popupBox"> 
    <div class="remindInfo"> 
        <div id="remindText" class="centent"> </div>
    </div>
    <div class="popupBtn">
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#remindBox')" class="btn btn-orange">确 定</a>
    </div>
</div>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
	$(".pages").on('click','a',function(){
		var obj = $(this);		
		var order = obj.data('order');
		var btnid = obj.attr('id');
		var num = obj.data('num');
		var url = '<?php echo Yii::app()->createUrl('class/applylistajax/');?>';
		var nextbtnEle = $("#nextbtn");
		var currClass = nextbtnEle.attr('class');
		if(btnid == 'nextbtn'){
			nextbtnEle.addClass('disnext');
		}	
		if(currClass != 'disnext'){
			$.post(url,{page:num,index:order},function(data){			
				if(data.status == 1){				
					if(data.detail.length > 0){
	    				var htmlStr = lastorder = '';
	    				$("#content").html('');

	    				$.each(data.detail,function(i,n){
	    					htmlStr += '<tr>';
	    					htmlStr += '<td>' + n.userName + ( n.phone?'（'+n.phone+'）':'' ) + '</td>'; 
	    					htmlStr += '<td>' + n.content + '</td>';
	    					htmlStr += '<td>' + n.createTime + '</td>';

	                        if( 0 == n.status ){
	                        	htmlStr += '<td id="apply_'+n.id+'"><div class="apply-btn">';
	                        	htmlStr += '<a href="javascript:;" rel="linkBnts" pid="'+n.id+'" flag="1" cid="'+n.cid+'" txt="是否同意“'+n.userName+'”'+(n.subject?'老师':'同学')+'入班申请？">同意</a>';
	                        	htmlStr += '<a href="javascript:;" rel="linkBnts" pid="'+n.id+'" flag="2" cid="'+n.cid+'" txt="是否拒绝“'+n.userName+'”'+(n.subject?'老师':'同学')+'入班申请？">拒绝</a> </div></td>';
	    					}
	                        else {
	                        	htmlStr += '<td><span class="apply-result">'+ ( 2==n.status?'已拒绝':(1==n.status?'已同意':'') ) + '</span></td>';
							}
	    					
	    					htmlStr += '</tr>';	

	    					lastorder = n.index;
	    				});
	    				$('#content').html(htmlStr);

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

	        				//if(num == 10000) nextbtnEle.hide();
	        				
	        				nextbtnEle.data('order', lastorder);
	    				}
	    				
	    				nextbtnEle.data('num', num+1);
	    				
	    				var dis = nextbtnEle.css('display');
//	     				alert(currv + ',,' + dis);

	        			var tmpnextnum = nextbtnEle.data('nextnum');
//	         			alert(tmpnextnum + '/' + num);
	        			if(tmpnextnum != num)
	        				nextbtnEle.show();
	    				

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
</script>
<script type="text/javascript">
    $(function(){
        $('a[rel=linkBnts]').live('click',function(){
            var _this = $(this); 
            var urls ='<?php echo Yii::app()->createUrl('class/applylist'); ?>';
            var pid = _this.attr('pid');
            var flag = _this.attr('flag');
            var cid = _this.attr('cid');
            $.post(urls,{mid:pid,flag:flag,cid:cid},function(data){
                if(data&&data.success=='1'){   
                    if( 1 == flag ){
                        data.msg = '已同意';
                    }else if( 2 == flag ){
                        data.msg = '已拒绝';
                    }
                    $('#apply_'+pid).html('<span class="apply-result">'+data.msg+'</span>'); 
                }else{
                    $('#remindText').text(data.msg);
                    showPromptsRemind('#remindBox');
                }
            },'json'); 
        }); 
    });
</script>

 
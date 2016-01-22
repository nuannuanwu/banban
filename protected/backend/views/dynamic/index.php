<div class="box">
    <form action="">
        <table class="tableForm searchForm" style="margin-bottom: 10px;"> 
        <tbody valign="middle">
            <tr valign="middle">
                <td width="45px"> 类型：</td>
                <td width="220px">
                    <select name="Dynamic[adtype]" id="selectsid" class="max" selectid="grade">
                        <option value="">全部</option>
                        <?php foreach($typearr as $k=>$v):?>
                            <option value="<?php echo $k;?>" <?php if($query['adtype']==$k) echo "selected='selected'";?>><?php echo $v;?></option>
                        <?php endforeach;?>

                    </select>
                </td>

                <td width="45px">标题：</td>
                <td width="240px">
                    <input name="Dynamic[title]" value="<?php echo $query['title'];?>" class="searchW260" style="width:220px;"  type="text" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')" >
                </td> 
                <td class="search">
                    <a href="<?php echo Yii::app()->createUrl('dynamic/create');?>" class="btn btn-primary fright">创建</a>
                    <span class="fright">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="submit" class="btn btn-primary" value="搜 索">
                </td> 
        </tr>
    </table>
</form> 
    <div class="tableBox">
   
        <table class="table table-bordered table-hover" width="100%" border="0" cellpadding="0" cellspacing="0">
            <thead>
              <tr style="background-color: #e8e8e8;">
                  <th width="10%">类型</th>
                  <th width="20%">标题</th>
                  <th width="25%">摘要</th>
                  <th width="15%">创建时间</th>
                  <th>操作</th>
              </tr>  
            </thead>
            <tbody>
                <?php if(count($data['model'])): ?> 
               <?php foreach($data['model'] as $val):?>
                   <tr>
                    <td><?php echo $val->adtype?$typearr[$val->adtype]:'';?></td>
                    <td><?php echo $val->title;?></td>
                    <td><?php echo $val->summery;?></td>
                    <td><?php echo $val->creationtime;?></td> 
                    <td>
                        <a href="<?php echo  Yii::app()->createUrl('dynamic/update/'.$val->id);?>">编辑</a>
                        <a  rel ="deleLink" href="javascript:;"  data-href="<?php echo Yii::app()->createUrl('dynamic/delete/'.$val->id);?>">删除</a>
                    </td>  
                   </tr> 
               <?php endforeach;?>
                <?php else :?>
                    <tr>
                        <td colspan="5" align="center" style=" font-size: 21px; padding: 100px 0;">
                            暂无数据
                        </td> 
                    </tr> 
                <?php endif; ?> 
            </tbody>
        </table>
        <div id="pager" style="margin-top: 30px;">
            <?php
            $this->widget('CLinkPager',array(
                    'header'=>'',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '末页',
                    'prevPageLabel' => '上一页',
                    'nextPageLabel' => '下一页',
                    'pages' => $data['pages'],
                    'maxButtonCount'=>9
                )
            );
            ?>    
        </div>  
    </div>  
</div>
<div id="popupBox" class="popupBox">
    <div id="popupInfo" style="padding: 30px;">
        <div class="centent">温馨提示：是否删除当前动态？</div>
    </div>
    <div style="text-align: center;">
        <a id="isOk" href="" class="btn btn-primary">确定</a> &nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#popupBox');" class="btn btn-default">取消</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/popupVeiw.js"></script>
<script type="text/javascript">
        //删除提醒
        $('[rel=deleLink] ').click(function () {
            var urls = $(this).data('href');
            $("#isOk").attr('href', urls);
            showPromptsIfonWeb('#popupBox');
        });
</script>
 

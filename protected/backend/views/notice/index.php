<script type="text/javascript" src="/js/business/My97DatePicker/WdatePicker.js"></script>

<div class="box">
    <form id="postForm" action="">
        <table class="tableForm searchForm" style="margin-bottom: 10px;"> 
        <tbody valign="middle">
            <tr valign="middle">
                <td width="70px"> 发送时间：</td>
                <td width="260px">
                    <input type="text" id="startdateInput"  class="Wdate"  name="startdate" style="width:110px; height: 28px;"  readonly="readonly" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',maxDate:'#F{$dp.$D(\'enddateInput\')||\'<?php echo date('Y-m-d');?>\';}'})" value="<?php echo $query['startdate'];?>"/>&nbsp;&nbsp;--
                    <input type="text" id="enddateInput"  class="Wdate"  name="enddate" style="width:110px;  height: 28px;"  readonly="readonly" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'#F{$dp.$D(\'startdateInput\')}',maxDate:'<?php echo date('Y-m-d');?>'})"  value="<?php echo $query['enddate'];?>"/>
                </td>
                <td width="110px" align="right" style="height:32px;">&nbsp;&nbsp;发送者手机号：</td>
                <td width="100px">
                    <input name="sendphone" value="<?php echo $query['sendphone'];?>" class="" style="width:110px "  type="text" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')" >
                </td>
                <td width="110px" align="right" style="">&nbsp;&nbsp;接收者手机号：</td>
                <td width="100px">
                    <input name="receivephone" value="<?php echo $query['receivephone'];?>" class="" style="width:110px;"  type="text" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')" >
                </td>
                <td width="80px" align="right" style="">&nbsp;&nbsp;消息类型：</td>
                <td width="130px">
                    <select name="noticetype" id="noticetypeid" > 
                        <option value="" <?php if($query['noticetype']==='') echo "selected='selected'";?>>全部</option>
                        <?php foreach($typeArr as $k=>$val):?>
                        <option value="<?php echo $k;?>" f="<?php echo $k;?>" <?php if($query['noticetype']==$k&&$query['noticetype']!='') echo "selected='selected'";?>><?php echo $val;?></option>
                    <?php endforeach;?>
                    </select>
                </td>
                <td class="search">
                    <input type="button" id="sub_from" class="btn btn-primary" value="搜 索">
                  <!--  <input type="button" class="btn btn-primary reset" value="重　置">-->
                </td>
        </tr>
    </table>
</form> 
    <div class="tableBox">
   
        <table class="table table-bordered table-hover" width="100%" border="0" cellpadding="0" cellspacing="0">
            <thead>
              <tr style="background-color: #e8e8e8;">
                  <th width="8%">发送人</th>
                  <th width="6%">接收人</th>
                  <th width="10%">发送时间</th>
                  <th >发送内容</th>
                  <th width="5%">消息类型</th>
                  <th width="7%">是否需要发送短信</th>
                  <th width="7%">发送来源</th>
                  <th width="7%">短信状态</th>
              </tr>
            </thead>
            <tbody>
                <?php if(count($data['model'])): ?> 
               <?php foreach($data['model'] as $val):?>
                   <tr>
                     <td><?php echo $val->sendertitle;?></td>
                     <td><?php echo $val->receivertitle?str_replace('，您好。','',$val->receivertitle):$val->receivename;?></td>
                       <td><?php echo $val->sendtime;?></td>
                       <td style="width:200px;overflow: hidden;"><?php echo $val->content;?></td>
                     <td><?php echo isset($typeArr[$val->noticetype])?$typeArr[$val->noticetype]:'';?></td>
                     <td><?php echo isset($sendsmsArr[$val->issendsms])?$sendsmsArr[$val->issendsms]:'';?></td>
                     <td><?php echo isset($platformArr[$val->platform])?$platformArr[$val->platform]:'';?></td>
                     <td><?php echo isset($smsstateArr[$val->state])?$smsstateArr[$val->state]:'';?></td>
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
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/jqueryui/jquery-ui.js"></script>
<script type="text/javascript"> 
    $(function(){
        $("#sub_from").click(function(){
            var startTime = $('#startdateInput').val();
            var endTime = $('#enddateInput').val(); 
            var sTime = (new Date(startTime)).getTime();
            var eTime = (new Date(endTime)).getTime();
            var str = eTime - sTime;
            var neTime = str/(24*60*60*1000);
            if(neTime>7){
               alert("选择的日期最大跨度为七天！"); 
            }else{
               $('#postForm').submit(); 
            } 
        });
        $('.reset').on("click",function(){
            $("input[name=startdate]").val('');
            $("input[name=enddate]").val('');
            $("input[name=sendphone]").val('');
            $("input[name=receivephone]").val('');
            $("#noticetypeid").val(''); 
        });
    })
</script>
 

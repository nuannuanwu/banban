<form id="searchFormBox" action="">
<table class="tableForm searchForm" style="margin-bottom: 10px;">
    <tr> 
        <td width="45px"> 学校：</td>
        <td width="220px" style=" overflow: visible;">
            <span id="statesCombo"></span>
<!--            <select name="Class[sid]" class="max" id="selectsid" selectid="grade"  url="<?php // echo Yii::app()->createUrl('range/getschoolgrade' );?>">
                  <option value="">全部</option>
                  <?php //foreach($schools as $k=>$v):?>
                  <option value="<?php //echo $k;?>"  <?php //if($query['sid']==$k) echo 'selected="selected"'; ?>><?php  // echo $v;?></option>
                  <?php // endforeach;?>
              </select> --> 
            <input id="statesComboInput" sid="<?php echo $query['sid'];?>" sname="<?php echo UserAccess::getSelfSchoolNameById($query['sid']);?>"  type="hidden" name="Class[sid]" value="<?php echo $query['sid'];?>" >
        </td>
        <td width="45px"> 年级：</td>
        <td width="130px">
            <select name="Class[grade]" id="grade">
                <option value="">全部</option>
                <option value="interest">兴趣班</option>
                <?php foreach($grades as $k=>$v):?>
                    <option value="<?php echo $k;?>" <?php if($query['grade']==$k) echo 'selected="selected"'; ?>><?php echo $v;?></option>
                <?php endforeach;?>
            </select>
        </td>
        <td width="75px" >班级名称：</td>
        <td width="180px">
            <input name="Class[name]" value="<?php echo $query['name'];?>" class="searchW260" style="width:160px;" type="text" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')" >
        </td>                   
        <td class="search">
           <!--  <a href="<?php echo Yii::app()->createUrl('class/create');?>" class="btn btn-primary fright">创建</a> -->
             <span class="fright">&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <a href="<?php echo Yii::app()->createUrl('class/import');?>" class="btn btn-primary fright">班级批量导入</a>
              <input type="button" onclick="submitPost();" class="btn btn-primary" value="搜 索"> 
        </td>
    </tr>
</table>
</form> 
<script type="text/javascript"> 
    function submitPost(){
        var sname = $("#statesComboInput").attr('sname');
        var vals = $("#statesComboInput").val();
        var sctName =$('.stc-input').val();
        if(sctName!=''&&vals==''){
            alert("请在学校列中选择一所学校");
        }else{
            $('#searchFormBox').submit();
        } 
    }
</script>
<form id="searchFormBox" action="">
<table class="tableForm searchForm" style="margin-bottom: 10px;">
    <tr>
        <td width="45px"> 学校：</td>
        <td width="220px" style="overflow: visible;">
             <span id="statesCombo"></span>
<!--            <select name="Subject[schoolid]" id="selectsid" class="max">
                <option value="">全部</option>
                <?php foreach($schools as $k=>$v):?>
                    <option value="<?php echo $k;?>" <?php if($query['schoolid']==$k) echo 'selected="selected"'; ?>><?php echo $v;?></option>
                <?php endforeach;?>
            </select>-->
            <input id="statesComboInput" sid="<?php echo $query['schoolid'];?>" sname="<?php echo UserAccess::getSelfSchoolNameById($query['schoolid']);?>"  type="hidden" name="Subject[schoolid]" value="<?php echo $query['schoolid'];?>" >
        </td>
       
        <td width="75px">科目名称：</td>
        <td width="200px">
            <input class="searchW260" style="width:180px;"  name="Subject[name]" type="text" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')"
                   value="<?php echo $query['name'];?>">
        </td>
        <td class="search">
            <a href="<?php echo Yii::app()->createUrl('subject/create');?>" class="btn btn-primary fright">创建</a>
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
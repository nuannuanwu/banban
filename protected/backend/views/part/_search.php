<form id="searchFormBox" action="">
<table class="tableForm searchForm" style="margin-bottom: 10px;">
    <tr> 
        <td width="45px"> 学校：</td>
        <td width="220px" style=" overflow: visible;">
            <span id="statesCombo"></span>
<!--            <select name="Department[sid]" id="selectsid" class="max">
                <option value="">全部</option>
                <?php //foreach($schools as $k=>$v):?>
                    <option value="<?php //echo $k;?>" <?php //if($query['sid']==$k) echo 'selected="selected"'; ?>><?php //echo $v;?></option>
                <?php // endforeach;?>
            </select>-->
            <input id="statesComboInput" sid="<?php echo $query['sid'];?>" sname="<?php echo UserAccess::getSelfSchoolNameById($query['sid']);?>"  type="hidden" name="Department[sid]" value="<?php echo $query['sid'];?>" >
        </td> 
        <td width="75px">部门名称：</td>
        <td width="180px">
            <input name="Department[name]" value="<?php echo $query['name']; ?>" class="searchW260" style="width:160px;"  type="text" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')" value="">
        </td>
        <td class="search">
            <a href="<?php echo Yii::app()->createUrl('part/create');?>" class="btn btn-primary fright">创建</a>
            <input type="button" onclick="submitPost()" class="btn btn-primary" value="搜 索"> 
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
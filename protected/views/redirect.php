<script>
function Jump(){
	window.location.href = '<?php echo $url;?>';
}
document.onload = setTimeout("Jump()" , <?php echo $delay;?>* 1000);
</script>
<style>
.main {padding:30px}
.main .aeBody{text-align:center;padding: 30px}
</style>

<div class="main">
	<!-- seText -->
	<div class="seText msg_<?php echo $type == 'success' ? 'success' : 'error' ; ?>">
		<!-- head -->
		<div class="head"> 
			<h2 class="title">系统提示</h2>
		</div>
		<!-- /head -->

		<!-- aeBody -->
		<div class="aeBody">
			<h2><?php echo $message;?></h2>
			<p>
				系统将在 <span class="warning"><?php echo $delay;?></span> 秒后自动跳转,如果不想等待,直接点击 
				<a class="btn" href="<?php echo $url;?>">这里</a> 跳转
				<br/>
			</p>
		</div>		
		<!-- /aeBody -->

	</div>
	<!-- /seText -->
</div>

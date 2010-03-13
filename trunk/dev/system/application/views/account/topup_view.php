<div class="content_box">
	<p><?=$user->getFName()?>, you currently have</p>
	<p class="balance">&pound;<? echo sprintf("%01.2f", ($credit/100)) ?></p>
	<p>in your Musique account</p>
	<p>You may deposit additional money to your account below:</p>
</div>

<div class="content_box">
	<a class="styled_button" href="<?=site_url('accountmanager/addcredit/100')?>"><span>Add &pound;1</span></a>
	<a class="styled_button" href="<?=site_url('accountmanager/addcredit/500')?>"><span>Add &pound;5</span></a>
	<a class="styled_button" href="<?=site_url('accountmanager/addcredit/1000')?>"><span>Add &pound;10</span></a>
	<a class="styled_button" href="<?=site_url('accountmanager/addcredit/2000')?>"><span>Add &pound;20</span></a>
	<a class="styled_button" href="<?=site_url('accountmanager/addcredit/5000')?>"><span>Add &pound;50</span></a>
	<a class="styled_button" href="<?=site_url('accountmanager/addcredit/10000')?>"><span>Add &pound;100</span></a>
</div>

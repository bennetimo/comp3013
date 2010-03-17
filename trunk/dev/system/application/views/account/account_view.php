<div class="page_title"><h3><?=$page_title?></h3></div>

<div id="content_padder">



<div class="content_box">
	<p><?=$user->getFName()?>, this is your account page. Here you can add more money to your Musique account to allow you to enjoy even more great music!</p>
</div>

<div class="summary_box">
	<h3 class="black_header">Account Summary</h3>
	<div class="feature_box">
		<h3>&pound;<? echo sprintf("%01.2f", ($credit/100)) ?></h3>
		<p>available balance</p>
		<a class="list_button" href="<?=site_url('main/topup')?>"><span>Add money</span></a>
	</div>
	
	<div class="feature_box">
		<h3><?=$user->getNumberOfPurchasedTracks()?></h3>
		<p>purchased tracks</p>
	</div>
	
	<div class="feature_box">
		<h3><?=$user->getNumberOfPlaylists()?></h3>
		<p>playlists created</p>
	</div>
	
	<div class="feature_box">
		<h3><?=$user->getNumberOfSharedPlaylists()?></h3>
		<p>shared playlists</p>
	</div>

</div>

<div id="user_details" class="content_box">
	<h3>Details</h3>
	<p>Name: <? echo $first_name." ".$last_name ?> </p>
	<p>Email: <? echo $email?> </p>
	<p>Date Registered: <? echo $joined ?></p>
	<a class="list_button" href="<?=site_url('main')?>">Edit Details</a><br /><br />
	<a class="list_button" href="<?=site_url('main')?>">Change Password</a>
</div>

</div>
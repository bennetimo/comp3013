<div class="page_title">
    <h3><?=$page_title?></h3>
</div>

<? $this->load->view("common/music_browser_view.php", array("display" => "none")); ?>
<? $this->load->view("common/tracks_list_view.php", array("display" => "")); ?>

<div id="content_padder" class="hideable">



<div class="content_box">
	<p><?=$user->getFName()?>, this is your account page. Here you can add more money to your Musique account to allow you to enjoy even more great music!</p>
</div>


<div id="user_details" class="content_box">
	<div id="user_details_content">
		<h3 class="black_header">Details</h3>
		<table>
			<tr>
				<td>Name:</td>
				<td><? echo $first_name." ".$last_name ?></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><? echo $email?></td>
			</tr>
			<tr>
				<td>Joined:</td>
				<td><? echo $joined ?></td>
			</tr>
		</table>
	</div>
	<div id="user_details_buttons">
		<a class="list_button" href="<?=site_url('main')?>">Edit Details</a><br /><br />
		<a class="list_button" href="<?=site_url('main')?>">Change Password</a>
	</div>
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


</div>
<script type="text/javascript" src="<?=base_url()?>system/application/js/main.js"></script>

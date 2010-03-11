<div class="page_title">
	<h3>My Account</h3>
</div>

<div class="content_box">
	<p>This is your account page.</p>
</div>

<div class="feature_box">
	<h3>&pound;<? echo sprintf("%01.2f", ($credit/100)) ?></h3>
	<p>available balance</p>
</div>

<div class="feature_box">
	<h3>64</h3>
	<p>purchased tracks</p>
</div>

<div class="feature_box">
	<h3>8</h3>
	<p>playlists created</p>
</div>

<div class="feature_box">
	<h3>3</h3>
	<p>shared playlists</p>
</div>

<br /><br /><br /><br /><br /><br />

<div class="content_box">
	<a class="styled_button" href="<?=site_url('accountmanager/addcredit/1000')?>"><span>Add &pound;10</span></a>
	<a class="styled_button" href="<?=site_url('main')?>"><span>Edit Details</span></a>
	<a class="styled_button" href="<?=site_url('main')?>"><span>Change Password</span></a>
</div>

<div class="content_box">
	<h3>Details</h3>
	<p>Name: <? $first_name ?> 
	Date Registered: 17th January 2010</p>
</div>
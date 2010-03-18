
<? if ($userid == "" || !$userid): ?>
<div class="page_title">
        <h3><?= $page_title?></h3>
    </div>
<div id="content_padder" class="welcome_text">
    
</div>
<? endif; ?>

<? $this->load->view("common/music_browser_view.php", array("display" => "none")); ?>
<? $this->load->view("common/tracks_list_view.php", array("display" => "")); ?>

<? if ($userid == "" || !$userid): ?>
<div id="content_padder" class="welcome_text">

	<div class="content_box">
	    <p>
	    Musique is an online streaming media player allowing you to listen to 
	    all your favourite music and share it easily with your friends.
	    
	    With an ever-growing library of artists and new ones being added all the time, 
	    you can be sure that whatever your taste, there is music for you waiting inside.
	    </p>
	</div>
	
	<div class="feature_box">
		<h3><?=User::getNumberOfUsers()?></h3>
		<p>registered users</p>
	</div>
	
	<div class="feature_box">
		<h3><?=Track::getNumberOfTracks()?></h3>
		<p>total tracks</p>
	</div>
	
	<div class="feature_box">
		<h3><?=Artist::getNumberOfArtists()?></h3>
		<p>featured artists</p>
	</div>

	<div class="feature_box">
		<h3>127</h3>
		<p>registered users</p>
	</div>
	
	<div class="content_box">
		<p>Try searching for your favourite music now using the box on the left, you'll be susprised at what we have on offer</p>
	</div>
	
	<div class="content_box">
		<p>To be on your way to enjoying all this music, create an account free now</p>
		<a class="list_button" href="<?=site_url('register')?>"><span>Create Account</span></a>
	</div>
	
</div>
<? endif; ?>
<script type="text/javascript" src="<?=base_url()?>system/application/js/main.js"></script>

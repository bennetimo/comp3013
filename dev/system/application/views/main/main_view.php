<? if ($userid != "" || $userid): ?>
</div> <!-- Close the content_padder if we are displaying search results. This stops the forced padding -->

<div id="search_results_box" >
    <table id="search_results_table">
        <tbody id="search_results_body"></tbody>
    </table>
</div>

<div> <!--  Open the contents padder again to avoid problems -->
<? endif; ?>

<? if ($userid == "" || !$userid): ?>
<div id="hideable">
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

	<br /><br /><br /><br /><br /><br />
	
	<div class="content_box">
		<p>Try searching for your favourite music now using the box on the left, you'll be susprised at what we have on offer</p>
		<p>Or, have a look at the top playlists</p>
		<a class="styled_button" href="<?=site_url('main')?>"><span>Top Playlists</span></a>
	</div>
	
	<div class="content_box">
		<p>To be on your way to enjoying all this music, create an account free now</p>
		<a class="styled_button" href="<?=site_url('main')?>"><span>Create Account</span></a>
	</div>
</div>
<? endif; ?>

<script type="text/javascript" src="<?=base_url()?>system/application/js/main.js"></script>

<? if ($userid != "" || $userid): ?>
<div> <!--  Open the contents padder again to avoid problems -->

<? else: ?>
    <div class="page_title">
        <h3><?= $page_title?></h3>
    </div>

    <!-- A simple padding div to ensure that all content is padding appropriately, except the page title -->
<div id="content_padder">
</div> <!-- Close the content_padder if we are displaying search results. This stops the forced padding -->
<? endif; ?>

<div id="search_results_box">

    <table style="background-color: #212121; font: bold 11px Tahoma; color: #FFFFFF; border-collapse: collapse; width: 100%;">
        <tbody>
            <tr>
                <td class="handle" style="padding: 3px;"></td>
                <td class="track_name" style="padding: 3px;">Track</td>
                <td class="track_genres" style="padding: 3px;">Genres</td>
                <td class="album_name" style="padding: 3px;">Album</td>
                <td class="track_artists" style="padding: 3px;">Artist</td>
                <td class="track_delete" style="padding: 3px;"></td>
            </tr>
        </tbody>
    </table>

    <div id="search_results_container">
    </div>
    
</div>

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

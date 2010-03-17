
<? if ($userid == "" || !$userid): ?>
<div class="page_title">
        <h3><?= $page_title?></h3>
    </div>
<div id="content_padder" class="welcome_text">
    
</div>
<? endif; ?>

<div id="music_browser">
	<table>
		<form action="/shop/index.php" method="post" name="shop">
			<tr align="center" valign="top">
				<td><div class="mesH1">Genre</div></td>
				<td><div class="mesH1">Artist</div></td>
				<td><div class="mesH1">Album</div></td>
      		</tr>
			<tr align="center" valign="top">
				<td>
					<select name="genre" size="5" id="genre" onchange="location='http://mes.simplyone.co.uk/shop/?genre='+genre.options[genre.options.selectedIndex].value">
						<option  value="all">All (<?= count($mb_genres) ?>)</option> 
						
						<?php 
						foreach($mb_genres as $record){
							echo "<option value='1'>$record</option>";
						}
						?>	
					</select>
				</td>
				<td>
					<select name="genre" size="5" id="genre" onchange="location='http://mes.simplyone.co.uk/shop/?genre='+genre.options[genre.options.selectedIndex].value">
						<option  value="all">All (<?= count($mb_artists) ?>)</option> 
						<?php 
						foreach($mb_artists as $record){
							echo "<option value='1'>$record</option>";
						}
						?>	
					</select>
				</td>
				<td>
					<select name="genre" size="5" id="genre" onchange="location='http://mes.simplyone.co.uk/shop/?genre='+genre.options[genre.options.selectedIndex].value">
						<option  value="all">All (7)</option> 
					</select>
				</td>
			</tr>
    	</table>  
	</form>
</div>

<h3 class="search_options_header"><a href="#" id="show_search_options">Show Search Options</a></h3>
<div id="search_results_box" class="tracks_list_box">

    <table class="tracks_list_header" style="display: none; background-color: #212121; font: bold 11px Tahoma; color: #FFFFFF; border-collapse: collapse; width: 100%;">
        <tbody>
            <tr>
                <td class="handle" style="padding: 3px;"></td>
                <td class="track_name" style="padding: 3px;">Track</td>
                <td class="track_button" style="padding: 3px;"></td>
                <td class="track_price" style="padding: 3px;"></td>
                <td class="track_genres" style="padding: 3px;">Genres</td>
                <td class="album_name" style="padding: 3px;">Album</td>
                <td class="track_artists" style="padding: 3px;">Artist</td>
                <td id="track_delete_cell" class="track_delete" style="padding: 3px;"></td>
            </tr>
        </tbody>
    </table>
   	
    <div id="search_results_container">

    </div>
    
</div>

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

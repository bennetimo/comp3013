<div class="page_title">
			<h3>Welcome.</h3>
</div>

<div class="content_box">
	<p>
	Musique is an online streaming media player allowing you to listen to 
	all your favourite music and share it easily with your friends.
	
	With an ever-growing library of artists and new ones being added all the time, 
	you can be sure that whatever your taste, there is music for you waiting inside.
	</p>
</div>


<div class="content_box" id="search_results" >
	<ul id="search_results_list">
	</ul>
</div>

<div class="feature_box">
	<h3>127</h3>
	<p>registered users</p>
</div>

<div class="feature_box">
	<h3>3402</h3>
	<p>total tracks</p>
</div>

<div class="feature_box">
	<h3>82</h3>
	<p>featured artists</p>
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
	

<? if($userid): ?>
<div id="playlists">
	<ul id="playlists_list">
	<? foreach ($playlists as $playlist): ?>
		<li><a onclick="loadPlaylist('<?=$playlist->getId()?>')" href="#pl<?=$playlist->getId()?>"><?=$playlist->getName()?></a></li>
	<? endforeach; ?>
	</ul>
</div>
<? endif; ?>


<script type="text/javascript">

// global variable mapping tracks list-items to their track/album ids
window.idToTrack = [];

var loginForm = $("#login_form");
var loginError = $("#login_error");

loginForm.submit(function()
{
	var submit = false;

	$.ajax({
		url: "<?=site_url('usermanager/validate_login_form')?>",
		async: false,
		type: "post",
		dataType: "json",
		data: loginForm.serialize(),

		success: function(data)
		{
			if (data.isValid) {
				submit = true;
				loginError.hide();
				loginError.html("");
			}
			else {
				loginError.html(data.error);
				loginError.show();
			}
		}
	});
	
	return submit;
});

var searchForm = $('#search_form');
var searchResultsList = $("#search_results_list");
var playlistsList = $("#playlists_list");

searchForm.submit(function()
{
	$.ajax({
		url: "<?=site_url('trackmanager/search')?>",
		async: true,
		type: "post",
		dataType: "json",
		data: searchForm.serialize(),

		success: function(data)
		{
			searchResultsList.setResults(data);
			
			searchResultsList.find("li").draggable({
				revert : true,
				revertDuration : 0,
				handle : ".handle",
				opacity : 0.4,
				helper : "clone"
			});
		}
	});

	return false;
});

function loadPlaylist(playlistid)
{
	$.ajax({
		url: "<?=site_url('playlistmanager/get_tracks')?>" + "/" + playlistid,
		async: true,
		dataType: "json",

		success: function(data)
		{
			var startTrackPosition = null;
			var endTrackPosition = null;
			
			searchResultsList.setResults(data);
			searchResultsList.sortable({
				
				start: function(event, ui) {
					startTrackPosition = ui.item.attr("id");
				},
				
				stop: function(event, ui) {
					endTrackPosition = ui.position;
					
					alert(startTrackPosition + " -> " + endTrackPosition);
					
					startTrackPosition = null;
					endTrackPosition = null;
				}
			});
		}
	});
}

playlistsList.find("li").droppable({
	
	drop: function(event, ui) {
		var listItemId = ui.draggable.attr("id");
		idToTrack[listItemId].trackId;
		idToTrack[listItemId].albumId;
	}
});

</script>

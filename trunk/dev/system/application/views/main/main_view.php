
<div class="content_box">
	<p>
	Musique is an online streaming media player allowing you to listen to 
	all your favourite music, and share it easily with your friends.
	
	Get started today to see what you've been missing
	</p>
</div>


<div class="content_box" id="search_results" >
	<table id="search_results_table">
	</table>
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
<ul>
	<a class="styled_button" href="<?=site_url('main')?>"><span>Top Playlists</span></a>
</ul>
</div>

<div class="content_box">
<p>To be on your way to enjoying all this music, create an account free now</p>
<ul>
	<a class="styled_button" href="<?=site_url('main')?>"><span>Create Account</span></a></li>
</ul>
</div>
	
<? if($userid): ?>
<div id="playlists">
	<table id="playlists_table">
	<? foreach ($playlists as $playlist): ?>
		<tr><td><a onclick="loadPlaylist('<?=$playlist->getId()?>')" href="#pl<?=$playlist->getId()?>"><?=$playlist->getName()?></a></td></tr>
	<? endforeach; ?>
	</table>
</div>
<? endif; ?>

<script>

var loginForm = $('#login_form');
var loginError = $('#login_error');

loginForm.submit(function()
{
	var submit = false;

	$.ajax({
		url: '<?=site_url('usermanager/validate_login_form')?>',
		async: false,
		type: 'POST',
		dataType: 'json',
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

var searchResultsTable = $('#search_results_table');

var searchForm = $('#search_form');
var searchResultsTable = $("#search_results_table");

searchForm.submit(function()
{
	$.ajax({
		url: '<?=site_url('trackmanager/search')?>',
		async: true,
		type: 'POST',
		dataType: 'json',
		data: searchForm.serialize(),

		success: function(data)
		{
			//alert(data);
			searchResultsTable.setResults(data);
		}
	});

	return false;
});

function loadPlaylist(playlistid)
{
	$.ajax({
		url: '<?=site_url('playlistmanager/get_tracks/')?>' + playlistid,
		async: true,
		dataType: 'json',

		success: function(data)
		{
			searchResultsTable.setResults(data);
		}
	});
}

</script>

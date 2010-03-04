
<div id="login_box">

<? if($userid == ""): ?>

<h3>Login</h3>

<form id="login_form" action="<?=site_url('usermanager/login')?>" method="POST">

	<input type="text" id="login_email" name="login_email"></input>
	<input type="password" id="login_password" name="login_password"></input>
	<input type="submit" value="login"></input>
	
	<div id="login_error" style="display: none;"></div>
	
</form>

<a href="<?=site_url('register')?>">register</a>

<? else: ?>

<h3>Logout <?=$userid?></h3>

<a href="<?=site_url('usermanager/logout')?>">logout</a>

<? endif; ?>

</div>

<div id="search_box">

<h3>Search</h3>

<form action="<?=site_url('trackmanager/search')?>" method="POST">
	
	<input type="text" name="search"></input>
	<input type="submit" value="search"></input>
		
</form>

<div id="search_results">
<table id="search_results_table">
</table>
</div>

</div>

<script>

var loginForm = $('#login_form');
var loginError = $('#login_error');

loginForm.submit(function()
{
	var submit = false;

	$.ajax({
		url: 'usermanager/validate_login_form',
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
searchResultsTable.setResults([{"name": "First"}, {"name": "Second"}]);

</script>
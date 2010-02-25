
<div id="login_box">

<? if($userid == ""): ?>

<h3>Login</h3>

<form action="<?=site_url('usermanager/login')?>" method="POST">

	<input type="text" id="login_email" name="login_email"></input>
	<input type="password" id="login_password" name="login_password"></input>
	<input type="submit" value="login"></input>
	
</form>

<a href="<?=site_url('register')?>">register</a>

<? else: ?>

<h3>Logout</h3>

<a href="<?=site_url('usermanager/logout')?>">logout</a>

<? endif; ?>

</div>

<div id="search_box">

<h3>Search</h3>

<form action="<?=site_url('trackmanager/search')?>" method="POST">
	
	<input type="text" name="search"></input>
	<input type="submit" value="search"></input>
		
</form>
	
</div>
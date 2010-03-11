<html>

<head>
	<title>Musique</title>
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>system/application/css/main.css"></link>
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>system/application/css/dynamicList.css"></link>
	<script src="<?=base_url()?>system/application/js/jquery.js" type="text/javascript"></script>
	<script src="<?=base_url()?>system/application/js/jquery-ui.js" type="text/javascript"></script>
	<script src="<?=base_url()?>system/application/js/utils.js" type="text/javascript"></script>
</head>

<body>

<script>
window.base_url = "<?=site_url()?>";
</script>

<!-- Create the container div which encompasses the entire page. Closed in footer -->
<div id="container">
	<div id="header">
		<div id="logo">
			<a href="<?=site_url('main')?>">
			<img src="<?=base_url()?>system/application/images/musique_logo_small.png"></img>
			</a>
		</div>
		
		<div id="login_box">
			<? if($userid == ""): ?>			
			<form id="login_form" action="<?=site_url('usermanager/login')?>" method="POST">
				<input type="text" id="login_email" name="login_email" value="email"></input>
				<input type="password" id="login_password" name="login_password" value="password"></input>
				<input type="submit" class="normal_button" value="login"></input>
			</form>
			
			<? else: ?>
			<h3>Logout</h3>
			<a href="<?=site_url('usermanager/logout')?>">logout</a>
			<? endif; ?>
		</div>
	
		<div id="blurb">
			<h3 class="bold_header">Discover Play Enjoy</h3>
		</div>
		
		
		<div id="navigation">
		<!-- The navigation links present on every page -->
		<div id="navigation_links">
			<ul>
				<li><a href="<?=site_url('register')?>">My Playlists</a></li>
				<li><a href="<?=site_url('main/account')?>">My Account</a></li>
				<li><a href="<?=site_url('register')?>">Add Money</a></li>
				<li><a href="<?=site_url('register')?>">Sign up!</a></li>
			</ul>
		</div>
		</div>
	</div>
	
	<!-- Create the content wrapper div which contains all actual contact. Closed in footer -->
	<div id="contents_wrapper">
	
	
	
	<div id="sidebar">
		<div id="search_bar">
			<div id="search_box">
					<h3 class="bold_header">Find Music.</h3>
					<form id="search_form" action="<?=site_url('trackmanager/search')?>" method="POST">
						<input type="text" name="search_term"></input>
						<input type="submit" class="normal_button" value="search" size="15"></input>
						<!-- <input type="radio" name="search_by" value="name" checked="checked" />name
						<input type="radio" name="search_by" value="genre" />genre<br />-->
					</form>	
				</div>
		</div>
	
		<div id="login_error" style="display: none;"></div>
		
		<div id="my_playlists">
		
		</div>
	</div>
	
	<!-- The main content div. All content for the pages should go within here, closed in footer -->
	<div id="content">
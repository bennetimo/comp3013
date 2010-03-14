<html>

<head>

	<title>Musique</title>
	
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>system/application/css/main.css"></link>
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>system/application/css/dynamicList.css"></link>
	<script src="<?=base_url()?>system/application/js/swfobject.js" type="text/javascript"></script>
	<script src="<?=base_url()?>system/application/js/jquery.js" type="text/javascript"></script>
	<script src="<?=base_url()?>system/application/js/jquery-ui.js" type="text/javascript"></script>
	<script src="<?=base_url()?>system/application/js/jquery-template.js" type="text/javascript"></script>
	<script src="<?=base_url()?>system/application/js/utils.js" type="text/javascript"></script>
	<script src="<?=base_url()?>system/application/js/player.js" type="text/javascript"></script>
	<script> window.site_url = "<?=site_url()?>"; window.base_url = "<?=base_url()?>";</script>
	
</head>

<body>

<!-- Create the container div which encompasses the entire page. Closed in footer -->
<div id="container">

	<div id="header">

        <div id="login_box">
        
            <? if($userid == ""): ?>            
            <form id="login_form" action="<?=site_url('usermanager/login')?>" method="POST">
                <input type="text" id="login_email" name="login_email" value="email"></input>
                <input type="password" id="login_password" name="login_password" value="password"></input>
                <input type="submit" class="normal_button" value="login"></input>
            </form>            
            <? else: ?>
                You are logged in as 
                <?=$user->getFName()?>:
                <a href="<?=site_url('usermanager/logout')?>">Logout</a>
            <? endif; ?>
            
        </div>
	
		<div id="logo">
			<a href="<?=site_url('main')?>">
			<img src="<?=base_url()?>system/application/images/musique_logo.jpg"></img>
			</a>
		</div>
	
<!--		<div id="blurb">-->
<!--<h3 class="bold_header">Discover Play Enjoy</h3>-->
<!--		</div>-->
		
		
<!--		<div id="navigation2">-->
<!--			 The navigation links present on every page -->
<!--			<div id="navigation_links">-->
<!--				<ul>-->
<!--					<li><a href="<?=site_url('main')?>">Home</a></li>-->
<!--					<li><a href="<?=site_url('search')?>">Search</a></li>-->
<!--					<li><a href="<?=site_url('main/account')?>">My Account</a></li>-->
<!--					<li><a href="<?=site_url('main')?>">My Music</a></li>-->
<!--					<li><a href="<?=site_url('register')?>">Sign up!</a></li>-->
<!--				</ul>-->
<!--			</div>-->
<!--		</div>-->
		
	</div>
	
	<div id="error_box"></div>
	
	<!-- Create the content wrapper div which contains all actual contact. Closed in footer -->
	<div id="contents_wrapper">	
	<div id="sidebar">
		<div id="search_bar">
			<div id="search_box">
			
                <h3>Find Music.</h3>
                <form id="search_form" action="<?=site_url('trackmanager/search')?>" method="POST">
                    <input type="text" id="search_input" name="search_term"></input><input type="submit" class="normal_button" value="search" size="15"></input><br />
                    <span class="search_by_label">search by</span>
                    <input type="radio" name="search_by" value="name" checked="checked" /><span class="search_by_label">name</span>
                    <input type="radio" name="search_by" value="artist" checked="checked" /><span class="search_by_label">artist</span>
                    <input type="radio" name="search_by" value="genre" /><span class="search_by_label">genre</span>
                </form>
                
            </div>
		</div>
		
    <? if($userid): ?>
    <div id="playlist_section">
    
        <h3>My Playlists</h3>
        
        <!-- USER PLAYLISTS SECION -->
            
        <?if(!count($playlists)):?><p>You have no playlists yet, create one below!</p><?endif;?>
        <div id="playlists">
            <table id="playlists_list">

                <? foreach ($playlists as $playlist): ?>
                <tr id="<?=$playlist->getId()?>">
                    <td><a onclick="loadPlaylist('<?=$playlist->getId()?>')" href="#pl<?=$playlist->getId()?>"><?=$playlist->getName()?></a></td>
                    <td><?php if($playlist->isShared()){echo " *";}?></td>
                    <td><a href="javascript:void(0)" onclick="removePlaylist('<?=$playlist->getId()?>')" >X</a></td>
                </tr>	                
                <? endforeach; ?>
                    
            </table>
        </div>
            
        <!--  ADD NEW PLAYLIST SECTION -->
        
        <div id="add_playlist_box">
            
	        <a href="#" id="add_pl"><h3>Add New Playlist</h3></a>
	        <form id="add_pl_form">
	            <table id="add_playlist_table">
	                <tr><td><input type="text" value="playlist name" id="pl_name" /></td><td><input type="submit" class="normal_button" value="Add" /></td></tr>
	                <tr><td><input type="checkbox" value="1" id="pl_shared" />shared</td><td></td></tr>
	            </table>
	        </form>
	        
        </div>
    </div>
    <? endif; ?>

	<div id="login_error" style="display: none;"></div>
	<div id="drag" style="background-color: green;"></div>
	
</div>
	

<!-- The main content div. All content for the pages should go within here, closed in footer -->
<div id="content">

    <div class="page_title">
        <h3><?= $page_title?></h3>
    </div>

    <!-- A simple padding div to ensure that all content is padding appropriately, except the page title -->
    <div id="content_padder">
    
    
    
    
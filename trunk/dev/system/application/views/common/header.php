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
        <script> window.site_url = "<?=site_url()?>"; window.base_url = "<?=base_url()?>"; </script>
    </head>
    
    <body>
        
        <!-- Create the container div which encompasses the entire page. Closed in footer -->
        <div id="container">
            <div id="header">
                
                <!-- Login Box -->
                
                <div id="login_box">
                    <? if($userid == ""): ?>
                    <form id="login_form" action="<?=site_url('usermanager/login')?>" method="POST">
                        <input type="text" id="login_email" name="login_email" value="email" /><input type="password" id="login_password" name="login_password" value="password" /><input type="submit" class="normal_button" value="login" />
                    </form>
                    <? else: ?>
                    You are logged in as 
                    <?=$user->getFName()?>
                    <input onclick="javascript:location='<?=site_url()?>/usermanager/logout'" type="submit" class="normal_button" value="logout" />
                    <? endif; ?>
                </div>
                
                <div id="logo_box">
                    <a href="<?=site_url('main')?>"><img src="<?=base_url()?>system/application/images/musique_logo2.png" border="0" /></a>
                </div>
                
                <div id="navigation">
                    <!-- The navigation links present on every page -->
                    <div id="navigation_links">
                        <ul>
                            <li>
                                <a href="<?=site_url('main')?>">Home</a>
                            </li>
                            <!--<li><a href="<?=site_url('search')?>">Search</a></li>-->
                            <li>
                                <a href="javascript:loadMyAccount();">My Account</a>
                            </li>
                            <li>
                                <a href="javascript:loadUserCollection()">My Music</a>
                            </li>
                            <? if($userid == ""): ?>
                            <li>
                                <a href="<?=site_url('register')?>">Sign up!</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
            </div>
            
            <div id="error_box"></div>
            
            <!-- Create the content wrapper div which contains all actual contact. Closed in footer -->
            <div id="contents_wrapper">
                
                <div id="sidebar" style="position: relative;">
                
                    <div id="search_box">
                        <h3>Find Music.</h3>
                        <form id="search_form" action="<?=site_url('trackmanager/search')?>" method="POST">
                            <input type="text" id="search_input" name="search_term" /><input type="submit" class="normal_button" value="search" size="15" />
                            <br/>
                            <input type="radio" name="search_by" value="name" checked="checked" /><span class="search_by_label">name</span>
                            <input type="radio" name="search_by" value="artist" checked="checked" /><span class="search_by_label">artist</span>
                            <input type="radio" name="search_by" value="genre" /><span class="search_by_label">genre</span>
                            <input type="radio" name="search_by" value="playlist" /><span class="search_by_label">playlist</span>
                        </form>
                    </div>
                            
                    <? if($userid): ?>
                    <div id="playlist_section">
                        
                        <!-- Users Playlists Section -->
                        
                        <h3>My Playlists</h3>
                        
                        <? if(!count($playlists)): ?>
                        <p>You have no playlists yet, create one below!</p>
                        <? endif; ?>
                        
                        <div id="playlists">
                            <table id="playlists_list">
                                <? foreach ($playlists as $playlist): $read_only = $userid != $playlist->getOwnerId(); ?>
                                <tr id="<?=$playlist->getId()?>" class="<?if($read_only) echo "read-only"; ?>" style="position: relative;">
                                    <td><a onclick="loadPlaylist('<?=$playlist->getId()?>',0)" href="#pl<?=$playlist->getId()?>"><?=$playlist->getName()?></a></td>
                                    <td class="playlist_play"><a onclick="player.playPlaylist('<?=$playlist->getId()?>')" href="#pl<?=$playlist->getId()?>"><img src="<?=base_url()?>system/application/images/button_play.png" /></a></td>
                                    <td class="playlist_is_shared<?=($playlist->isShared() ? " shared" : "")?>"></td>
                                    <td class="playlist_delete"><a href="javascript:void(0)" class="ui-playlist-delete-button" onclick="removePlaylist('<?=$playlist->getId()?>')"></a></td>
                                </tr>
                                <? endforeach; ?>
                            </table>
                        </div>
                        
                        <!-- Add New Playlist Section -->
                        
                        <div id="playlist_add_box">
                            <h3><a href="#" id="playlist_add_link">Add New Playlist</a></h3>
                            <form id="playlist_add_form">
                                <table id="playlist_add_table">
                                    <tr>
                                        <td><input type="text" value="playlist name" id="playlist_new_input" /></td>
                                        <td><input type="submit" class="normal_button" value="Add" /></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="1" id="pl_shared" />shared</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        
                    </div>
                    <? endif; ?>
                    
                </div>
                        
<!-- The main content div. All content for the pages should go within here, closed in footer -->
<div id="<?=(isset($dark) && $userid ? "content_dark" : "content") ?>">



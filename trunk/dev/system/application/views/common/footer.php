		<div id="music_note">
			<img src="<?=base_url()?>system/application/images/music_note.png"></img>
		</div>
	</div><!-- Close the contents created in the header -->
	</div><!-- Close the contents_wrapper created in the header -->
	
	<div id="footer">
		<div id="quick_links">
			<div class="section">
				<h3>About</h3>
				<ul>
					<li><a href="<?=site_url('main')?>">What is Musique?</a></li>
					<li><a href="<?=site_url('main')?>">Features</a></li>
				</ul>
			</div>
			<div class="section">
				<h3>Playlists</h3>
				<ul>
					<li><a href="<?=site_url('main')?>">View My Playlists</a></li>
					<li><a href="<?=site_url('main')?>">Create a new playlist</a></li>
					<li><a href="<?=site_url('main')?>">View my friends playlists</a></li>
				</ul>
			</div>
			<div class="section">
				<h3>Account</h3>
				<ul>
					<li><a href="<?=site_url('main')?>">Update Email</a></li>
					<li><a href="<?=site_url('main')?>">Change password</a></li>
					<li><a href="<?=site_url('main')?>">Recover lost password</a></li>
				</ul>
			</div>	
			<div class="section">
				<h3>Help</h3>
				<ul>
					<li><a href="<?=site_url('main')?>">FAQ</a></li>
					<li><a href="<?=site_url('main')?>">Contact Us</a></li>
				</ul>
			</div>
		</div>
	</div>
	

</div><!-- Close the container div created in the header -->

<div id="latch">
	<script type='text/javascript' src='<?=base_url()?>system/application/jwplayer/swfobject.js'></script>
	<div id='mediaspace'>This text will be replaced</div>
	<script type='text/javascript'>
  var so = new SWFObject('<?=base_url()?>system/application/jwplayer/player.swf','ply','470','24','9');
  so.addParam('allowfullscreen','true');
  so.addParam('allowscriptaccess','always');
  so.addParam('wmode','opaque');
  so.addVariable('duration','33');
  so.addVariable('file','http://www.longtailvideo.com/jw/upload/bunny.mp3');
  so.addVariable('backcolor','000000');
  so.addVariable('frontcolor','FFFFFF');
  so.addVariable('lightcolor','000000');
  so.write('mediaspace');
</script>
</div>



</body>
</html>
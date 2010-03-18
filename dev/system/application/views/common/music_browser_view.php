
<? if ($mb_genres && $mb_artists && $mb_albums): ?>

<div id="music_browser_box" style="display: <?=$display?>">

<div id="music_browser">
    <form action="<?=site_url('main')?>" method="post" id="music_browser_form">
        <table>
            <tr align="center" valign="top">
                <td><div class="music_browser_header">Genre</div></td>
                <td><div class="music_browser_header">Artist</div></td>
                <td><div class="music_browser_header">Album</div></td>
            </tr>
            <tr align="center" valign="top">
                <td>
                    <select name="genre" size="5" id="genre" >
                        <option  value="all" selected="true">All (<?= count($mb_genres) ?>)</option> 
                        <?php 
                        foreach($mb_genres as $record){
                            echo "<option value='{$record['id']}'>{$record['name']}</option>";
                        }
                        ?>  
                    </select>
                </td>
                <td>
                    <select name="genre" size="5" id="artist">
                        <option  value="all" selected="true">All (<?= count($mb_artists) ?>)</option> 
                        <?php 
                        foreach($mb_artists as $record){
                            echo "<option value='{$record['id']}'>{$record['name']}</option>";
                        }
                        ?>  
                    </select>
                </td>
                <td>
                    <select name="genre" size="5" id="album">
                        <option  value="all" selected="true">All (<?= count($mb_albums) ?>)</option> 
                        <?php 
                        foreach($mb_albums as $record){
                            echo "<option value='{$record['id']}'>{$record['name']}</option>";
                        }
                        ?>  
                    </select>
                </td>
            </tr>
        </table>  
    </form>
</div>

<h3 class="search_options_header"><a href="#" id="show_search_options">Show Search Options</a></h3>

</div>

<? endif; ?>
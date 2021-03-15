<?php
    include("header.php");

    function round_size($size)
    {
        if ($size < 1023) {
            return $size . " b";
        } else if ($size > 1024 && $size < 1048575) {
            return round($size / 1024, -2) . " kb";
        } else {
            return round($size / 1048576, 2) . " mb";
        }
    }

    $is_playlist = FALSE;

    function append_dir($ele) {
        return "songs/" . $ele;
    }

?>


<div id="listarea">
    <ul id="musiclist">
        <?php
            if (isset($_REQUEST["playlist"])) {
                $selected_playlist = $_REQUEST["playlist"];

                $songs = file("songs/$selected_playlist");

                $songs = array_map('append_dir', $songs);

                $is_playlist = TRUE;
            } else {
                $songs = glob("songs/*.mp3");
            }
            foreach ($songs as $song) {

                $song_size = round_size(filesize($song));
                ?>

                <li class="mp3item">
                    <a href=<?=$song?>><?=$song?></a>
                    (<?=$song_size?>)
                </li>
        <?php
            }
        ?>


        <?php
            if (!$is_playlist){
            $playlists = glob("songs/*.txt");
            foreach ($playlists as $playlist) {
                ?>
        <li class="playlistitem">
            <a href=<?="?playlist=".basename($playlist) ?>><?= $playlist?></a>
        </li>


        <?php
            }
            }
        ?>

    </ul>
</div>

<?php
include("footer.php");
?>

<?php
require("connect-db.php");

require("playlist-db.php");


$playlists = listAllPlaylists();
#var_dump($playlists);

?>


<body>
    <h1>Playlists</h1>
    <?php foreach ($playlists as $playlist): ?>
        <form action="manage_playlist.php" method="post">
            <input type="hidden" name="pid" value="<?php echo htmlspecialchars($playlist['pid']); ?>">
            <input type="submit" value="<?php echo htmlspecialchars($playlist['uid']); ?>">
        </form>
    <?php endforeach; ?>
</body>
</html>


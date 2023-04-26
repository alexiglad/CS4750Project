<?php
require_once("connect-db.php");
require_once("playlist-db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sid = isset($_POST['sid']) ? $_POST['sid'] : null;
    $query = isset($_POST['query']) ? $_POST['query'] : null;
    // var_dump($sid);
    // var_dump($query);

    if ($sid === null) {
        die("No song ID provided.");
    } else {
        $playlists = listAllPlaylists();
    }
}
?>

<!-- ... -->

<body>
    <h1>Add Song to Playlist</h1>
    <div class="cards" style="margin:2%;">
        <h2>Playlists</h2>
        <?php foreach ($playlists as $playlist): ?>
            <div class="card" style="background-color: #f3f3f3; width: 10rem; height: 5rem;">
                <form action="search.php" method="post" class="mx-auto my-auto">
                    <input type="hidden" name="sid" value="<?php echo htmlspecialchars($sid); ?>">
                    <input type="hidden" name="pid" value="<?php echo htmlspecialchars($playlist['pid']); ?>">
                    <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">
                    <input type="submit" value="<?php echo htmlspecialchars($playlist['name']); ?>">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>

<?php
require_once("db_interfacing/connect-db.php");
require_once("db_interfacing/playlist-db.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$listener_profile = getListenerProfile($_SESSION['uid']); 
$artist_profile = getArtistProfile($_SESSION['uid']); 


$playlists = listAllPlaylists();
#var_dump($playlists);
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-auto-rows: auto;
        grid-gap: 1rem;
    }
    .backbutton{
        text-decoration: none;
        font-weight: bold;
        color: #6f63ad;
        margin-bottom: 5%;
    }
    .backbutton:hover{
        text-decoration: underline;
        color: #6f63ad;
    }
</style>
<body>
    <h1>About</h1>

    <?php if (!empty($listener_profile)): ?>
        
        <h2>Listener Profile</h2>

        <p><strong>Favorite Genre:</strong> <?php echo htmlspecialchars($listener_profile[0]['favorite_genre']); ?></p>
        <p><strong>Favorite Artist:</strong> <?php echo htmlspecialchars($listener_profile[0]['favorite_artist']); ?></p>
        <p><strong>Favorite Song:</strong> <?php echo htmlspecialchars($listener_profile[0]['song_name']); ?></p>

    <?php endif; ?>

    <?php if (!empty($artist_profile)): ?>
        <h2>Artist Profile</h2>
        <p><strong>Studio:</strong> <?php echo htmlspecialchars($artist_profile[0]['studio']); ?></p>
        <p><strong>Genre:</strong> <?php echo htmlspecialchars($artist_profile[0]['genre']); ?></p>
    <?php endif; ?>


    <hr>
    <h1>Playlists</h1>

    <?php
    $owned_playlists = array();
    $unowned_playlists = array();

    foreach ($playlists as $playlist) {
        if ($playlist['uid'] == $_SESSION['uid']) {
            $owned_playlists[] = $playlist;
        } else {
            $unowned_playlists[] = $playlist;
        }
    }
    ?>

    <h2>Your Playlists</h2>
    <div class="cards" style="margin:2%;">
        <?php foreach ($owned_playlists as $playlist): ?>
            <div class="card" style="background-color: #f3f3f3; width: 10rem; height: 5rem;">
                <form action="manage_playlist.php" method="post" class="mx-auto my-auto">
                    <input type="hidden" name="pid" value="<?php echo htmlspecialchars($playlist['pid']); ?>">
                    <input type="hidden" name="is_owned" value="1">
                    <input type="submit" value="<?php echo htmlspecialchars($playlist['name']); ?>">
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Playlist Discovery</h2>
    <div class="cards" style="margin:2%;">
        <?php foreach ($unowned_playlists as $playlist): ?>
            <div class="card" style="background-color: #f3f3f3; width: 10rem; height: 5rem;">
                <form action="manage_playlist.php" method="post" class="mx-auto my-auto">
                    <input type="hidden" name="pid" value="<?php echo htmlspecialchars($playlist['pid']); ?>">
                    <input type="hidden" name="is_owned" value="0">
                    <input type="submit" value="<?php echo htmlspecialchars($playlist['name']); ?>">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

<?php
require_once("db_interfacing/connect-db.php");
require_once("db_interfacing/playlist-db.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
} 
In this code, session_status() == PHP_SESSION_NONE checks if a session has been started. If not, session_start() starts a new session.

The isset($_SESSION['username']) check determines if the 'username' session variable is set. If it's not set, the user is not logged in. If it is set, the user is logged in.

Keep in mind that this is a very





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sid = isset($_POST['sid']) ? $_POST['sid'] : null;
    $query = isset($_POST['query']) ? $_POST['query'] : null;
    // var_dump($sid);
    // var_dump($query);

    if ($sid === null) {
        die("No song ID provided.");
    } else {
        $playlists = listAllPlaylists();
        $owned_playlists = array();
        foreach ($playlists as $playlist) {
            if ($playlist['uid'] == $_SESSION['uid']) {
                $owned_playlists[] = $playlist;
            }
        }
    }
}
?>

<!-- ... -->
<?php include 'navbar.php';?>

<style>
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

    .cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-auto-rows: auto;
        grid-gap: 1rem;
    }

    
  body {
    height: 100%;
    width: 100%;
    }

    .fullheight{
        overflow-y: scroll;
    }

    input[type=submit] {
        background-color: #d5d1eb; 
        width: 8rem; 
        height: 3rem;
        border: none;
        text-decoration: none;
    }

</style>

<body>
<div class="fullheight" style="background-color: #f3f3f3; width: 25%; height: 90vh; float:left; padding: 3%; border-right: 0.5px solid rgb(207, 207, 207);">  
    <?php include 'userinfo.php';?>
  </div>  

  <div class="fullheight" style="background-color: white; width:75%; height: 90vh; float:left; padding: 3%;">  
    <h1>Add Song to Playlist</h1>
    <a class="backbutton" aria-current="page" href="index.php">Back to Profile</a>
    <br><br>

    <div class="cards" style="margin:2%;">
        <?php foreach ($owned_playlists as $playlist): ?>
            <div class="card" style="background-color: #d5d1eb; width: 10rem; height: 5rem;">
                <form action="search.php" method="post" class="mx-auto my-auto">
                    <input type="hidden" name="sid" value="<?php echo htmlspecialchars($sid); ?>">
                    <input type="hidden" name="pid" value="<?php echo htmlspecialchars($playlist['pid']); ?>">
                    <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">
                    <input type="submit" value="<?php echo htmlspecialchars($playlist['name']); ?>" >
                </form>
            </div>
        <?php endforeach; ?>
    </div>
        </div>
</body>

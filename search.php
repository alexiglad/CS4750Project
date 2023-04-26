<?php
require_once("connect-db.php");
require_once("search-db.php");
require_once("playlist-db.php");


if($_SERVER['REQUEST_METHOD'] == 'POST' || (isset($_GET['query']) && !empty($_GET['query'])))
{

//var_dump($_POST);
    $query = isset($_POST['query']) ? $_POST['query'] : null;
    $sid = isset($_POST['sid']) ? $_POST['sid'] : null;
    $pid = isset($_POST['pid']) ? $_POST['pid'] : null;
    // var_dump($query);
    // var_dump($_POST['sid']);
    // var_dump($_POST['pid']);
    if ($query === null) {// Handle the case when pid is not provided or request is not POST 
        
        die("No query provided.");
    }
    else{
        $songs = getSongs($query);
        $playlists = getPlaylists($query);

        if ($sid != null && $pid != null) {
            addSongToPlaylist($sid, $pid);
        } 
    }
    

}
?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php include 'navbar.php';?>

<style>
    .cards {
        display: flex;
        flex-direction: column;
        margin: 2%;
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
  <div style="background-color: #f3f3f3; width: 25%; height: 100vh; float:left; padding: 3%; border-right: 0.5px solid rgb(207, 207, 207);">  
    <?php include 'userinfo.php';?>
  </div>  

  <div style="background-color: white; width:75%; height: 100vh; float:left; padding: 3%;">  
    <h1>Search Results</h1>
    <a class="backbutton" aria-current="page" href="index.php">Back to Profile</a>
    <br> <br>

    <div class="cards" style="margin:2%;">
        <h2>Songs</h2>
           
        <?php foreach ($songs as $song): ?>
        
            <div class="card" style="background-color: #f3f3f3; width: 90%; height: 3rem; display:inline-block; ">
                <p style="float:left; padding-left: 1rem; line-height: 3rem;" class="mx-auto my-auto"><?php echo htmlspecialchars($song['name']); ?></p>
                <form style = "float:right; padding-right: 1rem; line-height: 3rem;" action="add_to_playlist.php" method="post">
                    <input type="hidden" name="sid" value="<?php echo htmlspecialchars($song['sid']); ?>">
                    <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">
                    <input type="submit" value="Add to Playlist">
                </form>
            </div>
           
        <?php endforeach; ?>

        <br>
        <h2>Playlists</h2>
        <?php foreach ($playlists as $playlist): ?>
            <div class="card" style="background-color: #f3f3f3; width: 10rem; height: 5rem;">
                <form action="manage_playlist.php" method="post" class="mx-auto my-auto">
                    <input type="hidden" name="pid" value="<?php echo htmlspecialchars($playlist['pid']); ?>">
                    <input type="submit" value="<?php echo htmlspecialchars($playlist['name']); ?>">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    </div>
</body>
</html>
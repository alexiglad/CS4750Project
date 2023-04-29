<?php
require_once("db_interfacing/connect-db.php");
require_once("db_interfacing/playlist-db.php");
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

//var_dump($_POST);
    $pid = isset($_POST['pid']) ? $_POST['pid'] : null;
    if ($pid === null) {// Handle the case when pid is not provided or request is not POST 
        
        die("No playlist ID provided.");
    }
    else{
        $songs = selectAllSongsInPlaylist($pid);
        $playlistname = getPlaylistName($pid);
        //TODO redo this code to check if it is owned based on pid
        $is_owned = ownsPlaylist($_SESSION['uid'], $pid);
        //var_dump($playlistname);
        //var_dump($songs);
    }
    if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Delete")){
        deleteSongFromPlaylist($_POST['sid_to_delete'], $_POST['pid']);
    } 
    if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Update Name")) {
      updatePlaylistName($_POST['pid'], $_POST['new_name']);
      $playlistname = getPlaylistName($pid);

    }
  

    #var_dump($songs);
}
?>



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

  body {
  height: 100%;
  width: 100%;
}

  .fullheight{
    overflow-y: scroll;
}

</style>

<body>
  <div class = "fullheight" style="background-color: #f3f3f3; width: 25%; height: 90vh; float:left; padding: 3%; border-right: 0.5px solid rgb(207, 207, 207);">  
    <?php include 'userinfo.php';?>
  </div>  

  <div class="fullheight" style="background-color: white; width:75%; height: 90vh; float:left; padding: 3%;">  

    <a class="backbutton" aria-current="page" href="index.php">Back to Playlists</a>
    <br> <br>

    <h1><?php foreach ($playlistname as $name) {echo $name['name'], "\n";} ?></h1>

    <?php if ($is_owned): ?>
        <form action="manage_playlist.php" method="post">
            <label for="new_name">New playlist name:</label>
            <input type="text" name="new_name" id="new_name" required>
            <input type="submit" name="actionBtn" value="Update Name" style="padding: 4px; color: black; border: 1px solid #6f63ad; background-color:#d5d1eb;" />
            <input type="hidden" name="pid" value="<?php echo $_POST['pid']; ?>" />
        </form>
    <?php endif; ?>
    <br>
    <div class="row justify-content-center">  
    <table class="w3-table w3-bordered w3-card-4 center" style="width:97%">
      <thead>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <tr style="background-color:#6f63ad; color: white;">
        <th width="30%">Song Name 
        <?php if ($is_owned): ?>
          <th width="30%">Delete? 
        <?php endif; ?>       
      </tr>
      </thead>

    <?php foreach ($songs as $characteristic): ?>
      <tr>
        <td><?php echo $characteristic['sname']; ?></td> 
        <td>
          <form action = "manage_playlist.php" method="post">
            
            <?php if ($is_owned): ?>
                <input type="submit" name="actionBtn" value="Delete" class="btn btn-danger" />
            <?php endif; ?>
            <input type="hidden" name="sid_to_delete" value="<?php echo $characteristic['sid']; ?>" />
            <input type="hidden" name="pid" value="<?php echo $_POST['pid']; ?>" />
          </form>
        </td>      
      </tr>
    <?php endforeach; ?>
    </table>
    </div> 
</div>
</body>
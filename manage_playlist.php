<?php
require("connect-db.php");
require("playlist-db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

var_dump($_POST);
    $pid = isset($_POST['pid']) ? $_POST['pid'] : null;
    if ($pid === null) {// Handle the case when pid is not provided or request is not POST 
        
        die("No playlist ID provided.");
    }
    else{
        $songs = selectAllSongsInPlaylist($pid);
    }
    if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Delete")){
        deleteSongFromPlaylist($_POST['sid_to_delete'], $_POST['pid']);
  
    } 

    // Your code to manage the playlist with the given $pid
    #var_dump($songs);
}
?>







<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <tr style="background-color:#B0B0B0">
    <th width="30%">Name        
    <th width="30%">Delete? 
    
  </tr>
  </thead>
<?php foreach ($songs as $characteristic): ?>
  <tr>
    <td><?php echo $characteristic['sname']; ?></td> 
    <td>
      <form action = "manage_playlist.php" method="post">
        <input type="submit" name="actionBtn" value="Delete" class="btn btn-danger" />
        <input type="hidden" name="sid_to_delete" value="<?php echo $characteristic['sid']; ?>" />
        <input type="hidden" name="pid" value="<?php echo $_POST['pid']; ?>" />

      </form>
    </td>              
  </tr>
<?php endforeach; ?>
</table>
</div> 
<?php
require("connect-db.php");
require("playlist-db.php");


$playlists = listAllPlaylists();
#var_dump($playlists);
?>
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
</style>

<body>

    <div style="background-color: #f3f3f3; width: 25%; height: 100vh; float:left; padding: 3%; border-right: 0.5px solid rgb(207, 207, 207);">  
        <h1 class="mx-auto"> User Info </h2>
    </div>  

    <div style="background-color: white; width:75%; height: 100vh; float:left; padding: 3%;">  
        <h1>About</h1>
        <hr>
        <h1>Playlists</h1>
        <div class = "cards" style="margin:2%;">
            <?php foreach ($playlists as $playlist): ?>
                <!--<div class="card" style="background-color: #f3f3f3; width: 10rem; height: 5rem;">-->
                <form action="manage_playlist.php" method="post">
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($playlist['name']); ?>">
                    <input type="submit" value="<?php echo htmlspecialchars($playlist['uid']); ?>">
                </form>
                <!--</div>-->
            <?php endforeach; ?>
        <div>
    </div>  

    
</body>
</html>


<?php
require_once("connect-db.php");
require_once("playlist-db.php");


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
        <hr>
        <h1>Playlists</h1>
        <div class = "cards" style="margin:2%;">
            <?php foreach ($playlists as $playlist): ?>
                <div class="card" style="background-color: #f3f3f3; width: 10rem; height: 5rem;">
                <form action="manage_playlist.php" method="post" class = "mx-auto my-auto">
                    <input type="hidden" name="pid" value="<?php echo htmlspecialchars($playlist['pid']); ?>">
                    <input type="submit" value="<?php echo htmlspecialchars($playlist['name']); ?>">
                </form>
                </div>
            <?php endforeach; ?>
        <div>
</body>
</html>


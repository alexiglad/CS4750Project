<?php
require_once("db_interfacing/connect-db.php");
require_once("db_interfacing/user-db.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .sidebar {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .sidebar img {
        width: 70%;
        display: block;
        margin-bottom: 25px;
        border-radius: 50%;
    }
</style>
<body>
<div class="sidebar">
    <h2 class="mx-auto"><?php echo $_SESSION['username'] ?></h2>
    <br><br>
    <div class="card card-body" style="background-color: #ffffff;">
        <div class="card-text">
            <div class="row">
                <!-- Friends Column -->
                <div class="col">
                    <h4>Friends</h4>
                    <?php
                    $friends = getFriends($_SESSION['uid']);

                    // Loop through friends and display each friend's username
                    if (!empty($friends)) {
                        echo 'Total friends: ' . count($friends) . '<br>';
                        foreach ($friends as $friend) {
                            if ($friend['uid1'] == $_SESSION['uid']) {
                                echo htmlspecialchars($friend['user2username']);
                            } else {
                                echo htmlspecialchars($friend['user1username']);
                            }
                            echo '<br>';
                        }
                    } else {
                        echo 'No friends found.';
                    }
                    ?>
                </div>


                <div class="col">
                    <h4>Liked Songs</h4>
                    <?php
                    
                    $liked_songs = getLikedSongs($_SESSION['uid']);

                    if (!empty($liked_songs)) {
                        echo 'Total liked songs: ' . count($liked_songs) . '<br>';
                        foreach ($liked_songs as $song) {
                            echo htmlspecialchars($song['name']);
                            echo '<br>';
                        }
                    } else {
                        echo 'No liked songs found.';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

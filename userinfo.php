<?php
require_once("db_interfacing/connect-db.php");
require_once("db_interfacing/user-db.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
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

    <h2 class="mx-auto" style="padding-top:4%;"><?php echo $_SESSION['username'] ?></h2>
    <br>
    <div class="card card-body text-center" style="background-color: #ffffff; width: 15rem;">
        <div class="card-text">
                <!-- Friends Column -->
                    <?php
                    $friends = getFriends($_SESSION['uid']);

                    // Loop through friends and display each friend's username
                    if (!empty($friends)) {
                        $countfriend = count($friends);
                        echo "<h4> $countfriend Friends </h4>" . '<hr>'; 
                        // 'Total friends: ' . count($friends) . '<br>';
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
    </div>
    <br>
    <div class="card card-body text-center" style="background-color: #ffffff; width: 15rem;">
        <div class="card-text">
                    <?php
                    
                    $liked_songs = getLikedSongs($_SESSION['uid']);

                    if (!empty($liked_songs)) {
                        //echo 'Total liked songs: ' . count($liked_songs) . '<br>';
                        $countlikes = count($liked_songs);
                        echo "<h4> $countlikes Liked Songs </h4>" . '<hr>'; 

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
</body>

</html>

<?php
function getFriends($uid){
    global $db;
    $query = "SELECT users1.uid as uid1, users1.username as user1username, users2.uid as uid2, users2.username as user2username FROM users as users1 INNER JOIN befriends ON users1.uid = befriends.uid1 INNER JOIN users as users2 ON users2.uid = befriends.uid2 WHERE befriends.uid1 = :uid OR befriends.uid2 = :uid";

    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->bindValue(':uid', $uid);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function getLikedSongs($uid){
    global $db;

    $query = "SELECT song.name FROM likes NATURAL JOIN song WHERE likes.uid = :uid";
    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->bindValue(':uid', $uid);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function getListenerProfile($uid){
    global $db;

    $query = "SELECT fav_artist.username as favorite_artist, song.name as song_name, listenerprofile.favorite_genre FROM song INNER JOIN listenerprofile ON song.sid = listenerprofile.favorite_song_sid INNER JOIN users as fav_artist ON listenerprofile.uid = fav_artist.uid WHERE listenerprofile.uid = :uid";
    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->bindValue(':uid', $uid);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;

}

function getArtistProfile($uid){
    global $db;

    $query = "SELECT artistprofile.genre, artistprofile.studio FROM artistprofile WHERE artistprofile.uid = :uid";
    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->bindValue(':uid', $uid);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
    
}



?>
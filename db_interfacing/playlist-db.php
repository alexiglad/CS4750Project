<?php

function ownsPlaylist($uid, $pid){
    global $db;

    $query = "SELECT COUNT(*) FROM createplaylist WHERE createplaylist.uid = :uid AND createplaylist.pid = :pid";

    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->bindValue(':uid', $uid);
    $statement->bindValue(':pid', $pid);
    $statement->execute();
    $count = $statement->fetchColumn();
    $statement->closeCursor();
    return $count >= 1;
}

function updatePlaylistName($pid, $name)
{

    global $db;

    $query = "update playlist set name = :name where pid = :pid";
    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->bindValue(':name', $name);
    $statement->bindValue(':pid', $pid);
    $statement->execute();
    $statement->closeCursor();
 
}

function deleteSongFromPlaylist($sid, $pid)
{

    global $db;

    $query = "delete from isadded where sid = :sid and pid = :pid";
    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->bindValue(':sid', $sid);
    $statement->bindValue(':pid', $pid);
    $statement->execute();
    $statement->closeCursor();
 
}

function selectAllSongsInPlaylist($pid){

    global $db;

    $query = "SELECT isadded.*, song.name AS sname FROM isadded 
              JOIN song ON isadded.sid = song.sid 
              WHERE isadded.pid = :pid";

    $statement = $db->prepare($query);
    $statement->bindValue(':pid', $pid);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    return $results;

}

function listAllPlaylists(){
    global $db;
    $query = "SELECT createplaylist.*, playlist.name 
              FROM createplaylist JOIN playlist ON playlist.pid = createplaylist.pid";
    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function getPlaylistName($pid){
    global $db;
    $query = "SELECT playlist.name FROM playlist WHERE playlist.pid = :pid";
    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->bindValue(':pid', $pid);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function addSongToPlaylist($sid, $pid) {
    global $db;

    $query = "INSERT IGNORE INTO isadded (pid, sid) VALUES (:pid, :sid)";

    $statement = $db->prepare($query);
    $statement->bindValue(':sid', $sid);
    $statement->bindValue(':pid', $pid);
    $statement->execute();
    $statement->closeCursor();
}



?>
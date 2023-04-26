<?php

function getSongs($substr){

    global $db;

    $query = "SELECT song.name, song.sid FROM song  
              WHERE song.name like :substr";

    $statement = $db->prepare($query);
    $statement->bindValue(':substr', '%' . $substr . '%');
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    return $results;

}

function getPlaylists($substr){
    global $db;

    $query = "SELECT playlist.name, playlist.pid FROM playlist  
              WHERE playlist.name like :substr";

    $statement = $db->prepare($query);
    $statement->bindValue(':substr', '%' . $substr . '%');
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    return $results;
}

?>
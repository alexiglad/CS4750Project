<?php
//have code to insert friend in friend table
function addSongToPlaylist($name, $pid)
{
    global $db;

    $query = "insert into playlist value (:pid, :name)";
    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->bindValue(':name', $name);
    $statement->bindValue(':pid', $pid);
    $statement->execute();
    $statement->closeCursor();

    
}
// function updateFriend($name, $major, $year)
// {

//     global $db;

//     $query = "update friends set major = :newMajor, year = :newYear where name = :oldName";
//     $statement = $db->prepare($query);//allows for precompiling of queries
//     $statement->bindValue(':oldName', $name);
//     $statement->bindValue(':newMajor', $major);
//     $statement->bindValue(':newYear', $year);
//     $statement->execute();
//     $statement->closeCursor();
 
// }
// function getFriendByName($name)
// {
//     global $db;

//     $query = "select * from friends where name = :name";
//     $statement = $db->prepare($query);//allows for precompiling of queries
//     $statement->bindValue(':name', $name);
//     $statement->execute();
//     $result = $statement->fetch();
//     $statement->closeCursor();
//     return $result;
// }
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
    //this is a temporary function just for the EC milestone, people will access playlists from profiles
    global $db;
    $query = "SELECT playlist.name 
              FROM createplaylist JOIN playlist ON playlist.pid = createplaylist.pid";
    $statement = $db->prepare($query);//allows for precompiling of queries
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}
?>
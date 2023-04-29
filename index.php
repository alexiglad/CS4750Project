<!DOCTYPE html>
<html>

<?php include 'navbar.php';?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
html,
body {
  height: 100%;
  width: 100%;
}

.fullheight{
    overflow-y: scroll;
}
</style>
<body>
    <div class="fullheight" style="background-color: #f3f3f3; width: 25%; height: 90vh; float:left; padding: 3%; border-right: 0.5px solid rgb(207, 207, 207);">  
    <?php include 'userinfo.php';?>
    </div>  

    <div class="fullheight" style="background-color: white; width:75%; height: 90vh; float:left; padding: 3%; ">  
    <?php include 'list_playlists.php';?>
    </div>
</body>

</html>


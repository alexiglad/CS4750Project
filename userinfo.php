<?php
require("connect-db.php");

?>
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

    .sidebar img{
        width: 70%;
        display: block;
        margin-bottom: 25px;
        border-radius: 50%;
    }
</style>

<body>

  <div class="sidebar">
    <img src="images/icon.png">
    <h2 class="mx-auto"> [USERNAME] </h2>
    <br><br>
    <div class="card card-body" style="background-color: #ffffff;">
        <div class = "card-text"> 
            <h4> 14 Friends </h4>
        </div>
    </div>
  </div>

</body>

</html>


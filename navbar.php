<!DOCTYPE html>
<html>

<head>
  <title>Navbar</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="content-language" content="en-us">
  <meta name="description" content="Navigation bar for the website.">

  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
  .navbar{
    border-bottom: 0.5px solid rgb(207, 207, 207);
    background-color: #6f63ad;
    color: #ffffff;
  }

  .navbar-nav .nav-item a{
      color: #000000; 
      font-weight: bold;
  }

  .btn:hover{
    background-color: #082340;
  }

 
</style>

<body>

<nav class="navbar">
  <div class="container-fluid" >
  <a class="navbar-brand" style="font-weight: bold; color: #ffffff;" href="logout.php">HoosListening</a>
    <form class="d-flex" action="search.php" method="POST">
      <input class="form-control me-2" style="width:430px;" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn" style="color: #ffffff;" type="submit">Search</button>
    </form>
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="logout.php">Log Out</a>
        </li>
    </ul>
  </div>
</nav>

</body>

</html>

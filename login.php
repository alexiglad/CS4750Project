<!DOCTYPE html>

<html>

<head>

    <title>LOGIN</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

     <form action="login.php" method="post">

        <h2>LOGIN</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>User Name</label>

        <input type="text" name="username" placeholder="User Name"><br>

        <label>Password</label>

        <input type="passw" name="passw" placeholder="Password"><br> 

        <button type="submit" name="Login">Login</button>

     </form>

<?php 
if (isset($_POST['Login'])){
session_start(); 

include "connect-db.php";


if (isset($_POST['username']) && isset($_POST['passw'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);
       
       return $data;
    }

    $username = validate($_POST['username']);

    $passw = validate($_POST['passw']);

    if (empty($username)) {

        header("Location: login.php?error=User Name is required");

        exit();

    }else if(empty($passw)){

        header("Location: login.php?error=Password is required");

        exit();

    }else{
        
$sql = "SELECT * FROM users WHERE username='$username' AND passw='$passw'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {

    $row = mysqli_fetch_assoc($result);

    if ($row['username'] === $username && $row['passw'] === $passw) {

        echo "Logged in!";

        $_SESSION['username'] = $row['username'];

        $_SESSION['email'] = $row['email'];

        $_SESSION['uid'] = $row['uid'];

        header("Location: index.php");

        exit();

    }else{

        header("Location: login.php?error=Incorect username or password");

        exit();

    }

}else{

    header("Location: login.php?error=Incorect username or password");

    exit();

}

}

}else{

header("Location: login.php");

exit();

}
}
?>


</body>

</html>

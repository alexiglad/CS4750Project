<!DOCTYPE html>

<html>

<head>

    <title>LOGIN</title>

</head>

<style>
body {
    background: #a094e3;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
}

*{
    box-sizing: padding-box;
}

form {
    width: 1000px;
    border: 3px solid rgb(72, 65, 112);
    padding: 20px;
    background: #6f63ad;
    border-radius: 20px;
    color: white;
}

h2 {
    text-align: center;
    margin-bottom: 40px;
}

input {
    display: block;
    border: 2px solid #ccc;
    width: 95%;
    padding: 10px;
    margin: 10px auto;
    border-radius: 5px;
}

label {
    color: white;
    font-size: 18px;
    padding: 10px;
}

button {
    float: right;
    background: rgb(35, 174, 202);
    padding: 10px 15px;
    color: #fff;
    border-radius: 5px;
    margin-right: 10px;
    border: none;
}

button:hover{
    opacity: .10;
}

.error {
   background: #F2DEDE;
   color: #0c0101;
   padding: 10px;
   width: 95%;
   border-radius: 5px;
   margin: 20px auto;
}

h1 {
    text-align: center;
    color: rgb(134, 3, 3);
}

a {
    float: right;
    background: rgb(183, 225, 233);
    padding: 10px 15px;
    color: #fff;
    border-radius: 10px;
    margin-right: 10px;
    border: none;
    text-decoration: none;
}

a:hover{
    opacity: .7;
}
</style>

<body>

     <form action="login.php" method="post">

        <h2>LOGIN</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>Username</label>

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

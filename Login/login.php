<?php
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required';
    }
    if (empty($_POST['pass'])) {
        $errors['pass'] = 'Password is required';
    }
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "todo";
    $connect = new mysqli($serverName, $userName, $password, $dbName);
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
    if (empty($errors)) {
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $loggedIn = false;
        $query="SELECT * From users where name='$username'";
        $result=mysqli_query($connect,$query);
        $no=mysqli_num_rows($result);
        if($no>0){
            $data=mysqli_fetch_assoc($result);
            if($data['password']==$pass){
                setcookie('username', $username, time() + (24 * 60 * 60), '/');
                setcookie('password', $pass, time() + (24 * 60 * 60), '/');
            $_SESSION['username'] = $username;
            // $query2="SELECT id FROM users where name='$userName";
            // $result2=mysqli_query($connect,$query2);
            // $user_id=mysqli_fetch_assoc($result2);
            $_SESSION['user_id']=$data['id'];
            $user_id= $_SESSION['user_id'];
            $loggedIn = true;
            header('Location: ../session2/front/pages/index.php');
            exit;
            }
            else{
                echo 'Wrong Password';
            }

        }
        if (!$loggedIn) {
            $errors['login'] = 'Username or password is incorrect';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Username">
        <?php if (isset($errors['username'])) {
            echo "<span style='color:red'>" . $errors['username'] . " </span>";
        }
        ?>
        <br>
        <input type="password" name="pass" placeholder="Password">
        <?php if (isset($errors['pass'])) {
            echo "<span style='color:red'>" . $errors['pass'] . " </span>";
        }
        ?>
        <?php if (isset($errors['login'])) {
            echo "<span style='color:red'>" . $errors['login'] . " </span>";
        }
        ?>
        <br>
        <button type="submit" name="login">Login</button>
    </form>
    <p>You do not have an account</p>
    <a href="register.php">Create a new account</a>
</body>
</html>
    
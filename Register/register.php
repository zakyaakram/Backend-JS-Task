<?php
$errors = [];
$errorsimage = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    if (empty($_POST['firstName'])) {
        $errors['firstName'] = 'First Name is required';
    }
    if (empty($_POST['lastName'])) {
        $errors['lastName'] = 'Last Name is required';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    }
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
        $errors['email']='Email is not a valid email address';
    }
    
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    }
    if (empty($_POST['confirmPassword'])) {
        $errors['confirmPassword'] = 'Confirm Password is required';
    } else {
        if ($_POST['password'] != $_POST['confirmPassword']) {
            $errors['confirmPassword'] = 'Password confirmation does not match';
        }
    }
    if (!isset($_POST['gender'])) {
        $errors['gender'] = 'You must choose a gender';
    }

    if ($_FILES['image']['error'] == 4) {
        $errorsimage[] = 'You must upload an image';
    } else {
        $allowedExtensions = ['jpg', 'png', 'gif', 'jpeg'];
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($extension), $allowedExtensions)) {
            $errorsimage[] = 'Image extension must be jpg, png, gif, or jpeg';
        }
    }

    if (empty($errors) && empty($errorsimage)) {
        $firstName = $_POST['firstName'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "todo";
        $connect = new mysqli($serverName, $userName, $password, $dbName);
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
         }
        $name=$_POST['firstName'];
        $password=$_POST['password'];
        $email=$_POST['email'];
        $query = "INSERT INTO users (name , email , password) VALUES ('$name' , '$email' , '$password')";
        $result = mysqli_query($connect, $query);
        if ($result) {
            echo "user added successfully"; 
        } else {
            echo "error in adding user " . mysqli_error($connect);
        }
        header('Location: login.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
</head>

<body>
    <h1>Registration</h1>
    <form method="post" action="register.php" enctype="multipart/form-data">
        <input type="text" name="firstName" placeholder="First Name">
        <?php if (isset($errors['firstName'])) {
            echo "<span style='color:red'>" . $errors['firstName'] . " </span>";
        }
        ?>
        <br>
        <input type="text" name="lastName" placeholder="Last Name">
        <?php if (isset($errors['lastName'])) {
            echo "<span style='color:red'>" . $errors['lastName'] . " </span>";
        }
        ?>
        <br>
        <input type="password" name="password" placeholder="Password">
        <?php if (isset($errors['password'])) {
            echo "<span style='color:red'>" . $errors['password'] . " </span>";
        }
        ?>
        <br>
        <input type="password" name="confirmPassword" placeholder="Confirm Password">
        <?php if (isset($errors['confirmPassword'])) {
            echo "<span style='color:red'>" . $errors['confirmPassword'] . " </span>";
        }
        ?>
        <br>
        <input type="email" name="email" placeholder="Email">
        <?php if (isset($errors['email'])) {
            echo "<span style='color:red'>" . $errors['email'] . " </span>";
        }
        ?>
        <br>
        <input type="file" name="image">
        <?php
        if (!empty($errorsimage)) {
            foreach ($errorsimage as $error) {
                echo "<p style='color:red'>$error</p>";
            }
        }
        ?>
        <br>
        <input type="radio" name="gender" value="male"> Male
        <input type="radio" name="gender" value="female"> Female
        <?php if (isset($errors['gender'])) {
            echo "<span style='color:red'>" . $errors['gender'] . " </span>";
        }
        ?>
        <br>
        <button type="submit" name="register">Register</button>
    </form>
    <p>You have an account <a href="login.php">Log in</a></p>

</body>

</html>
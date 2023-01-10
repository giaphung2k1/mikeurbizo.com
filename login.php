<?php

// Connect to the database
$host = "localhost";
$user = "root";
$password = "89ad8a2dde63c3aa";
$dbname = "micaphn";

$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the user input
$username = $_POST["username"];
$password = $_POST["password"];

// Check the login credentials against the database
$sql = "SELECT * FROM usuarios WHERE usuario = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user) {
    // Check if the password matches
    if (password_verify($password, $user["contrasena"])) {
        // Login successful, redirect to the dashboard
        session_start();
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        // Password is incorrect
        echo "Username or password is incorrect";
    }
} else {
    // User not found
    echo "Username or password is incorrect";
}

 // } else {
 //     // Unsuccessful login
 //     header('Location: login.php?error=Invalid login credentials');
 // }
mysqli_close($conn);

?>


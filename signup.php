<?php
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Check that the password and confirm password fields match
  if ($password != $confirm_password) {
      header('Location: signup.php?error=Passwords do not match');
      exit;
  }

  // Hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Establish a connection to the database
  $conn = mysqli_connect("localhost", "root", "89ad8a2dde63c3aa", "micaphn");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Insert the new user into the database
  $query = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$username', '$hashed_password')";
  $result = mysqli_query($conn, $query);

  // Redirect to the login page
  header('Location: index.html');
?>

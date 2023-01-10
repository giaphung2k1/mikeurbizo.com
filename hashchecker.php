<!DOCTYPE html>
<html>
<head>
  <title>Password Verification</title>
</head>
<body>
  <div style="text-align: center;">
    <form action="hashchecker.php" method="post">
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username"><br>
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password"><br><br>
      <input type="submit" value="Verify">
    </form> 
  </div>
</body>
</html>

<?php
  // Connect to the database
  $host = "localhost";
  $username = "root";
  $password = "89ad8a2dde63c3aa";
  $dbname = "micaphn";

  $conn = mysqli_connect($host, $username, $password, $dbname);
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Retrieve the form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare and execute a SELECT statement to retrieve the hashed password from the database
  $stmt = mysqli_prepare($conn, "SELECT contrasena FROM usuarios WHERE usuario = ?");
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  mysqli_stmt_close($stmt);

  // Check if a matching record was found
  if ($row = mysqli_fetch_assoc($result)) {
      // A matching record was found, so verify the provided password against the hashed password
      $hashed_password = $row['password'];
      if (password_verify($password, $hashed_password)) {
          echo "The provided password matches the hashed password.";
      } else {
          echo "The provided password does not match the hashed password.";
      }
  } else {
      // No matching record was found, so display an error message
      echo "No matching record was found for the specified username.";
  }

  // Close the database connection
  mysqli_close($conn);
?>

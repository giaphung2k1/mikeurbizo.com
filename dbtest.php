<?php
  // Check if the form has been submitted
  if (isset($_POST['submit'])) {
      // Retrieve the form data
      $host = $_POST['host'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      // Attempt to establish a connection to the database
      $conn = mysqli_connect($host, $username, $password);

      // Check connection
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      } else {
          echo "Connection successful!";
      }
  }
?>

<html>
<head>
  <title>MySQL Connection Test</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <form class="connection-form" action="" method="post">
      <h1>MySQL Connection Test</h1>
      <label for="host">Host:</label><br>
      <input type="text" id="host" name="host" value="<?php if (isset($_POST['host'])) echo $_POST['host']; ?>"><br><br>
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"><br><br>
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password"><br><br><br>
      <input type="submit" name="submit" value="Test Connection">
    </form>
  </div>
</body>
</html>

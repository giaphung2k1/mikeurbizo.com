<?php
    // Connect to the database
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "call_center";
    
    $conn = mysqli_connect($host, $user, $password, $dbname);
    
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    
    
    // Build the SELECT statement
    $query = "SELECT COLUMN_NAME 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE 
    TABLE_SCHEMA = Database()
AND TABLE_NAME = 'agent_data'";
    
    // Execute the query
    $result = mysqli_query($conn, $query);
        
?>
<!DOCTYPE html>
<html>
<head>
  <title>Call Center Report</title>
</head>
<body>
  <h1>Call Center Report</h1>
  <form action="query.php" method="post">
    <?php 
    // Check if the query was successful
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <input type="checkbox" id="<?=$row['COLUMN_NAME']?>" name="fields[]" value="<?=$row['COLUMN_NAME']?>">
    <label for="<?=$row['COLUMN_NAME']?>"><?=$row['COLUMN_NAME']?></label>
    <br>
    <?php
        }
        }else {
            // If the query was not successful, print an error message
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    
        // Close the connection
        mysqli_close($conn);
    ?>
    <!--<input type="checkbox" id="agent_no" name="fields[]" value="agent_no">-->
    <!--<label for="agent_no">Agent No</label>-->
    <!--<br>-->
    <!--<input type="checkbox" id="agent_name" name="fields[]" value="agent_name">-->
    <!--<label for="agent_name">Agent Name</label>-->
    <!--<br>-->
    <!--<input type="checkbox" id="login_minutes" name="fields[]" value="login_minutes">-->
    <!--<label for="login_minutes">Login Minutes</label>-->
    <!--<br>-->
    <!-- Add more fields here -->
    <button type="submit">Generate Report</button>
  </form>
</body>
</html>



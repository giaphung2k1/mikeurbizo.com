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

// Get the selected fields from the POST request
$fields = $_POST["fields"];

// Build the SELECT statement
$query = "SELECT " . implode(", ", $fields) . " FROM agent_data";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
  // If the query was successful, display the results in an HTML table
  echo "<table>";
  echo "<tr>";
  foreach ($fields as $field) {
    echo "<th>" . $field . "</th>";
  }
  echo "</tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($fields as $field) {
      echo "<td>" . $row[$field] . "</td>";
    }
    echo "</tr>";
  }
  echo "</table>";
} else {
  // If the query was not successful, print an error message
  echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>

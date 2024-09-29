<?php
$servername = "zlc.h.filess.io";
$username = "testingDatabase_keptgavein";
$password = "9430e6cad387a14dc0375621b019d76c9d1d177b";
$dbname = "testingDatabase_keptgavein";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch data from the database
$sql = "SELECT 
       trainCompanyName, 
       trainDate, 
       scheduledDep, 
       fromLocation, 
       actualDep, 
       scheduledArr, 
       toLocation, 
       actualArrival, 
       cancellation, 
       nextAvailableTrain, 
       delay_time FROM topDelayedTrainsPerDay";
$result = $conn->query($sql);
$passDetails = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $passDetails[] = $row;
    }
}
// Close the connection
$conn->close();
// Set the response header to JSON
header('Content-Type: application/json');
// Encode the data to JSON and output it
echo json_encode($passDetails, JSON_PRETTY_PRINT);
?>
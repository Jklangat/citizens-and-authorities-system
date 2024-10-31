<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_calendar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

$title = $data['title'];
$time_from = $data['time_from'];
$time_to = $data['time_to'];
$day = $data['day'];
$month = $data['month'];
$year = $data['year'];

$sql = "INSERT INTO events (title, time_from, time_to, day, month, year) VALUES ('$title', '$time_from', '$time_to', '$day', '$month', '$year')";

if ($conn->query($sql) === TRUE) {
    $response = ["status" => "success", "message" => "Event saved successfully"];
} else {
    $response = ["status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error];
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>

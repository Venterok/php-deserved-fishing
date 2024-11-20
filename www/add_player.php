<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GameDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$player_name = $_POST['player_name'];
$player_password = password_hash($_POST['player_password'], PASSWORD_BCRYPT);

$sql = "INSERT INTO Player (player_name, player_password) VALUES ('$player_name', '$player_password')";
if ($conn->query($sql) === TRUE) {
    echo "New player added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

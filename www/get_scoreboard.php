<?php
$servername = getenv('MYSQL_HOST') ?: 'localhost';
$username = getenv('MYSQL_USER') ?: 'root';
$password = getenv('MYSQL_PASSWORD') ?: '';
$dbname = getenv('MYSQL_DATABASE') ?: 'GameDB';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Scoreboard ORDER BY player_score DESC";
$result = $conn->query($sql);

$scoreboard = array();
while($row = $result->fetch_assoc()) {
    $scoreboard[] = $row;
}

echo json_encode($scoreboard);

$conn->close();
?>

<?php
$servername = getenv('MYSQL_HOST') ?: 'localhost';
$username = getenv('MYSQL_USER') ?: 'root';
$password = getenv('MYSQL_PASSWORD') ?: '';
$dbname = getenv('MYSQL_DATABASE') ?: 'GameDB';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$player_id = $_POST['player_id'];
$field_name = $_POST['field_name'];
$field_value = $_POST['field_value'];

$sql = "UPDATE Player SET $field_name='$field_value' WHERE player_id='$player_id'";
if ($conn->query($sql) === TRUE) {
    echo "UpdateSuccess";
} else {
    echo "UpdateFailed";
}

$conn->close();
?>

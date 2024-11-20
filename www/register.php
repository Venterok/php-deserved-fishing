<?php
$servername = getenv('MYSQL_HOST') ?: 'localhost';
$username = getenv('MYSQL_USER') ?: 'root';
$password = getenv('MYSQL_PASSWORD') ?: '';
$dbname = getenv('MYSQL_DATABASE') ?: 'GameDB';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$player_name = $_POST['player_name'];
$player_password = password_hash($_POST['player_password'], PASSWORD_BCRYPT);

$sql = "SELECT * FROM Player WHERE player_name='$player_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "UserExists";
} else {

    $sql = "INSERT INTO Player (player_name, player_password) VALUES ('$player_name', '$player_password')";
    if ($conn->query($sql) === TRUE) {
        echo "RegistrationSuccess";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

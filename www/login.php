<?php
$servername = getenv('MYSQL_HOST') ?: 'localhost';
$username = getenv('MYSQL_USER') ?: 'root';
$password = getenv('MYSQL_PASSWORD') ?: '';
$dbname = getenv('MYSQL_DATABASE') ?: 'GameDB';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("status" => "ConnectionFailed", "message" => $conn->connect_error)));
}

$player_name = $_POST['player_name'];
$player_password = $_POST['player_password'];

if (empty($player_name) || empty($player_password)) {
    echo json_encode(array("status" => "Error", "message" => "Имя пользователя или пароль пусты."));
    exit();
}

$sql = "SELECT player_id, player_name, player_password FROM Player WHERE player_name=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $player_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['player_password'];

    if (password_verify($player_password, $hashedPassword)) {

        $response = array(
            "status" => "LoginSuccess",
            "player_id" => $row['player_id'],
            "player_name" => $row['player_name']
        );
        echo json_encode($response);
    } else {
        // Неверный пароль
        echo json_encode(array("status" => "InvalidPassword", "message" => "Неверный пароль."));
    }
} else {
    // Пользователь не найден
    echo json_encode(array("status" => "UserNotFound", "message" => "Пользователь не найден."));
}

$stmt->close();
$conn->close();
?>

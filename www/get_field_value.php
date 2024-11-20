
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GameDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$player_id = $_POST['player_id'];
$field_name = $_POST['field_name'];


$allowed_fields = ['player_score', 'player_currency', 'player_caught', 'player_baits', 'player_gacha']; // Укажите допустимые поля
if (!in_array($field_name, $allowed_fields)) {
    echo "InvalidField";
    exit();
}

$sql = "SELECT $field_name FROM Player WHERE player_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row[$field_name];
} else { echo "PlayerNotFound";}

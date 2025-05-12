<?php
require 'config.php';

$page = $_GET['page'] ?? 'tablice';

switch ($page) {
    case 'city':
        $table = 'city';
        break;
    case 'warsaw':
        $table = 'wwa';
        break;
    case 'nowwa':
        $table = 'nowwa';
        break;
    case 'police':
        $table = 'police';
        break;
    default:
        $table = 'tablice';
}

$input = $_GET['input'] ?? '';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT answer FROM `$table` WHERE answer LIKE '%$input%' ORDER BY RAND()";
$result = $conn->query($sql);
$output = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
}

echo json_encode($output);
$conn->close();
?>


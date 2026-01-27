<?php
require 'config.php';

// Whitelist dozwolonych tabel - bezpieczeństwo!
$allowed_tables = ['city', 'wwa', 'nowwa', 'police', 'tablice'];
$page = $_GET['page'] ?? 'tablice';
// Mapowanie page -> table
$table_map = [
    'city' => 'city',
    'warsaw' => 'wwa',
    'nowwa' => 'nowwa',
    'police' => 'police',
    'classic' => 'tablice',
    'police' => 'police' 
];

$table = isset($table_map[$page]) ? $table_map[$page] : 'tablice';

// Input cleaning
$input = $_GET['input'] ?? '';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// PREPARED STATEMENT
$searchTerm = "%" . $input . "%";
$stmt = $conn->prepare("SELECT answer FROM `$table` WHERE answer LIKE ? ORDER BY RAND() LIMIT 5"); // LIMIT dla wydajności
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$output = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
}

echo json_encode($output);
$stmt->close();
$conn->close();
?>
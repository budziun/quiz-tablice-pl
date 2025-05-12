<?php
session_start();
require 'config.php';

$wojewodztwo = $_SESSION['wojewodztwo'] ?? '';
$input = $_GET['input'] ?? '';

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Używamy prepared statement dla bezpieczeństwa
$sql = "SELECT answer FROM `tablice` WHERE answer LIKE ? AND wojewodztwo = ? ORDER BY RAND()";
$stmt = $conn->prepare($sql);

// Dodajemy znaki % dla zapytania LIKE
$searchTerm = '%' . $input . '%';

// Bindujemy parametry
$stmt->bind_param("ss", $searchTerm, $wojewodztwo);

// Wykonujemy zapytanie
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
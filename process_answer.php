<?php
session_start();
require 'config.php';

// Ustawienie nagłówka JSON (ważne dla JS)
header('Content-Type: application/json');

// 1. WHITELIST TABEL
$allowed_tables = [
    'city' => 'city',
    'warsaw' => 'wwa',
    'nowwa' => 'nowwa',
    'police' => 'police',
    'classic' => 'tablice',
    'tablice' => 'tablice'
];

$page = $_POST['page'] ?? 'tablice';
$table = $allowed_tables[$page] ?? 'tablice';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed']);
    exit;
}

if (!isset($_SESSION['answeredQuestions'])) {
    $_SESSION['answeredQuestions'] = [];
}

if (!isset($_SESSION['points'])) {
    $_SESSION['points'] = 0;
}

// Liczba pytań
$sqlCount = "SELECT COUNT(*) as total FROM `$table`";
$resultCount = $conn->query($sqlCount);
$totalQuestions = ($resultCount && $row = $resultCount->fetch_assoc()) ? $row['total'] : 0;

$inputText = trim($_POST['text'] ?? '');
$recordID = $_SESSION['recordID'] ?? 0;

// Pobranie poprawnej odpowiedzi
$stmt = $conn->prepare("SELECT `answer` FROM `$table` WHERE `id` = ?");
$stmt->bind_param("i", $recordID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $correctAnswer = $row['answer'];

    // Porównanie (case-insensitive)
    if (mb_strtolower($inputText) === mb_strtolower($correctAnswer)) {
        
        // WIN
        if ($_SESSION['points'] >= $totalQuestions - 1) {
            session_unset();
            session_destroy();
            echo json_encode(['status' => 'win']);
            exit;
        }

        // CORRECT
        $_SESSION['points']++;
        $_SESSION['answeredQuestions'][] = $recordID;

        // Losowanie nowego ID
        $safetyCounter = 0;
        do {
            $newRandomID = rand(1, $totalQuestions);
            $safetyCounter++;
        } while (in_array($newRandomID, $_SESSION['answeredQuestions']) && $safetyCounter < 500);
        
        $_SESSION['recordID'] = $newRandomID;
        
        echo json_encode(['status' => 'correct']);

    } else {
        // INCORRECT
        // POPRAWKA: Najpierw zapisujemy punkty, potem niszczymy sesję
        $finalPoints = $_SESSION['points'];
        
        session_unset();
        session_destroy();
        
        echo json_encode([
            'status' => 'incorrect', 
            'correct_answer' => $correctAnswer,
            'points' => $finalPoints
        ]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No record found']);
}

$stmt->close();
$conn->close();
?>
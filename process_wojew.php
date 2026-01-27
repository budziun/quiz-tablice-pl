<?php
session_start();
require 'config.php';
header('Content-Type: application/json');

$wojewodztwo = $_SESSION['wojewodztwo'] ?? '';

// Definicja zakresów ID dla województw
$wojewodztwaZakresy = [
    'kujawsko-pomorskie' => ['start' => 1, 'end' => 23],
    'podlaskie' => ['start' => 24, 'end' => 39],
    'dolnośląskie' => ['start' => 40, 'end' => 68],
    'łódzkie' => ['start' => 69, 'end' => 92],
    'lubuskie' => ['start' => 93, 'end' => 106],
    'pomorskie' => ['start' => 107, 'end' => 126],
    'małopolskie' => ['start' => 127, 'end' => 148],
    'lubelskie' => ['start' => 149, 'end' => 172],
    'warmińsko-mazurskie' => ['start' => 173, 'end' => 193],
    'opolskie' => ['start' => 194, 'end' => 205],
    'wielkopolskie' => ['start' => 206, 'end' => 240],
    'podkarpackie' => ['start' => 241, 'end' => 265],
    'śląskie' => ['start' => 266, 'end' => 301],
    'świętokrzyskie' => ['start' => 302, 'end' => 315],
    'mazowieckie' => ['start' => 316, 'end' => 371],
    'zachodnio-pomorskie' => ['start' => 372, 'end' => 392]
];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['status' => 'error']); exit;
}

if (!isset($_SESSION['answeredQuestions'])) $_SESSION['answeredQuestions'] = [];
// Inicjalizacja punktów jeśli brak (dla bezpieczeństwa)
if (!isset($_SESSION['points'])) $_SESSION['points'] = 0;

if (!isset($wojewodztwaZakresy[$wojewodztwo])) {
    echo json_encode(['status' => 'error', 'message' => 'Wrong wojewodztwo']); exit;
}

$startId = $wojewodztwaZakresy[$wojewodztwo]['start'];
$endId = $wojewodztwaZakresy[$wojewodztwo]['end'];

// Liczba pytań
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM `tablice` WHERE wojewodztwo = ?");
$stmt->bind_param("s", $wojewodztwo);
$stmt->execute();
$resultCount = $stmt->get_result();
$totalQuestions = ($resultCount->num_rows > 0) ? $resultCount->fetch_assoc()['total'] : 0;

$inputText = trim($_POST['text'] ?? '');

// Sprawdzenie odpowiedzi
$stmt = $conn->prepare("SELECT `answer` FROM `tablice` WHERE `id` = ?");
$stmt->bind_param("i", $_SESSION['recordID']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $correctAnswer = $row['answer'];

    if (mb_strtolower($inputText) === mb_strtolower($correctAnswer)) {
        if ($_SESSION['points'] >= $totalQuestions - 1) {
            session_unset(); session_destroy();
            echo json_encode(['status' => 'win']); exit;
        }

        $_SESSION['points']++;
        $_SESSION['answeredQuestions'][] = $_SESSION['recordID'];
       
        $safety = 0;
        do {
            $newRandomID = rand($startId, $endId);
            $safety++;
        } while (in_array($newRandomID, $_SESSION['answeredQuestions']) && $safety < 500);

        $_SESSION['recordID'] = $newRandomID;
        echo json_encode(['status' => 'correct']);
        
    } else {
        // Zapisujemy punkty przed wyczyszczeniem sesji!
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
    echo json_encode(['status' => 'error']);
}
$stmt->close();
$conn->close();
?>
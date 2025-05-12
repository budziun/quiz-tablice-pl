<?php
session_start();
$wojewodztwo = $_SESSION['wojewodztwo'] ?? '';
require 'config.php';

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
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['answeredQuestions'])) {
    $_SESSION['answeredQuestions'] = [];
}

// Sprawdzenie czy województwo istnieje w tablicy zakresów
if (!isset($wojewodztwaZakresy[$wojewodztwo])) {
    die("Nieprawidłowe województwo");
}

$startId = $wojewodztwaZakresy[$wojewodztwo]['start'];
$endId = $wojewodztwaZakresy[$wojewodztwo]['end'];

// Bezpieczne zapytanie SQL z użyciem prepared statement
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM `tablice` WHERE wojewodztwo = ?");
$stmt->bind_param("s", $wojewodztwo);
$stmt->execute();
$resultCount = $stmt->get_result();

if ($resultCount->num_rows > 0) {
    $row = $resultCount->fetch_assoc();
    $totalQuestions = $row['total'];
} else {
    $totalQuestions = 0;
}

$inputText = $_POST['text'];

// Bezpieczne zapytanie dla sprawdzenia odpowiedzi
$stmt = $conn->prepare("SELECT `answer` FROM `tablice` WHERE `id` = ?");
$stmt->bind_param("i", $_SESSION['recordID']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $correctAnswer = $row['answer'];

    if ($_SESSION['points'] == $totalQuestions-1) {
        session_unset();
        session_destroy();
        echo "win";
        exit;
    }

    if ($inputText === $correctAnswer) {
        echo "correct";
        $_SESSION['points']++;
        $_SESSION['answeredQuestions'][] = $_SESSION['recordID'];
       
        do {
            // Generowanie ID z odpowiedniego zakresu dla danego województwa
            $newRandomID = rand($startId, $endId);
        } while (in_array($newRandomID, $_SESSION['answeredQuestions']));

        $_SESSION['recordID'] = $newRandomID;
        
    } else {
        session_unset();
        session_destroy();
        echo "incorrect"; 
    }
} else {
    echo "No records found in the database.";
}

$stmt->close();
$conn->close();
?>
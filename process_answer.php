<?php
session_start();

require 'config.php';
$page = $_POST['page'] ?? 'tablice';

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
    case 'classic':
        $table = 'tablice';
        break;
    default:
        $table = 'blad';
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['answeredQuestions'])) {
    $_SESSION['answeredQuestions'] = [];
}

$sqlCount = "SELECT COUNT(*) as total FROM `$table`";
$resultCount = $conn->query($sqlCount);

if ($resultCount->num_rows > 0) {
    $row = $resultCount->fetch_assoc();
    $totalQuestions = $row['total'];
} else {
    $totalQuestions = 0; 
}


$inputText = $_POST['text'];

$sql = "SELECT `answer` FROM `$table` WHERE `id` = ".$_SESSION['recordID'];
$result = $conn->query($sql);

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
            $newRandomID = rand(1, $totalQuestions);
        } while (in_array($newRandomID, $_SESSION['answeredQuestions']));

        $_SESSION['recordID'] = $newRandomID; // Ustaw nowy wybrany ID
        
    } else {
        session_unset();
        session_destroy();
        echo "incorrect"; 
    }
} else {
    echo "No records found in the database.";
}

$conn->close();
?>
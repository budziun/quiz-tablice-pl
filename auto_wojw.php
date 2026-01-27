<?php
session_start();
require 'config.php';

$wojewodztwo = $_SESSION['wojewodztwo'] ?? '';
$input = $_GET['input'] ?? '';

// --- FUNKCJA TWORZĄCA WZORZEC "FUZZY" ---
function createFuzzyPattern($term) {
    $term = mb_strtolower($term);
    $pattern = '';
    $len = mb_strlen($term);

    for ($i = 0; $i < $len; $i++) {
        $char = mb_substr($term, $i, 1);
        switch ($char) {
            case 'a': case 'ą': $pattern .= '[aą]'; break;
            case 'c': case 'ć': $pattern .= '[cć]'; break;
            case 'e': case 'ę': $pattern .= '[eę]'; break;
            case 'l': case 'ł': $pattern .= '[lł]'; break;
            case 'n': case 'ń': $pattern .= '[nń]'; break;
            case 'o': case 'ó': $pattern .= '[oó]'; break;
            case 's': case 'ś': $pattern .= '[sś]'; break;
            case 'z': case 'ź': case 'ż': $pattern .= '[zźż]'; break;
            default: $pattern .= preg_quote($char); break;
        }
    }
    return $pattern;
}
// ----------------------------------------

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Tworzymy wzorzec (np. "lodz" -> "[lł][oó]d[zźż]")
$searchTerm = createFuzzyPattern($input);

// Używamy REGEXP zamiast LIKE
$sql = "SELECT answer FROM `tablice` WHERE answer REGEXP ? AND wojewodztwo = ? ORDER BY RAND()";
$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $searchTerm, $wojewodztwo);

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
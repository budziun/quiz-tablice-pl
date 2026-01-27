<?php
require 'config.php';

// Whitelist dozwolonych tabel
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

// Pobranie inputu
$input = $_GET['input'] ?? '';

// --- FUNKCJA TWORZĄCA WZORZEC "FUZZY" (l == ł, o == ó itd.) ---
function createFuzzyPattern($term) {
    // Normalizujemy do małych liter dla uproszczenia
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
            default: 
                // Zabezpieczenie znaków specjalnych, jeśli ktoś wpisze np. kropkę
                $pattern .= preg_quote($char); 
                break;
        }
    }
    return $pattern;
}
// --------------------------------------------------------------

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Zamiast LIKE używamy REGEXP z naszym wzorcem
$searchTerm = createFuzzyPattern($input);

// Zapytanie SQL (REGEXP szuka wzorca w dowolnym miejscu ciągu)
$stmt = $conn->prepare("SELECT answer FROM `$table` WHERE answer REGEXP ? ORDER BY RAND() LIMIT 5");
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
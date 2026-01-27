<?php
// init_db.php - Skrypt inicjalizacji bazy danych

// Ładowanie konfiguracji połączenia
require 'config.php';

// Komunikat inicjalizacji
echo "<h1>Inicjalizacja bazy danych</h1>";

// Nawiązanie połączenia
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }
    
    echo "<p>Połączono z bazą danych: $dbname</p>";
    
    // Sprawdź czy tabele istnieją
    $tables_check = $conn->query("SHOW TABLES");
    $existing_tables = [];
    
    if ($tables_check->num_rows > 0) {
        while($row = $tables_check->fetch_array()) {
            $existing_tables[] = $row[0];
        }
    }
    
    echo "<p>Znaleziono istniejące tabele: " . implode(", ", $existing_tables) . "</p>";
    
    // Wczytaj plik SQL z definicją tabel
    $sql_file = file_get_contents(__DIR__ . '/sql/tablice.sql');
    
    // Podziel plik na pojedyncze zapytania
    $queries = explode(';', $sql_file);
    
    // Licznik udanych zapytań
    $success_count = 0;
    
    // Wykonaj każde zapytanie
    foreach ($queries as $query) {
        $query = trim($query);
        if (empty($query)) continue;
        
        // Wykonaj zapytanie
        if ($conn->query($query . ';')) {
            $success_count++;
        } else {
            echo "<p>Błąd wykonania zapytania: " . $conn->error . "</p>";
            echo "<pre>" . htmlspecialchars(substr($query, 0, 500)) . (strlen($query) > 500 ? '...' : '') . "</pre>";
        }
    }
    
    echo "<p>Wykonano zapytań: $success_count z " . count(array_filter($queries)) . "</p>";
    
    // Sprawdź ponownie tabele
    $tables_check = $conn->query("SHOW TABLES");
    $new_tables = [];
    
    if ($tables_check->num_rows > 0) {
        while($row = $tables_check->fetch_array()) {
            $new_tables[] = $row[0];
        }
    }
    
    echo "<p>Tabele po inicjalizacji: " . implode(", ", $new_tables) . "</p>";
    
    // Zamknij połączenie
    $conn->close();
    
    echo "<p>Baza danych zainicjalizowana!</p>";
    echo "<p><a href='index.php'>Przejdź do strony głównej</a></p>";
    
} catch (Exception $e) {
    echo "<p>Wystąpił błąd: " . $e->getMessage() . "</p>";
}
?>
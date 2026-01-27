<?php
session_start();

// Pobieramy tryb gry z URL (np. game.php?mode=warsaw)
$mode = $_GET['mode'] ?? 'classic';

// Konfiguracja dla każdego trybu
$config = [
    'classic' => [
        'title' => 'QUIZ TABLICE PL',
        'table' => 'tablice', // nazwa tabeli w bazie
        'js_page' => 'classic'
    ],
    'city' => [
        'title' => 'QUIZ MIASTA',
        'table' => 'city',
        'js_page' => 'city'
    ],
    'warsaw' => [
        'title' => 'QUIZ WARSZAWA',
        'table' => 'wwa',
        'js_page' => 'warsaw'
    ],
    'police' => [
        'title' => 'QUIZ POLICJA',
        'table' => 'police',
        'js_page' => 'police'
    ],
    'nowwa' => [
        'title' => 'QUIZ BEZ WWA',
        'table' => 'nowwa',
        'js_page' => 'nowwa'
    ]
];

// Jeśli ktoś wpisze zły mode, wracamy do classic
if (!array_key_exists($mode, $config)) {
    $mode = 'classic';
}

$currentSettings = $config[$mode];
$table = $currentSettings['table'];

// --- 1. POŁĄCZENIE I LOGIKA PRZED HTML (Dla poprawności danych) ---
require 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Inicjalizacja punktów
if (!isset($_SESSION['points'])) { $_SESSION['points'] = 0; }

// --- NOWE: Czas startu gry ---
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}
$elapsedTime = time() - $_SESSION['start_time'];

// --- NOWE: Obliczamy całkowitą liczbę pytań (dla paska postępu) ---
$sqlCount = "SELECT COUNT(*) as total FROM `$table`";
$resCount = $conn->query($sqlCount);
$rowTotal = $resCount->fetch_assoc();
$maxPoints = $rowTotal['total'];

// Logika losowania ID
if (!isset($_SESSION['recordID'])) {
     $countSql = "SELECT MAX(id) as max_id, MIN(id) as min_id FROM `$table`";
     $countRes = $conn->query($countSql);
     $range = $countRes->fetch_assoc();
     $_SESSION['recordID'] = rand($range['min_id'], $range['max_id']);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $currentSettings['title']; ?></title>
  <link rel="icon" type="image/jpeg" href="images/logo.jpg">
  <link rel="stylesheet" href="style.css"> 
  <script src="js/settings.js"></script>
  <script src="js/info.js"></script>
</head>
<body>

  <div id="loader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div class="spinner"></div> 
  </div>

  <div class="header">
    <div class="logo">
        <a href="index.php"><img src="images/logo.jpg" alt="Logo"></a>
    </div>
    <div class="links">
        <div class="vol-container" id="volContainer">
             <input type="range" id="volSlider" min="0" max="1" step="0.01" value="0.5" class="vol-slider">
             <div class="icon-wrapper">
                <img src="images/vol.png" id="volIcon" class="vol-icon" alt="Vol">
             </div>
        </div>
        <a href="#" id="themeBtn" class="link-icon" title="Zmień motyw">
             <img src="images/moon.png" class="theme-icon" alt="Theme">
        </a>
        <a href="https://github.com/budziun/quiz-tablice-pl" target="_blank" class="link-icon">
            <img src="images/git.png" class="git" alt="github">
        </a>
        <a href="#" id="infoLink" class="link-icon">
            <img src="images/info.png" class="info" alt="info">
        </a>
    </div>
  </div>

  <div class="main">
    
    <div style="width: 100%; max-width: 600px; margin-bottom: 20px;">
        <div id="game-timer">Czas: <?php echo gmdate("i:s", $elapsedTime); ?></div>
        
        <div class="progress-container">
            <div id="myProgressBar" class="progress-bar"></div>
        </div>
        <p id="progress-text">Postęp: 0%</p>
    </div>

    <div class="image-container">
    <?php
        // Pobranie danych o tablicy
        $stmt = $conn->prepare("SELECT * FROM `$table` WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['recordID']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imgName = $row["name"];
            $multiple = $row['multiple'];
            
            $finalImage = $imgName;
            if ($multiple != NULL && rand(1, 2) == 1) {
                $finalImage = $multiple;
            }
            echo "<img src='tabs/$finalImage.png' alt='Tablica' id='imgtablica' onerror=\"this.style.display='none';\">";
        } else {
            echo "<p>Błąd bazy danych. Spróbuj odświeżyć.</p>";
        }

        $stmt->close();
        $conn->close();
    ?>
    </div>

    <div class="form-container">
      
      <script>
          var currentPoints = <?php echo $_SESSION['points']; ?>;
          var maxPoints = <?php echo $maxPoints; ?>;
          var startTimeElapsed = <?php echo $elapsedTime; ?>;
      </script>

      <form id="answerForm" autocomplete="off">
        <div class="game-row">
            <div class="input-group">
                <input type="text" id="text" name="text" 
                       autocomplete="off" 
                       placeholder="Wpisz tablicę..." 
                       oninput="handleInput(this)" required>
                <div id="autocomplete-list"></div>
            </div>
            <button type="submit">Sprawdź</button>
        </div>
      </form>
    </div>
  </div>

  <div id="modal" style="display: none;">
    <div>
      <h1>Koniec gry</h1>
      <p>Nie udało się, spróbuj ponownie!</p>
      <p class="scorelose">Twój wynik: <b><?php echo $_SESSION['points']; ?> pkt</b></p>
      <p class="scorelose">Twój czas: <b><span id="timeDisplayLose">--:--</span></b></p> <p class="scorelose">Poprawna odpowiedź: <b><span id="correctAnswerDisplay"></span></b></p>
      <button onclick="playAgain()" id="btnHome">Zagraj ponownie</button>
    </div>
  </div>

  <div id="winn" style="display: none;">
    <div>
      <h1>Gratulacje!</h1>
      <p>Udało Ci się pokonać ten quiz!</p>
      <p class="scorelose">Wynik końcowy: <b><?php echo $_SESSION['points'] + 1; ?> pkt</b></p>
      <p class="scorelose">Twój czas: <b><span id="timeDisplayWin">--:--</span></b></p> <button onclick="playAgain()" id="btnHome">Zagraj ponownie</button>
    </div>
  </div>

  <div id="infoModal" style="display: none;"></div>

  <div id="modal" style="display: none;">
    <div>
      <h1>Koniec gry</h1>
      <p>Nie udało się, spróbuj ponownie!</p>
      <p class="scorelose">Twój wynik wynosi: <b><?php echo $_SESSION['points']; ?></b></p>
      <p class="scorelose">Poprawna odpowiedź to: <b><span id="correctAnswerDisplay"></span></b></p>
      <button onclick="playAgain()" id="btnHome">Zagraj ponownie</button>
    </div>
  </div>

  <div id="winn" style="display: none;">
    <div>
      <h1>Gratulacje!</h1>
      <p>Udało Ci się pokonać ten quiz!</p>
      <p class="scorelose">Wynik końcowy: <b><?php echo $_SESSION['points'] + 1; ?> punktów</b></p>
      <button onclick="playAgain()" id="btnHome">Zagraj ponownie</button>
    </div>
  </div>

  <div class="footer">
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>

  <script>
    var currentPage = "<?php echo $currentSettings['js_page']; ?>";

    function autocomplete(input) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    var response = JSON.parse(this.responseText);
                    showAutocomplete(input, response);
                } catch(e) {}
            }
        };
        xhr.open("GET", "autocomplete.php?input=" + encodeURIComponent(input.value) + '&page=' + currentPage, true);
        xhr.send();
    }

    function showAutocomplete(input, response) {
        var list = document.getElementById('autocomplete-list');
        list.innerHTML = '';
        response.forEach(function(item) {
            var div = document.createElement('div');
            div.textContent = item.answer;
            div.onclick = function() {
                input.value = item.answer;
                list.style.display = 'none';
            };
            list.appendChild(div);
        });
    }

    function handleInput(input) {
        var list = document.getElementById("autocomplete-list");
        if (input.value.length >= 1) {
            autocomplete(input);
            list.style.display = "block";
        } else {
            list.style.display = "none"; 
            list.innerHTML = '';
        }
    }

    document.getElementById("answerForm").addEventListener("submit", function(event) {
        event.preventDefault();
        var inputText = document.getElementById("text").value;
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    var response = JSON.parse(this.responseText);
                    
                    // Pobieramy aktualny czas z licznika (tekst np. "Czas: 01:23")
                    var finalTimeText = document.getElementById("game-timer").innerText.replace("Czas: ", "");

                    if (response.status === "correct") {
                        playSound('correct'); 
                        setTimeout(function() { window.location.reload(); }, 1400);
                    }
                    else if (response.status === "win") {
                        stopTimer();
                        
                        document.getElementById("timeDisplayWin").innerText = finalTimeText;
                        
                        setTimeout(function() {
                            document.getElementById("winn").style.display = "block";
                            playSound('win'); 
                        }, 500); 
                    }
                    else if (response.status === "incorrect") {
                        stopTimer(); 
                        document.getElementById("timeDisplayLose").innerText = finalTimeText;
                        document.getElementById("correctAnswerDisplay").innerText = response.correct_answer;
                        
                        setTimeout(function() {
                            document.getElementById("modal").style.display = "block";
                            playSound('wrong'); 
                        }, 500);
                    }
                } catch (e) {}
            }
        };
        xhr.open("POST", "process_answer.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("text=" + encodeURIComponent(inputText) + "&page=" + currentPage);
    });

    function playAgain() {
        window.location.href = "index.php";
    }
  </script>
  
  <script src="js/game_extras.js"></script>
</body>
</html>
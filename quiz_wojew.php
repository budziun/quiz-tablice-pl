<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUIZ TABLICE WOJEWÓDZTWO</title>
  <link rel="icon" type="image/jpeg" href="images/logo.jpg">
  <link rel="stylesheet" href="style.css"> 
  <script src="js/info.js"></script>
  <script src="js/settings.js"></script>
</head>
<body>
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
    
    <?php
        if (isset($_GET['wojewodztwo'])) {
            $_SESSION['wojewodztwo'] = $_GET['wojewodztwo'];
        }
        $wojewodztwo = $_SESSION['wojewodztwo'] ?? '';
      
        $wojewodztwa = [
            "kujawsko-pomorskie" => [1, 23],
            "podlaskie" => [24, 39],
            "dolnośląskie" => [40, 68],
            "łódzkie" => [69, 92],
            "lubuskie" => [93, 106],
            "pomorskie" => [107, 126],
            "małopolskie" => [127, 148],
            "lubelskie" => [149, 172],
            "warmińsko-mazurskie" => [173, 193],
            "opolskie" => [194, 205],
            "wielkopolskie" => [206, 240],
            "podkarpackie" => [241, 265],
            "śląskie" => [266, 301],
            "świętokrzyskie" => [302, 315],
            "mazowieckie" => [316, 371],
            "zachodnio-pomorskie" => [372, 392]
        ];

        if (!array_key_exists($wojewodztwo, $wojewodztwa)) {
            die("<p>Błąd: Nie wybrano województwa. Wróć do menu.</p>");
        }

        if (!isset($_SESSION['points'])) {
            $_SESSION['points'] = 0;
        }

        if (!isset($_SESSION['start_time'])) {
            $_SESSION['start_time'] = time();
        }
        $elapsedTime = time() - $_SESSION['start_time'];

        list($startid, $endid) = $wojewodztwa[$wojewodztwo];

        if (!isset($_SESSION['recordID'])) {
            $_SESSION['displayedIDs'] = [];
            do {
                $randomID = rand($startid, $endid);
            } while (in_array($randomID, $_SESSION['displayedIDs']));
            $_SESSION['recordID'] = $randomID;
        }

        require 'config.php';
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

        $stmtCount = $conn->prepare("SELECT COUNT(*) as total FROM `tablice` WHERE wojewodztwo = ?");
        $stmtCount->bind_param("s", $wojewodztwo);
        $stmtCount->execute();
        $resCount = $stmtCount->get_result();
        $rowTotal = $resCount->fetch_assoc();
        $maxPoints = $rowTotal['total'];
        $stmtCount->close();
    ?>

    <div class="game-stats-wrapper">
        <div id="game-timer">Czas: <?php echo gmdate("i:s", $elapsedTime); ?></div>
        
        <div class="progress-container">
            <div id="myProgressBar" class="progress-bar"></div>
        </div>
        <p id="progress-text">Postęp: 0%</p>
    </div>

    <div class="image-container">
    <?php
        $stmt = $conn->prepare("SELECT * FROM `tablice` WHERE `id` = ?");
        $stmt->bind_param("i", $_SESSION['recordID']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $altText = $row["name"];
            $pole_multiple = $row['multiple'];
            
            if($pole_multiple == NULL){
                echo "<img src='tabs/$altText.png' alt='$altText' id='imgtablica' onerror=\"this.style.display='none';\">";
            } else {
                $randomNim = rand(1, 2);
                echo "<img src='tabs/" . ($randomNim == 1 ? $pole_multiple : $altText) . ".png' alt='$altText' id='imgtablica' onerror=\"this.style.display='none';\">";
            }
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

      <form action="#" method="post" id="answerForm">
        <div class="game-row">
            <div class="input-group">
                <input type="text" id="text" name="text" 
                       required oninput="handleInput(this)" 
                       autocomplete="off" 
                       placeholder="Wpisz tablicę..." 
                       data-wojewodztwo="<?php echo $wojewodztwo; ?>">
                <div id="autocomplete-list"></div>
            </div>
            <button type="submit">Wyślij</button>
        </div>
        <div id="alreadyAnswered" style="display: none;">Już próbowałeś odpowiedzieć na to pytanie.</div>
      </form>
    </div>
  </div>

  <div id="modal" style="display: none;">
    <div>
      <h1>Koniec gry</h1>
      <p>Nie udało się, spróbuj ponownie!</p>
      <p class="scorelose">Twój wynik: <b><?php echo $_SESSION['points']; ?> pkt</b></p>
      <p class="scorelose">Twój czas: <b><span id="timeDisplayLose">--:--</span></b></p>
      <p class="scorelose">Poprawna odpowiedź: <b><span id="correctAnswerDisplay"></span></b></p>
      <button onclick="playAgain()" id="btnHome">Zagraj ponownie</button>
    </div>
  </div>

  <div id="winn" style="display: none;">
    <div>
      <h1>Gratulacje!</h1>
      <p>Udało ci się pokonać ten quiz!</p>
      <p class="scorelose">Wynik końcowy: <b><?php echo $_SESSION['points']+1; ?> pkt</b></p>
      <p class="scorelose">Twój czas: <b><span id="timeDisplayWin">--:--</span></b></p>
      <button onclick="playAgain()" id="btnHome">Zagraj ponownie</button>
    </div>
  </div>
  
  <div id="infoModal" style="display: none;"></div>

  <div class="footer">
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>

  <script>
    function autocomplete(input) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    const response = JSON.parse(this.responseText);
                    showAutocomplete(input, response);
                } catch(e) { }
            }
        };
        xhr.open("GET", "auto_wojw.php?input=" + encodeURIComponent(input.value), true);
        xhr.send();
    }

    function showAutocomplete(input, response) {
        const autocompleteList = document.getElementById('autocomplete-list');
        autocompleteList.innerHTML = '';
        response.forEach(function(item) {
            const option = document.createElement('div');
            option.textContent = item.answer;
            option.onclick = function() {
                input.value = item.answer;
                autocompleteList.style.display = 'none';
            };
            autocompleteList.appendChild(option);
        });
    }

    function handleInput(input) {
        const autocompleteList = document.getElementById("autocomplete-list");
        if (input.value.length >= 1) {
            autocomplete(input);
            autocompleteList.style.display = "block";
            input.classList.add("active");
        } else {
            autocompleteList.style.display = "none"; 
            input.classList.remove("active");
            autocompleteList.innerHTML = '';
        }
    }

    function playAgain() {
        window.location.href = "index.php";
    }

    document.getElementById("answerForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        const inputText = document.getElementById("text").value;
        const xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    const response = JSON.parse(this.responseText);

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
        
        xhr.open("POST", "process_wojew.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("text=" + encodeURIComponent(inputText));
    });
  </script>
  
  <script src="js/game_extras.js"></script>
</body>
</html>
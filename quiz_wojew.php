<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUIZ TABLICE WOJEWÓDZTWO</title>
  <link rel="stylesheet" href="style.css"> 
  <script src="js/info.js"></script>
</head>
<body>
  <div class="header">
    <div class="logo">
        <a href="index.php"><img src="images/logo.jpg" alt="Logo"></a>
    </div>
    <div class="links">
    <img src="images/git.png" class="git" alt="github- bdzn">
    <script src="js/git.js"></script>
        <a href="index.php">
            <img src="images/home.png" class="home" alt="home"></a>
        <a href="#" id="infoLink">
            <img src="images/info.png" class="info" alt="info"></a>
    </div>
  </div>
  <div class="main">
    <div class="image-container">
    <?php
        session_start();
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
            die("Błąd: Niepoprawna nazwa województwa.");
        }

        if (!isset($_SESSION['points'])) {
            $_SESSION['points'] = 0;
        }

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
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM `tablice` WHERE `id` = ?");
        $stmt->bind_param("i", $_SESSION['recordID']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $altText = $row["name"];
            $pole_multiple = $row['multiple'];
            $answer = $row["answer"];
            
            if($pole_multiple == NULL){
                echo "<img src='tabs/$altText.png' alt='$altText' id='imgtablica'>";
            } else {
                $randomNim = rand(1, 2);
                echo "<img src='tabs/" . ($randomNim == 1 ? $pole_multiple : $altText) . ".png' alt='$altText' id='imgtablica'>";
            }
        } else {
            echo "Brak danych w bazie.";
        }
        $stmt->close();
        $conn->close();
    ?>
    </div>
    <div class="form-container">
      <form id="answerForm">
        <div>
          <p id="points">Twoja liczba punktów: <?php echo $_SESSION['points']; ?></p>
          <div class="form-container">
          <input type="text" id="text" name="text" required oninput="handleInput(this)" autocomplete="off" data-wojewodztwo="<?php echo htmlspecialchars($wojewodztwo); ?>">
          <button type="submit">Wyślij</button>
          <div id="autocomplete-list"></div>
          </div>
        </div>
      </form>
      
      <div id="modal" style="display: none;">
        <div>
          <h1>Koniec gry</h1>
          <p>Nie udało się, spróbuj ponownie!</p>
          <p class="scorelose">Twój wynik wynosi: <b><?php echo $_SESSION['points']; ?></b></p>
          <p class="scorelose">Poprawna odpowiedź to: <b><?php echo $answer; ?></b></p>
          <button onclick="playAgain()" id="btnHome">Zagraj ponownie</button>
        </div>
      </div>

      <div id="winn" style="display: none;">
        <div>
          <h1>Gratulacje!</h1>
          <p>Udało ci się pokonać ten quiz!</p>
          <p class="scorelose">Twój wynik wynosi: <b><?php echo $_SESSION['points']+1; ?> punktów</b></p>
          <button onclick="playAgain()" id="btnHome">Zagraj ponownie</button>
        </div>
      </div>
      <div id="infoModal" style="display: none;"></div>
    </div>
  </div>

  <div class="footer">
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>

  <script>
    function autocomplete(input) {
        const xhr = new XMLHttpRequest();
        const wojewodztwo = input.getAttribute('data-wojewodztwo') || '';
        
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
                showAutocomplete(input, response);
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
        const badaudio = new Audio('sounds/bad_ans.wav');
        const craudio = new Audio('sounds/correct_ans.wav');
        
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log("Odpowiedź serwera:", this.responseText);
                const response = this.responseText;
                
                if (response === "correct") {
                    craudio.play();
                    setTimeout(function() {
                        window.location.reload();
                    }, 1400);
                } 
                else if (response === "win") {
                    document.getElementById("winn").style.display = "block";
                    craudio.play();
                }
                else if (response === "incorrect") {
                    document.getElementById("modal").style.display = "block";
                    badaudio.play();
                }
            }
        };
        
        xhr.open("POST", "process_wojew.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("text=" + encodeURIComponent(inputText));
    });
  </script>
</body>
</html>
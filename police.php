<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUIZ TABLICE POLICJA</title>
  <link rel="stylesheet" href="style.css"> 
  <script src="js/info.js"></script>
  <script>
  function autocomplete(input) {
    var xhr = new XMLHttpRequest();
    var currentPage = "police";
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        // Wyświetlenie możliwych odpowiedzi
        showAutocomplete(input, response);
      }
    };
    xhr.open("GET", "autocomplete.php?input=" + input.value + '&page=' + currentPage, true);
    xhr.send();
  }

  // Funkcja do wyświetlania możliwych odpowiedzi
  function showAutocomplete(input, response) {
    var autocompleteList = document.getElementById('autocomplete-list');
    autocompleteList.innerHTML = '';
    response.forEach(function(item) {
      var option = document.createElement('div');
      option.textContent = item.answer;
      option.onclick = function() {
        input.value = item.answer;
        autocompleteList.style.display = 'none';
      };
      autocompleteList.appendChild(option);
    });
  }

  // Funkcja do obsługi zdarzenia wprowadzania tekstu
  function handleInput(input) {
    if (input.value.length >= 1) {
      autocomplete(input);
    } else {
      document.getElementById('autocomplete-list').innerHTML = '';
    }
    var autocompleteList = document.getElementById("autocomplete-list");
    if (input.value.length >= 1) {
      autocompleteList.style.display = "block";
      input.classList.add("active");
    } else {
      autocompleteList.style.display = "none"; 
      input.classList.remove("active");
    }
  }

  // Funkcja do zwiększania liczby punktów
  function increasePoints() {
    var xhr = new XMLHttpRequest();
    
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = this.responseText;
        if (response === "success") {
          var pointsElement = document.getElementById("points");
          pointsElement.innerText = "Twoja liczba punktów: " + (++points);

        } else {
          console.log("Wystąpił błąd przy zwiększaniu liczby punktów.");
        }
      }
    };
    xhr.open("GET", "", true);
    xhr.send();
  }
  // Wywołanie funkcji sprawdzającej, czy użytkownik próbował już odpowiedzieć
  checkAnswered();
  
</script>
</head>
</script>
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
        if (!isset($_SESSION['start_time'])) {
          $_SESSION['start_time'] = time();  // Zapisz aktualny czas jako timestamp
          $startTime = $_SESSION['start_time'];  // Czas rozpoczęcia sesji
          $currentTime = time();  // Bieżący czas
          $timeElapsed = $currentTime - $startTime;  // Obliczenie, ile czasu minęło
      }
        // Inicjalizacja zmiennej sesji z liczbą punktów
        if (!isset($_SESSION['points'])) {
            $_SESSION['points'] = 0;
        }
        if (!isset($_SESSION['recordID'])) {
          $_SESSION['displayedIDs'] = [];
          do {
            $randomID = rand(1, 19);
        } while (in_array($randomID, $_SESSION['displayedIDs']));

          $_SESSION['recordID'] = $randomID;
      }
        require 'config.php';
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM `police` WHERE `id` = ".$_SESSION['recordID'];
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $altText = $row["name"];
            $pole_multiple = $row['multiple'];
            $answer = $row["answer"];
            
            if($pole_multiple==NULL){
                echo "<img src='tabs/$altText.png' alt='$altText' id='imgtablica'>";
            }
            if($pole_multiple!=NULL){
                $randomNim = rand(1, 2);
                if($randomNim==1){
                    echo "<img src='tabs/$pole_multiple.png' alt='$altText' id='imgtablica'>";
                }
                else{
                    echo "<img src='tabs/$altText.png' alt='$altText' id='imgtablica'>";
                }
            }
        } else {
            echo "Brak danych w bazie.";
        }

        $conn->close();
      ?>
    </div>
    <div class="form-container">
      <form action="#" method="post">
        <div>
          <p id="points">Twoja liczba punktów: <?php echo $_SESSION['points']; ?></p>
          <div class="form-container">
          <input type="text" id="text" name="text" required oninput="handleInput(this)" autocomplete="off">
          <button type="submit" onclick="increasePoints()">Wyślij</button>
          <div id="autocomplete-list"></div>
          <div id="alreadyAnswered" style="display: none;">Już próbowałeś odpowiedzieć na to pytanie.</div>
          </div>
        </div>
      </form>
      <script>
        document.querySelector("form").addEventListener("submit", function(event) {
          event.preventDefault();
          
          var inputText = document.getElementById("text").value;

          var xhr = new XMLHttpRequest();
          var badaudio = new Audio('sounds/bad_ans.wav');
          var craudio = new Audio('sounds/correct_ans.wav');
          xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var response = this.responseText;
              if (response === "correct") {
                craudio.play();
                increasePoints(); 
                setTimeout(function() {
        window.location.reload();
    }, 1400); 
              } 
              else if(response === "win"){
                setTimeout(function() {
                  document.getElementById("winn").style.display = "block";
                  craudio.play();
    }, 1400);
              }
              else if (response === "incorrect") {
                setTimeout(function() {
                  document.getElementById("modal").style.display = "block";
                  badaudio.play();
    }, 500);
              }
            }
          };
          var currentPage = "police";
          xhr.open("POST", "process_answer.php");
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.send("text=" + inputText + "&page=" + currentPage);
        });

        function playAgain() {
          window.location.href = "index.php";
        }
      </script>
      <div id="modal" style="display: none;">
        <div>
        
          <h1>Koniec gry</h1>
          <p>Nie udało się, spróbuj ponownie!</p>
          <p class="scorelose">Twoj wynik wynosi: <b><?php echo $_SESSION['points']; ?></b></p>
          <p class="scorelose">Poprawna odpowiedz to <b><?php echo $answer; ?></b></p>
          <button onclick="playAgain()" id="btnHome">Zagraj ponownie</button>
        </div>
      </div>
      <div id="winn" style="display: none;">
        <div>
        
          <h1>Gratulacje!</h1>
          <p>Udało ci się pokonać ten quiz!</p>
          <p class="scorelose">Twoj wynik wynosi:<b><?php echo $_SESSION['points']+1; ?> punktów</b></p>
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
</html>
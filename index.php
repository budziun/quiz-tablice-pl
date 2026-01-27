<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUIZ TABLICE PL</title>
  <link rel="stylesheet" href="style.css"> 
  <script src="js/settings.js"></script>
  <link rel="icon" type="image/jpeg" href="images/l1.png">
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
             <img src="images/moon.png" class="theme-icon" alt="Theme" style="width: 26px; height: 26px;">
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
    
    <div class="tiles-wrapper"> 
      
      <div class="tile" onclick="myhref('game.php?mode=classic');">
        <img src="images/poland.png" alt="Tryb 1" class='photokafelki'>
        <h3>Klasyczny</h3>
        <p>Zgaduj spośród wszystkich tablic rejestracyjnych w Polsce</p>
      </div>

      <div class="tile" onclick="myhref('game.php?mode=city');">
        <img src="images/city.png" alt="Tryb 2" class='photokafelki'>
        <h3>Miasta</h3>
        <p>Zgaduj tablice rejestracyjne polskich miast</p>
      </div>

      <div class="tile" onclick="myhref('game.php?mode=warsaw');">
        <img src="images/warsaw.png" alt="Tryb 3" class='photokafelki'>
        <h3>Warszawa</h3>
        <p>Zgaduj tablice rejestracyjne z Warszawy</p>
      </div>

      <div class="tile" onclick="myhref('game.php?mode=police');">
        <img src="images/police.png" alt="Tryb 4" class='photokafelki'>
        <h3>Policja</h3>
        <p>Zgaduj policyjne tablice rejestracyjne</p>
      </div>

      <div class="tile" onclick="myhref('game.php?mode=nowwa');">
        <img src="images/nowwa.png" alt="Tryb 5" class='photokafelki'>
        <h3>NO WWA</h3>
        <p>Zgaduj tablice rejestracyjne polskich miast bez Warszawy</p>
      </div>

      <div class="tile" onclick="myhref('choise.php');">
        <img src="images/pick.png" alt="Tryb 6" class='photokafelki'>
        <h3>Twój<br>Wybór</h3>
        <p>Zgaduj tablice rejestracyjne z wybranego przez ciebie województwa</p>
      </div>

    </div>
  </div>

  <div id="infoModal" style="display: none;"></div>

  <div class="footer">
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>

  <script src="js/info.js"></script>
  <script src="js/git.js"></script>
  <script type="text/javascript">
    function myhref(web){
      window.location.href = web;
    }
  </script>
</body>
</html>
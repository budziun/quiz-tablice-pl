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
  <script scr="js/info.js"></script>
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
        <script src="js/info.js"></script>
        
    </div>
  </div>

  <div class="main">
    <h1>Wybierz Tryb Gry</h1>
    <div class="tiles"> 
    <div class="tile" id="classic" onclick="myhref('classic.php');">
        <img src="images/poland.png" alt="Tryb 1" class='photokafelki'>
        <h3>Klasyczny</h3>
        <p>Zgaduj spośród wszystkich tablic rejestracyjnych w Polsce</p>
      </div>
      <div class="tile" id="city" onclick="myhref('city.php');">
        <img src="images/city.png" alt="Tryb 2" class='photokafelki'>
        <h3>Miasta</h3>
        <p>Zgaduj tablice rejestracyjne polskich miast</p>
      </div>
      <div class="tile" id="warsaw" onclick="myhref('warsaw.php');">
        <img src="images/warsaw.png" alt="Tryb 3" class='photokafelki'>
        <h3>Warszawa</h3>
        <p>Zgaduj tablice rejestracyjne z Warszawy</p>
      </div>
</div>
<div class="tiles1"> 
      <div class="tile" id="police" onclick="myhref('police.php');">
        <img src="images/police.png" alt="Tryb 4" class='photokafelki'>
        <h3>Policja</h3>
        <p>Zgaduj policyjne tablice rejestracyjne</p>
      </div>
      <div class="tiles1"> 
      <div class="tile" id="police" onclick="myhref('nowwa.php');">
        <img src="images/nowwa.png" alt="Tryb 5" class='photokafelki'>
        <h3>NO WWA</h3>
        <p>Zgaduj tablice rejestracyjne polskich miast bez Warszawy</p>
      </div>
      <div class="tiles1"> 
      <div class="tile" id="police" onclick="myhref('choise.php');">
        <img src="images/pick.png" alt="Tryb 6" class='photokafelki'>
        <h3>Twój<br>Wybór</h3>
        <p>Zgaduj tablice rejestracyjne z wybranego przez ciebie województwa</p>
      </div>
      <script type="text/javascript">
    function myhref(web){
      window.location.href = web;}
</script>
  </div>
  <div id="infoModal" style="display: none;"></div>
  <div class="footer">
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>
</body>
</html>
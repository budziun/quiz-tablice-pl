document.addEventListener("DOMContentLoaded", function() {
  var infoLink = document.getElementById("infoLink");
  var infoModal = document.getElementById("infoModal");
  
  // Ustawienie zawartości modala
  infoModal.innerHTML = `
      <div class="modal-content">
          <span class="close">&times;</span>
          <h1>INFO</h1>
          <h2>Made by <a id="gitlink" href="https://github.com/budziun">budziun</a> </h2>
          <h3>Cel gry</h3>
          <p>Celem gry jest zdobycie jak największej ilości punktów poprzez prawidłowe odgadywanie wylosowanych tablic rejestracyjnych zależnie od wybranego trybu gry losowane są różne tablice</p>
          <p>Ta strona pozwala sprawdzić swoją wiedzę na temat tablic rejestracyjnych samochodów w Polsce</p>
          <p>Czy uda ci się odgadnąć wszystkie tablice?</p><br>
          <h3>Wykorzystane ikony</h3><br>
          Icon by <a href='https://iconpacks.net/?utm_source=link-attribution&utm_content=3104'>Iconpacks</a>
          <div>Icons made from <a href="https://www.onlinewebfonts.com/icon">svg icons</a> is licensed by CC BY 4.0</div>
          Inne ikony <a href='https://pl.freepik.com/'>freepik </a><br>
          <h3>Mapa polski svg</h3><br>
          <a href='https://vemaps.com/poland/pl-04'>vemaps.com</a>
      </div>
  `;
  
  var closeBtn = infoModal.getElementsByClassName("close")[0];
  
  // Pokazywanie okienka po kliknięciu na obrazek
  infoLink.onclick = function(event) {
      event.preventDefault();
      event.stopPropagation();
      infoModal.style.display = "block";
  };
  
  // Zamykanie okienka po kliknięciu na przycisk "x"
  closeBtn.onclick = function() {
      infoModal.style.display = "none";
  };
  
  // Zamykanie okienka po kliknięciu poza obszarem okienka
  document.onclick = function(event) {
      if (!infoModal.contains(event.target) && event.target !== infoLink) {
          infoModal.style.display = "none";
      }
  };
});
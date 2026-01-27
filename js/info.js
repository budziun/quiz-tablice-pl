document.addEventListener("DOMContentLoaded", function() {
  var infoLink = document.getElementById("infoLink");
  var infoModal = document.getElementById("infoModal");
  
  // Nowa, ładniejsza struktura HTML modala
  var modalHTML = `
      <div class="modal-card">
          <div class="modal-header">
              <h2>O Projektcie</h2>
              <span class="close">&times;</span>
          </div>
          <div class="modal-body">
              <div class="info-section">
                  <h3>Cel gry</h3>
                  <p>Sprawdź swoją wiedzę o polskich tablicach rejestracyjnych! Zgaduj miasta, służby i województwa. Im szybciej i trafniej odpowiadasz, tym więcej punktów zdobywasz.</p>
              </div>

              <div class="info-row">
                  <div class="info-col">
                      <h3>Autor</h3>
                      <a href="https://github.com/budziun/quiz-tablice-pl" target="_blank" class="credit-link author-link">
                          budziun @ GitHub
                      </a>
                  </div>
                  <div class="info-col">
                      <h3>Mapa</h3>
                      <a href='https://vemaps.com/poland/pl-04' target="_blank" class="credit-link">
                          vemaps.com
                      </a>
                  </div>
              </div>

              <div class="info-section icons-section">
                  <h3>Ikony i Grafika</h3>
                  <div class="credits-list">
                      <span>Icon by <a href='https://iconpacks.net/?utm_source=link-attribution&utm_content=3104'>Iconpacks</a></span>
                      <span>Icons from <a href="https://www.onlinewebfonts.com/icon">svg icons</a> (CC BY 4.0)</span>
                      <span>Other resources by <a href='https://pl.freepik.com/'>Freepik</a></span>
                  </div>
              </div>
          </div>
      </div>
  `;

  // Wstrzyknięcie HTML tylko jeśli modal jest pusty
  if (infoModal.innerHTML.trim() === '') {
      infoModal.innerHTML = modalHTML;
  }
  
  // Ponowne pobranie przycisku zamknięcia, bo został nadpisany przez innerHTML
  var closeBtn = infoModal.querySelector(".close");
  
  // Pokazywanie okienka
  infoLink.onclick = function(event) {
      event.preventDefault();
      event.stopPropagation();
      infoModal.style.display = "flex"; // Zmieniono na flex dla lepszego centrowania
      setTimeout(() => {
          infoModal.classList.add('show'); // Klasa do animacji
      }, 10);
  };
  
  // Funkcja zamykania
  function closeModal() {
      infoModal.classList.remove('show');
      setTimeout(() => {
          infoModal.style.display = "none";
      }, 300); // Czekamy aż animacja zejścia się skończy
  }

  closeBtn.onclick = closeModal;
  
  // Zamykanie po kliknięciu w tło
  window.onclick = function(event) {
      if (event.target == infoModal) {
          closeModal();
      }
  };
});
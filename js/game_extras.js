/* Plik: js/game_extras.js */

// Zmienna globalna dla interwału (żeby móc go zatrzymać)
let timerInterval;

document.addEventListener("DOMContentLoaded", function() {
    initProgressBar();
    initTimer();
});

function initProgressBar() {
    if (typeof currentPoints === 'undefined' || typeof maxPoints === 'undefined') return;

    const progressBar = document.getElementById("myProgressBar");
    const progressText = document.getElementById("progress-text");

    if (progressBar && maxPoints > 0) {
        let percentage = (currentPoints / maxPoints) * 100;
        if (percentage > 100) percentage = 100;

        progressBar.style.width = percentage + "%";
        
        if (progressText) {
            progressText.innerText = "Postęp: " + Math.round(percentage) + "% (" + currentPoints + "/" + maxPoints + ")";
        }
    }
}

function initTimer() {
    if (typeof startTimeElapsed === 'undefined') return;

    let totalSeconds = startTimeElapsed;
    const timerElement = document.getElementById("game-timer");

    function updateClock() {
        totalSeconds++;
        
        let minutes = Math.floor(totalSeconds / 60);
        let seconds = totalSeconds % 60;

        if (seconds < 10) seconds = "0" + seconds;
        if (minutes < 10) minutes = "0" + minutes;

        if (timerElement) {
            timerElement.innerText = "Czas: " + minutes + ":" + seconds;
        }
    }

    // Przypisujemy interwał do zmiennej globalnej
    timerInterval = setInterval(updateClock, 1000);
}

// NOWA FUNKCJA: Zatrzymuje zegar
function stopTimer() {
    if (timerInterval) {
        clearInterval(timerInterval);
    }
}
document.addEventListener("DOMContentLoaded", function() {
    // === 1. OBSŁUGA GŁOŚNOŚCI (SUWAK) ===
    const volSlider = document.getElementById('volSlider');
    const volIcon = document.getElementById('volIcon');
    const volContainer = document.getElementById('volContainer');

    // Pobierz zapisaną głośność lub ustaw 50%
    let savedVol = localStorage.getItem('siteVolume');
    let currentVolume = savedVol !== null ? parseFloat(savedVol) : 0.5;

    // Inicjalizacja suwaka przy starcie
    if(volSlider) {
        volSlider.value = currentVolume;
        updateVolIcon(currentVolume);
    }

    // Funkcja aktualizująca wygląd ikony zależnie od poziomu
    function updateVolIcon(vol) {
        if(!volIcon) return;
        
        // Zmieniamy przezroczystość lub ikonę w zależności od głośności
        if(vol <= 0) {
            volIcon.style.opacity = '0.3'; // Wyciszony
        } else if(vol < 0.5) {
            volIcon.style.opacity = '0.7'; // Cicho
        } else {
            volIcon.style.opacity = '1.0'; // Głośno
        }
    }

    // Obsługa przesuwania suwaka
    if(volSlider) {
        volSlider.addEventListener('input', function(e) {
            currentVolume = parseFloat(e.target.value);
            localStorage.setItem('siteVolume', currentVolume);
            updateVolIcon(currentVolume);
        });
    }

    // Obsługa kliknięcia w ikonę (Mute / Unmute)
    if(volIcon) {
        volIcon.addEventListener('click', function(e) {
            e.stopPropagation(); // Żeby nie kolidowało z innymi eventami
            
            // Obsługa Mobile: Kliknięcie pokazuje suwak (klasa active)
            if (window.innerWidth <= 768) {
                volContainer.classList.toggle('active');
            }

            // Logika Mute (opcjonalna - jeśli chcesz wyciszać klikiem)
            // Jeśli suwak jest widoczny i klikamy ikonę -> wyciszamy
            // Ale na mobile kliknięcie najpierw otwiera suwak.
            /* if (currentVolume > 0) {
                localStorage.setItem('prevVolume', currentVolume); // Zapamiętaj poprzednią
                currentVolume = 0;
            } else {
                currentVolume = parseFloat(localStorage.getItem('prevVolume')) || 0.5;
            }
            volSlider.value = currentVolume;
            updateVolIcon(currentVolume);
            localStorage.setItem('siteVolume', currentVolume);
            */
        });
    }

    // Ukrywanie suwaka na mobile po kliknięciu gdzie indziej
    document.addEventListener('click', function(e) {
        if(volContainer && !volContainer.contains(e.target)) {
            volContainer.classList.remove('active');
        }
    });


    // === GLOBALNA FUNKCJA DŹWIĘKU ===
    window.playSound = function(type) {
        if (currentVolume <= 0.01) return; // Cisza absolutna

        let audioFile = '';
        if (type === 'correct') audioFile = 'sounds/correct_ans.wav';
        else if (type === 'wrong') audioFile = 'sounds/bad_ans.wav';
        else if (type === 'win') audioFile = 'sounds/correct_ans.wav';

        if (audioFile) {
            let audio = new Audio(audioFile);
            audio.volume = currentVolume; // Używamy aktualnej wartości z suwaka
            audio.play().catch(e => console.log("Audio error:", e));
        }
    };


    // === 2. OBSŁUGA DARK MODE ===
    const themeBtn = document.getElementById('themeBtn');
    const body = document.body;

    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
    }

    if(themeBtn) {
        themeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });
    }
});
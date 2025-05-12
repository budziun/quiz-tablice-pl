function autocomplete(input) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        showAutocomplete(input, response);
      }
    };
    xhr.open("GET", "autocomplete.php?input=" + input.value, true);
    xhr.send();
  }
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
  checkAnswered();
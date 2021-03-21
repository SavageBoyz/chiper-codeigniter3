<div class="sidenav">
  <a href="/">На главную</a>
  <a href="#services">О нас</a>
  <button class="dropdown-btn">Шифр двойной перестановки
    <i class="bi bi-chevron-compact-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/chiper/double_switch_e">Зашифровать</a>
    <a href="/chiper/double_switch_d">Дешифровать</a>
  </div>
  <button class="dropdown-btn">Шифр Цезаря с ключевым словом
    <i class="bi bi-chevron-compact-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/chiper/caesar_with_keyword_e">Зашифровать</a>
    <a href="/chiper/caesar_with_keyword_d">Дешифровать</a>
  </div>
</div>

<script>
  //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
  var dropdown = document.getElementsByClassName("dropdown-btn");
  var i;

  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
      } else {
        dropdownContent.style.display = "block";
      }
    });
  }
</script>
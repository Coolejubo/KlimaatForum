document.addEventListener("DOMContentLoaded", function() {
    if (!localStorage.getItem("cookie-consent")) {
      document.getElementById("cookie-consent").style.display = "block";
    }
  });
  
  document.getElementById("cookie-consent-agree").addEventListener("click", function() {
    localStorage.setItem("cookie-consent", "true");
    document.getElementById("cookie-consent").style.display = "none";
  });
  
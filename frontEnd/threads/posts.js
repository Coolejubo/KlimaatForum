document.querySelectorAll(".reply-button").forEach(function(button){
    button.addEventListener("click", function(){
        this.nextElementSibling.style.display = "block";
    });
});
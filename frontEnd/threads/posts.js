let replyButtons = document.querySelectorAll('.reply-button');
let replyForms = document.querySelectorAll('.reply-form');

replyButtons.forEach(function(button, index) {
    button.addEventListener('click', function() {
        replyForms[index].classList.toggle('hide');
    });
});

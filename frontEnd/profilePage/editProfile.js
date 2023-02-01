$(document).ready(function() {
  var editButton = $('.edit-button');
  var isEditing = false;

  $('.edit-button').click(function() {
    $('.edit-form').toggle();
    $('.user-details').toggle();
    isEditing = !isEditing;
    if (isEditing) {
      $(editButton).text("Cancel");
    } else {
      $(editButton).text("Edit");
    }
  });
});

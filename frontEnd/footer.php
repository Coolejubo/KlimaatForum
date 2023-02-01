
<script>

$(function () {
        $('.like-form').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let likeValue = form.find('input[name="likeValue"]').val();
            let postID = form.find('input[name="postID"]').val();
            let likeBtn = form.find('button[name="submit"]');
            let likeCount = form.find('span[name="likeCount"]').val();
            var likeCountElement = document.getElementById("likes-" + postID);
            var currentLikes = parseInt(likeCountElement.innerText.split(" ")[0]);


            $.ajax({
            type: 'post',
            url: 'https://webtech-ki46.webtech-uva.nl/backEnd/includes/like.inc.php',
            data: {
                likeValue: likeValue,
                postID: postID,
                submit: 'submit'
            },
            success: function (response) {
                if (likeValue === "like") {
                    currentLikes++;
                } else if (likeValue === "unlike") {
                    currentLikes--;
                }

                // update the text of the like count element
                likeCountElement.textContent = currentLikes + (currentLikes === 1 ? " Like" : " Likes");

                // Change the like/unlike value and the like button's appearance locally
                if (likeValue === 'like') {
                    form.find('input[name="likeValue"]').val('unlike');
                    likeBtn.removeClass('like-btn');
                    likeBtn.addClass('unlike-btn');
                } else {
                    form.find('input[name="likeValue"]').val('like');
                    likeBtn.removeClass('unlike-btn');
                    likeBtn.addClass('like-btn');
                } 
            }
            });


        });
});
</script>
<?php



?>

    </body>
</html> 

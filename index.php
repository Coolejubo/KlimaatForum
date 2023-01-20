<?php 

    include_once 'frontEnd/header.php'

?>
    
    <!-- <div class="row">
      <div class="column">
        <h2>Column</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
      </div>
      
      <div class="column">
        <h2>Column</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
      </div> -->
      

      <div class="pageBar">
            <a href="#" class="previous round">&#8249;</a>
            <a href="#" class="next round">&#8250;</a>
        </div>

        <?php 

            require_once 'backEnd/includes/showPostsFunctions.php';
            showLatestPosts();

        ?>

<?php 

    include_once 'frontEnd/footer.php'

?>        
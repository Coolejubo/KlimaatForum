<?php
    //Include de header
    include_once 'frontEnd/header.php';
    $pageInfo = '&webPage=index';

?>

<head>
    <!--Include de stylesheets voor homepagina-->
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/homePage/home.css">
    <link rel="stylesheet" href="https://webtech-ki46.webtech-uva.nl/frontEnd/threads/posts.css">
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    if (!localStorage.getItem("cookie-consent")) {
      document.getElementById("cookie-consent").style.display = "block";
    }
  });
  
  document.getElementById("cookie-consent-agree").addEventListener("click", function() {
    localStorage.setItem("cookie-consent", "true");
    document.getElementById("cookie-consent").style.display = "none";
  });
</script>
<?php
$displayLatest = true;
if (isset($_GET['displayLatest'])) {
    $displayLatest = $_GET['displayLatest'] === 'true';
    }
?>

<div class="pageFilters">
    <div class="pageBar">
        <a href="https://webtech-ki46.webtech-uva.nl?
            <?php 
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                if ($page <= 0){
                    echo 'page=0';
                } 
                else {
                echo 'page='.($page - 1);
                }
            } 
            else {
                echo 'page=0';
            }
            echo '&displayLatest=' . ($displayLatest ? 'true' : 'false');
            ?>
        " class="previous round">&#8249;</a>

        <?php
        require_once 'backEnd/includes/showPostsFunctions.php';
        require_once 'backEnd/includes/connection.php';
        $postCount = getPostCount($connection);
        if (!isset($_GET['page']) || $_GET['page'] + 1 < ceil($postCount / 10)) {
        ?>
            <a href="https://webtech-ki46.webtech-uva.nl?
            <?php
                if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        echo 'page='.($page + 1);
                    } 
                else {
                        echo 'page=1';
                    }
                echo "&displayLatest=".($displayLatest ? 'true' : 'false');
            ?>
            " class="next round">&#8250;</a>
        <?php
        }
        ?>

    </div>
    <div class="postTypeDiv">   
        <form action="#">
        <select class="postType" onchange="window.location = 'https://webtech-ki46.webtech-uva.nl?displayLatest=' + (this.value === 'latest') + '&page=' + <?php echo isset($_GET['page']) ? $_GET['page'] : '0'; ?>">
            <option value="best" <?php echo isset($_GET['displayLatest']) && $_GET['displayLatest'] === 'false' ? 'selected' : ''; ?>>Best Posts</option>
            <option value="latest" <?php echo !isset($_GET['displayLatest']) || $_GET['displayLatest'] === 'true' ? 'selected' : ''; ?>>Latest Posts</option>
        </select>
        </form>
    </div>
</div>

<div class="messages">
    <?php 
    require_once 'backEnd/includes/showPostsFunctions.php';
    require_once 'backEnd/includes/connection.php';
    if (isset($_GET['displayLatest'])) {
        $displayLatest = $_GET['displayLatest'] === 'true';
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($displayLatest) {
            $array = tenLatestPosts($connection, $page);
            $pageInfo = $pageInfo.'&page='.$page.'&'.'displayLatest=true';

        } else {
            $array = tenBestPosts($connection, $page);
            $pageInfo = $pageInfo.'&page='.$page.'displayLatest=false';
        }
    }
    else {
        if ($displayLatest) {
            $array = tenLatestPosts($connection, 0);
            $pageInfo = $pageInfo.'&displayLatest=true';
        } else { 
            $array = tenBestPosts($connection, 0);
            $pageInfo = $pageInfo.'&displayLatest=false';
        }
    }
    showPosts($array, $connection, $pageInfo);
    ?>
</div>

<?php 

    include_once 'frontEnd/footer.php'

?>        
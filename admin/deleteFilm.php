<?php
	session_start();
	ob_start();
    require_once('../database/database.php');

    if(isset($_GET["id"])){
        $filmID = $_GET['id'];
    }
    $sql1 = "DELETE FROM film  WHERE film_id = $filmID";
    $sql2 = "DELETE FROM film_actor  WHERE film_id = $filmID";
    $sql3 = "DELETE FROM film_category  WHERE film_id = $filmID";
    $sql4 = "DELETE FROM episodes  WHERE film_id = $filmID";
    $sql5 = "DELETE FROM comment  WHERE film_id = $filmID";

    $conn = new mysqli(HOST, USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
    if (mysqli_query($conn, $sql5) && mysqli_query($conn, $sql4) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql1)) {?>
        <script>
            alert("Xóa phim thành công");
            location.href = "manageFilm.php";
        </script>

    <?php        
    } else {
        echo "Lỗi xóa phim: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    
?>
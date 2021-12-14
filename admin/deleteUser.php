<?php
	session_start();
	ob_start();
    require_once('../database/database.php');

    if(isset($_GET["id"])){
        $userID = $_GET['id'];
    }
    $sql = "DELETE FROM users  WHERE user_id = $userID";
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn,'utf8');
    if (mysqli_query($conn, $sql)) {?>
        <script>
            alert("Xóa User thành công");
            location.href = "manageUser.php";
            // alert("hshshsh");
        </script>

    <?php        
    } else {
        echo "Lỗi xóa user " . mysqli_error($conn);
    }
    mysqli_close($conn);
    
?>
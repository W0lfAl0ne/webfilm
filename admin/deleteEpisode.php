<?php
    require_once('database/database.php');

    if(isset($_GET["id"])){
        $conn = new mysqli(HOST, USERNAME, PASSWORD,DATABASE);
        mysqli_set_charset($conn,'utf8');

        $id = $_GET["id"];
        $sql = "SELECT * 
                FROM episodes
                WHERE episode_id = $id";
        $episode = executeResult($sql)[0];

        $sql = "DELETE 
                FROM episodes
                WHERE episode_id = $id";
        
        
        if (mysqli_query($conn, $sql)) {?>
            <script>
                var id = <?php echo json_encode($episode['film_id'], JSON_HEX_TAG); ?>;
                alert("Xóa tập thành công");
                location.href='manageEpisode.php?id='+id;
            </script>
            <?php
            
           
    
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    
?>
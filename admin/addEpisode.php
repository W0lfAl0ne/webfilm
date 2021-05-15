<?php
    require_once('database/database.php');

    if(isset($_GET["id"])){
        $filmID = $_GET['id'];
    }
    $sql = "SELECT * FROM film WHERE film_id = $filmID";
    $result = executeResult($sql);
    
    if (count($result) == 0) { 
        echo "No required user";
    } else {
        $film = $result[0];

        $sql = "SELECT * FROM episodes WHERE film_id = ".$film['film_id']."";
        $episodes = executeResult($sql);

    }?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Episode</title>

    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/local.css" />

    <script type="text/javascript" src="asset/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>   

    <style>
        div {
            padding-bottom:20px;
        }
        .form-control{
            color: black;
        }
        .notifyerror{
            color: red;
            font-size: 90%;
            font-style: italic;
            font-weight: normal;
            margin-bottom: 0px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <?php
            include("common.php");
        ?>
        <div id="edit-film">
            <div class="row text-center">
                <h2><?php echo $film["film_name"] ?></h2>
            </div>

            <form action="" method="post">
    
                <div>
                    <label for="name_episode" class="col-md-2">
                        Tên tập phim
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name_episode" value="" name="name_episode">
                    </div>
                </div>
                <div>
                    <label for="link" class="col-md-2">
                        Link tập phim
                    </label>
                    <div class="col-md-9">
                            <input type="file" name="video_name" id="video_name" onchange="getlink()"/>
                            <input type="text" class="form-control" id="video_link" name="video" >
                            <p class="help-block">
                                Ví dụ: images/video/cuoc-chien-vo-cuc.jpg
                            </p>
                            <script>
                                function getlink() {
                                    var name =  document.getElementById("video_name").value;
                                    var n = name.lastIndexOf('\\'); 
                                    var result = name.substring(n + 1);
                                    document.getElementById("video_link").value = "images/video/" + result;
                                }
                            </script>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <!-- <input class="btn btn-primary" type="submit" value="Post"> -->
                        <button type="submit" class="btn btn-primary" id="button_post" name="button_post">Thêm tập phim </button>
                    </div>
                </div>
            </form>

            <?php
            if(isset($_POST["button_post"])){
                
                $name_episode = $_POST["name_episode"];
                $content = $_POST["video"];
            
                $sql = "INSERT INTO episodes(film_id,episode_name,url)            
                    VALUES ('$filmID', '$name_episode','$content')";

                $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
                mysqli_set_charset($conn,'utf8');
                $result = mysqli_query($conn,$sql);
                if($result){
                    
                    ?>
                    <script>
                        var id = <?php echo json_encode($filmID, JSON_HEX_TAG); ?>;
                        alert("Thêm tập phim thành công!");
                        location.href='manageEpisode.php?id='+id;
                    </script>

                <?php
                    
                } else { ?>
                    <script>
                        alert("Lỗi thêm tập phim");
                    </script>
                <?php 
                
                    
                }
            }
            ?>
        </div>  
    </div>
</body>
</html>

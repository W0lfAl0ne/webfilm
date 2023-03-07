<?php
session_start();
ob_start();
require_once('../database/database.php');

if (isset($_GET["id"])) {
    $filmID = $_GET['id'];
}
$sql = "SELECT * FROM film WHERE film_id = $filmID";
$result = executeResult($sql);
$film = $result[0];
?>

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
            padding-bottom: 20px;
        }

        .form-control {
            color: black;
        }

        .notifyerror {
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

            <form id="upload-form" action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="episode" class="col-md-2">
                        Tập số
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="episode" value="" name="episode">
                    </div>
                </div>
                <div>
                    <label for="name_episode" class="col-md-2">
                        Tên tập phim
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name_episode" value="" name="name_episode">
                    </div>
                </div>
                <div>
                    <label for="videoFile" class="col-md-2">
                        Chọn video
                    </label>
                    <div class="col-md-9">
                        <input type="file" id="videoFile" name="videoFile"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <!-- <input class="btn btn-primary" type="submit" value="Post"> -->
                        <button type="submit" class="btn btn-primary" id="button_post" name="button_post">Tải lên </button>
                    </div>
                </div>
            </form>
            <div id="progress-bar"></div>

            <script>
                var form = document.getElementById('upload-form');
                var progressBar = document.getElementById('progress-bar');

                form.addEventListener('submit', function(event) {
                    // event.preventDefault();

                    var xhr = new XMLHttpRequest();

                    xhr.upload.addEventListener('progress', function(event) {
                        if (event.lengthComputable) {
                            var percentComplete = event.loaded / event.total * 100;
                            progressBar.style.width = percentComplete + '%';
                            progressBar.innerHTML = percentComplete + '%';
                            // if(percentComplete==100) event.stopPropagation();
                        }
                    });

                    xhr.open('POST', form.action, true);
                    xhr.send(new FormData(form));
                });
            </script>

            <?php

            if (isset($_POST["button_post"])) {
                $target_dir = "../uploads/videos/";
                $file_name = "";
                $addFilm = false;
                if (isset($_FILES["videoFile"])) {
                    $file_name = uniqid() . '-' . basename($_FILES["videoFile"]["name"]);
                    $target_file = $target_dir . $file_name;
                    $uploadOk = 1;
                    $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


                    $check = getimagesize($_FILES["videoFile"]["tmp_name"]);
                    // if ($check == true) {
                    //     echo "Tệp tin là video - " . $check["mime"] . ".";
                    //     $uploadOk = 1;
                    // } else {
                    //     echo "Tệp tin không phải là video.";
                    //     $uploadOk = 0;
                    // }

                    // Kiểm tra kích thước của tệp tin
                    if ($_FILES["videoFile"]["size"] > 500000000) { // Giới hạn tệp tin là 500MB
                        echo "Tệp tin quá lớn.";
                        $uploadOk = 0;
                    }

                    // Cho phép các định dạng video cụ thể
                    if ($videoFileType != "mp4" && $videoFileType != "mov" && $videoFileType != "wmv" && $videoFileType != "avi") {
                        echo "Chỉ chấp nhận các định dạng MP4, MOV, WMV và AVI.";
                        $uploadOk = 0;
                    }

                    // Kiểm tra nếu có lỗi xảy ra
                    if ($uploadOk == 0) {
                        echo "Có lỗi xảy ra khi tải lên tệp tin.";
                        // Nếu không có lỗi, tải lên tệp tin
                    } else {
                        if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $target_file)) {
                            $addFilm = true;
                        } else {
                            $addFilm = false;
                        }
                    }
                }

                if ($addFilm) {
                    $episode = $_POST["episode"];
                    $name_episode = $_POST["name_episode"];
                    $content = $file_name;

                    $sql = "INSERT INTO episodes(film_id,episode,episode_name,url)            
                    VALUES ($filmID,$episode,'$name_episode','$content')";

                    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
                    mysqli_set_charset($conn, 'utf8');
                    $result = mysqli_query($conn, $sql);
                    if ($result) { ?>
                        <script>
                            var id = <?php echo json_encode($filmID, JSON_HEX_TAG); ?>;
                            alert("Thêm tập phim thành công!");
                            location.href = 'manageEpisode.php?id=' + id;
                        </script>
                    <?php

                    } else {
                    ?>
                        <script>
                            alert("Lỗi thêm tập phim");
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("Lỗi tải phim lên");
                    </script>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
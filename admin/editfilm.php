<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Dark Admin</title>

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
        $row = $result[0];
    ?>
        
    <div id="wrapper">
        <?php
            include("common.php");
        ?>
        <div class="container row" id="edit-film">
            <div class="row text-center">
                <h2>Chỉnh sửa film</h2>
            </div>
            <form method="post" id="form-insert-film" name="form-insert-film" class="form-horizontal" action="" role="form" >
                <div>
                    <label for="ID-film" class="col-md-2">
                        ID phim
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="ID-film" value="<?php echo $row["film_id"]; ?>" readonly>
                    </div>
                </div>
                <div>
                    <label for="film-name" class="col-md-2">
                        Tên phim
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="film-name" name="film-name" value="<?php echo $row["film_name"]; ?>">
                    </div>
                </div>
                <div>
                    <label for="film-name2" class="col-md-2">
                        Tên khác
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="film-name2" name="film-name2" value="<?php echo $row["default_name"]; ?>">
                    </div>
                </div>
                <div>
                    <label for="status" class="col-md-2">
                        Trạng thái
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="status" name="status" value="<?php echo $row["status"]; ?>">
                    </div>
                </div>
                <div>
                    <label for="director" class="col-md-2">
                        Đạo diễn
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="director" name="director" value="<?php echo $row["directors"]; ?>">
                    </div>
                </div>
                <div>
                    <?php
                        $sql ="select  actor.name from film_actor inner join actor on film_actor.film_id = ".$filmID." and film_actor.actor_id = actor.actor_id";
                        $result = executeResult($sql);
                        $actors = $result;
                    ?>
                    <label for="actor" class="col-md-2">
                        Diễn viên
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="actor" name="actor" value="<?php 
                            foreach($actors as $actor)
                            if($actor == $actors[0]) echo $actor['name'];
                            else echo', '.$actor['name'];
                        ?>">
                    </div>
                </div>
                <div>
                    <?php
                        $sql = "SELECT * FROM category ";
                        $categorys = executeResult($sql);

                        $sql ="select  category.name from film_category inner join category on film_category.film_id = ".$filmID." and film_category.category_id = category.category_id";
                        $result = executeResult($sql);
                        $categorysFilm = $result;
                    ?>

                    <label for="category" class="col-md-2">
                        Thể loại
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="category" name="category" value="<?php
                            foreach($categorysFilm as $category)
                            if($category == $categorysFilm[0]) echo $category['name'];
                            else echo', '.$category['name'];
                        ?>">
                    </div>

                    <div class="col-md-1">
                        <select id="select_category" style="color: black" name="select_category" onclick="chosseCategory(<?php echo count($categorys); ?>)">
                            <option value="" selected>thể loại</option>
                            <?php 
                                if (count($categorys) > 0) { 
                                    foreach($categorys as $category) { ?>
                                    <option  value="<?php echo $category["category_id"];?>" >
                                        <?php echo $category["name"];?>
                                    </option>
                            <?php 
                                    }
                                }  
                                else {
                                    echo "No category";
                                }
                            ?>
                        </select>
                        <script>
                            function chosseCategory(l) {
                                var categorys = <?php echo json_encode($categorys, JSON_HEX_TAG); ?>;
                                if(document.getElementById("select_category").value ){
                                    for(var i=0 ;i<l;i++) if(categorys[i]['category_id']==document.getElementById("select_category").value) {
                                        if(document.getElementById("category").value) {
                                            var t = document.getElementById("category").value;
                                            document.getElementById("category").value = t+", " + categorys[i]['name'] ;
                                            document.getElementById("select_category").value="";
                                        } else {
                                            document.getElementById("category").value = categorys[i]['name'] ;
                                            document.getElementById("select_category").value="";
                                        }
                                    }
                                }
                            }
                        </script>
                    </div>
                </div>
                <div>
                    <label for="type" class="col-md-2">
                        Type-movie 
                    </label>
                    <div class="col-md-10">
                        <select id="type" style="color: black" name="type_movie" >
                            <option value="1" <?php echo ($row["filmType_id"] == 1) ?  "selected": "" ?>>Phim bộ</option>
                            <option value="2" <?php echo ($row["filmType_id"] == 2) ?  "selected": "" ?>>Phim lẻ</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="nation" class="col-md-2">
                        Quốc gia
                    </label>
                    <div class="col-md-10">
                        <select id="nation" style="color: black" name="nation" >
                            <?php 
                                $sql1 = "SELECT * FROM nation";
                                $result1 = executeResult($sql1);

                                if (count($result1) > 0) { 
                                    foreach($result1 as $row1) { ?>
                                    <option value="<?php echo $row1["nation_id"];?>" <?php echo ($row["nation_id"] == $row1["nation_id"]) ?  "selected": "" ?>>
                                        <?php echo $row1["nation_name"];?>
                                    </option>
                            <?php 
                                    }
                                }  
                                else {
                                    echo "No nation";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="year" class="col-md-2">
                        Năm phát hành
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="year" name="year" value="<?php echo $row["release_year"]; ?>">
                    </div>
                </div>
                <div>
                    <label for="image" class="col-md-2">
                    Link ảnh 
                    </label>
                    <div class="col-md-9">
                        <input type="file" name="image_name" id="image_name" onchange="alertName()"/>
                        <input type="text" class="form-control" id="image_link" name="image" value="<?php echo $row["image"]; ?>">
                        <p class="help-block">
                            Ví dụ: /images/cuoc-chien-vo-cuc.jpg
                        </p>
                        <script>
                            function alertName() {
                                var name =  document.getElementById("image_name").value;
                                var n = name.lastIndexOf('\\'); 
                                var result = name.substring(n + 1);
                                document.getElementById("image_link").value = "image/" + result;
                            }
                        </script>
                    </div>
                </div>

                <div>
                    <label for="trailer" class="col-md-2">
                        Link Trailer
                    </label>
                    <div class="col-md-9">
                        <input type="file" name="trailer_name" id="trailer_name" onchange="alertNameTrailer()"/>
                        <input type="text" class="form-control" id="trailer_link" name="trailer" value="<?php echo $row["trailer"]; ?>">
                        <p class="help-block">
                            Ví dụ: https://www.youtube.com/embed/S12-4mXCNj4
                        </p>
                        <script>
                            function alertNameTrailer() {
                                var name =  document.getElementById("trailer_name").value;
                                var n = name.lastIndexOf('\\'); 
                                var result = name.substring(n + 1);
                                document.getElementById("trailer_link").value = "trailer/" + result;
                            }
                        </script>
                    </div>
                </div>
                <div>
                    <label for="decription" class="col-md-2">
                        Mô tả phim 
                    </label>
                    <div class="col-md-9" style="color: black">
                        <textarea name="decription" id="decription" cols="82" rows="10" ><?php echo $row["description"]; ?></textarea>
                    </div>
                
                </div>
                

                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary" id="button_update" name="button_update">Lưu lại</button>
                    </div>
                </div>
            </form>
            
        </div>  
    </div>
   
   
    <?php
        require_once('database/database.php');
        if(isset($_POST["button_update"])){
            $name = $_POST["film-name"];
            $name2 = $_POST["film-name2"];
            $status = $_POST["status"];
            $director = $_POST["director"];
            $type_movie = $_POST["type_movie"];
            $nation = $_POST["nation"];
            $year = $_POST["year"];
            $link_image = $_POST["image"];
            $link_trailer = $_POST["trailer"];
            $description = $_POST["decription"];

            $actors = $_POST["actor"];
            $categorys = $_POST["category"];

            $actorsfilm = explode(', ', $actors);
            $categorysfilm = explode(', ', $categorys);
            

            //thực hiện việc lưu trữ dữ liệu vào db 
            $sql = "SELECT * FROM film WHERE film_id = '$filmID'";
            $conn = new mysqli(HOST, USERNAME, PASSWORD,DATABASE);
            mysqli_set_charset($conn,'utf8');

            $check = mysqli_query($conn,$sql);
            if(mysqli_num_rows($check) <= 0){ ?>
                <script>
                    alert('Phim với ID <?php echo $filmID;?> không tồn tại');
                </script>";
                <?php
            }
            else{
                $sql = "UPDATE film SET 
                    film_name='$name',
                    default_name='$name2', 
                    status='$status', 
                    directors='$director',
                    filmType_id='$type_movie',
                    nation_id='$nation',
                    image='$link_image',
                    description='$description',
                    trailer='$link_trailer'
                    WHERE film_id = $filmID";
                $result = mysqli_query($conn,$sql);

                $sql = "DELETE FROM film_category  WHERE film_id = $filmID";
                mysqli_query($conn,$sql);
                $sql = "DELETE FROM film_actor  WHERE film_id = $filmID";
                mysqli_query($conn,$sql);


                $sql = "SELECT * FROM category";
                $categorys = executeResult($sql);

                $data = [];

                foreach($categorysfilm as $categoryfilm ) foreach($categorys as $category) if($categoryfilm == $category['name']) $data[] = $category;
                foreach($data as $category){
                    $sql = "INSERT INTO film_category(film_id,category_id)            
                            VALUES (".$filmID.", ".$category['category_id'].")";
                    mysqli_query($conn,$sql);
                }



                $sql = "SELECT * FROM actor";
                $actors = executeResult($sql);

                
                $data1 = [];
                foreach($actorsfilm as $actorfilm ) {
                    $bl = 1;
                    foreach($actors as $actor) if($actorfilm == $actor['name']) $bl = 0;
                
                    if($bl==1) $data1[] = $actorfilm;
                }

                foreach($data1 as $actor){
                    $sql = "INSERT INTO actor(name)            
                            VALUES ('$actor')";
                    mysqli_query($conn,$sql);
                }
            

                $data2 = [];
                $sql = "SELECT * FROM actor";
                $actors = executeResult($sql);
                foreach($actorsfilm as $actorfilm ) foreach($actors as $actor) if($actorfilm == $actor['name']) $data2[] = $actor;
                foreach($data2 as $actor){
                    $sql = "INSERT INTO film_actor(film_id,actor_id)
                            VALUES (".$filmID.", ".$actor['actor_id'].")";
                    mysqli_query($conn,$sql);
                }?>

                <script>
                    var id = <?php echo json_encode($filmID, JSON_HEX_TAG); ?>;
                    alert("Sửa thành công");
                    location.href='editfilm.php?id='+id;
                </script>
                <?php
            }

            mysqli_close($conn);
        }
    }
    ?>
    


</body>
</html>

        
    



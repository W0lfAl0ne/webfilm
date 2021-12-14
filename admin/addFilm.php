<?php
	session_start();
	ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post</title>

	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="asset/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="asset/css/local.css" />

	<script type="text/javascript" src="asset/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>

	<style>
		img {
			filter: gray;
			/* IE6-9 */
			-webkit-filter: grayscale(1);
			/* Google Chrome, Safari 6+ & Opera 15+ */
			-webkit-box-shadow: 0px 2px 6px 2px rgba(0, 0, 0, 0.75);
			-moz-box-shadow: 0px 2px 6px 2px rgba(0, 0, 0, 0.75);
			box-shadow: 0px 2px 6px 2px rgba(0, 0, 0, 0.75);
			margin-bottom: 20px;
		}

		img:hover {
			filter: none;
			/* IE6-9 */
			-webkit-filter: grayscale(0);
			/* Google Chrome, Safari 6+ & Opera 15+ */
		}

		div {
			padding-bottom: 30px;
		}
        .form-control{
            color: black;
        }
        .title{
            
            /* background-color: #2a9fd6; */
            padding: 10px 30px;
            border-radius: 10px;
            width: 500px;
            margin: auto;
        }
        
	</style>
</head>

<body>

	<?php
        require_once('../database/database.php');

        // $sql = "SELECT film_id FROM film ";
        // $result = executeResult($sql);


    ?>
		<div id="wrapper">
            <?php
                include("common.php");
            ?>
            <div class="container" id="post_film" style="padding: 0 15%">
                <div class="row text-center" style="margin: 20px 0px;">
                    <h2 class="title">Thêm Phim</h2>
                </div>
                <form method="post" id="form-insert-film" name="form-insert-film" class="form-horizontal" action="" role="form" >
                    
                    <div>
                        <label for="film-name" class="col-md-2">
                            Tên phim
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="film-name" name="film-name">
                        </div>
                    </div>

                    <div>
                        <label for="film-name2" class="col-md-2">
                            Tên phim 2
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="film-name2" name="film-name2">
                        </div>
                    </div>

                    <div>
                        <label for="director" class="col-md-2">
                            Đạo diễn
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="director" name="director">
                        </div>
                    </div>

                    <div>
                        <label for="year" class="col-md-2">
                            Năm phát hành
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="year" name="year">
                        </div>
                    </div>

                    <div>
                        <label for="nation" class="col-md-2">
                            Quốc gia
                        </label>
                        <div class="col-md-10">
                            <select id="nation" style="color: black" name="nation">
                                <?php 
                                    $sql = "SELECT * FROM nation";
                                    $result = executeResult($sql);

                                    if (count($result) > 0) { 
                                        foreach($result as $row) { ?>
                                        <option value="<?php echo $row["nation_id"];?>">
                                            <?php echo $row["nation_name"];?>
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
                        <label for="episodeNumber" class="col-md-2">
                            số tập
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="episodeNumber" name="episodeNumber">
                        </div>
                    </div>
                    
                    <div>
                        <?php
                        $sql = "SELECT * FROM actor ORDER BY name";
                        $actors = executeResult($sql);
                        ?>
                        <label for="actor" class="col-md-2">
                            Diễn viên
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="actor" name="actor">

                            
                        </div>

                        <div class="col-md-1">
                            <select id="select_actor" style="color: black" name="select_actor" onclick="chosse(<?php echo count($actors); ?>)">
                                <option value="" selected>diễn viên</option>
                                <?php 
                                    if (count($actors) > 0) { 
                                        foreach($actors as $actor) { ?>
                                        <option  value="<?php echo $actor["actor_id"];?>" >
                                            <?php echo $actor["name"];?>
                                        </option>
                                <?php 
                                        }
                                    }  
                                    else {
                                        echo "No actor";
                                    }
                                ?>
                            </select>
                            <script>
                                function chosse(l) {
                                    var actors = <?php echo json_encode($actors, JSON_HEX_TAG); ?>;
                                    if(document.getElementById("select_actor").value ){
                                        for(var i=0 ;i<l;i++) if(actors[i]['actor_id']==document.getElementById("select_actor").value) {
                                            if(document.getElementById("actor").value) {
                                                var t = document.getElementById("actor").value;
                                                document.getElementById("actor").value = t+", " + actors[i]['name'] ;
                                                document.getElementById("select_actor").value="";
                                            } else {
                                                document.getElementById("actor").value = actors[i]['name'] ;
                                                document.getElementById("select_actor").value="";
                                            }
                                        }
                                    }
                                }
                            </script>
                        </div>

                    </div>


                    <div>
                        <?php
                            $sql = "SELECT * FROM category ";
                            $categorys = executeResult($sql);
                        ?>

                        <label for="category" class="col-md-2">
                            Thể loại
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="category" name="category">
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
                            Kiểu phim
                        </label>
                        <div class="col-md-10">
                            <select id="type" style="color: black" name="type_movie">
                                <?php 
                                    $sql = "SELECT * FROM filmtype";
                                    $result = executeResult($sql);
                                    if (count($result) > 0) { 
                                        foreach($result as $row) { ?>
                                        <option value="<?php echo $row["filmType_id"];?>">
                                            <?php echo $row["filmType_name"];?>
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
                        <label for="image" class="col-md-2">
                        Link ảnh 
                        </label>
                        <div class="col-md-9">
                            <!-- <input type="file" name="image_name" id="image_name" onchange="alertName()"/> -->
                            <input type="text" class="form-control" id="image_link" name="image" >
                            <p class="help-block">
                                Ví dụ: https://play.google.com/store/movies/details/Avengers_Endgame?id=9G1LgUoApBU&hl=vi&gl=US
                            </p>
                            <!-- <script>
                                function alertName() {
                                    var name =  document.getElementById("image_name").value;
                                    var n = name.lastIndexOf('\\'); 
                                    var result = name.substring(n + 1);
                                    document.getElementById("image_link").value = "image/" + result;
                                }
                            </script> -->
                        </div>
                    </div>

                    <div>
                        <label for="image" class="col-md-2">
                        Link trailer
                        </label>
                        <div class="col-md-9">
                            <!-- <input type="file" name="trailer_name" id="trailer_name" onchange="alertNametrailer()"/> -->
                            <input type="text" class="form-control" id="trailer_link" name="trailer" >
                            <p class="help-block">
                                Ví dụ: https://www.youtube.com/embed/S12-4mXCNj4
                            </p>
                            <!-- <script>
                                function alertNametrailer() {
                                    var name =  document.getElementById("trailer_name").value;
                                    var n = name.lastIndexOf('\\'); 
                                    var result = name.substring(n + 1);
                                    document.getElementById("trailer_link").value = "trailer/" + result;
                                }
                            </script> -->
                        </div>
                    </div>

                    <div>
                        <label for="poster" class="col-md-2">
                        Link ảnh bìa
                        </label>
                        <div class="col-md-9">
                            <!-- <input type="file" name="poster_name" id="poster_name" onchange="alertName()"/> -->
                            <input type="text" class="form-control" id="poster_link" name="poster" >
                            <p class="help-block">
                                Ví dụ: https://play.google.com/store/movies/details/Avengers_Endgame?id=9G1LgUoApBU&hl=vi&gl=US
                            </p>
                            <!-- <script>
                                function alertName() {
                                    var name =  document.getElementById("poster_name").value;
                                    var n = name.lastIndexOf('\\'); 
                                    var result = name.substring(n + 1);
                                    document.getElementById("poster_link").value = "poster/" + result;
                                }
                            </script> -->
                        </div>
                    </div>

                    <div>
                        <label for="decription" class="col-md-2">
                        Mô tả phim 
                        </label>
                        <div class="col-md-9" style="color: black">
                            <textarea name="decription" id="decription" cols="82" rows="10"></textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <!-- <input class="btn btn-primary" type="submit" value="Post"> -->
                            <button type="submit" class="btn btn-primary" id="button_post" name="button_post">Đăng phim </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    <?php
    if(isset($_POST["button_post"])){
        $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn,'utf8');

        $name = $_POST["film-name"];
        $name2 = $_POST["film-name2"];
        $director = $_POST["director"];
        $year = $_POST["year"];
        $nation = $_POST["nation"];
        $episodeNumber = $_POST["episodeNumber"];
        $type_movie = $_POST["type_movie"];
        $link_image = $_POST["image"];
        $link_poster = $_POST["poster"];
        $link_trailer = $_POST["trailer"];
        $description = $_POST["decription"];

        $actors = $_POST["actor"];
        $categorysfilm = $_POST["category"];

        $actorsfilm = explode(', ', $actors);
        $categorysfilm = explode(', ', $categorysfilm);
        

        $sql = "INSERT INTO film(film_name,default_name,directors,release_year,nation_id,episode_number,status,filmType_id,view,description,trailer,image,poster)            
            VALUES ('$name', '$name2','$director','$year','$nation','$episodeNumber',0,'$type_movie',0,'$description','$link_trailer','$link_image','$link_poster')";
        $result = mysqli_query($conn,$sql);
        if($result){?>
            <script>
                alert("Insert film sucessfully!");
            </script>
        <?php
        } else { ?>
            <script>
                alert("Add film fail!");
            </script>
        <?php }

        

        $sql = "SELECT film_id
        FROM film
        WHERE film_name = '$name' AND
        default_name = '$name2' AND
        directors = '$director' AND
        release_year = '$year' AND
        nation_id = '$nation' AND
        episode_number = '$episodeNumber' AND
        filmType_id = '$type_movie' AND
        description = '$description' AND
        trailer = '$link_trailer' AND
        image = '$link_image'";

        $filmid = executeResult($sql)[0]['film_id'];

        $sql = "SELECT * FROM category";
        $categorys = executeResult($sql);

        $data = [];

        foreach($categorysfilm as $categoryfilm ) foreach($categorys as $category) if($categoryfilm == $category['name']) $data[] = $category;
        foreach($data as $category){
            $sql = "INSERT INTO film_category(film_id,category_id)            
                    VALUES (".$filmid.", ".$category['category_id'].")";
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
                    VALUES (".$filmid.", ".$actor['actor_id'].")";
            mysqli_query($conn,$sql);
        }
        

        mysqli_close($conn);
    }
    ?>

</body>

</html>
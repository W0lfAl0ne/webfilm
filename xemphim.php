<?php
session_start();
require_once('database/database.php');

$id = $_GET['id'];

$sql ="select  * from category";
$result = executeResult($sql);
$listCategorys = $result;

$sql ="select * from nation";
$result = executeResult($sql);
$listNations = $result;

$sql ="select * from filmType";
$result = executeResult($sql);
$listFilmTypes = $result;


$sql ="select * from film where film_id = ".$id."";
$result = executeResult($sql);
$film = $result[0];

$sql ="select * from episodes where film_id = ".$id."";
$result = executeResult($sql);
$film_episode = $result[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="phimCSS.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="main.js"></script>


</head>
<body>

    <!-- HEADER -->
    <nav class="navbar-inverse navbar-fixed-top">
        <div class="container-fluid " >
            <a href="http://localhost/html_css"><b class="logo">FilmsPlus</b></a>
            <ul class="nav navbar-nav uppercase">
                <li class="active"><a href="http://localhost/html_css"> <span class="glyphicon glyphicon-home"></span> Trang Chủ</a></li>
                <li><a href="locphim.php?filmType_id=<?php echo $listFilmTypes[0]["filmType_id"] ?>"><?php echo $listFilmTypes[0]["filmType_name"] ?></a></li>
                <li><a href="locphim.php?filmType_id=<?php echo $listFilmTypes[1]["filmType_id"] ?>"><?php echo $listFilmTypes[1]["filmType_name"] ?></a></li>
        
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Thể Loại <span class="caret"></span></a>
                    <ul class="row dropdown-menu category">
                        <?php
                        foreach($listCategorys as $category) {
                        ?>
                        <li class="col-sm-3">
                            <a class="" href="locphim.php?category_id='<?php echo $category['category_id']?>'"><?php echo $category['name']?></a>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quốc Gia
                <span class="caret"></span></a>
                <ul class="row dropdown-menu">
                    <?php
                    foreach($listNations as $nation) {
                    ?>
                    <li class="col-sm-12">
                        <a href="locphim.php?nation_id='<?php echo $nation['nation_id']?>'"><?php echo $nation['nation_name']?></a>
                    </li>
                    <?php }?>
                </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>

            <form class="navbar-form navbar-right" method="post" action="timphim.php">
                <div class="input-group">
                    <input type="text" class="form-control" size="20" onkeyup="showResult(this.value)" name="search" placeholder="Tìm Films">
                    <div class="input-group-btn">
                        <button class="btn btn-default text-right" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                    <div id="livesearch"></div>
                </div>
            </form>

        </div>
    </nav>
    
    <!-- END HEADER -->

    
    <!-- CONTENT -->
    <div class="container-fluid background">

        <div class=" row content">
            <ul class="breadcrumb">
                <li><a href="http://localhost/html_css"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="locphim.php?filmType_id=<?php echo $film['filmType_id'] ?>"><?php echo $film['filmType_id']==1?$listFilmTypes[0]['filmType_name']:$listFilmTypes[0]['filmType_name'] ?></a></li>
                <li><a href="phim.php?id=<?php echo $film['film_id']?>"><?php echo $film['film_name'] ?></a></li>
                <li class="active"><?php echo $film_episode['episode_name'] ?></li>        
            </ul>
        </div>

        <div class ="row content text-center sidenav" >
            <div class ="video-block">
                <iframe id = "video"  width="1000px" height="600px" src="<?php echo $film_episode['url'] ?>?start=0" frameborder="0" allowfullscreen></iframe>
            </div>
            
            
            <ul class="list-episode nav nav-pills">
                <?php
                    foreach($result as $film_episodeItem) {
                        if($film_episodeItem == $result[0]) {?>
                            <li class="active"><a class="btn-episode" data-toggle="pill" onclick = "document.getElementById('video').src ='<?php echo $film_episodeItem['url'] ?>'"><?php echo $film_episodeItem['episode_name'] ?></a></li>
                            <?php } else {?>
                                <li><a class="btn-episode" data-toggle="pill" onclick = "document.getElementById('video').src ='<?php echo $film_episodeItem['url'] ?>'"><?php echo $film_episodeItem['episode_name'] ?></a></li>
                                <?php
                            }
                    }?>
            </ul>
        </div>



        
        
    </div>


    <!-- END CONTENT -->

  <footer class="container-fluid text-center">
    <body>
        <div class="footer-icon">
          <a href="#"><b class="ti-facebook"></b></a>
          <a href="#"><b class="ti-instagram"></b></a>
          <a href="#"><b class="ti-twitter-alt"></b></a>
          <a href="#"><b class="ti-youtube"></b></a>
          <a href="#"><b class="ti-linkedin"></b></a>
          <a href="#"><b class="ti-pinterest"></b></a>
        </div>
        
        <div class="support">
          <h4>Liên Hệ Hỗ Trợ</h4>
          <b><h5>Phone: 0374819189</h5></b>
          <b><h5>Email: zzixx27xy93sq@gmail.com</h5></b>
          <b><h5>Địa Chỉ: 144 xuân thủy, Cầu Giấy</h5></b>
        </div>
      

    </body>
  </footer>

</body>
</html>




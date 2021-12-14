<?php
session_start();
ob_start ();
require_once('database/database.php');


$sql = 'select * from film';
$result = executeResult($sql);
$films = $result;

$sql ="select  * from category";
$result = executeResult($sql);
$listCategorys = $result;

$sql ="select * from nation";
$result = executeResult($sql);
$listNations = $result;

$sql ="select * from filmtype";
$result = executeResult($sql);
$listFilmTypes = $result;


$sql = "select * from film ";
if(isset($_GET['category_id']) && $_GET['category_id'] != null) $sql .= "INNER JOIN film_category ON film.film_id = film_category.film_id and film_category.category_id = ".$_GET['category_id']." ";
if(isset($_GET['filmType_id']) && $_GET['filmType_id'] != null) {
    $sql .= "WHERE film.filmType_id = ".$_GET['filmType_id']." ";
    if(isset($_GET['nation_id']) && $_GET['nation_id'] != null) $sql .= "and film.nation_id = ".$_GET['nation_id']." ";
} elseif(isset($_GET['nation_id']) && $_GET['nation_id'] != null) $sql .= "WHERE film.nation_id = ".$_GET['nation_id']." ";

$result = executeResult($sql);
$films_search = $result;

?>
<!DOCTYPE html>
  <html lang="en">
  <head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/fonts/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="mainCSS.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="main.js"></script>

</head>
<body>

  <!-- HEADER -->
 
    <nav class="navbar-inverse navbar-fixed-top">
        <div class="container-fluid " >
            <a href="https://webfilmplus.000webhostapp.com"><b class="logo">FilmsPlus</b></a>
            <ul class="nav navbar-nav uppercase">
                <li class="active"><a href="https://webfilmplus.000webhostapp.com"> <span class="glyphicon glyphicon-home"></span> Trang Chủ</a></li>
                <li><a href="locphim.php?filmType_id=<?php echo $listFilmTypes[0]["filmType_id"] ?>"><?php echo $listFilmTypes[0]["filmType_name"] ?></a></li>
                <li><a href="locphim.php?filmType_id=<?php echo $listFilmTypes[1]["filmType_id"] ?>"><?php echo $listFilmTypes[1]["filmType_name"] ?></a></li>
        
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Thể Loại <span class="caret"></span></a>
                    <ul class="row dropdown-menu category">
                        <?php
                        foreach($listCategorys as $category) {
                        ?>
                        <li class="col-sm-3">
                            <a class="" href="locphim.php?category_id=<?php echo $category['category_id']?>"><?php echo $category['name']?></a>
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
                    <a href="locphim.php?nation_id=<?php echo $nation['nation_id']?>"><?php echo $nation['nation_name']?></a>
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
    <div class="container-fluid text-center background">
    
        <div class="row content">
            <ul class="col-sm-9 filter-bar text-center">
                <form action="">
                    <select name="category_id" id="category_id">
                        <option value="">Thể Loại</option>
                            <?php
                            foreach($listCategorys as $category) {?>
                                <option value="<?php echo $category['category_id']?>" <?php if(isset($_GET['category_id']) && $_GET['category_id'] != null) if($category['category_id'] == $_GET['category_id']) echo 'selected' ?>><?php echo $category['name']?></option>
                            <?php }?>
                    </select>

                    <select name="nation_id" id="nation_id">
                        <option value="">Quốc Gia</option>
                            <?php
                            foreach($listNations as $nation) {?>
                                <option value="<?php echo $nation['nation_id']?>" <?php if(isset($_GET['nation_id']) && $_GET['nation_id'] != null) if($nation['nation_id'] == $_GET['nation_id']) echo 'selected' ?>><?php echo $nation['nation_name']?></option>
                            <?php }?>
                    </select>

                    <select name="filmType_id" id="filmType_id">
                        <option value="">Kiểu Phim</option>
                            <?php
                            foreach($listFilmTypes as $filmType) {?>
                                <option value="<?php echo $filmType['filmType_id']?>" <?php if(isset($_GET['filmType_id']) && $_GET['filmType_id'] != null) if($filmType['filmType_id'] == $_GET['filmType_id']) echo 'selected' ?>><?php echo $filmType['filmType_name']?></option>
                            <?php }?>
                    </select>

                    <input type="submit" value="Lọc">
                </form>
            </ul>


            <div class="row col-sm-9 sidenav background">
                <div class="row">
                    <div class = "contentLeft" >
                        <?php
                        if(count($films_search)>0){
                            foreach($films_search as $film_search) {?>
                                <div class="col-sm-3">
                                    <div class="thumbnail">
                                        <a href="phim.php?id='<?php echo $film_search['film_id']?>'">
                                            <img src="<?php echo $film_search['image'] ?>" alt="<?php echo $film_search['film_name']?>" style="width:100%">
                                            <div class="film_status"><?php 
                                                if($film_search['status']==$film_search['episode_number']) echo 'Hoàn Tất';
                                                else echo 'Tập ' . $film_search['status'] . '/' . $film_search['episode_number'];
                                                ?>
                                            </div>
                                            <div class="caption">
                                                <p><?php echo $film_search['film_name']?></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                    
                            <?php }
                        } else { ?>
                            <b style="color:#fff">KHÔNG TÌM THẤY KẾT QUẢ PHÙ HỢP</b>
                        <?php } ?>
                        
                    </div>
                </div>
                
            </div>

            <!-- contentRight -->
            <div class="col-sm-3 navbar-right sidenav">
                <h4 class="uppercase">PHIM HOT</h4>
                <div class = "contentRight">
                
                    <hr>
                    <ul class="nav nav-tabs">
                        <li class="active col-sm-4"><a data-toggle="tab" href="#menu1">Ngày</a></li>
                        <li class="col-sm-4"><a data-toggle="tab" href="#menu2">Tuần</a></li>
                        <li class="col-sm-4"><a data-toggle="tab" href="#menu3">Tháng</a></li>
                    </ul>
                    
                <div class="tab-content">
                    <div id="menu1" class="tab-pane fade in active">

                        <ul class="list-group nav">
                            <?php
                            foreach($films as $film) if( $film['filmType_id']==1){
                            ?>
                            <li>
                                <a class="list-item" href="phim.php?id='<?php echo $film['film_id']?>'">
                                    <img class="image" src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name']?>">
                                    <div class="list-item-title">
                                        <b><?php echo $film['film_name']?></b>
                                        <i><?php echo $film['default_name']?></i>
                                        <i><?php echo $film['release_year']?></i>
                                        <i>Lượt Xem: <span><?php echo $film['view'] ?></span ></i>
                                    </div>
                                </a>
                            </li>

                            <?php }?>
                        </ul>
                    </div>
                    
                    <div id="menu2" class="tab-pane fade">
                        <ul class="list-group nav">
                            <?php
                            foreach($films as $film) if( $film['filmType_id']==1){
                            ?>
                            <li>
                                <a class="list-item" href="phim.php?id='<?php echo $film['film_id']?>'">
                                    <img class="image" src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name']?>">
                                    <div class="list-item-title">
                                        <b><?php echo $film['film_name']?></b>
                                        <i><?php echo $film['default_name']?></i>
                                        <i><?php echo $film['release_year']?></i>
                                        <i>Lượt Xem: <span><?php echo $film['view'] ?></span ></i>
                                    </div>
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <ul class="list-group nav">
                            <?php
                            foreach($films as $film) if( $film['filmType_id']==1){
                            ?>
                            <li>
                                <a class="list-item" href="phim.php?id='<?php echo $film['film_id']?>'">
                                    <img class="image" src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name']?>">
                                    <div class="list-item-title">
                                        <b><?php echo $film['film_name']?></b>
                                        <i><?php echo $film['default_name']?></i>
                                        <i><?php echo $film['release_year']?></i>
                                        <i>Lượt Xem: <span><?php echo $film['view'] ?></span ></i>
                                    </div>
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div> 
            </div>
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


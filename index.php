<?php
session_start();
require_once('database/database.php');

if(isset($_POST["log_out"])){
  unset($_SESSION['username']);
  session_unset();
  session_destroy();
  header('Location:index.php');
}

$sql ="select * from category";
$result = executeResult($sql);
$listCategorys = $result;

$sql ="select * from nation";
$result = executeResult($sql);
$listNations = $result;

$sql ="select * from filmType";
$result = executeResult($sql);
$listFilmTypes = $result;



?>
<!DOCTYPE html>
  <html lang="en">
  <head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="mainCSS.css">
  <link rel="stylesheet" href="assets/fonts/themify-icons/themify-icons.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="main.js"></script>
  

</head>
<body>

  <!-- HEADER -->
 
  <nav class="navbar-inverse navbar-fixed-top">
    <div class="navbar-content container-fluid" >
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
      
      <?php if(empty($_SESSION["username"])) {?>
        <ul class="nav navbar-nav navbar-right">
          <li>
          <a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
          </li>
          
          <li>
            <a onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><span class="glyphicon glyphicon-log-in"></span> Login</a>

            <div id="id01" class="modal">
  
              <form class="modal-content animate" action="login.php" method="post">
                <div class="imgcontainer">
                  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                  <img src="assets/img/images.png" alt="Avatar" class="avatar">
                </div>
              
                <div class="container">
                  <label for="username"><b>Username</b></label>
                  <input type="text" placeholder="Enter Username" name="username" required>

                  <label for="password"><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="password" required>
                    
                  <button type="submit" name="btn_login">Login</button>
                  <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                  </label>
                </div>

                <div class="container" style="width: 100%; background-color:#f1f1f1">
                  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                  <span class="password">Forgot <a href="#">password?</a></span>
                </div>
              </form>
            </div>

            <script>
            // Get the modal
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            </script>
          </li>
        </ul>
          <?php } else {?>
            
        <form class="navbar-right content-logout" method="post" action="">
          <button id="logout" name="log_out"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</button>
          <a rel="nofollow" href="info_account.php"><span class="glyphicon glyphicon-user"> <?php echo $_SESSION["username"]?></span></a>
        </form>
             
        <?php } ?>
        
      

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

    <!-- SlideShow -->
    <div class="row text-center slider">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
      
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="assets/slides/WallpaperDog-10782934.jpg" alt="Doctor Strange">
            <div class="carousel-caption">
              <h3>Doctor Strange</h3>
              <p>Doctor Strange là một phim của điện ảnh Hoa Kỳ dựa trên nhân vật cùng tên của hãng Marvel Comics, sản xuất bởi Marvel Studios và phân phối bởi Walt Disney Studios Motion Pictures.</p>
            </div>
          </div>
      
          <div class="item">
            <img src="assets/slides/3679240_captain-america-civil-war-poster-fea-1200x737.jpg" alt="Captain America">
            <div class="carousel-caption">
              <h3>Captain America</h3>
              <p>Captain America: Nội chiến siêu anh hùng là phim điện ảnh siêu anh hùng của Mỹ năm 2016 dựa trên nhân vật truyện tranh Captain America của Marvel Comics, do Marvel Studios sản xuất và Walt Disney Studios Motion Pictures chịu trách nhiệm phân phối</p>
            </div>
          </div>
      
          <div class="item">
            <img src="assets/slides/3515432-endgamedek.jpg" alt="Avengers: End Game">
            <div class="carousel-caption">
              <h3>Avengers: End Game</h3>
              <p>Avengers: Hồi kết là phim điện ảnh siêu anh hùng Mỹ ra mắt năm 2019, do Marvel Studios sản xuất và Walt Disney Studios Motion Pictures phân phối</p>
            </div>
          </div>
        </div>
      
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div class="clear"></div>
    </div>
    <!--End SlideShow -->




    <!-- PHIM Bộ -->
    <div class="row content">
      <div class="col-sm-9 sidenav">
        <div class = "contentLeft" >
          <h3>Phim Bộ Mới Cập Nhập <a class="icon-right" href="locphim.php?filmType_id=<?php echo $listFilmTypes[0]["filmType_id"] ?>">Xem Thêm<span class="glyphicon glyphicon-chevron-right"></span></a></h3>
          
         

          <?php
          $sql = 'SELECT * FROM film WHERE filmType_id = 1 LIMIT 12';
          $result = executeResult($sql);
          $filmbo = $result;

          foreach($filmbo as $film){
          ?>
            <div class="col-sm-3">
              <div class="thumbnail">
                <a href="phim.php?id=<?php echo $film['film_id']?>">
                  <img src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name']?>" style="width:100%">
                  <div class="film_status"><?php 
                    if($film['status']>=$film['episode_number']) echo 'Hoàn Tất';
                    else echo 'Tập ' . $film['status'] . '/' . $film['episode_number'];
                    ?>
                  </div>
                  <div class="caption">
                    <p><?php echo $film['film_name']?></p>
                  </div>
                </a>
              </div>
            </div>
            
          <?php }?>
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
                 $sql = 'SELECT * FROM film WHERE filmType_id = 1 LIMIT 5';
                 $result = executeResult($sql);
                 $filmbo = $result;
                foreach($filmbo as $film){
                ?>
                  <li>
                    <a class="list-item" href="phim.php?id='<?php echo $film['film_id']?>'">
                      <img class="image" src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name']?>">
                      <div class="list-item-title">
                        <b><?php echo $film['film_name']?></b>
                        <i><?php echo $film['default_name']?></i>
                        <i><?php echo $film['release_year']?></i>
                      </div>
                    </a>
                  </li>

                <?php }?>
              </ul>
            </div>
            
            <div id="menu2" class="tab-pane fade">
              <ul class="list-group nav">
                <?php
                foreach($filmbo as $film) {
                ?>
                  <li>
                    <a class="list-item" href="phim.php?id='<?php echo $film['film_id']?>'">
                      <img class="image" src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name']?>">
                      <div class="list-item-title">
                        <b><?php echo $film['film_name']?></b>
                        <i><?php echo $film['default_name']?></i>
                        <i><?php echo $film['release_year']?></i>
                      </div>
                    </a>
                  </li>

                <?php }?>
              </ul>
            </div>
            <div id="menu3" class="tab-pane fade">
            <ul class="list-group nav">
              <?php
                foreach($filmbo as $film) {
                ?>
                  <li>
                    <a class="list-item" href="phim.php?id='<?php echo $film['film_id']?>'">
                      <img class="image" src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name']?>">
                      <div class="list-item-title">
                        <b><?php echo $film['film_name']?></b>
                        <i><?php echo $film['default_name']?></i>
                        <i><?php echo $film['release_year']?></i>
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


    <!-- PHIM LẺ -->
    <div class="row content">
      <div class="col-sm-9 contentLeft sidenav">
        <h3>Phim Lẻ Mới Cập Nhập <a class="icon-right" href="locphim.php?filmType_id=<?php echo $listFilmTypes[1]["filmType_id"] ?>">Xem Thêm<span class="glyphicon glyphicon-chevron-right"></span></a></h3>

        <?php
        $sql = 'SELECT * FROM film WHERE filmType_id = 2 LIMIT 12';
        $result = executeResult($sql);
        $filmle = $result;

        foreach($filmle as $film){
        ?>
          <div class="col-sm-3">
            <div class="thumbnail">
              <a href="phim.php?id='<?php echo $film['film_id']?>'">
                <img src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name']?>" style="width:100%">
                <div class="caption">
                  <p><?php echo $film['film_name']?></p>
                </div>
              </a>
            </div>
          </div>
        <?php }?>
      </div>
    </div>
        
  

    <!-- PHIM HOẠT HÌNH -->
    <div class="row content">
      <div class="col-sm-9 contentLeft sidenav">
        <h3>Phim Hoạt Hình Mới Cập Nhập <a class="icon-right" href="#">Xem Thêm<span class="glyphicon glyphicon-chevron-right"></span></a></h3>
        
        <?php
        $sql = "SELECT * FROM film INNER JOIN film_category ON film.film_id = film_category.film_id and film_category.category_id = 1 LIMIT 12";
        $result = executeResult($sql);
        $filmhoathinh = $result;

        foreach($filmhoathinh as $film){
        ?>
          <div class="col-sm-3">
            <div class="thumbnail">
              <a href="phim.php?id='<?php echo $film['film_id']?>'">
                <img src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name']?>" style="width:100%">
                <div class="caption">
                  <p><?php echo $film['film_name']?></p>
                </div>
              </a>
            </div>
          </div>
          
        <?php }?>
        
        

        
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




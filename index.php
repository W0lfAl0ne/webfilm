<?php
session_start();
ob_start();

require_once('database/database.php');

if (isset($_POST["log_out"])) {
  unset($_SESSION['username']);
  session_unset();
  session_destroy();
  header('localhost/t');
}

$sql = "select * from category";
$result = executeResult($sql);
$listCategorys = $result;

$sql = "select * from nation";
$result = executeResult($sql);
$listNations = $result;

$sql = "select * from filmtype";
$result = executeResult($sql);
$listFilmTypes = $result;

$sql = 'SELECT * FROM film ORDER BY view DESC LIMIT 5';
$result = executeResult($sql);
$filmhot = $result;

if (isset($_POST["btn_login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $username = strip_tags($username);
  $username = addslashes($username);
  $password = strip_tags($password);
  $password = addslashes($password);
  if ($username == "" || $password == "") { ?><script>
      alert("username và password bạn không được để trống!")
    </script>
    <?php
  } else {
    $sql = "SELECT * FROM users WHERE user_name = '$username'";
    $result = executeResult($sql);
    if (count($result) < 1) { ?>
      <script>
        alert("Username không đúng");
        header('Location:index.php');
      </script>
      <?php
    } else {
      if ($password == $result[0]["password"]) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        // phân quyền
        if ($result[0]['usertype'] == 1 || $result[0]['usertype'] == 2) {
          header('Location:admin/index.php');
        } else {
          //member
          header('Location:index.php');
        }
      } else { ?>
        <script>
          alert('Password failure');
          header('Location:index.php');
        </script>
<?php
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Film Plus</title>
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
    <div class="navbar-content container-fluid">
      <a href="<?php echo $url ?>"><b class="logo">FilmsPlus</b></a>

      <ul class="nav navbar-nav uppercase">
        <li class="active"><a href="<?php echo $url ?>"> <span class="glyphicon glyphicon-home"></span> Trang Chủ</a></li>
        <li><a href="locphim.php?filmType_id=<?php echo $listFilmTypes[0]["filmType_id"] ?>"><?php echo $listFilmTypes[0]["filmType_name"] ?></a></li>
        <li><a href="locphim.php?filmType_id=<?php echo $listFilmTypes[1]["filmType_id"] ?>"><?php echo $listFilmTypes[1]["filmType_name"] ?></a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Thể Loại <span class="caret"></span></a>
          <ul class="row dropdown-menu category">
            <?php
            foreach ($listCategorys as $category) {
            ?>
              <li class="col-sm-3">
                <a class="" href="locphim.php?category_id=<?php echo $category['category_id'] ?>"><?php echo $category['name'] ?></a>
              </li>
            <?php } ?>
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quốc Gia
            <span class="caret"></span></a>
          <ul class="row dropdown-menu">
            <?php
            foreach ($listNations as $nation) {
            ?>
              <li class="col-sm-12">
                <a href="locphim.php?nation_id=<?php echo $nation['nation_id'] ?>"><?php echo $nation['nation_name'] ?></a>
              </li>
            <?php } ?>
          </ul>
        </li>
      </ul>

      <?php if (empty($_SESSION["username"])) { ?>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
          </li>

          <li>
            <a onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><span class="glyphicon glyphicon-log-in"></span> Login</a>

            <div id="id01" class="modal">

              <form class="modal-content animate" action="index.php" method="post">
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
      <?php } else { ?>

        <form class="navbar-right content-logout" method="post" action="">
          <button id="logout" name="log_out"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</button>
          <a rel="nofollow" href="info_account.php"><span class="glyphicon glyphicon-user"> <?php echo $_SESSION["username"] ?></span></a>
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

        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
          <li data-target="#myCarousel" data-slide-to="4"></li>
        </ol>


        <div class="carousel-inner" role="listbox">
          <?php for ($i = 0; $i < 5; $i++) { ?>
            <a class="item <?php $tmp = $i == 0 ? 'active' : '';
                            echo $tmp ?>" href="phim.php?id=<?php echo $filmhot[$i]['film_id'] ?>">
              <img src="./uploads/images/<?php echo $filmhot[$i]['poster'] ?>" alt="<?php echo $filmhot[$i]['film_name'] ?>">
              <div class="carousel-caption">
                <h3><?php echo $filmhot[$i]['film_name'] ?></h3>
                <p><?php echo $filmhot[$i]['description'] ?></p>
              </div>
            </a>
          <?php } ?>

        </div>


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
        <div class="contentLeft">
          <h3>Phim Bộ Mới Cập Nhập <a class="icon-right" href="locphim.php?filmType_id=<?php echo $listFilmTypes[0]["filmType_id"] ?>">Xem Thêm<span class="glyphicon glyphicon-chevron-right"></span></a></h3>



          <?php
          $sql = 'SELECT * FROM film WHERE filmType_id = 1 LIMIT 12';
          $result = executeResult($sql);
          $filmbo = $result;

          foreach ($filmbo as $film) {
          ?>
            <div class="col-sm-3">
              <div class="thumbnail">
                <a href="phim.php?id=<?php echo $film['film_id'] ?>">
                  <img src="./uploads/images/<?php echo $film['image'] ?>" alt="<?php echo $film['film_name'] ?>" style="width:100%">
                  <div class="film_status"><?php
                                            if ($film['status'] >= $film['episode_number']) echo 'Hoàn Tất';
                                            else echo 'Tập ' . $film['status'] . '/' . $film['episode_number'];
                                            ?>
                  </div>
                  <div class="caption">
                    <p><?php echo $film['film_name'] ?></p>
                  </div>
                </a>
              </div>
            </div>

          <?php } ?>
        </div>
      </div>


      <!-- contentRight -->
      <div class="col-sm-3 navbar-right sidenav">
        <h4 class="uppercase">PHIM HOT</h4>
        <div class="contentRight">

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
                foreach ($filmhot as $film) {
                ?>
                  <li>
                    <a class="list-item" href="phim.php?id='<?php echo $film['film_id'] ?>'">
                      <img class="image" src="./uploads/images/<?php echo $film['image'] ?>" alt="<?php echo $film['film_name'] ?>">
                      <div class="list-item-title">
                        <b><?php echo $film['film_name'] ?></b>
                        <i><?php echo $film['default_name'] ?></i>
                        <i><?php echo $film['release_year'] ?></i>
                        <i>Lượt Xem: <span><?php echo $film['view'] ?></span></i>
                      </div>
                    </a>
                  </li>

                <?php } ?>
              </ul>
            </div>

            <div id="menu2" class="tab-pane fade">
              <ul class="list-group nav">
                <?php
                foreach ($filmhot as $film) {
                ?>
                  <li>
                    <a class="list-item" href="phim.php?id='<?php echo $film['film_id'] ?>'">
                      <img class="image" src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name'] ?>">
                      <div class="list-item-title">
                        <b><?php echo $film['film_name'] ?></b>
                        <i><?php echo $film['default_name'] ?></i>
                        <i><?php echo $film['release_year'] ?></i>
                        <i>Lượt Xem: <span><?php echo $film['view'] ?></span></i>
                      </div>
                    </a>
                  </li>

                <?php } ?>
              </ul>
            </div>
            <div id="menu3" class="tab-pane fade">
              <ul class="list-group nav">
                <?php
                foreach ($filmhot as $film) {
                ?>
                  <li>
                    <a class="list-item" href="phim.php?id='<?php echo $film['film_id'] ?>'">
                      <img class="image" src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name'] ?>">
                      <div class="list-item-title">
                        <b><?php echo $film['film_name'] ?></b>
                        <i><?php echo $film['default_name'] ?></i>
                        <i><?php echo $film['release_year'] ?></i>
                        <i>Lượt Xem: <span><?php echo $film['view'] ?></span></i>
                      </div>
                    </a>
                  </li>

                <?php } ?>
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

        foreach ($filmle as $film) {
        ?>
          <div class="col-sm-3">
            <div class="thumbnail">
              <a href="phim.php?id='<?php echo $film['film_id'] ?>'">
                <img src="./uploads/images/<?php echo $film['image'] ?>" alt="<?php echo $film['film_name'] ?>" style="width:100%">
                <div class="caption">
                  <p><?php echo $film['film_name'] ?></p>
                </div>
              </a>
            </div>
          </div>
        <?php } ?>
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

        foreach ($filmhoathinh as $film) {
        ?>
          <div class="col-sm-3">
            <div class="thumbnail">
              <a href="phim.php?id='<?php echo $film['film_id'] ?>'">
                <img src="./uploads/images/<?php echo $film['image'] ?>" alt="<?php echo $film['film_name'] ?>" style="width:100%">
                <div class="caption">
                  <p><?php echo $film['film_name'] ?></p>
                </div>
              </a>
            </div>
          </div>

        <?php } ?>




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
        <b>
          <h5>Phone: 0374819189</h5>
        </b>
        <b>
          <h5>Email: zzixx27xy93sq@gmail.com</h5>
        </b>
        <b>
          <h5>Địa Chỉ: 144 xuân thủy, Cầu Giấy</h5>
        </b>
      </div>

    </body>
  </footer>

</body>

</html>
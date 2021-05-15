<?php
session_start();
require_once('database/database.php');


$id = $_GET['id'];

$sql ="select * from category";
$result = executeResult($sql);
$listCategorys = $result;

$sql ="select * from nation";
$result = executeResult($sql);
$listNations = $result;

$sql ="select * from filmType";
$result = executeResult($sql);
$listFilmTypes = $result;


$sql ="select * from film where film_id = $id";
$result = executeResult($sql);
$film = $result[0];

$sql ="select  actor.name from film_actor inner join actor on film_actor.film_id = ".$id." and film_actor.actor_id = actor.actor_id";
$result = executeResult($sql);
$actors = $result;

$sql ="select  category.name from film_category inner join category on film_category.film_id = ".$id." and film_category.category_id = category.category_id";
$result = executeResult($sql);
$categorys = $result;
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
    <div class="container-fluid background">

        <div class=" row content">
            <ul class="breadcrumb">
                <li><a href="http://localhost/html_css"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="locphim.php?filmType_id=<?php echo $film['filmType_id'] ?>"><?php echo $film['filmType_id']==1?$listFilmTypes[0]['filmType_name']:$listFilmTypes[0]['filmType_name'] ?></a></li>
                <li class="active"><?php echo $film['film_name'] ?></li>        
            </ul>
        </div>

        <div class ="row content film-information sidenav" >

            <div class="col-sm-3 text-center">
                <div class="image">
                    <img src="<?php echo $film['image'] ?>" alt="<?php echo $film['film_name'] ?>">
                    <a href="xemphim.php?id=<?php echo $id?>" target="_top">
                        <button>Xem Phim</button>
                    </a>
                </div>
                <div class="clear"></div>
            </div>

            <div class="col-sm-8 text-left">
                <div class="title">
                    <b class="text-uppercase"><?php echo $film['film_name'] ?></b>
                    <i><?php echo $film['default_name']  ?></i>
                   
                </div>
                
                <hr>
                <div class="information">
                    <p id="status">Trạng thái: <i><?php 
                        if($film['status']>=$film['episode_number']) echo 'Hoàn Tất';
                        else echo 'Tập ' . $film['status'] . '/' . $film['episode_number'];
                        ?></i></p>
                    <p>Đạo diễn: <?php echo $film['directors'] ?></p>
                    <p>Diễn viên: 
                    <?php 
                        foreach($actors as $actor)
                        if($actor == $actors[0]) echo '<a href="">'.$actor['name'].'</a>';
                        else echo', <a href="">'.$actor['name'].'</a>';
                    ?></p>
                    
                    <p>Thể loại: 
                    <?php
                        foreach($categorys as $category)
                        if($category == $categorys[0]) echo '<a href="">'.$category['name'].'</a>';
                        else echo', <a href="">'.$category['name'].'</a>';
                    ?></p>
                    <p>Số tập: <?php echo $film['episode_number']  ?></p>
                    <p>Năm sản xuất: <?php echo $film['release_year']  ?></p>
                    <p>Quốc gia: <?php
                        foreach($listNations as $nation)
                            if($nation['nation_id'] == $film['nation_id']) {
                                echo $nation['nation_name'];
                                break;
                                }
                    ?></p>
                    
                </div>
                
            </div>
        </div>
        <hr>

        
        <div class ="row content film-content sidenav text-center">
            <h2>NỘI DUNG</h2>
            <p  class ="text-left"><?php echo $film['description']  ?></p>
            <iframe width="560px" height="315px" src="<?php echo $film['trailer'] ?>?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

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




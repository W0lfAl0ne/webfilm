<?php
session_start();
ob_start ();
require_once('database/database.php');

$sql ="select  * from category";
$result = executeResult($sql);
$listCategorys = $result;

$sql ="select * from nation";
$result = executeResult($sql);
$listNations = $result;

$sql ="select * from filmtype";
$result = executeResult($sql);
$listFilmTypes = $result;

$conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
mysqli_set_charset($conn,'utf8');

if(isset($_POST["button_update"])){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $fullName = $_POST["fullname"];
  $birthday = $_POST["birthday"];
  $gender = $_POST["gender"];
  $usertype = $_POST["usertype"];

  //thực hiện việc lưu trữ dữ liệu vào db
  $sql = "SELECT* FROM users WHERE user_name = '$username'";
  $check = mysqli_query($conn,$sql);
  if(mysqli_num_rows($check) > 0){ ?>
      
      <script>
          alert('Tài khoản $username đã tồn tại');
      </script>";
      
      <?php
  }
  else{
    $sql = "INSERT INTO users(user_name,full_name,password,email,birthday,gender,usertype)
            VALUES ('$username', '$fullName','$password','$email','$birthday','$gender',3)";

      if(mysqli_query($conn,$sql)){
        echo "
        <script>
          alert('Add user successfully!');
        </script>
        ";
      $_SESSION["username"] = $username;
      $_SESSION["password"] = $password;
        header('Location:Index.php');
      }
          

  }
}
mysqli_close($conn);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Index</title>
  <link href="css/owl.carousel.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="mainCSS.css">

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
  
  <div class="container-fluid text-center background">
    <div class="row content" style="color:#fff">
      <h3 style="font-size:30px;text-align:center;margin-bottom:0px;margin-top:0px;">Đăng kí thành viên</h3>
      <div class="form-update">
        <form method="post" id="form-update" name="form-update" class="form-horizontal" action="" role="form" style="padding: 20px;">
          <div class="form-group">
            <label class="col-lg-3 control-label" >Tài khoản</label>
            <div class="col-lg-7">
              <input type="text" class="form-control" name="username" id="username" value="">
              <label class="notifyerror" style="visibility: hidden; height: 0px" id="usernameerror">Tên tài khoản chỉ bao gồm ký tự a-z, A-Z và số</label>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label" >Mật khẩu</label>
            <div class="col-lg-7">
              <input type="password" class="form-control" name="password" id="password1" value="">
              <label class="notifyerror" style="visibility: hidden; height: 0px" id="password1error">Mật khẩu phải bao gồm chữ thường, chữ hoa và số, độ dài tối thiểu 8 ký tự</label>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label" >Xác nhận mật khẩu</label>
            <div class="col-lg-7">
              <input type="password" class="form-control" name="password2" id="password2" value="">
              <label class="notifyerror" style="visibility: hidden; height: 0px" id="password2error1">Mật khẩu phải bao gồm chữ thường, chữ hoa và số, độ dài tối thiểu 8 ký tự</label>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label" >Họ tên</label>
            <div class="col-lg-7">
              <input type="text" class="form-control" name="fullname" id="fullname" value="">
              <label class="notifyerror" style="visibility: hidden; height: 0px" id="fullnameerror">Tên chỉ bao gồm các chữ cái</label>  
            </div>
          </div>
          
          <div class="form-group">
              <label class="col-lg-3 control-label" >Email</label>
              <div class="col-lg-7"><input type="email" class="form-control" name="email" id="email">
              <label class="notifyerror" style="visibility: hidden; height: 0px" id="emailerror">Email không đúng định dạng name@domain</label>  
              </div>
          </div>
                      
          <div class="form-group">
              <label for="birthday" class="col-lg-3 control-label" >Ngày sinh</label>
              <div class="col-lg-7">
                  <input class="form-control" type="date" value="" id="birthday" name="birthday">
              </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label" >Giới tính</label>
            <div class="col-lg-7">
              <label class="checkbox-inline">
                <input type="radio" name="gender" id="update-gender-male" value="male" checked=""> Nam</label>
                <label class="checkbox-inline">
                  <input type="radio" name="gender" id="update-gender-female" value="female"> Nữ
                </label>
            </div>
          </div>

          <div class="col-offset-3 col-lg-10">
            <button type="submit" class="btn btn-primary" id="button_update" name="button_update">Đăng ký </button>
          </div>
          <div class="clear"></div>
        </form>
      </div>
    </div>
    
  </div>
    
    
  <script language="javascript">
    var username = document.getElementById("username");
    var password1 = document.getElementById("password1");
    var password2 = document.getElementById("password2");
    var fullname = document.getElementById("fullname");
    var email = document.getElementById("email");
    var phone = document.getElementById("phone");
    var button_update = document.getElementById("button_update");

    var usernameerror = document.getElementById("usernameerror");
    //var passworderror = document.getElementById("passworderror");
    var password1error =  document.getElementById("password1error");
    var password2error1 =  document.getElementById("password2error1");
    var fullnameerror = document.getElementById("fullnameerror");
    var emailerror =  document.getElementById("emailerror");
    //var phoneerror =  document.getElementById("phoneerror");

    var regUsername = /^[A-Za-z0-9]+$/;
    var regFullname = /^[A-Za-z ]+$/;
    var regEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    // var regPhone =  /^\d{10}$/;
    var regPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/

    //var errorPasswordDefault = (passworderror.innerText || passworderror.textContent);

    username.onchange = function(){
      checkname();
    }

    password1.onchange = function(){
      checkNewpassword();
    }

    password2.onchange = function(){
      checkNewpassword2();
    }

    fullname.onchange = function(){
      checkfullname();
    }

    email.onchange = function(){
      checkemail();
    }

    button_update.onclick = function(){
      if(username.value.toString().length <= 0){
        alert("Bạn chưa nhập tên tài khoản");
        checkname();
        return false;
      }

      if(fullname.value.toString().length <= 0){
        alert("Bạn chưa nhập tên");
        checkname();
        return false;
      }

      if(email.value.toString().length <= 0){
        alert("Bạn chưa nhập email");
        checkemail();
        return false;
      }

      var validName = checkname();

      var validNewPass1 = true;
      var validNewPass2 = true;

      if(password1.value.toString().length > 0 || password2.value.toString().length > 0){
        validNewPass1 = checkNewpassword();
        validNewPass2 = checkNewpassword2();
      }
      var validFullname = checkfullname();
      var validEmail = checkemail();

      if(validName && validNewPass1 && validNewPass2 && validFullname && validEmail){
        return true;
      }
      return false;
    }
    function checkNewpassword(){
      if(!regPassword.test(password1.value)){
        password1error.style.visibility = 'visible';
        password1error.style.height = 'auto';
        return false;
      }
      else{
        password1error.style.visibility = 'hidden';
        password1error.style.height = '0px';
        
        if(password2.value.toString().length > 0){
          if(password2.value.localeCompare(password1.value) == 0){
            password2error1.style.visibility = 'hidden';
            password2error1.style.height = '0px';
            return true;
          }
          else{
            password2error1.innerHTML = "Mật khẩu không khớp";
            password2error1.style.visibility = 'visible';
            password2error1.style.height = 'auto';
            return false;
          }
        }   
        return true;
      }
    }

    function checkname(){
      if(!regUsername.test(username.value)){
        usernameerror.style.visibility = 'visible';
        usernameerror.style.height = 'auto';
        return false;
      }
      else{
        usernameerror.style.visibility = 'hidden';
        usernameerror.style.height = '0px';
        return true;
      }
    }

    function checkpass(){
      if(!regPassword.test(password.value)){
        passworderror.style.visibility = 'visible';
        passworderror.style.height = 'auto';
        return false;
      }
      else{
        passworderror.style.visibility = 'hidden';
        passworderror.style.height = '0px';
        return true;
      }
    }

    function checkemail(){
      if(!regEmail.test(email.value)){
        emailerror.style.visibility = 'visible';
        emailerror.style.height = 'auto';
        return false;
      }
      else{
        emailerror.style.visibility = 'hidden';
        emailerror.style.height = '0px';
        return true;
      }
    }

    function checkfullname(){
      if(!regFullname.test(fullname.value)){
        fullnameerror.style.visibility = 'visible';
        fullnameerror.style.height = 'auto';
        return false;
      }
      else{
        fullnameerror.style.visibility = 'hidden';
        fullnameerror.style.height = '0px';
        return true;
      }
    }

    function checkNewpassword2(){
      if(!regPassword.test(password2.value)){
        //password2error1.innerHTML = errorPasswordDefault;
        password2error1.style.visibility = 'visible';
        password2error1.style.height = 'auto';
        return false;
      }
      else{
        if(password1.value.toString().length > 0){
          if(password2.value.localeCompare(password1.value) == 0){
            password2error1.style.visibility = 'hidden';
            password2error1.style.height = '0px';
            return true;
          }
          else{
            password2error1.innerHTML = "Mật khẩu không khớp";
            password2error1.style.visibility = 'visible';
            password2error1.style.height = 'auto';
            return false;
          }
        }
        else{
          password2error1.style.visibility = 'hidden';
          password2error1.style.height = '0px';
          return true;
        }
      }
    }

  </script>
</body>
</html>
<?php 
  session_start();
  ob_start ();
  require_once('database/database.php');

  $sql ="select * from category";
  $result = executeResult($sql);
  $listCategorys = $result;

  $sql ="select * from nation";
  $result = executeResult($sql);
  $listNations = $result;

  $sql ="select * from filmType";
  $result = executeResult($sql);
  $listFilmTypes = $result;
  
  $username = $_SESSION['username'];
  $sql="SELECT * FROM users WHERE user_name= '$username'";

  $result = executeResult($sql);
  

  if(count($result) < 1){
    echo "Username không tồn tại";
  }
  
  $info =$result[0];

  $received_name  = $info['user_name'];
  $received_birthday=$info['birthday'];
  $received_gender = $info['gender'];
  $received_fullname = $info['full_name'];
  $received_email = $info['email'];
  $id=$info['user_id'];


  if(isset($_POST["button_update"])){
    $username = $_POST["username"];
    $password = $_POST["password1"];
    $email = $_POST["email"];
    $fullName = $_POST["fullname"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];

 
    $sql = "UPDATE users SET 
              user_name = $username,
              password = $password,
              full_name = $fullName,
              email = $email,
              birthday = $birthday,
              gender = $gender
            WHERE user_id = $id";  
    $conn = new mysqli(HOST, USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
    if(mysqli_query($conn,$sql)){
      echo '
        <script>
          alert("cập nhật thành công")
        </script>
      ';
    }
    mysqli_close($conn);                                        
  }
?>
 
<!DOCTYPE html>
<!-- saved from url=(0018)javascript:void(); -->
<html lang="vi">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Index</title>
  <link href="css/owl.carousel.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="mainCSS.css"> 
  <script src="js/jquery.min.js" type="text/javascript"></script>
  <script src="js/owl.carousel.js" type="text/javascript"></script>
  <script src="js/jwplayer.js"></script>


  <link href="css/style-info_account.css" type="text/css" rel="stylesheet"> 
  <link href="css/style.min.css" type="text/css" rel="stylesheet"> 

  <style type="text/css">
    #wrapper {
      color: #fff;
      background-color: #000;
    }
    .checkbox-inline{
      padding: 7px 0px 0px !important;
    }

    .form-register{
      padding: 10px;
      margin-bottom: 50px;
    }
    .form-control {
      background-color: #333 !important;
      border: 1px solid #111 !important;
      color: #b8b8b8 !important;
    }

    
    .col-lg-3,
    .col-lg-7,
    .col-lg-10 {
      position: relative;
      min-height: 1px;
      padding-left: 10px;
      padding-right: 10px;
    }

    .form-control {
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
    }

    @media (min-width: 992px) {
    
      .col-lg-3,
     
      .col-lg-7,
     
      .col-lg-10 {
        float: left;
      }
   
      .col-lg-3 {
        width: 25%;
      }
   
      .col-lg-7 {
        width: 58.333333333333336%;
      }
    
      .col-lg-10 {
        width: 30%;
      }
      .col-offset-3 {
        margin-left: 25%;
      }
    }

    .form-control:-moz-placeholder {
      color: #999999;
    }

    .form-control::-moz-placeholder {
      color: #999999;
    }

    .form-control:-ms-input-placeholder {
      color: #999999;
    }

    .form-control::-webkit-input-placeholder {
      color: #999999;
    }

    .form-control {
      display: block;
      width: 100%;
      height: 38px;
      padding: 8px 12px;
      font-size: 14px;
      line-height: 1.428571429;
      color: #555555;
      /* vertical-align: middle; */
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border-radius: 4px;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
              box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
              transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    }

    .form-control:focus {
      border-color: rgba(82, 168, 236, 0.8);
      outline: none;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
              box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
    }

    .form-group {
      margin-bottom: 15px;
    }

    .radio,
    .checkbox {
      display: block;
      min-height: 20px;
      padding-left: 20px;
      margin-top: 10px;
      margin-bottom: 10px;
      /* vertical-align: middle; */
    }

    .radio label,
    .checkbox label {
      display: inline;
      margin-bottom: 0;
      font-weight: normal;
      cursor: pointer;
    }

    .radio input[type="radio"],
    .radio-inline input[type="radio"],
    .checkbox input[type="checkbox"],
    .checkbox-inline input[type="checkbox"] {
      float: left;
      margin-left: -20px;
    }

    .radio + .radio,
    .checkbox + .checkbox {
      margin-top: -5px;
    }

    .radio-inline,
    .checkbox-inline {
      display: inline-block;
      padding-left: 20px;
      margin-bottom: 0;
      font-weight: normal;
      vertical-align: middle;
      cursor: pointer;
    }

    .radio-inline + .radio-inline,
    .checkbox-inline + .checkbox-inline {
      margin-top: 0;
      margin-left: 10px;
    }  


    .btn {
      display: inline-block;
      padding: 8px 12px;
      margin-bottom: 0;
      font-size: 14px;
      font-weight: 500;
      line-height: 1.428571429;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      cursor: pointer;
      border: 1px solid transparent;
      border-radius: 4px;
      margin-left: 10px;
    }



    .btn-primary {
      color: #ffffff;
      background-color: #428bca;
      border-color: #428bca;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary.active {
      background-color: #357ebd;
      border-color: #3071a9;
    }

    .btn-primary.disabled,
    .btn-primary[disabled],
    fieldset[disabled] .btn-primary,
    .btn-primary.disabled:hover,
    .btn-primary[disabled]:hover,
    fieldset[disabled] .btn-primary:hover,
    .btn-primary.disabled:focus,
    .btn-primary[disabled]:focus,
    fieldset[disabled] .btn-primary:focus,
    .btn-primary.disabled:active,
    .btn-primary[disabled]:active,
    fieldset[disabled] .btn-primary:active,
    .btn-primary.disabled.active,
    .btn-primary[disabled].active,
    fieldset[disabled] .btn-primary.active {
      background-color: #428bca;
      border-color: #428bca;
    }


    .form-inline .form-control,
    .form-inline .radio,
    .form-inline .checkbox {
      display: inline-block;
    }

    .form-inline .radio,
    .form-inline .checkbox {
      margin-top: 0;
      margin-bottom: 0;
    }

    .form-horizontal .control-label {
      padding-top: 9px;
    }

    .form-horizontal .form-group:before,
    .form-horizontal .form-group:after {
      display: table;
      content: " ";
    }


    .form-horizontal .form-group:after {
      clear: both;
    }

    .form-horizontal .form-group:before,
    .form-horizontal .form-group:after {
      display: table;
      content: " ";
    }

    .form-horizontal .form-group:after {
      clear: both;
    }

    @media (min-width: 768px) {
      .form-horizontal .form-group {
     
        margin-left: -15px;
      }
    }

    .form-horizontal .form-group .row {
  
      margin-left: -10px;
    }

    @media (min-width: 768px) {
      .form-horizontal .control-label {
        text-align: right;
      }
    }

    .notifyerror{
      color:red;
      font-size: 90%;
      font-style: italic;
      font-weight: normal;
      margin-bottom: 0px;
    }

  </style>
</head>
  <body style="position: relative;">

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

    <div id="wrapper">
      
      <div id="body-wrap" class="container">
      </div>    

      <h3 style="margin-bottom: 20px; font-size:30px;text-align:center; ">Thông tin khách hàng</h3>

      <div class="form-update">
        <form method="post" id="form-update" name="form-update" class="form-horizontal" action="" role="form">

          <div class="form-group">
            <label class="col-lg-3 control-label">Tài khoản</label>
            <div class="col-lg-7">
              <input type="text" class="form-control" name="username" id="update-username" value="<?php echo htmlentities($received_name); ?>">
              <label class="notifyerror" style="visibility: hidden; height: 0px" id="usernameerror">Tên tài khoản chỉ bao gồm ký tự a-z, A-Z và số</label>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Mật khẩu cũ</label>
            <div class="col-lg-7">
              <input type="password" class="form-control" name="password" id="password" value="">
              <label class="notifyerror" style="visibility: hidden; height: 0px" id="passworderror">Mật khẩu phải bao gồm chữ thường, chữ hoa và số, độ dài tối thiểu 8 ký tự</label>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Mật khẩu mới</label>
            <div class="col-lg-7">
              <input type="password" class="form-control" name="password1" id="password1" value="">
              <label class="notifyerror" style="visibility: hidden; height: 0px" id="password1error">Mật khẩu phải bao gồm chữ thường, chữ hoa và số, độ dài tối thiểu 8 ký tự</label>
            </div>
          </div>


          <div class="form-group">
            <label class="col-lg-3 control-label">Xác nhận mật khẩu</label>
            <div class="col-lg-7">
              <input type="password" class="form-control" name="password2" id="password2" value="">
              <label class="notifyerror" style="visibility: hidden; height: 0px" id="password2error1">Mật khẩu phải bao gồm chữ thường, chữ hoa và số, độ dài tối thiểu 8 ký tự</label>
            </div>
          </div>
            
            <div class="form-group">
              <label class="col-lg-3 control-label">Họ tên</label>
              <div class="col-lg-7">
                <input type="text" class="form-control" name="fullname" id="update-fullname" value="<?php echo htmlentities($received_fullname); ?>">
                <label class="notifyerror" style="visibility: hidden; height: 0px" id="fullnameerror">Tên chỉ bao gồm các chữ cái</label>  
              </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Email</label>
                <div class="col-lg-7"><input type="email" class="form-control" name="email" id="update-email" value="<?php echo htmlentities($received_email); ?>">
                <label class="notifyerror" style="visibility: hidden; height: 0px" id="emailerror">Email không đúng định dạng name@domain</label>  
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Ngày sinh</label>
                <div class="col-lg-7">
                  <input type="date" class="form-control" name="birthday" id="birthday" value="<?php echo htmlentities($received_birthday); ?>">
                </div>
            </div>

    
            <div class="form-group">
              <label class="col-lg-3 control-label">Giới tính</label>
              <div class="col-lg-7">
                <label class="checkbox-inline">
                  <input type="radio" name="gender" id="update-gender-male" value="male" 
                  <?php echo ($received_gender=='male')?'checked':'' ?>> Nam</label>
                  <label class="checkbox-inline">
                  <input type="radio" name="gender" id="update-gender-female" value="female"
                  <?php echo ($received_gender=='female')?'checked':'' ?>> Nữ
                  </label>
              </div>
            </div>

          

            <div class="col-offset-3 col-lg-10">
              <button type="submit" class="btn btn-primary" id="button_update" name="button_update">Cập nhật</button>
            </div>

            <div class="clear"></div>
          </form>
      </div>
    
    
    <script language="javascript">
      var username = document.getElementById("update-username");
      var password = document.getElementById("password");
      var password1 = document.getElementById("password1");
      var password2 = document.getElementById("password2");
      var fullname = document.getElementById("update-fullname");
      var email = document.getElementById("update-email");
      var button_update = document.getElementById("button_update");
      var update_birthday = document.getElementById("birthday");
  

      var usernameerror = document.getElementById("usernameerror");
      var passworderror = document.getElementById("passworderror");
      var password1error =  document.getElementById("password1error");
      var password2error1 =  document.getElementById("password2error1");
      var fullnameerror = document.getElementById("fullnameerror");
      var emailerror =  document.getElementById("emailerror");
      var phoneerror =  document.getElementById("phoneerror");

      var regUsername = /^[A-Za-z0-9]+$/;
      var regFullname = /^[A-Za-z ]+$/;
      var regEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var regPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/

      var errorPasswordDefault = (passworderror.innerText || passworderror.textContent);

      username.onchange = function(){
        checkname();
      }

      password.onchange = function(){
        checkpass();
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

        if(password.value.toString().length <= 0){
          alert("Bạn chưa nhập mật khẩu");
          checkpass();
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
        var validPass = checkpass();

        var validNewPass1 = true;
        var validNewPass2 = true;

        if(password1.value.toString().length > 0 || password2.value.toString().length > 0){
          validNewPass1 = checkNewpassword();
          validNewPass2 = checkNewpassword2();
        }
        var validFullname = checkfullname();
        var validEmail = checkemail();
        // var validBirthday = checkbirthday(update_birthday_day.value,update_birthday_month.value,update_birthday_year.value);

        if(validName && validPass && validNewPass1 && validNewPass2 && validFullname && validEmail && validBirthday){
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
          password2error1.innerHTML = errorPasswordDefault;
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
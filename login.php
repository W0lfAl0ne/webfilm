<?php
    session_start();
    ob_start ();
    require_once('database/database.php');

    if(isset($_POST["btn_login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
            
        $username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {?><script>
			alert("username và password bạn không được để trống!")
            </script>
            <?php
        }
        else{
			$sql = "SELECT * FROM users WHERE user_name = '$username'";
            $result = executeResult($sql);
            if(count($result)<1){?>
                <script>
                    alert("Username không đúng");
                    header('Location:index.php');
                </script> 
            <?php
            } else{
                if($password==$result[0]["password"]){
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    // phân quyền
                    if($result[0]['usertype'] == 1 || $result[0]['usertype'] == 2){
                        header('Location:admin/index.php');
                    }
                    else{
                        //member
                        header('Location:index.php');                    
                    }
                }
                else{?>
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
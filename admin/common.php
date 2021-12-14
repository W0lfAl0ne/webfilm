<?php
	// session_start();
	ob_start();
	if(isset($_SESSION['username'])){
		$name = $_SESSION['username'];
		// get ID admin
		require_once('../database/database.php');
		$sqlAd = "SELECT * from users WHERE user_name = '$name'";
		$resultAd =  executeResult($sqlAd);
		if(count($resultAd) > 0){
			$rowAd = $resultAd[0];
		}
		
?>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Admin Panel</a>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul id="active" class="nav navbar-nav side-nav">
				<li>
					<a href="index.php">
						<i class="fa fa-bullseye"></i> Dashboard</a>
				</li>
				<li>
					<a href="addFilm.php">
					<i class="fa fa-plus"></i></i> Add film</a>
				</li>
				<li>
					<a href="manageFilm.php">
					<i class="fa fa-tasks"></i> Manage film</a>
				</li>
				<?php if($rowAd['usertype']==1) {?>
				<li>
					<a href="addUser.php">
						<i class="fa fa-user-plus"></i> Add account</a>
				</li>
				<li>
					<a href="manageUser.php">
						<i class="fa fa-edit"></i> Manage User</a>
				</li>
				<?php } ?>
			</ul>
			<ul class="nav navbar-nav navbar-right navbar-user">
				<!-- <li>
					<form class="navbar-search">
						<input type="text" placeholder="Search" class="form-control">
					</form>
				</li> -->
				<li class="divider-vertical"></li>
				<li class="dropdown user-dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-user"></i> <?php echo $_SESSION['username'];?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo "editUser.php?id=". $rowAd["user_id"]?>"> <i class="fa fa-user"></i> Profile</a>
						</li>
						<li>
							<form method="post" action="">
								<a> <button id="logout" name="log_out" > 
									<i class="fa fa-power-off"></i>Đăng xuất</button> 
								</a>
							</form>
						</li>

					</ul>
				</li>

			</ul>

			<style>
				#logout{
					background: black; 
					width: 100%; 
					border: none; 
					color: white; 
					text-align: left; 
					padding-left: 20px;
				}
			</style>
			<?php
				if(isset($_POST["log_out"])){
					unset($_SESSION['username']);
					session_unset(); 
					session_destroy();
					header('Location:../index.php');
				}
			?>
		</div>
	</nav>
<?php
	} else {
		header('Location:../index.php');
	}
?>

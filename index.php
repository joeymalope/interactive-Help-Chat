<!DOCTYPE html>
<?php
	session_start();
	$servername="localhost";
	$user="103_Malope";
	$password="KrNgxdzT";
	$db="103_Malope";
	$conn=mysqli_connect($servername,$user,$password,$db);
	$notRegistered=false;
	if(isset($_POST["login"])){
		$email=$_POST["email"];
		$password=$_POST["password"];		
		$search="SELECT * FROM users WHERE email='$email' AND password='$password'";
		if($result=mysqli_query($conn,$search)){
			//echo "Big beard";
			$row=mysqli_fetch_assoc($result);
			if(mysqli_num_rows($result)==1){
				echo $row["username"];
				echo "<br />".$row["password"];
				$_SESSION['currentUser']=$row["username"];
				header('location:home.php')	 ;
			}
			else{
				echo "Not registered";
				$_SESSION["notRegistered"]=true;
			}
		}
	}

	if(isset($_POST["register"])){
		//echo "hello";
		$email=$_POST["email2"];
		$username=$_POST["username"];

		$password=$_POST["password1"];
		$search="SELECT * FROM users WHERE email='$email' AND password='$password'";
		$insert="INSERT INTO users (email,username,password) VALUES ('$email','$username','$password')  ";
		$results=mysqli_query($conn,$search);
		if(mysqli_num_rows($results) == 0){
			if(mysqli_query($conn,$insert)){
				echo "Inserted successfully";
			}
			else echo "<h1>Oops insert Query failed!!!</h1>";
		} 
		else $userExists=true;
	}
//	else echo "<h1>register fAILED</h1>";
?>
<html>	
	<head>
		<meta name="author"  content="Pappi Malope">
		<title>
			COMIC COM
		</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		  <script src="bootstrap/js/jquery-2.1.3.min.js"></script>
		  <script src="bootstrap/js/bootstrap.min.js"></script>
		  <script >
		  	$(document).ready(function() {      
			   $('.carousel').carousel('pause');
			});
		  </script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12" id="header">
					<div id="brand-name">
						COMIC COM
						<h2>
								The online Comic Con
						</h2>
					</div>

				</div>
			</div>	
			<div class="row" id="login">
				<div class="col-md-6 col-md-offset-3 col-xs-12">
				<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<form action="index.php" method="post">
								<legend>
									<h1>LOGIN</h1>
								</legend>
								<?php 
								if( isset($_SESSION["notRegistered"]) && $_SESSION["notRegistered"])
									echo "<p class='alert alert-danger'>Please check that your username and password are correct</p>";
								?>
								<div class="form-group">
									<label><h1>Email</h1></label>
									<input type="email" class="form-control" name="email" placeholder="WHAT'S YOUR EMAIL?"/>
								</div>	
								<div class="form-group">
									<label><h1>Password</h1></label>
									<input type="password" class="form-control" name="password" placeholder="ENTER PASSWORD"/>
								</div>	
								<input type="hidden" name="login" />
                                <div class="form-group">
									<button  class="btn btn-default" type="submit">
										LOGIN
									</button> 
								    <span data-target="#myCarousel" data-slide-to="1">
										<a href="">	<span id="account">Do you have acoount?</span></a>
									</span>
                                </div>    
							</form>
						</div>
						<div class="item register">
							<form action="index.php" method="post">
								<legend>
									<h1>REGISTER</h1>
								</legend>
								<div class="form-group">
									<label><h1>Username</h1></label>
									<input type="text" class="form-control" name="username" placeholder="WHAT'S YOUR USERNAME?"/>
								</div>	
								<div class="form-group">
									<label><h1>Email</h1></label>
									<input type="email" class="form-control" name="email2" placeholder="WHAT'S YOUR EMAIL?"/>
								</div>
								<div class="form-group">
									<label><h1>Password</h1></label>
									<input type="password" class="form-control" name="password1" id="password1" placeholder="ENTER PASSWORD"/>	
								</div>
								<div class="form-group">			
									<label><h1>Retype Password</h1></label>
									<input type="password" class="form-control" name="password2" id="password2" placeholder="RETYPE PASSWORD"/>
								</div>
								<input type="hidden" name="register" />	
								<div class="form-group">
									<button  class="btn btn-default" type="submit">
										REGISTER
									</button> 
								</div>	
							</form>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12" id="footer">	
				</div>
			</div>	
		</div>
	</body>
</html>
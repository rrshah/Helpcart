<?php
	session_start();
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Helpcart</title>
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>	
</head>

<body background="bb.png">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Helpcart</a>
			</div>	
				<div>
					<ul class="nav navbar-nav navbar-right">
					    <li><a href="#" id="signup" data-toggle="modal" data-target=".signup-modal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
					    <li><a href="#" id="login" data-toggle="modal" data-target=".login-modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> 
                                           

					</ul>
   				 </div>
		</div>

		<!---------- Login Modal ---------------->
		<div class="modal fade login-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Login</h4>
		      	</div>
			<div class="modal-body">
				<form role="form" method="post" action="">
					<div class="form-group">
						<input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
					</div>
					 <div class="form-group">
						<input name="password" type="password" class="form-control" id="pwd" placeholder="Password" required>
					</div>
					<button name="submit_login" type="submit" class="btn btn-primary">Login</button>
				</form>
			</div>
		    </div>
		  </div>
		</div>

		<!---------- Sign Up Modal ---------------->
		<div class="modal fade signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sign Up</h4>
		      	</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<div class="form-group">
						<input name="cust_name" type="text" class="form-control" id="name" placeholder="Name" required>
					</div>
					<div class="form-group">
						<input name="cust_email" type="email" class="form-control" id="email" placeholder="Email" required>
					</div>
					 <div class="form-group">
						<input name="cust_pwd" type="password" class="form-control" id="pwd" placeholder="Password" required>
					</div>
					<div class="form-group">
						<input name="cust_addr" type="text" class="form-control" id="addr" placeholder="Address" required>
					</div>
					<div class="form-group">
						<input name="cust_city" type="text" class="form-control" id="city" placeholder="City" required>
					</div>
					 <div class="form-group">
						<input name="cust_pincode" type="number" class="form-control" id="pin" placeholder="Pincode" required>
					</div>

					<button name="submit_signup" type="submit" class="btn btn-primary">Sign Up</button>
				</form>
			</div>
		    </div>
		  </div>
		</div>


	</nav>


	
	<div class="jumbotron">
		<div class="container">			
			<br><br>
			<p style="text align:justify">Do you want to get the best of domestic help and driving services? Do you want to get domestic help and drivers without having to step out of your home?  If your answer is yes, Helpcart is the place for you!</p>
		</div>
	</div>

	<div class="container">	
		<br><br><br>
		<div class="row">
			<a href="cook.php">
				<img style="margin: 0px 15px" src="cook.jpg" title="Cook" class="img-circle" alt="Cook" width="200" height="200"  class="thumbnail img-responsive">
			</a>
		
			<a href="chauffeur.php">
				<img style="margin: 0px 15px" src="chauffeur.jpg" title="Chauffeur" class="img-circle" alt="Chauffeur" width="200" height="200"  class="thumbnail img-responsive">
			</a>

			<a href="nanny.php">
				<img style="margin: 0px 15px" src="nanny.jpg" title="Nanny" class="img-circle" alt="Nanny" width="200" height="200"  class="thumbnail img-responsive">
			</a>
	
			<a href="caretaker.php">
				<img style="margin: 0px 15px" src="caretaker.jpg" title="Care Taker" class="img-circle" alt="Care Taker" width="200" height="200"  class="thumbnail img-responsive">
			</a>
	
			<a href="cleaner.php">
				<img style="margin: 0px 15px" src="cleaner.jpg" title="Cleaner" class="img-circle" alt="Cleaner" width="200" height="200"  class="thumbnail img-responsive">
			</a>
		</div>
	</div>
	
	
	<footer style=" position:fixed; height:50px; background-color:#E3E3E3; bottom:0px; left:0px; right:0px; margin-bottom:0px;">
		<div class="container">
			<br>
			<div class="row">
			    <div class="col-md-4">
	           		<a href="mail.php" class="text-muted">&copy Helpcart.com 2015</a>
				</div>
				<div class="col-md-4"></div>
			    <div class="col-md-2">
	           		<a href="aboutus.html" class="text-muted">About Us</a>
				</div>
				<div class="col-md-2">
					<a href="contactus.html" class="text-muted">Contact Us</a>
				</div>
			</div>
	  	</div>
	</footer>
	
<?php


	if (isset($_POST['submit_login'])) {
	  login();
	}

	if (isset($_POST['submit_signup'])) {
       	  signup();
	}

	function login(){
		$user_pwd = $_POST["password"];
		$user_name = $_POST["email"];

		try {

         		$servername = "localhost";
	        	$username = "root";
		 	$password = "magnum";
			$dbname = "helpcart";
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$stmt = $conn->prepare("SELECT cust_id,name FROM customer where password='$user_pwd' AND email='$user_name'"); 
		    	$stmt->execute();    
			$result = $stmt -> fetch();
			$cust_id = $result['cust_id'];
		    	$rows=$stmt->rowCount();	
			if ($rows == 1){
				$_SESSION["email"] = "$user_name";
				$_SESSION["cust_id"] = "$cust_id";
			}			    	
			else
				$error="Invalid Password or Username";
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
		$conn=null;
	}

	function signup(){
		try{
			 $name = $_POST["cust_name"];
			 $email = $_POST["cust_email"];
			 $password = $_POST["cust_pwd"];
			 $address = $_POST["cust_addr"];
			 $city = $_POST["cust_city"];
			 $pincode = (int)$_POST["cust_pin"];
			 $servername = "localhost";
			 $username = "root";
			 $password = "magnum";
			 $dbname = "helpcart";

			 $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 $stmt = $conn->prepare("INSERT INTO customer(name,email,password,address,city,pincode)values(:name,:email,:password,:address,:city,:pincode)");
			 $stmt->bindParam(":name", $name);
			 $stmt->bindParam(":email", $email);
			 $stmt->bindParam(":password", $password);
			 $stmt->bindParam(":address", $address);
			 $stmt->bindParam(":city", $city);
			 $stmt->bindParam(":pincode",$pincode,PDO::PARAM_INT);
			
		         if (!$stmt) {
				echo "\nPDO::errorInfo():\n";
				print_r($conn->errorInfo());
			 }
			 $stmt->execute();
			 session_start();
			 echo "<script type='text/javascript'>alert('success!')</script>";
			 $_SESSION["email"] = "$user_name";
			
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
	}
?>


</body>

</html>






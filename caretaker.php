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
				<a class="navbar-brand" href="#">Helpcart</a>
			</div>	
<div>
					<ul class="nav navbar-nav navbar-right">
					    <li><a href="index.php" id="home" ><span class="glyphicon glyphicon-home"></span> Home</a></li>
                                        </ul>
               </div>
		</div>
	</nav>

	<div class="jumbotron">
		<div class="container">
			<div class="row">
			    <div class="col-md-4">
					<br>
					<img src="caretaker.jpg" title="Care Taker" class="img-circle" alt="Cook" width="200" height="200"  class="thumbnail img-responsive">
			    </div>

			    <div class="col-md-8">
				<br><br><br><br>
				<p style="text-align: justify">When you’re faced with needing care or giving care, a little help can go a long way!</p>
			    </div>
			</div>
		</div>
		
	</div>
	<div class="container" style="background-color:white; padding:10px 10px">
	  <form class="form-horizontal" role="form" method="post" action="">
	    <div class="form-group">
	      <label class="control-label col-sm-2" for="pwd">Day:</label>
	      <div class="col-sm-10">          
		<input type="date" name="caretaker_date" required>
	      </div>
	    </div>

	    <div class="form-group">
	      <label class="control-label col-sm-2" for="time">Time (HH:MM AM/PM):</label>
	      <div class="col-sm-10">          
		<input type="time" name="caretaker_time" required>
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="control-label col-sm-2" for="hours">Total hours of operation:</label>
	      <div class="col-sm-10">          
		<select name="caretaker_op">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
					<option>11</option>
					<option>12</option>
					<option>Permanent</option>
				</select>
	      </div>
	    </div> 
	    <div class="form-group">        
	      <div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-primary" name="submit_caretaker">Submit</button>
	      </div>
	    </div>
	  </form>
	</div>

		<?php


			if (isset($_POST['submit_caretaker'])) {
			  caretaker();
			}

			function caretaker(){
				try{
					 
					 $servername = "localhost";
					 $username = "root";
					 $password = "magnum";
					 $dbname = "helpcart";
					 $catid = 1;
					 $cust_id = (int)$_SESSION["cust_id"];
					 $time = $_POST["caretaker_time"];
					 $day = $_POST["caretaker_date"];
					 $is_perm = $_POST["caretaker_op"];

					 if(is_numeric($is_perm))		
						$is_perm = 0;
					 else
						$is_perm = 1;
		echo "$is_perm\n";
					 $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    	 if(isset($_SESSION["email"])){
						 $stmt = $conn->prepare("SELECT DISTINCT worker.worker_id FROM worker LEFT JOIN transaction ON worker.worker_id = transaction.worker_id WHERE transaction.worker_id IS NULL and worker.cat_id = 3");
				$stmt->execute();    
				$result = $stmt -> fetch();
				$worker_id = $result['worker_id'];
			    	$rows=$stmt->rowCount();	

				if ($rows >= 1){
				 	 $stmt = $conn->prepare("INSERT INTO transaction(cust_id,cat_id,arrival_time,day,is_perm,worker_id) values(:cust_id,:cat_id,:time,:day,:is_perm,:worker_id)");
					 $stmt->bindValue(":cust_id",$cust_id,PDO::PARAM_INT);
					 $stmt->bindValue(":cat_id",3,PDO::PARAM_INT);
					 $stmt->bindParam(":time", $time);
					 $stmt->bindParam(":day", $day);
					 $stmt->bindParam(":is_perm", $is_perm, PDO::PARAM_BOOL);
					 $stmt->bindValue(":worker_id",$worker_id,PDO::PARAM_INT);
	
					 if (!$stmt) {
						echo "\nPDO::errorInfo():\n";
						print_r($conn->errorInfo());
					 }
					 $stmt->execute();
					$stmt = $conn->prepare("SELECT name,phone from worker where worker_id = $worker_id");
					 
					 if (!$stmt) {
						echo "\nPDO::errorInfo():\n";
						print_r($conn->errorInfo());
					 }
					 $stmt->execute();
					$result = $stmt -> fetch();
					$worker_name = $result['name'];
					$worker_phone = $result['phone'];
					echo "$worker_name";
					require 'PHPMailerAutoload.php';
					 
					$mail = new PHPMailer;
					 
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'rajani.brinda@gmail.com';                   // SMTP username
					$mail->Password = 'jaishrikrishna';               // SMTP password
					$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
					$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
					$mail->setFrom('rajani.brinda@gmail.com', 'Brinda Rajani');     //Set who the message is to be sent from
					$mail->addAddress('rutu.shah.26@gmail.com', 'Rutuja Shah');  // Add a recipient
					$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
					$mail->isHTML(true);                                  // Set email format to HTML
					 
					$mail->Subject = 'Worker Details';
					$mail->Body    = 'Worker Name: '.$worker_name.'<br>Worker Phone: ' .$worker_phone. '<br>Thank you!';
					$mail->AltBody = 'Worker Name: '.$worker_name.' Worker Phone: ' .$worker_phone. ' Thank you!';
					//$mail->AddAttachment("/var/www/html/worker.jpg");  
					//Read an HTML message body from an external file, convert referenced images to embedded,
					//convert HTML into a basic plain-text alternative body
					//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
					 if(!$mail->send()) {
					   echo 'Message could not be sent.';
					   echo 'Mailer Error: ' . $mail->ErrorInfo;
					   exit;
					}
					echo "<script type='text/javascript'>alert('Details of the worker have been mailed to you! Kindly check your inbox.')</script>"; 
				}
				else
					 echo "<script type='text/javascript'>alert('No worker available. Please try later')</script>";
					}
					else
						echo "<script type='text/javascript'>alert('Please Login!')</script>";
			
				}
				catch(PDOException $e) {
				    echo "Error: " . $e->getMessage();
				}
			}
		?>

</body>

</html>

<?php  
  


$servername = "localhost";
$username = "root";
$password = "";
$dbname="blog";


$username1="";
		$email="";
		$password1="";
		$fullname="";
		$dob="";
	  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
	$dsn= "mysql:host=" . $servername . ";dbname=" . $dbname;
	$pdo=new PDO($dsn, $username, $password);

	if ($_SERVER['REQUEST_METHOD']=="POST"){
if (isset($_POST['email'])  && isset($_POST['fullname'])){
 
 		 
	$username1=$_POST['username'];
	$email=$_POST['email'];
	$password1=$_POST['pwd'];
	$fullname=$_POST['fullname'];
	$dob="";
  

 $sql = "INSERT INTO users (username, email, password, fullname, dob) VALUES (:username, :email, :password, :fullname, :dob)";

      $stmt = $pdo->prepare($sql);
      
      $stmt->execute(['username' => $username1, 'email' => $email, 'password' => $password1, 'fullname' => $fullname, 'dob' => $dob]);


  
 }
  
 }
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}

if (isset($_SESSION['user'])) {
	try{
		$dsn= "mysql:host=" . $servername . ";dbname=" . $dbname;
		$pdo=new PDO($dsn, $username, $password);

		if ($_SERVER['REQUEST_METHOD']=="GET"){

			if (isset($_GET["posted"]) && isset($_GET["body"])&& isset($_GET["title"])){

			  	$title = $_GET["title"];
			 	$body = $_GET["body"];
			 	$publishDate = $_GET['publishDate'];
			 	$userId = $_SESSION['user']['id'];

				$sql1 = "INSERT INTO posts (title, body, publishDate, userId) VALUES (:title, :body, :publishDate, :userId)";
				$stmt = $pdo->prepare($sql1);
				$stmt->execute(['title' => $title, 'body' => $body, 'publishDate'=>$publishDate, 'userId' => $userId]);
				header('Location: index.php');
				exit;
			}
		}
		
	} 

	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
}
?>


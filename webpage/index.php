<?php
  
 	include('connection.php');

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}


function login(){
  include('connection.php');

	$query="SELECT * FROM users where username=:username and password=:password";
	$username = $_POST['username'];
	$password = $_POST['pwd'];
	$stmt = $pdo->prepare($query);
	$stmt->execute(['username' => $username,'password' => $password]);
	$count=$stmt->rowCount();

	$rows = $stmt->fetchAll();
	
	if($count > 0)
	{
		
		$_SESSION["user"] = $rows[0];

		unset($_SESSION['user']['password']);

		if (isset($_POST["remember"]))
		{
			setcookie("username", $_POST["username"] . $_POST["pwd"], time() + 60 * 60 * 24 * 365);
			
	 	}
	 	else
	 	{
	 		setcookie("username", $_POST["username"] . $_POST["pwd"], time()-1);
		}
	}
	header("Location: index.php");
	exit;
}


if (isset($_POST["login"])){
	if (empty($_POST["username"]) || empty($_POST["pwd"]))
		$message='<label> All fields are required</label>';
	else
		login();
}

if (isset($_GET["logout"])) {
	session_destroy();
	setcookie("username", '', -1);
	header('Location: index.php');
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Personal Page</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php include('header.php'); ?>

		<?php if (!isset($_COOKIE['username'])){ ?>
		 <div class="twocols">
			<form action="index.php" method="post" class="twocols_col">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" />
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" />
					</li>
					<li>
						<label for="remember">Remember Me</label>
						<input type="checkbox" name="remember" id="remember" checked />
					</li>
					<li>
						<input type="submit" name="login" value="Submit" /> &nbsp; Not registered? <a href="register.php">Register</a>
					</li>
				</ul>
			</form>

			<div class="twocols_col">
				<h2>About Us</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur libero nostrum consequatur dolor. Nesciunt eos dolorem enim accusantium libero impedit ipsa perspiciatis vel dolore reiciendis ratione quam, non sequi sit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nobis vero ullam quae. Repellendus dolores quis tenetur enim distinctio, optio vero, cupiditate commodi eligendi similique laboriosam maxime corporis quasi labore!</p>
			</div>
		</div>
	<?php } ?>

		<?php if (isset($_COOKIE['username'])){ ?>
<div class="logout_panel" method="get" ><a href="register.php">My Profile</a>&nbsp;|&nbsp;<a href="index.php?logout=1">Log Out</a></div>
		
		<h2>New Post</h2>
		<form action="index.php" method="get">
			<ul class="form">
				<li>
					<label for="title">Title</label>
					<input type="text" name="title" id="title" />
				</li>
				<li>
					<label for="body">Body</label>
					<textarea name="body" id="body" cols="30" rows="10"></textarea>
				</li>
				<li>
					<label for="start">Publish date:</label>

                  <input type="date" id="start" name="publishDate" min="2020-03-21" max="2021-03-21">
			</li>
					
				<li>
					<input type="submit" name="posted" value="Post" />
				</li>  


			</ul>
		</form>
		<div class="onecol">
			<div class="card">
				<h2>TITLE HEADING</h2>
				<h5>Author, Sep 2, 2017</h5>
				<p>Some text..</p>
				<p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
			</div>
			<div class="card">
				<h2>TITLE HEADING</h2>
				<h5>Author, Sep 2, 2017</h5>
				<p>Some text..</p>
				<p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
			</div>

		</div>
	<?php } ?>
		
	</body>
</html>
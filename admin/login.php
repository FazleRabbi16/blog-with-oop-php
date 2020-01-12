<?php
 include "../lib/Session.php";
  Session::int();
  Session::checklogin();
?>
<?php
//for remove undefine. 
 $msg = NULL;
 ?>
<?php include "../config/config.php";?>
<?php include "../lib/Database.php";?>
<?php include "../helpers/format.php";?>
<?php
// all object create here ...
$db = new Database();
$fm = new Format();
?>
<?php 
 //get user login data from input field
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['login']) ) {
  $Username = $fm->filterdata($_POST['username']);
  $Password = $fm->filterdata(md5($_POST['password']));
  $Username = mysqli_real_escape_string($db->link,$Username);
  $Password = mysqli_real_escape_string($db->link,$Password);
  $query    = "SELECT * FROM  tbl_user WHERE username='$Username' AND password='$Password'";
  $result   = $db->select($query);
  if ($result == false){
   $msg = "<span style='color:red;font-size:18px;'>Please enter any valid data.</span>";
  }
  if ($result){
  	$value = mysqli_fetch_array($result);  
  	$rows  = mysqli_num_rows($result); 
  	if ($rows > 0){
  		Session::set('login',true);
  		Session::set('username',$value['username']);
  		Session::set('userid',$value['id']);
      Session::set('name',$value['name']);
      Session::set('role',$value['role']);
  		header("location:index.php");
  	}else{
  	  "<span style='color:red;font-size:18px;'>No Data Match ! Please Contact With Our Support Team.</span>";
     }
    }
   }
 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="POST">
			<h1>User Login</h1>
			<?php echo $msg; ?>
			<div>
				<input type="text" placeholder="Username" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" name="login" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgotpassword.php">Forgot Password !</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
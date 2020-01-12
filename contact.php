<?php include "inc/header.php";?>
<?php 
 $error = $msg = "";
 ?>
<?php 
  if ($_SERVER['REQUEST_METHOD']=='POST') {
  	  $fname=$fm->filterdata($_POST['firstname']);
  	  $lname=$fm->filterdata($_POST['lastname']);
  	  $email=$fm->filterdata($_POST['email']);
  	  $body =$fm->filterdata($_POST['body']);
  	  $fname= mysqli_real_escape_string($db->link,$fname);
  	  $lname= mysqli_real_escape_string($db->link,$lname);
  	  $email= mysqli_real_escape_string($db->link,$email);
  	  $body = mysqli_real_escape_string($db->link,$body);
  	  if ($fname=='' OR $lname=='' OR $email=='' OR $body=='') {
  	  	$error = "Field Must Not Be Empty";
  	  }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
  	  	$error = "Enter Validate Email";
  	  }else{
   $query = "INSERT INTO tbl_contact(firstname,lastname,email,body) 
             VALUES('$fname','$lname','$email','$body')";
     $inserted_rows = $db->insert($query);
    if ($inserted_rows){
      $msg = "Message Send Successfully.";
    }else {
      $error = "Message Not Send"; 	
  	  }
  }
}
 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
    <?php 
	   if (isset($error)) {
	   	echo "<span style='color:red'>$error</span>";
	   }
	   if (isset($msg)) {
	   echo "<span style='color:green'>$msg</span>";
	   }
	 ?>					
				<h2>Contact us</h2>		
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>
</div>

<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>


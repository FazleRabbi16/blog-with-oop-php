<?php
 include "../lib/Session.php";
  Session::int();
  Session::checklogin();
?>
<?php
//for remove undefine. 
 $errormsg = NULL;
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
 //get user email for recover password
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['email'])) {
  $email = $fm->filterdata($_POST['email']);
  $email = mysqli_real_escape_string($db->link,$email);
  if (empty($email)){
    $errormsg="<span style='color:red;font-size:18px;'>Field Must Not Be Empty.</span>";
    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
     $errormsg="<span style='color:red;font-size:18px;'>Enter Your Validate Email.</span>";
    }else{
  $mailquery="SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
  $selecetmail=$db->select($mailquery);
      if ($selecetmail){
           while ($value=$selecetmail->fetch_assoc()) {
              $userid  =$value['id'];
              $username=$value['username'];
          }
         $txt=substr($email,0,3); 
         $rand=rand(100,500);
         $newpass="$txt$rand";
         $md5newpass=md5($newpass);
         $updatequery="UPDATE tbl_user SET password='$md5newpass'
                       WHERE id='$userid'";
         $update_row=$db->update($updatequery);
         $to      = 'nobody@example.com';
         $subject = 'Your New Password';
         $message = 'Hello'.$username.' your new password is '.$newpass;
         $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion(); 
         $sendmail=mail($to, $subject,$message);
         if ($sendmail){
           $errormsg="<span style='color:green;font-size:18px;'>Email sent successfully.</span>";
          }else{
            $errormsg="<span style='color:red;font-size:18px;'>Email not sent.</span>";
          }          
      }elseif($selecetmail==false){
        $errormsg="<span style='color:red;font-size:18px;'>Email Not Exist.</span>";
      }
    }

   }
 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Forget Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
  <section id="content">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
      <h1>Password Recovery.</h1>
    <?php 
    if (isset($errormsg)){
       echo $errormsg;
     }
     ?>  
      <div>
        <input type="text" placeholder="Enter Your Valid Email" name="email"/>
      </div>
      <div>
        <input type="submit" name="recover" value="send mail" />
      </div>
    </form><!-- form -->
    <div class="button">
      <a href="login.php">Login</a>
    </div><!-- button -->
  </section><!-- content -->
</div><!-- container -->
</body>
</html>
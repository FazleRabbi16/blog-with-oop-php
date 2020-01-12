<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php 
  if (Session::get('role')!=0) {
    echo "<script>window.location='index.php';</script>";
  }
 ?>
<div class="grid_10">

<div class="box round first grid">
    <h2>Add New User</h2>
   <div class="block copyblock"> 
<?php 
 if ($_SERVER['REQUEST_METHOD']=='POST' AND isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email    = $_POST['email'];
    $role     = $_POST['role'];
    $name     = $fm->filterdata($name);
    $username = $fm->filterdata($username);
    $password = $fm->filterdata($password);
    $email    = $fm->filterdata($email);
    $role     = $fm->filterdata($role);
    $name     = mysqli_real_escape_string($db->link,$name);
    $username = mysqli_real_escape_string($db->link,$username);
    $password = mysqli_real_escape_string($db->link,$password);
    $email    = mysqli_real_escape_string($db->link,$email);
    $role     = mysqli_real_escape_string($db->link,$role);
    if (empty($username) || empty($password) || empty($email) || empty($role)){
      echo "<span style='color:red;font-size:18px;'>Field Must Not Be Empty.</span>";
    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
     echo "<span style='color:red;font-size:18px;'>Invalid email address.</span>";
    } else{
      $mailquery = "SELECT*FROM tbl_user WHERE email='$email'";
      $mail =$db->select($mailquery);
      $checkmail=$mail->fetch_assoc();
      if ($checkmail!=false) {
       echo "<span style='color:red;font-size:18px;'>Email Already Exist.</span>";
      }else{
        $query   = "INSERT INTO  tbl_user(name,username,password,email,role) VALUES('$name','$username','$password','$email','$role')"; 
    $adduser = $db->insert($query); 
    if ($adduser){
    echo "<span style='color:green;font-size:18px;'>User Added Succesfully.</span>";
    }else{
    echo "<span style='color:red;font-size:18px;'>User Not Added Succesfully.</span>";
       }  
    }
      }
    
   
 }
?>

 <form action="" method="POST">
<table class="form">
<tr>
  <td><label>Name:</label></td>
        <td>
            <input type="text" name="name" placeholder="Enter Username..." class="medium" />
        </td>
    </tr>          
    <tr>
  <td><label>Username:</label></td>
        <td>
            <input type="text" name="username" placeholder="Enter Username..." class="medium" />
        </td>
    </tr>
 
 <tr>
  <td><label>Password:</label></td>
        <td>
            <input type="text" name="password" placeholder="Enter Password" class="medium" />
        </td>
    </tr>

      <tr>
     <td><label>E-mail:</label></td>
        <td>
            <input type="text" name="email" placeholder="Enter Valid E-mail Address..." class="medium" />
        </td>
    </tr>

     <tr>
      <td></td>
       <td>
      <select class="select" name="role">
        <option>Select User Role</option>
        <option value="0">Admin</option>
        <option value="1">Author</option>
        <option value="2">Editor</option>
      </select>
      </td>
     </tr> 

     <tr>
      <td></td>
        <td>
            <input type="submit" name="submit" Value="Create" />
        </td>
    </tr>
</table>
</form>
</div>
</div>
  </div>
<?php include "inc/footer.php";?> 

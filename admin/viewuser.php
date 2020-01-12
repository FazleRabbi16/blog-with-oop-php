<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php 
 if (!isset($_GET['userid']) OR $_GET['userid']==NULL) {
   echo "<script>window.location='userlist.php';</script>";
 }else{
   $userId=$_GET['userid'];
 }
 ?>
 <?php 
  if (isset($_POST['submit'])) {
    echo "<script>window.location='userlist.php';</script>";
  }

  ?>
<div class="grid_10">
<div class="box round first grid">
<h2>User details</h2>
<div class="block">
<?php 
 $query="SELECT * FROM tbl_user WHERE id='$userId'";
 $user =$db->select($query);
 if ($user){
    while ($result=$user->fetch_assoc()){
      $userrole=$result['role'];
     if ($userrole==0) {
        $role = "Admin";
      }elseif($userrole==1){
        $role = "Author";
      }elseif ($userrole==2) {
        $role = "Editor";
      } 
 ?>               
<form action="" method="POST" >
<table class="form">
 <tr>
    <td>
        <label>Name:</label>
    </td>
    <td>
        <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
    </td>
</tr>

<tr>
    <td>
        <label>Username:</label>
    </td>
    <td>
        <input type="text" value="<?php echo $result['username'];?>" name="username" class="medium" />
    </td>
</tr>

 <tr>
    <td>
        <label>E-mail</label>
    </td>
    <td>
        <input type="text" name="email" value="<?php echo $result['email'];?>" class="medium" />
    </td>
</tr> 

 <tr>
    <td>
        <label>User Role : </label>
    </td>
    <td>
        <input type="text" name="role" value="<?php echo $role;?>" class="medium" />
    </td>
</tr>     
<tr>
<td style="vertical-align: top; padding-top: 9px;">
      <label>Details</label>
  </td>
  <td>
      <textarea class="tinymce" name="body">
     <?php echo $result['details'];?>
      </textarea>
  </td>
</tr>
<tr>
<td></td>
<td>
  <input type="submit" name="submit" Value="Ok" />
</td>
</tr>
</table>
</form>
<?php } } ?>
</div>
</div>
</div>
<!--Load TinyMCE-->         
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function(){
     setupTinyMCE();
     setDatePicker('date-picker');
     $('input[type="checkbox"]').fancybutton();
     $('input[type="radio"]').fancybutton();
   }); 
</script> 
<!--Load TinyMCE-->
<?php include "inc/footer.php";?>
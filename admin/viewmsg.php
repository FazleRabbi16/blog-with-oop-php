<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<div class="grid_10">
<div class="box round first grid">
<h2>View Message.</h2>
<?php 
 if ($_SERVER['REQUEST_METHOD']=='POST' AND $_POST['submit']) {
    echo "<script>window.location='inbox.php';</script>";
 }
 ?>
<?php
 if(!isset($_GET['viewmsgid']) OR $_GET['viewmsgid']==NULL){
      //header("location:inbox.php");
     echo "<script>window.location='inbox.php';</script>";
  }else{
    $msgid=$_GET['viewmsgid'];
  } 
 ?>
<div class="block">
<?php 
$query="SELECT * FROM tbl_contact WHERE id='$msgid'";
$msg=$db->select($query);
if ($msg){
  while ($result=$msg->fetch_assoc()){ 
 $fullname = $result['firstname'].' '.$result['lastname'];
?>             
<form action="" method="POST">  
<table class="form">
 <tr>
    <td>
        <label>Name</label>
    </td>
    <td>
        <input type="text" readonly name="name" value="<?php echo $fullname;?>" class="medium" />
    </td>
</tr>

 <tr>
    <td>
        <label>Email</label>
    </td>
    <td>
        <input type="text" readonly name="email" value="<?php echo $result['email'];?>" class="medium" />
    </td>
</tr>

 <tr>
    <td>
        <label>Date</label>
    </td>
    <td>
        <input type="text" readonly name="name" value="<?php echo $fm->dateformat($result['date']);?>" class="medium" />
    </td>
</tr>

<tr>
  <td style="vertical-align: top; padding-top: 9px;">
      <label>Message</label>
  </td>
  <td>
<textarea class="tinymce" name="body">
  <?php echo $result['body'];?>
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
<?php }} ?>
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
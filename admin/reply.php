<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<div class="grid_10">
<div class="box round first grid">
<h2>Reply Message Throug Email.</h2>
<?php
 if(!isset($_GET['replymsgid']) OR $_GET['replymsgid']==NULL){
     echo "<script>window.location='inbox.php';</script>";
  }else{
    $msgid=$_GET['replymsgid'];
  } 
 ?>
<?php 
 if ($_SERVER['REQUEST_METHOD']=='POST' AND $_POST['submit']) {
    $to      = $fm->filterdata($_POST['toEmail']);
    $from    = $fm->filterdata($_POST['fromEmail']);
    $subject = $fm->filterdata($_POST['subject']);    
    $message = $fm->filterdata($_POST['body']);
    $to      = mysqli_real_escape_string($db->link,$to);
    $from    = mysqli_real_escape_string($db->link,$from);
    $subject = mysqli_real_escape_string($db->link,$subject);
    $message = mysqli_real_escape_string($db->link,$message);
    $sendEmail=mail($to,$subject,$message,$from);
    if ($sendEmail){
      echo "<span style='color:green;font-size:18px;'>Email Send Successfully.
     </span>";
    }else{
      echo "<span style='color:red;font-size:18px;'>Email Not Send Successfully.
     </span>";
    }
 }
 ?>

<div class="block">
<?php 
$query="SELECT * FROM tbl_contact WHERE id='$msgid'";
$msg=$db->select($query);
if ($msg){
  while ($result=$msg->fetch_assoc()){ 
?>             
<form action="" method="POST">  
<table class="form">
 <tr>
    <td>
        <label>TO</label>
    </td>
    <td>
        <input type="text" readonly name="toEmail" value="<?php echo $result['email'];?>" class="medium" />
    </td>
</tr>

 <tr>
    <td>
        <label>From</label>
    </td>
    <td>
        <input type="text"  name="fromEmail" placeholder="Enter validate email" class="medium" />
    </td>
</tr>

 <tr>
    <td>
        <label>Subject</label>
    </td>
    <td>
        <input type="text"  name="subject" class="medium" />
    </td>
</tr>
 <tr>
  <td style="vertical-align: top; padding-top: 9px;">
      <label>Message</label>
  </td>
  <td>
<textarea class="tinymce" name="body"></textarea>
  </td>
  </tr>

<tr>
      <td></td>
      <td>
          <input type="submit" name="submit" Value="Send" />
           <a type="submit" href="inbox.php">Back</a>
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
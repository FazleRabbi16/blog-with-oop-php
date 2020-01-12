<?php include "inc/header.php";?>
<style>
  .deletebtn{margin-left:10px;}
  .deletebtn a{background:#f0f0f0 none repeat scroll 0 0;
   border:1px solid #ddd;
   color:#444;
   cursor:pointer;font-size:20px;font-weight:normal;padding: 4px 10px;
  }
</style>
<?php include "inc/sidebar.php";?>
<div class="grid_10">
<div class="box round first grid">
<h2>Page</h2>

<?php 
//get id for update
if (!isset($_GET['pageid']) OR $_GET['pageid']==NULL) {
  echo "<script>window.location='index.php';</script>";
}else{
     $id=$_GET['pageid'];
 }
 ?>
<?php 
//update
 if ($_SERVER['REQUEST_METHOD']=='POST' AND isset($_POST['submit'])){
    $name = mysqli_real_escape_string($db->link,$_POST['name']);
    $body = mysqli_real_escape_string($db->link,$_POST['body']);
    if ($name=='' || $body==''){
    echo "<span style='color:red;font-size:18px;'>Field Must Not Be Empty.</span>";
    }else{
    $query = "UPDATE tbl_page SET name='$name',body='$body' WHERE id='$id'";
    $update_rows = $db->update($query);
    if ($update_rows){
     echo "<span style='color:green;font-size:18px;'>Page Updated Successfully.
     </span>";
    }else {
     echo "<span style='color:green;font-size:18px;'>Page Not Updated Successfully!</span>";
    }
   }     
    
}
?> 
 <?php 
   $query="SELECT * FROM tbl_page WHERE id='$id'";
   $query_push = $db->select($query);
   if ($query_push){
       while ($result = $query_push->fetch_assoc()){
   ?> 
<div class="block">               
<form action="" method="POST">
<table class="form">
 <tr>
    <td>
        <label>Name</label>
    </td>
    <td>
        <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
    </td>
</tr>
<tr>
  <td style="vertical-align: top; padding-top: 9px;">
      <label>Content</label>
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
          <input type="submit" name="submit" Value="Update" />
   <span class="deletebtn"><a onclick="return confirm('Are you sure to delete data.')" href="deletepage.php?delete=<?php echo $result['id'];?>">Delete</a></span>
      </td>
  </tr>
</table>
</form>
 </div>
<?php } } ?>
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
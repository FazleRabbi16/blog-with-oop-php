<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php 
//see postlist.php line maybe line 72 and look here.
 if ((md5('terces'.$_GET['EditSliderid']) != $_GET['editseq'])) {
      echo "<script>window.location='postlist.php';</script>";
 }else{
    $sliderid = $_GET['EditSliderid'];
 }
 ?>
<div class="grid_10">
<div class="box round first grid">
<h2>Update Slider</h2>
<?php 
 if ($_SERVER['REQUEST_METHOD']=='POST' AND isset($_POST['submit'])){
    $title = mysqli_real_escape_string($db->link,$_POST['title']);
    //image 
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;
    //image
    if ($title==''){
    echo "<span style='color:red;font-size:18px;'>Field Must Not Be Empty.</span>";
    }else{
        if(!empty($file_name)){
         if($file_size >1048567){
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    }elseif(in_array($file_ext,$permited) === false){
     echo "<span>You can upload only:-"
     .implode(', ', $permited)."</span>";
    }else{
    move_uploaded_file($file_temp, $uploaded_image);
    $query = "UPDATE tbl_slider
              SET  
              title='$title',
              image='$uploaded_image'
             WHERE id='$sliderid'
              ";
    $updated_rows = $db->update($query);
    if ($updated_rows){
     echo "<span style='color:green;font-size:18px;'>Slider updated Successfully.
     </span>";
    }else {
     echo "<span style='color:green;font-size:18px;'>Slider Not updated !</span>";
    }
   }     
  }else{
    $query = "UPDATE tbl_slider
              SET  
              title='$title'
              WHERE id='$sliderid'
              ";
    $updated_rows = $db->update($query);
    if ($updated_rows){
     echo "<span style='color:green;font-size:18px;'>Slider Data updated Successfully.
     </span>";
    }else {
     echo "<span style='color:green;font-size:18px;'>Slider Data Not updated !</span>";
    }

  }

 } 
   }
  ?>
<?php 
 $query="SELECT * FROM tbl_slider WHERE id='$sliderid'";
 $slider = $db->select($query);
 if ($slider) {
     while ($slider_result = $slider->fetch_assoc()) {
 ?>

<div class="block">               
<form action="" method="POST" enctype="multipart/form-data">
<table class="form">
 <tr>
    <td>
        <label>Title</label>
    </td>
    <td>
        <input type="text" name="title" value="<?php echo $slider_result['title']; ?>" class="medium" />
    </td>
</tr>
<tr>
  <td>
      <label>Upload Slider</label>
  </td>
  <td>
<img src="<?php echo $slider_result['image']; ?>" width="140px" height="80px"><br/>
<input type="file" name="image" />
  </td>
</tr>
        
<tr>
      <td></td>
      <td>
          <input type="submit" name="submit" Value="Update" />
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
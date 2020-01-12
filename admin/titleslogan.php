<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<style>
 .leftside{float:left;width:70%;}   
 .rightside{float:right;width:20%;}
 .rightside img{height:160px; width:180px;}
</style>
        <div class="grid_10">
		  <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
  <?php 
 if ($_SERVER['REQUEST_METHOD']=='POST' AND isset($_POST['submit'])){
    $title  =$fm->filterdata($_POST['title']);
    $slogan =$fm->filterdata($_POST['slogan']); 
    $title = mysqli_real_escape_string($db->link,$title);
    $slogan = mysqli_real_escape_string($db->link,$slogan);
    //image 
    $permited  = array('png');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = 'logo'.'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;
    //image
    if ($title=='' || $slogan==''){
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
    $query = "UPDATE title_slogan
              SET  
              title='$title',
              slogan='$slogan',
              logo='$uploaded_image'
             WHERE id='1'
              ";
    $updated_rows = $db->update($query);
    if ($updated_rows){
     echo "<span style='color:green;font-size:18px;'>Data updated Successfully.
     </span>";
    }else {
     echo "<span style='color:green;font-size:18px;'>Data Not updated !</span>";
    }
   }     
  }else{
    $query = "UPDATE title_slogan
              SET 
              title='$title', 
              slogan='$slogan'
              WHERE id='1' ";
    $updated_rows = $db->update($query);
    if ($updated_rows){
     echo "<span style='color:green;font-size:18px;'>Data updated Successfully.
     </span>";
    }else {
     echo "<span style='color:green;font-size:18px;'>Data Not updated !</span>";
    }

  }

 } 
   }
  ?>              
  <?php 
   $query="SELECT * FROM title_slogan";
   $query_push = $db->select($query);
   if ($query_push){
       while ($result = $query_push->fetch_assoc()){
   ?>              
                <div class="block sloginblock"> 
                <div class="leftside">              
<form action="titleslogan.php" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
    <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
<input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label>Upload logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                            </td>
                            <td>
     <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
          <div class="rightside">
          <img src="<?php echo $result['logo'];?>" alt="logo">
          </div>      
                </div>
<?php } } ?>

            </div>
        </div>
<?php include "inc/footer.php";?>  

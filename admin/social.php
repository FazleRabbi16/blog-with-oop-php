<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
		  <div class="box round first grid">
                <h2>Update Social Media</h2>
<?php 
if ($_SERVER['REQUEST_METHOD']=='POST' AND isset($_POST['submit'])){
$facebook=$fm->filterdata($_POST['facebook']);
$twitter =$fm->filterdata($_POST['twitter']);
$linkedin =$fm->filterdata($_POST['linkedin']); 
$googleplus =$fm->filterdata($_POST['googleplus']);
$facebook = mysqli_real_escape_string($db->link,$facebook);
$twitter = mysqli_real_escape_string($db->link,$twitter);
$linkedin = mysqli_real_escape_string($db->link,$linkedin);
$googleplus = mysqli_real_escape_string($db->link,$googleplus);
 if ($facebook=='' || $twitter=='' || $linkedin==''|| $googleplus==''){
    echo "<span style='color:red;font-size:18px;'>Field Must Not Be Empty.</span>";
    }else{
        $query = "UPDATE social_media
                  SET  
                  facebook='$facebook',
                  twitter='$twitter',
                  linkedin='$linkedin',
                  googleplus='$googleplus'
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
}
?>                  
<?php 
$query="SELECT * FROM social_media";
$query_push = $db->select($query);
if ($query_push){
while ($result = $query_push->fetch_assoc()){
?>  
        <div class="block">               
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
    <input type="text" name="facebook" value="<?php echo $result['facebook'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
<input type="text" name="twitter" value="<?php echo $result['twitter'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
<input type="text" name="linkedin" value="<?php echo $result['linkedin'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
 <input type="text" name="googleplus" value="<?php echo $result['googleplus'];?>" class="medium" />
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
 <?php include "inc/footer.php";?>       

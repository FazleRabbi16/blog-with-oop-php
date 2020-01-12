<?php $id=0;?>
<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?> 
<div class="grid_10">
<div class="box round first grid">
<h2>Update Theme</h2>
<div class="block copyblock">

 <?php 
 if ($_SERVER['REQUEST_METHOD']=='POST' AND isset($_POST['submit'])){
        $theme = $_POST['theme'];
        $theme = $fm->filterdata($theme);
        $query="UPDATE tbl_theme
                SET theme='$theme'
                WHERE id='1'";
        $update = $db->update($query);
      if ($update){
     echo "<span style='color:green;font-size:18px;'>Theme Updated Succesfully.</span>";
      }else{
        echo "<span style='color:green;font-size:18px;'>Theme Not Updated.</span>";
      }        
    }   
?>
<?php 
$query = "SELECT * FROM tbl_theme WHERE id='1'";
$themes = $db->select($query);
if ($themes) {
    while ($result=$themes->fetch_assoc()){
?>
<form action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<table class="form">					
<tr>
    <td>
<input type="radio" name="theme" value="default" <?php if ($result['theme']=='default'){echo "checked";} ?> />Default
    </td>
</tr>
<tr>
    <td>
        <input type="radio" name="theme" value="green" <?php if ($result['theme']=='green'){echo "checked";} ?> />Green
    </td>
</tr>
<tr>
    <td>
        <input type="radio" name="theme" value="light_blue" <?php if ($result['theme']=='light_blue'){echo "checked";} ?> />Light blue
    </td>
</tr>
<tr> 
    <td>
        <input type="submit" name="submit" Value="Change" />
    </td>
</tr>
</table>
</form>
 <?php }} ?>
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?> 

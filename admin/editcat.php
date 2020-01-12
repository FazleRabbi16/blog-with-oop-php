<?php $id=0;?>
<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?> 
<div class="grid_10">
<div class="box round first grid">
<h2>Update Category</h2>
<div class="block copyblock">
<?php 
if (!isset($_GET['catid']) OR $_GET['catid']==NULL) {
  echo "<script>window.location='catlist.php';</script>";
}
 if (isset($_GET['catid'])) {
     $id=$_GET['catid'];
 }
 ?>
 <?php 
 if ($_SERVER['REQUEST_METHOD']=='POST' AND !empty($id)){
        $name = $_POST['name'];
        $name = $fm->filterdata($name);
        $query="UPDATE tbl_category
                SET cat_name='$name'
                WHERE id='$id'";
        $update = $db->update($query);
      if ($update){
     echo "<span style='color:green;font-size:18px;'>Category Updated Succesfully.</span>";
      }else{
        echo "<span style='color:green;font-size:18px;'>Category Not Updated.</span>";
      }        
    }   
?>
<?php 
$query = "SELECT * FROM tbl_category WHERE id='$id'";
$catname = $db->select($query);
if ($catname) {
    while ($result=$catname->fetch_assoc()) {
?>
<form action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<table class="form">					
<tr>
    <td>
        <input type="text" name="name" value="<?php echo $result['cat_name'];?>" class="medium" />
    </td>
</tr>
<tr> 
    <td>
        <input type="submit" name="submit" Value="Save" />
    </td>
</tr>
</table>
</form>
<?php }} ?>
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?> 

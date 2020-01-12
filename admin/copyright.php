<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<div class="grid_10">
<div class="box round first grid">
        <h2>Update Copyright Text</h2>
<?php 
if ($_SERVER['REQUEST_METHOD']=='POST' AND isset($_POST['submit'])){
$note=$fm->filterdata($_POST['copyright']);
$note = mysqli_real_escape_string($db->link,$note);
if ($note==''){
    echo "<span style='color:red;font-size:18px;'>Field Must Not Be Empty.</span>";
    }else{
        $query = "UPDATE tbl_copywrite
                  SET  
                  note='$note'
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
$query="SELECT * FROM tbl_copywrite";
$query_push = $db->select($query);
if ($query_push){
while ($result = $query_push->fetch_assoc()){
?>         
        <div class="block copyblock"> 
         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
<input type="text" value="<?php echo $result['note'];?>" name="copyright" class="large" />
                    </td>
                </tr>
				
				 <tr> 
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
<div class="clear">
</div>
</div>
<?php include "inc/footer.php";?>    
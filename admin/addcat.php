<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
<?php 
 if ($_SERVER['REQUEST_METHOD']=='POST' AND isset($_POST['catname'])) {
    $catname = $_POST['catname'];
    $catname = $fm->filterdata($catname);
    $Catname = mysqli_real_escape_string($db->link,$catname);
    if (empty($Catname)){
      echo "<span style='color:red;font-size:18px;'>Field Must Not Be Empty.</span>";
    }else{
    $query   = "INSERT INTO  tbl_category(cat_name) VALUES('$Catname')"; 
    $InsertCategory = $db->insert($query); 
    if ($InsertCategory) {
    echo "<span style='color:green;font-size:18px;'>Category Inserted Succesfully.</span>";
    }else{
    echo "<span style='color:red;font-size:18px;'>Category Not Inserted.</span>";
       }  
    }
   
 }
?>

 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<table class="form">					
    <tr>
        <td>
            <input type="text" name="catname" placeholder="Enter Categorey Name" class="medium" />
        </td>
    </tr>
	<tr> 
        <td>
            <input type="submit" name="submit" Value="Save" />
        </td>
    </tr>
</table>
</form>
</div>
</div>
</div>
<?php include "inc/footer.php";?> 

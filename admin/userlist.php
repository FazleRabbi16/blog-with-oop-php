<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
 <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
<?php 
if (isset($_GET['deluser'])&&Session::get('role')==0){
$deluser = $_GET['deluser'];
$query="DELETE FROM tbl_user WHERE id='$deluser'";
$Removeuser= $db->delete($query);
if (!$Removeuser){
//echo "<script>window.location='catlist.php';</script>";
echo "<span style='color:red;font-size:18px;'>User Not Remove.</span>";
}else{

echo "<span style='color:green;font-size:18px;'>User Remove Succesfully.</span>";
 }
}
?>
<div class="block">        
<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Details</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php 
$query  = "SELECT * FROM tbl_user";
$user = $db->select($query);
if ($user){
$i = 0;
while ($result = $user->fetch_assoc()) {
	$i++;
  $user_role=$result['role'];
  if ($user_role==0) {
    $role="Admin";
  }elseif ($user_role==1) {
    $role="Author";
  }elseif ($user_role==2) {
   $role="Editor";
  }
?>
<tr class="odd gradeX">
<td><?php echo $i;?></td>
<td><?php echo $result['name'];?></td>
<td><?php echo $result['username'];?></td>
<td><?php echo $result['email'];?></td>
<td><?php echo $role?></td>
<td><?php echo $fm->textshort($result['details'],30);?></td>
<td>
<a href="viewuser.php?userid=<?php echo $result['id'];?>">View</a> 
<?php if(Session::get('role')==0) { ?>
 ||<a href="?deluser=<?php echo $result['id'];?>" onclick="return confirm('Are you sure to delet the user.')">Delete</a>
<?php }?>
</td>
</tr>
<?php } } ?>	
</tbody>
				</table>
               </div>
            </div>
          </div>
 <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();

      });
 </script>         
<?php include "inc/footer.php";?>         

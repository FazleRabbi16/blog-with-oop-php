<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<!--Delete image-->
<?php 
$delmsg=NULL;
 if (isset($_GET['Deleteslider']) ){
 	if (Session::get('role')=='0'){
    $sliderid = $_GET['Deleteslider'];
 	$query  = "SELECT * FROM tbl_slider WHERE id='$sliderid'";
 	$slider=$db->select($query);
 	if ($slider){
 	 	while ($getdata = $slider->fetch_assoc()){
 	 		$dellink = $getdata['image'];
 	 		unlink($dellink);
 	 	}
 	   } 
 	 $delquery = "DELETE FROM tbl_slider WHERE id='$sliderid'";
 	 $delslider  = $db->delete($delquery);
 	 if($delslider){
 	  $delmsg = "<span style='color:green;font-size:18px;'>Slider Deleted Succesfully.</span>";
 	    }else{
 	  $delmsg = "<span style='color:red;font-size:18px;'>Slider Not Deleted .</span>"; 	
 	    }
 }
}
 ?>
 <!--Delete image-->
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
      <?php echo $delmsg;//show delete message ?>          
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="30%">Slider Title</th>
							<th width="50%">Image</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>	
<?php 
//show all post
$query = "SELECT * FROM tbl_slider ORDER BY id DESC";
$slider = $db->select($query);
 if($slider){
 	$i=0;
   while ($slider_result = $slider->fetch_assoc()){
    $i++;       
 ?>
<tr class="odd gradeX">
	<td><?php echo $i;?></td>
	<td><?php echo $slider_result['title'];?></td>
	<td><img src="<?php echo $slider_result['image'];?>" padding="50px" width="200px" height="100px"></td>
<td>	
<?php
$secret =  md5('terces'.$slider_result['id']);
if ( Session::get('role')==0 ){ ?>
<a href="editslider.php?editseq=<?php echo $secret; ?>&EditSliderid=<?php echo $slider_result['id'];?>">Edit</a> || 
<a href="?Deleteslider=<?php echo $slider_result['id'];?>" onclick="return confirm('Are you sure to delete the data')">Delete</a>
<?php } ?>
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

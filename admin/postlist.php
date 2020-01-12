<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<!--Delete image-->
<?php 
$delmsg=NULL;
 if (isset($_GET['Deletepost']) ){
 	if (Session::get('role')=='0' || Session::get('role')=='1'){
    $postid = $_GET['Deletepost'];
 	$query  = "SELECT * FROM tbl_post WHERE id='$postid'";
 	$data=$db->select($query);
 	if ($data){
 	 	while ($getdata = $data->fetch_assoc()) {
 	 		$dellink = $getdata['image'];
 	 		unlink($dellink);
 	 	}
 	   } 
 	 $delquery = "DELETE FROM tbl_post WHERE id='$postid'";
 	 $deldata  = $db->delete($delquery);
 	 if($deldata){
 	  $delmsg = "<span style='color:green;font-size:18px;'>Post Deleted Succesfully.</span>";
 	    }else{
 	  $delmsg = "<span style='color:red;font-size:18px;'>Post Not Deleted.</span>"; 	
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
							<th width="15%">Category</th>
							<th width="10%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tag</th>
							<th width="10%">Date</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>	
<?php 
//show all post
$query = "SELECT tbl_post.*,tbl_category.cat_name
          FROM tbl_post
          INNER JOIN tbl_category
          ON tbl_post.catid = tbl_category.id";
 $post = $db->select($query);
 if($post){
 	$i=0;
   while ($result = $post->fetch_assoc()){
    $i++;       
 ?>
<tr class="odd gradeX">
	<td><?php echo $i;?></td>
	<td><?php echo $result['cat_name'];?></td>
	<td><?php echo $result['title'];?></td>
	<td><?php echo $fm->textshort($result['body'],50);?></td>
	<td><img src="<?php echo $result['image'];?>" padding="50px" width="60px" height="40px"></td>
	<td><?php echo $result['author'];?></td>
	<td><?php echo $result['tags'];?></td>
	<td><?php echo $fm->dateformat($result['date']);?></td>
	<td>
    <a href="viewpost.php?ViewPostid=<?php echo $result['id'];?>">View</a>
         <?php
			$secret =  md5('terces'.$result['id']);
			if (Session::get('userid')==$result['userid'] OR Session::get('role')==0 ){ ?>
				||<a href="editpost.php?editseq=<?php echo $secret; ?>&EditPostid=<?php echo $result['id'];?>">Edit</a> || 
		<a href="?Deletepost=<?php echo $result['id'];?>" onclick="return confirm('Are you sure to delete the data')">Delete</a>
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

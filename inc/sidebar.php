<div class="sidebar clear">
<div class="samesidebar clear">
<h2>Categories</h2>
<?php 
//show all category 
$query = "SELECT * FROM tbl_category"; 
$Allcategory=$db->select($query);
if($Allcategory){
 while ($result=$Allcategory->fetch_assoc()){
 ?>
<ul>
<li><a href="postbycat.php?category=<?php echo $result['id'];?>"><?php echo $result['cat_name'];?></a></li>
</ul>
<?php }}else{?>
<li>No Category Created</li>	
<?php } ?>	
	</div>			
<div class="samesidebar clear">
<h2>Latest articles</h2>
<?php 
//show all latest post 
$query = "SELECT * FROM tbl_post ORDER BY id DESC limit 5"; 
$All_latestpost = $db->select($query);
if($All_latestpost){
 while ($result=$All_latestpost->fetch_assoc()){
 ?>
<div class="popular clear">
<h3><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
<?php echo $fm->textshort($result['body'],100);?>
</div>
<?php } }else{header("Location:404.php");}?>					
</div>
			
</div>
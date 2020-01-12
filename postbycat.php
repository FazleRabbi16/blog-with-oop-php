<?php include "inc/header.php";?>
<div class="contentsection contemplete clear">
<div class="maincontent clear"><!--Main section start-->
<?php 
 if(!isset($_GET['category']) || $_GET['category']==NULL){
 	header("Location:404.php");
 }else{
 	$id = $_GET['category']; 
 }
 ?>
 
<?php
// for show those post whose are matching by category...
$query = "SELECT * FROM tbl_post WHERE catid=$id";
$post  = $db->select($query);
if($post){
  while ($result = $post->fetch_assoc()){
?>
<div class="samepost clear">

<h2><a href="post.php?id=<?php echo $result['id']?>"><?php echo $result['title']?></a></h2>

<h4><?php echo $fm->dateformat($result['date']);?>, By <a href="#"><?php echo $result['author']?></a></h4>
<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
<?php echo $fm->textshort($result['body']);?>
<div class="readmore clear">
<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
</div>

</div>
<?php } }else{ ?>
<h3>No Post Available In These Category.</h3>
<?php } ?>
</div><!--Main section end-->

<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
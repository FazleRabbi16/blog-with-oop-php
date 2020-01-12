<?php include "inc/header.php";?>
<?php 
 if(!isset($_GET['id']) || $_GET['id']==NULL){
 	header("Location:404.php");
 }else{
 	$id = $_GET['id']; 
 }
 ?>
<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
<?php 
//showing deatils about post.
$query = "SELECT * FROM tbl_post WHERE id=$id";
$post_details  = $db->select($query);
  if($post_details){
  	    while ($result=$post_details->fetch_assoc()){
 ?>
<h2><?php echo $result['title']?></h2>
<h4><?php echo $fm->dateformat($result['date']);?>, By <a href="#"><?php echo $result['author']?></a></h4>
<img src="admin/<?php echo $result['image'];?>" alt="post image"/>
 <?php echo $result['body'];?>
           

<div class="relatedpost clear">
<h2>Related articles</h2>	
<?php 
 //show related post.
  $catid = $result['catid'];
  $queryRelated = "SELECT * FROM tbl_post WHERE catid=$catid AND id NOT IN($id) limit 6";

  $related_post = $db->select($queryRelated);
  if($related_post){
  	    while ($related_result=$related_post->fetch_assoc()){
?>
<a href="post.php?id=<?php echo $related_result['id'];?>"><img src="admin/<?php echo $related_result['image'];?>" alt="post image"/></a>

<?php } }else{echo "No Related Data Available.";} ?>
</div>
<?php } }else{header("location:404.php");}?>
</div>
</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>		
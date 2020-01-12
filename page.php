<?php include "inc/header.php";?>
<div class="contentsection contemplete clear">
<div class="maincontent clear">
<div class="about">
<?php				
if (!isset($_GET['pageid']) OR $_GET['pageid']==NULL){
  header("location:404.php");
}else{
	$get_page_id=$_GET['pageid'];
}
?>	
<?php 
$query="SELECT * FROM tbl_page WHERE id='$get_page_id'";
$page = $db->select($query);
if($page){
while ($result=$page->fetch_assoc()){
?>
<h2><?php echo $result['name'];?></h2>
<p><?php echo $result['body'];?></p>
<?php } } ?>			
</div>
</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
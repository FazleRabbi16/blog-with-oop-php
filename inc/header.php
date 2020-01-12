<?php include "lib/Session.php"; Session::int();?>
<?php include "config/config.php";?>
<?php include "lib/Database.php";?>
<?php include "helpers/format.php";?>

<?php
// all object create here ...
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<html>
<head>
<?php include "scripts/meta.php"; ?>
<?php include"scripts/css.php";?>
<?php include"scripts/js.php";?>
</head>

<body>
<?php 
  if (isset($_GET['search'])){
   $search = Session::set('search',$_GET['search']);
   //print_r($another);exit();
  }
  $search = Session::get('search');
 ?>

<!--headercaption-->	
	<?php 
   $query="SELECT * FROM title_slogan";
   $query_push = $db->select($query);
   if ($query_push){
       while ($result = $query_push->fetch_assoc()){
   ?>  
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
				<img src="admin/<?php echo $result['logo'];?>" alt="Logo"/>
				<h2><?php echo $result['title'];?></h2>
				<p><?php echo $result['slogan'];?></p>
			</div>
		</a>
	<?php } } ?>	
<!--headercaption-->		
		<div class="social clear">
<?php 
$query="SELECT * FROM social_media";
$query_push = $db->select($query);
if ($query_push){
while ($result = $query_push->fetch_assoc()){
?>
			<div class="icon clear">
<a href="<?php echo $result['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
<a href="<?php echo $result['twitter'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
<a href="<?php echo $result['linkedin'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
<a href="<?php echo $result['googleplus'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
<?php } } ?>			
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" 
                 <?php if (isset($search)){ ?>
                  value = "<?php echo $search;?>";	
                 <?php }else{ ?>
                  placeholder ="searh keyword..";	
                 <?php } ?>	
				/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
<?php 
  $path = $_SERVER['SCRIPT_FILENAME'];
  $currentpath = basename($path,'.php'); 
 ?>
	<ul>
		<li><a 
          <?php  
           if ($currentpath == 'index') {
           echo "id='active'";//active by menue
           }
           ?>
			href="index.php">Home</a></li>
		  <?php 
		   $query="SELECT * FROM tbl_page";
		   $query_push = $db->select($query);
		   if ($query_push){
		       while ($result = $query_push->fetch_assoc()){
		   ?>
		<li><a 
            <?php 
              if (isset($_GET['pageid']) && $_GET['pageid']==$result['id']) {
              	echo 'id="active"';//active by Database
              }
             ?>

			href="page.php?pageid=<?php echo $result['id'];?>"><?php echo $result['name'];?></a></li>	
	<?php } } ?>
		<li><a 
            <?php
           if ($currentpath == 'contact') {
           echo "id='active'"; //active by menue
           }
           ?>
			href="contact.php">Contact</a></li>
	</ul>
</div>
<?php 
     //dynamicallys show header title
	  if (isset($_GET['pageid'])){
	  	$get_page_id = $_GET["pageid"];
	  	$pagequery="SELECT * FROM tbl_page WHERE id='$get_page_id'";
		$query_push = $db->select($pagequery);
		   if ($query_push){
		   while ($pageheader=$query_push->fetch_assoc()){  ?>
	      <title><?php echo $pageheader['name']."-".Title;?></title>
	      <?php }}}elseif (isset($_GET['id'])){
	     $postid = $_GET["id"];
	  	 $pagequery="SELECT * FROM tbl_post WHERE id='$postid'";
		 $query_push = $db->select($pagequery);
		   if ($query_push){
		   while ($pageheader=$query_push->fetch_assoc()){ 
	       ?>
          <title><?php echo $pageheader['title']."-".Title;?></title>
          <?php }}}else{?>
	      <title><?php echo $fm->title()."-".Title;?></title>	
	      <?php }?>	
    <meta name="language" content="English">
<meta name="description" content="It is a website about education">
 <?php 
  if (isset($_GET['id'])){
  	  $tagid=$_GET['id'];
  	  $pagequery="SELECT * FROM tbl_post WHERE id='$tagid'";
      $tag = $db->select($pagequery);
		if ($tag){
		 while ($value=$tag->fetch_assoc()){ ?>
      	<meta name="keywords" content="<?php echo $value['tags'];?>">		 	
		<?php }}}else{?>
		<meta name="keywords" content="<?php echo KEYWORDS;?>">	
		<?php } ?>		 	

<meta name="author" content="F.Rabbi">
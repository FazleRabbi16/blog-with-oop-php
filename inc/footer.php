	</div>
		
	</div>

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
<?php 
$query="SELECT * FROM tbl_copywrite";
$query_push = $db->select($query);
if ($query_push){
while ($result = $query_push->fetch_assoc()){
?>
<p>&copy; <?php echo $result['note']; echo "&nbsp"; echo date("d-m-Y") ;?>.</p>
<?php } } ?>	  
	</div>
<?php 
$query="SELECT * FROM social_media";
$query_push = $db->select($query);
if ($query_push){
while ($result = $query_push->fetch_assoc()){
?>
	<div class="fixedicon clear">
<a href="<?php echo $result['facebook'];?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
<a href="<?php echo $result['twitter'];?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
<a href="<?php echo $result['linkedin'];?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
<a href="<?php echo $result['googleplus'];?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>
	</div>
<?php } } ?>	
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>
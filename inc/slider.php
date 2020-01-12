<div class="slidersection templete clear">
        <div id="slider">
        	<?php 
             $query="SELECT * FROM tbl_slider ORDER BY id limit 5";
             $img = $db->select($query);
             if ($img){
             	while ($getimg = $img->fetch_assoc()){
        	 ?>
            <a href="#"><img src="admin/<?php echo $getimg['image'];?>" alt="<?php echo $getimg['title'];?>" title="<?php echo $getimg['title'];?>" /></a>
          <?php } } ?>
        </div>

</div>
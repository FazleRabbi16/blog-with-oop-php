<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php 
 if (!isset($_GET['ViewPostid']) OR $_GET['ViewPostid']==NULL){
      echo "<script>window.location='postlist.php';</script>";
 }else{
    $postid = $_GET['ViewPostid'];
 }
 ?>
 <?php 
   if (isset($_POST['submit'])) {
     echo "<script>window.location='postlist.php';</script>";
   }
  ?>
<div class="grid_10">
<div class="box round first grid">
<h2>View Post</h2>
<?php 
 $query="SELECT * FROM tbl_post WHERE id='$postid'";
 $post = $db->select($query);
 if ($post) {
     while ($postresult = $post->fetch_assoc()) {
 ?>

<div class="block">               
<form action="" method="POST" enctype="multipart/form-data">
<table class="form">
 <tr>
    <td>
        <label>Title</label>
    </td>
    <td>
        <input type="text" readonly name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
    </td>
</tr>

<tr>
    <td>
        <label>Tags</label>
    </td>
    <td>
        <input type="text" readonly name="tags" value="<?php echo $postresult['tags']; ?>" class="medium" />
    </td>
</tr>

 <tr>
    <td>
        <label>Author</label>
    </td>
    <td>
        <input type="text" readonly name="author" value="<?php echo $postresult['author']; ?>" class="medium" />
    </td>
    <td>
        <input type="hidden" name="userid" value="<?php echo Session::get('userid'); ?>" class="medium" />
    </td>
</tr>   
       <!--category-->
               <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                       <select id="select" readonly name="catname">
                            <option value="1">Select Category</option>
                     <?php 
                    $query="SELECT * FROM tbl_category";
                    $category=$db->select($query);
                    if ($category) {
                           while ($result=$category->fetch_assoc()) {   
                          ?>     
<option
<?php if ($result['id'] == $postresult['catid']) { ?>
   selected='selected';
<?php } ?>
 value="<?php echo $result['id'];?>"><?php echo $result['cat_name'];?></option>
                  <?php } } ?>
                        </select>  
                    </td>
                </tr>
          <!--category--> 
                        <tr>
                            <td>
                                <label>Image</label>
                            </td>
                            <td>
  <img src="<?php echo $postresult['image']; ?>" width="120px" height="80px"><br/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                <?php echo $postresult['body'];?>    
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
              <?php } } ?>  
            </div>
        </div>
<!--Load TinyMCE-->         
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function(){
     setupTinyMCE();
     setDatePicker('date-picker');
     $('input[type="checkbox"]').fancybutton();
     $('input[type="radio"]').fancybutton();
   }); 
</script> 
<!--Load TinyMCE-->
<?php include "inc/footer.php";?>
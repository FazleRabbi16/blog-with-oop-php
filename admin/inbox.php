<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
<?php 
  if (isset($_GET['seenmsgid'])) {
     $seenmsgid=$_GET['seenmsgid'];
       $query= "UPDATE tbl_contact
                SET 
                status='1'
                WHERE id='$seenmsgid'
                  ";
     $updated_rows = $db->update($query);
    if ($updated_rows){
     echo "<span style='color:green;font-size:18px;'>Message TO Send Seen Box.
     </span>";
    }else {
     echo "<span style='color:green;font-size:18px;'>Sorry there is problem to move seen box!</span>";
    }           
  }
 ?>
 <?php 
  $unseenmsg=$deletemsg=NULL;
  if (isset($_GET['unseenmsgid'])){
     $unseenmsgid=$_GET['unseenmsgid'];
       $query= "UPDATE tbl_contact
                SET 
                status='0'
                WHERE id='$unseenmsgid'
                  ";
     $updated_rows = $db->update($query);
    if ($updated_rows){
     $unseenmsg = "<span style='color:green;font-size:18px;'>Message TO Send Unseen Box.
     </span>";
    }else {
     $unseenmsg = "<span style='color:green;font-size:18px;'>Sorry there is problem to move Unseen box!</span>";
    }           
  }
if (isset($_GET['delmsgid'])){
     $delmsgid=$_GET['delmsgid'];
$query= "DELETE FROM tbl_contact 
         WHERE id='$delmsgid' ";
     $delete_rows = $db->update($query);
    if ($delete_rows){
     $deletemsg = "<span style='color:green;font-size:18px;'>Message Delete Successfully.
     </span>";
    }else {
     $deletemsg = "<span style='color:green;font-size:18px;'>Message Not Delete Successfully.!</span>";
    }           
  }

 ?> 
             <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">S.No.</th>
							<th width="15%">Name</th>
							<th width="15%">Email</th>
							<th width="20%">Message</th>
							<th width="10%">Date</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query  = "SELECT * FROM tbl_contact WHERE status='0'
						  ORDER BY id DESC";
						$msg = $db->select($query);
						if ($msg){
						$i = 0;
						while ($result= $msg->fetch_assoc()){
						$i++; 
			$fullname = $result['firstname'].' '.$result['lastname'];
							?>
						<tr class="odd gradeX"> 			
			<td><?php echo $i;?></td>
            <td><?php echo $fullname;?></td>
			<td><?php echo $result['email'];?></td>
			<td><?php echo $fm->textshort($result['body'],30);?></td>
			<td><?php echo $fm->dateformat($result['date']);?></td>
						<td>
<a href="viewmsg.php?viewmsgid=<?php echo $result['id'];?>">View</a>||
<a href="reply.php?replymsgid=<?php echo $result['id'];?>">Reply</a>||
<a onclick="return confirm('Are You Sure To Move the Message To Seen Box')" href="?seenmsgid=<?php echo $result['id'];?>">Seen</a>
					   </td>
					</tr>
			      <?php }}?>
					</tbody>
				</table>
               </div>
           </div>
<!--seen message-->
               <div class="box round first grid">
                <h2>Seen Message</h2>
          <?php 
		   if (isset($unseenmsg)){
		   	echo $unseenmsg;
		     }
		   if (isset($deletemsg)) {
		    	echo $deletemsg;
		    } 
		   ?>     
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                    $query  = "SELECT * FROM tbl_contact WHERE status='1'
						  ORDER BY id DESC";
						$msg = $db->select($query);
						if ($msg){
						$i = 0;
						while ($result= $msg->fetch_assoc()){
						$i++; 
			$fullname = $result['firstname'].' '.$result['lastname'];
							?>
						<tr class="odd gradeX"> 			
			<td><?php echo $i;?></td>
            <td><?php echo $fullname;?></td>
			<td><?php echo $result['email'];?></td>
			<td><?php echo $fm->textshort($result['body'],30);?></td>
			<td><?php echo $fm->dateformat($result['date']);?></td>
						<td>
<a onclick="return confirm('Are You Sure To Delete The Record')" href="?delmsgid=<?php echo $result['id'];?>">Delete</a>||
<a href="?unseenmsgid=<?php echo $result['id'];?>">Unseen</a>
					   </td>
					</tr>
			      <?php }}?>
					</tbody>
				</table>
               </div>
            </div>
  <!--seen message-->          
        </div>
        
 <script type="text/javascript">
    $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();

      });
 </script>         
<?php include "inc/footer.php";?>

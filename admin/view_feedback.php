<?php 
    session_start();
    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    if(isset($_GET['del']))
    {
        if(mysqli_query($conn,"delete from feedback where id = '".$_GET['id']."'"))
        {
            echo "<script>alert('Feedback deleted successfully..!')</script>";
        }
        else
        {
            echo "<script>alert('Unable to delete feedback..!')</script>";
            echo mysqli_error($conn);
        }
    }
    include 'link.php';
    include 'admin_header.php';
?>
    <div class="outter-wp">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
										<th>Name</th>
										<th>User Name</th>
										<th>Product</th>
										<th>Contact</th>
										<th>Feedback</th>
										<th>Date</th>
										<th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                    $query=mysqli_query($conn,"select product.name as pname, feedback.id, user.first_name, user.last_name, user.username, user.contact, feedback.feedback, feedback.date, feedback.status from feedback join user on feedback.userid=user.id join product on product.id = feedback.product_id where feedback.status=true order by feedback.id desc");
                                    $cnt=1;
                                    while($row=mysqli_fetch_array($query))
                                    {?>									
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['first_name']." ".$row['last_name']);?></td>
                                            <td><?php echo htmlentities($row['username']);?></td>
                                            <td><?php echo htmlentities($row['pname']);?></td>
                                            <td><?php echo htmlentities($row['contact']);?></td>
                                            <td><?php echo htmlentities($row['feedback']);?></td>
                                            <td><?php echo htmlentities($row['date']);?></td>
                                            <td> <?php if($row['status']){echo 'Active';}else{echo 'In-Active';}?></td>
                                            <td>
                                                <a href="view_feedback.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                                        </tr>
                                        <?php $cnt=$cnt+1; 
                                    } ?>
                                </tbody>			
                            </table>
    </div>
        
<?php
    include 'footer.php';
    include 'admin_sidebar.php';
?>
<!--js -->
<link rel="stylesheet" href="css/vroom.css">
<script type="text/javascript" src="js/vroom.js"></script>
<script type="text/javascript" src="js/TweenLite.min.js"></script>
<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
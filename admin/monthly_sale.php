<?php 
    session_start();
    include 'config.php';
    $uid = $_SESSION['id'];

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    include 'link.php';
    include 'admin_header.php';
    ?>
    
    <button style="float:right" onclick="printDiv('printableArea')" type="button" class="btn btn-success">
    Print   <span class="glyphicon glyphicon-chevron-right"></span>
    </button>
    <div class="outter-wp" id="printableArea">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
										<th>Bill No</th>
										<th>Buyer Name</th>
										<th>Address</th>
										<th>City</th>
										<th>Pin Code</th>
										<th>Payment No</th>
										<th>Payment Method</th>
										<th>Bill Amount</th>
										<th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                                    $query=mysqli_query($conn,"select * from purchase WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE()) order by id desc
                                    ");
                                    $cnt=1;
                                    while($row=mysqli_fetch_array($query))
                                    {?>									
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['product_track']);?></td>
                                            <td><?php echo htmlentities($row['user_fullname']);?></td>
                                            <td><?php echo htmlentities($row['user_address']);?></td>
                                            <td><?php echo htmlentities($row['user_city']);?></td>
                                            <td><?php echo htmlentities($row['user_pin']);?></td>
                                            <td><?php echo htmlentities($row['payment_no']);?></td>
                                            <td><?php echo htmlentities($row['payment_method']);?></td>
                                            <td><?php echo htmlentities($row['amount']);?></td>
                                            <td><?php echo htmlentities($row['date']);?></td>
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
<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
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
<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
  $query = 'SELECT ID, t.TYPE
            FROM users u
            JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['TYPE'];
                   
  if ($Aa=='User'){
?>
  <script type="text/javascript">
    //then it will be redirected
    alert("Restricted Page! You will be redirected to POS");
    window.location = "pos.php";
  </script>
<?php
  }           
}      $Dtotal = null;
       if($_GET['action'] == "daily"){
            $date_now = date('Y-m-d'); // get current date
            // Get the daily sales
            $query = "SELECT T.DATE as DATE, C.PRODUCTS, C.size, C.QTY, C.PRICE, (C.QTY * C.PRICE) as GTOTAL
            FROM transaction T
            JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
            WHERE DATE(T.DATE) = '".$date_now."'
            ORDER BY DATE(T.DATE) DESC";
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            
            // Get the Total of daily sales
            $query1 = "SELECT T.DATE as DATE, C.PRODUCTS, C.size, C.QTY, C.PRICE, SUM(C.QTY * C.PRICE) as DTOTAL
            FROM transaction T
            JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
            WHERE DATE(T.DATE) = '".$date_now."'
            ORDER BY DATE(T.DATE) DESC";
            $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));

            while ($row1 = mysqli_fetch_assoc($result1)) {
              $Dtotal = $row1['DTOTAL'];
            }           
       }elseif($_GET['action'] == "monthly"){
            $date_now = date('Y-m-d'); // get current date
            // Get the Monthly sales
            $query = "SELECT T.DATE as DATE, C.PRODUCTS, C.size, C.QTY, C.PRICE, (C.QTY * C.PRICE) as GTOTAL
            FROM transaction T
            JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
            WHERE MONTH(T.DATE) = MONTH(now())
            ORDER BY DATE(T.DATE) DESC";
            $result = mysqli_query($db, $query) or die (mysqli_error($db));

            // Get the Total of Monthly sales
            $query1 = "SELECT T.DATE as DATE, C.PRODUCTS, C.size, C.QTY, C.PRICE, SUM(C.QTY * C.PRICE) as DTOTAL
            FROM transaction T
            JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
            WHERE MONTH(T.DATE) = MONTH(now())
            ORDER BY DATE(T.DATE) DESC";
            $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));

            while ($row1 = mysqli_fetch_assoc($result1)) {
              $Dtotal = $row1['DTOTAL'];
            }
       }elseif($_GET['action'] == "year"){
            $date_now = date('Y-m-d'); // get current date
            // Get the Yearly sales
            $query = "SELECT T.DATE as DATE, C.PRODUCTS, C.size, C.QTY, C.PRICE, (C.QTY * C.PRICE) as GTOTAL
            FROM transaction T
            JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
            WHERE Year(T.DATE) = Year(now())
            ORDER BY DATE(T.DATE) DESC";
            $result = mysqli_query($db, $query) or die (mysqli_error($db));

            // Get the Total of yearly sales
            $query1 = "SELECT T.DATE as DATE, C.PRODUCTS, C.size, C.QTY, C.PRICE, SUM(C.QTY * C.PRICE) as DTOTAL
            FROM transaction T
            JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
            WHERE Year(T.DATE) = Year(now())
            ORDER BY DATE(T.DATE) DESC";
            $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));

            while ($row1 = mysqli_fetch_assoc($result1)) {
              $Dtotal = $row1['DTOTAL'];
            }
       }elseif($_GET['action'] == "range"){
        $from_date = $_POST["from_date"];
        $to_date = $_POST["to_date"];
        // Get the Range sales
        $query = "SELECT T.DATE as DATE, C.PRODUCTS, C.size, C.QTY, C.PRICE, (C.QTY * C.PRICE) as GTOTAL
          FROM transaction T
          JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
          WHERE DATE(T.DATE) BETWEEN '".$from_date."' AND '".$to_date."'
          ORDER BY DATE(T.DATE) DESC";
          $result = mysqli_query($db, $query) or die (mysqli_error($db));
        

        // Get the Total of Range sales
        $query1 = "SELECT T.DATE as DATE, C.PRODUCTS, C.size, C.QTY, C.PRICE, SUM(C.QTY * C.PRICE) as DTOTAL
          FROM transaction T
          JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
          WHERE DATE(T.DATE) BETWEEN '".$from_date."' AND '".$to_date."'
          ORDER BY DATE(T.DATE) DESC";
          $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
          while ($row1 = mysqli_fetch_assoc($result1)) {
            $Dtotal = $row1['DTOTAL'];
          }
       }else{
        // Get all sales
        $query = 'SELECT C.PRODUCTS, C.size, C.QTY, C.PRICE, (C.QTY * C.PRICE) as GTOTAL, T.DATE
              FROM transaction T
              JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
              ORDER BY T.DATE DESC';
              $result = mysqli_query($db, $query) or die (mysqli_error($db));
        // Get Total all sales
        $query1 = 'SELECT C.PRODUCTS, C.size, C.QTY, C.PRICE, SUM(C.QTY * C.PRICE) as DTOTAL, T.DATE
              FROM transaction T
              JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
              ORDER BY T.DATE DESC';
              $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
              while ($row1 = mysqli_fetch_assoc($result1)) {
                $Dtotal = $row1['DTOTAL'];
              }
       }
            ?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-2 font-weight-bold text-primary">Sales </h4>
                <h4 class="m-2 font-weight-bold text-primary">&nbsp;<a  href="Sales.php?action=daily" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;">Daily Sales</a>&nbsp;<a  href="Sales.php?action=monthly" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;">Monthly Sales</a>&nbsp;<a  href="Sales.php?action=year" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;">Yearly Sales</a>&nbsp;<a  href="Sales.php?action=" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;">View All</a> </h4>
                <hr>
                <h6><form method="post" action="Sales.php?action=range">&nbsp;<label for="from_date">From Date:</label>&nbsp;<input type="date" id="from_date" name="from_date">&nbsp;<label for="to_date">To Date:</label>&nbsp;<input type="date" id="to_date" name="to_date">&nbsp;<input class="btn btn-primary bg-gradient-primary" type="submit" value="View Date Range"></form></h6>
                <hr>
                <h2 class="m-2 font-weight-bold text-secondary">TOTAL SALES : <?php echo '₱ '.number_format($Dtotal, 2).'' ?> </h2>    
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th width="20%">Date</th>
                     <th>Product Name</th>
                     <th>Size</th>
                     <th width="10%">Qty</th>
                     <th width="13%">Price</th>
                     <th width="13%">Grand Total</th>
                   </tr>
               </thead>
          <tbody>
          <?php                  
    
          
      
            while ($row = mysqli_fetch_assoc($result)) {
                       
                echo '<tr>';
                echo '<td>'. $row['DATE'].'</td>';
                echo '<td>'. $row['PRODUCTS'].'</td>';
                echo '<td>'. $row['size'].'</td>';
                echo '<td>'. $row['QTY'].'</td>';
                echo '<td>'. $row['PRICE'].'</td>';
                echo '<td>'. $row['GTOTAL'].'</td>';
                echo '</tr> ';
                        }
          ?>                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
<?php
include'../includes/footer.php';
?>
<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?><?php 

                $query = 'SELECT ID, t.TYPE
                          FROM users u
                          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['TYPE'];
                   
if ($Aa=='User'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected
                      alert("Restricted Page! You will be redirected to POS");
                      window.location = "pos.php";
                  </script>
             <?php   }
                         
           
}   
            ?>
          <div class="row show-grid">
            <!-- Customer ROW -->
            <div class="col-md-3">
            <!-- Customer record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body" >
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Transaction Type</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM customer";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Record(s)
                      </div>
                    </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                  </div>
                </div>
              </div>
            </div>          

          <!-- User record -->
          <div class="col-md-12 mb-3">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Registered Account</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM users WHERE TYPE_ID=2";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Record(s)
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 mb-3" >
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center" >
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">LOW STOCK ARE BELOW 5</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query1 = 'SELECT NAME, SUM(QTY_STOCK) as TOTAL_STOCK, c.CNAME
                           FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID
                           GROUP BY NAME,CNAME DESC
                           HAVING TOTAL_STOCK < 5';
                        $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                          echo '<br>'.$row1['NAME'];
                          echo '('.$row1['CNAME'].')';
                          echo '<br> Quantity: '.$row1['TOTAL_STOCK'];
                          echo '<hr>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          
            <!-- Employee ROW -->
          <div class="col-md-3">
            <!-- Employee record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Employees</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM employee";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Record(s)
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-12 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sales</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                         $query1 = 'SELECT C.PRODUCTS, C.size, C.QTY, C.PRICE, SUM(C.QTY * C.PRICE) as DTOTAL, T.DATE
                         FROM transaction T
                         JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
                         ORDER BY T.DATE DESC';
                         $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
                         while ($row1 = mysqli_fetch_assoc($result1)) {
                           $Dtotal = $row1['DTOTAL'];
                           echo "₱ ".number_format($Dtotal, 2)." ";
                         }
                        ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 mb-3" >
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center" >
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cashier Total Sales History </div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query1 = 'SELECT t.ROLE, t.EMPLOYEE, SUM(t.QTY * t.PRICE) as TOTAL_SALES, td.TRANS_ID
                           FROM  transaction_details t join transaction td on t.TRANS_D_ID = td.TRANS_D_ID
                           GROUP BY t.EMPLOYEE
                           ORDER BY td.TRANS_ID ASC';
                        $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                          echo ''.$row1['ROLE'];
                          echo '<br>'.$row1['EMPLOYEE'];
                          echo '<br> Total Sales : ₱ '.number_format($row1['TOTAL_SALES'], 2).'';
                          echo '<hr>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          
          <!-- PRODUCTS ROW -->
          <div class="col-md-3">
            <!-- Product record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">

                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Product</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800">
                          <?php 
                          $query = "SELECT COUNT(*) FROM product";
                          $result = mysqli_query($db, $query) or die(mysqli_error($db));
                          while ($row = mysqli_fetch_array($result)) {
                              echo "$row[0]";
                            }
                          ?> Record(s)
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Overall Item Sale</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query1 = 'SELECT C.PRODUCTS, C.size, C.QTY, C.PRICE, COUNT(C.QTY) as DTOTAL, T.DATE
                        FROM transaction T
                        JOIN transaction_details C ON T.`TRANS_D_ID`=C.`TRANS_D_ID`
                        ORDER BY T.DATE DESC';
                        $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                          $Dtotal = $row1['DTOTAL'];
                          echo $Dtotal." ";
                        }
                        ?> Item(s)
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
           
            </div>

            
          <!-- NEWEST PRODUCTS -->
                <div class="col-lg-3">
                    <div class="card shadow h-100">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">

                          <div class="col-auto">
                            <i class="fa fa-th-list fa-fw"></i> 
                          </div>

                        <div class="panel-heading"> Newest Product
                        </div>
                        <div class="row no-gutters align-items-center mt-1">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-0 text-gray-800">
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="list-group">
                              <?php 
                                $query = "SELECT NAME, PRODUCT_CODE FROM product order by PRODUCT_ID DESC LIMIT 5";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<a href='#' class='list-group-item text-gray-800'>
                                          <i class='fa fa-tasks fa-fw'></i> ".$row['NAME']."
                                          </a>";
                                  }
                              ?>
                            </div>
                            <!-- /.list-group -->
                            <a href="product.php" class="btn btn-default btn-block">View All Products</a>
                        </div>
                        <!-- /.panel-body -->
                    </div></div></div></div></div>
                  



                    <div class="card-body">
                        <div class="row no-gutters align-items-center">

                          <div class="col-auto">
                            <i class="fa fa-th-list fa-fw"></i> 
                          </div>

                        <div class="panel-heading"> Top Product Sales
                        </div>
                        <div class="row no-gutters align-items-center mt-1">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-0 text-gray-800">
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="list-group">
                              <?php 
                                $query = "SELECT PRODUCTS, SUM(QTY) as total_qty, size FROM transaction_details GROUP BY PRODUCTS, size ORDER BY total_qty DESC, size LIMIT 5";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<a href='#' class='list-group-item text-gray-800'>
                                          ".$row['PRODUCTS']."<br>(".$row['size'].") <br> Quantity :".$row['total_qty']."
                                          </a>";
                                  }
                              ?>
                            </div>
                            <!-- /.list-group -->
                            <a href="transaction.php" class="btn btn-default btn-block">View Transactions</a>
                        </div>
                        <!-- /.panel-body -->
                    </div></div></div></div></div>

                    <div class="card-body">
                        <div class="row no-gutters align-items-center">

                          <div class="col-auto">
                            <i class="fa fa-th-list fa-fw"></i> 
                          </div>

                        <div class="panel-heading"> Latest Transaction 
                        </div>
                        <div class="row no-gutters align-items-center mt-1">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-0 text-gray-800">
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="list-group">
                              <?php 
                                $query = 'SELECT *, FIRST_NAME,tt.EMPLOYEE
                                  FROM transaction T
                                  JOIN customer C ON T.`CUST_ID`=C.`CUST_ID`
                                  JOIN transaction_details tt ON tt.`TRANS_D_ID`=T.`TRANS_D_ID`
                                  GROUP BY TRANS_ID DESC LIMIT 5';
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<a href='#' class='list-group-item text-gray-800'>
                                          ".$row['DATE']."<br>(".$row['FIRST_NAME'].") <br> ITEM :".$row['NUMOFITEMS']."<br> Cashier :".$row['EMPLOYEE']."
                                          </a>";
                                  }
                              ?>
                            </div>
                            <!-- /.list-group -->
                            <a href="transaction.php" class="btn btn-default btn-block">View Transaction</a>
                        </div>
                        <!-- /.panel-body -->
                    </div></div></div></div></div></div>
                  </div>         
          </div>
          
<?php
include'../includes/footer.php';
?>
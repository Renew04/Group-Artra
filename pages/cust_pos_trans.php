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
           
             ?>   
             <?php   
                         
           
}   
            ?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $fname = $_POST['firstname'];
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO customer
                    (CUST_ID, FIRST_NAME)
                    VALUES (Null,'{$fname}')";
                    mysqli_query($db,$query)or die ('Error in updating Database');
                break;
              }
            }
            ?>
              <script type="text/javascript">
                window.location = "customer.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>
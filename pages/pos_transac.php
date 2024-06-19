<?php
include'../includes/connection.php';
session_start();
              $totals = $_POST['subtotal'];         
              if ($totals === "Data not available") {
                // Cash is null or not numeric (a string), display an error message
                echo '<script type="text/javascript">
                          alert("ERROR.");
                          window.location = "pos.php";
                          </script>';
              } else{
              $date = $_POST['date'];
              $id = $_POST['id'];
              $customer = $_POST['customer'];
              $emp = $_POST['employee'];
              $rol = $_POST['role'];
              $cash = $_POST['cash'];  
              $siz = $_POST['size'];
              $stck = $_POST['stock'];
              $total = intval($_POST['total']);
              //imma make it trans uniq id
              $today = date("mdGis"); 
              
              $countID = count($_POST['name']);
              // echo "<table>";

              if ($cash < 0) {
                // Cash is negative, display an error message
                echo "<script type='text/javascript'>alert('ERROR : CASH AMOUNT CAN'T BE NEGATIVE'); window.location = 'pos.php';</script>";
              } elseif ($cash < $total) {
                // Cash is insufficient, display an error message
                echo "<script type='text/javascript'>alert('ERROR : CASH AMOUNT ARE INSUFFICIENT'); window.location = 'pos.php';</script>";
              } else{
              switch($_GET['action']){
                case 'add':
                for($i=1; $i<=$countID; $i++)
                  {
                      //echo "'".$_POST['stock'][$i-1]."', '{$today}','Size :', '".$_POST['code'][$i-1]."', '".$_POST['name'][$i-1]."', '".$_POST['size'][$i-1]."', 'QUANTITY OF DELETION :','".$_POST['quantity'][$i-1]."', '".$_POST['price'][$i-1]."', '{$emp}', '{$rol}' <br>";
                      if (isset($_POST['code'][$i-1])) {
                        $productCode = mysqli_real_escape_string($db, $_POST['code'][$i-1]);
                        $productSize = mysqli_real_escape_string($db, $_POST['cat'][$i-1]);
                        $productQuantity = mysqli_real_escape_string($db, $_POST['quantity'][$i-1]);

                        $sqldel = "DELETE FROM product WHERE PRODUCT_CODE ='".$productCode."' AND CATEGORY_ID ='".$productSize."' ORDER BY PRODUCT_ID DESC LIMIT ".$productQuantity.";";
                        mysqli_query($db,$sqldel)or die (mysqli_error($db));
                      } else {
                        //Handle the case where $_POST['id'][$i-1] is not set
                        echo "No product ID provided at index ".($i-1);
                      }
                      
                      $query = "INSERT INTO `transaction_details`
                                 (`ID`, `TRANS_D_ID`, `PRODUCTS`, `size` , `QTY`, `PRICE`, `EMPLOYEE`, `ROLE`)
                                 VALUES (Null, '{$today}', '".$_POST['name'][$i-1]."', '".$_POST['size'][$i-1]."', '".$_POST['quantity'][$i-1]."', '".$_POST['price'][$i-1]."', '{$emp}', '{$rol}')";

                      mysqli_query($db,$query)or die (mysqli_error($db));
                  }  
                      $query111 = "INSERT INTO `transaction`
                                (`TRANS_ID`, `CUST_ID`, `NUMOFITEMS`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_D_ID`)
                                VALUES (Null,'{$customer}','{$countID}','{$total}','{$cash}','{$date}','{$today}')";
                      mysqli_query($db,$query111)or die (mysqli_error($db));

                  break;
                } 
              }
                    echo '<script type="text/javascript">
                          alert("Successfully Purchased the Item.");
                          </script>';
                    
                          $sql = "SELECT TRANS_ID FROM Transaction order by TRANS_ID DESC LIMIT 1";
                                $sql1 = mysqli_query($db, $sql) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($sql1)) {
                             $transd = $row["TRANS_ID"];
                          }
                          
            }//
                      unset($_SESSION['pointofsale']);

                      echo '<script type="text/javascript">
                        window.location = "pos_printable.php?action=print&id='.$transd.'";
                        </script>';
               ?>
              <script type="text/javascript">
              //  alert("Success.");
              //  window.location = "pos.php";
              </script>
          </div>



























<?php
              // switch($_GET['action']){
              //   case 'add':     
              //       $query = "INSERT INTO transaction_details
              //                  (`ID`, `PRODUCTS`, `EMPLOYEE`, `ROLE`)
              //                  VALUES (Null, 'here', '{$emp}', '{$rol}')";
              //       mysqli_query($db,$query)or die ('Error in Database '.$query);
              //       $query2 = "INSERT INTO `transaction`
              //                  (`TRANS_ID`, `CUST_ID`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_D_ID`)
              //                  VALUES (Null,'{$customer}','{$subtotal}','{$lessvat}','{$netvat}','{$addvat}','{$total}','{$cash}','{$date}','{$today}'')";
              //       mysqli_query($db,$query2)or die ('Error in updating Database2 '.$query2);
              //   break;
              // }

              // mysqli_query($db,"INSERT INTO transaction_details
              //                 (`ID`, `PRODUCTS`, `EMPLOYEE`, `ROLE`)
              //                 VALUES (Null, 'a', '{$emp}', '{$rol}')");

              // mysqli_query($db,"INSERT INTO `transaction`
              //                 (`TRANS_ID`, `CUST_ID`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_DETAIL_ID`)
              //                 VALUES (Null,'{$customer}',{$subtotal},{$lessvat},{$netvat},{$addvat},{$total},{$cash},'{$date}',(SELECT MAX(ID) FROM transaction_details))");

              // header('location:posdetails.php');

            ?>
<!--  <script type="text/javascript">
      alert("Transaction successfully added.");
      window.location = "pos.php";
      </script> -->
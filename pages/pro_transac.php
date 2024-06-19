<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $pc = $_POST['prodcode'];
              $name = $_POST['name'];
              $desc = $_POST['description'];
              $qty = $_POST['quantity'];
              $pr = $_POST['price']; 
              $cat = $_POST['category'];
              $dats = $_POST['datestock'];
              $Fimage = $_FILES['Fimage']['name'];
              $Fimage_tmp = $_FILES['Fimage']['tmp_name'];
              $Ffolder = 'image/'.$Fimage;
              $Bimage = $_FILES['Bimage']['name'];
              $Bimage_tmp = $_FILES['Bimage']['tmp_name'];
              $Bfolder = 'image/'.$Bimage;

              move_uploaded_file($Fimage_tmp, $Ffolder); 
              move_uploaded_file($Bimage_tmp, $Bfolder); 
              
              


              switch($_GET['action']){
                case 'add':

                 $query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME,DESCRIPTION, COUNT(`QTY_STOCK`) AS "QTY_STOCK",PRICE, Fimage, Bimage, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE PRODUCT_CODE ='.$pc;
                 $result = mysqli_query($db, $query) or die(mysqli_error($db));
                 if($row = mysqli_fetch_array($result))
                 {
                  $prdc = $row["PRODUCT_CODE"];
                  $nms = $row["NAME"];
                  $Descrypt = $row["DESCRIPTION"];
                  $categ = $row["CNAME"];
                  $prce = $row["PRICE"];
                  $Fi = $row["Fimage"];
                  $Bi = $row["Bimage"];
                  if($pc == $prdc){
                    if($cat == $categ){
                      for($i=0; $i < $qty; $i++){
                        $query = "INSERT INTO product
                                  (PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, PRICE, CATEGORY_ID, DATE_STOCK_IN,stats, Fimage, Bimage)
                                  VALUES (Null,'{$pc}','{$nms}','{$Descrypt}',1,{$prce},{$cat},'{$dats}','Active','{$Fi}','{$Bi}')";
                        mysqli_query($db,$query)or die ('Error in updating product in Database '.$query);
                        }
                    }else{
                      for($i=0; $i < $qty; $i++){
                        $query = "INSERT INTO product
                                  (PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, PRICE, CATEGORY_ID, DATE_STOCK_IN,stats, Fimage, Bimage)
                                  VALUES (Null,'{$pc}','{$nms}','{$Descrypt}',1,{$prce},{$cat},'{$dats}','Active','{$Fi}','{$Bi}')";
                        mysqli_query($db,$query)or die ('Error in updating product in Database '.$query);
                        }
                    }
                    echo "<script type='text/javascript'>alert('You Updated the Stocks of Product Name :".$row["NAME"]."');window.location = 'product.php';</script>";          
                  }else{
                    for($i=0; $i < $qty; $i++){
                      $query = "INSERT INTO product
                                (PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, PRICE, CATEGORY_ID, DATE_STOCK_IN,stats, Fimage, Bimage)
                                VALUES (Null,'{$pc}','{$name}','{$desc}',1,{$pr},{$cat},'{$dats}','Active','{$Fimage}','{$Bimage}')";
                      mysqli_query($db,$query)or die ('Error in updating product in Database '.$query);
                      }
                    echo "<script type='text/javascript'>alert('New Product Created!! :".$row["NAME"]."'); window.location = 'product.php';</script>";
                  }
                 }else{
                 echo "<script type='text/javascript'>alert('IF THE PRODUCT DIDN'T MET OR ADD THE NEW PRODUCT'); window.location = 'product.php';</script>";
                 }
                break;
              } 
            ?>
              <script type="text/javascript">window.location = 'product.php';</script>
          </div>

<?php
include'../includes/footer.php';
?>
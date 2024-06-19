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
}
$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='category'>
        <option disabled selected>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['CATEGORY_ID']."'>".$row['CNAME']."</option>";
  }

$opt .= "</select>";

  $query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, PRICE, p.CATEGORY_ID, DATE_STOCK_IN, Fimage, Bimage, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE PRODUCT_ID ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz = $row['PRODUCT_ID'];
      $zzz = $row['PRODUCT_CODE'];
      $A = $row['NAME'];
      $desc = $row['DESCRIPTION'];
      $B = $row['QTY_STOCK'];
      $pr = $row['PRICE']; 
      $E = $row['CNAME'];
      $cat = $row['CATEGORY_ID'];
      $dats = $row['DATE_STOCK_IN'];
      $Fimage = $row['Fimage'];
      $Bimage = $row['Bimage'];
    }
      $id = $_GET['id'];
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Inventory for : <?php echo $A ?></h4>
            </div>
            <a type="button" class="btn btn-primary bg-gradient-primary" href="inv_searchfrm.php?action=edit & id='<?php echo $zzz; ?>'"><i class="fas fa-fw fa-flip-horizontal fa-share"></i> Back</a>
                
            <div class="card-body">

            <form role="form" method="post" action="inv_edit1.php?action=add" enctype="multipart/form-data">
              <input type="hidden" name="idd" value="<?php echo $zz; ?>" />
              <input type="hidden" name="descript" value="<?php echo $desc; ?>" />
              <input type="hidden" name="pricing" value="<?php echo $pr; ?>" />
              <input type="hidden" name="categorize" value="<?php echo $cat; ?>" />
              <input type="hidden" name="DateStock" value="<?php echo $dats; ?>" />
              <input type="hidden" name="Fimage" value="<?php echo $Fimage; ?>" />
              <input type="hidden" name="Bimage" value="<?php echo $Bimage; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Code:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="ProdCode" value="<?php echo $zzz; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="ProdName" value="<?php echo $A; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Quantity:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Quantity" name="qty" value="<?php echo $B; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Size:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" name="Category" value="<?php echo $E; ?>" readonly>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
            </div>
          </div></center>

<?php
include'../includes/footer.php';
?>
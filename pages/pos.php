<?php
include'../includes/connection.php';
include'../includes/topp.php';
// session_start();
$product_ids = array();
//session_destroy();

//check if Add to Cart button has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $quantity = $_POST['quantity'];
  $stock = $_POST['stock'];
  if (!is_numeric($quantity) || $quantity <= 0 || $quantity > $stock) {
    // Redirect back to the form page and display an error message
    echo "<script type='text/javascript'>alert('Invalid quantity');</script>";
} else {
    // Continue with your POST action
if(filter_input(INPUT_POST, 'addpos')){
    if(isset($_SESSION['pointofsale'])){
         $stock = $_POST['stock'];
         // Keep track of how many products are in the shopping cart
         $count = count($_SESSION['pointofsale']);
        
         // Create sequential array for matching array keys to product IDs
         $product_ids = array_column($_SESSION['pointofsale'], 'id');
         $requested_quantity = filter_input(INPUT_POST, 'quantity');
         $product_id = filter_input(INPUT_GET, 'id');
         $available_stock = $stock; // Replace with actual stock retrieval logic
 
         if (!in_array($product_id, $product_ids)) {
             // Product doesn't exist in the cart, add it
             $_SESSION['pointofsale'][$count] = array(
                 'id' => $product_id,
                 'code' => filter_input(INPUT_POST, 'code'),
                 'cat' => filter_input(INPUT_POST, 'cat'),
                 'name' => filter_input(INPUT_POST, 'name'),
                 'price' => filter_input(INPUT_POST, 'price'),
                 'quantity' => $requested_quantity,
                 'size' => filter_input(INPUT_POST, 'size'),
                 'stock' => filter_input(INPUT_POST, 'stock')
             );
         } else {
             // Product already exists, increase quantity if stock allows
             for ($i = 0; $i < count($product_ids); $i++) {
                 if ($product_ids[$i] == $product_id) {
                     // Check if requested quantity exceeds available stock
                     if ($requested_quantity + $_SESSION['pointofsale'][$i]['quantity'] > $available_stock) {
                         // Display an error message to the user
                         echo "<script type='text/javascript'>alert('Sorry, we do not have enough stock to fulfill your order.');</script>";
                         // You can also prevent the user from proceeding with the payment.
                     } else {
                         // Add item quantity to the existing product in the array
                         $_SESSION['pointofsale'][$i]['quantity'] += $requested_quantity;
                     }
                 }
             }
         }  
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['pointofsale'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'code' => filter_input(INPUT_POST, 'code'),
            'cat' => filter_input(INPUT_POST, 'cat'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity'),
            'size' => filter_input(INPUT_POST, 'size'),
            'stock' => filter_input(INPUT_POST, 'stock')           
        );
    }
}
}
}
if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['pointofsale'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['pointofsale'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['pointofsale'] = array_values($_SESSION['pointofsale']);
}

//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
                ?>
                <div class="row">
                <div class="col-lg-12">
                  <div class="card shadow mb-0">
                  <div class="card-header py-2">
                    <h4 class="m-1 text-lg text-primary">Product category</h4>
                  </div>
                        <!-- /.panel-heading -->
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                              <li class="nav-item">
                                <a class="nav-link" href="#" data-target="#XSmall" data-toggle="tab">XSmall</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Small" data-toggle="tab">Small</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Medium" data-toggle="tab">Medium</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Large" data-toggle="tab">Large</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#XLarge" data-toggle="tab">XLarge</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#XXLarge" data-toggle="tab">XXLarge</a>
                              </li>
<!-- TAB PANE AREA --->
<?php include 'postabpane.php'; ?>
<!-- END TAB PANE AREA --->

        <div style="clear:both"></div>  
        <br />  
        <div class="card shadow mb-4 col-md-12">
        <div class="card-header py-3 bg-white">
          <h4 class="m-2 font-weight-bold text-primary">Transaction</h4>
        </div>
        
      <div class="row">    
      <div class="card-body col-md-9">
        <div class="table-responsive">

        <!-- trial form lang   -->
<form role="form" method="post" action="pos_transac.php?action=add" onsubmit="return validateForm();">
  <input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
  <input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">
  
        <table class="table">    
        <tr>  
             <th width="40%">Product Name</th>
             <th width="15%">Size</th>
             <th width="10%">Quantity</th>  
             <th width="15%">Price</th>  
             <th width="15%">Total</th>  
             <th width="5%">Action</th>  
        </tr>  
        <?php  

        if(!empty($_SESSION['pointofsale'])):  
            
             $total = 0;  
        
             foreach($_SESSION['pointofsale'] as $key => $product): 
        ?>  
        <tr>
            <input type="hidden" name="id[]" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="cat[]" value="<?php echo $product['cat']; ?>">
            <input type="hidden" name="code[]" value="<?php echo $product['code']; ?>">
            <input type="hidden" name="stock[]" value="<?php echo $product['stock']; ?>">
          <td>
            <input type="hidden" name="name[]" value="<?php echo $product['name']; ?>">
            <?php echo $product['name']; ?>
          </td>  

          <td>
            <input type="hidden" name="size[]" value="<?php echo $product['size']; ?>">
            <?php echo $product['size']; ?>
          </td> 

           <td>
            <input type="hidden" name="quantity[]" value="<?php echo $product['quantity']; ?>">
            <?php echo $product['quantity']; ?>
          </td>  

           <td>
            <input type="hidden" name="price[]" value="<?php echo $product['price']; ?>">
            ₱ <?php echo number_format($product['price']); ?>
          </td>  

           <td>
            <input type="hidden" name="total" value="<?php echo $product['quantity'] * $product['price']; ?>">
            ₱ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
           <td>
               <a href="pos.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn bg-gradient-danger btn-danger"><i class="fas fa-fw fa-trash"></i></div>
               </a>
           </td>  
        </tr>
        <?php  
                  $total = intval($total) + ($product['quantity'] * $product['price']);
             endforeach;  
        ?>


        <?php  
        endif;
        ?>  
        </table> 
         </div>
       </div> 

<?php
include 'posside.php';
include'../includes/footer.php';
?>
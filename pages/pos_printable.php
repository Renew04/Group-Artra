<?php
include'../includes/connection.php';
session_start();
if($_GET['action']=="print"){
$query = "SELECT *, FIRST_NAME, EMPLOYEE, (CASH - GRANDTOTAL) as total, ROLE
              FROM transaction T
              JOIN customer C ON T.`CUST_ID`=C.`CUST_ID`
              JOIN transaction_details tt ON tt.`TRANS_D_ID`=T.`TRANS_D_ID`
              WHERE TRANS_ID ='".$_GET['id']."'";
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result)) {
          $fname = $row['FIRST_NAME'];
          $date = $row['DATE'];
          $tid = $row['TRANS_D_ID'];
          $cash = intval($row['CASH']);
          $grand = intval($row['GRANDTOTAL']);
          $change = $row['total'];
          $emp = $row['EMPLOYEE'];
          $roles = $row['ROLE'];
          $numitem = $row['NUMOFITEMS'];
        }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Artra Printable</title>
        <style>
        * {
    font-size: 12px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 75px;
    max-width: 75px;
    height: 30px;
    word-break: break-all;
}

td.quantity,
th.quantity {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.price,
th.price {
    width: 45px;
    max-width: 45px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 155px;
    max-width: 155px;
}

img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
        </style>
    </head>
    <body>
        <div class="ticket">
            <img src="image/ArtraLogo.jpg" alt="Logo">
            <p class="centered">Artra Clothing Line<br>
                <br>Pampano blk13 Teacher Village pla-pla 
                <br>(Navotas City)</p>
                <p class="centered">Transaction Number
                <br><?php echo $tid; ?></p>
                <p class="centered">Date :<?php echo $date; ?>
                    <br>Cashier Name: <?php echo $emp; ?> </p>        
            <table>
                <thead>
                    <tr>
                        <th class="description">PRODUCT</th>
                        <th class="quantity">QTY/ PRICE</th>
                        <th class="price">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql1 = "SELECT *,(QTY * PRICE) As total FROM Transaction_details WHERE TRANS_D_ID=".$tid;
        $result1 = mysqli_query($db, $sql1) or die (mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result1)) {
                      echo "<tr>";
                      echo '<td class="description">'.$row["PRODUCTS"].'<br>('.$row["size"].')</td>';
                      echo '<td class="quantity">x'.$row["QTY"].'/<br>₱'.$row["PRICE"].'</td>';
                      echo '<td class="price">₱'.$row["total"].'</td>';
                      echo "</tr>";
        }
                ?>
                    <tr>
                        <td class="description"></td>
                        <td class="quantity">Total</td>
                        <td class="price">₱<?php echo $grand; ?></td>
                    </tr>
                </tbody>
            </table>
            
            <p class="centered">Total Items :<?php echo $numitem; ?>
                <br> Tendered Amount :₱<?php echo $cash; ?>
                <br> Change :₱<?php echo $change; ?>
            </p>
            <p class="centered">Thanks for your purchase!
                <br>No Refund Policy!
                <hr>
                <br>Copyright © BitBard POS and Inventory System 2024</p>
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        <a href="pos.php"><button id="btnPrint" class="hidden-print">Back</button></a>
    </body>
</html>
        <script>
            const $btnPrint = document.querySelector("#btnPrint");
            $btnPrint.addEventListener("click", () => {
                window.print();
            });
        </script>

<?php
 //connection to the server = Driver={MySQL ODBC 8.0 UNICODE Driver};Server=MYSQL8010.site4now.net;Database=db_aa8833_artra;Uid=aa8833_artra;Password=123456789artra"
 
 //$servername = "MYSQL8010.site4now.net";
 //$username = "aa8833_artra";
 //$password = "123456789artra";
 //$dbname = "db_aa8833_artra";
 
 $db = mysqli_connect('localhost', 'root', '', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'artra') or die(mysqli_error($db));
?>

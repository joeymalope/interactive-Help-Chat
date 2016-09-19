<?php
$conn=mysqli_connect("localhost","root","","ssdb");
//session_start();
$_SESSION["conn"]=$conn;
/*$createTbl="CREATE TABLE IF NOT EXISTS `PendingQueries` (
`query_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `query` varchar(800) NOT NULL,
)";

if(mysqli_query($conn,$createTbl)){
    
}
else "Error " .mysqli_error($conn);
*/    
    
?>
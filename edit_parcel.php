<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM parcels where id = ".$_GET['id'])->fetch_array();
//$qry="SELECT id  FROM parcels ORDER BY `id`.`reference_number DESC";

foreach($qry as $k => $v){
	$$k = $v;
}
include 'new_parcel.php';
?>
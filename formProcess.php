<?php
$reference_number = uniqid();

// Print the unique number
//echo $uniqueNumber;



if (isset($_POST['submit'])) {
    // get the user input
    //$input = $_POST['input'];
    //$id=$_POST['id'];
    $sender_name = $_POST['sender_name'];
	$sender_address = $_POST['sender_address'];
    $sender_contact = $_POST['sender_contact'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_address = $_POST['recipient_address'];
    $recipient_contact = $_POST['recipient_contact'];
    //$type = $_POST['type'];   //already added 1 
	//$from_branch_id = $_POST['from_branch_id'];
	//$to_branch_id = $_POST['to_branch_id'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $width = $_POST['width'];
    $length=$_POST['length'];
    //$price = $_POST['price']; //no need because this is only a tracking system REMOVED
    //$status = $_POST['status'];// default status is one
   // $date_created = $_POST['date_created']; 
    //$reference_number=$_POST['reference_number'];
    // connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'cms_db');

    // create a query to insert the input into the table
   $query = "INSERT INTO parcels ( `reference_number`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`,
   `recipient_address`, `recipient_contact`, `type`, `from_branch_id`, `to_branch_id`, `weight`, `height`, `width`, `length`, 
`price`, `status`)VALUES('$reference_number','$sender_name','$sender_address','$sender_contact','$recipient_name','$recipient_address',
     '$recipient_contact','1', '10500', '10500', '$weight', '$height', '$width', '$length','10','1')";
/*
$query = "INSERT INTO parcels (`reference_number`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`, 
`recipient_address`, `recipient_contact`, `type`, `from_branch_id`, `to_branch_id`, `weight`, `height`, `width`, `length`, 
`price`, `status`) VALUES ( '101', 'testoen', 'test add', '34214', 'test name', 'sdgfsd', 'sfsd', '1', '10500', '10500',
 '1', '1', '1', '1', '12', '1')";   
*/
// execute the query 
    $result = mysqli_query($db, $query);

    // check if the query was successful
   
    if ($result) {
      header('Location:form.php');
      
    } else {
        echo "An error occurred while adding the input to the database.";
    }}


?>

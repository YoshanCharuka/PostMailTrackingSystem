<?php

// check if the form has been submitted
if (isset($_POST['submit'])) {
    // get the user input
    //$input = $_POST['input'];
    $id=$_POST['id'];
    $sender_name = $_POST['sender_name'];
	$sender_address = $_POST['sender_address'];
    $sender_contact = $_POST['sender_contact'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_address = $_POST['recipient_address'];
    $recipient_contact = $_POST['recipient_contact'];
    $type = $_POST['type'];    
	$from_branch_id = $_POST['from_branch_id'];
	$to_branch_id = $_POST['to_branch_id'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $width = $_POST['width'];
    $length=$_POST['length'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $date_created = $_POST['date_created'];
    $reference_number=$_POST['reference_number'];
    // connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'cms_db');

    // create a query to insert the input into the table
    $query = "INSERT INTO parcels (`id`, `reference_number`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`, 
    `recipient_address`, `recipient_contact`, `type`, `from_branch_id`, `to_branch_id`, `weight`, `height`, `width`, `length`, `price`
    , `status`, `date_created`)VALUES('$id','$reference_number','$sender_name','$sender_address','$sender_contact','$recipient_name',
    '$recipient_address','$recipient_contact','$type', '$from_branch_id', '$to_branch_id', '$weight', '$height', '$width', '$length',
     '$price', '$status', '$date_created')";

    // execute the query 
    $result = mysqli_query($db, $query);

    // check if the query was successful
    if ($result) {
        echo "The input was added to the database successfully.";
    } else {
        echo "An error occurred while adding the input to the database.";
    }
}

?>

<!-- create the user input form -->
<div class="col-lg-12">
	<div class="card card-outline card-danger">
		<div class="card-body">
<form method="post" action="">
<div id="msg" class=""></div>
    <div class="row">
        <div class="col-md-6">
              <b>Sender Information</b>
                <div class="form-group">
            <label for="sender_name">sender name</label><br>
            <input type="text" id="input" name="sender_name" class="form-label"><br><br>
                </div>
                <div class="mb-3">
            <label for="sender_address">sender address</label><br>
            <input type="text" id="input" name="sender_address"><br><br>
                </div>
            <div class="form-group">
            <label for="sender_contact">sender contact</label><br>
            <input type="text" id="input" name="sender_contact"><br><br>
        </div>
        </div>
    
        <div class="col-md-6">
              <b>Recipient Information</b>
              <div class="form-group">
            <label for="recipient_name">recipient_name</label><br>
            <input type="text" id="input" name="recipient_name"><br><br>

            <label for="recipient_address">recipient_address</label><br>
            <input type="text" id="input" name="recipient_address"><br><br>

            <label for="recipient_contact">recipient_contact</label><br>
            <input type="text" id="input" name="recipient_contact"><br><br>
        </div>
    </div>
</div>    
  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
  <label for="dtype">Type</label>
              <input type="checkbox" name="type" id="dtype" <?php echo isset($type) && $type == 1 ? 'checked' : '' ?> data-bootstrap-switch data-toggle="toggle" data-on="Deliver" data-off="Pickup" class="switch-toggle status_chk" data-size="xs" data-offstyle="info" data-width="5rem" value="1">
              <small>Deliver = Deliver to Recipient Address</small>
              <small>, Pickup = Pickup to nearest Branch</small><br><br>
 </div>
    </div>
    <div class="form-group" id="tbi-field">
        <label for="from_branch_id">from_branch_id</label><br>
        <input type="text" id="input" name="from_branch_id"><br><br>

        <label for="to_branch_id">to_branch_id</label><br>
        <input type="text" id="input" name="to_branch_id"><br><br>
    </div>
            </div>
           
              
            <div class="form-group" id="tbi-field">
              <label for="" class="control-label">Pickup Branch</label>
              <select name="to_branch_id" id="to_branch_id" class="form-control select2">
                <option value="fgdsfgs">rgtdfghydf</option>
                <?php 
                  $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                    while($row = $branches->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($to_branch_id) && $to_branch_id == $row['id'] ? "selected":'' ?>><?php echo $row['branch_code']. ' | '.(ucwords($row['address'])) ?></option>
                <?php endwhile; ?>
              </select>

</div>

        <hr>
       

<b>Parcel Information</b><br>

    <label for="weight">weight</label><br>
    <input type="text" id="input" name="weight"><br><br>

    <label for="height">height</label><br>
    <input type="text" id="input" name="height"><br><br>

    <label for="length">length</label><br>
    <input type="text" id="input" name="length"><br><br>

    <label for="width">width</label><br>
    <input type="text" id="input" name="width"><br><br>

    <label for="price">price</label><br>
    <input type="text" id="input" name="price"><br><br>
    
    <label for="id">id</label><br>
    <input type="text" id="input" name="id"><br><br>

    <label for="status">status</label><br>
    <input type="text" id="input" name="status"><br><br>

    <label for="date_created">date_created</label><br>
    <input type="date" id="input" name="date_created"><br><br>

    <label for="reference_number">reference_number</label><br>
    <input type="text" id="input" name="reference_number"><br><br>

    

    <input type="submit" name="submit" value="Submit">
</form>

</div>

</div>

</div>

<script>
  $('#dtype').change(function(){
      if($(this).prop('checked') == true){
        $('#tbi-field').hide()
      }else{
        $('#tbi-field').show()
      }
  })
    $('[name="price[]"]').keyup(function(){
      calc()
    })
  $('#new_parcel').click(function(){
    var tr = $('#ptr_clone tr').clone()
    $('#parcel-items tbody').append(tr)
    $('[name="price[]"]').keyup(function(){
      calc()
    })
    $('.number').on('input keyup keypress',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9]/, '');
        val = val.replace(/,/g, '');
        val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
        $(this).val(val)
    })

  })
	$('#manage-parcel').submit(function(e){
		e.preventDefault()
		start_load()
    if($('#parcel-items tbody tr').length <= 0){
      alert_toast("Please add atleast 1 parcel information.","error")
      end_load()
      return false;
    }
		$.ajax({
			url:'ajax.php?action=save_parcel',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
			 if(resp){
             resp = JSON.parse(resp)
             if(resp.status == 1){
               alert_toast('Data successfully saved',"success");
               end_load()
               var nw = window.open('print_pdets.php?ids='+resp.ids,"_blank","height=700,width=900")
             }
			 }
        if(resp == 1){
            alert_toast('Data successfully saved',"success");
            setTimeout(function(){
              location.href = 'index.php?page=parcel_list';
            },2000)

        }
			}
		})
	})
  function displayImgCover(input,_this) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#cover').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
  function calc(){

        var total = 0 ;
         $('#parcel-items [name="price[]"]').each(function(){
          var p = $(this).val();
              p =  p.replace(/,/g,'')
              p = p > 0 ? p : 0;
            total = parseFloat(p) + parseFloat(total)
         })
         if($('#tAmount').length > 0)
         $('#tAmount').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
  }
</script>



<?php include 'testh.php' ?>
<?php include 'footer.php' ?>
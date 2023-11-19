

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/form.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>Document</title>
</head>
<body>
  <script src="form.js"></script>
  <div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>New Parcel</h3>
            
            <div class="card">
                <h5 class="text-center mb-4">Add Parcel</h5>
                <form class="form-card"  method="post" action="formProcess.php">
                    <div class="row justify-content-between text-left">
                   <!-- <input type="hidden" name="id" value="<?php /* echo isset($id) ? $id : '' */?>>-->
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3" for="sender_name">Sender Name<span class="text-danger"> *</span>
                    </label><input type="text" id="Yourname" name="sender_name" placeholder="Your name"  required placeholder="Email" onblur="validate(1)"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Reciver Name<span class="text-danger"> *</span>
                    </label><input type="text" id="Recivername" name="recipient_name" placeholder="Reciver name" onblur="validate(2)" required placeholder="Email" > </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Sender Address<span class="text-danger"> *</span>
                    </label> <input type="text" id="YourAddress" name="sender_address" required placeholder="Sender Address" placeholder="Your Address" onblur="validate(3)"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Reciver Address<span class="text-danger"> *</span>
                    </label> <input type="text" id="ReciverAddress" name="recipient_address" required placeholder="Reciver Address"   placeholder="Reciver Address" onblur="validate(4)"> </div>
                    </div>
                    <div class="row justify-content-between text-left">
                      <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Contact number<span class="text-danger"> *</span>
                    </label> <input type="text" id="YourContactNumber" required placeholder="Contact number" name="sender_contact" placeholder="Your Contact Number" onblur="validate(5)"> </div>
                      <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Contact number<span class="text-danger"> *</span>
                    </label> <input type="text" id="ReciverContactNumber" required placeholder="Contact number" name="recipient_contact" placeholder="Reciver Contact Number" onblur="validate(6)"> </div>
                  </div>
                
                  
                  <hr> <!-- 
                 <p><strong>Type</strong></p> 
                  <label class="switch" >
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                    <div class="btn1">
                      <button onclick="myFunction()">pick up</button>
                    </div>
                    <div class="tag">
                         <p>Deliver=Deliver to reciption address/pickup=Pickup to nearest</p>
                    </div>
                  <br>
                  <br>
                 
                 
                    <div class="branch">
                        <label for="branch">Branch Processed:</label>
                        <select id="branch" name="Branch Processed" >
                            <option value = "0" selected>Avenra Avenue, Colombo 10</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div> 
                    <div class="pickup" >
                        <label for="branch" >Pickup Branch:</label>
                        <select id="pickup" name="Pickup Branch">
                            <option value = "0" selected>Avenra Avenue, Colombo 10</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>  -->
                    <!--branches selection-->

                    <?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="type">Type</label>
              <input type="checkbox" name="type" id="dtype" <?php echo isset($type) && $type == 1 ? 'checked' : '' ?>
               data-bootstrap-switch data-toggle="toggle" data-on="Deliver" data-off="Pickup" class="switch-toggle status_chk"
                data-size="xs" data-offstyle="info" data-width="5rem" value="1">
              <small>Deliver = Deliver to Recipient Address</small>
              <small>, Pickup = Pickup to nearest Branch</small>
            </div>
          </div>
          <div class="col-md-6" id=""  <?php echo isset($type) && $type == 1 ? 'style="display: none"' : '' ?>>
            <?php/* if($_SESSION['login_branch_id'] <= 0): */?>
              <div class="form-group" id="fbi-field">
                <label for="" class="control-label">Branch Processed</label>
              <select name="from_branch_id" id="from_branch_id" class="form-control select2">
                <option value=""></option>
                <?php 
                  $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                    while($row = $branches->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($from_branch_id) && $from_branch_id == $row['id'] ? "selected":'' ?>>
                  <?php echo $row['branch_code']. 
                  ' | '.(ucwords($row['address'])) ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <?php /*else:*/ ?>
              <input type="hidden" name="from_branch_id" value="testbranch">
            <?php /*endif;*/ ?>  
            <div class="form-group" id="tbi-field">
              <label for="" class="control-label">Pickup Branch</label>
              <select name="to_branch_id" id="to_branch_id" class="form-control select2">
                <option value=""></option>
                <?php 
                  $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                    while($row = $branches->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($to_branch_id) && $to_branch_id == $row['id'] ? "selected":'' ?>>
                  <?php echo $row['branch_code']. ' | '.(ucwords($row['address'])) ?></option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>
        </div> 

        <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php 
  date_default_timezone_set("Asia/Manila");
  
  ob_start();
  $title = isset($_GET['page']) ? ucwords(str_replace("_", ' ', $_GET['page'])) : "Home";
  $title = str_replace("Persons Companies","Persons/Companies",$title);
  ?>

  <!-- Google Font: Source Sans Pro -->
 
	<script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
  
</head>

        <script>
  $('#dtype').change(function(){
      if($(this).prop('checked') == true){
        $('#tbi-field').hide()
      }else{
        $('#tbi-field').show()
      }
  })
</script>

                    
                  <br> <br> <br>
                  <h5>Parcel Information</h5>
                    <hr>
                        <table width="70%">
                            <tr>
                            <th>width</th>
                            <th>Hight</th>
                            <th>Length</th>
                            <th>width</th>
                            
                            </tr>
                            <tr>
                            <td><input type="text" name="weight" required placeholder="weight"></td>
                            <td><input type="text" name="height" required placeholder="height" ></td>
                            <td><input type="text" name="width" required placeholder="width"></td>
                            <th><input type="text" name="length" required placeholder="length"></th>

                            </tr>
                        
                    
                        </table>
                    <hr>
                   
                    
                    <button  type="submit" name="submit" value="Submit">Save</button>
                    <button type="cancel" value="Cancel">Cancel</button>
                    

                    
                </form>
            </div>
        </div>
    </div>
</div>
</body>


<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<!--<div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="dtype">Type</label>
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
  <meta name="viewport" content="width=device-width, initial-scale=1">-->
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
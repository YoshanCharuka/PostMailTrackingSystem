<?php include 'db_connect.php' ?>

  <?php include 'testh.php' ?>
  <?php include 'footer.php' ?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page with Background Image Example</title>
  <link rel="stylesheet" href="./style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
 
</head>

</head>
<body>

<div id="bg"></div>

<form>

  <div class="form-field">
    <button class="btn" type="submit">Log in</button> 
  </div>

</form>


<div class="container">
  <img src="img/200.png" alt="logo" >
  <div class="topleft">LK POST</div>
  
  
  
  
</div>
<div class="header">Sri Lanka Post- Track & Trace</div>

<div class="searchBox">

  <input class="searchInput" type="search" id="ref_no" placeholder="Enter Tracking Number...">
  <button type="button" id="track-btn" class="btn btn-sm btn-danger btn-gradient-danger">
                            <i class="fa fa-search"></i>
                        </button>
</div>
<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="timeline" id="parcel_history">
				
			</div>
		</div>
	</div>
<div id="clone_timeline-item" class="d-none">
	<div class="iitem">
	    <i class="fas fa-box bg-blue"></i>
	    <div class="timeline-item">
	      <span class="time"><i class="fas fa-clock"></i> <span class="dtime">12:05</span></span>
	      <div class="timeline-body">
	      	asdasd
	      </div>
	    </div>
	  </div>
</div>


 
<!-- partial -->
<script>
	function track_now(){
		start_load()
		var tracking_num = $('#ref_no').val()
		if(tracking_num == ''){
			$('#parcel_history').html('')
			end_load()
		}else{
			$.ajax({
				url:'ajax.php?action=get_parcel_heistory',
				method:'POST',
				data:{ref_no:tracking_num},
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error')
					end_load()
				},
				success:function(resp){
					if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
						resp = JSON.parse(resp)
						if(Object.keys(resp).length > 0){
							$('#parcel_history').html('')
							Object.keys(resp).map(function(k){
								var tl = $('#clone_timeline-item .iitem').clone()
								tl.find('.dtime').text(resp[k].date_created)
								tl.find('.timeline-body').text(resp[k].status)
								$('#parcel_history').append(tl)
							})
						}
					}else if(resp == 2){
						alert_toast('Unkown Tracking Number.',"error")
					}
				}
				,complete:function(){
					end_load()
				}
			})
		}
	}
	$('#track-btn').click(function(){
		track_now()
	})
	$('#ref_no').on('search',function(){
		track_now()
	})
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
   if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
   }
  ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=parcel_list");

?>
<?php include 'header.php' ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style/log.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script type="text/javascript" src="log.js"></script>
    
</head>
<body>
    <div class="parent clearfix">
        <div class="bg-illustration">
          <img src="./img/313.jpg" alt="logo">
    
          
    
        </div>
        
        <div class="login">
          <div class="container">
          <?php /*echo $_SESSION['system']['name']*/ ?> </b></a>  
          <h1>Login</h1>
        
            <div class="login-form">
            <form action="" id="login-form">
              <input type="email" class="form-control" name="email" required placeholder="Email">
              <input type="password" class="form-control" name="password" required placeholder="Password">
    
                <div class="remember-form">
                <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
                </div>
                <div class="forget-pass">
                  <a href="#">Forgot Password ?</a>
                </div>
                <button type="submit" class="btn btn-danger btn-block">Sign In</button>

              
                <div class="one-form">
                  <a href="form.php" target="_blank">One Time Order </a>
                </div>
                
    
              </form>
            </div>
        
          </div>
          </div>
      </div>
      <script> 
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=parcel_list';
        }else{
          //location.href ='index.php?page=home';
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          end_load();
        }
      }
    })
  })
  })
</script>
<?php include 'footer.php' ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
?>
<?php include 'header.php' ?>
<head>
 <style>
    body {
      background: rgb(2, 0, 36); 
      
 background: linear-gradient(180deg, rgba(2, 0, 30, 1) 0%, rgba(9, 9, 121, 1) 10%, rgba(0, 212, 255, 1) 100%); 

    }
    .login-box {
     /* Adjust the margin to center the login box vertically */
      width: 400px;
      height:300px; /* Adjust the width of the login box */
      padding: 20px;
      align-items: start;
      max-width: ;
     
   /* Add padding to the login box */
    }

    .login-card-body {
    height:40vh;
    
    background-size:100%;
    background-repeat:no-repeat;
    
    background-position:center;
        
         
    }
    .login-box{
      /* background-color:red; */
      width:700px;
    }
    .input-group{
      margin: 20px auto;
    }
    input[type='email'],input[type='password']{
      background-color:lightblue;
      height:5vh;
      width:100%;
    }
    .login-logo > .text-white,a{
      font-weight:900;

    }
    button{
      position: absolute;
      left:200px;
    }
    
  </style>
  
  
</head>
<body class="hold-transition login-page bg-cyan">
  <h1><b><?php echo $_SESSION['system']['name'] ?></b></h1>
<div class="login-box">
  <div class="login-logo">
    <a href="#" class="text-white">LOGIN</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
  
    <div class="login-card-body">
    
      <form action="" id="login-form">
    
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group mb-3">
          <label for="">Login As</label>
          <select name="login" id="" class="custom-select custom-select-sm">
            <option value="0">Employee</option>
            <option value="1">Evaluator</option>
            <option value="2">Admin</option>
          </select>
        </div>
        
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
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
          location.href ='index.php?page=home';
        }else{
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

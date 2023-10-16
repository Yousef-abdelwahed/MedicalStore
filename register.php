<?php

include 'config.php';

if(isset($_POST['upload'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$pass'") ;

   

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES('$name', '$email', '$pass')") ;
      $message[] = 'registered successfully!';
   }

$secs=(mysqli_real_escape_string($conn, md5($_POST['password']))==mysqli_real_escape_string($conn, md5($_POST['cpassword'])));
if ($pass) {
   echo '<script>
           Swal.fire({
               title: "تم تسجيل الدخول بنجاح!",
               html: "<b>مرحبًا بك.</b><br><a href=\'dashboard.php\'>انتقل إلى لوحة التحكم</a>",
               icon: "success",
               confirmButtonText: "موافق"
           });
       </script>';
}

   header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="./style/formStyle.css">

</head>
<body >

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>




<center>

<section class="login-section">
   <h1 class="my-5">Create New Customer Account</h1>
 <div class="box signUp">
      <div class="signUp-box">
      <div class="form signUpForm">
         <form action=""  method="post">
            <h3 class="mb-4">Sign up</h3>
            <div class="form-floating mb-3">
                   <input  class="input form-control" type="text" placeholder  name="name" required>
                   <label for="floatingInput"name="email">Name </label>
               </div>
               <div class="form-floating mb-3">
                   <input type="email"name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                   <label for="floatingInput"name="email">Email </label>
               </div>
               <div class="form-floating mb-3">
                   <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                   <label for="floatingPassword" >Password</label>
               </div>
               <div class="form-floating">
                   <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                   <label for="floatingPassword" >Confirm</label>
               </div>
               <button type="submit" onclick="checkPasswords()" name="upload" value="Sign up" id="myButton" class="sub btn btn-outline-primary my-4 w-100"><a href="./login.php">Create new Account</a> </button>

               </form>
            </div>
                      </div>
   </div>
 </div>


   <div >
      
      <!-- <form class="form" action="" method="post">
          <p class="title">Sign up </p>
          <p class="message">Please Enter Your Information </p>
              <label>
                  <input class="input" type="text" placeholder required name="name">
                  <span>username</span>
              </label>
         
          <label>
              <input class="input" type="email" placeholder required name="email">
              <span>Email</span>
          </label> 
              
          <label>
              <input class="input" type="password" id="pas1" required name="password">
              <span>Password</span>
          </label>
          <label>
              <input class="input" type="password" id="pas2" required name="cpassword">
              <span>Confirm password</span>
          </label>
         <input type="submit" class="sub" onclick="checkPasswords()" name="upload" value="Sign up" id="myButton">
      
         <button class="submit" onclick="checkPasswords();" name="submit">Submit</button> -->
          <!-- <p class="signin">Already have an acount ? <a href="login.php">Sign in</a> </p> -->
      <!-- </form> -->
   <!-- </div> -->
</center>
<script src="reg-script.js"></script>
</body>
</html>

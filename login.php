<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>


   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="./style/formStyle.css">

</head>
<body>









<center>

 <section class="login-section">
   <h1 class="my-5">Customer Login</h1>
 <div class="container">

 <div class="box signInText ">
      <p class="" >New Customers</p>
      <p class="text-muted lh-sm fs-6">Creating an account has many benefits: check out faster, keep more than one address, track orders and more.
</p>
<div class="d-grid gap-2">
  <button class="btn btn-primary fw-bold" type="button"><a class="text-de" href="./register.php">Create an Account</a> 
  </button>
</div>
 </div>

 <div class="box signIn">
      <div class="formBox">
      <div class="form sigInForm">
         <form action=""  method="post">
            <h3 class="mb-2">Sign In</h3>

               <div class="form-floating mb-3">
                   <input type="email"name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                   <label for="floatingInput"name="email">Email </label>
               </div>
               <div class="form-floating">
                   <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                   <label for="floatingPassword" >Password</label>
               </div>
               <button 
               type="submit"
               value="Log in"name="submit" class="submit btn btn-outline-primary my-4 w-100"
               >login</button>
               <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message alert alert-danger" role="alert" onclick="this.remove();">
      '.$message.'
    </div>
     ';

   }
}
?>   
               </form>
               

            </div>
          </div>
   </div>
   
 </div>
   <!-- <div class="formBox">
      <div class="form sigInForm">
         <form action="">
            <h3 class="mb-2">Sign In</h3>

               <div class="form-floating mb-3">
                   <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                   <label for="floatingInput">Email </label>
               </div>
               <div class="form-floating">
                   <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                   <label for="floatingPassword">Password</label>
               </div>
               <button type="submit" class="btn btn-outline-primary my-4 w-100">login</button>

               </form>
            </div>
                      </div>
   </div> -->
 

</div>
 </section>
   
<!-- 
 <div class="div1">
    <span class="input-span">
    <label for="email" class="label">Email</label>
    <input type="email" name="email"required placeholder="Enter your email"></span>
    <span class="input-span">
    <label for="password" class="label">Password</label>
    <input type="password" name="password" required placeholder="Enter your password"></span>
    <input class="submit" type="submit" value="Log in" name="submit">
    <span class="span">Don't have an account? <a href="register.php">Sign up</a></span> -->


</center>
<!-- <button id="myButton">إظهار SweetAlert</button> -->

<script>
   if(message){
      document.getElementById("myButton").add(function() {
    Swal.fire({
        title: 'رسالة SweetAlert',
        text: 'هذه رسالة SweetAlert مخصصة.',
        icon: 'success', // يمكنك استبداله بـ 'error' أو 'warning' أو أي أيقونة أخرى تفضلها
        confirmButtonText: 'موافق'
    });
});
   }

</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
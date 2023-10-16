<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'المنتج أضيف بالفعل إلى عربة التسوق!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'المنتج يضاف الى عربة التسوق!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'تم تحديث كمية سلة التسوق بنجاح!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>عربة التسوق</title>
<link rel="stylesheet " href="./style/mainStyle.css">
<!-- custom css file link  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet " href="./style/storeStyle.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet " href="./style/footerStyle.css">
<link rel="stylesheet " href="./style/storeStyle.css">
<link rel="stylesheet " href="./style/navStyle.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
   <header class="">
    <div class="app-img">
       <img class="w-100" src="./img/headerImage.jpg" alt="">
    </div>  
      <div class="me-auto">
      <ul class="navbar-nav container-flued ">
         
         <!-- *********** -->
         <?php
             $select_user = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_user) > 0){
             $fetch_user = mysqli_fetch_assoc($select_user);
      };
                ?>
                        <li class="nav-item mx-4 dropdown ms-auto">
          <a class="btn btn-outline-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

          <button class="button-cover" role="button"><span class="text">Hey!</span><span> <?php echo $fetch_user['name']; ?></span></button>
         

          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">User Profile</a></li>
            <li><a class="dropdown-item" href="#">setting</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('هل أنت متأكد أنك تريد تسجيل الخروج؟');" class="delete-btn">logout</a></a></li>

          </ul>
        </li>

                     </ul>
      </div>
       <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div class="nav-logo mx-5 "><a class="navbar-brand" href="#"><img src="./img/pharmacyLogo.png" class="w-100 "></a></div>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      
      <ul class="navbar-nav m-auto">
      <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#n_bar" aria-controls="navbarNavAltMarkup" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        <li class="nav-item dropdown mx-4">
          <a class="btn btn-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Shope By Departments
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#">Medical Equipments</a></li>
            <li><a class="dropdown-item" href="#">Ultrasound</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#"class="">Brands</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">About us</a>
        </li>
      </ul>
      
                </div>
              </div>
            </nav>
   </header>
   <section class="store-section my-3 w-75 m-auto">
      <div class="container-fluid m-auto">
         <div class="item active">
            <div class="row">
                  <!-- cards -->
                  <?php
                  $cars = array("product1", "product2", "product3");

                     for ($x = 0; $x <= 2; $x++) {
                       echo '<div class="col-md-3">
                       <div class="thumb-wrapper">
                          
                          <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                          <div class="img-box">
                             <img  src="./img/'.$cars[$x].'.jpg" class="zoom w-100" alt="">	
                             <span><img  src="./img/bg-img1.jpg" class="second-img" alt="">
                             </span>	
                          </div>
                          <div class="thumb-content">
                             <h4 class="product-title">Apple iPad</h4>									
                             <div class="star-rating">
                                <ul class="list-inline">
                                   <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                   <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                   <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                   <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                   <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                </ul>
                             </div>
                             <p class="item-price"><strike>$400.00</strike> <b>$369.00</b></p>
                             <a href="#" class="btn btn-primary">Add to Cart</a>
                          </div>						
                       </div>
                    </div>';
                     }
                     ?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
                        
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="./img/product1.jpg" class="img-responsive w-100" alt="">									
								</div>
								<div class="thumb-content">
									<h4 class="product-title">Apple iPad</h4>									
									<div class="star-rating">
										<ul class="list-inline">
											<span class="list-inline-item"><i class="fa fa-star"></i></span>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
									<p class="item-price"><strike>$400.00</strike> <b>$369.00</b></p>
									<a href="#" class="btn btn-primary">Add to Cart</a>
								</div>						
							</div>
						</div>
						
					</div>
				</div>
         </div>
   </section>


   <!-- Footer -->
<footer class="w-75 mt-5   m-auto d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">&copy;<?php
         $year = date("Y");
         echo $year;
         ?> Pharmacy</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="#" class="nav-link px-2 ">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 ">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 ">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 ">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 ">About</a></li>
    </ul>
  </footer>

   <!-- ************************************ -->
<!-- <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

<div class="container">



<div class="products">

   <h1 class="heading">أحدث المنتجات</h1>

   <div class="box-container">

   <?php
   include('config.php');
   $result = mysqli_query($conn, "SELECT * FROM products");      
   while($row = mysqli_fetch_array($result)){
   ?>
      <form method="post" class="box" action="">
         <img src="admin/<?php echo $row['image']; ?>"  width="200">
         <div class="name"><?php echo $row['name']; ?></div>
         <div class="price"><?php echo $row['price']; ?></div>
         <input type="number" min="1" name="product_quantity" value="1">
         <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
   <?php
      };
   ?>

   </div>

</div>

<div class="shopping-cart">

   <h1 class="heading"> عربة التسوق</h1>

   <table>
      <thead>
         <th>الصورة</th>
         <th>الاسم</th>
         <th>السعر</th>
         <th>العدد</th>
         <th>السعر الكلي</th>
         <th>العمل</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><img src="admin/<?php echo $fetch_cart['image']; ?>" height="75" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo $fetch_cart['price']; ?>$ </td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="تعديل" class="option-btn">
               </form>
            </td>
            <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>$</td>
            <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('إزالة العنصر من سلة التسوق؟');">حذف</a></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">العربة فارغة</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">المبلغ الإجمالي :</td>
         <td><?php echo $grand_total; ?>$</td>
         <td><a href="index.php?delete_all" onclick="return confirm('حذف كل المنتجات من العربة?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">حذف الكل</a></td>
      </tr>
   </tbody>
   </table> -->



</div>

</div>
<script>
   // fa-star-o
   // fa-star
   $(document).ready(function(){
		$(".list-inline-item i").click(function(){
			$(this).toggleClass("fa-star fa-star-o");
		});
	});
	$(document).ready(function(){
		$(".wish-icon i").click(function(){
			$(this).toggleClass("fa-heart fa-heart-o");
		});
	});	
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>
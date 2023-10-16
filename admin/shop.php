<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Poppins:wght@100;200;300&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

<link rel="stylesheet" type="text/css" id="theme-t" href="day.css">
    <script>
const themeToggle = document.getElementById("theme");
const themeLink = document.getElementById("theme-t");

// تحقق من الوضع الحالي وقم بتعيينه بناءً على ذلك
if (localStorage.getItem("theme") === "night") {
    themeLink.href = "night.css";
}

// تبديل الوضع عند النقر على الزر
themeToggle.addEventListener("click", () => {
    if (themeLink.getAttribute("href") === "day.css") {
        themeLink.href = "night.css";
        localStorage.setItem("theme", "night");
    } else {
        themeLink.href = "day.css";
        localStorage.setItem("theme", "day");
    }
});

    </script>
</head>
<body>

<div class="header">
            
               <div class="section">
                 <h1>Available products</h1>
               </div>
    
    <div class="nav-bar">
                   <ul>
            <li><a href="#" target="_blank">Home</a></li>
            <li><a href="#" target="_blank">about</a></li>
            <li><div class="input-wrapper">
  <button class="icon"> 
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="25px" width="25px">
      <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"></path>
      <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M22 22L20 20"></path>
    </svg>
  </button>
  <input placeholder="search.." class="input" name="text" type="text">
</div></li>
            <li style="float: right;"></li>
          </ul>
    </div>



    <label for="theme" class="theme">
	<span class="theme__toggle-wrap">
		<input id="theme" class="theme__toggle" type="checkbox" role="switch" name="theme" value="dark">
		<span class="theme__fill"></span>
		<span class="theme__icon">
			<span class="theme__icon-part"></span>
			<span class="theme__icon-part"></span>
			<span class="theme__icon-part"></span>
			<span class="theme__icon-part"></span>
			<span class="theme__icon-part"></span>
			<span class="theme__icon-part"></span>
			<span class="theme__icon-part"></span>
			<span class="theme__icon-part"></span>
			<span class="theme__icon-part"></span>
		</span>
	</span>
</label>
    
</div>
    <?php
    include('config.php');
    $result = mysqli_query($con, "SELECT * FROM products");
    while($row = mysqli_fetch_array($result)){
        echo "
        <center>
        <main class='aa'>
        
        <div class='cc'>
        <div class='card_box'>
            <span></span>
                <img src='$row[image]' class='card-img-top'>
               
                    <h5 class='card-title'>$row[name]</h5>
                    <p class='card-text'>$row[price]</p>
                    <a href='val.php? id=$row[id]' class='edit_btn' name='add'>Add to cart</a>
                </div>
</div>
        </main>
        <center>
        ";
    }
    ?>





</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Poppins:wght@100;200;300&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shope online | اضافة منتجات</title>
   
</head>
<body>
<center>
  <main>
    <div class="form-container">
        <form class="form" action="insert.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="input-name">Product Name</label>
            <input type="text" name="name" id="input-name">
          </div>
          <div class="form-group">
            <label for="input-price">Product Price</label>
            <input type="text" name="price" id="input-price" >
            
          </div>
       <div class="contan-buttun">
       <div class="file-input">
            <input type="file" name="image" id="file" class="file">
             <label for="file">
               Select file
               <p class="file-name"></p>
             </label>
           </div>
             <br>
             <button class="form-submit-btn" name="upload">submit</button>
       </div>
       <div>
        <a href="products.php" class="an">View all products</a>
       </div>
        </form>
      </div>
    </main>
</center>


</body>
</html>
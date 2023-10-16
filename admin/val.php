<?php
include('config.php');
$ID=$_GET['id'];
$my=mysqli_query($con,"select * from prod where id=$ID");
$data=mysqli_fetch_array($my);
?>
<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Poppins:wght@100;200;300&family=Tajawal:wght@300&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products its ok</title>



</head>
<body>
    <center>
    <div class="card">
  
    <form action="shopping-card.php" method="post">
    <h2>This product will be added to the card</h2>
    <input type="text" name="id" value="<?php echo $data['id'] ?>" readonly>
    <input type="text" name="name" value="<?php echo $data['name'] ?>" readonly>
    <input type="text" name="price" value="<?php echo $data['price'] ?>" readonly>
    <button type="submit" name="add" class="form-submit-btn">are you sure?</button><br>
    <a href="shop.php" class="back">back</a>
        </form>
</div>
    </center>
</body>
</html>
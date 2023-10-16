<?php

include('config.php');
$ID=$_GET['id'];

mysqli_query($con,"DELETE FROM insert_card WHERE id=$ID");

header('location: card.php');

?>
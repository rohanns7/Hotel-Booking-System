<!DOCTYPE html>
<?php
session_start();
include('header.php');
include('admin/db_connect.php');

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./css/home.css">
  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  <title>ANNAPURNA HOTEL</title>
</head>
<body> 
  <header>
    <!--  logo    -->
    <div class="logo">
        
      <a href="Homepage.php"><img src="images/logo.png"></a>
    <h1 style="margin-top: 25px">HOTEL ANNAPURNA</h1>
    </div>

    <!--  Navigation    -->

    <nav class="active">
      <ul>
        <li><a href="index.php?page=list">Accomodation</a></li>
        <li><a href="DINNING.html">Restaurant</a></li>
        <li><a href="..">Happenings</a></li>
        <li><a href="..">Activities</a></li>  
      </ul>
    </nav>
  </header>
  
  <div class="background-image">
    <img src="images/hotel.jpg">
  </div>
  <div class="text-box">
    <h1 style="margin-top: 530px">ANNAPURNA HOTEL</h1>
  </div>
<div class="room" style="
  font-size: 100px;
  background-color: black;
  width: 350px;
  height: 150px;
  color: white;
  margin-left: 570px;
  padding-left: 40px;
  margin-top: 45px;
}">Room</div>
  <!--Accomodation-->

  <?php
  $query = $conn->query("SELECT * FROM  room_categories order by rand() ");
  while($row = $query->fetch_assoc()):
  ?>
    <div class="container">
    <h1><?php echo $row['name']; ?></h1>
    <img class="image-cafe" src="assets/img/<?php echo $row['cover_img'] ?>" alt="" />
    <div class="right-box">
    <p><?php echo $row['description']; ?></p>    
        <div class="book">
          <a href="#">Book Now</a>
        </div>
    </div>
</div>
<?php endwhile; ?>



</body>
</html>
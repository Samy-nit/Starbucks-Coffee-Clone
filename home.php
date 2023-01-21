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
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Starbucks Order</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
      ?>
      <h3><?php echo $fetch['name']; ?></h3>
         <select required class="join-now" name="preference" placeholder="Preference" id="list" onchange="getSelectValue();">
            <option value="">Select</option>
            <option value="Hot Coffees">Hot Coffee</option>
            <option value="Hot Teas">Hot Tea</option>
            <option value="Cold Coffees">Cold Coffee</option>
            <option value="Hot Drinks">Hot Drink</option>
            <option value="Iced Teas">Iced Tea</option>
            <option value="Frappuccino">Frappuccino Blended Beverage</option>
            <option value="Cappuccino">Cappuccino Blended Beverage</option>
            <option value="Lattes">Latte</option>
            <option value="Mochas">Mocha</option>
            <option value="Chocolate">Chocolate Cream Cold Brew</option>
            <option value="Vanilla">Vanilla Cream Cold Brew</option>
            <option value="Espresso">Espresso</option>
            <option value="Chestnut">Chestnut Praline Cream</option>
            <option value="White Chocolate">White Hot Chocolate</option>
            <option value="Caramel">Caramel Blended Beverage</option>
            <option value="Almondmilk">Sugar Cookie Almondmilk</option>
            <option value="Almondmilk">Teavana Mango Black Tea</option>
            <option value="Almondmilk">Peach Green Tea</option>
            <option value="Almondmilk">Passion Tango</option>
        </select>
    <script>
        
        function getSelectValue()
        {
            var selectedValue = document.getElementById("list").value;
            console.log(selectedValue);
        }
        getSelectValue();

    </script>
      <a href="thankyou.php" class="btn">Place Order</a>

      <a href="index.php?logout=<?php echo $user_id; ?>" class="delete-btn">Logout</a>
      <p>New <a href="login.php">Login</a> or <a href="register.php">Register</a></p>
   </div>

</div>

</body>
</html>
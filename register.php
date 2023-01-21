<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $preference = mysqli_real_escape_string($conn, $_POST['preference']);

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }
      else{
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, preference) VALUES('$name', '$email', '$pass', '$preference')") or die('query failed');

         if($insert){
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Starbucks Register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>JOIN NOW</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="Enter Username" class="box" required>
      <input type="email" name="email" placeholder="Enter Email" class="box" required>
      <input type="password" name="password" placeholder="Enter Password" class="box" required>
      <input type="password" name="cpassword" placeholder="Confirm Password" class="box" required>
      <select required name="preference" placeholder="Preference" class="box" id="list" onchange="getSelectValue();">
            <option value="">Preference</option>
            <option value="None">None</option>
            <option value="Hot Coffees">Hot Coffees</option>
            <option value="Hot Teas">Hot Teas</option>
            <option value="Cold Coffees">Cold Coffees</option>
            <option value="Hot Drinks">Hot Drinks</option>
            <option value="Iced Teas">Iced Teas</option>
            <option value="Frappuccino">Frappuccino Blended Beverages</option>
            <option value="Cappuccino">Cappuccino Blended Beverages</option>
            <option value="Lattes">Lattes</option>
            <option value="Mochas">Mochas</option>
        </select>
    <script>
        
        function getSelectValue()
        {
            var selectedValue = document.getElementById("list").value;
            console.log(selectedValue);
        }
        getSelectValue();

    </script>
      <input type="submit" name="submit" value="Register" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>
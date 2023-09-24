<?php

include 'config.php';

session_start();

$publisherid = $_SESSION['publisher_id'];

if(!isset($publisherid)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $lines = mysqli_real_escape_string($conn, $_POST['lines']);
   $select_message = "SELECT * FROM `essays` WHERE name = '$name' AND essay_lines = '$lines'" or die('query failed');
   $res = mysqli_query($conn,$select_message);

   if(mysqli_num_rows($res) > 0){
      $message[] = '
      Topic added already!';
   }else{
      $sql = "INSERT INTO `essays`(name,essay_lines) VALUES('$name', $lines)" or die('query failed');
      $res = mysqli_query($conn,$sql);
      $message[] = 'Topic Added successfully!';
   }

}


if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $sql = "DELETE FROM `essays` WHERE id = '$delete_id'" or die('query failed');
    $res = mysqli_query($conn,$sql);
    header('location:publisher_essay.php');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin_style.css">


</head>
<body>
   
<?php include 'publisher_header.php'; ?>


<section class="contact">

   <form action="" method="post">
      <h3>Give Topics Of Essays For Essay Competition!</h3>
      <input type="text"  name="name" required placeholder="enter topic name" class="box">
      <input type="text" name="lines" required placeholder="enter no of lines"class="box">
      <input type="submit" value="Submit" name="send" class="btn">
   </form>

</section>




<section class="messages">

   <h1 class="title"> Essay Topics </h1>

   <div class="box-container">
   <?php
      $sql = "SELECT * FROM `essays`" or die('query failed');
   $res = mysqli_query($conn,$sql);
      if(mysqli_num_rows($res) > 0){
         while($fetch_message = mysqli_fetch_assoc($res)){
      
   ?>
   <div class="box">
      <p> id : <span><?php echo $fetch_message['id']; ?></span> </p>
      <p> name : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> no of lines : <span><?php echo $fetch_message['essay_lines']; ?></span> </p>
      <a href="publisher_essay.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">No topics were added by you!</p>';
   }
   ?>
   </div>

</section>


<!-- custom js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
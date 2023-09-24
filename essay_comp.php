<?php

include 'config.php';

session_start();

$id = $_SESSION['user_id'];

if(!isset($id)){
   header('location:login.php');
}



if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $story_type = $_POST['method'];
    $file = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_folder = 'uploaded_file/'.$file;
 
    $select_product_name = "SELECT story_name FROM `contest` WHERE story_name = '$story_type'" or die('query failed');
    $res = mysqli_query($conn,$select_product_name);
    if(mysqli_num_rows($res) > 0){
       $message[] = 'essay already added';
    }else{
       $add_product_query = "INSERT INTO `contest`(user_name,user_email,user_number,image,story_name,type) VALUES('$name','$email','$number', '$file','$story_type','essay')" or die('query failed');
       $res = mysqli_query($conn,$add_product_query);
 
       if($add_product_query){
          if($file_size > 2000000){
             $message[] = 'file size is too large';
          }else{
             move_uploaded_file($file_tmp_name, $file_folder);
             $message[] = 'Essay submitted successfully!';
          }
       }else{
          $message[] = 'Essay not Added';
       }
   

    }
 }
 header( "refresh:100;url=essay_comp.php" );
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

   <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


</script>
</head>
<body>
   


nt-size: 25px;">Competition Ends on</h3><?php  echo '<h2>'; echo date('d/m/y H:i:s', time()+10800); echo '</h2>'; ?>
?php
     $sql = "SELECT * FROM `essays`" or die('query failed');
  $res = mysqli_query($conn,$sql);
      if(mysqli_num_rows($res) > 0){
        while($fetch_message = mysqli_fetch_assoc($res)){
     
 ?>><?php echo $fetch_message['name']; ?></span> </p>
   nes : <span><?php echo $fetch_message['essay_lines']; ?></span> </p>
SELCT * FROM essays";
$re = mysqli_query($conn,$sql);
?>
<setion class="contact">
   <form method="post" enctype="multipart/form-data">
  <h3 style="font-size: 30px ;">Submit Your Essay</h3>
     <h4 style="font-size: 15px ;"><b>Get a chance to Win amazing prizes</b></h4>
     <input type="text" name="name" required placeholder="enter your name" readonly = "true" value="<?php echo $_SESSION['user_name']; ?>" class="box">
     <input type="email" name="email" required placeholder="enter your email" readonly = "true" value="<?php echo $_SESSION['user_email']; ?>" class="box">
     <input type="text" name="number" required placeholder="enter your phone number" class="box">
     
     <div class="inputBox">
           <select name="method" class="box">
           <option selected>Choose Essay</option>
           <?php while($row = mysqli_fetch_assoc($res))
           {echo'
              <option value="'.$row['name'].'">'.$row['name'].'</option>';
           }
           echo'
            </select>
        </div>
        ';
        ?>
     <input type="file" name="file" accept=".pdf,.doc,.txt" class="box" required>
      <input style = "width:100%;" type="submit" value="Submit" name="send" class="btn">
  
  </form>

<br><br><br>                 YH
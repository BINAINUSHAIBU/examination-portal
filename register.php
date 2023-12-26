
<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
  $tutor_id $_COOKIE['tutor_id'];
}else{
  $tutor_id = '';
  
}

if(isset($_POST['submit'])){

  $id = create_unique_id();
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $profession = $_POST['profession'];
  $profession = filter_var($profession, FILTER_SANITIZE_STRING);
  $Email = $_POST['Email'];
  $Email = filter_var($Email, FILTER_SANITIZE_STRING);
  $pass = ubainu2017($_POST['pass']);
  $pass= filter_var($pass, FILTER_SANITIZE_STRING);
  $c_pass = ubainu2017($_POST['c_pass']);
  $c_pass= filter_var($c_pass, FILTER_SANITIZE_STRING);

  $image = $_FILES['image']['name'];
  $image = filter_var($image, FILTER_SANITIZE_STRING);
  $ext = pathinfo($image, PATHINFO_EXTENSION);
  $rename = create_unique_id(). '.'.$ext;
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_size = $_FILES['image']['size'];
  $image_folder = '../uploaded_files/' .$rename;

  $select_tutor_Email = $conn->prepare("SELECT * FROM 'tutors' WHERE Email = ?");
  $select_tutor_Email->execute([$Email]);

  if($select_tutor_Email->rowCount() > 0){
    $message[] = 'Email already taken!';
  }else{
    if($pass != $c_pass){
      $message[] = 'password not matched!';
    }else{
      if($image_size > 2000000){
        $message[] = 'image size is too large! ';
      }else{
        $insert_tutor = $conn->prepare("INSERT INTO 'tutors'(id, name, profession, Email, password, image) VALUES(?,?,?,?,?,?)");
      $insert_tutor->execute([$id, $name, $profession, $Email, $c_pass, $rename]);
      move_uploaded_file($image_tmp_name, $image_folder);

      
      $verify_tutor = $conn->prepare("SELECT * FROM 'tutors' WHERE Email = ? AND password =? LIMIT 1");
      $verify_tutor->execute([$Email, $c_pass]);
      $row = $verify_tutor->fetch(PDO::FETCH_ASSOC);

      if($insert_tutor){
         if($verify_tutor->rowCount() > 0){
          setcookie('tutor_id', $row['id'], time() + 60*60*24*30, '/');
          header('location:dashboard.php');
         }else{
          $message[] = 'something went wrong!';
         }
      }
      }
    }
 }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

    <!---font awesome cdn link---->

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css"
    />

    <!---FontAwesome CDN Link for Icons--->
    <script
      src="https://kit.fontawesome.com/aab5c28c5d.js"crossorigin="anonymous"></script>

    <!------custom css file link---->

    <link rel="stylesheet" href="admin_style.css">
  
</head>
<body style="padding-left: 0;">
  
  <?php
  if(isset($message)){
    foreach($message as $message){
      echo '
      <div class="message" form>
   <span>'.$message.'</span>
   <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
  </div>
      ';

    }
  }
  ?>
  


  <header class="header">
    <section class="flex">
      <a href="dashboard.php">Admin.</a>

      <form action="search_page.php" method="post" class="search-form">
        <input type="text"  placeholder="search here..."  required maxlength="100" name="search_box" />
        <button type="submit" class="fas fa-search"  name="search_btn"  ></button>
      </form>

      <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div id="search-btn" class="fas fa-search"></div>
        <div id="user-btn" class="fas fa-user"></div>
        <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
        <?php
        $select_profile = $conn->prepare("SELECT * 'tutors' WHERE id= ?");
        $select_profile->execute([$tutor_id]);
        if($select_profile->rowCount() > 0){
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC); ?>
          }<img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
        }  <h3><?= $fetch_profile['name']; ?> </h3>
        }  <span><?= $fetch_profile['profession']; ?></span>
        <h3>please login first</h3>
        <a href="profile.php" class="btn">view profile</a>
        
        <div class="flex-btn">
        
        <div class="flex-btn">
          <a href="login.php" class="option-btn">login</a>
          <a href="register.php" class="option-btn">register</a>
      
        </div>
        
        <?php
      }else{
     ?>
        </div>
    </div>
    
        <?php
    }
    ?>
  </div>

    </section>

  </header>

  <!----header section ends---->

<!------side bar section starts---->


<div class="side-bar">

<div id="close-bar">
<i class="fas fa-times"></i>

</div>

<div class="profile">    
    
          <h3>please login or register</h3>
          <div class="flex-btn">
               <a href="login.php" class="option-btn">login</a>
               <a href="register.php" class="option-btn">register</a>
 
            </div>
          <?php
         }
         ?>
        </div>
        
<nav class="navbar">
<a href="dashboard.php"><i class="fas fa-home"></i><span>Home</span></a>
<a href="playlist.php"><i class="fas fa-bars-staggered"></i><span>playlists</span></a>
<a href="content.php"><i class="fas fa-graduation-cap"></i><span>contents</span></a>
<a href="comments.php"><i class="fas fa-comment"></i><span>comments</span></a>
<a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
</nav>

</div>

<!------side bar section ends---->


<!---------register section starts--->

<section class="form-container">

<form action="" method="post" enctype="multipart/form-data">
  <h3>Register new</h3>
  <div class="flex">

    <p>your name <span>*</span></p>
    <input type="text"  name="name" maxlength="50" required placeholder="enter your name" class="box">
    <p>your profession <span>*</span></p>
    <select name="profession" class="box">
      <option value="" disabled selected>--select your profession</option>
      <option value="Developer">Developer</option>
      <option value="Designer">Designer</option>
      <option value="Musicial">Musician</option>
      <option value="Biologist">Biologist</option>
      <option value="Teacher">Teacher</option>
      <option value="Engineer">Engineer</option>
      <option value="Lawyer">Lawyer</option>
      <option value="Accountant">Accountant</option>
      <option value="Doctor">Doctor</option>
      <option value="Journalist">Journalist</option>
      <option value="Photographer">photographer</option>
    </select>
    
    <p>your Email <span>*</span></p>
    <input type="text"  name="Email" maxlength="50" required placeholder="enter your Email" class="box">
  </div>
 <div class="col">
  
  <p>your password <span>*</span></p>
  <input type="text"  name="pass" maxlength="20" required placeholder="enter your password" class="box">
  <p> confirm password<span>*</span></p>
  <input type="text"  name="c_pass" maxlength="20" required placeholder="confirm your password" class="box">
  <p>select pic <span>*</span></p>
  <input type="file" name="image" class="box" required accept="image/*">
 </div>
 </div>
 <input type="submit" value="register now" name="submit" class="btn">
<p class="link">already have an account? <a href="login.php">Login now</a></p>

</form>

</section>




<!---------register section ends--->



    


    <!-------custom js file link----->
    <script src="admin_script.jsx"></script>

</body>
</html>


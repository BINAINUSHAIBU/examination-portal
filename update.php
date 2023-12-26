
<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
  $tutor_id $_COOKIE['tutor_id'];
}else{
  $tutor_id = '';

  header('location:login.php')
}

if(isset($_POST['submit'])){

  $select_tutor = $conn->prepare("SELECT * FROM 'tutors' WHERE id = ? LIMIT 1");
  $select_tutor->execute([$tutor_id]);
  $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
    
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $profession = $_POST['profession'];
    $profession = filter_var($profession, FILTER_SANITIZE_STRING);
    $Email = $_POST['Email'];
    $Email = filter_var($Email, FILTER_SANITIZE_STRING);

    if(!empty($profession)){
      $update_profession = $conn->prepare("UPDATE 'tutors' SET profession = ? WHERE id = ?");
      $update_profession->execute([$profession, $tutor_id]);
      $message[] = ' profession updated  successfully!';
    }

    if(!empty($Email)){
      
      $select_tutor_Email = $conn->prepare("SELECT * FROM 'tutors' WHERE Email = ?");
  
      $select_tutor_Email->execute([$Email]);
      if($select_)

      $update_Email = $conn->prepare("UPDATE 'tutors' SET Emain = ? WHERE id = ?");
      $update_Emaill->execute([$Email, $tutor_id]);
      $message[] = 'Email updated successfully!';
    }


    $prev_image = $fetch_tutor['image']; 
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = create_unique_id(). '.'.$ext;
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = '../uploaded_files/' .$rename;

    if(!empty($image)){
      if($image_size->20000000){
        $message[] = 'image size is too large!';
      }else{
        $update_image = $conn->prepare("UPDATE 'tutors' SET image = ? WHERE id = ?");
      $update_image->execute([$rename, $tutor_id]);
      move_uploaded_file($image_tmp_name, $image_folder);
      if($prev_image != '' AND $prev_image != $rename){
        unlink('../unloaded_files/'.$prev_image);
      }
      $message[] = 'image updated successfully!'; 

      }
    }

     $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $prev_pass = $fetch_tutor['password']; 
    $old_pass = ubainu2017($_POST['old_pass']);
    $old_pass= filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = ubainu2017($_POST['new_pass']);
    $new_pass= filter_var($new_pass, FILTER_SANITIZE_STRING);
    $c_pass = ubainu2017($_POST['c_pass']);
    $c_pass= filter_var($c_pass, FILTER_SANITIZE_STRING);
       
    if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
        $message[] = 'old password not matched!';
      }elseif($new_pass != $c_pass){
        $message[] = 'confirm password not matched!';
      }else{
        if($new_pass != $empty_pass){ 
      $update_pass = $conn->prepare("UPDATE 'tutors' SET password = ? WHERE id = ?");
      $update_pass->execute([$c_pass, $tutor_id]);
      $message[] = 'password updated successfully!';
        }else{
          $message[] = 'please enter new password!';
        }
      }
    }

}
?>
$count_content =$conn->prepare("SELECT * FROM 'content' WHERE tutor_id = ?");

$count_content->execute([$tutor_id]);
$total_contents = $count_content->rowCount();

$count_playlist =$conn->prepare("SELECT * FROM 'playlist' WHERE tutor_id = ?");

$count_playlist->execute([$tutor_id]);
$total_playlists = $count_playlist->rowCount();


$count_likes =$conn->prepare("SELECT * FROM 'likes' WHERE tutor_id = ?");

$count_likes->execute([$tutor_id]);
$total_likes = $count_likes->rowCount();

$count_comments =$conn->prepare("SELECT * FROM 'comments' WHERE tutor_id = ?");

$count_comments->execute([$tutor_id]);
$total_comments = $count_likes->rowCount();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>

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
<body>

-->  <!----header section starts---->


  <header class="header">

    <section class="flex">

      <a href="dashboard.php" class="logo">Admin.</a>

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
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
           ?>
          }
          <img src="images/pic-1.png" alt="">
        }  <h3><?= $fetch_profile['name']; ?> </h3>
        }  <span><?= $fetch_profile['profession']; ?></span>
        <h3>Tutor A</h3>
        <p>developer</p>
        <a href="profile.php" class="btn">view profile</a>
        
        <div class="flex-btn">
          <a href="login.php" class="option-btn">login</a>
          <a href="register.php" class="option-btn">register</a>
        </div>
        <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>

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
      
    
          <img src="images/pic-1.png" alt="">
          <h3><?= $fetch_profile ['name']; ?></h3>
          <span><? = $fetch_profile ['profesion']; ?></span>
          <h3>Tutor A </h3>
          <p>developer</p>
          <a href="profile.php" class="btn">view profile</a>
          <div class="flex-btn">
             <a href="login.php" class="option-btn">login</a>
             <a href="register.php" class="option-btn">register</a>
  
          </div>
          <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>  
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


<!-----header section link------>
 
<?php include '../components/connect.php'; ?>

<!-----update section starts-->



<section class="form-container">

<form action="" method="post" enctype="multipart/form-data">
  <h3>Update profile</h3>
  <div class="flex">

    <p>your name</p>
    <input type="text"  name="name" maxlength="50" placeholder="<?= $fetch_profile ['name']; ?>" class="box">
    <p>your profession </p>
    <select name="profession" class="box">
      <option value="<?= $fetch_profile ['profession']; ?>" selected <?= $fetch_profile ['profession']; ?> </option>
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
    
    <p>your Email</p>
    <input type="text"  name="Email" maxlength="50" placeholder="<?= $fetch_profile ['Email']; ?>" class="box">
  </div>
 <div class="col">
  <p>old password </p>
  <input type="text"  name="old_pass" maxlength="20" placeholder="enter your old password" class="box">
  <p> your password</p>
  <input type="text"  name="new_pass" maxlength="20" placeholder="enter your new password" class="box">
  <p> confirm password</p>
  <input type="text"  name="c_pass" maxlength="20" placeholder="confirm your new password" class="box">
 </div>
 </div>
 <p>select pic </p>
 <input type="file" name="image" class="box" accept="image/*">
 <input type="submit" value="Update  now" name="submit" class="btn">

</form>

</section>


<!-----update section ends-->


<!--------footer  section link---->
    <?php include '../components/footer.php'; ?>


    <!-------custom js file link----->
    <script src="admin_script.jsx"></script>


    
<!-------footer section starts--->

<footer class="footer">
   
  &copy; copyright @ <?= date('Y'); ?> by <span>BINAINU SHAIBU WEBSITE DEVELOPER</span> | all rights reserved!


</footer>

<!-------footer section ends--->

</body>
</html>


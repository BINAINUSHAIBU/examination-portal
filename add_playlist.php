
<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
  $tutor_id $_COOKIE['tutor_id'];
}else{
  $tutor_id = '';

  header('location:login.php')
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add playlist</title>

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
          <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
        }  <h3><?= $fetch_profile['name']; ?> </h3>
        }  <span><?= $fetch_profile['profession']; ?></span>
        <h3>please login first</h3>
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
      
    
          <img src="..uploaded_files/<?= $fetch_profile ['image']; ?>" alt="">
          <h3><?= $fetch_profile ['name']; ?></h3>
          <span><? = $fetch_profile ['profesion']; ?></span>
          <h3>please login or register</h3>
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


<?php
  include_once 'includes/dbh.php';
  session_start();



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>"Speedynuts"</title>
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="./normalize.css">
  </head>
  <body>
    <nav class="navbar">
      <div class="nav-left">
            <!-- header -->
        <img src="./assets/logo.svg" alt="Speedynuts">
      </div>
        <ul>
          <li><a href="home.php" class="nav-link">home</a></li>
          <li><a href="gallery.php" class="nav-link">gallery</a></li>
          <li><a href="aboutus.html" class="nav-link">About US</a></li>
        </ul>
    </nav>

    <main>
      <div class="container" >
        <h1>Home</h1>
      </div>
      <section class="container">
        <div class="wrapper">
          <h1> Welcome to Speedynuts.com </h1>
          <p style="color: black">
            text text text text text text text text text text text text text text
            text text text text text text text text text text text text text text
            text text text text text text text text text text text text text text
            text text text text text text text text text text text text text text
            text text text text text text text text text text text text text text
            text text text text text text text text text text text text text text
            text text text text text text text text text text text text text text
            text text text text text text text text text text text text text text
            text text text text text text text text text text text text text text
          </p>
          </div>
      </section>



      <section class="gallery-links">
        <div class="wrapper">
          <div class="home-gallery-container">
            <?php
                    include_once 'includes/dbh.php';

                    $sql = " SELECT * FROM pictures ORDER BY id DESC LIMIT 3";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                      echo "SQL statement 1 failed!";
                    } else {
                      mysqli_stmt_execute($stmt);
                      $result = mysqli_stmt_get_result($stmt);
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="#">
                          <div style="background-image: url(includes/uploads/'.$row["filename"].'); background-size: cover; height: 18rem">
                            </div>
                            <h4>'.$row["imagetitle"].'</h4>
                            <p>'.$row["imagedescription"].'</p>

                              </a>';
                        }
                      }
                    ?>
              </div>
          </div>
      </section>
    </main>
  </body>
</html>

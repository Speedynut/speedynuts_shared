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
        <h1>Gallery</h1>
      </div>

      <section class="gallery-links">
        <div class="wrapper">
          <div class="gallery-container">
            <?php
                    include_once 'includes/dbh.php';

                    $sql = " SELECT * FROM pictures ORDER BY id DESC";
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
        <section class="gallery-links">
          <div class="upload-wrapper">
            <h1 style="padding: 0;">Upload</h1>
            <?php
            echo '<div class="gallery-upload">
              <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="filename" placeholder="File name...">
                <input type="text" name="imagetitle" placeholder="Image title...">
                <input type="text" name="imagedescription" placeholder="Image description...">
                <input type="file" name="file">
                <button type="submit" name="submit">UPLOAD</button>';
            ?>
          </form>
        </div>
      </div>
    </section>

    </main>
  </body>
</html>

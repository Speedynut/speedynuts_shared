 <?php

$filename = [];
$imagetitle = [];
$imagedescription = [];


if (isset($_POST['submit'])) {
  $newFileName = $_POST['filename'];
  if (empty($newFileName)) {
    $newFileName = "pictures";
  } else {
    $newFileName = strtolower(str_replace(" ", "-", $newFileName));
  }
  $imagetitle = $_POST["imagetitle"];
  $imagedescription = $_POST["imagedescription"];

  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg','jpeg','png','pdf');

      if(in_array($fileActualExt, $allowed)) {
        if($fileError === 0) {
          if($fileSize < 20000000) {
             $imageFullname = $newFileName . "." . uniqid("", true) . ".". $fileActualExt;
             $fileDestination = 'uploads/'.$imageFullname;

             include_once "dbh.php";

             if (empty($imagetitle) OR empty($imagedescription)) {
               header("Location: ../error.html");
               exit();
             } else {
             $sql = "SELECT * FROM pictures;";
             $stmt = mysqli_stmt_init($conn);
             if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
             } else {
               mysqli_stmt_execute($stmt);
               $result = mysqli_stmt_get_result($stmt);
               $rowCount = mysqli_num_rows($result);
               $setImageOrder = $rowCount + 1;

               $sql = "INSERT INTO pictures (filename, imagetitle, imagedescription, imageurl)
                        VALUES (?, ?, ?, ?);";
               if (!mysqli_stmt_prepare($stmt, $sql)) {
               echo "SQL statement failed!";
             } else {
               mysqli_stmt_bind_param($stmt, "ssss", $imageFullname, $imagetitle, $imagedescription, $fileDestination);
               mysqli_stmt_execute($stmt);

               move_uploaded_file($fileTmpName, $fileDestination);

               header("Location: ../gallery.php");
             }
           }
         }

        } else {
          echo "Kolleg! Your file is too big";
        }
      } else {
        echo "Kolleg! There was an error uploading your file";
      }
    } else {
      echo "Kolleg! File cannot be uplad (Wrong Format)";
  }
}

<?php
$con = mysqli_connect("fdb26.awardspace.net","2950233_crayondwork","sooryajaya@28","2950233_crayondwork");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 /* else{
  echo "<script>alert('haii')</script>";
  }*/
          if (isset($_FILES['image'])){
          $error=array();
          $file_name=$_FILES['image']['name'];
          $file_size=$_FILES['image']['size'];
          $file_tmp=$_FILES['image']['tmp_name'];
          $file_type=$_FILES['image']['type'];
          $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
          
          $extensions = array("jpg","jpeg","png");
  
                  if(in_array($file_ext,$extensions) == false){
                  echo "Please choose the image with extension .jpg, .jpeg, .png";
                  $error[]="Please choose the image with extension .jpg, .jpeg, .png";
  
                  }
                  if(move_uploaded_file($file_tmp, "upload/" . $file_name)){
                  echo "<script>alert('haii')</script>";
                 // move_uploaded_file($file_tmp, "upload/" . $file_name);
                  
                  }
          }
?>
<!DOCTYPE html>
<html>
<head>
<title>home</title>
</head>
<body>
<form action="index.php" method="POST" enctype="multipart/form-data " >
<input type="file" name="image" >
<input type="submit" value="upload">
</form>
</body>
</html>
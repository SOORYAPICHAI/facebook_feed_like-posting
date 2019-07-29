<?php
  // Create database connection
//  $db = mysqli_connect("localhost", "root", "", "image_upload");
$db = mysqli_connect("fdb26.awardspace.net","2950233_crayondwork","sooryajaya@28","2950233_crayondwork");
  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM images ORDER BY ID DESC");
?>
<?php

$db = mysqli_connect("fdb26.awardspace.net","2950233_crayondwork","sooryajaya@28","2950233_crayondwork");
if (isset($_POST['liked'])) {
		$postid = $_POST['postid'];
		$result2 = mysqli_query($db, "SELECT * FROM images WHERE id=$postid");
		$row = mysqli_fetch_array($result2);
		$n = $row['likes'];

                mysqli_query($db, "UPDATE images SET likes=$n+1 WHERE id=$postid");
		mysqli_query($db, "INSERT INTO likes (userid, postid) VALUES (1, $postid)");
		

		
		exit();
	}
        if (isset($_POST['unliked'])) {
		$postid = $_POST['postid'];
		$result3 = mysqli_query($db, "SELECT * FROM images WHERE id=$postid");
		$row = mysqli_fetch_array($result3);
		$n = $row['likes'];

		mysqli_query($db, "DELETE FROM likes WHERE postid=$postid AND userid=1");
		mysqli_query($db, "UPDATE images SET likes=$n-1 WHERE id=$postid");
				
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>News Feed</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="utf-8">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
        background-color:white;
         
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 60%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 2px solid black;
        background-color:#f2f2f2;
       
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	<!--float: left;-->
   	margin: 5px;
   	width: 100%;
   	height: auto;
   }
   
   .container {
  position: relative;
}


.textareaModal {
    display: block;
    margin-top:5%;
    margin-left: auto;
    margin-right: auto;
   
  border: 1px solid;
  padding: 10px;
  box-shadow: 5px 10px 18px grey;
  outline:none;

}

#rcorners3{

  border-radius: 17px;
  background: white;
  padding: 20px; 
  width: 60%;
  height: 5%;
  
}
.btnModal {
  background-color: #0099cc;;
  border: none;
  color: white;
  text-align: center;
  font-size: 12px;
  margin: 4px 2px;
  opacity: 0.6;
  transition: 0.3s;
}

.btnModal:hover {opacity: 1}

.buttonModalPost {
  border: 1px solid #0066cc;
  background-color: #0099cc;
  color: #ffffff;
  padding: 5px 10px;
}
hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0; 
}


@media screen and (max-width: 900px) and (min-width: 300px) {
#content{
width:90%;
height:100%;
}}
.likes_count{
color:#8c8c8c;
}
.img_wrp {
  display: inline-block;
  position: relative;
}
.closee {
  position: absolute;
  top: 0;
  right: 0;
  font-wieght:bold;
  background:transparent;
  border:none;
}
#xButton{
display:none;
float: right;
}
</style>


<!-- input file selected image displaying -->
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
document.getElementById('blah').style.display="block";
document.getElementById('xButton').style.display = 'block';
document.getElementById("post").disabled = false;
document.getElementById("post").style.backgroundColor = "blue";
            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<!-- Counting the characters  -->
<script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 50) {
          val.value = val.value.substring(0, 50);
        } else {
          $('#charNum').text(50 - len+"/50");
        }
      }
    </script>
    

    </head>
<body style="background-color:#f2f2f2">
<div id="content">

   <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
    <textarea class="textareaModal" id="rcorners3" placeholder="Please post here......" readonly data-toggle="modal" data-target="#myModal"></textarea>

  <!-- Modal -->
  <div class="modal fade-in" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Share a post here....</h4>
        </div>
        <div class="modal-body">
           <form method="POST" action="index2.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
        <input type="file"  name="image" id="selectedFile" accept=".jpg, .jpeg, .png" style="display: none;" onchange="readURL(this);"/>
<input type="button"  class ="btnModal" value="Browse..." onclick="document.getElementById('selectedFile').click();"  />
  	<!--  <input type="file" name="image" accept=".jpg, .jpeg, .png" onchange="readURL(this);" />-->
        <br>
        <div class="img_wrp">
       <div id="xButton"> <i class="fa fa-close closee"  style="font-size:48px;color:red"></i></div> 
        <img id="blah" src="#"  hidden />
       
        <br>
    </div>
  	</div>
  	<div>
        <textarea id="text" 
 
      	name="image_text" 
      	placeholder="Say something about this image..." onkeyup="countChar(this)" style="width:100%;height:100%;"></textarea>
     <!-- <textarea
      	id="text" 
 
      	name="image_text" 
      	placeholder="Say something about this image..." onkeyup="countChar(this)"> </textarea>-->
         <span id="charNum"></span>
  	</div>
  	<div>
  		<button type="submit" class="buttonModalPost"  name="upload" id="post" disabled>POST</button>
  	</div>
  </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      	echo "<img src='images/".$row['image']."' >";        
        echo "<br>";
        echo "<hr>";
      	echo '<p style="color:#000000">'.$row["image_text"].'</p>';
        echo "<hr>";
        
        
        $results = mysqli_query($db, "SELECT * FROM likes WHERE userid=1 AND postid=".$row['id']."");
                if (mysqli_num_rows($results) == 1 )
                {
                echo '<span class="unlike" id="'.$row["id"].'">';
                echo '<a href=""><i  class="fa fa-thumbs-up"></i></a>';
                echo "</span>";
                
                }
                else
                {
                echo '<span class="like" id="'.$row["id"].'">';
                echo '<a href=""><i class="fa fa-thumbs-o-up"></i></a>';
                echo '</span>';
                }
        /*echo "<span>";
        echo "<a href='#'>like</a>";
        echo "</span>";*/
        echo "&nbsp;";
        echo "&nbsp;";
        echo "<span class='likes_count'>".$row['likes']." likes</span>";
      echo "</div>";
    }
    
  ?>
 
</div>
    <script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').click(function() {
                var postid=this.id;
   $.ajax({
				url: 'index2.php',
				type: 'post',
				data: {
					'liked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
                                        /*setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
      }, 1000);*/
				}
			});
});
// when the user clicks on unlike
		$('.unlike').on('click', function(){
			var postid=this.id;

			$.ajax({
				url: 'index2.php',
				type: 'post',
				data: {
					'unliked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
                                         /*setTimeout(function(){// wait for 5 secs(2)
                                         location.reload(); // then reload the page.(3)
                                         }, 1000);*/
				}
			});
		});
                           });

</script>
<script>

document.getElementById('xButton').addEventListener("click", function(){
    document.getElementById('blah').style.display = 'none';
    document.getElementById('xButton').style.display = 'none';   
});

</script>
</body>
</html>
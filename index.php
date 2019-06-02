<?php

	include 'init/db.php';
	
	if(CONNECTED){

	include 'init/user.php';
	
		$page;

	if($USER_DATA!=null){

		if($_SERVER['REQUEST_METHOD']=='POST'){

			if(isset($_POST['act'])){

				if($_POST['act']=='logout'){

					unset($_SESSION['user_id']);
					header("Location:?");

				}
					if($_POST['act']=='edit_profile'){
					
						$temp = $_FILES["avatar"]["name"];
					
					$temp_file = explode(".", $temp);

					$new_file =  $_POST['login'].".".end($temp_file);
					move_uploaded_file($_FILES['avatar']['tmp_name'], 'prophotos/'.$new_file);
			
					$login = $_POST['login'];
					$pass1 = $_POST['password'];
					$name = $_POST['name'];
					$surname = $_POST['surname'];
					$gender = $_POST['gender'];
					$city = $_POST['city'];
					$phone = $_POST['phone'];
					$birthday = $_POST['birthday'];
					$uid = $_SESSION['user_id'];
					
					 $sql = "UPDATE users SET login=\"".$login."\", password=\"".$password."\", 
                                name=\"".$name."\", surname=\"".$surname."\",gender=\"".$gender."\", city = \"".$city."\",
                                phone = \"".$phone."\", birthday = \"".$birthday."\",url = \"".$new_file."\" WHERE id=\"".$uid."\"";
            		$connection->query($sql);
					header("Location:?page=profile");
				}
				
						if($_POST['act']=='add_post'){
						
					$title = $_POST['title'];
					$content = $_POST['content'];
					$userlogin = $USER_DATA->login;
					$user_id = $USER_DATA->id;
					
					$temp = $_FILES["post_photo"]["name"];
					$temp_file = explode(".", $temp);
					$new_file = $userlogin.".". $_POST['title'].".".end($temp_file);
					move_uploaded_file($_FILES['post_photo']['tmp_name'], 'post_photos/'.$new_file);
	
				

					$sql_text = "INSERT INTO posts(id,uid,title,content,post_date,photo,active) 
					 VALUES(NULL,\"".$user_id."\",\"".$title."\",\"".$content."\",NOW(),\"".$new_file."\",1)";
		
					$connection->query($sql_text);
						header("Location:?page=profile");

				}
				
					
				
			
		
				
						if($_POST['act']=='add_comment'){
					
					$content = $_POST['comment'];
					$post_id = $_POST['image_id'];
					$user_id = $USER_DATA->id;
					
				

					$sql_text = "INSERT INTO comments(id,post_id,user_id,text,post_date) 
					 VALUES(NULL,\"".$post_id."\",\"".$user_id."\",\"".$content."\",NOW())";
		
					$connection->query($sql_text);
						header("Location:?page=profile");

				}
						if($_POST['act']=='delete_comment'){
					
					$post_id = $_POST['image_id'];
					

					$sql_text = "DELETE FROM comments WHERE user_id=".$USER_DATA->id." AND post_id=".$post_id;
		
					$connection->query($sql_text);
						header("Location:?page=profile");

				}
					if($_POST['act']=='delete_post'){
					
					$post_id = $_POST['post_id'];
					

					$sql_text = "DELETE FROM posts WHERE uid=".$USER_DATA->id." AND id=".$post_id;
		
					$connection->query($sql_text);
						header("Location:?page=profile");

				}
				
				
						if($_POST['act']=='add_comment2'){
					
					$content = $_POST['comment'];
					$post_id = $_POST['image_id'];
					$user_id = $USER_DATA->id;
					
				

					$sql_text = "INSERT INTO comments(id,post_id,user_id,text,post_date) 
					 VALUES(NULL,\"".$post_id."\",\"".$user_id."\",\"".$content."\",NOW())";
		
					$connection->query($sql_text);
						header("Location:?page=news");

				}
						if($_POST['act']=='delete_comment2'){
					
					$post_id = $_POST['image_id'];
					

					$sql_text = "DELETE FROM comments WHERE user_id=".$USER_DATA->id." AND post_id=".$post_id;
		
					$connection->query($sql_text);
						header("Location:?page=news");

				}
				
					if($_POST['act']=='delete_friend'){
					
					$friend_id = $_POST['friend_id'];
					$id = $USER_DATA->id;

					$sql_text = "DELETE FROM friends WHERE user_one=".$id." AND user_two=".$friend_id." OR user_two=".$id." AND user_one=".$friend_id;
		
					$connection->query($sql_text);
						header("Location:?page=friends");

				}
				
				if($_POST['act']=='add_friend'){
					
					$friend_id = $_POST['user_id'];
					$user_id = $USER_DATA->id;
					
				

					$sql_text = "INSERT INTO friends(id,user_one,user_two) 
					 VALUES(NULL,\"".$user_id."\",\"".$friend_id."\")";
		
					$connection->query($sql_text);
						header("Location:?page=friends");

				}
					if($_POST['act']=='send_message'){
					
					$text = $_POST['text'];
					$r_id = $_POST['receiver_id'];
					
					$id=$USER_DATA->id;
					$query = "INSERT INTO messages VALUES(NULL,".$id.", ".$r_id.",\"".$text."\", 0, 1, 1, NOW())";
					$connection->query($query);
					header("Location:?page=dialog&id=$r_id");
					

				}
			
					if($_POST['act']=='show_profile'){
					
					$id = $_POST['user_id'];
					
					header("Location:?page=show_profile&id=$id");
					

				}
				
					if($_POST['act']=='create_album'){
					
					$name = $_POST['name'];
					$id=$USER_DATA->id;
					
					$query = "INSERT INTO albums VALUES(NULL,\"".$name."\",".$id.")";
					$connection->query($query);
					header("Location:?page=create");
					

				}
					if($_POST['act']=='upload_photo'){
					
				
					$album_id = $_POST['album'];
					
					$temp = $_FILES["photo"]["name"];
					$temp_file = explode(".", $temp);
					$new_file = sha1(rand()).".".end($temp_file);
					move_uploaded_file($_FILES['photo']['tmp_name'], 'albums/'.$new_file);
	
				

					$sql_text = "INSERT INTO photos(id,name,album_id,url,post_time) 
					 VALUES(NULL,\"".$temp."\",\"".$album_id."\",\"".$new_file."\", NOW() )";
		
					$connection->query($sql_text);
						header("Location:?page=upload");
					

				}
				
			}
		}	


		$page = 'profile';

		if(isset($_GET['page'])){

			if($_GET['page']=='profile'){

				$page = 'profile';

			}else if($_GET['page']=='news'){

				$page = 'news';

			}
			else if($_GET['page']=='add_post'){

				$page = 'add_post';

			}
				else if($_GET['page']=='messages'){

				$page = 'messages';

			}
			else if($_GET['page']=='photos'){

				$page = 'photos';

			}
			else if($_GET['page']=='friends'){

				$page = 'friends';

			}
		
			else if($_GET['page']=='edit_profile'){

				$page = 'edit_profile';

			}
			else if($_GET['page']=='create'){

				$page = 'create';

			}
			else if($_GET['page']=='upload'){

				$page = 'upload';

			}
			else if($_GET['page']=='view'){

				$page = 'view';

			}
				else if($_GET['page']=='dialog'){

				$page = 'dialog';

			}
				else if($_GET['page']=='show_profile'){

				$page = 'show_profile';

			}
			else{

				$page = '404';

			}

		}


	}else{

		if($_SERVER['REQUEST_METHOD']=='POST'){

			if(isset($_POST['act'])){

				if ($_POST['act']=='register'){
					
					$temp = $_FILES["avatar"]["name"];
					
					$temp_file = explode(".", $temp);

					$new_file =  $_POST['login'].".".end($temp_file);
					move_uploaded_file($_FILES['avatar']['tmp_name'], 'prophotos/'.$new_file);
					
			
			
			
					$login = $_POST['login'];
					$pass1 = $_POST['password'];
					$pass2 = $_POST['password2'];
					$name = $_POST['name'];
					$surname = $_POST['surname'];
					$gender = $_POST['gender'];
					$city = $_POST['city'];
					$phone = $_POST['phone'];
					$birthday = $_POST['birthday'];
					
					if($pass1==$pass2){

		$sql_text = "INSERT INTO users(id,login,password,name,surname,gender,city,phone,birthday,url,active) 
					 VALUES(NULL,\"".$login."\",\"".$pass1."\",\"".$name."\",\"".$surname."\",\"".$gender."\",\"".$city."\",\"".$phone."\",\"".$birthday."\",\"".$new_file."\",1)";
		
		$connection->query($sql_text);

		header("Location:index.php?success=1");

	}else{

		header("Location:index.php?error=1");

		}
				
}
				if($_POST['act']=='login'){

					$login = $_POST['login'];
					$pass = $_POST['password'];

					$query = $connection->query("SELECT * FROM users 
						WHERE login = \"".$login."\" AND password = \"".$pass."\" ");

					if($row=$query->fetch_object()){

						$_SESSION['user_id'] = $row->id;
						header("Location:?page=profile");

					}

				}
			
			}

		}

		$page = 'home';

		if(isset($_GET['page'])){

			if($_GET['page']=='home'){

				$page = 'home';

			}else if($_GET['page']=='register'){

				$page = 'register';

			}
		
			else{

				$page = '404';

			}

		}


	}
	
	?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qclub</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
</head>

<body>

		<div id="sitename">
			<div class="width">
				<h1><a href="#"> Qclub </a></h1>

	
				<div class="clear"></div>
			</div>
		</div>

		<section id="body" class="width clear">
				
				<?php

        	include 'views/'.($USER_DATA!=null?'logged':'notlogged').'/'.$page.'.php';

        ?>
		</section>
	
		<footer class="clear">
			<div  class="width">
				<p class="left">&copy; 2015 Qclub.</p>
				<p class="right"><a href="http://vk.com/meru_nur/">by Meruert Nurgazy</a></p>
			</div>
		</footer>
</body>
</html>
<?php
}
?>

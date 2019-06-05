<link rel="stylesheet" href="styles.css" type="text/css" />
<?php

	include 'init/db.php';
	
	if(CONNECTED){

	include 'init/user.php';
	
	if($USER_DATA!=null){

		if($_SERVER['REQUEST_METHOD']=='POST'){
		    	if(isset($_POST['act'])){
		    	
		    	    
		    	    	if($_POST['act'] == 'search_content'){

					$key = $_POST['key'];

				
				$query = $connection->query("SELECT * FROM users WHERE id!=".$USER_DATA->id." AND name LIKE \"%".$key."%\" OR surname LIKE \"%".$key."%\"");
			
				while($row = $query->fetch_object()){
					$id=$row->id;
					$id2=$USER_DATA->id;
					$query2 = $connection->query("SELECT * FROM friends WHERE user_one=".$id." AND user_two =".$id2." OR user_two=".$id." AND user_one =".$id2);
							while($row2 = $query2->fetch_object()){
								$r = $row2->id;
							}
							if($r==0){
				?>
					<form action="?" method="post">
					<div id = "found_friends">
                   <p> 
                      	<p><img class="search_friends" align='left' alt="avatar" src = "<?php echo "prophotos/".$row->url."";  ?>"></p>
                        <h4> <?php echo $row->name." ".$row->surname;?>  </h4>
                       <h5>&nbsp Birthday: &nbsp<?php echo $row->birthday;?></h5>
                       <h5>&nbsp City: &nbsp<?php echo $row->city;?></h5>
                       <h5>&nbsp Phone: &nbsp<?php echo $row->phone;?></h5>
                   
                    </p>
                    <br>
    
              </div>
             <input type="hidden" name = "user_id" value = "<?php echo $row->id;?>">
              <input type="hidden" name = "act" value = "add_friend">
                    	<input type = "submit" class="formbutton" value="ADD TO FRIENDS"> 
              </form>
              
					<?php
							}
				}
		}
				 
				 
		    	    
	}
	}
}
}

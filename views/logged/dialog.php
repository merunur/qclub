	<aside id="sidebar" class="column-left">
				<ul>
                	<li>
						<h4>Navigate</h4>
                        <ul class="blocklist">
                            <li><a href="?page=profile">My profile</a></li>
                            <li><a href="?page=friends">My friends</a></li>
                            <li><a href="?page=photos">My photos</a></li>
                            <li class="selected-item"><a href="?page=messages">My messages</a></li>
                            <li><a href="?page=news">My news</a></li>
                        </ul>

					</li>	
				</ul>
				<form action="?" method="post">
                    	<input type="hidden" name = "act" value = "logout">
                    	<input type = "submit" class="formbutton" value="LOGOUT">
                    </form>
			
			</aside>
			<section id="content" class="column-right">
				
			    
			    <?php
			     $id1 = $USER_DATA->id;
			     $id2 = $_GET['id'];
			    	$sql_text = "SELECT * FROM messages WHERE (sid=".$id1." AND rid=".$id2.") OR (rid=".$id1." AND sid=".$id2.")";
   
                        $connect = $connection->query($sql_text);
                        $sql3 ="SELECT name,surname,url FROM users WHERE id=".$id2;
                        $connect3 = $connection->query($sql3);
			           $r3 = $connect3->fetch_object();
			           $n=$r3->name;
			           $s=$r3->surname;
			           $url = $r3->url;
                        ?>
                        
                        <hr>
                   <div id="title_bar">
                 
			 <div >
                   <p> <table>
                   	<tr>
                   		<td> <a style="background-color:#fff" href="?page=messages"><b> <=Back </b></a></td>
                   		<td><p><img class="message_logo" align='left' alt="avatar" src = "<?php echo "prophotos/".$url."";  ?>"></p>
                       <h5> <?php echo $n." ".$s;?>  </h5></td>
                   	</tr>
                   </table> 
                       	
                       
                      
                    </p>
              </div></div>
              
              <div class="clear"></div>
              <hr>
                        
                      <table id="dialog_table">
                          
                        <?php
			   while($row = $connect->fetch_object()){
			       $time= $row->sent_date;
			       if($row->sid==$id1){
			           $sql2 ="SELECT name,url FROM users WHERE id=".$id1;
			          
			           $connect2 = $connection->query($sql2);
			           $r = $connect2->fetch_object();
			           $user=$r->name;
			           $img = $r->url;
			           ?>
						<tr>
						    <td><img class="dialog_icon" align='left' src = "<?php echo "prophotos/".$img."";  ?>"></td>
						    <td id="dialog_td"><div><b><?php echo $user?></b></div><div><?php echo $row->text?></div></td>
						   <td><h6 style="color:#505050 "><?php echo $time;?></h6></td>
						</tr>
						<?php
			         
			       }
			       else{ 
			           
			           $sql2 ="SELECT name,url FROM users WHERE id=".$id2;
			           $connect2 = $connection->query($sql2);
			           $r = $connect2->fetch_object();
			           $user=$r->name;
			           $img = $r->url;
			           ?>
						<tr>
						    <td><img class="dialog_icon" align='left' src = "<?php echo "prophotos/".$img."";  ?>"></td>
						    <td id="dialog_td"><div><b><?php echo $user?></b></div><div><?php echo $row->text?></div></td>
						   <td><h6 style="color:#505050 "><?php echo $time;?></h6></td>
						</tr>
						<?php
			           
			       }
						
							
							}
						
						?>
				</table>
				<br>
				  <form action="?" method="post">
					<textarea style="width:700px; height:70px;" id ="text" name = "text"></textarea>
			<br>
				     <input type="hidden" id= "receiver_id" name = "receiver_id" value = "<?php echo $id2;?>">
				    <input type="hidden" name = "act" value = "send_message">
					<input type="submit" class="formbutton" value = "SEND">
		
	</form>
				
	  </section>

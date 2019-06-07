	<aside id="sidebar" class="column-left">
				<ul>
                	<li>
						<h4>Navigate</h4>
                        <ul class="blocklist">
                            <li><a href="?page=profile">My profile</a></li>
                            <li><a href="?page=friends">My friends</a></li>
                            <li class="selected-item"><a href="?page=photos">My photos</a></li>
                            <li ><a href="?page=messages">My messages</a></li>
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
			 <div id = "photo_upload">
			  <div id="title_bar">
			      <table>
			          <tr>
			              	<td align="center"><a href="?page=photos">Home</a></td>
			             <td align="center"><a href="?page=create">Create Album</a></td>
			              <td align="center"><a href="?page=upload">Upload </a></td>
			          </tr>
			      </table>
                  </div>
                  <div id="container">
                      <h3>Create Album</h3>
                      <form method="post" action="?">
                          Album Name: <input type="text" name="name" />
                          <input type="hidden" name="act" value="create_album">
                          <input type="submit" class="formbutton" value="create"/>
                          
                      </form>
                      
                      
                  </div>
              </div>
	  </section>

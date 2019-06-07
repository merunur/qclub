
				<fieldset>

					<legend><h3>New post</h3></legend>
					<form action="?" method="post" enctype="multipart/form-data">
							<p><label for="post_photo">Upload photo:</label>
						    	 <input type="file" name = "post_photo" id="post_photo"><br> </p>	
						<p><label for="title">Title:</label>
						<input type="text" name="title" id="title" value="" /><br /></p>
						<p><label for="content">Content:</label>	
						<textarea cols="60" rows="11" name="content" id="content"></textarea><br /></p>
							<input type="hidden" value="add_post" name = "act">
						<p><input type="submit" name="send" class="formbutton" value="Send" /></p>
					</form>
	
				</fieldset>

<div>
	<?php if($user->avatar != PLACE_HOLDER_IMAGE): ?>
		<img src=<?=$user->avatar?> alt="UserAvatar" width="200" height="120">
	<?php endif; ?>
	<br>
	<?php if($user->avatar != PLACE_HOLDER_IMAGE): ?>
		<p> <strong>Replace your profile photo: </strong></p>
	<?php else: ?>
		<p> <strong>Add your profile photo: </strong></p>
	<?php endif; ?>

	<form class=formfields action="/users/p_profile_upload" method="post"
		enctype="multipart/form-data">

	    <?php if(isset($error)): ?>
		    <div class='error'>
		            Invalid file type or File may too be large (2MB limit).
		    </div>
		<?php endif; ?>


		<label for="file">Filename:</label>
		<input type="file" name="file" id="file" required><br>

 		<input type="submit" name="submit" value="Submit">
	</form>
</div>


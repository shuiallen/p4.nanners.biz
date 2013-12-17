<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<!-- Common CSS/JS -->
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
    <div class=outer-box>
        <div class=logo-header>
            What Am I Doing Today?
        </div>
        <div class=user-bar>
        	<!-- Menu for users who are logged in -->
			<?php if(is_object($user) && $user): ?>
				<li><a href='/users/logout'>Logout</a></li>
				<li><a href='/users/profile'>My Profile</a></li>
			<!-- Menu options for users who are not logged in -->
			<?php else: ?>
				<li><a href='/users/signup'>Register</a></li>
				<li><a href='/users/login'>Login</a></li>
		    <?php endif; ?>
        </div>
        <div class=nav>
 			<li><a href='/'>Home</a></li>

		<?php if(is_object($user) && $user): ?>
			<!-- Additional options for users who are logged in -->
			<li><a href='/tasks'>Tasks</a></li>
			<li><a href='/tasks/edit'>Work with Tasks</a></li>
			<li><a href='/reports'>Reports</a></li>
			<li><a href='/quicklists'>QuickList</a></li>
			<li><a href='/lists'>Build a List</a></li>
			<li><a href='/projects'>Projects</a></li>
        </div>

		<?php endif; ?>

        <div class=content>
			<?php if(isset($content)) echo $content; ?>
        </div>
    </div>

	<!-- Common CSS/JSS -->
	<?php if(isset($client_files_body)) echo $client_files_body; ?>

    <div class="footer"> &copy; My P4 What Am I Doing Today? Web Application</div>
</body>
</html>
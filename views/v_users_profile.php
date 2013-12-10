<h2> Profile </h2>

<div class=vertical-container>
    <form class=formfields method='POST' action='/users/p_update'>
        First Name<br>
        <input type='text' name='first_name' value=<?=$user->first_name ?>>
        <br><br>

        Last Name<br>
        <input type='text' name='last_name' value=<?=$user->last_name ?>>
        <br><br>

        Nick Name (optional)<br>
        <input type='text' name='nickname' value=<?=$user->nickname ?>>
        <br><br>

        Email<br>
        <input type='text' name='email' value=<?=$user->email?>>
        <br><br>

        <?php if(isset($error)): ?>
            <div class='error'>
                <?php if ($error == "duplicate"): ?>
                    An existing user is already using this email address.  Please provide a unique email address.
                   <br>
                <?elseif ($error == "invalidemail"): ?>
                    Invalid email address.
                   <br>
                <?php endif; ?>
            </div>
 
        <?php endif; ?>
        
        <input type='submit' value='Update'>

        <?php $error = NULL; ?>
    </form>
</div>
<br>

<div class="right-side-bar">
	<?=$avatar;?>    
</div>
<div class=right-side-bar>
<p> Profile created :
    <time datetime="<?=Time::display($user->created,'Y-m-d G:i')?>">
         <?=Time::display($user->created)?>
    </time>
</p>
</div>



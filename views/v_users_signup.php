<h2> Signup </h2>
<div class=vertical-container>
    <form class=formfields method='POST' action='/users/p_signup'>
        <?php if(isset($error) && $error == "blanks"): ?>
            <div class='error'>
                Missing required fields.
            </div>
            <br>
        <?php endif; ?>
        First Name<br>
        <input type='text' name='first_name' required>
        <br><br>

        Last Name<br>
        <input type='text' name='last_name' required>
        <br><br>

        Nick Name (optional)<br>
        <input type='text' name='nickname'>
        <br><br>

        Email<br>
        <input type='text' name='email' required>
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

        Password<br>
        <input type='password' name='password' required>
        <br><br>

        <input type='submit' value='Sign up'>

        <?php $error = NULL; ?>
    </form>
</div>
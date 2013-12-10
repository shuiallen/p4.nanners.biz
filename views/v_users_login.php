<h2> Log in </h2>
<div class=vertical-container>
    <form class=formfields method='POST' action='/users/p_login'>

        Email<br>
        <input type='text' name='email' autofocus required>

        <br><br>

        Password<br>
        <input type='password' name='password' required>

        <br><br>

        <?php if(isset($error)): ?>
            <div class='error'>
                Login failed. Please double check your email and password.
            </div>
            <br>
        <?php endif; ?>

        <input type='submit' value='Log in' >

    </form>
</div>
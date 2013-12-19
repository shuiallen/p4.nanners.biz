<?php

class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        # TODO: Change this
        Router::redirect('/posts/users');
    }

    public function signup($error = NULL) {

        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";

        # Pass data to the view
        $this->template->content->error = $error;

        # Generate a new CSRF session token, and pass it to the View
        $this->template->content->token = NoCSRF::generate('token');

        # Render template
        echo $this->template;

    }

    public function p_signup() {
        ProjectUtils::check_token($_POST, "update signup");
        # If it doesn't fail, we can remove the token
        unset($_POST['token']);

        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Sign up data fields should not have any funny business in them, so cleaning them on input
 
        $_POST['email'] = ProjectUtils::clean($_POST['email']);
        $_POST['first_name'] = ProjectUtils::clean($_POST['first_name']);
        $_POST['last_name'] = ProjectUtils::clean($_POST['last_name']);
        $_POST['nickname'] = ProjectUtils::clean($_POST['nickname']);
        # Password will never be displayed and should be exactly what the user input

        # The input form sets required, so this might be overkill in this simple project
        # But this allows signup to be used programmatically
        # Check input for blank fields, error if any are blank, skipping exceptions;
        if(users_controller::hasBlanks($_POST, array('nickname'))) { 
           Router::redirect('/users/signup/blanks');  
        }
   
        if (!users_controller::uniqueEmail($_POST['email'])) {
            Router::redirect("/users/signup/duplicate");
        }

        if (!users_controller::validEmail($_POST['email'])) {
           Router::redirect("/users/signup/invalidemail");
        }

        # More data we want stored with the user
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();
        
        # Encrypt the password  
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

        # Create an encrypted token via their email address and a random string
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        # Insert this user into the database
        $user_id = DB::instance(DB_NAME)->insert('users', $_POST);

        # Question: how do you know the insert succeeded?  
        # Send them to the login page
        Router::redirect('/users/login');
     
    }

    // Look for blank values in form data, skipping noted exceptions
    private function hasBlanks($formdata, $skip) {

        foreach($formdata as $field => $value){
            if (in_array($field, $skip))
                continue;
            if(empty($value)) { 
               return true;  
            }
        }
        return false;  

    }

    // Is this email address already used by an existing user?
    private function uniqueEmail($email) {

        # Check that this email address is unique
        $q = "SELECT email 
                FROM users 
                WHERE email = '".$email."'"; 

        $email = DB::instance(DB_NAME)->select_field($q);
        
        # If we found a record with the same email, reject the signup
        if($email) {
            return false;
        }
        return true;

    }

    // This is a util that could be moved to a Utilities library
    // This is a hack to at least get an email address in the format 'name@emailhost'
    private function validEmail($email) {

        # Check that the email address is in a valid format
        # Comment this out because I want to use non-existent email addresses during testing
        # and I'm not using real email functions yet
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //    Router::redirect("/users/signup/invalidemail");
        // }

        $atpos = strpos($email,'@');
        $name = strstr($email, '@', true);

        # If we didn't find an '@' in the email, or
        # there isn't a string before and after the @
        if (!$atpos)
            return false;
        if (strlen($name) > 0 && strlen($email)-1 > $atpos)
            return true;
        return false;

    }

    public function login($error = NULL) {
 
        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        # Pass data to the view
        $this->template->content->error = $error;

        # Generate a new CSRF session token, and pass it to the View
        $this->template->content->token = NoCSRF::generate('token');
        
        # Render template
        echo $this->template;
    }

    public function p_login() {
       ProjectUtils::check_token($_POST, "update profile");
        # If it doesn't fail, we can remove the token
        unset($_POST['token']);

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
        $q = "SELECT token 
                FROM users 
                WHERE email = '".$_POST['email']."' 
                AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        # If we didn't find a matching token in the database, it means login failed
        if(!$token) {

            # Send them back to the login page
            Router::redirect("/users/login/error");

        # But if we did, login succeeded! 
        } else {

            /* 
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
            setcookie("token", $token, strtotime('+1 year'), '/');

            # Send them to the main page
            Router::redirect("/lists/mylists");

        }

    }

    public function logout() {

        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them to the main page
        Router::redirect("/");

    }

    public function profile($error = NULL) {

        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) {
            Router::redirect('/users/login');
        }

        # If they weren't redirected away, continue:

        # Setup view
        $this->template->content = View::instance('v_users_profile');
        $this->template->title   = "Profile of ".$this->user->first_name;
        # the user's image is handled in a separate view
        $this->template->content->avatar = View::instance('v_users_avatar');

        # Pass data to the view
        $this->template->content->avatar->error = $error;
        $this->template->content->error = $error;

        # Generate a new CSRF session token, and pass it to the View
        $this->template->content->token = NoCSRF::generate('token');

        # Render template
        echo $this->template;

    }

    public function p_update () {

        ProjectUtils::check_token($_POST, "update profile");
        # If it doesn't fail, we can remove the token
        unset($_POST['token']);

        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        if ($_POST['email'] != $this->user->email) {
        if (!users_controller::uniqueEmail($_POST['email'])) {
            // Todo: this is breaking the update operation, fix this
            Router::redirect("/users/profile/duplicate");
        }
        if (!users_controller::validEmail($_POST['email'])) {
           Router::redirect("/users/profile/invalidemail");
        }}

         # Update the user's data
        DB::instance(DB_NAME)->update(
            'users', $_POST, "WHERE user_id = ".$this->user->user_id);
        Router::redirect("/users/profile");
       
    }

    public function p_profile_upload() {

        # Upload the chosen filen and store in avatars directory with the user_id to identify the file
        $file = Upload::upload($_FILES, "/uploads/avatars/", array("jpg", "jpeg", "gif", "png"), $this->user->user_id);

        // Is there a better way to check for error ?
        if ($file == 'Invalid file type.' || $file == 'Error moving file') {
            Router::redirect('/users/profile/error');
        }

        # Update the user's avatar in the database
        DB::instance(DB_NAME)->update('users', Array("avatar" => $this->user->user_id.".jpg"),
                                      "WHERE user_id = ".$this->user->user_id);
        Router::redirect("/users/profile");
    }
} # end of the class
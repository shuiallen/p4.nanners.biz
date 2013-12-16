<?php

// library for re-usable utility functions
// All methods should be static, accessed like: Utils::method(...);
class ProjectUtils {

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public static function clean($input) {
	
	    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
		
	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public static function check_token($data, $errstr) {
        /*
        @param String $key The session and $origin key where to find the token.
        @param Mixed $origin The object/associative array to retreive the token data from (usually $_POST).
        @param Boolean $throwException (Facultative) TRUE to throw exception on check fail, FALSE or default to return false.
        @param Integer $timespan (Facultative) Makes the token expire after $timespan seconds. (null = never)
        @param Boolean $multiple (Facultative) Makes the token reusable and not one-time. (Useful for ajax-heavy requests).

        @return Boolean Returns FALSE if a CSRF attack is detected, TRUE otherwise.
        */
		$csrf_pass = NoCSRF::check('token', $data, false, 60*10, true );

		# force failure for testing purposes
		# $csrf_pass = false;
		
        # CSRF Failed
        if(!$csrf_pass) {
            # How you want to handle the error is up to you; here we're just passing back a generic error message
            die("CSRF token error in ".$errstr);
        }
	}
} # eoc

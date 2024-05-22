<?php
class Validate
{
    static function validName($first, $last){
        return ctype_alpha(trim($first)) && ctype_alpha(trim($last));
    }

    static function validGithub($link){
        return (filter_var($link, FILTER_VALIDATE_URL));
    }

    static function validExperience($exp){
        return is_string($exp);
    }

    static function validPhone($phone){
        return strlen($phone) == 10;
    }


    static function validEmail($email){
        return (filter_var($email, FILTER_VALIDATE_EMAIL));
    }
}


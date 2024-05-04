<?php

//First and last name
function validName($first, $last){
    return ctype_alpha(trim($first)) && ctype_alpha(trim($last));
}

function validGithub($link){
    return (filter_var($link, FILTER_VALIDATE_URL));
}

function validExperience($exp){
    return is_string($exp);
}

function validPhone($phone){
    return strlen($phone) == 10;
}


function validEmail($email){
    return (filter_var($email, FILTER_VALIDATE_EMAIL));
}


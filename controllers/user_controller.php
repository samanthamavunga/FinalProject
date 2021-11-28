<!--this what is going to call the class methods 
this is where unit testing will bewhat receives information from the front end and pass it to the model class
connect to user class inside the classes 


Inserting new posts

is calling of a method inside post class==>means go into post user class and call the function create


create instance of a each method and run the query


call the function
create instance of each method and run the query
have ifcnditions


Functions such as delete, update, getresults, create, 

-->

<?php
//connect to database class
require_once (dirname(__FILE__)).'/../classes/user_class.php';

function register_new_user($username, $email, $password, $image_path){
    // create a new instance of user object
    $user = new User;

    // run the query
    $run_query = $user->register($username, $email, $password, $image_path);

    // if successful
    if($run_query){
        return $run_query;
    }else{
        return false;
    }
}

function verify_email_fxn($email){
    // create a new instance of user object
    $user = new User;

    // run the query
    $run_query = $user->verify_email($email);

    // if successful
    if($run_query){
        // fetch data from database
        $user_email = $user->db_fetch();
        if(empty($user_email)){
            // if empty means the email isn't in the database already
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
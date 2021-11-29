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

function register_new_user($fname, $lname,$username, $gender, $dob, $location, $street_name, $par, $sch, $randominfor, $pnum, $psw, $psw_repeat, $image){
    // create a new instance of user object
    $user = new User;

    // run the query
    $run_query = $user->register($fname, $lname,$username, $gender, $dob, $location, $street_name, $par, $sch, $randominfor, $pnum, $psw, $psw_repeat, $image);

    // if successful
    if($run_query){
        return $run_query;
    }else{
        return false;
    }
}

function verify_username($username){
    // create a new instance of user object
    $user = new User;

    // run the query
    $run_query = $user->verify_username($username);

    // if successful
    if($run_query)
    {
        // fetch data from database
        $user_username = $user->db_fetch();
        if(empty($user_username))
        {
            // if empty means the username isn't in the database already
            return true;
        }
        else{
            return false;
        }
    }else{
        return false;
    }
}
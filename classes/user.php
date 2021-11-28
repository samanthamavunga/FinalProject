<!--any sql query pertaining to the user, anything about the user 
inserting new user
class user will extent the connection, require that

For example l have function that will create new user, update, delete,
etc
a child class of the database class will be created
user extend 

Class user extend database->

<?php
//connect to database class
require_once (dirname(__FILE__)).'/../settings/db_class.php';

class User extends db_connection{
    // register user
    public function register($username, $email, $password, $image_path){
        $sql = "INSERT INTO `users`(`name`, `email`, `password`, `image`) VALUES ('$username', '$email', '$pasword', '$image_path')";

        return $this->db_query($sql);
    }

    // verify user email
    public function verify_email($email){
        $sql = "SELECT * FROM `users` WHERE `email`='$email'";
        return $this->db_query($sql);
    }
}

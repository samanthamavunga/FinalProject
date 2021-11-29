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
require_once (dirname(__FILE__)).'/../Database_Connections/db_class.php';

class User extends db_connection{
  // register user
  function register_new_user($fname, $lname,$username, $gender, $dob, $location, $street_name, $par, $sch, $randominfor, $pnum, $psw, $psw_repeat, $image)
  {
    $sql="INSERT INTO `register`(`firstname`, `lastname`, `username`, `gender`, `dob`, `location`, `street_name`, `parentname`, `school`, `randominfor`, `phonenumber`, `password`, `image`) VALUES ('$fname', '$lname','$username','$gender','$dob','$location','$street_name','$par','$sch','$randominfor','$pnum','$psw','$image')";

      return $this->db_query($sql);
  }

  
  // verify user username
  public function verify_username($username){
      $sql = "SELECT * FROM `register` WHERE `username`='$username'";
      return $this->db_query($sql);
  }
}


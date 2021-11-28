<!--any sql query pertaining to the user, anything about the user 
inserting new user
class user will extent the connection, require that

For example l have function that will create new user, update, delete,
etc
a child class of the database class will be created
user extend 

Class user extend database->

<?php
//MVC
//Model that interacts with database
//Code that interact with my database
//connect to database class
require_once (dirname(__FILE__)).'/../settings/db_class.php';

class Post extends db_connection {
    public function create($title, $body){
        // sql query
        $sql = "INSERT INTO `posts`(`title`, `body`) VALUES ('$title','$body')";//being called where there was an arror create

        // run query
        return $this->db_query($sql);
    }

    public function getPosts(){
        //sql query
        $sql = "SELECT * FROM `posts`";

        //run query
        return $this->db_query($sql);
    }

    public function getSinglePost($id){
        // sql query
        $sql = "SELECT * FROM `posts` WHERE `id`='$id'";

        // run query
        return $this->db_query($sql);
    }

    public function update($id, $title, $body){
        // sql query
        $sql = "UPDATE `posts` SET `title`='$title',`body`='$body' WHERE `id`='$id'";

        // run query
        return $this->db_query($sql);
    }

    public function delete($id){
        // sql query
        $sql = "DELETE FROM `posts` WHERE `id`='$id'";

        // run query
        return $this->db_query($sql);
    }
}

?>



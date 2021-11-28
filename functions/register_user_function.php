<?php
//connect to controller
require_once (dirname(__FILE__)).'/../controllers/user_controller.php';

// keep track of errors
$errors = array();
// check if the button has been clicked
if(isset($_POST["submit"])){
    // grab form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["password2"];

    // validate data
    // check if fields are empty
    if(empty($username)){
        array_push($errors, "name is requried");
    }
    if(empty($email)){
        array_push($errors, "email is requried");
    }
    if(empty($password)){
        array_push($errors, "password is requried");
    }
    if(empty($confirm_password)){
        array_push($errors, "password 2 is requried");
    }

    // check if email already exists
    $verify_email = verify_email_fxn($email);
    if(!$verify_email){
        array_push($errors, "email already exists");
    }

    // check if fields are of appropriate length
    if(strlen($username) > 100){
        array_push($errors, "username must be shorter than 100 characters");
    }
    if(strlen($email) > 100){
        array_push($errors, "email must be shorter than 100 characters");
    }

    // check if passwords are the same
    if($password != $confirm_password){
        array_push($errors, "passwords need to match");
    }

    // validate email with regex
    $regex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
    // set an error if not a valid email address
    if(!preg_match($regex, $email)){
        array_push($errors, "enter a valid email address");
    }

    // image validation
    $target_dir = "images/";
    // file path
    $target_file = $target_dir.basename($_FILES["image"]["name"]);
    // image file type
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // check if image has been uploaded
    if(empty($_FILES["image"]["name"])){
        array_push($errors, "file cannot be empty");
    }else{
        // check if its an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check == false){
            array_push($errors, "file is not an image");
        }

        // check if the file already exists
        if(file_exists($target_file)){
            array_push($errors, "file already exists");
        }

        // limit file size to 5MB
        if($_FILES["image"]["size"] > 5000000){
            array_push($errors, "upload an image less than 5MB");
        }

        // limit file type
        if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "gif"){
            array_push($errors, "Sorry, only JPG, PNG & GIF files are allowed");
        }
    }


    // if form is fine
    if(count($errors) == 0){
        // upload image
        $upload_image = move_uploaded_file($_FILES["image"]["tmp_name"], '../'.$target_file);

        // check if uploaded succesfully and then add new user
        // note we are stroring the path to the image in the database
        if($upload_image){
            // if upload was a success
            // encrypt password
            $password = md5($password);

            // register the new user
            $register_user = register_new_user($username, $email, $password, $target_file);

            // check if user is registered
            if(!$register_user){
                echo "failed";
            }else{
                echo "success";
                // redirect
            }
        }else{
            echo "upload failed";
        }
    }else{
        session_start();
        // store the errors inside session
        $_SESSION["errors"] = $errors;
        header("location: ../index.php");
    }
    // upload image
    // record new user into the database
}
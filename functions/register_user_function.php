
<?php
//connect to controller
require_once (dirname(__FILE__)).'/../controllers/user_controller.php';

// keep track of errors
$errors = array();

// check if the button has been clicked
if(isset($_POST["register"]))
{

    // grab form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['uname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob']; 
    $location = $_POST['loc'];
    $street_name = $_POST['street_loc'];
    $par = $_POST['par'];
    $sch = $_POST['sch'];
    $randominfor =$_POST['randominfor'];
    $pnum = $_POST['pnum'];
    $psw = $_POST['password'];
    $psw_repeat= $_POST['password2'];
    $image = $_POST['image'];

    // validate data
    // check if fields are empty

    //for fname
    if(empty($fname))
    {
      array_push($errors, "firstname is required");
     }
     

    //for lname 
    if(empty($lname))
    {
      array_push($errors, "Lastname is required");
     }

     //for username
    if(empty($gender))
    {
        array_push($errors, "please select gender, is required");
    }

    //
    if(empty($dob)){
        array_push($errors, "dob is required"); 
    }


    //for location confirmation
    if(empty($location))
    {
        array_push($errors, "location is required");
    }


    //for location confirmation
    if(empty($street_name))
    {
        array_push($errors, "streetname is required");
    }


    //for location confirmation
    if(empty($par))
    {
        array_push($errors, "Name or parent/guardian is requried");
    }
     
    //for primary school
    if(empty($sch))
    {
        array_push($errors, "School name is requried");
    }

    //for short answer
    if(empty($randominfor))
    {
        array_push($errors, "Short answers is requried");
    }

    //for short answer
    if(empty( $pnum ))
    {
        array_push($errors, "Phone number is requried");
    }


    //for password
    if(empty($psw))
    {
        array_push($errors, "Password is requried");
    }
    

    //for password confirmation
    if(empty($psw_repeat))
    {
      array_push($errors, "passwordconfirmaton is requried");
    }


    // check if email already exists
    $verify_username = verify_username($username); 
    if(!$verify_username){
        array_push($errors, "Username already exists");
    }

    // check if fields are of appropriate length
    if(strlen($username) > 100){
        array_push($errors, "username must be shorter than 100 characters");
    }
    if(strlen($password) > 15){
        array_push($errors, "password must be shorter than 100 characters");
    }

    // check if passwords are the same
    if($psw != $psw_repeat){
        array_push($errors, "passwords need to match");
    }

    // validate email with regex
    //$regex = "/^[a-zA-Z-]+$/;";
    // set an error if not a valid email address
    //if(!preg_match($regex, $username)){
       // array_push($errors, "Your username is not valid. Only characters A-Z, a-z and '-' are  acceptable.");
    //}

    // image validation
    $target_dir = "images/";

    // file path
    $target_file = $target_dir.basename($_FILES["image"]["name"]);

    // image file type
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // check if image has been uploaded
    if(empty($_FILES["image"]["name"]))
    {
        array_push($errors, "file cannot be empty");
    }
    else{
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
        // note we are storing the path to the image in the database
        if($upload_image){

            // if upload was a success
            // encrypt password
            $password = md5($password);

            // register the new user
            $register_user = register_new_user($fname, $lname,$username, $gender, $dob, $location, $street_name, $par, $sch, $randominfor, $pnum, $psw, $psw_repeat, $target_file);

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
        header("location: ../Registration.php");
    }
    // upload image
    // record new user into the database
}
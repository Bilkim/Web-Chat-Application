<?php
session_start();
include_once "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    //check if user email is valid
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        //if the email is valid
        // check if the email already exists
        $sql = mysqli_query($conn, "SELECT email from users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            echo "$email - This email already exists!";
        }else{
            //check if image is uploaded
            if(isset($_FILES['image'])){ //if file is uploaded
                $img_name = $_FILES['image']['name'];//getting user uploaded img name
                $img_type = $_FILES['image']['type'];//getting user uploaded img type
                $tmp_name = $_FILES['image']['tmp_name'];//this temporary name is used to save/move file in our folder   
                
                //explode image and get the last extension like jpg png
                $img_explode = explode('.',$img_name);
                $img_ext = end($img_explode);//extension of a user uploaded image file

                $extensions = ['png','jpeg','jpg'];//img ext
                if(in_array($img_ext, $extensions) === true){
                    // if user uploaded img ext is matched with an array extension
                    $time = time();//return us the current time
                                    // time is needed when uploading user img to in our folder we rename user file with current time
                                    //so that all the image files will have a unique name
    
                    //moving the user uploaded img to our particular folder
                    $new_img_name = $time.$img_name;

                    if(move_uploaded_file($tmp_name, "images/".$new_img_name)){//if user upload img move to our folder
                        $status = "Active now"; //once user signs up the status will be active now
                        $random_id = rand(time(), 10000000);// creating random id for user

                        //insert all data inside table
                        $sql2 = mysqli_query($conn, "INSERT INTO users (`unique_id`, `fname`, `lname`, `email`, `password`,`img`, `status`)
                                             VALUES ({$random_id},'{$fname}','{$lname}','{$email}','{$password}','{$new_img_name}','{$status}')");

                        if($sql2){//if data is inserted
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if(mysqli_num_rows($sql3) > 0 ){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id'];//using this session we used user unique_id in other php file
                                echo "success";  
                            }
                        }
                        else{
                            echo"Something went wrong!";
                        }
                    }
                    

                }else{
                    echo"Please select an image file - jpeg, jpg, png!";
                }


            }else{
                echo"Please select an image file";
            }
        }
    }else{
        echo"$email - This is not a valid email";
    }
}else{
    echo"All input fields are required!";
}
?>
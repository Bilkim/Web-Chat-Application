<?php
$conn = mysqli_connect("localhost", "root", "", "login","3309");
if(!$conn){
    echo"Connected..." .mysqli_connect_error();
}
 $username = mysqli_real_escape_string($conn, $_POST['username']);
 $password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($email) && !empty($password)){

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
    if(mysqli_num_rows($sql) > 0){//if users credential match
        $row = mysqli_fetch_assoc($sql);
        $status = "Active now";
        //update user status to active now id user login successfully
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
        $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other php file
        echo "success";
        $_SESSION['unique_id'] = $row['unique_id'];//using this session we used user unique_id in other php file
        echo "success";

    }else{
        echo"Email or password is incorrect!";
    }
}else{
    echo"All input fields are required!";
}


?>
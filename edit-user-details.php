<?php
include("config/constants.php");
include("partials/user-login-check.php");

if(isset($_POST['edit-sent'])){
    $username = $_POST['edit-sent'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $mail = $_POST['mail'];
    $user = $_POST['user'];
    $location = $_POST['location'];

    $sql = "UPDATE tbl_user SET full_name = '$name', contact_number = '$number', email = '$mail', location = '$location' WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);


    header("Location: view-user.php");
}else{
    header("Location: ./");
}

?>
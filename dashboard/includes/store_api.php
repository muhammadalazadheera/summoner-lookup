<?php 

    session_start();
    require '../../assets/setup/db.inc.php';

    if(isset($_POST['store_api'])){

        $key = mysqli_real_escape_string($conn, $_POST['api_key']);
        $expire_date = mysqli_real_escape_string($conn, $_POST['expire_date']); 
        $result = mysqli_query($conn,  "UPDATE `api` SET `api_key`='$key',`expire_date`='$expire_date' WHERE 1");

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        
    } 
 
?>

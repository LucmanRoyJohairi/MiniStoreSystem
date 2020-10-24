<?php
//namespace App\Http\Controllers;
    include('db_connection.php');
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $sql = "Select username,password from tblaccounts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($user == $row["username"]){
                if($pass == $row["password"]){
                    echo "Login Successful";
                }else{
                    echo "username or password is incorrect";
                }
            }else{
                echo "username or password is incorrect";
            }
        }
    } else {
        echo "0 results";
    }
    $conn->close();

?>

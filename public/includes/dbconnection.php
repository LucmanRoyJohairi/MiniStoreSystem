<?php 
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=dbinventorysystem','root','');
    }catch(PDOException $f){
        echo $f->getmessage;
    }

    // $db['db_host'] = "localhost";
    // $db['db_user'] = "root";
    // $db['db_pass'] = "";
    // $db['db_name'] = "dbInventorySystem";

    // //converting to constants
    // foreach($db as $key => $value){
    //     define(strtoupper($key), $value);
    // }



    // $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // if(!$connect){
    //     die("failed to connect to the server.");

    // }
?> 
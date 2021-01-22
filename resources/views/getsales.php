@php
    include('includes/dbconnection.php');
    //$id = $_GET['id'];

    $sql = $pdo->prepare('select * from tblorders order by orderId desc');
    $sql->execute();

    $row1 = array();
    while($row=$sql->fetch(PDO::FETCH_OBJ)){
       $row1[] = $row;
    }
    //print_r($row1);
    $response = $row1;

    header('Content_type: application/json');

    // foreach($response as $a){
    //     echo json_encode($a[0]);
    // }
   echo json_encode($response);

@endphp

@php 
    include('includes/dbconnection.php');
    $id = $_GET['id'];

    $sql = $pdo->prepare('select * from tblproducts where productId = :p');
    $sql->bindParam(":p", $id);
    $sql->execute();

    $row = $sql->fetch(PDO::FETCH_ASSOC);

    $response = $row;

    header('Content_type: application/json');

    echo json_encode($response);

@endphp

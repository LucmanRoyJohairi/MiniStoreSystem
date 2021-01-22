<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use PDO;
Class OrdersController extends Controller
{
    use ApiResponse;

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    
    public function orders(){
        return view('orders');
    }
    
    public function values(){
        include('includes/dbconnection.php');

        $id = $_GET['id'];

        $sql = $pdo->prepare('select * from tblproducts where productId = :p');
        $sql->bindParam(":p", $id);
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        $response = $row;

        header('Content_type: application/json');

        echo json_encode($response);

    }
    
    public function addOrder(){
        include('includes/dbconnection.php');
        if(isset($_POST['btnOrder'])){
            $cname = $_POST['customername'];
            $date = $_POST['date'];
            $total = $_POST['total'];
            $paid = $_POST['paid'];
            $due = $_POST['due'];
        
            $sql = $pdo->prepare('insert into tblorders(customerName, orderDate, Total, Paid, Due) values(:a, :b, :c, :d, :e)');
            $sql->bindParam(':a', $cname);
            $sql->bindParam(':b', $date);
            $sql->bindParam(':c', $total);
            $sql->bindParam(':d', $paid);
            $sql->bindParam(':e', $due);
        
            if($sql->execute()){
              echo 'order added';
            }else{
              echo 'order failed';
            }
          }
    }
}
?>



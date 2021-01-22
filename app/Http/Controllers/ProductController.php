<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

Class ProductController extends Controller
{
    use ApiResponse;

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    
    public function addProduct(){
        include ("includes/dbconnection.php");
        if(isset($_POST['btnAdd'])){
            $pname = $_POST['Name'];
            $category = $_POST['category'];
            $pprice = $_POST['purchaseprice'];
            $sprice = $_POST['salesprice'];
            $stock = $_POST['stockleft'];
            $description = $_POST['description'];
        
            // =========== Image Upload ==============
            $f_name = $_FILES['productimage']['name'];
            $f_temp = $_FILES['productimage']['tmp_name'];
        
            $f_size = $_FILES['productimage']['size'];
            $f_extension = explode('.', $f_name);
            $f_extension = strtolower(end($f_extension));
        
            $f_newfile = uniqid().'.'.$f_extension;
            $store = "productimages/".$f_newfile;
        
            if($f_extension == 'jpg' || $f_extension == 'png' || $f_extension == 'gif'){
              if($f_size>=1000000){
                echo 'file must be 1mb';
              }else{
                if(move_uploaded_file($f_temp, $store)){
                  $image = $f_newfile;
                  $insertProd = $pdo->prepare("insert into tblproducts(productName,ProductCategory,purchasePrice,salePrice,productStock,productDescription,productImage) Values(:a, :b, :c, :d, :e, :f, :g)");
                  $insertProd->bindParam(':a', $pname);
                  $insertProd->bindParam(':b', $category);
                  $insertProd->bindParam(':c', $pprice);
                  $insertProd->bindParam(':d', $sprice);
                  $insertProd->bindParam(':e', $stock);
                  $insertProd->bindParam(':f', $description);
                  $insertProd->bindParam(':g', $image);
        
                  if($insertProd->execute()){
                    echo 'Product added';
                  }else{
                    echo 'product not added';
                  }
        
                }
              }
            }else{
              echo 'Only .png and .jpg are accepted';
            }
        
        
            //$image = $_POST['productimage'];
        
            
        
        
          }
    
        
    }
    public function deleteProduct(){
        include ('includes/dbconnection.php');
        if(isset($_POST['btndel'])){
            $delId = $_POST['btndel'];
            $del = $pdo->prepare("delete from tblproducts where productId = '$delId'");
            //echo $del->execute();
            if($del->execute()){
                echo 'Record Deleted';
            }else{
              echo 'Failed to delete record';
            }
        }
    }
}
?>

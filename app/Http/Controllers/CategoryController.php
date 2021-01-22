<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

Class CategoryController extends Controller
{
    use ApiResponse;

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    
    public function deleteCategory(){
        include ('includes/dbconnection.php');
        if(isset($_POST['btndel'])){
            $delId = $_POST['btndel'];
            $del = $pdo->prepare("delete from tblcategory where catId = '$delId'");
            //echo $del->execute();
            if($del->execute()){
                echo 'Record Deleted';
            }else{
              echo 'Failed to delete record';
            }
        }
    }

    public function addcategory(){
        include ('includes/dbconnection.php');
        if(isset($_POST['btnAdd'])){
            $catName = $_POST['categoryname'];
        
        
            $insertCat = $pdo->prepare("insert into tblcategory(category) Values(:category)");
            $insertCat->bindParam(':category', $catName);
        
            
            if($insertCat->execute()){
              echo 'Category added';
            }
            
        
          }
    }
    
}
?>

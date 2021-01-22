<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

Class UserController extends Controller
{
    use ApiResponse;

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    
    public function login(){
        return view('login');
    }
    
    public function submit(){
       
        $user = $_POST["username"];
        $pass = $_POST["password"];

        $data = User::all();
        
        foreach ($data as $acc){
            $realUser = $acc->username;
            //return $realUser;
            if($user == $realUser){
                $realPass = $acc->password;
                if($pass == $realPass){
                    return view('dashboard');
                }
                if($pass != $realPass){
                    return 'Username or password is incorrect.';
                }
            }
        }
    }

    public function addUser(){
        include ("includes/dbconnection.php");
        if(isset($_POST['btnSubmit'])){
            $username = $_POST['Name'];
            $password = $_POST['Password'];
            $email = $_POST['Email'];
            $usertype = $_POST['Usertype'];
    
    
            if(isset($_POST['Email'])){
                $sql1 = $pdo->prepare("SELECT email from tblusers where email = '$email'");
                $sql1->execute();
                if($sql1->rowCount() > 0){
                    echo 'email already exist';
                }else{
                    
                    $sql2 = $pdo->prepare("insert into tblusers(username, email, password, userType) Values(:name, :email, :pass, :usertype)");
    
                    $sql2->bindParam(':name', $username);
                    $sql2->bindParam(':email', $email);
                    $sql2->bindParam(':pass', $password);
                    $sql2->bindParam(':usertype', $usertype);
    
                    if($sql2->execute()){
                    echo 'User added';
    
                    }else{
                            
                        echo 'Failed to add user';
                    }
                }
            }
            
    
        }
    }
    public function deleteUser(){
        include ('includes/dbconnection.php');
        if(isset($_POST['del'])){
           
            $delId = $_POST['del'];
            
            $del = $pdo->prepare("delete from tblusers where userId = '$delId'");
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

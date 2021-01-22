<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

Class DashboardController extends Controller
{
    use ApiResponse;

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function category(){
        return view('category');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function register(){
        return view('register');
    }
    public function addproduct(){
        return view('addproduct');
    }
    public function products(){
        return view('products');
    }
    public function orders(){
        return view('createorder');
    }
    public function salesreport(){
        return view('salesreport');
    }
}
?>

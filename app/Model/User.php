<?php

namespace App\Model;

//the library to create a model in lumen
use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'tblusers';
    // column sa table
    protected $fillable = [
        'username', 'email', 'password', 'userType',
    ];
    public $timestamps = false;
    protected $primaryKey = 'userId';//add to not explicitly ask for an id when adding data
}

?>

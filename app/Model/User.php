<?php

namespace App\Model;

//the library to create a model in lumen
use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'tblaccounts';
    // column sa table
    protected $fillable = [
        'username', 'password'
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';//add to not explicitly ask for an id when adding data
}

?>

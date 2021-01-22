<?php

namespace App\Model;

//the library to create a model in lumen
use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    protected $table = 'tblcategory';
    // column sa table
    protected $fillable = [
        'category',
    ];
    public $timestamps = false;
    protected $primaryKey = 'catId';//add to not explicitly ask for an id when adding data
}

?>

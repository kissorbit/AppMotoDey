<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{

    protected $table = 'menus';
    
    public  function Children(){
        return $this->hasMany('App\Menus','parent')->orderBy('hierarchy','asc');
    }

}

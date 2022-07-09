<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{

    protected $table = 'modules';

    public function ModuleFields()
    {
        return $this->hasMany('App\ModuleFields', 'module_id', 'id');
    }
}

<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Selectlsr extends Model
{
    protected $table = 'Selectlsr';
    
    public function select(){ return $this->belongsTo('App\Lsrs', 'select', 'id');}
    
}

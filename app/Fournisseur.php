<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $table = 'Fournisseur';
    
    public function name_drivers(){ return $this->belongsTo('App\Drivers', 'name_drivers', 'id');}
    
}

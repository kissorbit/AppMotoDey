<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    protected $table = 'Construction';
    
    public function trucks_location(){ return $this->belongsTo('App\Truckconstruction', 'trucks_location', 'id');}
    
}

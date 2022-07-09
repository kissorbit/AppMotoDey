<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Agriculture extends Model
{
    protected $table = 'Agriculture';
    
    public function transportgoods(){ return $this->belongsTo('App\Transportgoods', 'transportgoods', 'id');}
    
}

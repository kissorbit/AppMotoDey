<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Maketrade extends Model
{
    protected $table = 'Maketrade';
    
    public function choise_lsp(){ return $this->belongsTo('App\Lsrs', 'choise_lsp', 'id');}public function choise_lsr(){ return $this->belongsTo('App\Lsrs', 'choise_lsr', 'id');}
    
}

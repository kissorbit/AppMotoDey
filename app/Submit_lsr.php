<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Submit_lsr extends Model
{
    protected $table = 'Submit_lsr';
    
    
    public function setdate_loadingAttribute($value){ $date = \DateTime::createFromFormat('d-m-Y H-i-s',$value);$this->attributes['date_loading'] = $date->format('Y-m-d H:i:s');  }public function getdate_loadingAttribute($value){ return date('d-m-Y H-i-s',  strtotime($value)); }
}

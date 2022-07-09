<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleFields extends Model
{

    protected $table = 'module_fields';

    public function Modules()
    {
        return $this->belongsTo('App\Modules', 'module_id', 'id');
    }
}

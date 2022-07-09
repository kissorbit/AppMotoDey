<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{

    protected $table = 'fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['field_name'];

}

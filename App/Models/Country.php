<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Interfaces\ModelInterface;

class Country extends Model implements ModelInterface
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];    
    protected $guarded = ['id'];
    public function getAll(){
        return self::all();
    }
    static public function findFromId(int $id){
        return self::find($id);
    }
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }                
}

?>